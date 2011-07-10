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
?>
  <table class="galeria" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40" valign="top"><?php Renders::render_image('galeria/left-on.png', array('width'=>40, 'heigth'=>163))?></td>
      <td valign="top">
        <?php for($i=0; $i < $num_exibir; $i++) {
          echo Renders::render_galeria_part();
        }?>
      </td>
      <td width="40" valign="top"><?php Renders::render_image('galeria/right-on.png', array('width'=>40, 'heigth'=>163))?></td>
    </tr>
  </table>
<?php
  }
  
  private static function render_galeria_part() {
?>
<div class="produto-wrapper">
  <table class="produto" cellspacing="1" cellpadding="0">
    <tr>
      <td class="produto-imagem">[img]</td><td class="produto-bar">b</td>
    </tr>
  </table>
  <div class="produto-info">
    <div class="prod-tit">Bota de Couro</div>
    <div class="prod-de">R$ 179,00</div>
    por <div class="prod-por">R$ 149,00</div>
    <div class="prod-button-wrapper"><input type="button" value="COMPRAR"/></div>
  </div>
</div>
<?php
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