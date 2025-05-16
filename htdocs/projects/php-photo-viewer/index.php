<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>PHP Photo Viewer</title>
	<meta name="description" content="A super lightweight and retro-friendly PHP 5.4 photo viewer library and website.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>PHP Photo Viewer</h2>

		<p>
			A super lightweight and retro-friendly PHP 5.4 photo viewer library
			and website. Great for sharing your digicam photos with your friends
			and family members, but also great if you want to use it as a
			library and build your own image gallery website with it.
		</p>

		<p>
			The goal of this project is to be extremely simple, all that you
			have to do is create a folder named <code>photos</code> and drop
			your photos that you want displayed there. You can organize them
			into folders, which subsequently will become albums in the gallery.
			The thumbnails for each photo will be generated automatically by the
			application and will be stored in a folder named <code>thumbs</code>.
		</p>
	</div>

	<div class="section">
		<h3>screenshots</h3>

		<?= compat_image_gallery(array(
			array('loc' => "./screenshots/home.png", 'alt' => "Home page of the application"),
			array('loc' => "./screenshots/gallery.png", 'alt' => "A folder/gallery page"),
			array('loc' => "./screenshots/photo-top.png", 'alt' => "Top of a photo page"),
			array('loc' => "./screenshots/photo-bottom.png", 'alt' => "Bottom of a photo page")
		)); ?>
	</div>

	<div class="section">
		<h3>deployment</h3>

		<p>
			This application was built to be retro-friendly both on the server
			side as well as the client side, so its requirements are quite small
			and their versions very old, so you can easily host this on anything
			built in the last 15 years as long as you satisfy the following
			requirements:
		</p>

		<ul>
			<li>PHP 5.4</li>
			<li><a href="https://www.php.net/manual/en/book.exif.php">Exif PHP Extension</a></li>
			<li><a href="https://www.php.net/manual/en/book.imagick.php">ImageMagick PHP Extension</a></li>
		</ul>

		<h4>classic web server deployment</h4>

		<p>
			As is tradition with PHP applications of this era you can simply
			drop this repository inside a folder of your web server and it
			should be up and running already. The application works both inside
			a VirtualHost or in a subfolder of your web server automatically, no
			need to configure anything.
		</p>

		<p>
			You must create a <code>photos/</code> and a <code>thumbs/</code>
			folders for the storage of photos and their thumbnails respectively.
			The thumbnails are generated as needed by the application.
		</p>

		<p>
			The <code>.htaccess</code> that's included with the project is
			simply to guard against snooping inside the <code>.git</code> folder
			and other development files. It's not required for the application
			to run and contains nothing of importance.
		</p>

		<p>
			There are a couple of variables you can tweak inside the <code>index.php</code>
			source, feel free to do so if the defaults are not of your liking.
			Also feel free to edit the layout and styling of the application as
			much as you want.
		</p>

		<h4>using docker</h4>

		<p>
			Even though deploying this application is extremely simple and
			straightforward if you already have a web server setup, most servers
			these days are only hosts for Docker. To make this application also
			easy to deploy on these environments a <code>Dockerfile</code> is
			also included in the repository and can be easily deployed to using
			a <code>docker-compose.yml</code> similar to this one:
		</p>

<?php compat_code_begin('yaml'); ?>---
services:
  web:
    build: .
    restart: unless-stopped
    ports:
      - '8005:80'
    volumes:
      - ./photos:/var/www/localhost/htdocs/photos<?php compat_code_end(); ?>

		<p>
			This will expose the web server on port <code>8005</code> and will
			create a volume for the photo storage folder from <code>photos/</code>
			in the root of the repository. This configuration, as is, will keep
			the thumbnail cache inside the container, meaning it will be deleted
			when the container is restarted. If you want the thumbnail cache to
			be persistent add another volume for the <code>thumbs/</code>
			directory.
		</p>
	</div>

	<div class="section">
		<h3>usage as a library</h3>

		<p>
			The application was intended to also work as a library for embedding
			photo galleries into other websites, so the code is very modular and
			everything is contained in the <code>photo_viewer.php</code> source
			file, the <code>index.php</code> is simply a front-end for it.
		</p>

		<p>
			You can import the <code>photo_viewer.php</code> into your
			application and use it standalone to embed a similar feature right
			into your own website. Use this repository as an example, read the
			documentation inside the source file and you should have everything
			you need to embed this feature.
		</p>

		<p>
			If you create any additional functionality please contribute back
			your changes since it helps the community.
		</p>
	</div>

	<div class="section">
		<h3>downloads</h3>

		<ul>
			<li><a href="https://github.com/nathanpc/php-photo-viewer">Source code</a></li>
		</ul>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
