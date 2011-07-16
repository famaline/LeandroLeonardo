<div class="produto-wrapper">
<?php if(isset($product)) {
  $price = number_format($product['price'], 2, ',', '.');
  $special_price = number_format($product['special_price'], 2, ',', '.');
  $image = RenderHelpers::get_post_image($product['ID']);
}
?>
  <table class="produto" cellspacing="1" cellpadding="0">
    <tr>
      <td class="produto-imagem"><img src="<?php echo $image -> guid ?>" class="product-image" border=0/></td><td class="produto-bar">b</td>
    </tr>
  </table>
  <div class="produto-info">
    <div class="prod-tit"><?php echo $product['post_title']?></div>
    <div class="prod-de">R$ <?php echo $price?></div>
    por <div class="prod-por">R$ <?php echo $special_price?></div>
    <div class="prod-button-wrapper"><input type="button" class="buy-submit" value="COMPRAR"/></div>
  </div>
</div>