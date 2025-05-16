<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>PickLE</title>
	<meta name="description" content="An electronic component pick list application and file parser library.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>PickLE</h2>

		<p>
			An application and a parsing library to create an electronic
			component pick list file format designed to be human-readable and
			completely usable in its own plain-text form. You can think of it as
			<a href="https://daringfireball.net/projects/markdown/syntax">Markdown</a>
			for your project's pick lists.
		</p>

		<p>
			The name of the project is supposed to be a fun little combination
			of the words in the phrase <b>Pick</b> <b>L</b>ist for
			<b>E</b>lectronics.
		</p>

		<p>
			This project was conceived out of a need to create pick lists for my
			company when we were building/assembling projects for customers,
			allowing us to quickly create definition files that compiled all the
			necessary information about a project's prototype or production run.
		</p>

		<p>
			The first, and <a href="https://github.com/nathanpc/pickle">original
			library and reference implementation</a>, was developed in Perl, as
			this allowed us to quickly develop the parser for the file, since
			it's easily parseable with regular expressions, although
			<a href="#ports">ports have been made</a> for many other languages
			due to some of our internal requirements and projects.
		</p>
	</div>

	<div id="ports" class="section">
		<h3>ports</h3>

		<p>
			Although the <a href="https://github.com/nathanpc/pickle">original
			library and reference implementation</a> was written in Perl, many
			ports of the library, and some applications, were also developed:
		</p>

		<ul>
			<li><a href="https://github.com/nathanpc/pickle-web">Web application (PHP)</a></li>
			<li><a href="https://github.com/nathanpc/PickLE.NET">.NET Framework 2.0</a></li>
			<li><a href="https://github.com/nathanpc/jPickLE">Java</a></li>
			<li><a href="https://github.com/nathanpc/libpickle">ISO C89</a></li>
		</ul>
	</div>

	<div class="section">
		<h3>screenshots</h3>

		<p>
			Since only the <a href="https://github.com/nathanpc/pickle-web">PHP
			web application</a> is available publicly, here's how that specific
			application looks like with an example document loaded:
		</p>

		<?= compat_image_gallery(array(
			array('loc' => "./screenshots/bootstrap-archive.png",
				'alt' => "List of pick lists page with the Bootstrap theme"),
			array('loc' => "./screenshots/bootstrap-pick.png", 'alt' => "Pick list page with the Bootstrap theme"),
			array('loc' => "./screenshots/bootstrap-upload.png", 'alt' => "Upload page with the Bootstrap theme"),
			array('loc' => "./screenshots/bootstrap-spec.png", 'alt' => "File specification page with the Bootstrap theme"),
			array('loc' => "./screenshots/goldenera-archive.png", 'alt' => "List of pick lists page with the Golden Era theme"),
			array('loc' => "./screenshots/goldenera-pick.png", 'alt' => "Pick list page with the Golden Era theme"),
			array('loc' => "./screenshots/goldenera-upload.png", 'alt' => "Upload page with the Golden Era theme"),
			array('loc' => "./screenshots/nineties-archive.png", 'alt' => "List of pick lists page with the Nineties theme"),
			array('loc' => "./screenshots/nineties-pick.png", 'alt' => "Pick list page with the Nineties theme")
		)); ?>

		<p>
			Because the web application was built to support all kinds of
			devices, a nice theming engine was built from scratch to skin the
			application to the user's taste, but also to support extremely old
			and outdated browsers, when we (only me to be fair) were feeling
			like using a retro computer for work.
		</p>
	</div>

	<div class="section">
		<h3>examples</h3>

		<p>
			Examples of usage of the libraries can be found in the their
			respective repositories, since each language is different, but most
			importantly is to show how a PickLE document is easily readable and
			can even store the state of the pick list itself:
		</p>

		<?php compat_code_begin(); ?>Name: Example Project
Revision: A
Description: A very simple pick list example.
Website: https://example.com/pickle
Source-Control: https://github.com/pickle/example/
License: CC BY-NC-SA 4.0

---

Ceramic Capacitor:
[ ]	6	C0805	(0.1u)	"100nF Ceramic Capacitor"	[C0805]
C1 C2 C3 C5 C6 C7

[X]	1	C0805	(1u)	"1uF Ceramic Capacitor"	[C0805]
C4

Resistor:
[ ]	1	R1206	(1)	"1 Ohm Current Sense Resistor"	[R1206]
R1

[ ]	12	R0805	(1k)	"1k Ohm Resistor"	[R0805]
R2 R4 R7 R9 R14 R15 R19 R23 R30 R31 R32 R33

Integrated Circuit:
[X]	2	74HC595D	"8-bit Shift Register"	[SO16]
IC1 IC2

[ ]	2	LM258ADR	"Generic Operational Amplifier"	[SO08]
U1 U2

[ ]	1	PIC16F18325-I/SL	"Microchip PIC 8-bit Microcontroller"	[SO14]
U3

Connector:
[ ]	1	USB-MICRO-10118194-0001LF	"Micro USB Connector"	[AMPHENOL_10118194-0001LF]
USB1

[X]	1	PIC-ICSP-JST-XH	"PIC In-Circuit Serial Programming Header"	[B5B-XH-A]
ICSP1

[X]	1	KEYSTONE-590-9V	"Keystone 590 - Arranged for a 9V (PP3) Battery"	[KEYSTONE-590-9V]
BATT1<?php compat_code_end(); ?>
	</div>

	<div class="section">
		<h3>file specification</h3>

		<p>
			This file specification section has been lifted straight from the
			<a href="https://github.com/nathanpc/pickle-web/blob/master/themes/_common/about_text.html">web
			application's about page</a>:
		</p>

<!-- BEGIN file specification -->
<p>
	In order for us to start writing our own pick list documents let's learn in
	great detail every technical aspect of the file specification bit-by-bit. In
	order to better understand the specification details described in this section,
	it's advised to consult the example document above.
</p>

<h4>File Extension</h4>

<p>
	The <code>.pkl</code> extension should be used for all PickLE picks list
	documents without exceptions. It's an unique extension, will work even on
	extremely old systems that have a 3 character limit on extensions, and when
	read out loud spells out "pickle".
</p>

<h4>Document Layout</h4>

<p>
	Every single pick list document <strong>must</strong> contain two sections:
	The <mark>header</mark> and the <mark>list</mark>. These sections are separated
	by a line containing only <code>---</code>.
</p>

<h4>Header Section</h4>

<p>
	Every document <strong>must</strong> begin with a header section that
	describes the pick list and provides extra metadata for both, the user, and
	for parsers/frontends that are going through a specific file.
</p>

<p>
	Each property inside the header section <strong>must</strong> be in its own
	line and multi-line properties are <strong>not</strong> supported. You can
	have empty lines separating properties.
</p>

<p>
	Each property <strong>must</strong> be specified in a style very similar to
	<a href="https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html">HTTP headers</a>
	with a <mark>name</mark> that <strong>should</strong> have its initials
	capitalized and words must be separated by dashes. Whitespace should
	never be used for property names and the only allowed characters in this
	field are alphanumerics and the word separation dash.
	<br>
	<em>Examples: <code>Name</code>, <code>Sample-Name</code>, <code>Website-2</code></em>
</p>

<p>
	After the property name, without any whitespace, a colon <strong>must</strong>
	be placed, followed by a space, and the <mark>value</mark> of the property,
	which can contain any type of character, but must all be contained in a
	single line.
</p>

<p>
	Some properties declared in the header section are special and will be used
	by parsers to display relevant data related to the document itself, but this
	section is also an area that the user can use to store any sort of metadata
	that is deemed necessary, so as long as the name used for a property doesn't
	clash with one of these special cases, they can be used without restrictions.
	Here's a list of the special properties used by PickLE parsers:
</p>

<dl class="row">
	<dt class="col-sm-2">Name <span class="badge badge-danger">Required</span></dt>
	<dd class="col-sm-9">The name of the project/product tha this pick list belongs to.
	</dd>

	<dt class="col-sm-2">Revision <span class="badge badge-danger">Required</span></dt>
	<dd class="col-sm-9">Board revision.</dd>

	<dt class="col-sm-2">Description <span class="badge badge-danger">Required</span></dt>
	<dd class="col-sm-9">A brief description of the project/product.</dd>

	<dt class="col-sm-2">Website</dt>
	<dd class="col-sm-9">Link to the project's website.</dd>

	<dt class="col-sm-2">Source-Control</dt>
	<dd class="col-sm-9">Link to the project's source control repository.</dd>

	<dt class="col-sm-2">License</dt>
	<dd class="col-sm-9">
		Project's license in the <a href="https://spdx.org/licenses/">SPDX License
			Identifier</a> format.
	</dd>
</dl>

<h4>Pick List Section</h4>

<p>
	After all of the properties are defined in the header section, the following
	section will define the pick list itself. This pick list section is organized
	in a very particular way: You <strong>must</strong> always define a
	<mark>category</mark>, followed by one or more pick list <mark>items</mark>.
</p>

<p>
	All items described in this section can be separated by zero or more empty
	lines, and you <strong>cannot</strong> have empty categories or start the
	pick list section with an item.
</p>

<h5>Category Definition</h5>

<p>
	A category definition is simply a line that only contains a title label
	followed by a colon. The title label can contain any sort of character, with
	the exception of colons, and <strong>must</strong> be properly capitalized,
	since it'll be used by frontends as headers for each collection of items.
</p>

<h5>Pick List Item</h5>

<p>
	A pick list item is <strong>always</strong> defined in two consecutive lines.
	The first line describes the item and the second is a list of the reference
	designators to locate this item on a board.
</p>

<p>
	The item description has a very simple and intuitive format and every field
	contained in it <strong>must</strong> be separated by one or more whitespace
	characters, although tabs are recommended, and the order of the fields
	<strong>must</strong> be followed.
</p>

<p>
	The description line <strong>must</strong> start with the <mark>picked checkbox</mark>
	represented by a pair of square brackets that <strong>must</strong> either
	contain a <mark>space</mark> to indicate the component has not been picked or
	any other single character to indicate tha the component has been picked, but
	as a norm the picked state should be represented by a capital <code>X</code>.
	<br>
	<em>Examples: <code>[ ]</code>, <code>[X]</code></em>
</p>

<p>
	Following the picked checkbox a <mark>quantity</mark> <strong>must</strong>
	be supplied in the form of an integer number that <strong>must</strong> match
	the number of reference designators given in the following line. This quantity
	field <strong>must</strong> be ignored by all parsers, since they should use
	the quantity of reference designators, and it's only used as a human reference.
	<br>
	<em>
		Examples: <code>1</code>, <code>12</code>, <code>123</code>, <code>5000</code>
	</em>
</p>

<p>
	Next up a <mark>manufacturer part number</mark> must be defined. This should
	be typed without any enclosing characters and <strong>must</strong> never
	contain any whitespace, any other characters are allowed.
	<br>
	<em>
		Examples: <code>PIC16F18325-I/SL</code>, <code>LM317-T</code>, <code>590</code>,
		<code>74HC595D</code>
	</em>
</p>

<p>
	Following that an <em>optional</em> <mark>value</mark> can be supplied
	and <strong>must</strong> be enclosed in parenthesis. This value field should
	follow the standard component value representation conventions used in
	schematics and should not contain any units.
	<br>
	<em>
		Examples: <code>(100)</code>, <code>(100n)</code>, <code>(1.2k)</code>,
		<code>(4k7)</code>
	</em>
</p>

<p>
	After the value an <em>optional</em> component <mark>description</mark> can
	be defined and <strong>must</strong> be enclosed in double-quotes. This field
	is supposed to mimic the brief description fields that we see in distributor's
	websites.
	<br>
	<em>
		Examples: <code>"PIC 16-series Microcontroller"</code>,
		<code>"8-bit Latching Shift Register"</code>, <code>"730nm Red LED"</code>
	</em>
</p>

<p>
	Last in this line, but certainly not least, an <em>optional</em> component
	<mark>package</mark> can be supplied and <strong>must</strong> be enclosed in
	square brackets. This field should follow standard naming conventions so that
	parsers and frontends can use it for filtering and aggregation.
	<br>
	<em>
		Examples: <code>[0805]</code>, <code>[SO-8]</code>, <code>[D-PAK]</code>,
		<code>[DIP-40]</code>
	</em>
</p>

<p>
	Reference designators <strong>must</strong> always follow the standard
	convention of being fully capitalized and in the format of characters followed
	by numbers. Whenever more than one reference designator is listed they
	<strong>should</strong> be separated by spaces.
</p>
<!-- END file specification -->
	</div>

	<div class="section">
		<h3>download</h3>

		<ul>
			<li><a href="https://metacpan.org/dist/PickLE">CPAN</a></li>
			<li><a href="https://github.com/nathanpc/ascii-image">Source code (Perl)</a></li>
		</ul>

		<p>
			For links to download any of the ports of the parser or application
			you should consult the <a href="#ports">ports section</a> of this
			page.
		</p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
