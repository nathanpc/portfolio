<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Litter Box</title>
	<meta name="description" content="A simple solution to upload and share files extremely quickly with strangers on the internet.">
</head>
<body>
	<?php include_template('header'); ?>

	<div class="section">
		<h2>Litter Box</h2>

		<p>
			A simple solution to upload and share files extremely quickly with
			strangers on the internet, no matter if you, or your strangers, are
			using ancient browsers from the nineties.
		</p>

		<p>
			The goal of this project is to provide a quick and super simple
			solution that allows you, and only you, to upload files to a server
			you control and make them available on the internet for other
			people. Think of it as a public <a href="https://workspace.google.com/products/drive/">Google
			Drive</a> folder that's self hosted and can be used with ancient
			browsers.
		</p>

		<p>
			This project can, and by its own design and goal, should be exposed
			to the public internet. All your uploads will by default be public,
			but uploading new content requires the usage of a
			<a href="https://en.wikipedia.org/wiki/Time-based_one-time_password">TOTP</a>,
			so you are protected against random people uploading things to your
			server.
		</p>
	</div>

	<div class="section">
		<h3>screenshots</h3>

		<?= compat_image_gallery(array(
			array('loc' => "./screenshots/home.png", 'alt' => "Home page of the application"),
			array('loc' => "./screenshots/home-filled.png", 'alt' => "Home page with every field populated"),
			array('loc' => "./screenshots/uploaded.png", 'alt' => "Successful upload page")
		)); ?>
	</div>

	<div class="section">
		<h3>deployment</h3>

		<p>
			If this project seems like the sort of thing that floats your boat,
			getting it up and running is extremely simple, and only requires
			<b>two steps</b>, all thanks to the magic of <a href="https://en.wikipedia.org/wiki/Docker_(software)">Docker</a>.
		</p>

		<p>
			First you should create a <code>docker-compose.yml</code> file with
			the following contents:
		</p>

<?php compat_code_begin('yaml'); ?>---
services:
  app:
    image: 'ghcr.io/nathanpc/litterbox:main'
    restart: unless-stopped
    ports:
      - '8001:80'
    volumes:
      - ./uploads:/app/u
    environment:
      TOTP_SECRET: 'changeme'<?php compat_code_end(); ?>

		<p>
			This will pull the image from the registry and expose the service on
			port <code>8001</code>. It will also setup a volume where the
			uploaded files will be stored. You should <b>change the
			<code>TOTP_SECRET</code> environment variable</b> to something a bit
			more secure, since this will be the key used to generate your
			one-time passwords.
		</p>

		<p>
			And after running <code>docker compose up -d</code> you should have
			the system up and running. The next step is to get the
			base32-encoded secret key for your TOTP application. To do so simply
			execute the following command:
		</p>

		<?php compat_code_begin('bash'); ?>docker compose exec app php /app/totp.php<?php compat_code_end(); ?>
	</div>

	<div class="section">
		<h3>downloads and links</h3>

		<ul>
			<li><a href="https://box.innove.link">My personal instance</a></li>
			<li><a href="https://github.com/nathanpc/litterbox/pkgs/container/litterbox">Docker image registry</a></li>
			<li><a href="https://github.com/nathanpc/litterbox">Source code</a></li>
		</ul>
	</div>

	<?php include_template('footer'); ?>
</body>
</html>
