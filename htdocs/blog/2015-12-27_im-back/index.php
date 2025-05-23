<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>I'm Back!</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>I'm Back!</h2>
		<div id="published-date">2015-12-27</div>
	</div>

<p>Sorry for this extremely long break, I've been extremely busy with a bunch of stuff from university and wasn't feeling inspired to write any blog posts, but now I'm hopefully back and I have a lot of plans for interesting future posts.</p>

<p>This year I got overwhelmed by a shitton of university assignments and to top all that I've been exposing my projects at a bunch of trade shows together with my friends. If you've ever exposed things in trade shows you'll know that it's extremely stressing (before, during, and after) and time consuming, so I've been putting a lot of effort into that. The last trade show I've been to was called InnovaCities and it happened in Foz do Igua&ccedil;u, <a href="https://www.google.com.br/maps/dir/Vitoria,+Vit%C3%B3ria+-+State+of+Esp%C3%ADrito+Santo/Foz+do+Igua%C3%A7u,+State+of+Paran%C3%A1/@-22.8712631,-51.9386506,6z/data=!4m14!4m13!1m5!1m1!1s0xb83d5d85374ee9:0x97595e7ea70ed809!2m2!1d-40.2957768!2d-20.2976178!1m5!1m1!1s0x94f6983de5db79bb:0x920b68c585cac349!2m2!1d-54.5854238!2d-25.5162467!5i2?hl=en">pretty far from home</a>, and I had a great time there showing a much improved version of the <a href="http://nathancampos.me/post/85832773918/lightwave-am-transmitterreceiver">lightwave transmitter</a> and a automatic shower and sink that focuses on saving water which was a project I did with a friend that had the idea. We even had the pleasure of meeting some polish researchers and the prince of Nigeria.</p>

<?= compat_image("./innovacities-prince-nigeria.jpg", "A photo with the Prince Momodu Joel Shaka") ?>

<p>Of course during this year I did a bunch of projects for myself including headphone amps, pre amplifiers, battery chargers, LED lighting, electronic loads, power amplifiers, and a lot more! I've also been experimenting with DC/DC conversion and power inverters which will be subjects of future blog posts.</p>

<p>One of the most notable projects I've been working on almost during the entire year is a <a href="https://github.com/nathanpc/battery-capacity">battery capacity database</a> ,which I plan to include all the batteries I can find, and be extremely helpful to determine which battery to buy next or estimate the battery life of your project with a certain battery, I'm currently working to create mathematical models of each battery. I'm so focused on this project that I've ditched the old super simple electronic load, which consisted of just a potentiometer, a op-amp, and a power transistor with a data logging multimeter, to a much better, automated, computer-controlled load that I named <a href="https://github.com/nathanpc/miniload">miniload</a>. Discharging batteries now is a lot faster and a lot less problematic.</p>

<?= compat_image("./messy-protoboard.jpg", "miniload") ?>

<p>This is just a bit of what happened when I was away. Tomorrow I'm my trip to Dubai starts, I'll be there for the new year celebrations and will be back in the middle of January, so don't go away, there's a lot more to come in 2016! </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
