<?php
get_header(); ?>
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
            <td><?php Renders::render_image('headers/fern.jpg', array('width' => '300', 'height' => '50'))?></td>
          </tr>
          <tr>
            <td>bla</td>
          </tr>
        </table>
      </div>
		</div>
<?php get_footer(); ?>
