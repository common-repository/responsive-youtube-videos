<?php
/**
 * Responsive YouTube Videos - Text editor button
 *
 * Code and styling for the TinyMCE button in the text
 * editor that inserts a shortcode into the post.
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * If the WYSIWYG editor is available in the admin area
 * the shortcode button is added to the icons.
 */
add_action('admin_head', 'somryv_add_responsive_ytbutton');

function somryv_add_responsive_ytbutton() {

	global $typenow;
	// check user permissions
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
	}
		// verify the post type
	if( ! in_array( $typenow, array( 'post', 'page' ) ) )
		return;

	// check if WYSIWYG is enabled
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "som_add_responsive_ytbutton_mce");
		add_filter('mce_buttons', 'som_register_responsive_ytbutton');
		somryv_register_scripts();
		som_custom_youtubemce_styles();
		somryv_get_editor_header_html();
	}

}

function som_add_responsive_ytbutton_mce($plugin_array) {
		$plugin_array['som_responsive_ytbutton'] = plugins_url( '/assets/js/somryv_editor_button_script.js', dirname(__FILE__) );
		return $plugin_array;
}

function som_register_responsive_ytbutton($buttons) {
	 array_push($buttons, "som_responsive_ytbutton");
	 return $buttons;
}

/**
 * Some custom styling for the TinyMCE window
 *
 * @return echo script to admin page <head>
 */

function som_custom_youtubemce_styles() {

	$youtubeicon = plugins_url( '/assets/images/youtube-icon.png', dirname(__FILE__) );

	echo '
	<style>
		.mce-som-responsive-youtube-mce .mce-window-head {
			background-image: url("' . $youtubeicon . '")!important;
			background-repeat: no-repeat!important;
			background-position: left 10px center!important;
			background-size: 30px 30px!important;
			padding-left: 35px!important;
		}
		.mce-som-responsive-youtube-mce .mce-container.mce-panel.mce-foot {
			background-image: url("https://www.squareonemedia.co.uk/images/logo-png.png")!important;
			background-repeat: no-repeat!important;
			background-position: left 10px center!important;
			background-size: 30px 30px!important;
		}
		.mce-som-responsive-youtube-mce .mce-i-checkbox {
			float: right;
		}
		.mce-som-responsive-youtube-mce .somyt-mce-link {
			color: #0073aa!important;
		}
		.mce-som-responsive-youtube-mce .somyt-mce-link:hover {
			color: #00a0d2!important;
		}
		.mce-som-responsive-youtube-mce .somryv-mce-preview-wrap {
			width: 100%;
			text-align: center;
		}
		.mce-som-responsive-youtube-mce #somryv-preview-button {
			margin-bottom: 0;
			margin-top: 10px;
		}
		@media (max-width: 350px) {
			/* Make the MCE window responsive on mobile devices*/
			.mce-som-responsive-youtube-mce {
				max-width: 100%!important;
				overflow: scroll!important;
			}
		}
		i.somryv-youtube-button {
			background-image: url("' . $youtubeicon . '")!important;
			/*font: 400 20px/1 dashicons;
			padding: 0;
			vertical-align: top;
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			margin-left: -2px;
			padding-right: 2px;*/
		}
	</style>
	';

}