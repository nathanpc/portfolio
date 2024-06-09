<div id="header">
	<!-- Title header block. -->
	<div id="title-head">
		<h1>Nathan Campos</h1>
		<?= breadcrumbs(isset($crumbs) ? $crumbs : null); ?>
	</div>

	<!-- Navigation bar. -->
	<div id="navbar">
		<?= navbar(array(
			'index' => '/',
			'projects' => '/projects',
			'blog' => '/blog',
			'work' => $_SERVER['REQUEST_SCHEME'] . '://innoveworkshop.com/',
			'contact' => '/contact'
		)); ?>
	</div>

	<hr>
</div>

<div id="content">