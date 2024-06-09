<?php
require_once __DIR__ . '/../templates/includes.php';
require_once __DIR__ . '/../src/blog.php';

// Get the blog post.
$post = BlogPost::FromRequest();

// Ensure that the last modified date displayed is of the post's file.
$last_modified = null;
if (!is_null($post))
	$last_modified = $post->last_modified;

// Fix the breadcrumbs bar.
$crumbs = array('blog' => '/blog');
if (!is_null($post)) {
	$crumbs = array(
		'blog' => '/blog',
		$post->slug => $post->permalink()
	);
}

// Render the DOCTYPE template.
include_once __DIR__ . '/../templates/doctype.php';
?>
<html>
<head>
	<title><?= !is_null($post) ? $post->meta('title') :
		'Post not found' ?></title>
	
	<?php include_once __DIR__ . '/../templates/head.php'; ?>
</head>
<body>
	<?php include_once __DIR__ . '/../templates/header.php'; ?>

	<?php if (!is_null($post)) { ?>
		<!-- Blog post header. -->
		<div id="blog-post" class="section">
			<h2><?= $post->meta('title') ?>
			<a href="<?= $post->permalink() ?>">#</a></h2>
			<div id="published-date"><?= $post->published_date() ?></div>
		</div>
		
		<?= $post->content() ?>
	<?php } else { ?>
		<?php http_response_code(404); ?>
		<div class="section">
			<h2>Not found</h2>
	
			<p>Sorry but we were not able to find the blog post in question.</p>
	
			<p><b>TODO: </b>Put picture of a sad cat here.</p>
		</div>
	<?php } ?>
	
	<?php include_once __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
