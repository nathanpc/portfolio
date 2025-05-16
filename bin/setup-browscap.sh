#!/bin/sh

## setup-browscap.sh
## Sets up PHP to support browser capabilities using a browscap.ini file.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

# Get the PHP directory.
if [ $# == 0 ]; then
	echo "usage: $0 phpdir"
	echo ""
	echo "    phpdir    Directory where your php.ini file is located."
	exit 5
fi
phpdir="$1"

# Ensure the PHP extra directory exists.
echo "Ensuring we have the extra directory as $phpdir/extra..."
mkdir -p "$phpdir/extra"
if [ $? != 0 ]; then
	echo "Failed to create PHP extra directory."
	exit 1
fi

# Download the browscap.ini file.
echo "Downloading the browscap.ini file to $phpdir/extra/browscap.ini..."
curl 'http://browscap.org/stream?q=Full_PHP_BrowsCapINI' \
	-o "$phpdir/extra/browscap.ini"
if [ $? != 0 ]; then
	echo "Failed to download browscap.ini file."
	exit 2
fi

# Enable browscap in PHP.
echo "Enabling the browscap file in $phpdir/php.ini..."
sed -ie "s|;browscap = extra/browscap.ini|browscap = $phpdir/extra/browscap.ini|g" \
	"$phpdir/php.ini"

# Reload Apache.
echo "Restarting the Apache server..."
apachectl -k restart

echo "Done."
