<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Nathan's Link Collection</title>
	<meta name="description" content="The place where I hoard all precious links.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>link collection</h2>

		<p>This is a <s>massive hoard</s> curated collection of some links from
			the great information superhighway that the internet is. The purpose
			of this part of my website is share some important pages that have
			helped me in the past while researching a specific topic, or simply
			something I found amusing.</p>

		<p>It's a great place to spend a weekend's afternoon and dive into some
			rabbit holes. Also, the information it contains is at least a
			million times more accurate than the first page of any Google search
			these days.</p>

		<p>The information you'll find here will be divided into the following
			categories for your browsing pleasure:</p>

		<!-- Links Table of Contents -->
		<ul>
			<li><a href="#os">Operating Systems</a>
				<ul>
					<li><a href="#os-msdos">MS-DOS</a></li>
					<li><a href="#os-win9x">Windows 9x</a></li>
				</ul>
			</li>
			<li><a href="#computers">Computers</a>
				<ul>
					<li><a href="#computers-pocket386">Pocket 386</a></li>
				</ul>
			</li>
			<li><a href="#prog">Programming</a>
				<ul>
					<li><a href="#prog-msdos">MS-DOS</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<div class="section">
		<!-- Operating Systems -->
		<?php include __DIR__ . '/operating-systems.php'; ?>
	</div>

	<div class="section">
		<!-- Computers -->
		<?php include __DIR__ . '/computers.php'; ?>
	</div>

	<div class="section">
		<!-- Programming -->
		<?php include __DIR__ . '/programming.php'; ?>
	</div>

	<div class="section">
		<p style="font-size: 10pt;"><i>
			I began collecting these links in July of 2025, so sadly much of my
			resources along the years have been lost, which is the reason why
			this page now exists.
		</i></p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
