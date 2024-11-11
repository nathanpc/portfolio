# My portfolio website

This is the source code of my portfolio website and showcases how little we need
in order to have a sustainable and accessible web presence.

## Setup

This website is built using [Fantastique](https://github.com/nathanpc/fantastique)
and is supposed to be built into a static form that can easily be hosted by any
web server imaginable, given this it requires a build step before it can be
deployed.

In order to build the website all that's needed is to run `make build`. This
will simply call the `bin/build.php` script, although it will also set up your
local environment with all composer requirements automatically.

After the website has been built it will be available inside the `public/`
directory, you can then host these files using any web server you wish, although
having a web server that can accept a `.htaccess` is recommended since it has
some definitions for nice things such as error pages, etc.

## License

This library is free software; you may redistribute and/or modify it under the
terms of the [Mozilla Public License 2.0](https://www.mozilla.org/en-US/MPL/2.0/).
