<?php
require_once __DIR__ . '/../templates/includes.php';

// Get the last modified date from the post's file and fix the breadcrumbs bar.
$last_modified = $this->last_modified;
$crumbs = array(
	'blog' => '/blog',
	$this->slug => $this->permalink()
);

// Render the DOCTYPE template.
include __DIR__ . '/../templates/doctype.php';
?>
<html>

<head>
	<?php include __DIR__ . '/../templates/head.php'; ?>
</head>

<body>
	<?php include __DIR__ . '/../templates/header.php'; ?>

	<!-- Blog post header. -->
	<div id="blog-post" class="section">
		<h2><?= $this->title ?>
			<a href="<?= $this->permalink() ?>">#</a>
		</h2>
		<div id="published-date"><?= $this->published_date() ?></div>
	</div>

	<?= $this->content() ?>

	<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>

</html>
