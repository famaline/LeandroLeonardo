 <?php
 $index = 0;
  
 foreach((array)$product_list as $row) {
   $index = $index + 1;
   $product_new = new Produto($row);
   $resto  = $index % 4;
   $produtos[$index] = $product_new;
   
   //dividido por 4 ou final do arquivo
   if ($resto == 0 or $index==count($product_list) ){
      echo "<tr class=\"galeria-produtos\">";      
      foreach((array)$produtos as $product) {
      echo "<td>";
        require('./wp-content/plugins/llrenders/galeria_part.php');
     echo "</td>";  
      }  
      echo "</tr>";
      $produtos = '';
    }
  }
  
  ?>