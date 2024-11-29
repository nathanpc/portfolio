### Makefile
### Automates everything in the project.
###
### Author: Nathan Campos <nathan@innoveworkshop.com>

# Tools
RM       = rm -f
MKDIR    = mkdir -p
GIT      = git
PHP      = php
CURL     = curl
COMPOSER = ./bin/composer.phar
DOCKER   = docker

# Paths
BINDIR   = ./bin
BUILDDIR = ./public

.PHONY: build run setup pull deploy blog-cache

all: run

build: $(BUILDDIR)/robots.txt setup
	$(PHP) $(BINDIR)/build.php

run:
	$(DOCKER) compose build
	$(DOCKER) compose up

setup: $(COMPOSER)
	$(COMPOSER) install
	$(MKDIR) $(BUILDDIR)

pull:
	$(GIT) pull

deploy: pull
	$(DOCKER) compose build
	$(DOCKER) compose up -d

$(BUILDDIR)/robots.txt:
	$(CURL) -o "$(BUILDDIR)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'

$(COMPOSER):
	$(PHP) -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	$(PHP) composer-setup.php --install-dir=$(BINDIR)
	$(RM) composer-setup.php
