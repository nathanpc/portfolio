### Makefile
### Automates everything in the project.
###
### Author: Nathan Campos <nathan@innoveworkshop.com>

# Tools
RM    = rm -f
LN    = ln -s
MKDIR = mkdir -p
CURL  = curl

# Paths
BINDIR = ./bin
HTDOCS = ./htdocs

# Files
SOURCES = $(find $(HTDOCS) -type f -name '*.html')

.PHONY: all build

all: build

build: $(HTDOCS)/robots.txt

$(HTDOCS)/robots.txt:
	$(MKDIR) $(HTDOCS)
	$(CURL) -o "$(HTDOCS)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'
