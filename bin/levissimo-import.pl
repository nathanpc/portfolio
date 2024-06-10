#!/usr/bin/env perl

=head1 NAME

LevissimoImporter - Imports levissimo blog posts into our website

=head1 SYNOPSIS

Simply provide the path to the levissimo's blog root folder as a command-line
argument and this script will take care of importing everything into this
website.

=cut

use strict;
use warnings;
use autodie;

use Carp;
use Data::Dumper qw(Dumper);

=head1 METHODS

=over 4

=item C<get_post_files>(I<$post_dir>)

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

# Script's main entry point.
sub main {
	# Get the levissimo root directory.
	if (scalar(@ARGV) == 0) {
		croak "Path to the levissimo directory must be passed as argument.";
	}
	my $base_dir = $ARGV[0];

	# Get the list of post files.
	my @post_files = get_post_files("$base_dir/posts");
	print Dumper(\@post_files);
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
