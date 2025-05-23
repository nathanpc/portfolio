<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>My Raspberry Pi Post-Mortem</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>My Raspberry Pi Post-Mortem</h2>
		<div id="published-date">2012-11-20</div>
	</div>

<p>This might be the worst day of this current year. As you might already know yesterday, after 4 months of agony, <a href="http://instagram.com/p/SOj3MIlsH2/">I finally received my Raspberry Pi</a>. It cheered me up a lot, since in the same day my old Galaxy S bricked. Today the perfect chemical reaction occurred. All the excitement and expectation converted entirely (maybe multiplied) into a strange mix of frustration, sadness, and anger. My Raspberry Pi arrived dead.</p>

<p>After 4 long months of wait, ~20 items on a TODO list, 3 projects, 2 VMs, ~50 tweets, and 3 articles, it all came to a sad end. Today my friend borrowed me his spare USB keyboard so I could turn ON an configure my Raspberry Pi for the first time. While it was booting I had one of the most awesome experiences ever: I've watched the original Linux boot, with a logo on the left corner and all those awesome lines blazing through the screen, just like in 2005 when I booted Linux for the first time on my extremely old IBM ThinkPad. After I saw those lines for the first time I decided I wanted to know more about how things were made, Linux got me into programming, and turned me into what I am today. It was a awesome moment to watch those lines again.</p>

<p>The first thing <a href="http://www.raspbian.org/">Raspbian</a> did was show me a nice <a href="http://en.wikipedia.org/wiki/Ncurses">ncurses</a>-based configuration tool. I started configuring it and suddenly "No Signal". I looked at the Raspberry Pi and the only thing that showed me it was working was the Power LED, all the other LEDs (including the internet ones) turned OFF. I disconnected the power and tried booting it up again. This time it did the same thing, but a lot earlier.</p>

<p>I rushed to my computer to check if it was a known issue and if someone had a fix, many users had similar issues, but not the same, the suggestions were the same: Check the power source voltage and the SD Card. I've started by downloading the other distros and flashing them on different cards, without success on the Pi, I was still having the strange issue. Then I decided to get a multimeter to check the voltage of the board, when I checked the board voltage it was great, so it means it wasn't the power source causing the issue. All I got was to acknowledge that I got a faulty unit.</p>

<p>I inserted the Raspberry Pi back into its case and gently stored it into the drawer were I put all the electronics that stopped working, which currently contains only my first laptop (that ThinkPad with Linux) and my Galaxy S. I care a lot about all my electronics, even after they are "dead", that's why I never sold, or trashed any of them, which means I almost have a museum here in my room, with all the devices I ever owned.</p>

<p>I'm curious to know what will be the next thing that will get me as excited as the Raspberry Pi did. Computers, they aren't fun to play with anymore, and the Raspberry Pi changed this. The mobile world that always excited me, since the day I got my Palm, is no longer that exciting. So what's next?</p>

<p>I don't think I'll be buying another Raspberry Pi, probably not. All the excitement extinguished today.</p>

<p><em>Updates:</em><ul><li><a href="http://www.raspberrypi.org/phpBB3/viewtopic.php?f=28&t=20657">Looks like I'm not alone</a></ul> </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
