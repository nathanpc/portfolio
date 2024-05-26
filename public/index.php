<?php
require_once __DIR__ . '/../src/common_utils.php';
require_once __DIR__ . '/../src/compat.php';
require_once __DIR__ . '/../src/navbar.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Nathan Campos</title>

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
			<div class="section">
				<h2>about me</h2>

				<p>I'm a <b>full-stack developer</b> (although I prefer the
				backend), <b>creative technologist</b> and an <b>electronics
				engineer</b> born in <a
				href="https://en.wikipedia.org/wiki/Brazil">Brazil</a> and
				currently living in <a
				href="https://en.wikipedia.org/wiki/Portugal">Portugal</a>.
				You can find me working on almost anything that involves
				electricity, both in terms of hardware and software. Building
				things has always been a passion of mine, so you'll notice that
				I'm always self-motivated to work on new projects that involve
				technology. Some of the things that I've worked on have been
				used by hundreds of thousands of people, maybe into the millions
				depending on who's counting, and my work has definitely reached
				at least tens of millions.</p>

				<p>I'm currently dedicating some of my time to passing some of
				my knowledge to another generation and having a lot of fun
				working on creative projects with my students and colleagues at
				<a href="https://www.iade.europeia.pt/">IADE - Creative
				University</a>. I'm mostly involved with the <a
				href="https://www.iade.europeia.pt/en/undergraduate-programs/bachelor-creative-technologies/">
				Creative Technologies</a>, <a
				href="https://www.iade.europeia.pt/en/undergraduate-programs/bachelor-games-development/">
				Games Development</a>, and <a
				href="https://www.iade.europeia.pt/licenciaturas/engenharia-informatica/">
				Computer Science</a> degrees.</p>

				<p>If you browse this website, <a
				href="https://github.com/nathanpc">my GitHub profile</a>, or <a
				href="<?= $_SERVER['REQUEST_SCHEME'] . '://innoveworkshop.com/'
				?>">my company's website</a> you'll notice that I'm capable of
				building quite a lot of amazing things. If you're looking for
				someone with my skillset either for your company or to make your
				idea become a reality feel free to reach out to me at <?=
				safe_email('nathan@innoveworkshop.com') ?>.</p>
			</div>
		</div>

		<div id="footer">
			<hr>
			<div class="copyright">
				Nathan Campos &#169; <?= '2024-' . date('Y') ?>
			</div>
			<div class="last-modified">
				Last modified: <?= date('Y-m-d H:i', getlastmod()) ?>
			</div>
		</div>
	</body>
</html>
