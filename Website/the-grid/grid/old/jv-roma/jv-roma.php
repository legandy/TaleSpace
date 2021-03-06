<?php
/**
 * @package   The_Grid
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2015 Themeone
 *
 * Skin: Roma
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH')) { 
	exit;
}

$tg_el = The_Grid_Elements();
$jv_el = JV_The_Grid_Elements(); // Get Javo Elements

$format = $tg_el->get_item_format();

$excerpt_args = array(
	'length' => 100
);

$media_args = array(
	'icons' => array(
		'image' => '<i class="tg-icon-search2"></i>'
	)
);

$output = $tg_el->get_media_wrapper_start();
	$output .= $tg_el->get_media();
	$output .= '<div class="tg-media-icon">';
		$output .= (in_array($format, array('video', 'audio'))) ? '<i class="tg-icon-play"></i>' : '<i class="tg-icon-search2"></i>';
	$output .= '</div>';
	$output .= '<div class="tg-item-content">';
		$output .= $tg_el->get_overlay();
		$output .= $tg_el->get_the_title();
		$output .= $jv_el->get_jv_category();  // Jv Category
		$output .= $jv_el->get_jv_location();  // Jv Location
		$output .= $jv_el->get_jv_rating_ave(); // Jv rating
		//$output .= $tg_el->get_the_excerpt($excerpt_args);
	$output .= '</div>';
	$output .= '<div class="tg-item-media-overlay">';
		$output .= $tg_el->get_media_button($media_args);
	$output .= '</div>';
$output .= $tg_el->get_media_wrapper_end();
		
return $output;