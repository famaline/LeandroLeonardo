<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

	</div><!-- #main -->
</div><!-- #wrapper -->
<table id="rodape" width="1004" cellspacing="0">
	<tr><td height="30" style="background-color: #CCC"><img/></td></tr>
</table>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</center>
</body>
</html>
