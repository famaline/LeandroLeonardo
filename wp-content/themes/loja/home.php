<?php
get_header(); ?>
<?php //Renders::render_query('SELECT * FROM wp_posts WHERE post_parent = 31 and post_type = \'wpsc-product\';') ?>
		<div id="container">
			<div id="content" role="main">
        <table cellpadding="0" cellspacing="0" id="destaque">
          <tr>
            <td><?php Renders::render_destaque(1);?></td>
            <td><?php Renders::render_destaque(2);?></td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" id="lancamentos">
          <tr>
            <td><?php Renders::render_image('tit-lancamentos.png', array('width' => '133', 'height' => '22'))?></td>
          </tr>
          <tr>
            <td><?php Renders::render_galeria('lancamentos', 4)?></td>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" id="promocoes">
          <tr>
            <td><?php Renders::render_image('tit-promocoes.png', array('width' => '110', 'height' => '22'))?></td>
          </tr>
          <tr>
            <td><?php Renders::render_galeria('promocoes', 4)?></td>
          </tr>
        </table>
      </div>
		</div>
<?php get_footer(); ?>
