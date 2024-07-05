<?php include_once __DIR__ . '/../../templates/doctype.php'; ?>
<html>
<head>
	<title>Internal server error</title>

	<?php include_once __DIR__ . '/../../templates/head.php'; ?>
</head>

<body>
	<?php include_once __DIR__ . '/../../templates/header.php'; ?>
	<?php http_response_code(500); ?>

	<div class="section">
		<h2>Internal server error</h2>

		<p>Something very bad just happened...</p>

		<p><?= compat_image('/assets/images/http-status/500.jpg',
			'500 Internal Server Error cat meme') ?></p>
	</div>

	<?php include_once __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>
