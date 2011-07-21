<?php
if(gettype($product) != 'object') {
  $product = Produto::findById($product);
}
?>
<form onsubmit='submitLLform(this, "<?php echo $categoria ?>");return false;'  action='' method='post'>
  <div class='wpsc_variation_forms'>
  <?php 
  $variacoes = Variation::findByProduct($product);
  foreach($variacoes as $variacao) {
    $subvars = $variacao -> getChildren();
?>
    <p>
      <label for='variation_select_1_<?php echo $variacao->getID()?>'><?php echo $variacao->getName()?>:</label>
      <select class='wpsc_select_variation' name='variation[<?php echo $variacao->getID()?>]' id='variation_select_1_<?php echo $variacao->getID()?>'>
        <option value='0' >-- Please Select --</option>
    <?php
    foreach($subvars as $subvar) {
    ?>
        <option value='<?php echo $subvar->getID()?>' ><?php echo $subvar->getName()?></option>
<?php }?>
      </select>
    </p>
<?php 
}?>
  </div>
  <input type='hidden' name='wpsc_ajax_action' value='add_to_cart' />
  <input type='hidden' name='product_id' value='<?php echo $product-> getID()?>' />
  <input type='hidden' name='item' value='<?php echo $product-> getID()?>' />
  <input type='submit' id='product__submit_button' class='wpsc_buy_button' name='Buy' value='COMPRAR'  />
</form>