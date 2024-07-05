FROM alpine:3

RUN apk update && apk add \
	make \
    php83 \
    composer \
    curl \
    sed \
	php83-apache2 \
	php83-mbstring \
    php83-openssl \
    php83-curl \
	&& rm -rf /var/cache/apk/*

# Setup Virtual Host.
RUN sed -zie 's|\(<Directory "/var/www/localhost/htdocs">\)\(.*\)\(</Directory>\)|\1\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n\3|g' /etc/apache2/httpd.conf && \
	sed -ie 's|/var/www/localhost/htdocs|/var/www/app/public|g' /etc/apache2/httpd.conf && \
	sed -ie 's|#\(LoadModule rewrite_module modules/mod_rewrite.so\)|\1|g' /etc/apache2/httpd.conf

# Download and setup browscap.ini
RUN curl 'http://browscap.org/stream?q=Full_PHP_BrowsCapINI' -o \
	/etc/php83/browscap.ini
RUN sed -ie 's|;browscap = extra/browscap.ini|browscap = /etc/php83/browscap.ini|g' \
	/etc/php83/php.ini

WORKDIR /var/www/app

# Composer
COPY composer.* ./
RUN composer install

# Our source files.
COPY bin/ ./bin
COPY src/ ./src
COPY templates/ ./templates
COPY Makefile ./
COPY docker-entrypoint.sh ./

EXPOSE 80

ENTRYPOINT ["/var/www/app/docker-entrypoint.sh"]
