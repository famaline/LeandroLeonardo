<?php
class Variation {
  private $ID;
  private $name;
  private $slug;
  private $description;
  private $product_id;
  
  public function getID() { return $this->ID; } 
  public function getName() { return $this->name; } 
  public function getSlug() { return $this->slug; } 
  public function getDescription() { return $this->description; } 
  public function getProductId() { return $this->product_id; }
  public function setID($id) { $this->ID = $id; } 
  public function setName($name) { $this->name = $name; } 
  public function setSlug($slug) { $this->slug = $slug; } 
  public function setDescription($description) { $this->description = $description; } 

  public function __construct($data) {
    $this -> ID = $data['ID'];
    $this -> name = $data['name'];
    $this -> slug = $data['slug'];
    $this -> description = $data['description'];
    $this -> product_id = $data['product_id'];
  }
  
  public function __toString() {
    return $this->ID.' '.$this->name;
  }

  
  public static function findByProduct($product, $filters=null) {
    return Variation::find_variation(0, $product -> getID(), $filters);
  }
  
  public function getChildren() {
    return Variation::find_variation($this -> ID, $this -> product_id);
  }
  
  private static function find_variation($parent_id=0, $product_id=0, $filters=null) {
    global $wpdb;
    
    //Estoque da variação: SELECT meta_value as estoque FROM wp_term_relationships tr INNER JOIN wp_posts p ON tr.object_id = p.id INNER JOIN wp_postmeta ON post_id = p.ID AND meta_key = '_wpsc_stock' WHERE post_parent = 90 AND term_taxonomy_id = 11
    //SELECT (SELECT sum(meta_value) FROM wp_posts inn_p INNER JOIN wp_term_relationships inn_tr ON inn_p.id = inn_tr.object_id INNER JOIN wp_postmeta inn_pm ON inn_p.id = inn_pm.post_id AND inn_pm.meta_key = '_wpsc_stock' WHERE inn_p.post_parent = tr.object_id AND inn_tr.term_taxonomy_id = terms.term_id) as estoque, terms.term_id as ID, terms.name, terms.slug, tt.description, tr.object_id as product_id FROM wp_terms terms INNER JOIN wp_term_relationships tr ON terms.term_id = tr.term_taxonomy_id INNER JOIN wp_term_taxonomy tt ON terms.term_id = tt.term_id WHERE taxonomy = 'wpsc-variation' AND parent = 7 AND tr.object_id = 90
    $sql = "SELECT terms.term_id as ID, terms.name, terms.slug, tt.description, tr.object_id as product_id FROM wp_terms terms INNER JOIN wp_term_relationships tr ON terms.term_id = tr.term_taxonomy_id INNER JOIN wp_term_taxonomy tt ON terms.term_id = tt.term_id WHERE taxonomy = 'wpsc-variation' AND parent = $parent_id";
    if($product_id != 0)
      $sql .= " AND tr.object_id = $product_id";
      
    if(isset($filters)) {
      $keys = array_keys($filters);
      
      foreach($keys as $key) {
        $sql .= " AND $key = '" . $filters[$key] . "'";
      }
    }

    $data = $wpdb->get_results($sql, ARRAY_A);
    $retorno = array();
    
    foreach($data as $row) {
      array_push($retorno, new Variation($row));
    }
    
    return $retorno;
  }
}