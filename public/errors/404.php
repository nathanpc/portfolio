<?php include_once __DIR__ . '/../../templates/doctype.php'; ?>
<html>
<head>
	<title>Not found</title>

	<?php include_once __DIR__ . '/../../templates/head.php'; ?>
</head>

<body>
	<?php include_once __DIR__ . '/../../templates/header.php'; ?>
	<?php http_response_code(404); ?>

	<div class="section">
		<h2>Not found</h2>

		<p>Sorry but we were not able to find the page in question.</p>

		<p><?= compat_image('/assets/images/http-status/404.jpg',
			'404 Not Found cat meme') ?></p>
	</div>

	<?php include_once __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>
