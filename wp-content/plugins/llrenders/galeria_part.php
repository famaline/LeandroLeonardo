<div class="produto-wrapper">
<?php 
if(isset($product)):
  $price = number_format($product -> getPrice(), 2, ',', '.');
  $special_price = number_format($product -> getSpecialPrice(), 2, ',', '.');
  $slug = $product -> getSlug();
  $id = $product -> getID();
  $title = $product -> getTitle();
?>
  <table class="produto" cellspacing="1" cellpadding="0">
    <tr>
      <td class="produto-imagem" onclick="LLRenders.showProduct('<?php echo $categoria?>', '<?php echo $slug ?>')">
        <img src="<?php echo wpsc_the_product_thumbnail(160, 160, $id, 'products-page' ) ?>" class="product-image" border=0/>
      </td>
      <td class="produto-bar" valign="top" align="center">
        <?php Renders::render_image('galeria/cores.png', array('width'=>22, 'heigth'=>42))?>
        <?php Renders::render_image('galeria/seta-cima.png', array('width'=>12, 'heigth'=>7))?>
        <div style="height: 98px; margin-bottom: -16px;">
          <div style="border:solid 1px #FFF;width: 12px; height: 12px; background-color: #e3b9a3; margin-top: 5px;"></div>
          <div style="border:solid 1px #FFF;width: 12px; height: 12px; background-color: #945f33; margin-top: 5px;"></div>
          <div style="border:solid 1px #FFF;width: 12px; height: 12px; background-color: #000; margin-top: 5px;"></div>
        </div>
        <?php Renders::render_image('galeria/seta-baixo.png', array('width'=>12, 'heigth'=>7))?>
      </td>
    </tr>
  </table>
  <div class="produto-info">
    <div class="prod-tit" onclick="LLRenders.showProduct('<?php echo $categoria?>', '<?php echo $slug?>')"><?php echo $title?></div>
    <?php if($product -> isPromotional()): ?>
      <div class="prod-de" onclick="LLRenders.showProduct('<?php echo $categoria?>', '<?php echo $slug?>')">R$ <?php echo $price?></div>
      por <div class="prod-por" onclick="LLRenders.showProduct('<?php echo $categoria?>', '<?php echo $slug?>')">R$ <?php echo $special_price?></div>
    <?php else:?>
      <div class="prod-por" onclick="LLRenders.showProduct('<?php echo $categoria?>', '<?php echo $slug?>')">R$ <?php echo $price?></div>
    <?php endif?>
  </div>
  <div class="prod-button-wrapper"><input type="button" class="buy-submit" value="COMPRAR"/><?php wpsc_add_to_cart_button($id)?></div>
</div>
<?php
endif
?>