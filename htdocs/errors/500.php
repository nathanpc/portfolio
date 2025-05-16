<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>
	<title>500 Internal Server Error</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>Internal server error</h2>

		<p>Something very bad just happened...</p>

		<p><?= compat_image('/assets/images/http-status/500.jpg',
			'500 Internal Server Error cat meme') ?></p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
