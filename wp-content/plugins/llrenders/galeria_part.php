<div class="produto-wrapper">
<?php 
if(isset($product)):
  $price = number_format($product -> getPrice(), 2, ',', '.');
  $special_price = number_format($product -> getSpecialPrice(), 2, ',', '.');
  $slug = $product -> getSlug();
  $id = $product -> getID();
  $title = $product -> getTitle();
  
  $image_src = wpsc_the_product_thumbnail(160, 160, $id, 'products-page' );
  if(empty($image_src))
    $image_src = WPSC_CORE_THEME_URL . 'wpsc-images/noimage.png';
?>
  <table class="produto" cellspacing="1" cellpadding="0">
    <tr>
      <td class="produto-imagem" onclick="LLRenders.showProduct('<?php echo $categoria?>', '<?php echo $slug ?>')">
        <img src="<?php echo $image_src ?>" class="product-image" width="160" height="160" border=0/>
      </td>
      <td class="produto-bar" valign="top" align="center">
        <?php Renders::render_image('galeria/cores.png', array('width'=>22, 'heigth'=>42))?>
        <?php Renders::render_image('galeria/seta-cima.png', array('width'=>12, 'heigth'=>7))?>
        <?php $variations = Variation::findByProduct($product, array('slug'=>'cor'));?>
        <?php 
        if(count($variations) > 0) {
          $cores = $variations[0] -> getChildren();
          
          if(count($cores) > 0) {
        ?>
        <div style="height: 98px; margin-bottom: -16px;">
          <?php foreach($cores as $cor): 
          preg_match('/[a-f0-9]{6}/i', $cor -> getDescription(), $matches)
          ?>
          <div class="caixa-cor" style="background-color: #<?php echo $matches[0] ?>;"></div>
          <?php endforeach ?>
          </div>
        <?php 
          }
        } ?>
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
  <div class="prod-button-wrapper">
    <div class="wpsc_loading_animation" style="display: none;margin-bottom: -10px;margin-top: 15px;visibility: visible;" id="loadingindicator_<?php echo $categoria?>_<?php echo $id?>">
      <img title="Loading" alt="Loading" id="loadingimage" src="<?php echo wpsc_loading_animation_url(); ?>" />
      <?php _e('Updating cart...', 'wpsc'); ?>
    </div>
    <div class="wpsc_loading_animation" style="display: none;margin-bottom: -10px;margin-top: 15px;visibility: visible;" id="adicionado_<?php echo $categoria?>_<?php echo $id?>">
      Produto adicionado ao carrinho!
    </div>
    <?php echo Renders::render_botao_comprar($product, $categoria)?>
  </div>
</div>
<?php
endif
?>