<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Old Computer Challenge 2024 - Day 2</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Old Computer Challenge 2024 - Day 2</h2>
		<div id="published-date">2024-07-17</div>
	</div>

<p>I'm actually writing this on day 3, but let's ignore this fact and pretend
it's still yesterday. I thought I was going to have a bit of free time in the
evening to write this post, but I was very tired and went straight to bed.</p>

<p>The day was very calm, mainly hanging out in IRC, browsing <i>gopherspace</i>
(this may have a big impact on my activities today), and installing and
configuring a bunch of applications on my Power Mac G5 and on my PowerBook G4.
It was clearly a day to chill and simply enjoy some old software. At least now
my PowerPC Macs have a ton of great software installed and are a lot more usable
for daily tasks.</p>

<p>A bit of the day was also spent setting up Quake II and configuring it all
since there was the possibility of some <a href="https://bb.deadnet.se/viewtopic.php?t=84">
evening matches</a>, although by the time everyone was playing I had already
signed out for dinner and a quiet evening. I did spend a couple of hours playing
on public servers during the afternoon, just to ensure I had it properly
configured. <i>*wink* *wink*</i></p>

<p>Some work was done in terms of setting up a public share box, which is my
idea of an FTP server with an HTTP directory listing frontend, allowing me to
quickly upload random files to a cloud server from any device, great for
temporary sharing files. I wanted to do all of this with Docker, but after some
frustrations trying to get a proper FTP server running on Alpine I've decided to
put a stop on this project while I play around with shinnier things.</p>

<?= compat_image('./znc-desktop.png',
	'A view from my Power Mac 5G\'s desktop right now with ZNC open in ' .
	'Safari just as I remember setting it up back in 2010') ?>

<p>One quality of life improvement that was quite a nostalgia trip to setup was
an IRC bouncer. Since I'm jumping back and forth with different machines and
because I do want to get back into regularly chatting on IRC, a bouncer is a
must. I went with the venerable <a href="https://znc.in/">ZNC</a>, and let me
tell you, seeing this web interface again after more than 10 years was one of
the biggest nostalgia trips I've ever had in my life. Setup was just as clunky
as I remember, but now I can have a proper IRC presence, although I was shocked
that it's no longer fashionable to use <a href="https://wiki.znc.in/Awaynick">
awaynick</a>.</p>

<p>Since a lot of gopherspace browsing was done today, all of it using
<a href="http://gopher.floodgap.com/overbite/d?ff38">OverbiteFF</a> since it was
the fastest way for me to get a Gopher client running on OS X, it did start
feeling a bit wrong using a lot of CPU power and memory simply to display
something that was meant to be an extremely lightweight protocol.</p>

<?= compat_image('./gopher-netscape.png',
	'Browsing Gopher on Netscape 3 via VNC') ?>

<p>I do understand that a lot of people prefer browsing gopher using a terminal
client such as <a href="https://lynx.invisible-island.net/">Lynx</a>, which
makes a ton of sense, after all Gopher is mainly a text-based protocol and it
does fit nicely with the terminal, although I've always associated Gopher with
graphical clients, such as the ones found on early Firefox and classic Mac OS,
and as of late we don't have any "native" offerings for modern operating systems
that kind of look like the "ListView-based" applications from the past.</p>

<p>Because of all this gophering I may be inclined to use some of my OCC time to
enjoy writing a proper graphical Gopher client since the protocol is so easy to
implement.</p>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>

