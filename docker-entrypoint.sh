#!/bin/sh

make blog-cache
if [[ $? -ne 0 ]]; then
    exit 1
fi

/usr/sbin/httpd -D FOREGROUND
