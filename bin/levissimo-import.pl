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
use File::Spec;

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

	return $slug;
}

=item I<$fname> = C<build_name>(I<\%tags>)

Builds up a compliant filename for the post.

=cut

sub build_name {
	my ($tags) = @_;
	return "$tags->{created}_" . make_slug($tags->{title});
}

=item I<$post_contents> = C<build_post>(I<\@lines>, I<\%tags>)

Builds up the contents of a post file in the new format from the information
contained in the levissimo format.

=cut

sub build_post {
	my ($lines, $tags) = @_;
	my $post = "<?php\n";

	# Build metadata structure.
	$post .= "\$post = array(\n";
	$post .= "\t'title' => '" . ($tags->{title} =~ s/'/\\'/gr) . "'\n";
	$post .= ");\n?>\n";

	# Build post contents.
	foreach (@{$lines}) {
		# Ignore meta tag lines.
		if ($_ =~ /^<meta\s/) {
			next;
		}

		# Append line to buffer without modification.
		$post .= "$_\n";
	}

	return $post;
}

# Script's main entry point.
sub main {
	# Get the levissimo root directory.
	if (scalar(@ARGV) == 0) {
		croak "Path to the levissimo directory must be passed as argument.";
	}
	my $base_dir = $ARGV[0];

	# Get the list of post files.
	my @post_files = get_post_files("$base_dir/posts");
	foreach (@post_files) {
		# Read the post and parse meta tags.
		my @lines = read_lines("$base_dir/posts/$_");
		my %tags = parse_meta_tags(\@lines);

		# Build post file.
		my $post_content = build_post(\@lines, \%tags);
		print build_name(\%tags) . "\n";
		print Dumper($post_content);
		return;
	}
}

=back

=cut

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
