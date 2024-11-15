<?php include __DIR__ . '/../templates/doctype.php';  ?>
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
