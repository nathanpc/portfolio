<?php

// Require utilities for project pages.
require_once __DIR__ . '/../src/projects_utils.php';

// Fantastique object building.
$this->fill(array(
	'title' => 'Nathan\'s Projects',
	'description' => 'A list of my most recent projects, but only the ones I ' .
		'cared to include.'
));

// Render the DOCTYPE template.
require_once __DIR__ . '/../templates/includes.php';
include __DIR__ . '/../templates/doctype.php';
?>
<html>

<head>
	<?php include __DIR__ . '/../templates/head.php'; ?>
</head>

<body>
	<?php include __DIR__ . '/../templates/header.php'; ?>

	<div class="section">
		<p>A small collection of some of my most recent, or at least most
			impactful works. This is by far not a list of everything that I've
			done professionally, most of which is closed source and
			unfortunately protected by NDAs, but if you want to have a better
			idea of everything I've done publically you can check out all my
			<a href="https://github.com/nathanpc">GitHub repositories</a>.</p>
	</div>

	<div class="section">
		<h2>web applications</h2>
		<p>The concept of a web application these days is, sadly, of a
			full-fledged desktop application that runs in your browser, with
			millions of lines of obfuscated Javascript, and sometimes other
			languages compiled to WebAssembly and running straight on your
			browser. The web applications that I have developed are nothing like
			that, never will be, and are basically what you would expect a web
			application to be back in 2010.</p>

		<?= project_component('pickle', 'PickLE',
			'A web application for managing and using electronic component ' .
			'pick lists with a theming engine that allows it to look great ' .
			'on modern platforms while still being compatible with browsers ' .
			'from the nineties.') ?>

		<?= project_component('litterbox', 'Litter Box',
			'A simple solution to upload and share files extremely quickly ' .
			'with strangers on the internet. Supports uploading and sharing ' .
			'with weirdos that still use 90s computers.') ?>

		<?= project_component('php-photo-viewer', 'PHP Photo Viewer',
			'A super lightweight and retro-friendly PHP 5.4 photo viewer ' .
			'library and website. Perfect for a digicam photo gallery.') ?>
	</div>

	<div class="section">
		<h2>libraries</h2>
		<p>Some of the libraries that I have created to help myself and other
			developers when writing solutions.</p>

		<?= project_component('fantastique', 'Fantastique',
			'An unopinionated, and labour intensive, static website ' .
			'generator for PHP. Allowing users to have all the flexibility ' .
			'they need to create any kind of static web site as if it were a ' .
			'classic PHP project.') ?>

		<?= project_component('pickle', 'PickLE',
			'An application and a parsing library to create an electronic ' .
			'component pick list file format designed to be human-readable ' .
			'and completely usable in its own plain-text form.') ?>

		<?= project_component('ascii-image', 'ascii-image',
			'A Ruby gem to convert any image into a lovely, colored, blocky, ' .
			'ASCII representation for showing off on your terminal.') ?>

		<?= project_component('php-photo-viewer', 'PHP Photo Viewer',
			'A super lightweight and retro-friendly PHP 5.4 photo viewer ' .
			'library and website. Perfect for a digicam photo gallery.') ?>
	</div>

	<div class="section">
		<h2>under construction</h2>

		<p><?= compat_image('/assets/images/misc/under-construction.gif',
				'Under construction GIF') ?></p>

		<p>More content, and more up-to-date content, is currently being written
			to go on this page. Consider everything that you see here as
			throughly incomplete.</p>
	</div>

	<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>

</html>
