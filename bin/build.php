<?php
/**
 * build.php
 * Builds the static website.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/blog.php';

use \Bramus\Ansi\Ansi;
use \Bramus\Ansi\Writers\StreamWriter;
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

use \Fantastique\Exceptions\Exception;
use \Fantastique\Builder;

/**
 * Gets a list of our blog posts and renders them all out while we are at it.
 *
 * @param string $output_path Root of the website's output folder.
 *
 * @return array List of blog posts from newest to oldest.
 *
 * @throws \Exception if the blog post lookup fails.
 */
function get_post_list(string $output_path): array {
	$posts = array();
	foreach (glob(realpath(__DIR__ . '/../blog') . '/*.php') as $fpath) {
		$blog_post = new BlogPost($fpath);
		$blog_post->content();
		$blog_post->render($output_path);
		$posts[] = $blog_post;
	}

	return array_reverse($posts);
}

/**
 * Builds up the actual static website.
 *
 * @throws Exception if something goes wrong while building the static website.
 */
function make_website(): void {
	// Create the builder.
	$root = __DIR__ . '/..';
	$output_path = "$root/build";
	$builder = new Builder("$root/site", $output_path);

	// Copy static files.
	$builder->copy_static("$root/static");

	// Build the website.
	$builder->render_folder("$root/site/errors");
	$builder->render_folder("$root/site", false, [
		'blog.php',
		'blog_post.php'
	]);

	// Build blog posts.
	$posts = get_post_list($output_path);
	$builder->render_page("$root/site/blog.php", [
		'listing' => $posts
	]);
}

// Make it!
$ansi = new Ansi(new StreamWriter('php://stdout'));
try {
	make_website();
} catch (Exception $e) {
	$ansi->color(SGR::COLOR_FG_RED)
		->text($e->getMessage())
		->lf()
		->text($e->getTraceAsString());
}
