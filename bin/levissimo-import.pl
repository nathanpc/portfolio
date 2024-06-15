#!/usr/bin/env perl

=head1 NAME

Levissimo::Importer - Imports levissimo blog posts into our website

=head1 SYNOPSIS

Simply provide the path to the levissimo's blog root folder as a command-line
argument and this script will take care of importing everything into this
website.

=cut

package Levissimo::Importer;

use strict;
use warnings;
use autodie;

use Carp;
use Data::Dumper qw(Dumper);
use File::Copy;
use File::Spec;
use File::Basename;
use Term::ANSIColor;

=head1 GLOBALS

=over 4

=item I<$base_dir>

Directory where the levissimo blog we are importing is located at.

=cut

my $base_dir = undef;

=back

=head1 METHODS

=over 4

=item I<@posts> = C<get_post_files>(I<$post_dir>)

Gets the list of blog post files from the levissimo I<$post_dir>.

=cut

sub get_post_files {
	my ($post_dir) = @_;

	# Get the list of blog post files.
	my @posts = ();
	opendir(my $dir, $post_dir);
	foreach (readdir($dir)) {
		if ((-f "$post_dir/$_") && ($_ =~ /\.html$/)) {
			push @posts, $_;
		}
	}
	closedir $dir;

	# Sort the posts the same way they should be presented.
	return sort { $b cmp $a } @posts;
}

=item I<@lines> = C<read_lines>(I<$path>)

Reads a file in I<$path> line-by-line and returns the array of lines.

=cut

sub read_lines {
	my ($path) = @_;

	my @lines = ();
	open(my $fh, '<:encoding(UTF-8)', $path);
	while (my $line = <$fh>) {
		chomp $line;
		push @lines, $line;
	}
	
	return @lines;
}

=item I<%tags> = C<parse_meta_tags>(I<\@lines>)

Parses the meta tags in the I<$article>.

=cut

sub parse_meta_tags {
	my ($lines) = @_;
	my %tags;

	foreach (@{$lines}) {
		# Yes, I know parsing HTML with regular expressions is bad.
		if ($_ =~ /^<\s?meta\s+name="(?<name>[\w\d\.\-:_']+)"\s+content="(?<content>[^"]+)"\s?>\s?$/g) {
			$tags{$+{name}} = $+{content};
		}
	}

	return %tags;
}

=item I<$slug> = C<make_slug>(I<$content>)

Generates a slug based on the provided content.

=cut

sub make_slug {
	my ($content) = @_;
	my $slug = $content;

	# Create the slug.
	$slug =~ s/[^\w\d\-_]/\-/g;  # Substitute everything illegal for dashes.
	$slug =~ s/\-+/\-/g;         # Remove duplicate dashes.
	$slug =~ s/\-$//;            # Remove trailing dash.

	# Make lowercase and remove cruft to make it short.
	$slug = lc $slug;
	$slug =~ s/\-([mts])\-/$1\-/g;
	$slug =~ s/(^|\-)(its?|is|in|a|i|the|for|to|of|and)\-/\-/g;

	# Final clean up.
	$slug =~ s/\-+/\-/g;
	$slug =~ s/^\-//;
	$slug =~ s/\-$//;

	return $slug;
}

=item I<$path> = C<import_image>(I<$name>, I<$src>)

Imports an image from levissimo to our website and returns the new I<$path> of
the image relative to the website's public folder.

=cut

sub import_image {
	my ($name, $src) = @_;

	# Determine the output image folder location and create it if needed.
	my $img_folder = dirname(dirname(__FILE__)) . "/public/assets/blog/$name";
	if (!-d $img_folder) {
		mkdir $img_folder;
	}

	# Copy the image from its original location to ours.
	my $img_path = "$base_dir/static" . $src;
	copy($img_path, "$img_folder/" . basename($src));

	return "/assets/blog/$name/" . basename($src);
}

=item I<$fname> = C<build_name>(I<\%tags>)

Builds up a compliant filename for the post.

=cut

sub build_name {
	my ($tags) = @_;
	return "$tags->{created}_" . make_slug($tags->{title});
}

=item I<$post_contents> = C<build_post>(I<\@lines>, I<\%tags>, I<$name>)

Builds up the contents of a post file in the new format from the information
contained in the levissimo format.

=cut

sub build_post {
	my ($lines, $tags, $name) = @_;
	my $post = "<?php\n";

	# Build metadata structure.
	$post .= "\$post = array(\n";
	$post .= "\t'title' => '" . ($tags->{title} =~ s/'/\\'/gr) . "'\n";
	$post .= ");\n?>\n";

	# Build post contents.
	my $state = "";
	my $num_lines = scalar @{$lines};
	for (my $i = 0; $i < $num_lines; ++$i) {
		my $line = $lines->[$i];

		# Ignore meta tag lines.
		if ($line =~ /^<meta\s/) {
			next;
		}

		# Substitute image containers.
		if ($line =~ /^<p class="image-container">/) {
			if ($line =~ /alt="(?<alt>[^"]+)"\s+src="(?<src>[^"]+)"/g) {
				# Import image and build the PHP template.
				my $ifn = basename(import_image($name, $+{src}));
				$post .= "<?= blog_image(\"$ifn\", \"$+{alt}\") ?>\n";

				next;
			}

			print "$i: $line\n";
			croak "Failed to parse image container on post $tags->{title}";
		}

		# Substitute image albums.
		if ($line =~ /^<nav class="album">/) {
			$post .= "<?php blog_image_gallery(array(\n";

			# Process the album.
			my $first = 1;
			while ($line ne "</nav>") {
				# Parse the image and its caption.
				if ($line =~ /^\s*<img\s+src="(?<src>[^"]+)">/) {
					my $ifn = $+{src};
					if ($lines->[$i + 1] =~ /^\s*<figcaption>(?<caption>[^<]+)<\/figcaption>/) {
						# Import image and get the file location.
						$ifn = basename(import_image($name, $ifn));

						# Add the comma to the previous image structure.
						if (!$first) {
							$post .= ",\n";
						}

						# Build the PHP template.
						my $caption = $+{caption};
						$post .= "\tarray('loc' => \"$ifn\", 'alt' => " .
							"\"$caption\")";
						$first = 0;
					} else {
						print "$i: $line\n";
						croak "Image in album didn't have a caption set on " .
							"post $tags->{title}. Captions are required in " .
							"our website.";
					}
				}

				# Go to the next image in the album.
				$line = $lines->[++$i];
			}

			$post .= "\n)); ?>\n";
			next;
		}

		# Substitute code block beginnings.
		if ($line =~ /^<pre><code class=\"/) {
			if ($line =~ /^<pre><code class=\"language-(?<lang>[^"]+)"><script type="prism-html-markup">/) {
				# Special kind with HTML entities encoding script.
				$post .= "<?php compat_code_begin('$+{lang}'); ?>";
				$line = substr($line, length("<pre><code class=\"language-" .
					"$+{lang}\"><script type=\"prism-html-markup\">"));
				$post .= $line;
				$state = "prism-html-markup";

				# Handle cases where it's a single line code block.
				if ($line =~ /<\/code><\/pre>$/) {
					goto PARSE_CODE_BLOCK_END;
				} else {
					next;
				}
			} elsif ($line =~ /^<pre><code class=\"language-(?<lang>[^"]+)">/) {
				$post .= "<?php compat_code_begin('$+{lang}'); ?>";
				$line = substr($line,
					length("<pre><code class=\"language-$+{lang}\">"));
				$post .= $line;

				# Handle cases where it's a single line code block.
				if ($line =~ /<\/code><\/pre>$/) {
					goto PARSE_CODE_BLOCK_END;
				} else {
					next;
				}
			}

			print "$i: $line\n";
			croak "Failed to parse code blog beginning on post $tags->{title}";
		}

PARSE_CODE_BLOCK_END:
		# Substitute code block endings.
		if ($line =~ /<\/code><\/pre>$/) {
			if (($state eq "prism-html-markup") && ($line =~ /<\/script><\/code><\/pre>$/)) {
				$post .= substr($line, 0,
					rindex($line, "</script></code></pre>"));
				$post .= "<?php compat_code_end(); ?>\n";
				$state = "";

				next;
			} elsif ($line =~ /<\/code><\/pre>$/) {
				$post .= substr($line, 0, rindex($line, "</code></pre>"));
				$post .= "<?php compat_code_end(); ?>\n";

				next;
			}

			print "$i: $line\n";
			croak "Failed to parse code blog ending on post $tags->{title}";
		}

		# Remove any silly link properties and awful typographer quotes.
		$post =~ s/\s+target="_blank"//g;
		$post =~ s/&rsquo;/'/g;
		$post =~ s/&(l|r)dquo;/"/g;

		# Append line to the buffer.
		$post .= "$line\n";
	}

	# Append imported watermark.
	$post .= "<p style=\"font-size: 0.8em\">\n\tThis article was imported " .
		"from <a href=\"http://currentflow.net/\">my old blog\n\t</a>. Some " .
		"things may be broken.\n</p>\n";

	return $post;
}

=item C<process_post>(I<$path>)

Reads a levissimo post file and imports the post into our website.

=cut

sub process_post {
	my ($path) = @_;

	print "Importing " . basename($path) . "... ";

	# Read the post and parse meta tags.
	my @lines = read_lines($path);
	my %tags = parse_meta_tags(\@lines);

	# Build post file.
	my $name = build_name(\%tags);
	my $post_content = build_post(\@lines, \%tags, $name);

	# Write the post file.
	my $post_path = dirname(dirname(__FILE__)) . "/blog/$name.php";
	open(my $fh, '>:encoding(UTF-8)', $post_path);
	print $fh $post_content;
	close $fh;

	print "ok\n";
}

=back

=cut

# Script's main entry point.
sub main {
	# Get the levissimo root directory.
	if (scalar(@ARGV) == 0) {
		croak "Path to the levissimo directory must be passed as argument.";
	}
	$base_dir = $ARGV[0];

	# Get the list of post files.
	my @post_files = get_post_files("$base_dir/posts");
	foreach (@post_files) {
		process_post("$base_dir/posts/$_");
	}
}

# Call the script's main entry point.
main();
__END__

=head1 LICENSE

This project is licensed under the same license as the containing project. For
more information please read the C<LICENSE> file in the project's root folder.

=head1 AUTHOR

Nathan Campos <nathanpc@innoveworkshop.com>

=head1 COPYRIGHT

Copyright (c) 2024 Nathan Campos.

=cut
