<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Using a HPC on a Daily Basis</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Using a HPC on a Daily Basis</h2>
		<div id="published-date">2014-04-07</div>
	</div>

<p>Recently I've started using my <a href="http://www.hpcfactor.com/reviews/hardware/hp/jornada720/">Jornada 720</a> as a replacement for my iPad as a lab computer since it's extremely tiny (space is very important in the bench) and can do practically everything I need my iPad for, of course I still have my main computer in the lab to program microcontrollers and do everything, but the Jornada is great to have near my working area so I can quickly check datasheets, schematics, and parts list while soldering or prototyping.</p>

<?= compat_image("./lab-view.jpg", "My workbench and lab space") ?>

<p>Usually when I'm prototyping or testing a board I have to check datasheets for pinouts, common voltages, etc. and Adobe Reader is great for this task:</p>

<?= compat_image("./datasheet.png", "Datasheet open") ?>

<p>In my main computer I keep a very well organized folder (and database, but I'm still researching the best way to get the DB into my j720 and keep them both synced) with datasheets for practically every electronic component I have in stock. So whenever I update the folder with more stuff I just <a href="http://rsync.samba.org/">rsync</a> everything to my Jornada, and since it's a nice Linux machine I've already wrote a nice script to automate things.</p>

<?= compat_image("./datasheet-folder.png", "Datasheets") ?>

<?= compat_image("./folders.png", "Folders") ?>

<p>Last, but certainly not least, I've built a small command line application a while ago called <a href="https://github.com/nathanpc/build-bom">build-bom</a> which gets a schematic file from my CAD program (<a href="http://www.cadsoftusa.com/">EAGLE</a>) and can output the parts list into HTML, CSV, or JSON. So whenever I'm populating a board I export the parts list to HTML and open it in my Jornada so I can know which part to place where in the board:</p>

<?= compat_image("./parts-list.png", "Parts list") ?>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
