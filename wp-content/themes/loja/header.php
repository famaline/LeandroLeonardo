<?php
/**
 * O cabecalho do tema.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Loja
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<style>
#cabecalho #linha_media {
	background-color: #EFEFEF;
}

#cabecalho #cabecalho_msg {
	background-color: #AAA;
	padding: 3px;
	color: #FFF;
}
</style>
</head>

<body <?php body_class(); ?>>
<center>
<div id="wrapper" class="hfeed">
	<div id="header">
				<table id="cabecalho" width="100%" cellspacing="0">
					<tr id="linha_top"><td colspan="3" height="3" style="background-color: #CCC"><img/></td></tr>
					<tr id="linha_media">
						<td height="60" width="400">&nbsp;</td>
						<td valign="bottom" width="300"><div id="cabecalho_msg">Teste</div></td>
						<td width="304" align="right" style="padding-right: 15px;"><?php Renders::render_now();?><br/><?php get_search_form(); ?></td>
					</tr>
				</table>
		<div id="masthead">
			<div id="access" role="navigation">

            </ul>
        </div>
    </div>
				<table>
					<tr>
		                <td><?php RenderHelpers::write_menu_link('home', 'Home', '/');?></td><td>|</td>
		                <td><?php RenderHelpers::write_menu_link('contato', 'Contato', '/contato/');?></td><td>|</td>
		                <td><?php RenderHelpers::write_menu_link('missao', 'Missão', '/missao/');?></td><td>|</td>
		                <td><?php RenderHelpers::write_menu_link('agenda', 'Agenda', '/events/');?></td>
					</tr>
				</table>
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">