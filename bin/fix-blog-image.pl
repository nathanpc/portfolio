#!/usr/bin/env perl

## fix-blog-image.pl
## Fixes all instances of $this->image* in blog posts.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;

while (my $line = <>) {
	chomp $line;

	if ($line =~ m/^(.*<\?= )\$this\->image\((["'])(.+)/g) {
		# Regular image.
		print $1 . 'compat_image(' . $2 . './' . $3;
	} elsif ($line =~ m/^(.*)\$this\->image_gallery\((.+)/g) {
		# Image gallery.
		print $1 . 'compat_image_gallery(' . $2;
	} elsif ($line =~ m/^(.*)["']loc["']\s=>\s(['"])(.+)/g) {
		# Image gallery image location.
		print $1 . "'loc' => " . $2 . './' . $3;
	} elsif ($line =~ m/^(.*)\$this\->asset\((['"])(.+)/g) {
		# Asset link.
		print $1 . 'compat_image(' . $2 . './' . $3;
	} else {
		# Regular line.
		print $line;
	}

	print "\n";
}
