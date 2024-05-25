<?php
/**
 * navbar.php
 * Utilities for building the navigation bar of web pages.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/common_utils.php';

/**
 * Builds up a navigation bar item.
 *
 * @param $label   Item label.
 * @param $loc     Location reference. WARNING: Will be passed to href().
 * @param $classes HTML classes associated with the element.
 *
 * @return Navigation bar item element.
 */
function nav_item(string $label, string $loc, string $classes = ''): string {
	# Build up the classes HTML property.
	$class_html = "class=\"item $classes\"";
	if (empty($classes))
		$class_html = 'class="item"';

	return "<span $class_html><a href=\"" . href($loc) . "\">$label</a></span>";
}
