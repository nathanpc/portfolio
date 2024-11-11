<div id="header">
	<!-- Title header block. -->
	<div id="title-head">
		<h1>Nathan Campos</h1>
		<?= breadcrumbs(breadcrumbs_page($this)); ?>
	</div>

	<!-- Navigation bar. -->
	<div id="navbar">
		<?= navbar(array(
			'index' => '/',
			'projects' => '/projects',
			'blog' => '/blog',
			'work' => '//innoveworkshop.com/',
			'contact' => '/contact'
		)); ?>
	</div>

	<hr>
</div>

<div id="content">
