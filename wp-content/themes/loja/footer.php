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
<table id="rodape" width="1004" cellspacing="0">
	<tr style="background-color: #e5e5e5">
    <td id="aceitamos">Aceitamos:</td>
    <td id="pgto">&nbsp;</td>
    <td id="texto"><?php Renders::render_content('rodape', 'Por favor, crie uma página cujo nome seja "rodape" e grave o conteúdo do rodapé lá')?></td>
    <td id="redes-sociais">
      <a href="http://calcadosdiro.blogspot.com/" target="_blank"><?php Renders::render_image('footer/logo_blog.gif', array('width' => 16, 'height' => 16, 'border' => 0));?></a>
      <a href="http://www.facebook.com/profile.php?id=100001737159103" target="_blank"><?php Renders::render_image('footer/logo_facebook.gif', array('width' => 16, 'height' => 16, 'style' => 'margin-left:5px;', 'border' => 0));?></a>
      <a href="http://twitter.com/Dirocalcados" target="_blank"><?php Renders::render_image('footer/logo_twitter.gif', array('width' => 16, 'height' => 16, 'style' => 'margin-left:5px;', 'border' => 0));?></a>
      <a href="http://www.orkut.com.br/Main#Profile?uid=13310873658463652765" target="_blank"><?php Renders::render_image('footer/logo_orkut.gif', array('width' => 16, 'height' => 16, 'style' => 'margin-left:5px;', 'border' => 0));?></a>
    </td>
  </tr>
</table>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</div><!-- #wrapper -->
</center>
</body>
</html>
