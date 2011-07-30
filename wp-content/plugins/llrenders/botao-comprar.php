<?php
if(gettype($product) != 'object') {
  $product = Produto::findById($product);
}

$corVariation = Variation::findByProduct($product, array('slug'=>'cor'));
if(count($corVariation) > 0) {
  $variationCor = $corVariation[0];
  $cores = $corVariation[0] -> getChildren();
}

$tamanhoVariation = Variation::findByProduct($product, array('slug'=>'tamanho'));
if(count($tamanhoVariation) > 0) {
  $variationTamanho = $tamanhoVariation[0];
  $tamanhos = $tamanhoVariation[0] -> getChildren();
}
?>
<form onsubmit='submitLLform(this, "<?php echo $categoria ?>");return false;' action='' method='post'>
<?php if(isset($cores) && isset($tamanhos)) { ?>
<table cellspacing="0" cellpadding="0" title="Escolha uma variação" style="font-size: 10px; color: #777; cursor:pointer; margin-bottom:5px;margin-top:-5px;">
<?php if(isset($cores)) { ?>
  <tr onclick="LLRenders.chooseVariation('color', this);">
    <td width="35">cor:</td>
    <td>
      <table class="variations-color-chosen">
        <tr>
          <td><div style="background-color: #CCC;margin: 2px 0 0 -5px;" class="caixa-cor selecionado"></div></td><td><div class="color-name">--</div></td>
        </tr>
      </table>
    </td>
  </tr>
<?php } 
if(isset($tamanhos)) {
?>
  <tr onclick="LLRenders.chooseVariation('size', this);">
    <td width="35">tam.:</td><td><div class="tamanho-name">--</div></td>
  </tr>
<?php }?>
</table>
<?php
} else {
  echo '<div class="produto-wrapper-spacer"></div>';
}

 if(isset($cores)) { ?>
<div class="variations-color-chooser-div" style="display: none;background-color: #FFFFFF;border: 1px solid #777777;margin-left: 40px;margin-top: -25px;padding: 5px 10px;position: absolute;">
  <table cellpadding="0" cellspacing="0">
<?php foreach($cores as $cor): ?>
    <tr class="variations-color-chooser" onclick="LLRenders.chooseColor({'parentId':<?php echo $variationCor->getID()?>,'id': <?php echo $cor->getID()?>,'hexa':'<?php echo $cor -> getDescription() ?>','name':'<?php echo $cor -> getName() ?>'}, this);">
      <td width="15"><div style="background-color: #<?php echo $cor -> getDescription() ?>;margin: 2px 0 0 -5px;" class="caixa-cor"></div></td><td><?php echo $cor -> getName() ?></td>
    </tr>
<?php endforeach ?>
  </table>
</div>
<?php } ?>
<div class="variations-size-chooser-div" style="background-color: #FFFFFF;
    display: none;
    border: 1px solid #777777;
    font-size: 10px;
    margin-left: 40px;
    margin-top: -10px;
    padding: 5px 10px;
    position: absolute;
    width: 65px;">
<?php if(isset($tamanhoVariation)) { 
  foreach($tamanhos as $tamanho) {
?>
<span style="cursor:pointer" onclick="LLRenders.chooseSize({'parentId':<?php echo $variationTamanho->getID()?>,'id': <?php echo $tamanho -> getID()?>,'size':'<?php echo $tamanho -> getName() ?>'}, this)"><?php echo $tamanho -> getName() ?></span>
<?php 
  }
}?>
</div>
<?php if(isset($variationTamanho)) { ?>
<input type="hidden" name="variation[<?php echo $variationTamanho->getID()?>]" value=""/>
<?php
}
if(isset($variationCor)) { ?>
<input type="hidden" name="variation[<?php echo $variationCor->getID()?>]" value=""/>
<?php
}
?>
  <input type='hidden' name='wpsc_ajax_action' value='add_to_cart' />
  <input type='hidden' name='product_id' value='<?php echo $product-> getID()?>' />
  <input type='hidden' name='item' value='<?php echo $product-> getID()?>' />
  <input type='submit' id='product__submit_button' class='wpsc_buy_button' name='Buy' value='COMPRAR' />
</form>