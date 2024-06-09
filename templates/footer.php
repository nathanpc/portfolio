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
		Last modified: <?= date('Y-m-d H:i', $last_modified ?? getlastmod()) ?>
	</div>
</div>

<?php if (is_debug()) { ?>
	<!-- Debugging -->
	<pre id="debug" class="code-block" width="800"><code><?php
		print_r(get_browser(null, true));
	?></code></pre>
<?php }  ?>
