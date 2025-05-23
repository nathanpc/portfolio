### Makefile
### Automates everything in the project.
###
### Author: Nathan Campos <nathan@innoveworkshop.com>

# Tools
RM     = rm -f
LN     = ln -s
MKDIR  = mkdir -p
CURL   = curl
DOCKER = docker

# Paths
BINDIR = ./bin
HTDOCS = ./htdocs

# Files
SOURCES = $(find $(HTDOCS) -type f -name '*.html')

.PHONY: all build docker blog sitemap

all: build

build: $(HTDOCS)/robots.txt blog sitemap

docker: build
	$(DOCKER) compose pull
	$(DOCKER) compose build
	$(DOCKER) compose up -d

blog: $(find $(HTDOCS)/blog/*/ -type f -name '*.php')
	$(BINDIR)/build-blog-index.pl

sitemap: blog
	find $(HTDOCS) -type f -name '*.php' -not -path './htdocs/errors/*' | \
		$(BINDIR)/build-sitemap.pl > $(HTDOCS)/sitemap.xml

$(HTDOCS)/robots.txt:
	$(CURL) -o "$(HTDOCS)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'
