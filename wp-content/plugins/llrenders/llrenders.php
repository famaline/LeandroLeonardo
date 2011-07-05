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
}

class RenderHelpers {
	public static function write_menu_link($name, $text, $forced_link = '') {
	    $url = get_bloginfo('url') . (isset($forced_link) && !empty($forced_link) ? $forced_link : '/main/' . $name . '/');
	    $class_name = $name . ((RenderHelpers::actual_url(true) == $url) ? '_on' : '' );
	    print '<a href="' . $url . '" title="' . $text . '" class="' . $class_name . '">' . $text . '</a>';
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