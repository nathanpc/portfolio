FROM alpine:3 AS build

# Install packages.
RUN apk update && apk add \
	make \
	php83 \
	curl \
	sed \
	php83-apache2 \
	php83-mbstring \
	&& rm -rf /var/cache/apk/*

# Setup Virtual Host.
RUN sed -zie 's|\(<Directory "/var/www/localhost/htdocs">\)\(.*\)\(</Directory>\)|\1\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n\3|g' /etc/apache2/httpd.conf && \
	sed -ie 's|/var/www/localhost/htdocs|/var/www/app/htdocs|g' /etc/apache2/httpd.conf && \
	sed -ie 's|#\(LoadModule rewrite_module modules/mod_rewrite.so\)|\1|g' /etc/apache2/httpd.conf

# Download and setup browscap.ini
RUN curl 'http://browscap.org/stream?q=Full_PHP_BrowsCapINI' -o /etc/php83/browscap.ini && \
	sed -ie 's|;browscap = extra/browscap.ini|browscap = /etc/php83/browscap.ini|g' /etc/php83/php.ini

# Setup PHP for development.
#RUN sed -ie 's/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/error_reporting = E_ALL/g' /etc/php83/php.ini && \
#	sed -ie 's/display_errors = Off/display_errors = On/g' /etc/php83/php.ini && \
#	sed -ie 's/display_startup_errors = Off/display_startup_errors = On/g' /etc/php83/php.ini && \
#	sed -ie 's/;html_errors = On/html_errors = On/g' /etc/php83/php.ini

WORKDIR /var/www/app

# Copy over everything we need to run the web site.
COPY bin/ ./bin
COPY gopher/ ./gopher
COPY templates/ ./templates
COPY blog/ ./blog
COPY src/ ./src
COPY htdocs/ ./htdocs

EXPOSE 80

ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]
