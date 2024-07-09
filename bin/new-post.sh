#!/bin/bash

## new-post.sh
## Creates a new blog post for editing.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

# Ensure we have the slug.
if [ $# -eq 0 ]; then
	echo "usage: $0 slug"
	exit 1
fi

# Variables
dt=`date -j "+%Y-%m-%d"`
slug=$1
fname="blog/${dt}_$slug.php"

# Create the stub of the post.
touch "$fname"
printf "<?php\n\$post = array(\n\t'title' => '$slug'\n);\n?>\n\n<p></p>\n" >> \
	"$fname"
"${EDITOR:-vim}" "$fname"
