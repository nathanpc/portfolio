<?php
require_once __DIR__ . '/../src/common_utils.php';
require_once __DIR__ . '/../src/compat.php';
require_once __DIR__ . '/../src/navbar.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Nathan Campos</title>

		<link rel="stylesheet" href="<?= href('/assets/css/main.css') ?>">
	</head>
	<body>
		<div id="header">
			<!-- Title header block. -->
			<div id="title-head">
				<h1>Nathan Campos</h1>
				<div id="breadcrumbs">
					<span class="sep">/</span> <span class="label">index</span>
				</div>
			</div>

			<!-- Navigation bar. -->
			<div id="navbar">
				<?= nav_item('index', '/', 'first') ?>
				<span class="spacer">|</span>
				<?= nav_item('blog', '/blog') ?>
				<span class="spacer">|</span>
				<?= nav_item('contact', '/contact', 'last') ?>
			</div>

			<hr>
		</div>

		<div id="content">
			<div class="section">
				<h2>about me</h2>
				<p>This should be a nice explanation about me and should
				sumamrize things that I make and made in the past. It's very
				important that this showcases everything that I am and show
				how I can help people and companies out with my knowledge and
				expertise.</p>
			</div>
		</div>

		<div id="footer">
			<hr>
			<div class="copyright">
				Nathan Campos &#169; <?= '2024-' . date('Y') ?>
			</div>
		</div>
	</body>
</html>
