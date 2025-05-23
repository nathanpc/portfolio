<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Mini6 Amplifier</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Mini6 Amplifier</h2>
		<div id="published-date">2014-09-11</div>
	</div>

<?= compat_image("./mini6.jpg", "Mini6 amplifier") ?>

<p>I was a bit bored a couple of weeks ago so I decided to design a very simple discrete amplifier rated for 6W/channel just to make sure it would't oscillate and be more confident to build bigger ones.</p>

<?= compat_image("./schematic.png", "Schematic") ?>

<p>As you can see it's a fairly simple design with a op-amp pre-amplifier and a discrete power amplifier. Building it was extremely simple, the difficult part is always mounting all the panel components and wiring everything.</p>

<?= compat_image("./checking-values.jpg", "Checking components to be placed") ?>

<p>A while ago I built a program called <a href="https://github.com/nathanpc/build-bom">build-bom</a> to help me quickly find the component values when assembling a board. It's a great use for a old EeePC that you may have laying around.</p>

<?= compat_image("./overview.jpg", "PCB with all components soldered") ?>

<p>One thing that you may have noticed is that I've used canned transistors instead of your typical plastic TO-92. The only reason I did this was because they looked cool and I have a bunch laying around.

<?= compat_image_gallery(array(
	array('loc' => "./board-cad.png", 'alt' => "How the board looks like in CAD"),
	array('loc' => "./components.jpg", 'alt' => "Organizing the components to begin soldering"),
	array('loc' => "./begin-soldering.jpg", 'alt' => "Started soldering"),
	array('loc' => "./checking-values.jpg", 'alt' => "Checking the values with my program"),
	array('loc' => "./top-view.jpg", 'alt' => "Top view of the board after soldering"),
	array('loc' => "./side-view.jpg", 'alt' => "Side view of the board"),
	array('loc' => "./overview.jpg", 'alt' => "Board with the heatsinks"),
	array('loc' => "./wiring.jpg", 'alt' => "Wires soldered"),
	array('loc' => "./lights-on.jpg", 'alt' => "First power-up"),
	array('loc' => "./front.jpg", 'alt' => "Front panel"),
	array('loc' => "./back.jpg", 'alt' => "Back panel")
)); ?>

<p>If you want to know more about the amplifier check out the <a href="https://github.com/nathanpc/Mini6">GitHub repo</a>. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
