<?php
/**
 * compat.php
 * A browser compatibility layer to enable us to build a website that can be
 * viewed by the latest browsers alongside some of the oldest ones.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/../src/common_utils.php';

// Get the browser information once in order to infer it's oldness.
$browser_info = get_browser(null, true);

/**
 * Checks if the browser that is requesting us is console-based and won't be
 * capable of interpreting CSS or displaying images.
 *
 * @return TRUE if the browser visiting us is console-based.
 */
function compat_isconsole(): bool {
	global $browser_info;
	return ($browser_info['browser'] == 'Lynx') ||
		($browser_info['browser'] == 'w3m');
}

/**
 * Generates a compatible image for an ancient browser.
 *
 * @param $loc Location of an image relative to the public folder.
 *
 * @return Compatible image binary file.
 */
function compat_image(string $loc): string {
	global $browser_info;
	$img_loc = href($loc);
	// TODO: Convert the image for super old browsers.

	return $img_loc;
}

