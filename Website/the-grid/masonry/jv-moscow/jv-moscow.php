<?php
/**
 * @package   The_Grid
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2015 Themeone
 *
 * Skin: jv-moscow
 *
 */
 
// Exit if accessed directly
if (!defined('ABSPATH')) { 
	exit;
}

$tg_el = The_Grid_Elements();
$jv_el = JV_The_Grid_Elements(); // Get Javo Elements

$format = $tg_el->get_item_format();
$colors = $tg_el->get_colors();
$image  = $tg_el->get_attachment_url();

$terms_args = array(
	'color' => 'color',
	'separator' => ', '
);

$link_arg = array(
	'icon' => __( 'Read More', 'tg-text-domain' )
);

$author_args = array(
	'prefix' => __( 'By', 'tg-text-domain' ).' ',
);

$com_args = array(
	'icon' => '<i class="tg-icon-chat"></i>'
);

$media_args = array(
	'icons' => array(
		'image' => '<i class="tg-icon-add"></i>',
		'audio' => __( 'Play Song', 'tg-text-domain' ),
		'video' => __( 'Play Video', 'tg-text-domain' ),
	)
);

$author = preg_replace('/(<a\b[^><]*)>/i', '$1 style="color:'.$colors['content']['title'].'">', $tg_el->get_the_author($author_args));

$output = isset( $output ) ? $output : null;

if ($format == 'quote' || $format == 'link') {

	$output  = ($image) ? '<div class="tg-item-image" style="background-image: url('.esc_url($image).')"></div>' : null;
	$output .= $tg_el->get_content_wrapper_start();
		$output .= '<i class="tg-'.$format.'-icon tg-icon-'.$format.'" style="color:'.$colors['content']['title'].'"></i>';
		$output .= $tg_el->get_the_date();
		$output .= ($format == 'quote') ? $tg_el->get_the_quote_format() : $tg_el->get_the_link_format();
		$output .= '<div class="tg-item-footer">';
			$output .= $author;
			$output .= $tg_el->get_the_likes_number();
			$output .= $tg_el->get_the_comments_number($com_args);
		$output .= '</div>';
	$output .= $tg_el->get_content_wrapper_end();
	
	return $output;
	
} else {
	
	$media_content  = $tg_el->get_media();
	$social_buttons = $tg_el->get_social_share_links();

	$output .= $tg_el->get_the_title();
	
	if ($media_content) {
		$output .= $tg_el->get_media_wrapper_start();
			$output .= sprintf( '<div class="tg-moscow-featured-status">%s</div>', $jv_el->get_jv_status_raw() );
			$output .= $media_content;
			if ($image || in_array($format, array('gallery', 'video'))) {
				$output .= $tg_el->get_overlay();
				$output .= $tg_el->get_center_wrapper_start();	
				$output .= (in_array($format, array('video', 'audio'))) ? $tg_el->get_media_button($media_args) : null;
				$output .= (!in_array($format, array('video', 'audio'))) ? $tg_el->get_link_button($link_arg) : null;
				$output .= $tg_el->get_center_wrapper_end();
				if (!empty($social_buttons)) {
					$output .= '<div class="tg-share-icons">';
					foreach ($social_buttons as $url) {
						$output .= $url;
					}
					$output .= '</div>';
				}
			}			
		$output .= $tg_el->get_media_wrapper_end();
	}
	
	$output .= $tg_el->get_content_wrapper_start();
		$output .= sprintf( '<div class="tg-item-featured-meta"><span>%1$s</span>%2$s</div>', $jv_el->get_jv_price_raw(), $jv_el->get_jv_type_raw() );
		$output .= $tg_el->get_the_excerpt( Array( 'length' => 80 ) );				
	$output .= $tg_el->get_content_wrapper_end();
	$output .= '<div class="tg-item-meta-holder">';		
		$output .= sprintf(
			'<div class="tg-item-meta-field"><i class="fa fa-home"></i><span>%1$s</span></div>',
			$jv_el->get_jv_area_raw()
		);
		$output .= sprintf(
			'<div class="tg-item-meta-field"><i class="fa fa-bed"></i><span>%1$s</span>%2$s</div>',
			$jv_el->get_jv_bedrooms_raw(),
			esc_html__( "Beds", 'javohome' )
		);
		$output .= sprintf(
			'<div class="tg-item-meta-field"><i class="fa fa-bath"></i><span>%1$s</span>%2$s</div>',
			$jv_el->get_jv_bathrooms_raw(),
			esc_html__( "Baths", 'javohome' )
		);
		$output .= sprintf(
			'<div class="tg-item-meta-field"><i class="fa fa-home"></i><span>%1$s</span>%2$s</div>',
			$jv_el->get_jv_garages_raw(),
			esc_html__( "Garage", 'javohome' )
		);
	$output .= '</div>';
	

	return $output;

}