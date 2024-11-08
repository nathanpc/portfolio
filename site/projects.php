<?php
require_once __DIR__ . '/../templates/includes.php';

// Render the DOCTYPE template.
include __DIR__ . '/../templates/doctype.php';
?>
<html>

<head>
	<title>Nathan's Projects</title>

	<?php include __DIR__ . '/../templates/head.php'; ?>
</head>

<body>
	<?php include __DIR__ . '/../templates/header.php'; ?>

	<div class="section">
		<p><?= compat_image(
				'/assets/images/misc/under-construction.gif',
				'Under construction GIF'
			) ?></p>

		<p>Sorry I'm still building this part of my website.</p>
	</div>

	<?php include __DIR__ . '/../templates/footer.php'; ?>
</body>

</html>
