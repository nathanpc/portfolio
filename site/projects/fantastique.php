<?php
// Require utilities for project pages.
require_once __DIR__ . '/../../src/projects_utils.php';

// Fantastique object building.
$this->fill(array(
	'title' => 'Fantastique',
	'description' => 'An unopinionated static website generator for PHP.'
));

// Render the DOCTYPE template.
require_once __DIR__ . '/../../templates/includes.php';
include __DIR__ . '/../../templates/doctype.php';
?>
<html>

<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>
</head>

<body>
	<?php include __DIR__ . '/../../templates/header.php'; ?>

	<div class="section">
		<h2>Fantastique</h2>

		<p>
			An unopinionated, and labour intensive, static website generator for
			PHP. Allows developers to have all the flexibility they need to
			create any kind of static web site as if it were a classic PHP
			project.
		</p>

		<p>
			This framework <a href="<?= href('/blog/2024-11-15/this-as-static-website.html') ?>">was
			developed to convert this website to static</a>, so this already is
			a great showcase of the capabilities of this project.
		</p>
	</div>

	<div class="section">
		<h3>motivation</h3>

		<p>
			The motivation for building this static site generator was simple.
			PHP is one of the most versatile ways of templating and quickly
			composing websites, but most of the time we only need it for simple
			things that can be static.
		</p>

		<p>
			This tiny module aims at creating a simple way to use PHP to create
			static websites while maintaining the greatest amount of flexibility
			possible.
		</p>
	</div>

	<div class="section">
		<h3>example usage</h3>

		<p>
			Using this microframework is extremely simple, and only requires the
			knowledge of 3 methods. <code>copy_static</code>, which simply
			copies assets and already static objects into the website build
			directory. <code>render_page</code>, which renders a PHP file into
			a static HTML page, and it's recursive brother
			<code>render_folder</code>, which does the same, but on an entire
			folder structure.
		</p>

		<p>
			Here's an exerpt from the <code>generate_example.php</code> that's
			included in the repository of the project, which contains the full
			example of how to use the framework and its features:
		</p>

		<?php compat_code_begin('php'); ?>use \Fantastique\Builder;

// Get our builder helper.
$builder = new Builder(__DIR__ . '/example', __DIR__ . '/build');

// Copy over everything from the static directory.
$builder->copy_static(__DIR__ . '/static');

// Render the example folder.
$builder->render_folder(__DIR__ . '/example', true, ['context.php']);
$builder->render_page($builder->base_path . '/context.php', [
	'something' => 'extra context!'
]);<?php compat_code_end(); ?>
	</div>

	<div class="section">
		<h3>download</h3>

		<ul>
			<li><a href="https://packagist.org/packages/nathanpc/fantastique">Packagist</a></li>
			<li><a href="https://github.com/nathanpc/fantastique">Source code</a></li>
		</ul>
	</div>

	<?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>
