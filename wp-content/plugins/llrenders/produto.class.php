<?php
class Produto {
  private $ID;
  private $title;
  private $price;
  private $special_price;
  private $slug;
  
  public function __construct($data) {
    $this -> ID = $data['ID'];
    $this -> title = $data['post_title'];
    $this -> price = $data['price'];
    $this -> special_price = $data['special_price'];
    $this -> slug = $data['post_name'];
  }
  
  public function getID() {
    return $this -> ID;
  }
  
  public function getTitle() {
    return $this -> title;
  }
  
  public function getPrice() {
    return $this -> price;
  }
  
  public function getSpecialPrice() {
    return $this -> special_price;
  }
  
  public function getSlug() {
    return $this -> slug;
  }
  
  public function isPromotional() {
    return $this -> special_price > 0;
  }
  
  public function getVariations() {
    return Variation::find_by_product($this);
  }
  
  private static $cache = array();
  
  //retrieves the product category Id by slug
  public static function get_cat_ID($slug) {
    // Controlando Cache -----------------------------------------
    $cache = Cache::getInstance();
    $key = "/product/category_id/$slug";
    $category_id = $cache -> getValue($key);
    
    if(isset($category_id))
      return $category_id;
    //------------------------------------------------------------
    
    global $wpdb;
    
    $sql = "SELECT term_id as ID FROM " . $wpdb->prefix ."terms WHERE slug='$slug'";
    $results = $wpdb->get_results($sql, ARRAY_A);

    $retorno = empty($results)? 0 : $results[0]['ID'];
    
    //guardando no cache
    $cache -> setValue($key, $retorno);
    
    return $retorno;
  }

  public static function findById($id) {
    $produtos = Produto::all(array('ID' => $id));
    
    if($produtos && count($produtos) == 1)
      return $produtos[0];
    
    return null;
  }
  
  //retrieves all products filtered by whatever conditions given;
  //special condition: category_id
  public static function all($conditions=null, $extra_sqls=null) {
    global $wpdb;
    //Busca de estoque, caso nulo, quer dizer que não se interessa por controle de estoque

    $sql_price = "SELECT meta_value FROM " . $wpdb->prefix . "postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wpsc_price'";
    $sql_special_price = "SELECT meta_value FROM " . $wpdb->prefix . "postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wpsc_special_price'";
    $sql_estoque_principal = "SELECT meta_value AS qtde FROM " . $wpdb->prefix . "postmeta WHERE post_id = p.ID AND meta_key = '_wpsc_stock'";
    $sql_estoque_variacoes = "SELECT SUM(meta_value) as qtde FROM " . $wpdb->prefix . "postmeta WHERE post_parent = p.ID AND meta_key = '_wpsc_stock'";
    $sql = "SELECT pr.ID, pr.post_title, pr.price, pr.special_price, pr.post_name FROM (SELECT ID, post_title, post_name, ($sql_price) as price, ($sql_special_price) as special_price, post_content, ($sql_estoque_principal) as estoque, ($sql_estoque_variacoes) as estoque_variacoes FROM " . $wpdb->prefix ."posts p WHERE p.post_status = 'publish' AND p.post_type = 'wpsc-product') as pr";
    
    if(!empty($conditions)) {
      if(array_key_exists('category_id', $conditions)) {
        $sql .= " INNER JOIN " . $wpdb->prefix ."term_relationships tr ON tr.object_id = pr.ID";
      }
      $sql .= " WHERE 1=1";
      $conditions_keys = array_keys($conditions);
      foreach($conditions_keys as $condition_key) {
        $key = $condition_key == 'category_id'? 'tr.term_taxonomy_id' : $condition_key;

        $sql .= " AND $key='" . $conditions[$condition_key] . "'";
      }
    }

    if(isset($extra_sqls)) {
      $before_query = $extra_sqls['before-query'];
      
      if(isset($before_query)) {
        $sql .= $before_query;
      }
    }
    
    $data = $wpdb->get_results($sql, ARRAY_A);
    $retorno = array();
    foreach($data as $row) {
      array_push($retorno, new Produto($row));
    }
    
    return $retorno;
  }
  
  public static function search($s) {
    global $wpdb;
    $sql = "SELECT pr.ID, pr.post_title, pr.price, pr.special_price, pr.post_name FROM (SELECT ID, post_title, post_name, ( SELECT meta_value FROM " . $wpdb->prefix ."postmeta pm WHERE pm.post_id = ppp.object_id AND pm.meta_key = '_wpsc_price' ) AS price,  (SELECT meta_value FROM " . $wpdb->prefix ."postmeta pm WHERE pm.post_id = ppp.object_id AND pm.meta_key = '_wpsc_special_price') AS special_price, post_content FROM (SELECT * FROM ( SELECT object_id FROM wp_terms terms INNER JOIN wp_term_relationships tr ON terms.term_id = tr.term_taxonomy_id AND terms.name LIKE '%$s%') AS tt, wp_posts p WHERE p.post_type = 'wpsc-product' AND p.post_status = 'publish' AND p.id = tt.object_id) AS ppp ) AS pr";
  
    return $wpdb->get_results($sql,ARRAY_A);
  }
  
}