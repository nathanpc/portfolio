<?php
/**
 * PortfolioPage.php
 * Helps out when building the pages of the website.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

namespace Portfolio;

use Fantastique\Page;
use Fantastique\Exceptions\Exception;

/**
 * A custom Page builder that contains some specific things related to our
 * website's pages.
 */
class PortfolioPage extends Page {
	public int $last_modified;

	/**
	 * Constructs a page builder.
	 *
	 * @throws Exception If anything unexpected happens.
	 */
	public function __construct(string $base_path, string $source) {
		parent::__construct($base_path, $source);
		$this->set_last_modified();

		// Add page to sitemap.
		Sitemap::add_page($this);
	}

	/**
	 * Gets the last modified date from the source file and stores it.
	 *
	 * @throws Exception If anything unexpected happens.
	 */
	public function set_last_modified(): void {
		$this->last_modified = filemtime($this->source);
		if ($this->last_modified === false) {
			throw new Exception('Could not get the last modified date of the ' .
				'source file');
		}
	}
}
