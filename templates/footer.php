<?php
/**
 * @param int [$last_modified] Document's last modified UNIX timestamp.
 */
?>
</div>

<div id="footer">
	<hr>
	<div class="copyright">
		Nathan Campos &#169; <?= '2024-' . date('Y') ?>
	</div>
	<div class="last-modified">
		Last modified: <?= date('Y-m-d H:i', isset($last_modified) ?
			$last_modified : getlastmod()) ?>
	</div>
</div>
