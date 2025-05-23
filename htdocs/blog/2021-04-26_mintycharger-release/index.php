<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>MintyCharger Released!</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>MintyCharger Released!</h2>
		<div id="published-date">2021-04-26</div>
	</div>

<?= compat_image('./product-hero-shot.jpg', 'The final version of the product') ?>

<p>
	In <a href="<?= blog_href('2021-04-06', 'revisiting-mintycharger') ?>">a
	previous post</a>, we've talked about how we were developing a better "9V"
	(PP3) battery charger and how it was based on an old project of mine. After
	about a week since the first prototype PCB was soldered up and ready for
	firmware development, we've <a href="https://innoveworkshop.com/product/mintycharger">
	released our latest product</a>.
</p>

<p>
	We were able to quickly build the firmware for the final version because
	most of the work was already done from the prototype that we had built last
	year, but that only got us so far. Most of the work this time wasn't on the
	voltage/current regulation code, but instead was on the user interface, and
	on the actual detection of the charge/discharge status of the battery.
</p>

<p>
	This is a pretty small product and something that is, in my opinion, quite
	different from what's currently available on the market. I hope you enjoy it
	and consider purchasing one!
</p>

<div style="text-align: center;">
	<a href="https://www.tindie.com/products/23461/?ref=offsite_badges&utm_source=sellers_innove&utm_medium=badges&utm_campaign=badge_large">
		<img decoding="async" alt="I sell on Tindie" width="200" height="104"
			src="https://d2ss6ovg47m0r5.cloudfront.net/badges/tindie-larges.png">
	</a>
</div>

	<?php include_template('footer'); ?>
</body>
</html>
