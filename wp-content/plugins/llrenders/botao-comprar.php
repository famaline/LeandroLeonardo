<?php
if(gettype($product) != 'object') {
  $product = Produto::findById($product);
}
?>
<form onsubmit='submitLLform(this, "<?php echo $categoria ?>");return false;'  action='' method='post'>
  <div class='wpsc_variation_forms'>
  <?php /* ?>
    <p>
      <label for='variation_select_1_6'>Cor:</label>
      <select class='wpsc_select_variation' name='variation[6]' id='variation_select_1_6'>
        <option value='0' >-- Please Select --</option>
        <option value='8' >Beje</option>
        <option value='10' >Marrom</option>
        <option value='9' >Preto</option>
      </select>
    </p>
    <p>
      <label for='variation_select_1_7'>Tamanho:</label>
      <select class='wpsc_select_variation' name='variation[7]' id='variation_select_1_7'>
        <option value='0' >-- Please Select --</option>
        <option value='11' >25</option>
        <option value='12' >41</option>
      </select>
    </p>
    <?php */?>
  </div>
  <input type='hidden' name='wpsc_ajax_action' value='add_to_cart' />
  <input type='hidden' name='product_id' value='<?php echo $product-> getID()?>' />
  <input type='hidden' name='item' value='<?php echo $product-> getID()?>' />
  <input type='submit' id='product__submit_button' class='wpsc_buy_button' name='Buy' value='COMPRAR'  />
</form>