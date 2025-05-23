<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>The sad state of macOS icons</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>The sad state of macOS icons</h2>
		<div id="published-date">2024-07-09</div>
	</div>

<p>Yesterday I was working on a personal project that involved building an
application for an older version of macOS. While browsing the Apple's extensive
documentation from circa OS X 10.8 (which I have
<a href="https://archive.org/details/Xcode51DocSets">archived</a> just in case)
I stumbled upon a very interesting paragraph that explicitly told developers
they should never reuse their iOS icons for their macOS applications. Given the
unique design language of the Mac's operating system the icons must be
different.</p>

<?= compat_image('./old-apple-guidelines.png',
	'OS X 10.8 Human Interface Guidelines') ?>

<p>It's ironic that 10 years later the complete opposite would be true. These
days if you use an icon that isn't in line with the iOS guidelines your
application would stick out like a sore thumb in the dock. The
<a href="https://developer.apple.com/design/human-interface-guidelines/app-icons">
modern version of these guidelines</a> now instruct developers they must use the
familiar iOS rounded rectangle, but they at least have the option of slightly
extending visual elements past the borders: (emphasis mine)</p>

<blockquote>For example, the TextEdit icon pairs a mechanical pencil with a sheet of lined paper to suggest a utilitarian writing experience. After you create a detailed, realistic image of a tool, it often works well to <b>let it float just above the background and extend slightly past the icon boundaries</b>. If you do this, make sure the tool remains visually unified with the background and <b>doesn’t overwhelm the rounded-rectangle shape</b>.</blockquote>

<p>I won't dwell into the modern macOS design language, which for me seems more
like a glorified iPad these days, but along the way, and along this path of
merging the mobile and desktop design languages, we lost a very important design
aspect related to the icons: Their shape.</p>

<?= compat_image('./modern-dock.png', 'Appearance of the dock on modern macOS') ?>

<p>Whenever you look at the dock on macOS your brain has to interpret the sea of
icons it's currently seeing. Given that they are all the exact same shape your
brain has to use only their colors in order to identify them. This means you
have to try harder in order to identify icon of the application you are looking
for. Beforehand you could actually use the shape of the icon itself to help out
on that cognitive task.</p>

<?= compat_image('./old-dock.png', 'How my dock used to look like in OS X 10.8') ?>

<p>Not only did we loose the shape of the icons, we also lost their unique 3D
appearance, something that was completely different from what Windows had back
in the day and made the Mac unique. These days macOS seems bland, just another
operating system, even Windows 11 looks more or less like it. It doesn't even
stand out from its mobile, and highly paired down, variants. It doesn't feel
like a professional operating system that you can get work done as it felt back
in the days when Steve Jobs was proud to advertise its UNIX features.</p>

	<?php include_template('footer'); ?>
</body>
</html>
