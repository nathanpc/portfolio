FROM alpine:3 AS build

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
    php83-dom \
	&& rm -rf /var/cache/apk/*

# Setup Virtual Host.
RUN sed -zie 's|\(<Directory "/var/www/localhost/htdocs">\)\(.*\)\(</Directory>\)|\1\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n\3|g' /etc/apache2/httpd.conf

WORKDIR /app

# Copy over things needed to setup the website.
COPY composer.json ./
COPY composer.lock ./
COPY Makefile ./
COPY bin/ ./bin
COPY src/ ./src
COPY templates/ ./templates

# Setup the website.
RUN make setup

# Copy over everything that makes the website itself.
COPY static/ ./static
COPY site/ ./site
COPY blog/ ./blog

# Build the static website.
RUN make build

FROM alpine:3 AS deploy

RUN apk update && apk add apache2 \
	&& rm -rf /var/cache/apk/*

WORKDIR /var/www/localhost/htdocs

# Copy updated Apache configuration.
COPY --from=build /etc/apache2/httpd.conf /etc/apache2/httpd.conf

# Copy static website contents.
COPY --from=build /app/public/ /var/www/localhost/htdocs

EXPOSE 80

ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]
