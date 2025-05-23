<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>OAuth Broke The Internet</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>OAuth Broke The Internet</h2>
		<div id="published-date">2012-04-06</div>
	</div>

<p>
	If you don't know what OAuth is, it's a auth process for cross-domain login,
	like Twitter or Facebook when you want to login/register on client apps,
	like <a href="http://hootsuite.com/">HootSuite</a>,
	<a href="http://carbonwp7.com/">Carbon</a> or
	<a href="http://tapbots.com/software/tweetbot/">Tweetbot</a>, or when you're
	just logging into a 3rd-party site like
	<a href="http://www.empireavenue.com/">Empire Avenue</a> or
	<a href="http://geekli.st/">Geeklist</a>.
</p>

<p>
	It's a very secure system, the problem is that you break the user experience
	in the worst way possible. You take the user out of the web site or app just
	to login, the developer has to create a very bad system by embedding a
	WebView to the app or redirecting to the browser just to log the user in.
</p>

<p>
	xAuth is good, but not perfect, at least you don't need to take the user out
	of the app, the problem is that Twitter, for example, the developer must
	request the xAuth keys and wait if it gets approved, also it has limitations
	like no access to Direct Messages.
</p>

<p>
	Users and developers should make some pressure on Twitter, Facebook, Google
	etc. to open the xAuth access without limitations or ask for a new and
	better authentication system.
</p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://dreamintech.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
