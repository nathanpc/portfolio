<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Incredible Chinese USB Car Power Supply</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Incredible Chinese USB Car Power Supply</h2>
		<div id="published-date">2016-03-28</div>
	</div>

<p>Recently I bought a couple of those <a href="./extension.jpg">super ultra cheap cigarette plug extensions</a> to distribute 12V in the lab for various things. As usual with everything chinese, I decided to open it up to see how horrible it was inside, but I also did that to upgrade the wiring since I would be pulling a couple of amps from this and I want to minimize the voltage drop.</p>

<?= compat_image("./thing.jpg", "The thing") ?>

<p>This is the incredible thing I found inside the thing as the 5V supply for the USB socket. A 7805 regulator and a 20 ohm 1/4W resistor <strong>in series with the 5V output</strong>. I guess it could have been worse, they could have used a 5.2V zener or the worst of all just a resistor voltage divider.</p>

<p>China never ceases to amaze me. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
