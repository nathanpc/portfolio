#!/usr/bin/env perl

## build-blog-index.pl
## Builds the blog index page.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;
use autodie;

use File::Basename;

# Open file for writing.
my $blog_folder = dirname(dirname(__FILE__)) . '/htdocs/blog';
my $index_fn = $blog_folder . '/index.php';
open(my $index_fh, '>', $index_fn);
print "Writing blog index to $index_fn\n";

# Print header part of the file.
print $index_fh <<"HEADER";
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Nathan's random musings</title>
	<meta name="description" content="Nathan's personal blog. Where you can follow his adventures in the world of technology.">
</head>
<body>
	<?php include_template('header'); ?>

HEADER

# Get list of entries in blog directory.
opendir(my $blog_dir, $blog_folder);
my @entries = reverse(sort(readdir($blog_dir)));
closedir($blog_dir);
my $last_year = '';
foreach (@entries) {
	# Filter only directories.
	my $dir = $blog_folder . '/' . $_;
	if (-d $dir) {
		# Ignore dot folders.
		if (m/^\./) {
			next;
		}

		# Get parts.
		if (m/^(?<year>[0-9]{4})-(?<month>[0-9]{2})-(?<day>[0-9]{2})_(?<slug>.+)/i) {
			my $date = $+{year} . '-' . $+{month} . '-' . $+{day};
			my $slug = $+{slug};

			# Print year section if needed.
			if ($+{year} ne $last_year) {
				$last_year = $+{year};
				print $index_fh "\n\t<h3 class=\"post-year\">" . $last_year .
					"</h3>\n\n";
			}

			# Get post title.
			my $title = $slug;
			open(my $fh, '<', $dir . '/index.php');
			while (my $line = <$fh>) {
				chomp $line;
				if ($line =~ m/^\s*<title>(?<title>.+)<\/title>$/i) {
					$title = $+{title};
					last;
				}
			}
			close($fh);

			# Print post entry.
			print "Adding $date - $title... ";
			print $index_fh <<"POST";
	<div class="post-listing">
		<span class="published-date">$date</span>
		<a class="title" href="<?= blog_href('$date', '$slug') ?>">
			$title
		</a>
	</div>
POST
			print "ok\n";
		}
	}
}

# Print page footer.
print $index_fh <<FOOTER;

	<?php include_template('footer'); ?>
</body>
</html>
FOOTER

# Close file handle and exit.
close($index_fh);
print "Done!\n";
