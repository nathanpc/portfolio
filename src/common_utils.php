<?php
/**
 * common_utils.php
 * Common utility functions that make the work of building a website a bit more
 * pleasurable.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

/**
 * Creates a proper href location based on our project's root path.
 *
 * @param string $loc Location as if the resource was in the root of the server.
 *
 * @return string Transposed location of the resource.
 */
function href($loc) {
	return $loc;
}

/**
 * Includes the contents of a template file from the templates folder.
 *
 * @param string $name Name of the template file without the extension.
 */
function include_template($name) {
	include __DIR__ . '/../templates/' . $name . '.php';
}
