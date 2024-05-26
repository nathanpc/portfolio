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
 * @param $loc Location as if the resource was in the root of the server.
 * 
 * @return Transposed location of the resource.
 */
function href(string $loc): string {
	return $loc;
}

/**
 * Builds up an HTML element that makes it safe to publicly share an email
 * address on the internet. This will only keep you safe from the shittiest of
 * spam crawlers.
 *
 * @param $email Email to be "machine-obfuscated".
 *
 * @return A safer way to share an email on the open web.
 */
function safe_email(string $email): string {
	$parts = explode('@', $email, 2);
	return "<a class=\"email\" href=\"mailto:$email\">{$parts[0]} [at] " .
		"{$parts[1]}</a>";
}

/**
 * Checks if we are in debug mode.
 *
 * @return TRUE if the debug URL parameter is set to a truthful value.
 */
function is_debug(): bool {
	return isset($_GET['debug']) ? (bool)$_GET['debug'] : false;
}
