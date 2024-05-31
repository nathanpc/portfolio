<?php
// Render the page header.
require_once __DIR__ . '/../templates/templates.php';
template_head();

/**
 * Builds the blog post file path.
 *
 * @param $date Date when the blog post was created.
 * @param $slug Blog post slug.
 *
 * @return Possible path to the blog post source file or null if the supplied
 *         parameters are invalid.
 */
function get_post_path(string $date = null, string $slug = null): string|null {
	$date = $date ?? $_GET['date'];
	$slug = $slug ?? $_GET['slug'];

	// Sanitize inputs.
	$safe_date = preg_replace('/[^0-9\-]/', '', $date);
	$safe_slug = preg_replace('/[^0-9a-zA-Z\-_]/', '', $slug);

	// Ensure we always fail when someone tries to be cleaver.
	if (($date != $safe_date) || ($slug != $safe_slug))
		return null;

	// Check if the file actually exists.
	$fpath = __DIR__ . "/../blog/{$safe_date}_{$safe_slug}.php";
	if (!file_exists($fpath))
		return null;

	return $fpath;
}

/**
 * Gets the requested blog post structure.
 *
 * @return Associative array with the information and contents of the blog post.
 */
function get_blog_post(): array|null {
	// Get the post's path.
	$path = get_post_path();
	if (is_null($path))
		return null;

	// Load and buffer the contents of the blog post.
	ob_start();
	include_once($path);
	$post['content'] = ob_get_contents();
	$post['date'] = date_create(preg_replace('/[^0-9\-]/', '', $_GET['date']));
	ob_end_clean();

	return $post;
}

// Get the blog post.
$post = get_blog_post();
if (is_null($post)) {
	// Looks like we were unable to find the blog post in question.
	http_response_code(404);
?>
	<div class="section">
		<h2>Not found</h2>

		<p>Sorry but we were not able to find the blog post in question.</p>

		<p><b>TODO: </b>Put picture of a sad cat here.</p>
	</div>
<?php
	template_footer();
	exit(1);
}

// Render the requested blog post.
?>

<!-- Blog post header. -->
<div id="blog-post" class="section">
	<h2><?= $post['title'] ?></h2>
	<div class="published">
		<?= date('Y-m-d', $post['date']->getTimestamp()) ?>
	</div>
</div>

<?php
// Render the blog post.
echo $post['content'];

// Render the page footer.
template_footer();
?>
