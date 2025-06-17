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
our %links = (count => 0, hrefs => []);
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
		'url' => {
			'open' => "",
			'close' => "<a href=\"%href%\">%label%</a>"
		},
	}
);

# Opens a tag.
sub open_tag {
	my ($tag) = @_;
	push @stack, $tag;

	# Handle special case for links.
	if ($tag eq 'url') {
		$links{'count'}++;
		push @{$links{'hrefs'}}, '';
		return '';
	}

	return $tags{$format}{$tag}->{'open'};
}

# Closes a tag.
sub close_tag {
	my ($tag) = @_;
	$tag = pop @stack if not defined $tag;

	# Handle special case for links.
	if ($tag eq 'url') {
		my ($url, $label) = split(/\|/, shift @{$links{'hrefs'}});
		$label = handle_tags($label);

		# Fix special URLs.
		if ($url =~ m/^blog:/) {
			$url =~ s/^blog://;
			my ($date, $slug) = split /_/, $url;
			$url = "<?= blog_href('$date', '$slug') ?>";

		}

		# Build URL tag.
		my $ret = $tags{$format}{'url'}->{'close'};
		$ret =~ s/%href%/$url/ge;
		$ret =~ s/%label%/$label/ge;

		return $ret;
	}

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

# Parses tags that are found in lines that can overflow.
sub handle_tags {
	my ($line) = @_;
	my $output = '';

	foreach my $char (split '', $line) {
		# Ignore everything if we are inside a code section.
		if (current_tag() eq 'code' and $char ne '`') {
			$output .= $char;
			next;
		}

		# Handle inside of link definitions.
		if (current_tag() eq 'url' and $char ne ']') {
			$links{'hrefs'}[-1] .= $char;
			next;
		}

		# Handle special (tags) characters.
		if    ($char eq '*') { $output .= auto_tag('bold'); }
		elsif ($char eq '/') { $output .= auto_tag('italic'); }
		elsif ($char eq '`') { $output .= auto_tag('code'); }
		elsif ($char eq '[') { $output .= auto_tag('url'); }
		elsif ($char eq ']') { $output .= auto_tag('url'); }
		else                 { $output .= $char; }
	}

	return $output;
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
	$section .= handle_tags($line);

next_line:
	# Store line for later.
	$prev_line = $line;
}

# Close all remaining tags.
while (scalar @stack > 0) {
	$section .= close_tag();
}
print "$section\n";
