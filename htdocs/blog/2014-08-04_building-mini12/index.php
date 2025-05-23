<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Building the Mini12</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Building the Mini12</h2>
		<div id="published-date">2014-08-04</div>
	</div>

<p><strong>Update:</strong> This project was my first try at building an amplifier, because of this it is pretty awful in terms of performance, it has very noticeable crossover distorsion. For better designs please look at newer posts here.</p>

<?= compat_image("./mini12.jpg", "The finished project") ?>

<p>Last week, I decided to take on a very simple project: build a very low distortion, reasonably powerful, battery-powered amplifier that could fit in a very small, transparent enclosure that I had.</p>

<p>The main idea was to have this very small amplifier that could be moved around the house and powered from some 18650 cells so that I could enjoy some music with my friends when they come for our regular LAN parties. Usually we use one of those crappy iPod dock/speaker things that everyone loves, but, personally, they don't sound very good to me.</p>

<p>Since this was a quick project, I decided to make it as simple as possible to avoid any trouble. The easiest it could be was to use an audio op-amp driving a class B output made with darlington transistors with some negative feedback to keep the distortion really low, so that's what I did:</p>

<?= compat_image("./schematic.png", "Schematic") ?>

<p>I also designed a <a href="./peak-detector.png">very simple peak detector</a> to detect any clipping on the output to make sure the signal was as clean as possible, but, sadly, my case was so small that I couldn't fit it in. Since it would be powered from 2 18650 packs (3 cells each) or a pair of 9V batteries, the <a href="./power-supply.png">power supply</a> is extremely simplistic.</p>

<p>When all of the parts arrived, I decided to get everything prepared to be assembled the next day.</p>

<?= compat_image("./pre-assembly.jpg", "All the parts needed to built it have been collected") ?>

<p>Choosing where to put the jacks and switches was a bit tricky since the space inside the enclosure was extremely small.</p>

<?= compat_image("./drilling.jpg", "Holes drilled in the case and panel components test fitted") ?>

<p>Since I wasn't patient enough to wait for a PCB, I decided to build the whole thing on a piece of protoboard which was a bit tricky because of the space the jacks took.</p>

<?= compat_image("./protoboard.jpg", "All PCB components soldered") ?>

<p>After soldering the headphone jack and on/off switch, mounted from the inside, it was time to solder the RCA jacks which had to be mounted from the outside. This was very difficult since I had to make the shortest cable possible while making sure that I could still lift the board up to solder the cable to the PCB.</p>

<?= compat_image("./more-jacks.jpg", "Started soldering the panel mount components") ?>

<p>Sliding the board back into place was extremely difficult, but after a lot of wiggling, it was perfectly placed on the bottom of the enclosure, and I was ready to plug the power jacks into the JST connectors on the board. It was the only way to mount them, otherwise I wouldn't be able to lift the board to solder them.</p>

<?= compat_image("./finished.jpg", "All finished up and ready for testing") ?>

<p>Since it was 1:38AM, I was quite tired, and since I had been working on this thing for <a href="/img/mini12/time.jpg"><strong>7 hours and 12 minutes</strong></a>, I decided that it was time to sleep and leave the enclosure closing and testing for the next day. (<a href="http://i.imgur.com/J9wPMpI.jpg">Obligatory picture of the pile of wires and component leads</a>)</p>

<p>First thing to do in the morning was to test the little beast. This was the test setup (after using my oscilloscope and a dummy load to make sure everything was working fine). I had to use the living room table since my bench was a mess (as usual), and there was no space for the 2 speakers.</p>

<?= compat_image("./testing.jpg", "Testing the amplifier on my living room") ?>

<p>And that's all! If you want more technical information about the project, be sure to visit the <a href="https://github.com/nathanpc/mini12">GitHub repo</a>. If you want to discuss it, jump on over to the <a href="http://www.diyaudio.com/forums/solid-state/260161-mini12-my-first-amplifier.html">diyAudio thread</a>. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
