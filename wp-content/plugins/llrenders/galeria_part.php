<div class="produto-wrapper">
<?php if(isset($product)) {?>
  <table class="produto" cellspacing="1" cellpadding="0">
    <tr>
      <td class="produto-imagem">[img]</td><td class="produto-bar">b</td>
    </tr>
  </table>
  <div class="produto-info">
    <div class="prod-tit"><?php echo $product['post_title']?></div>
    <div class="prod-de">R$ <?php echo $product['price']?></div>
    por <div class="prod-por">R$ <?php echo $product['special_price']?></div>
    <div class="prod-button-wrapper"><input type="button" value="COMPRAR"/></div>
  </div>
<?php }?>
</div>