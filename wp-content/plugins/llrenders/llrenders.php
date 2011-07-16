<?php
/*
Plugin Name: Renders
Plugin URI: http://
Description: Disponibiliza diversos renderizadores para exibicao de produtos e outros
Author: Leandro & Leonardo
Version: 1.0
Author URI: http://
*/


/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
class Renders {
  public static function render_galeria($categoria, $num_exibir=4) {
    $products = Produto::all(array('category_id' => Produto::get_cat_ID($categoria)));
    require_once('galeria.php');
  }
  
  private static function render_galeria_part($product, $categoria='') {
    require_once('galeria_part.php');
  }
  
  public static function render_image($path, $params=null) {
    $image_tag = '<img src="' . get_bloginfo('template_directory') . '/images/' . $path . '"';
    
    if(isset($params)) { //percorre parametros chave/valor e printa como atributos da imagem
      $attributes = array_keys($params);
      foreach($attributes as $attribute) {
        $image_tag .= " $attribute=\"$params[$attribute]\"";
      }
    }
    
    $image_tag .= '/>';
    
    echo $image_tag;
  }
	public static function render_now() {
		$dias_semana = array('Domingo', 'Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado');
		$meses = array('', 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro');
		$date_info  = getdate(time());
		$dia_semana =  $dias_semana[$date_info['wday']];
		$dia_mes = $date_info['mday'];
		$mes = $meses[$date_info['mon']];
		$ano = $date_info['year'];
		echo "$dia_semana, $dia_mes de $mes de $ano";
	}
	
	public static function render_destaque($indice=1, $template=null) {
		$destaque = get_page_by_title("destaque$indice");
		$dado = get_post_custom_values("produto", $destaque -> ID);
		$image = RenderHelpers::get_post_image($destaque -> ID);

		if($template === null) {
			$template = function ($img, $dt) {
				echo '<div id="post-img-container"><a href="' . get_bloginfo('url') . '?wpsc-product=' . $dt . '"><img src="' . $img -> guid . '" id="post-img" width="468" border=0/></a></div>';
			};
		}
		
		$template($image, $dado[0]);
	}

	public static function render_menu_link($name, $text, $forced_link = '') {
	    $url = get_bloginfo('url') . (isset($forced_link) && !empty($forced_link) ? $forced_link : '/main/' . $name . '/');
	    $class_name = 'linkmenu' . ((RenderHelpers::actual_url(true) == $url) ? '_on' : '' );
	    print '<a href="' . $url . '" title="' . $text . '" class="' . $class_name . '">' . $text . '</a>';
	}
  
  public static function render_content($name, $msg_default='') {
    $content = get_page_by_title($name) -> post_content;
    echo ($content === null ? $msg_default : $content);
  }
}

class RenderHelpers {
	public static function starts_with($text, $compared){
	    return strpos($text, $compared) === 0;
	}
	
	public static function get_post_image($post_id) {
	    $args = array(
	        'post_type' => 'attachment',
	        'numberposts' => -1,
	        'post_status' => null,
	        'post_parent' => $post_id
		); 
	    $attachments = get_posts($args);
	    $image = null;
	    
	    if($attachments) {
	        foreach ($attachments as $attachment) {
	            $type = $attachment -> post_mime_type;
	            
	            if(RenderHelpers::starts_with($type, 'image/'))
	                return $attachment;
	        }
	    }
	    
	    return false;
	}
	
    public static function actual_url($clean = false) {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on")
            $pageURL .= "s";
            
        $pageURL .= "://" . $_SERVER["SERVER_NAME"];
        
        if ($_SERVER["SERVER_PORT"] != "80")
            $pageURL .= ":".$_SERVER["SERVER_PORT"];
        
        $uri = $_SERVER["REQUEST_URI"];
        
        if($clean) {
            $pos = strrpos($uri, '?');
            if($pos)
                $uri = substr($uri, 0, $pos);
        }
        
        return $pageURL . $uri;
    }
}

class Cache {
  private $innerCache;
  private static $instance;
  
  private function __construct() {
    $innerCache = array();
  }
  
  public static function getInstance() {
    if(!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance; 
  }
  
  public function getValue($key) {
    echo 'xxxx' . isset($innerCache) . 'yyyy';
    if(array_key_exists($key, $innerCache)) {
      return $innerCache[$key];
    }
  }
}

class Produto {
  private static $cache = array();
  
  //retrieves the product category Id by slug
  public static function get_cat_ID($slug) {
    /*
    $category_id = Cache::getInstance() -> getValue('/product/category_id');
    
    if(isset($category_id)) {
      return $category_id;
    }
    */
    global $wpdb;
    
    $sql = "SELECT term_id as ID FROM " . $wpdb->prefix ."terms WHERE slug='$slug'";
    $results = $wpdb->get_results($sql, ARRAY_A);

    return empty($results)? 0 : $results[0]['ID'];
  }

  //retrieves all products filtered by whatever conditions given;
  //special condition: category_id
  public static function all($conditions=null) {
    global $wpdb;
    
    $sql_price = "SELECT meta_value FROM " . $wpdb->prefix ."postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wpsc_price'";
    $sql_special_price = "SELECT meta_value FROM " . $wpdb->prefix ."postmeta pm WHERE pm.post_id = p.ID AND pm.meta_key = '_wpsc_special_price'";
    $sql = "SELECT pr.ID, pr.post_title, pr.price, pr.special_price, pr.post_name FROM (SELECT ID, post_title, post_name, ($sql_price) as price, ($sql_special_price) as special_price, post_content FROM " . $wpdb->prefix ."posts p WHERE p.post_status = 'publish' AND p.post_type = 'wpsc-product') as pr";
    
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

    return $wpdb->get_results($sql, ARRAY_A);
  }
}

function my_init_method() {
    wp_deregister_script( 'llrenders' );
    wp_register_script( 'llrenders', plugins_url( '/llrenders/js/llrenders.js' , dirname(__FILE__) ) );
    wp_enqueue_script( 'llrenders' );
}    
 
add_action('init', 'my_init_method');