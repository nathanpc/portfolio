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
 * @param string $label   Item label.
 * @param string $loc     Location reference. Passed through href() if it beings
 *                        with /.
 * @param string $classes HTML classes associated with the element.
 *
 * @return string Navigation bar item element.
 */
function nav_item($label, $loc, $classes = '') {
	// Build up the classes HTML property.
	$class_html = "class=\"item $classes\"";
	if (empty($classes))
		$class_html = 'class="item"';

	// Build the href property value.
	$href_val = $loc;
	if ($loc[0] == '/')
		$href_val = href($loc);

	return "<span $class_html><a href=\"$href_val\">$label</a></span>";
}

/**
 * Spacer to be used between navigation bar items.
 *
 * @return string Navigation bar spacer element.
 */
function nav_spacer() {
	return '<span class="spacer">|</span>';
}

/**
 * Builds up an entire navigation bar.
 *
 * @param array $items Associative array with label and href of an item.
 *
 * @return string Navigation bar elements. Should be placed inside a container.
 */
function navbar($items) {
	$nav = '';
	foreach ($items as $label => $href) {
		// Add a spacer between the items if needed.
		if (!empty($nav))
			$nav .= "\n" . nav_spacer() . "\n";

		// Add the actual item.
		$nav .= nav_item($label, $href);
	}

	return $nav;
}
