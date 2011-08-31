<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<script>
  eventManager.listenTo('before:submitLLform', function(json) {
    var form = json.form;
    var element = null;
    var elementName = null;
    for(var i = 0; i < form.elements.length; i++) {
      element = form.elements[i];
      elementName = element.name;

      if(elementName.match(/^variation\[\d+\]$/) && element.value == "") {
        alert("Favor escolher uma cor e tamanho");
        throw 'ABORT';
      }
    }
  });
</script>
		<div id="container">
			<div id="content" role="main">
        <div>
          <table border="0" cellspacing="0" cellpadding="0" align="top" id="search-container-table">
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
               <table border="0" cellspacing="8" cellpadding="8" id="search-content-table">
                 <tbody>
                   <tr>
                   
                    <?php
                     // take search terms and escape them
                     $s = $wpdb->escape(stripslashes($wp_query->query_vars['s']));
                     $product_list = Produto::search($s);

                     if (!$product_list) {
                       echo "<h2 class='entry-title' >Lista de Produtos</h2>";
                        echo "<p> Nenhum produto encontrado com o termo: ".$s."<p>";
                     }
                     else {
                       echo "<h2 class='entry-title' >Lista de Produtos</h2>";
                       echo "<p align='Right'> Total de resultados: ".count($product_list)."<p>";
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
