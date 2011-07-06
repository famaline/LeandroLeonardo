<?php
get_header(); ?>
		<div id="container">
			<div id="content" role="main">
			<?php Renders::render_destaque(1, function($a,$b){?>
				Usando um template como parâmetro: <?php echo $a?><?php echo $b?>
			<?php });?>
			<?php Renders::render_destaque(2);?>
			</div>
		</div>
<?php get_footer(); ?>
