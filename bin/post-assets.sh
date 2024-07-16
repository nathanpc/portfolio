#!/bin/bash

## post-assets.sh
## Gets a blog post's assets folder. It'll create the folder if one doesn't yet
## exist.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

# Ensure we have the post's filename.
if [ $# -lt 1 ]; then
	echo "usage: $0 postfile"
	exit 1
fi

# Variables
dt_slug=`basename "$1" .php`
folder="public/assets/blog/${dt_slug}"

# Create the assets directory if needed.
if [ ! -d "$folder" ]; then
	mkdir "$folder"
fi

# Return the assets directory for piping into another command.
echo "$folder"
