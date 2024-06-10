<?php
require_once __DIR__ . '/../templates/includes.php';
require_once __DIR__ . '/../src/blog.php';

// Template defaults.
$post = null;
$last_modified = null;
$crumbs = array('blog' => '/blog');
$listing = !isset($_GET['date']) && !isset($_GET['slug']);

if ($listing) {
	// Get the blog listing.
	$listing = BlogPost::List();
} else {
	// Get the blog post if the user requested one.
	$post = BlogPost::FromRequest();
	if (!is_null($post)) {
		// Ensure that the last modified date displayed is of the post's file.
		$last_modified = $post->last_modified;

		// Fix the breadcrumbs bar.
		$crumbs = array(
			'blog' => '/blog',
			$post->slug => $post->permalink()
		);
	}
}

// Render the DOCTYPE template.
include_once __DIR__ . '/../templates/doctype.php';
?>
<html>

<head>
	<title><?php
			if ($listing) {
				echo "Nathan's random musings";
			} else if (!is_null($post)) {
				echo $post->meta('title');
			} else {
				echo 'Post not found';
			}
			?></title>

	<?php include_once __DIR__ . '/../templates/head.php'; ?>
</head>

<body>
	<?php include_once __DIR__ . '/../templates/header.php'; ?>

	<?php if ($listing) { ?>
		<!-- Blog listing. -->
		<?php foreach ($listing as $post_json) { ?>
			<?php $post = BlogPost::FromJSON($post_json); ?>
			<div class="post-listing">
				<span class="published-date"><?= $post->published_date() ?></span>
				<a class="title" href="<?= $post->permalink() ?>">
					<?= $post->title() ?>
				</a>
			</div>
		<?php } ?>
		<?php $post = null; ?>
	<?php } else if (!is_null($post)) { ?>
		<!-- Blog post header. -->
		<div id="blog-post" class="section">
			<h2><?= $post->title() ?>
				<a href="<?= $post->permalink() ?>">#</a>
			</h2>
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