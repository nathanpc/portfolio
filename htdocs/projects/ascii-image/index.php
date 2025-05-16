<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>ascii-image</title>
	<meta name="description" content="A Ruby gem to convert any image into a lovely, blocky, ASCII representation.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>ascii-image</h2>

		<p>
			A simple Ruby gem that relies on <a href="https://github.com/rmagick/rmagick">RMagick</a>
			to convert an image, local or from a URL, into a sequence of colored
			ANSI blocks to be displayed nicely on a terminal.
		</p>

		<p>
			This is the first Ruby gem that I ever developed, and also the first
			library that I ever published on an online package repository. When
			I was a lot younger and very naive.
		</p>

		<p>
			This library was very successful for what it was, with a total of
			17k downloads throughout its lifetime (checked on 2025-04-18). I
			don't know what people were doing with it, since it has no
			<a href="https://rubygems.org/gems/ascii-image/reverse_dependencies">reverse
			dependencies</a>, but I guess it was mainly wrapped into scripts and
			used to preview images in the terminal or simply generate ANSI art
			to embed into bash profiles, which was my main use for it.
		</p>
	</div>

	<div class="section">
		<h3>screenshots</h3>

		<p>
			I was going to provide some screenshots of it in action, but I was
			unable to find any contemporary ones in my archives or in the
			history of the GitHub repo, even though I'm pretty certain I had
			some somewhere, and when I tried using the library on my modern
			machines it was all kinds of broken and I'm not in the mood to setup
			a whole Ruby environment just for a screenshot, sorry.
		</p>
	</div>

	<div class="section">
		<h3>example usage</h3>

		<p>
			Using this library is as simple as a one-liner (shown here as two
			lines for legibility), all that you have to do is call the
			<code>build(width)</code> method with the maximum <code>width</code>
			of characters that the ANSI art should be:
		</p>

		<?php compat_code_begin('ruby'); ?>require 'ascii-image'

ascii = ASCII_Image.new("~/my_image.jpg")
ascii.build(20)

ascii = ASCII_Image.new("http://www.levihackwith.com/wp-content/uploads/2011/10/github-logo.png")
ascii.build(60)<?php compat_code_end(); ?>
	</div>

	<div class="section">
		<h3>download</h3>

		<ul>
			<li><a href="https://rubygems.org/gems/ascii-image">RubyGems</a></li>
			<li><a href="https://github.com/nathanpc/ascii-image">Source code</a></li>
		</ul>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
