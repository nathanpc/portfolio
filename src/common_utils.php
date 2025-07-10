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
 * Creates a proper href location for a blog post.
 *
 * @param string $date Date of the blog post in ISO8601 format.
 * @param string $slug Slug of the blog post.
 *
 * @return string Link to the blog post in question.
 */
function blog_href($date, $slug) {
	// Determine the proper separator.
	static $sep = null;
	if (is_null($sep)) {
		$sep = '_';
		foreach (apache_get_modules() as $module) {
			if ($module == 'mod_rewrite') {
				$sep = '/';
				break;
			}
		}
	}

	return href('/blog/' . $date . $sep . $slug . '/');
}

/**
 * Includes the contents of a template file from the templates folder.
 *
 * @param string $name Name of the template file without the extension.
 */
function include_template($name) {
	include __DIR__ . '/../templates/' . $name . '.php';
}

/**
 * Creates a project section card. To be used in the projects listing page.
 *
 * @param string $id   Slug of the corresponding project page.
 * @param string $name Name of the project.
 * @param string $desc A short, but lengthy, description of the project.
 */
function project_component($id, $name, $desc) {
	echo "<div id=\"$id\" class=\"project-comp\">\n";
	echo "	<h3><a href=\"" . href("/projects/$id") . "\">$name</a></h3>\n";
	echo "	<p>$desc</p>";
	echo '</div>';
}

/**
 * Creates a link section card. To be used in the links listing page.
 *
 * @param string      $name Name of the link.
 * @param string      $url  URL of the link.
 * @param string|null $desc A short description of the link.
 */
function link_component($name, $url, $desc = null) {
	echo "<div class=\"link-comp\">\n";
	echo "	<a href=\"$url\">$name</a>\n";
	if (!is_null($desc))
		echo "	&ndash; <span class=\"desc\">$desc</span>";
	echo '</div>';
}
