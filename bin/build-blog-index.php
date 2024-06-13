#!/usr/bin/env php
<?php
/**
 * build-blog-index.php
 * Builds up the list of blog posts and caches it.
 * 
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/../src/blog.php';

/**
 * Gets a list of our blog posts in a structured format.
 *
 * @return array List of blog posts.
 */
function get_post_list(): array {
	// Build up the files array.
	$files = array();
	foreach (glob(realpath(__DIR__ . '/../blog') . '/*.php') as $fpath) {
		$parts = preg_split('/[\._]+/', basename($fpath));
		array_push($files, array(
			'path' => $fpath,
			'date' => $parts[0],
			'slug' => $parts[1]
		));
	}
	$files = array_reverse($files);

	// Build up the posts array.
	$posts = array();
	foreach ($files as $file) {
		array_push($posts,
			BlogPost::FromDateSlug($file['date'], $file['slug']));
	}

	return $posts;
}

/**
 * Builds a JSON array from a list of posts.
 *
 * @param array $posts List of posts.
 * 
 * @return array JSON representation of the posts list.
 */
function build_json(array $posts): array {
	$json = array('length' => count($posts), 'posts' => array());

	for ($i = 0; $i < count($posts); $i++) {
		// Ensure we have an environment for the post to inherit.
		$GLOBALS['_GET'] = array(
			'date' => $posts[$i]->published_date(),
			'slug' => $posts[$i]->slug
		);

		// Convert the post's metadata into JSON.
		$arr = $posts[$i]->as_array();
		echo "[$i/{$json['length']}] {$arr['published_date']} " .
			"{$arr['title']}\n";

		array_push($json['posts'], $arr);
	}

	return $json;
}

// Build post object index.
echo "Building blog post object index...\n";
$posts = get_post_list();

// Convert the object index into an associative array that's JSON-friendly.
echo "Reading post contents and gathering metadata...\n";
$posts_json = build_json($posts);

// Save the gathered data to a JSON cache file.
echo "Saving index to JSON cache file...\n";
file_put_contents(__DIR__ . '/../blog_cache.json',
	json_encode($posts_json, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));

echo "Done.\n";
