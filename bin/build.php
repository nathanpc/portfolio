<?php
/**
 * build.php
 * Builds the static website.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Fantastique\Builder;
use Fantastique\Page;

// Create the builder.
$root = __DIR__ . '/..';
$builder = new Builder("$root/site", "$root/build");

// Copy static files.
$builder->copy_static("$root/static");

// Make the error pages.
$builder->render_folder("$root/site/errors");

// Create the main website pages.
$builder->render_folder("$root/site", false, ['blog.php']);
