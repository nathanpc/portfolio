<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Generic Chinese MP3 Player Teardown</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Generic Chinese MP3 Player Teardown</h2>
		<div id="published-date">2014-05-16</div>
	</div>

<p>As I've described in <a href="/post/2014-05-11/Unbelievable_Prices.html">Unbelievable Prices</a>, I bought a crappy chinese MP3 player to use as a "true" sound source (instead of the function generator I use while early-testing my audio projects) for testing my audio circuits without having to worry about accidentally shorting 12V into my iPod's headphone jack or something like that while probing around.</p>

<p>Yesterday it arrived and as it was expected, it's the best of Shenzhen. Horrible plastics and build quality, the buttons are super stiff, and overall a shitty product as it was expected to be, but since I'm only going to use it for testing, I don't care. Here are some pictures of the "beautiful" thing:

<?= compat_image_gallery(array(
	array('loc' => "./unboxed.jpg", 'alt' => "Unboxing this cheap little thing"),
	array('loc' => "./disassembled.jpg", 'alt' => "Taking it to bits"),
	array('loc' => "./front.jpg", 'alt' => "Front side"),
	array('loc' => "./left-side.jpg", 'alt' => "Left side"),
	array('loc' => "./right-side.jpg", 'alt' => "Right side")
)); ?>

<p>As you can see it's a typical chinese product. The LiPo battery has no markings, except for a weird XI logo, it doesn't look like a protected pack and the flimsy wires that connect it to the main board can snap off at any second and short the thing out.</p>

<?= compat_image("./board-view.jpg", "Board view") ?>

<p>Right next to what looks like the main processor, which sadly I couldn't find any information about it, there's a very nicely heat-shrunk clock crystal. On the center of the board you can see a generic <a href="http://www.ti.com/lit/ds/symlink/lm4871.pdf">4871</a> audio power amplifier, and on the left side there's a <a href="http://www.kingroad-china.net/Uploadfiles/2010763471154996.pdf">BK1080</a> FM receiver IC.</p>

<?= compat_image("./top-board.jpg", "Top board view") ?>

<p>On the other side of the board all you can see is the horrible LCD and the shittiest buttons you can buy in the Shenzhen market. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
