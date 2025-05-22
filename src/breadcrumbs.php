<?php
/**
 * breadcrumbs.php
 * Utilities for building the breadcrumbs bar of web pages.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/common_utils.php';

/**
 * Builds up the breadcrumbs bar.
 *
 * @param array $crumbs Paths contained in the breadcrumbs bar.
 *
 * @return string Breadcrumbs bar element.
 */
function breadcrumbs($crumbs) {
	$sep = '<span class="sep">/</span>';
	$html = "<div id=\"breadcrumbs\">\n";

	// Append crumbs to the element.
	foreach ($crumbs as $label => $href) {
		if (!is_null($href)) {
			$html .= " $sep <a class=\"label\" href=\"$href\">$label</a>";
		} else {
			$html .= " $sep <span class=\"label\">$label</span>";
		}
	}

	$html .= "\n</div>";
	return $html;
}

/**
 * Builds a breadcrumbs structure from the request.
 *
 * @return array Breadcrumbs structure based on the request.
 */
function breadcrumbs_fromreq() {
	$url_path = strtok($_SERVER['REQUEST_URI'], '?');
	$crumbs = array();
	$paths = array();

	// Make better crumbs for blog posts.
	if (strpos($url_path, '/blog/') === 0)
		$url_path = preg_replace('/_/', '/', $url_path);

	// Build the crumbs from the requested path.
	foreach (explode('/', $url_path) as $path) {
		array_push($paths, $path);
		if (!empty($path))
			$crumbs[htmlentities($path)] = implode('/', $paths);
	}

	// Ensure this works for the index page.
	if (count($crumbs) == 0)
		$crumbs['index'] = null;

	return $crumbs;
}
