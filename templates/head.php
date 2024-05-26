<?php
/**
 * head.php
 * Template for the head of every webpage on our website.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/../src/common_utils.php';
require_once __DIR__ . '/../src/compat.php';
require_once __DIR__ . '/../src/navbar.php';

/**
 * Head page template.
 *
 * @param $props Customizable properties of the template.
 */
function template_head(array $props = array()) {
	$props = array_merge(array(
		'title' => 'Nathan Campos'
	), $props);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?= $props['title'] ?></title>

		<!-- Mobile definitions. -->
		<meta name="viewport"
			content="width=600, initial-scale=1, user-scalable=1" />

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
				<?= navbar(array(
					'index' => '/',
					'projects' => '/projects',
					'blog' => '/blog',
					'work' => $_SERVER['REQUEST_SCHEME'] .
						'://innoveworkshop.com/',
					'contact' => '/contact'
				)); ?>
			</div>

			<hr>
		</div>

		<div id="content">
<?php } ?>
