<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
        <div>
          <table border="0" cellspacing="0" cellpadding="0" width="120" height="100" align="top">
            <tr>
             <td id="search-menu" align="left" valign="top">&nbsp;
               <table id="search-type-table">
                 <tbody>
                   <tr>
                     <td>
                      <?php require('search_types.php');?>
                    </td>    
                  </tr>  
                <tbody>  
              </table> 
             </td>
             <td id="search-content" align="left" valign="top">
               <table border="0" cellspacing="8" cellpadding="8" width="900" height="302" id="search-content-table">
                 <tbody>
                   <tr>
                   
                    <?php
                     // take search terms and escape them
                     $s = $wpdb->escape(stripslashes($wp_query->query_vars['s']));
                     $product_list = Produto::search($s);

                     if (!$product_list) {
                       echo "<h2 class='entry-title' >Nenhum produto encontrado com o termo: ".$s."</h2>";
                     }
                     else {
                       echo "<h2 class='entry-title' >Resultado da pesquisa com o termo: ".$s."</h2>";
                       echo "<p> Total de resultados= ".count($product_list)."<p>";
                     }
                   ?>
               
                   </tr>
                   <tr>
                     <td>
                       <?php require('search_itens.php');?>
                     </td>
                   </tr> 
                 </tbody>
               </table>
             </td>
            </tr>
          </table>
        </div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
