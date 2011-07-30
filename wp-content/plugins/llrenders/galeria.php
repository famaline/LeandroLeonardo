<?php
$qtde = count($products);
$count_down = $qtde;
$first = true;
$indice = 0;

while($count_down > 0):
  $galeria_id = "galeria_" . $categoria . "_$indice";
?>
  <table class="galeria" style="display: <?php echo $first?'block':'none' ?>;" id="<?php echo $galeria_id?>" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40" valign="top">
        <?php Renders::render_image('galeria/left-on.png', array('width'=>40, 'heigth'=>163, 'style'=>'cursor:pointer', 'onclick'=>'return eventManager.fireEvent(\'previous:galeria\', {\'id\':\'' . $galeria_id . '\'})'))?>
      </td>
      <td valign="top" width="890">
        <?php for($i=$indice*$num_exibir; $i < (($indice + 1) * $num_exibir); $i++):
          $count_down -= 1;
          $product = ($i <= ($qtde - 1)) ? $products[$i] : null;
          Renders::render_galeria_part($product, $categoria);
        endfor?>
      </td>
      <td width="40" valign="top"><?php Renders::render_image('galeria/right-on.png', array('width'=>40, 'heigth'=>163, 'style'=>'cursor:pointer', 'onclick'=>'return eventManager.fireEvent(\'next:galeria\', {\'id\':\'' . $galeria_id . '\'})'))?></td>
    </tr>
  </table>
<?php
  $first = false;
  $indice++;
endwhile
?>