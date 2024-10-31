<?php
/**
 * Responsive YouTube Videos - Settings page
 *
 * The content and layout for the plugin settings page
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The plugin settings page
 */

add_action( 'admin_head', 'som_get_script_assets' );

function som_get_script_assets() {

	if ( isset( $_GET[ 'page' ] ) == 'som-responsive-youtube-videos') {
		/**
		 * If the current admin page is this plugin's
		 * settings, register the necessary script files.
		 * somryv_register_scripts() in functions file
		 */
		somryv_register_scripts();
	}
}

function somryv_options_page() {

	/**
	 * Pull in the settings preview template file if
	 * the preview url string if present
	 * @param $preview the somryvpreview url string
	 */
	$preview = isset( $_GET['somryvpreview'] ) ? $_GET['somryvpreview'] : '' ;

	if ($preview) {

		include_once( SOMRYV_PATH . 'templates/somryv-settings-preview.php' );	
	
	} else {
	
	/**
	 * This small javascript function refreshes the page
	 * if it's loaded from using the back or forward buttons,
	 * keeping the settings and shortcode generator up-to-date.
	 */
	?>

	<input id="alwaysFetch" type="hidden" />
	<script>
		setTimeout(function () {
		var el = document.getElementById('alwaysFetch');
		el.value = el.value ? location.reload() : true;
		}, 0);
	</script>
	
	<?php	/**
		 * Pull in the main settings page, as this isn't a preview
		 */
		include_once( SOMRYV_PATH . 'templates/somryv-settings-main.php' );

	}

}

/**
 * Settings page link for the Plugins main page
 *
 * @return $links link to the settings page
 */
 
 function somryv_get_settings_link() {
 	$url = get_admin_url() . 'plugins.php?page=som-responsive-youtube-videos';
	return $url;
 }

function somryv_settings_link( $links ) {
    $url = get_admin_url() . 'plugins.php?page=som-responsive-youtube-videos';
    $settings_link = '<a href="' . $url . '">' . __('Settings', 'som-responsive-youtube-videos') . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
 
function somryv_after_setup_plugin() {
     add_filter('plugin_action_links_' . SOMRYV_PLUGIN_BASENAME, 'somryv_settings_link');
}
add_action ('after_setup_theme', 'somryv_after_setup_plugin');