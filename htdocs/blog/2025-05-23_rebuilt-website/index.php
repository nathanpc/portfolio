<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Rebuilt the website (again)</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Rebuilt the website (again)</h2>
		<div id="published-date">2025-05-23</div>
	</div>

	<p>
		I guess the only I do with this website is rebuild it... Once again I
		decided to redo the entire thing. In less than a year this website has
		been built from scratch, and rebuilt completely twice.
	</p>

	<p>
		The reason for the rebuild this time was out of frustration. Even though
		I was fairly happy with <a href="<?= blog_href('2024-11-15', 'this-as-static-website') ?>">the
		static website I had built</a>, I couldn't really edit it and test my
		changes on any of my old computers, largely because of the requirement
		on PHP 8. This made me very frustrated, since one of the joys of having
		such a simple and minimalistic website is to use it and edit it on older
		machines.
	</p>

	<p>
		After much frustration I did decide to pull the trigger on the rewrite
		and basically reverted everything to how things were
		<a href="https://github.com/nathanpc/portfolio/tree/97b1234e2da81719dd5fa9142bd4c7779162def2">before
		the static rewrite</a>, although I made a whole bunch of changes to make
		it more maintainable in the long run, especially since the old code for
		the website was littered with special functions for blog posts that I
		had to look up every time I made a post.
	</p>

	<p>
		All in all the website is now in a much better state, the code for it is
		cleaner, it's easier to maintain, many of the processes used to
		administer it adhere to the UNIX philosophy, and I can basically work on
		it on any machine I desire.
	</p>

	<p>
		Maybe one day I will implement an RSS feed generator for the blog and
		actually make use of <a href="https://github.com/nathanpc/portfolio/blob/52b256478712c2d6552bb1d93e0095c2aabea71c/src/compat.php">all
		those <code>compat_*</code> functions</a> that are supposed to make the
		website work with older web browsers.
	</p>

	<?php include_template('footer'); ?>
</body>
</html>
