<?php
// Fantastique object building.
$this->fill(array(
	'title' => 'Nathan\'s Projects',
	'description' => 'A list of my most recent projects, but only the ones I ' .
		'cared to include.'
));

/**
 * Creates a project section.
 *
 * @param string $id   Slug of the corresponding project page.
 * @param string $name Name of the project.
 * @param string $desc A short, but lengthy, description of the project.
 */
function project_component(string $id, string $name, string $desc) {
	echo "<div id=\"$id\" class=\"project-comp\">\n";
	echo "	<h3><a href=\"" . href("/projects/$id") . "\">$name</a></h3>\n";
	echo "	<p>$desc</p>";
	echo '</div>';
}

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
		<h2>libraries</h2>
		<p>Some of the libraries that I have created to help myself and other
			developers when writing solutions.</p>

		<?= project_component('fantastique', 'Fantastique',
			'An unopinionated, and labour intensive, static website ' .
			'generator for PHP. Allowing users to have all the flexibility ' .
			'they need to create any kind of static web site as if it were a ' .
			'classic PHP project.') ?>
	</div>

	<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>

</html>
