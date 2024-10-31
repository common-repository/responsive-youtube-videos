<?php
/**
 * Responsive YouTube Videos - Shortcodes
 *
 * Code for the shortcode function and return values
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode variables pass through som_responsive_video,
 * are are checked against plugin settings.
 * somryv_get_video returns the html code.
 */

add_shortcode( 'somryv', 'som_responsive_video' );

function som_responsive_video( $atts ) {

	// Pull in the plugin settings

	$genoptions = get_option( 'somryv_gen_settings' );

	$advoptions = get_option( 'somryv_adv_settings' );

	// Failsafe, check for blank video sizes

	somryv_check_blank_video_sizes();

	// Attributes

	$atts = shortcode_atts(
		array(
			'type' => 'youtube',
			'url' => '',
			'size' => '',
			'align' => '',
			'link' => 'false',
			'desc' => '',
			'start' => ''
		), $atts, 'som-responsive-youtube' );

	$videotype = $atts['type'];
	
	$videourl = $atts['url'];

	$videosize = $atts['size'];
	
	$videowidth = som_responsive_video_size( $atts['size'] );

	$videoalign = som_responsive_video_align( $genoptions, $atts['align'] );

	$link = $atts['link'];

	$desc = $atts['desc'];
	
	$start = $atts['start'];

	/**
	 * Call to function in somryv-video-content.php
	 */
	do_action( 'somryv_load_video_css' );

	return somryv_get_video( $videotype, $videourl, $videosize, $videowidth, $videoalign, $link, $desc, $start );

}