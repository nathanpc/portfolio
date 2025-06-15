#!/usr/bin/env perl

## render-md.pl
## Renders Extended Markdown (my own version of it) into multiple formats.
##
## Author: Nathan Campos <nathan@innoveworkshop.com>

use strict;
use warnings;
use autodie;
use Data::Dumper;

# Global variables.
our @stack = ();
our $title = '';
our $format = 'html';

# Tags hash.
our %tags = (
	'html' => {
		'paragraph' => {
			'open' => "\n<p>",
			'close' => "</p>\n"
		},
		'bold' => {
			'open' => "<b>",
			'close' => "</b>"
		},
		'italic' => {
			'open' => "<i>",
			'close' => "</i>"
		},
		'code' => {
			'open' => "<code>",
			'close' => "</code>"
		},
		'url_begin' => {
			'open' => "<a href=\"",
			'close' => "\">"
		},
		'url_end' => {
			'open' => "",
			'close' => "</a>"
		},
	}
);

# Opens a tag.
sub open_tag {
	my ($tag) = @_;
	push @stack, $tag;
	return $tags{$format}{$tag}->{'open'};
}

# Closes a tag.
sub close_tag {
	my ($tag) = @_;
	$tag = pop @stack if not defined $tag;
	return $tags{$format}{$tag}->{'close'};
}

# Gets the tag we are currently inside of.
sub current_tag {
	my $idx = index($stack[-1], "\t");
	if ($idx == -1) {
		return $stack[-1];
	}
	return substr($stack[-1], 0, $idx);
}

# Opens or closes a tag automatically.
sub auto_tag {
	my ($tag) = @_;

	if (current_tag() eq $tag) {
		return close_tag();
	} else {
		return open_tag(@_);
	}
}

# Get title and jump obligatory title line break.
$title = substr(<STDIN>, 2);
chomp $title;
scalar <STDIN>;

# Read paragraphs from STDIN.
my $prev_line = '';
my $section = '';
while (my $line = <STDIN>) {
	chomp $line;
	my $tag = undef;

	# Handle the end of paragraphs.
	if ($line eq '') {
		# Ignore multiple empty lines.
		next if ($prev_line eq '');

		# Close all tags since we have finished the paragraph.
		do {
			$tag = pop @stack;
			$section .= close_tag($tag);
		} while ($tag ne 'paragraph');

		# Print entire section.
		print "$section\n";
		$section = '';

		goto next_line;
	} else {
		# Continuation from a previous line in the section.
		$section .= ' ';
	}

	# Handle paragraph beginning.
	if ($prev_line eq '' and $line =~ m/^[A-Za-z0-9"']/) {
		$section .= open_tag('paragraph');
	}

	# Handle various tags that can overflow to the next line.
	foreach my $char (split '', $line) {
		# Ignore everything if we are inside a code section.
		if ((current_tag() eq 'code' and $char ne '`') or
			(current_tag() eq 'url_begin' and $char ne '|')) {
			$section .= $char;
			next;
		}

		# Handle inside of links.
		if (current_tag() eq 'url_begin' and $char eq '|') {
			$section .= close_tag();
			$section .= open_tag('url_end');
			next;
		}

		# Handle special (tags) characters.
		if    ($char eq '*') { $section .= auto_tag('bold'); }
		#elsif ($char eq '/') { $section .= auto_tag('italic'); }
		elsif ($char eq '`') { $section .= auto_tag('code'); }
		elsif ($char eq '[') { $section .= auto_tag('url_begin'); }
		elsif ($char eq ']') { $section .= auto_tag('url_end'); }
		else                 { $section .= $char; }
	}

next_line:
	# Store line for later.
	$prev_line = $line;
}

# Close all remaining tags.
while (scalar @stack > 0) {
	$section .= close_tag();
}
print "$section\n";
