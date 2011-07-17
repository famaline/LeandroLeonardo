  <table class="galeria" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40" valign="top"><?php Renders::render_image('galeria/left-on.png', array('width'=>40, 'heigth'=>163))?></td>
      <td valign="top">
        <?php for($i=0; $i < $num_exibir; $i++):
          $product = ($i <= (count($products) - 1)) ? $products[$i] : null;
          Renders::render_galeria_part($product, $categoria);
        endfor?>
      </td>
      <td width="40" valign="top"><?php Renders::render_image('galeria/right-on.png', array('width'=>40, 'heigth'=>163))?></td>
    </tr>
  </table>