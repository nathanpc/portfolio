# My portfolio website

This is the source code of my portfolio website and showcases how little we need
in order to have a sustainable and accessible web presence.

## Setup

Since this is a classic PHP project you basically just have to `git clone` into
the right folder and you're good to go, although you must first ensure you have
a couple of things set up beforehand, since this website assumes it resides at
the root of your web server.

The first thing that you need to do is configure your web server to enable
`mod_rewrite` and allow `.htaccess` overrides, so that we can rewrite URLs into
prettier ones and prevent access to sensitive files and directories. You can
learn how to enable this functionality from the following tutorial:
[How to Set Up the htaccess File on Apache](https://www.linode.com/docs/guides/how-to-set-up-htaccess-on-apache/).

The next step is to ensure that the `DocumentRoot` property of your site
configuration points to the `public/` directory of project. You can learn how to
set this up from the following tutorial:
[How To Set Up Apache Virtual Hosts](https://www.digitalocean.com/community/tutorial_collections/how-to-set-up-apache-virtual-hosts).
For completeness, here's an example of how your virtual host configuration
might look like:

```apacheconf
<VirtualHost *:80>
    ServerAdmin hi@nathancampos.me
    ServerName nathancampos.me
    DocumentRoot /var/www/portfolio/public
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

<Directory /var/www/portfolio/public>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Now you should be almost ready to put it into production, all that's left is to
ensure that you have a `browscap.ini` file in your system configured so that our
compatibility layer for old browsers works.

### browscap.ini

Our website is built with the idea that the web these days is an absolute pile
of shit, with bloated websites, intrusive ads, and a privacy nightmare. When we
set out to build this website we've thought of making it properly accessible by
anyone and ensure that it's not bloated, this can be easily achieved if we
target old browsers, since their limitations will play to our ideals.

In order to ensure that we can support most of the browsers out there a
compatibility layer had to be developed, and it relies heavily on PHP's
[`get_browser()`](https://www.php.net/manual/en/function.get-browser.php)
function, which in turn requires a proper `browscap.ini` file to exist in its
configuration.

You can fetch an up-to-date `browscap.ini` file specifically for PHP from the
amazing [**browscap.org**](http://browscap.org) website:

```bash
curl 'http://browscap.org/stream?q=Full_PHP_BrowsCapINI' -o
/etc/php/browscap.ini
```

Now simply edit your `php.ini` configuration to uncomment the `browscap`
environment variable, set it to the location of the file and you should be up
and running after restarting the web server.

## License

This library is free software; you may redistribute and/or modify it under the
terms of the [Mozilla Public License 2.0](https://www.mozilla.org/en-US/MPL/2.0/).
