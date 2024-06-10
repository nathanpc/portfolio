<?php
/**
 * blog.php
 * Handles everything related to the blog and its entries.
 * 
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/common_utils.php';

/**
 * Blog post abstraction.
 */
class BlogPost {
	public string $slug;
	public DateTime $date;
	public int $last_modified;
	public ?array $metadata = null;
	public ?string $content = null;
	public ?string $path = null;

	public function __construct(string $slug, DateTime $date) {
		$this->slug = $slug;
		$this->date = $date;
		$this->last_modified = $date->getTimestamp();
	}

	/**
	 * Gets a blog post object from a request.
	 *
	 * @return ?BlogPost Requested blog post object or NULL if it wasn't found.
	 */
	public static function FromRequest(): ?BlogPost {
		return self::FromDateSlug($_GET['date'], $_GET['slug']);
	}

	/**
	 * Gets a blog post object from a date and slug.
	 *
	 * @return ?BlogPost Requested blog post object or NULL if it wasn't found.
	 */
	public static function FromDateSlug(string $date, string $slug): ?BlogPost {
		// Get the file and check if it actually exists.
		$fpath = self::get_path($date, $slug);
		if (!file_exists($fpath))
			return null;

		// Build up the post object.
		$post = new self($slug, date_create($date));
		$post->set_path($fpath);

		return $post;
	}

	/**
	 * Gets the permalink to the blog post.
	 *
	 * @return string Permalink to the blog post.
	 */
	public function permalink(): string {
		return href('/blog/' . date('Y-m-d', $this->date->getTimestamp()) .
			"/{$this->slug}");
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
			// A weird post without an associated file.
			if (is_null($this->path))
				return $this->content;

			// Fetch the content and cache it.
			ob_start();
			include_once($this->path);
			$this->metadata = $post;
			$this->content = ob_get_contents();
			ob_end_clean();
		}

		return $this->content;
	}

	/**
	 * Sets the associated file path.
	 *
	 * @param string $fpath File path to be associated with this post.
	 */
	private function set_path(string $fpath) {
		$this->path = $fpath;
		$this->last_modified = filemtime($this->path);
	}

	/**
	 * Array representation of this object.
	 * 
	 * @param bool $include_content Should we also include the content?
	 *
	 * @return array Object as array.
	 */
	public function as_array(bool $include_content = false): array {
		$arr = array(
			'slug' => $this->slug,
			'published_date' => $this->published_date(),
			'last_modified_ts' => $this->last_modified,
			'path' => $this->path,
			'title' => $this->meta('title')
		);

		// Should we include the contents?
		if ($include_content)
			$arr['content'] = $this->content();

		// Include the metadata.
		$arr['metadata'] = $this->metadata;
		
		return $arr;
	}

	/**
	 * Builds the blog post file path.
	 *
	 * @param string $date Date when the blog post was created.
	 * @param string $slug Blog post slug.
	 *
	 * @return ?string Possible path to the blog post source file.
	 */
	private static function get_path(string $date, string $slug): string|null {
		// Sanitize inputs.
		$safe_date = preg_replace('/[^0-9\-]/', '', $date);
		$safe_slug = preg_replace('/[^0-9a-zA-Z\-_]/', '', $slug);

		// Ensure we always fail when someone tries to be cleaver.
		if (($date != $safe_date) || ($slug != $safe_slug))
			return null;

		return realpath(__DIR__ . "/../blog/{$safe_date}_{$safe_slug}.php");
	}
}