<?php
/**
 * compat.php
 * A browser compatibility layer to enable us to build a website that can be
 * viewed by the latest browsers alongside some of the oldest ones.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/common_utils.php';

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
function compat_image($loc, $alt, $props = [], $link = false) {
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
function compat_image_gallery($images) {
	$wrap_point = 3; //compat_ismobile() ? 2 : 3;
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
function compat_code_begin($lang = null) {
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
