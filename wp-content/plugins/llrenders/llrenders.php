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