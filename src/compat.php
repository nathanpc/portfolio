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
 * @return bool TRUE if the browser visiting us is console-based.
 */
function compat_isconsole(): bool {
	global $browser_info;
	return ($browser_info['browser'] == 'Lynx') ||
		($browser_info['browser'] == 'w3m');
}

/**
 * Checks if the browser that is requesting us is based on WebKit. This includes
 * the Blink engine.
 *
 * @return bool TRUE if the browser visiting us is WebKit-based.
 */
function compat_iswebkit(): bool {
	global $browser_info;
	return ($browser_info['renderingengine_name'] == 'WebKit') ||
		($browser_info['renderingengine_name'] == 'Blink');
}

/**
 * Checks if the device that is requesting us is of the mobile type (smartphone
 * or tablet).
 *
 * @return bool TRUE if the browser visiting us is WebKit-based.
 */
function compat_ismobile(): bool {
	global $browser_info;
	return (bool)$browser_info['ismobiledevice'];
}

/**
 * Generates a compatible image for an ancient browser.
 *
 * @param string $loc   Location of an image relative to the public folder.
 * @param string $alt   Image caption.
 * @param array  $props Associative array of additional HTML properties.
 * @param bool   $link  Include link to the original file.
 *
 * @return string HTML image element tailored to the requesting device.
 */
function compat_image(string $loc, string $alt, array $props = [],
					  bool $link = false): string {
	$img_loc = href($loc);
	// TODO: Convert the image location for super old browsers.

	// Build up HTML properties.
	$props_html = '';
	foreach ($props as $key => $value)
		$props_html .= "$key=\"$value\" ";

	// Get the final HTML element.
	$html = "<img src=\"$img_loc\" alt=\"$alt\" $props_html>";
	if ($link)
		return "<a href=\"$img_loc\">$html</a>";
	return $html;
}

/**
 * Creates an image gallery that's compatible with all sorts of different
 * browsers.
 *
 * @param array $images List of images containing 'loc' and 'alt' fields.
 * 
 * @return string HTML image gallery tailored to the requesting device.
 */
function compat_image_gallery(array $images): string {
	$wrap_point = compat_ismobile() ? 2 : 3;
	$html = "<table class=\"image-gallery\">\n";

	// Populate with image elements.
	for ($i = 0; $i < count($images); $i++) {
		$img = $images[$i];

		// Add a table row for every 3 images.
		if (($i % $wrap_point) == 0) {
			if ($i != 0)
				$html .= "</tr>\n";
			$html .= "<tr>\n";
		}

		$html .= "<td valign=\"top\">\n" . compat_image($img['loc'],
			$img['alt'], [], true) . "\n<br>\n<div class=\"caption\">" .
			"{$img['alt']}</div>\n</td>";
	}

	$html .= "</tr>\n</table>";
	return $html;
}

/**
 * Placed at the beginning of a code block in order to buffer its output and
 * allow for the insertion of syntax highlighting on browsers that support it.
 * 
 * @param string $lang Programming language code for syntax highlighting.
 */
function compat_code_begin(string $lang = null) {
	echo "<pre class=\"code-block\" width=\"600\"><code>";
	ob_start();
}

/**
 * Placed at the end of a code block to print its buffered output and allow for
 * the insertion of syntax highlighting on browsers that support it.
 */
function compat_code_end() {
	echo htmlentities(ob_get_clean());
	echo "</code></pre>";
}
