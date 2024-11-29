<?php
/**
 * Sitemap.php
 * Handles the creation of a proper sitemap for the website.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

namespace Portfolio;

use DOMDocument;

/**
 * Handles the creation of a proper sitemap for the website.
 */
class Sitemap {
	private static array $pages = array();
	private string $base_url;

	/**
	 * Constructs a new sitemap generator object.
	 *
	 * @param string $base_url Base URL of the website.
	 */
	public function __construct(string $base_url) {
		$this->base_url = $base_url;
	}

	/**
	 * Adds a page to the sitemap.
	 *
	 * @param PortfolioPage $page     Page to be added to the sitemap.
	 * @param string        $changes  Frequency in which this page gets changed.
	 * @param float         $priority Relative priority of the page.
	 */
	public static function add_page(PortfolioPage $page,
	                                string $changes = "monthly",
	                                float $priority = 0.5): void {
		self::$pages[] = array(
			"page" => $page,
			"changefreq" => $changes,
			"priority" => $priority
		);
	}

	/**
	 * Builds up the sitemap XML document.
	 *
	 * @return DOMDocument Sitemap in XML document format.
	 * @throws \DOMException
	 */
	public function build_xml(): DOMDocument {
		// Setup DOM.
		$dom = new DOMDocument('1.0', 'utf-8');
		$dom->formatOutput = true;
		$dom->preserveWhiteSpace = true;

		// Create root element.
		$root = $dom->createElement('urlset');
		$root->setAttribute('xmlns',
			'http://www.sitemaps.org/schemas/sitemap/0.9');
		$dom->appendChild($root);

		// Build URL list.
		foreach (self::$pages as $sitepage) {
			// Create page element.
			$page = $sitepage['page'];
			$elem = $dom->createElement('url');

			// Populate page element.
			$elem->appendChild($dom->createElement('loc',
				$this->build_loc($page)));
			$elem->appendChild($dom->createElement('lastmod',
				date('Y-m-d', $page->last_modified)));
			$elem->appendChild($dom->createElement('changefreq',
				$sitepage['changefreq']));
			$elem->appendChild($dom->createElement('priority',
				$sitepage['priority']));

			// Append page to sitemap.
			$root->appendChild($elem);
		}

		return $dom;
	}

	/**
	 * Builds up a correct URL location for the sitemap.
	 *
	 * @param PortfolioPage $page Page that was rendered.
	 *
	 * @return string Cleaned location URL.
	 */
	protected function build_loc(PortfolioPage $page): string {
		// Build up the location path.
		$path = $page->path;
		if ($page->filename !== 'index.html')
			$path .= "/$page->filename";

		// Clean up the location path if needed.
		$path = preg_replace('/\/\//', '', $path);

		return $this->base_url . $path;
	}
}
