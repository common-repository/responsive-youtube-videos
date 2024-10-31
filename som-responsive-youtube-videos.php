<?php
/*
Plugin Name: Responsive Videos by Square One Media
Plugin URI: https://www.squareonemedia.co.uk
Description: Finally a simple, intuitive way to add responsive videos to your website.
Author: Square One Media
Author URI: https://www.squareonemedia.co.uk
Version: 2.1
Text Domain: som-ryv
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=VAYF6G99MCMHU
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin activation sets the plugin default options
 */

define('SOMRYV_PATH', plugin_dir_path(__FILE__));
define( 'SOMRYV_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

include_once( SOMRYV_PATH . 'includes/somryv-plugin-functions.php' );
include_once( SOMRYV_PATH . 'includes/somryv-plugin-settings.php' );
include_once( SOMRYV_PATH . 'includes/somryv-plugin-settings-page.php' );
include_once( SOMRYV_PATH . 'includes/somryv-editor-button.php' );
include_once( SOMRYV_PATH . 'includes/somryv-shortcodes.php' );
include_once( SOMRYV_PATH . 'includes/somryv-video-content.php' );
include_once( SOMRYV_PATH . 'includes/somryv-shortcode-widget.php' );

register_activation_hook( __FILE__, 'somryv_plugin_activated' );

function somryv_plugin_activated() {

	/**
	 * Set all of the default option values for size and alignment
	 */

	/**
	 * General
	 */
	$genoptions = get_option( 'somryv_gen_settings' );
	if ( !$genoptions['somryv_video_align_default'] ) {
		$genoptions['somryv_video_align_default'] = 'center'; // default alignment for responsive video
	}
	if ( !$genoptions['somryv_video_size_default'] ) {
		$genoptions['somryv_video_size_default'] = 'large'; // default size for responsive video	
	}
	update_option( 'somryv_gen_settings', $genoptions ); // update all the options

	/**
	 * Descriptions
	 */
	$descoptions = get_option( 'somryv_desc_settings' );
	if ( !$descoptions['somryv_video_desc_style'] ) {
		$descoptions['somryv_video_desc_style'] = '1'; // default style for video description
	}
	update_option( 'somryv_desc_settings', $descoptions ); // update all the options

	/**
	 * Colours
	 */	
	$colouroptions = get_option( 'somryv_desc_colour_settings' );
	$colouroptions = somryv_set_default_styles( $colouroptions, 1 ); // default style for video description
	update_option( 'somryv_desc_colour_settings', $colouroptions ); // update all the options

	/**
	 * Advanced
	 */
	$advoptions = get_option( 'somryv_adv_settings' );
	$advoptions = somryv_set_default_video_sizes( $advoptions ); // set all the default video size values
	update_option( 'somryv_adv_settings', $advoptions ); // update all the options

	/**
	 * Quick Load Colours
	 */	
	//$qload_colouroptions = get_option( 'somryv_qload_colour_settings' );
	//$qload_colouroptions = somryv_set_default_qload_styles( $qload_colouroptions, 1 ); // default style for video description
	//update_option( 'somryv_qload_colour_settings', $qload_colouroptions ); // update all the options

}