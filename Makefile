### Makefile
### Automates everything in the project.
###
### Author: Nathan Campos <nathan@innoveworkshop.com>

# Tools
RM       = rm -f
MKDIR    = mkdir -p
GIT      = git
PHP      = php
COMPOSER = ./bin/composer.phar
DOCKER   = docker

# Paths
BINDIR = ./bin

.PHONY: build run setup pull deploy blog-cache

all: run

build: setup
	$(PHP) ./bin/build.php

run:
	$(DOCKER) compose build
	$(DOCKER) compose up

setup: $(COMPOSER)
	$(COMPOSER) install

pull:
	$(GIT) pull

deploy: pull
	$(DOCKER) compose build
	$(DOCKER) compose up -d

$(COMPOSER):
	$(PHP) -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	$(PHP) composer-setup.php --install-dir=$(BINDIR)
	$(RM) composer-setup.php
