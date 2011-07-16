<?php
class Cache {
  private $innerCache;
  private static $instance;
  
  private function __construct() {
    $this -> innerCache = array();
  }
  
  public static function getInstance() {
    if(!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance; 
  }
  
  public function getValue($key) {
    if(array_key_exists($key, $this -> innerCache)) {
      return $this -> innerCache[$key];
    }
  }
  
  public function setValue($key, $value) {
    $this -> innerCache[$key] = $value;
  }
}