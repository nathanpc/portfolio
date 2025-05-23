<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Lightwave AM Transmitter/Receiver</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Lightwave AM Transmitter/Receiver</h2>
		<div id="published-date">2014-05-14</div>
	</div>

<p>This week I've been experimenting with a very simple and cheap project for wireless transmissions, a <a href="http://en.wikipedia.org/wiki/Light">lightwave</a> AM transmitter and receiver based on <a href="http://www.cheapscience.com/2012/03/voice-led-modulator.html">Scott's design</a>, which was based on <a href="https://www.youtube.com/watch?v=vvF77YdkzcY">VK2ZAY's design</a>. In my final design I've increased the base biasing resistors to decrease the size of the coupling capacitor and also used a darlington transistor to get more current gain.</p>

<?= compat_image("./basic-schematic.png", "Schematic") ?>

<p>The transmitter is pretty straight forward, the input modulates the current passing by the LED, which modulates the intensity of light, if you've designed any class A amplifiers in the past you surely know how it works. The receiver is just a simple <a href="http://en.wikipedia.org/wiki/Transimpedance_amplifier">transimpedance amplifier</a>, which is amplifying the signal quite a bit (~56x gain) since the transmitter will usually be a bit far from the receiver. You can do the same with a op-amp, but I much prefer a discrete circuit for these simple things.</p>

<p>You can put a buffer stage with a darlington <a href="http://en.wikipedia.org/wiki/Common_collector">emitter follower</a> on the output of the receiver so you can drive a speaker directly. Something that I would recommend is to add a small (10x gain maybe?) pre-amplifier for the transmitter, that way you'll get a bit more signal if you're source isn't very loud, specially if you want to drive some high power LEDs, since you have a lot of current headroom with those.</p>

<p>If you want to experiment with different values in a simulation, here is the <a href="https://dl.dropboxusercontent.com/u/12174296/Current%20Flow/AM%20Lightwave%20Transmitter%20and%20Receiver.asc">LTspice schematic</a>. The best way to choose the best LED + photodiode combination to maximize the range is to build some breakout boards that you can plug different LEDs and photodiodes until you have the perfect combination.</p>

<?= compat_image("./first-prototypes.jpg", "Prototypes") ?>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
