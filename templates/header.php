<div id="header">
	<!-- Title header block. -->
	<div id="title-head">
		<h1>Nathan Campos</h1>
		<?php
			require_once __DIR__ . '/../src/breadcrumbs.php';
			echo breadcrumbs(isset($crumbs) ? $crumbs : breadcrumbs_fromreq());
		?>
	</div>

	<!-- Navigation bar. -->
	<div id="navbar">
		<?php
			require_once __DIR__ . '/../src/navbar.php';
			echo navbar(array(
				'index' => '/',
				'projects' => '/projects',
				'blog' => '/blog',
				'wiki' => $_SERVER['REQUEST_SCHEME'] . '://wiki.nathancampos.me/',
				'work' => $_SERVER['REQUEST_SCHEME'] . '://innoveworkshop.com/',
				'contact' => '/contact'
			));
		?>
	</div>

	<hr>
</div>

<div id="content">
