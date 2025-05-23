<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Old Computer Challenge 2024 - Day 1</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Old Computer Challenge 2024 - Day 1</h2>
		<div id="published-date">2024-07-16</div>
	</div>

<p>This post is part of a series for the <a href="https://occ.deadnet.se/">Old
Computer Challenge 2024</a>. You can find my previous post on this series
<a href="<?= blog_href('2024-07-15', 'occ-2024-day1') ?>">here</a>.</p>

<p>Yesterday was an "interesting" day. I had to start a bit late because I still
had a bit of work-related tasks to do before jumping 100% into the challenge. In
order to have a system to participate I had to first swap the motherboard of my
PowerBook G4 with one from a parts machine. This proccess took almost my entire
day. You have to remove exactly 62 screws in order to get the motherboard out,
it's by far the most painful repair I've done in my life. The good news is that
the repair was successful. I'm typing this article in it! Although the path to
get here wasn't very straightforward.</p>

<?= compat_image('./hollow-chassis.jpeg',
	'The hollow chassis without its motherboard') ?>

<p>Upon finishing the board swap, screwing back every single one of the 62
screws, and lightly cleaning the chassis, I was ready to restore the image of
the old spinning rust hard drive (in this case it really feels rusty) into the
shiny new SSD. I insert my <a href="https://macintoshgarden.org/apps/mac-osx-mac-os-10-ppc">
totally legit install media of OS X 10.4</a>, plug my FireWire external drive
with the original disk image, and fire it up. Since this is a slow machine I
boot it in verbose mode (<code>Command-V</code> on boot) and am immediately
greeted with the exact same kernel panics and random errors I've described in
the previous post. Apparently the original motherboard was fine after all.</p>

<?= compat_image('./screws.jpeg', 'Every single one of the 62 screws') ?>

<p>Putting in all this work and getting nowhere was really frustrating, but
anyway, I powered through it, trying every imaginable thing to get the machine
to boot. In the end I think the 1GB RAM stick I was using was faulty, since it
would always kernel panic when it was installed, prompting me to dig through my
bag of RAM sticks to find another 1GB one that worked. I had minor success when
I swapped the old hard drive back in to the machine, as it booted straightaway.
Following that were many attempts to image the drive into the SSD on the machine
itself or using my Power Mac G5, all fruitless.</p>

<p>In the end I was only able to get a bootable drive after booting the
PowerBook with its original hard drive, connecting the SSD via USB, firing up
<a href="http://macintoshgarden.org/apps/carbon-copy-cloner-347">Carbon Copy
Cloner</a> and leaving it overnight to very slowly clone the disks. Today I woke
up, swapped the SSD in to the PowerBook, assembled everything back, and it's now
fully working, and it's blazingly fast (for a 2005 computer).</p>

<?= compat_image('./bbedit.png',
	'Fully working and editing writing this article') ?>

<p>Today my plan is to get a <a href="https://wiki.znc.in/ZNC">ZNC bouncer</a>
going so that I can be on IRC on my PowerBook G4 and on my Power Mac G5. I'll
also be working on a setup to easily upload files to my cloud server so that I
can instantly share images and files directly from my older machines, something
that will also be useful for my modern machines, since I've always wanted to
FTP into a server, drop some files, and get a link to share. Hopefully this will
kill my lazy habit of dropping the files on Google Drive.</p>

<p>One interesting thing about this challenge is that it's making me think of
quality of life projects that will enable me to be more inclined to use my retro
gear in the future. It's a lot more inviting to use a machine if you know it's
all set up and that it'll be able to perform "modern" tasks without you having
to spend time setting things up.</p>

	<?php include_template('footer'); ?>
</body>
</html>
