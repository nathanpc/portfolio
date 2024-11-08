<?php
// Fantastique object building.
$this->fill(array(
	'title' => 'Nathan\'s Projects',
	'description' => 'A list of my most recent projects, but only the ones I ' .
		'cared to include.'
));

// Render the DOCTYPE template.
require_once __DIR__ . '/../templates/includes.php';
include __DIR__ . '/../templates/doctype.php';
?>
<html>

<head>
	<title><?= $this->title ?></title>

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
