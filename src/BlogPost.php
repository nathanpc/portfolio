<?php
/**
 * BlogPost.php
 * Handles everything related to the blog and its entries.
 * 
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

namespace Portfolio;

require_once __DIR__ . '/common_utils.php';
require_once __DIR__ . '/compat.php';

use DateTime;
use Fantastique\Exceptions\Exception;
use Fantastique\Exceptions\PathException;

/**
 * Blog post abstraction.
 */
class BlogPost extends PortfolioPage {
	public string $slug;
	public DateTime $date;
	public string $post_source;
	public ?array $metadata = null;
	public ?string $content = null;

	/**
	 * Builds up a blog post object from a source path.
	 *
	 * @param string $fpath Path to the source file of the blog post.
	 *
	 * @throws PathException if the file doesn't exist.
	 * @throws Exception if something unexpected happens.
	 */
	public function __construct(string $fpath) {
		// Get our specific parts.
		$this->post_source = $fpath;
		$parts = preg_split('/[._]+/', basename($fpath, '.php'), 2);
		$this->date = date_create($parts[0]);
		$this->slug = $parts[1];

		// Build up the Fantastique page.
		parent::__construct(__DIR__ . '/../blog', $fpath);
		$this->title = null;
		$this->path = "/blog/{$this->published_date()}";
		$this->filename = "{$this->slug}.html";

		// Do the old switcheroo with the page template.
		$this->source = realpath(__DIR__ . '/../site/blog_post.php');
	}

	/**
	 * Gets a blog post object from a date and slug.
	 *
	 * @return BlogPost Requested blog post object or NULL if it wasn't found.
	 *
	 * @throws Exception If the requested blog post wasn't found.
	 */
	public static function FromDateSlug(string $date, string $slug): BlogPost {
		// Get the file and check if it actually exists.
		$fpath = self::get_path($date, $slug);
		if (!file_exists($fpath)) {
			throw new Exception("No blog post found with date $date and slug " .
				$slug);
		}

		// Build up the post object.
		return new self($fpath);
	}

	/**
	 * Gets the permalink to the blog post.
	 *
	 * @return string Permalink to the blog post.
	 */
	public function permalink(): string {
		return $this->link_post($this->published_date(), $this->slug);
	}

	/**
	 * Gets the published date as a pretty ISO8601 string.
	 *
	 * @return string Published date in ISO8601 format.
	 */
	public function published_date(): string {
		return date('Y-m-d', $this->date->getTimestamp());
	}

	/**
	 * Get metadata information from the post.
	 *
	 * @param string $key Metadata key.
	 * 
	 * @return any Requested information.
	 */
	public function meta(string $key) {
		// Read the metadata in case we haven't cached it previously.
		if (is_null($this->metadata))
			$this->content();
	
		return $this->metadata[$key];
	}

	/**
	 * Gets the post's content.
	 *
	 * @return string The associated post's content.
	 */
	public function content(): string {
		// Check if first we need to fetch the content.
		if (is_null($this->content)) {
			// Fetch the content and cache it.
			ob_start();
			include($this->post_source);
			$this->metadata = $post;
			$this->title = $post['title'];
			$this->content = ob_get_contents();
			ob_end_clean();
		}

		return $this->content;
	}

	/**
	 * Gets the href location of an asset related to the blog post.
	 *
	 * @param string $fname Filename of the asset.
	 *
	 * @return string Location of the asset relative to the public folder.
	 */
	function asset(string $fname): string {
		return self::build_asset_loc($this->published_date(), $this->slug,
			$fname);
	}

	/**
	 * Gets an image's location that is associated with this blog post.
	 *
	 * @param string $fname Filename of the requested image.
	 * 
	 * @return string Actual location of the image based on the public folder.
	 */
	public function get_image_loc(string $fname): string {
		return self::build_asset_loc($this->published_date(), $this->slug,
			$fname);
	}

	/**
	 * Gets an assets's location that is associated with a blog post.
	 *
	 * @param string $fname Filename of the requested asset.
	 * 
	 * @return string Location of the asset relative to the public folder.
	 */
	public static function build_asset_loc(string $date, string $slug,
										   string $fname): string {
		return '/assets/blog/' . self::build_token($date, $slug) . "/$fname";
	}

	/**
	 * Gets the name used in files and folders associated with a post.
	 * 
	 * WARNING: All data passed to this function will be sanitized internatlly.
	 * The returned string should be considered safe.
	 *
	 * @param string $date Date of publishing.
	 * @param string $slug Slug name.
	 * @param bool   $fail Should we fail if someone is trying to be clever?
	 * 
	 * @return ?string Safe name associated with this post.
	 */
	public static function build_token(string $date, string $slug,
									   bool $fail = false): ?string {
		// Sanitize inputs.
		$safe_date = preg_replace('/[^0-9\-]/', '', $date);
		$safe_slug = preg_replace('/[^0-9a-zA-Z\-_]/', '', $slug);

		// Ensure we always fail when someone tries to be cleaver.
		if ($fail && (($date != $safe_date) || ($slug != $safe_slug)))
			return null;

		return "{$safe_date}_{$safe_slug}";
	}

	/**
	 * Builds the blog post file path.
	 *
	 * @param string $date Date when the blog post was created.
	 * @param string $slug Blog post slug.
	 *
	 * @return ?string Possible path to the blog post source file.
	 */
	protected static function get_path(string $date, string $slug): ?string {
		return realpath(__DIR__ . '/../blog/' .
			self::build_token($date, $slug) . '.php');
	}

	/**
	 * Generates the appropriate image element for a blog post.
	 *
	 * @param string $fname Image file name relative to the post's image folder
	 *                      (/public/assets/blog/<post_fname>).
	 * @param string $alt   Image caption.
	 * @param array  $props Associative array of additional HTML properties.
	 * @param array  $opts  Modification options.
	 *
	 * @return string HTML image element tailored to the requesting device.
	 */
	function image(string $fname, string $alt, array $props = [],
	               array $opts = []): string {
		// Merge our options with some defaults.
		$opts = array_merge(array(
			'caption' => false
		), $opts);

		// Build out the element.
		$html = "<div class=\"blog-image\">\n" .
			compat_image($this->asset($fname), $alt, $props, true) . "\n";
		if ($opts['caption'])
			$html .= "<br>\n<div class=\"caption\">$alt</div>\n";
		$html .= "</div>";

		return $html;
	}

	/**
	 * Creates an image gallery for a particular blog post.
	 *
	 * @param array $images List of images containing 'loc' and 'alt' fields.
	 *
	 * @return string HTML image gallery.
	 */
	function image_gallery(array $images): string {
		// Transpose the location of the images.
		for ($i = 0; $i < count($images); $i++) {
			$images[$i]['loc'] = $this->asset($images[$i]['loc']);
		}

		// Return the gallery element.
		return compat_image_gallery($images);
	}

	/**
	 * Gets the permalink to another blog post.
	 *
	 * @param string $date Date the post was published.
	 * @param string $slug Post's slug.
	 *
	 * @return string Blog post's link.
	 */
	function link_post(string $date, string $slug): string {
		return href("/blog/$date/$slug.html");
	}
}
