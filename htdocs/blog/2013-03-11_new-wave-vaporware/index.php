<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>The New Wave of Vaporware</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>The New Wave of Vaporware</h2>
		<div id="published-date">2013-03-11</div>
	</div>

<p>Last week I got a new development device, a Galaxy Nexus, mainly for Android development since I bricked my old Galaxy S. Sooner or later I would try to install my favorite alpha mobile OS: Firefox OS. I really wanted to try Firefox OS because of how they want HTML5 to be the primary (and unique) way to build applications, but since I <strong>NEVER</strong> run anything on emulators, I was waiting until I had a device that was compatible.</p>

<p>So I went to <a href="https://developer.mozilla.org/en/docs/Mozilla/Firefox_OS">their docs</a> to get started on how to flash their OS into my Galaxy Nexus. The first thing that I see is that they don't provide binaries, that's not good, but I can compile it myself, no big deal. So I started following their <a href="https://developer.mozilla.org/en-US/docs/Mozilla/Firefox_OS/Building_and_installing_Firefox_OS">Building/Installation entries</a>, installed all the prerequisites, pulled the code from their repo and ran the configure command to prepare the repo. Then I realized it was downloading the Android source code, which is fucking huge and takes an eternity to download, at this point I realized things weren't going to be good.</p>

<p>For some reason they weren't using Google's servers to get Android's code, but instead the shitty Linaro ones, I was getting a extremely unreliable, 60kb/s download, it was a hell. After <strong>4 hours</strong> trying to get all the code it started failing bad and then it wouldn't download the rest anymore, so I went to their IRC channel hoping to get some help, but couldn't get much of it, but what was interesting from the conversation in the IRC is that their primary development target isn't phones, but the shitty emulator.</p>

<p>I can rant about emulator and all that crap for days here, but I prefer not to. So, dear Mozilla, if you want developers to really care about the awesome product that you're building, you should first give us a fast and easy way to install it on our devices.</p>

<p>If you look closer at all these 5th place mobile OSes (Ubuntu Touch, Firefox OS, and Tizen) you'll realize one major thing: It looks like they'll never ship (yeah Tizen, you're the worst at the time), they just appear to be a bunch of vaporware.</p>

<p>I really love to see all these emerging technologies and have fun with development stuff, but if I can't install it, I'll just loose my interest and never look back. I think I'll never try Firefox OS again, it was a great experiment, but if you focus on crap emulators I won't support your platform. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>

