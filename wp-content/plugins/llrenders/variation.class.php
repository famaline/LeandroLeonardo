<?php
class Variation {
  public static function find_by_product($product) {
    /*
    global $wpdb;
    
    $sql_price = "SELECT meta_value FROM " . $wpdb->prefix ."postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wpsc_price'";
    $sql_special_price = "SELECT meta_value FROM " . $wpdb->prefix ."postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wpsc_special_price'";
    $sql = "SELECT pr.ID, pr.post_title, pr.price, pr.special_price, pr.post_name FROM (SELECT ID, post_title, post_name, ($sql_price) as price, ($sql_special_price) as special_price, post_content FROM " . $wpdb->prefix ."posts p WHERE p.post_status = 'publish' AND p.post_type = 'wpsc-product') as pr WHERE pr.ID = $id";

    $data = $wpdb->get_results($sql, ARRAY_A);
    if(count($data) != 1) {
      return null;
    }
    
    return new Produto($data[0]);
    */
  }
}