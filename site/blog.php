<?php
require_once __DIR__ . '/../templates/includes.php';

// Fantastique object building.
$listing = $this->context['listing'];
$this->fill(array(
	'title' => 'Nathan\'s random musings',
	'path' => '/blog'
));

// Render the DOCTYPE template.
include __DIR__ . '/../templates/doctype.php';
?>
<html>

<head>
	<?php include __DIR__ . '/../templates/head.php'; ?>
</head>

<body>
	<?php include __DIR__ . '/../templates/header.php'; ?>

	<!-- Blog listing. -->
	<?php $last_year = ""; ?>
	<?php foreach ($listing as $post) { ?>
		<?php if ($last_year != $post->date->format('Y')) { ?>
			<!-- Year marker. -->
			<?php $last_year = $post->date->format('Y'); ?>
			<h3 class="post-year"><?= $last_year ?></h3>
		<?php } ?>

		<div class="post-listing">
			<span class="published-date"><?= $post->published_date()
				?></span>
			<a class="title" href="<?= $post->permalink() ?>">
				<?= $post->title ?>
			</a>
		</div>
	<?php } ?>

	<br>

	<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>

</html>
