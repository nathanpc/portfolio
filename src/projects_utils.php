<?php
/**
 * projects_utils.php
 * A collection of utilities for the projects pages.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/compat.php';

/**
 * Creates a project section card. To be used in the projects listing page.
 *
 * @param string $id   Slug of the corresponding project page.
 * @param string $name Name of the project.
 * @param string $desc A short, but lengthy, description of the project.
 */
function project_component(string $id, string $name, string $desc) {
	echo "<div id=\"$id\" class=\"project-comp\">\n";
	echo "	<h3><a href=\"" . href("/projects/$id") . "\">$name</a></h3>\n";
	echo "	<p>$desc</p>";
	echo '</div>';
}

/**
 * Gets the location of a project's image in the project's assets folder.
 *
 * @param string $id  Slug of the corresponding project page.
 * @param string $loc Location of an image relative to the project's assets
 *                    folder.
 *
 * @return string Link location of the project's image.
 */
function project_image_href(string $id, string $loc): string {
	return "/assets/projects/$id/$loc";
}

/**
 * Gets an image for the current project.
 *
 * @param string $id    Slug of the corresponding project page.
 * @param string $loc   Location of an image relative to the project's assets
 *                      folder.
 * @param string $alt   Image caption.
 * @param array  $props Associative array of additional HTML properties.
 * @param bool   $link  Include link to the original file.
 *
 * @return string HTML image element tailored to the requesting device.
 */
function project_image(string $id, string $loc, string $alt, array $props = [],
					   bool $link = false): string {
	return compat_image(project_image_href($id, $loc), $alt, $props, $link);
}

/**
 * Creates an image gallery for a project's images.
 *
 * @param string $id     Slug of the corresponding project page.
 * @param array  $images List of images containing 'loc' and 'alt' fields.
 *
 * @return string HTML image gallery tailored to the requesting device.
 */
function project_image_gallery(string $id, array $images): string {
	$reloc_images = array();

	// Relocate the images.
	foreach ($images as $img) {
		array_push($reloc_images, array(
			'loc' => project_image_href($id, $img['loc']),
			'alt' => $img['alt']
		));
	}

	return compat_image_gallery($reloc_images);
}
