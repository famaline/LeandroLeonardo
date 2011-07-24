<?php
if(gettype($product) != 'object') {
  $product = Produto::findById($product);
}
?>
<form onsubmit='submitLLform(this, "<?php echo $categoria ?>");return false;'  action='' method='post'>
<table cellspacing="0" cellpadding="0" title="Escolha uma variação" style="font-size: 10px; color: #777; cursor:pointer; margin-bottom:5px;margin-top:-5px;">
  <tr onclick="LLRenders.chooseVariation('color', this);">
    <td width="35">cor:</td>
    <td>
      <table class="variations-color-chosen">
        <tr>
          <td><div style="background-color: #e3b9a1;margin: 2px 0 0 -5px;" class="caixa-cor"></div></td><td>Beje</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr onclick="LLRenders.chooseVariation('size', this);">
    <td>tam.:</td><td>41</td>
  </tr>
</table>
<div class="variations-color-chooser-div" style="display: none;background-color: #FFFFFF;border: 1px solid #777777;margin-left: 40px;margin-top: -25px;padding: 5px 10px;position: absolute;">
  <table cellpadding="0" cellspacing="0">
    <tr class="variations-color-chooser" onclick="LLRenders.chooseColor({'hexa':'e3b9a1'}, this);">
      <td width="15"><div style="background-color: #e3b9a1;margin: 2px 0 0 -5px;" class="caixa-cor"></div></td><td>Beje</td>
    </tr>
    <tr class="variations-color-chooser" onclick="LLRenders.chooseColor({'hexa':'000'}, this);">
      <td><div style="background-color: #000;margin: 2px 0 0 -5px;" class="caixa-cor"></div></td><td>Preto</td>
    </tr>
    <tr class="variations-color-chooser" onclick="LLRenders.chooseColor({'hexa':'945F33'}, this);">
      <td><div style="background-color: #945F33;margin: 2px 0 0 -5px;" class="caixa-cor"></div></td><td>Marrom</td>
    </tr>
  </table>
</div>
<div class="variations-size-chooser-div" style="background-color: #FFFFFF;
    display: none;
    border: 1px solid #777777;
    font-size: 10px;
    margin-left: 40px;
    margin-top: -10px;
    padding: 5px 10px;
    position: absolute;
    width: 65px;">
<span style="cursor:pointer" onclick="LLRenders.chooseSize({'size':25}, this)">25</span>, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37
</div>
  <div class='wpsc_variation_forms'>
  <?php 
  $variacoes = Variation::findByProduct($product);
  foreach($variacoes as $variacao) {
    $subvars = $variacao -> getChildren();
?>
      <select onchange="variation_selected(this);" class='wpsc_select_variation' style="display:none;" name='variation[<?php echo $variacao->getID()?>]' id='variation_select_<?php echo $product -> getID() ?>_<?php echo $variacao->getID()?>'>
        <option value='0' ><?php echo $variacao->getName()?></option>
    <?php
    foreach($subvars as $subvar) {
    ?>
        <option value='<?php echo $subvar->getID()?>' ><?php echo $subvar->getName()?></option>
<?php }?>
      </select>
<?php 
}?>
  </div>
  <input type='hidden' name='wpsc_ajax_action' value='add_to_cart' />
  <input type='hidden' name='product_id' value='<?php echo $product-> getID()?>' />
  <input type='hidden' name='item' value='<?php echo $product-> getID()?>' />
  <input type='submit' id='product__submit_button' class='wpsc_buy_button' name='Buy' value='COMPRAR'  />
</form>