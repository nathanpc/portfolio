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
	&& rm -rf /var/cache/apk/*

# Setup Virtual Host.
RUN sed -zie 's|\(<Directory "/var/www/localhost/htdocs">\)\(.*\)\(</Directory>\)|\1\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n\3|g' /etc/apache2/httpd.conf

WORKDIR /app

# Copy over everything.
COPY bin/ ./bin
COPY src/ ./src
COPY site/ ./site
COPY blog/ ./blog
COPY static/ ./static
COPY templates/ ./templates
COPY composer.json ./
COPY composer.lock ./
COPY Makefile ./

# Download the robots.txt to block AI bots.
RUN curl 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt' \
    -o '/app/static/robots.txt'

# Build the static website.
RUN make setup
RUN make build

FROM alpine:3 AS deploy

RUN apk update && apk add apache2 \
	&& rm -rf /var/cache/apk/*

# Copy updated Apache configuration.
COPY --from=build /etc/apache2/httpd.conf /etc/apache2/httpd.conf

# Copy static website contents.
COPY --from=build /app/public/ /var/www/localhost/htdocs

EXPOSE 80

ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]
