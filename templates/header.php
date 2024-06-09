<div id="header">
	<!-- Title header block. -->
	<div id="title-head">
		<h1>Nathan Campos</h1>
		<div id="breadcrumbs">
			<span class="sep">/</span> <span class="label">index</span>
		</div>
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