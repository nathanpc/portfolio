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
 * @param ?array $crumbs Paths contained in the breadcrumbs bar. Use NULL if it
 *                       is supposed to mimic the requested URL path.
 * 
 * @return string Breadcrumbs bar element.
 */
function breadcrumbs(?array $crumbs = null): string {
	$sep = '<span class="sep">/</span>';
	$html = "<div id=\"breadcrumbs\">\n";

	// Build the paths from the request.
	if (is_null($crumbs))
		$crumbs = breadcrumbs_fromreq();

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
function breadcrumbs_fromreq(): array {
	$url_path = strtok($_SERVER['REQUEST_URI'], '?');
	$crumbs = array();
	$paths = array();

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
