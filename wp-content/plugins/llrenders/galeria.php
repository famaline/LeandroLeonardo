  <table class="galeria" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40" valign="top"><?php Renders::render_image('galeria/left-on.png', array('width'=>40, 'heigth'=>163))?></td>
      <td valign="top">
        <?php for($i=0; $i < $num_exibir; $i++) {
          $product = (count($products) - 1) <= $i? $products[$i] : null;
          echo Renders::render_galeria_part($product);
        }?>
      </td>
      <td width="40" valign="top"><?php Renders::render_image('galeria/right-on.png', array('width'=>40, 'heigth'=>163))?></td>
    </tr>
  </table>