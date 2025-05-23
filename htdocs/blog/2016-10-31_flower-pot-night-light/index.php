<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Flower Pot Night Light</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Flower Pot Night Light</h2>
		<div id="published-date">2016-10-31</div>
	</div>

<p>A couple of months back (April if I recall) I was bored and looking for a nice project to kill some time in a rainy saturday. I decided to build a nice night light for my bedroom. I had a set of restrictions put in place so that I would be pleased with the final result, these were:<ul><li>Must run on AAs<li>Adjustable intensity<li>Small and cute<li>Should be built entirely with parts that I had on hand</ul></p>

<?= compat_image("./in-use.jpg", "In use") ?>

<p>The first challenge was to find a nice enclosure, since this was going to be used as decoration it couldn't just be a bare protoboard with some LEDs or a boring project box. While looking through the pile of stuff (most people would call trash) I had stored in various places around the house, I found a couple of cubic flower pots made in various materials. I thought the ceramic one would fit my bedroom quite well, so that part was done.</p>

<?= compat_image("./sanding.jpg", "Sanding the case") ?>

<p>The next thing would be to find a diffuser to cover the LEDs and and give a more uniform light. My first idea was to use acrylic or something like that, but sadly I didn't have any on hand so I had to improvise. Again I went looking through my stuff and found an empty Ferrero Rocher enclosure (I knew I would use it some day), all I had to do was sand and cut it so it would fit the flower pot.</p>

<?= compat_image("./board.jpg", "The finalized board") ?>

<p>The last and most boring part was to solder all the LEDs, they are in a series parallel arrangement, with 9 parallel groups of 2 in series so that I could use a 9V supply. For driving them I decided to build a simple constant current sink with the <a href="https://upload.wikimedia.org/wikipedia/en/thumb/f/fd/Current_Limiter_NPN.PNG/200px-Current_Limiter_NPN.PNG">two NPN transistors in a feedback configuration</a> and designed it in such a way that it would be adjustable up to 100mA.</p>

<p>If you want to see more pictures of the whole process they are all available in this album:</p>

<?= compat_image_gallery(array(
	array('loc' => "./cutting.jpg", 'alt' => "Cutting the rough shape of the lens and sanding the corners"),
	array('loc' => "./sanding.jpg", 'alt' => "Sanding the lens to difuse the light"),
	array('loc' => "./gluing.jpg", 'alt' => "Gluing the flaps that will hold the circuit board in place"),
	array('loc' => "./board.jpg", 'alt' => "A close-up of the PCB"),
	array('loc' => "./solder.jpg", 'alt' => "A OK soldering job"),
	array('loc' => "./lid-open.jpg", 'alt' => "How it looks with the lens removed"),
	array('loc' => "./batteries.jpg", 'alt' => "The batteries are held in a 6-cell holder loose in the bottom of the pot"),
	array('loc' => "./in-use.jpg", 'alt' => "The light in its place")
)); ?>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
