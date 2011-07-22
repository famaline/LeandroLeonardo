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