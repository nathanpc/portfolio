<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>What To Do Before You Start Digging Into The Code</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>What To Do Before You Start Digging Into The Code</h2>
		<div id="published-date">2011-10-22</div>
	</div>

<p>
	I know a lot of developers that immediately after they have an awesome idea,
	they start coding it. Let me begin by saying that if you do this, you're
	completely doing it wrong! In this article I'll be teaching you how to start
	the right way, so you won't get disorganized in your own mess of ideas for
	your project.
</p>

<p>
	First of all, create a folder or create a new project in your IDE and add a
	<b>TODO file to the root</b>. In the first line of this file you will put
	the main concept of your project. Later, make a simple topic list with
	things that you want to implement, how you want them to be, what is the
	style to be used, if there will be the need of any 3rd party library, and so
	on. Here is a simple example made to help you out a bit:
</p>

<?php compat_code_begin(); ?>Dream in Tech
A new kind of site that will give the users the best content about technology, programming and other geeky stuff.

* Get a domain under .net
* Get a cool theme
* Write at least one article each day
* Improve the authors.php design
* Correct the unknown link bug
* Make the header 100px tall
* Continue like this...<?php compat_code_end(); ?>

<p>
	After you have made that, you can start to code, but as you progress and
	have other ideas, don't forget to add them there. After you start
	accomplishing your topics, keep the list more organized by separating the
	finished ones of the pending ones. Like this:
</p>

<?php compat_code_begin(); ?>Dream in Tech
A new kind of site that will give the users the best content about technology, programming and other geeky stuff.

To-do:
* Write at least one article each day
* Correct the unknown link bug
* Make the header 100px tall
* Continue like this…

Finished:
x Get a domain under .net
x Get a cool theme
x Improve the authors.php design
x Continue like this...<?php compat_code_end(); ?>

<p>
	Organization is the most important thing when you're a developer. Leave a
	comment saying about how you keep your projects organized or if you use any
	program to help you.
</p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://dreamintech.net/">my old blog
	</a>. Some things may be broken.
</p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>

