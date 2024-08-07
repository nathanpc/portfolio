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

.PHONY: run setup pull deploy blog-cache

all: run

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

blog-cache:
	$(PHP) $(BINDIR)/build-blog-index.php

$(COMPOSER):
	$(PHP) -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	$(PHP) composer-setup.php --install-dir=$(BINDIR)
	$(RM) composer-setup.php
