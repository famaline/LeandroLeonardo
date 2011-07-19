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
        <table border="0" cellspacing="0" cellpadding="0" width="120" height="100&quot;">
        <tbody>
        <tr>
        <td style="text-align: left;" align="left">&nbsp;

          <strong>Tipo</strong>
          <a href="?s=Bota">Botas</a>
          <a href="?s=Festa">Festa</a>
          <a href="?s=Mocassim">Mocassim</a>
          <a href="?s=Peep Toe">Peep Toe</a>
          <a href="?s=Rasteira">Rasteiras</a>
          <a href="?s=Salto Alto">Salto Alto</a>
          <a href="?s=Sandália">Sandálias</a>
          <a href="?s=Sapatilha">Sapatilhas</a>
          <a href="?s=Scarpin">Scarpin</a> 
          <a href="?s=Tênis">Tênis</a>  
          <strong>Tamanho</strong>
          <a href="?s=25">25</a>
          <a href="?s=26">26</a>
          <a href="?s=27">27</a>
          <a href="?s=28">28</a>
          <a href="?s=31">31</a>
          <a href="?s=33">33</a>
          <a href="?s=34">34</a>
          <a href="?s=35">35</a>
          <a href="?s=36">36</a>
          <a href="?s=37">37</a>
          <a href="?s=38">38</a>
          <a href="?s=39">39</a>
          <a href="?s=40">40</a>
       </td>
        <td align="left">
        <table border="0" cellspacing="8" cellpadding="8" width="900" height="302">
        <tbody>
        <tr>
        <td  valign="top">
          <?php
          // take search terms and escape them
          $s = $wpdb->escape(stripslashes($wp_query->query_vars['s']));
          $product_list = Produto::search($s);
          
          if (!$product_list) {
            echo "<h2 class='entry-title' >Nenhum produto encontrado com o termo: ".$s."</h2>";
          }
          else {
            
            echo "<h2 class='entry-title' >Resultado da pesquisa com o termo: ".$s."</h2>";
            echo "<p> Total = ".count($product_list)."<p>";
            $index = 0;
            foreach((array)$product_list as $row) {
              $index = $index + 1;
              $product_simples = new Produto($row);
              
              $resto  = $index % 4;
              $produtos[$index] = $product_simples;
              //dividido por 4
              if ($resto == 0){
                foreach((array)$produtos as $product) {
                  require('./wp-content/plugins/llrenders/galeria_part.php');
                }  
                $produtos = '';
               }
               //final e não dividido por 4
              if ($resto != 0 and $index==count($product_list) ){
                  foreach((array)$produtos as $product) {
                    require('./wp-content/plugins/llrenders/galeria_part.php');
                  }
                $produtos = '';
              } 
            } 
          }

          
          ?>
          </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
