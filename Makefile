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
BINDIR   = ./bin
BUILDDIR = ./htdocs

.PHONY: all build

all: build

build: $(BUILDDIR)/robots.txt

$(BUILDDIR)/robots.txt:
	$(MKDIR) $(BUILDDIR)
	$(CURL) -o "$(BUILDDIR)/robots.txt" 'https://raw.githubusercontent.com/ai-robots-txt/ai.robots.txt/refs/heads/main/robots.txt'
