<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>
	<title>404 Not Found</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>Not found</h2>

		<p>Sorry but we were not able to find the page in question.</p>

		<p><?= compat_image('/assets/images/http-status/404.jpg',
			'404 Not Found cat meme') ?></p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
