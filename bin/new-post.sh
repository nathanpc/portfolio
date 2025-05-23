#!/bin/sh

## new-post.sh
## Creates a new blog post for editing.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

# Ensure we have the slug.
if [ $# -ne 2 ]; then
	echo "usage: $0 slug title"
	exit 1
fi

# Variables
dt=`date "+%Y-%m-%d"`
slug=$1
title=$2
dn="htdocs/blog/${dt}_$slug"
fname="$dn/index.php"

# Create the post directory.
mkdir "$dn"
if [ $? -ne 0 ]; then
	echo "Failed to create post directory"
	exit 1
fi

# Create the post file template.
tee "$fname" <<EOF
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
		<div id="published-date">$dt</div>
	</div>

	<p>
		%content%
	</p>

	<?php include_template('footer'); ?>
</body>
</html>
EOF

# Open an editor to edit the post.
"${EDITOR:-vim}" "$fname"
