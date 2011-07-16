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
<script>
var Loja = {
  get_bloginfo: function(what) {
    var values = {'url': '<?php echo get_bloginfo('url')?>'};
    
    return values[what];
  }
};
</script>
</head>

<body <?php body_class(); ?>>
<center>
<div id="wrapper" class="hfeed">
	<div id="header">
    <div id="linha_top"></div>
    <div id="linha_media">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td height="80" valign="top">
          	<table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="347">&nbsp;</td>
                <td valign="top">
                  <table width="100%" cellspacing="0" cellpadding="0">
                    <tr height="18">
                      <td align="right" class="data" style="padding-right: 15px;"><?php Renders::render_now();?></td>
                    </tr>
                    <tr>
                      <td>
                      	<table width="100%" cellspacing="0" cellpadding="0">
                          <tr>
                            <td valign="top" width="341"><div id="cabecalho_msg">Teste</div></td>
                            <td width="304" align="right" valign="top" id="search-area" style="padding-right: 15px;"><?php get_search_form(); ?></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td height="26" align="center">
            <table id="menu">
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0">
                    <tr>
                      <td><?php Renders::render_menu_link('home', 'Home', '/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('missao', 'Missão', '/missao/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('produtos', 'Produtos', '/products-page/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('agenda', 'Eventos', '/events/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('amigos', 'Amigos', '/amigos-diro/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('localizacao', 'Localização', '/localizacao/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('contato', 'Contato', '/contato/');?></td><td class="menu-separador">|</td>
                      <td><?php Renders::render_menu_link('fechar', 'Fechar Pedido', '/products-page/checkout/');?></td>
                    </tr>
                  </table>
                <td>
              <tr>
            </table>
          </td>
        </tr>
      </table>
    </div><!-- #linha_media -->
	</div><!-- hearder -->
	<div id="main">