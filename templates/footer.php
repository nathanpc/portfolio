<?php
/**
 * footer.php
 * Template for the footer of every webpage on our website.
 *
 * @author Nathan Campos <nathan@innoveworkshop.com>
 */

require_once __DIR__ . '/../src/common_utils.php';
require_once __DIR__ . '/../src/compat.php';

/**
 * Footer page template.
 *
 * @param $props Customizable properties of the template.
 */
function template_footer(array $props = array()) {
	$props = array_merge(array(
	), $props);

?>
		</div>

		<div id="footer">
			<hr>
			<div class="copyright">
				Nathan Campos &#169; <?= '2024-' . date('Y') ?>
			</div>
			<div class="last-modified">
				Last modified: <?= date('Y-m-d H:i', getlastmod()) ?>
			</div>
		</div>

		<?php if (is_debug()) { ?><pre id="debug" class="code-block" width="800"><code><?php
			print_r(get_browser(null, true));
		?></code></pre><?php }  ?>
	</body>
</html>
<?php } ?>
