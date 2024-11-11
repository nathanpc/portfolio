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
function breadcrumbs(array $crumbs): string {
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
 * Builds a breadcrumbs structure from a Fantastique page object.
 *
 * @return array Breadcrumbs structure.
 *
 * @see breadcrumbs
 */
function breadcrumbs_page(\Fantastique\Page $page): array {
	$crumbs = array();
	$paths = array();

	// Build the crumbs from the requested path.
	foreach (explode('/', $page->path) as $path) {
		$paths[] = $path;
		if (!empty($path))
			$crumbs[htmlentities($path)] = implode('/', $paths);
	}

	// Include the file if it's not an index.html.
	if ($page->filename != 'index.html') {
		$name = preg_replace('/\.[^.]+$/', '', $page->filename);
		$crumbs[htmlentities($name)] = implode('/', $paths) .
			"/{$page->filename}";
	}

	// Ensure this works for the index page.
	if (count($crumbs) == 0)
		$crumbs['index'] = null;

	return $crumbs;
}
