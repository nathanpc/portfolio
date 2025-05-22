#!/usr/bin/env perl

## fix-blog-template.pl
## Converts old blog posts to use the new template.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;

my $after_header = 0;
my $title = '';
my $pubdate = $ARGV[0];

while (my $line = <STDIN>) {
	chomp $line;

	if (!$after_header) {
		# Jump over the PHP header and get the title.
		if ($line =~ m/'title' => '(.+)'/) {
			$title = $1;
			$title =~ s/\\//g;
		} elsif ($line =~ m/\?>/) {
			$after_header = 1;

			# Print top part of the HTML file.
			print <<"HEADER";
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>$title</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>$title</h2>
		<div id="published-date">$pubdate</div>
	</div>
HEADER
		}

		next;
	}

	print "$line\n";
}

# Print page footer.
print <<FOOTER;
	</div>

	<?php include_template('footer'); ?>
</body>
</html>

FOOTER
