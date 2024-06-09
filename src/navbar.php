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
 * @param $loc     Location reference. Passed through href() if beings with /.
 * @param $classes HTML classes associated with the element.
 *
 * @return Navigation bar item element.
 */
function nav_item(string $label, string $loc, string $classes = ''): string {
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
 * @return Navigation bar spacer element.
 */
function nav_spacer(): string {
	return '<span class="spacer">|</span>';
}

/**
 * Builds up an entire navigation bar.
 *
 * @param $items Associative array with label and href of an item.
 *
 * @return Navigation bar elements. Should be placed inside a container.
 */
function navbar(array $items): string {
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
