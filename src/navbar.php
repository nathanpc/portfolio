<?php
/**
 * navbar.php
 * Utilities for building the navigation bar of web pages.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

function nav_item(string $label, string $loc): string {
	return '<a href="' . href($loc) . "\">$label</a>";
}
