<?php
/**
 * Responsive YouTube Videos - Functions
 *
 * Functions for getting/setting various options
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function somryv_init() {
	add_filter( 'pre_update_option_somryv_desc_settings', 'somryv_reset_colours', 20, 2 );
}

add_action( 'admin_init', 'somryv_init' );

function somryv_settings_footer() {

	if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'som-responsive-youtube-videos' ) {
		include_once( SOMRYV_PATH . 'templates/somryv-settings-footer.php' );
	}

}

add_action( 'admin_footer', 'somryv_settings_footer' );

function som_responsive_video_size( $size ) {

	/**
	 * Get the size value of the shortcode size variable.
	 * If none, default value is returned.
	 *
	 * Called from som_responsive_video() in Shortcodes.
	 *
	 * @param $size passed in video size from shortcode
	 * @return the value of the video size (width)
	 */

	$genoptions = get_option( 'somryv_gen_settings' );
	$advoptions = get_option( 'somryv_adv_settings' );

	if ( ! $size ) {
		$size = $genoptions['somryv_video_size_default'];
	}

	if ( 'small' == $size ) {
		return $advoptions['somryv_video_size_small'];
	} elseif ( 'medium' == $size ) {
		return $advoptions['somryv_video_size_medium'];
	} elseif ( 'large' == $size ) {
		return $advoptions['somryv_video_size_large'];
	} else {
		return '100%';
	}

}

function som_responsive_video_align( $genoptions, $align ) {

	/**
	 * Get the alignment value of the shortcode align variable.
	 * If none, default value is returned.
	 *
	 * Called from som_responsive_video() in Shortcodes.
	 *
	 * @param $genoptions passed in options array
	 * @param $align passed in video alignment from shortcode
	 * @return the value of the video alignment (CSS classname)
	 */

	if ( ! $align ) {
		$align = $genoptions['somryv_video_align_default'];
	}

	return $align;

}

/**
 * The default values for each video size variable.
 *
 * @return array of values $videosizes
 */
function somryv_get_default_video_sizes() {

	$videosizes = array(
	'small' => '250px',
	'medium' => '500px',
	'large' => '750px',
	'full' => '100%'
	);

	return $videosizes;

}

function somryv_set_default_video_sizes( $advoptions, $reset = false ) {

	$defaultsizes = somryv_get_default_video_sizes();

	if ( ! $advoptions['somryv_video_size_small'] || $reset ) {
		$advoptions['somryv_video_size_small'] = $defaultsizes['small'];
	}
	if ( ! $advoptions['somryv_video_size_medium'] || $reset ) {
		$advoptions['somryv_video_size_medium'] = $defaultsizes['medium'];
	}
	if ( ! $advoptions['somryv_video_size_large'] || $reset ) {
		$advoptions['somryv_video_size_large'] = $defaultsizes['large'];
	}
	if ( ! $advoptions['somryv_video_size_full'] || $reset ) {
		$advoptions['somryv_video_size_full'] = $defaultsizes['full'];
	}

	return $advoptions;

}

function somryv_check_blank_video_sizes() {

	/**
	 * Failsafe function.
	 * If any default sizes are found to be blank,
	 * they are set to the plugin defaults.
	 */

	$advoptions = get_option( 'somryv_adv_settings' );
	$defaultsizes = somryv_get_default_video_sizes();

	if ( ! $advoptions['somryv_video_size_small'] ) {
		$advoptions['somryv_video_size_small'] = $defaultsizes['small'];
	}

	if ( ! $advoptions['somryv_video_size_medium'] ) {
		$advoptions['somryv_video_size_medium'] = $defaultsizes['medium'];
	}

	if ( ! $advoptions['somryv_video_size_large'] ) {
		$advoptions['somryv_video_size_large'] = $defaultsizes['large'];
	}

	if ( ! $advoptions['somryv_video_size_full'] ) {
		$advoptions['somryv_video_size_full'] = $defaultsizes['full'];
	}

	update_option('somryv_adv_settings', $advoptions);

}

function somryv_get_default_video_size( $genoptions ) {
	$size = $genoptions['somryv_video_size_default'];
	return $size;
}

function somryv_get_default_video_align( $genoptions ) {
	$align = $genoptions['somryv_video_align_default'];
	return $align;
}

add_action( 'admin_enqueue_scripts', 'somryv_enqueue_iris' );
function somryv_enqueue_iris() {
	if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'som-responsive-youtube-videos' ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', plugins_url('/assets/js/somryv_color_script.js', dirname(__FILE__)), array( 'wp-color-picker' ), false, true );
	}
}

add_filter( 'the_editor_content', 'somryv_tinymce_style' );
function somryv_tinymce_style( $content ) {
	$somryv_css = plugins_url( '/assets/css/somryv_video_css.css', dirname(__FILE__) );
	add_editor_style( $somryv_css );

	// This is for front-end tinymce customization
	if ( ! is_admin() ) {
		global $editor_styles;
		$editor_styles = (array) $editor_styles;
		$stylesheet    = (array) $stylesheet;

		$stylesheet[] = $somryv_css;

		$editor_styles = array_merge( $editor_styles, $stylesheet );

	}
	return $content;
}

add_action( 'wp_head', 'somryv_load_video_custom_css' );
function somryv_load_video_custom_css() {
	
	/**
	 * Header CSS to override for custom colours
	 * on the website frontend.
	 */
	
	if ( ! is_admin() ) {
		somryv_video_overriding_css();
	}
}

function somryv_video_overriding_css() {

	$colours = get_option( 'somryv_desc_colour_settings' );
	$font = $colours['somryv_video_desc_font'];
	$border = $colours['somryv_video_desc_border'];
	$bg = $colours['somryv_video_desc_bg'];

	echo '
<style>
.somryv-desc-wrap .somryv-desc {
	color: ' . $font . '!important;
	border-color: ' . $border . '!important;
	background-color: ' . $bg . '!important;
}

.somryv-desc-wrap-4 .somryv-desc-corner-1 {
	border-color: ' . $border . ' transparent transparent transparent!important;
}

.somryv-desc-wrap-5 .somryv-desc-corner-1 {
	border-color: ' . $border . ' transparent transparent transparent!important;
}

.somryv-desc-wrap-5 .somryv-desc-corner-4 {
	border-color: transparent transparent ' . $border . ' transparent!important;
}

.somryv-desc-wrap-6 .somryv-desc-corner-4 {
	background-color: ' . $border . '!important;
}
</style>
	';

	$ql_options = get_option( 'somryv_qload_settings' );
	$style = ( isset( $ql_options['somryv_play_button'] ) && $ql_options['somryv_play_button'] ) ? $ql_options['somryv_play_button'] : 1 ;
	$default_prime = somryv_get_default_qload_styles( $style, 'primary' );
	$default_arrow = somryv_get_default_qload_styles( $style, 'arrow' );
	$default_second = somryv_get_default_qload_styles( $style, 'secondary' );
	
	$ql_colours = get_option( 'somryv_qload_colour_settings' );
	$primary = ( isset( $ql_colours['somryv_prime_colour'] ) && $ql_colours['somryv_prime_colour'] ) ? $ql_colours['somryv_prime_colour'] : $default_prime ;
	$arrow = ( isset( $ql_colours['somryv_arrow_colour'] ) && $ql_colours['somryv_arrow_colour'] ) ? $ql_colours['somryv_arrow_colour'] : $default_arrow ;
	$secondary = ( isset( $ql_colours['somryv_second_colour'] ) && $ql_colours['somryv_second_colour'] ) ? $ql_colours['somryv_second_colour'] : $default_second ;

	echo '
<style>
.som-video-wrap .som-resp-video:hover .som-resp-video-play .som-resp-video-play-icon,
.som-video-wrap .som-resp-video-play.som-resp-video-play-nohover .som-resp-video-play-icon {
	border-color: rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) ' . $arrow . ';
}
.som-video-wrap .som-resp-video:hover .som-resp-video-play.som-resp-video-play,
.som-video-wrap .som-resp-video .som-resp-video-play.som-resp-video-play-nohover {
	background-color: ' . $primary . ';
}

.som-video-wrap .som-resp-video:hover .som-resp-video-play-3.som-resp-video-play,
.som-video-wrap .som-resp-video:hover .som-resp-video-play-4.som-resp-video-play,
.som-video-wrap .som-resp-video .som-resp-video-play-3.som-resp-video-play-nohover,
.som-video-wrap .som-resp-video .som-resp-video-play-4.som-resp-video-play-nohover {
	background-color: ' . $primary . ';
	border-color: ' . $secondary . ';
}
</style>
	';

}

function somryv_settings_includes() {

	/**
	 * Called from Plugin Settings	
	 * Loads the stylesheet and script files
	 * only for the settings/widgets pages.
	 */
	 
	global $pagenow;
	
	if ( $pagenow == 'widgets.php' ) {
	
		wp_register_style( 'somryv_settings_style', plugins_url('/assets/css/somryv_settings_style.css', dirname(__FILE__) ) );
		wp_enqueue_style( 'somryv_settings_style' );

		somryv_get_settings_header_html();
	
	}

	if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'som-responsive-youtube-videos' ) {
	
		wp_enqueue_script( 'somryv_settings_script', plugins_url('/assets/js/somryv_settings_script.js', dirname(__FILE__) ), array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'somryv_main_script', plugins_url('/assets/js/main.js', dirname(__FILE__) ), array('jquery'), '1.0.0', true );
		
		wp_register_style( 'somryv_settings_style', plugins_url('/assets/css/somryv_settings_style.css', dirname(__FILE__) ) );
		wp_enqueue_style( 'somryv_settings_style' );
		
		do_action( 'somryv_load_video_css' );

		somryv_get_settings_header_html();

	}

}

function somryv_register_scripts() {

	/**
	 * Called from Settings Page & Editor Button
	 * Loads the script file that contains
	 * functions for WP editor button and
	 * shortcode generator.
	 */
	 
	wp_register_script( 'somryv_functions_script', plugins_url('/assets/js/somryv_functions.js', dirname(__FILE__) ) );
	wp_enqueue_script( 'somryv_functions_script' );

}

function somryv_get_editor_header_html() {

	$genoptions = get_option( 'somryv_gen_settings' ); // get the plugin options settings
	$size = somryv_get_default_video_size( $genoptions ); // Default video size setting
	$align = somryv_get_default_video_align( $genoptions ); // Default video alignment setting

	echo '
<script type="text/javascript">
	defaultSizeVar = "' . $size . '";
	defaultAlignVar = "' . $align . '";
</script>
<!--[if lte IE 9]>
	<style>
		#som-gen-shortcode-form-wrap.generate-shortcode-open .som-gen-shortcode-form {
			top: 30px!important;
			margin: auto auto;
		}
		#somryv-copy-confirm {
			display: none;
		}
		#somryv-copy-confirm.somryv-copied {
			display: block;
			right: 25%;
		}
	</style>
<![endif]-->	
	';
	
}

function somryv_get_settings_header_html() {

	/**
	 * Called from Settings Page & Editor Button
	 * Places 2 variables on the HTML page
	 * that represent the PHP variables for
	 * default video size and alignment.
	 * Used by script functions.
	 */

	$genoptions = get_option( 'somryv_gen_settings' ); // get the plugin options settings
	$advoptions = get_option( 'somryv_adv_settings' );
	$size = somryv_get_default_video_size( $genoptions ); // Default video size setting
	$align = somryv_get_default_video_align( $genoptions ); // Default video alignment setting
	
	$youtubeicon = plugins_url( '/assets/images/youtube-icon.png', dirname(__FILE__) );
	$videobg = plugins_url( '/assets/images/YouTube_light_color_icon.png', dirname(__FILE__) );

	echo '
<script type="text/javascript">
	defaultSizeVar = "' . $size . '";
	defaultAlignVar = "' . $align . '";
</script>
<noscript><style>
	.som-no-java { display: block!important; }
</style></noscript>
	';
	
	$somryvsettings = isset( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : '';
	$somryvsettingscolours = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : '';

	$colours = get_option( 'somryv_desc_colour_settings' );
	$font = $colours['somryv_video_desc_font'];
	$border = $colours['somryv_video_desc_border'];
	$bg = $colours['somryv_video_desc_bg'];
	$preview = isset( $_GET['somryvpreview'] ) ? $_GET['somryvpreview'] : '';

	if ( $preview ) {
		echo '
<style>
#wpfooter {
	display: none;
}
#wpcontent {
	margin-left: 0!important;
	padding-left: 0!important;
}
.somryv-row {
	padding: 0!important;
}
#adminmenumain {
	display: none;
}
.som-footer-wrap {
	display: none;
}
</style>
	';
	
	somryv_video_overriding_css();
	
	}

$small = $advoptions['somryv_video_size_small'];
$medium = $advoptions['somryv_video_size_medium'];
$large = $advoptions['somryv_video_size_large'];

echo '
<style>
';

if (strpos($large, '%') != true) {
	str_replace( "px" , "", $large );
	$large = $large + 170;
	echo '
@media (max-width: ' . $large . 'px) {
	.som-video-wrap.som-video-large {
		float: none!important;
		text-align: center!important;
		margin-left: auto!important;
		margin-right: auto!important;
		padding-bottom: 20px!important;
	}
}
';
} else {
	echo '
@media (max-width: 900px) {
	.som-video-wrap.som-video-large {
		float: none!important;
		text-align: center!important;
		margin-left: auto!important;
		margin-right: auto!important;
		padding-bottom: 20px!important;
	}
}
';
}

if (strpos($medium, '%') != true) {
	str_replace( "px" , "", $medium );
	$medium = $medium + 170;
	echo '
@media (max-width: ' . $medium . 'px) {
	.som-video-wrap.som-video-medium {
		float: none!important;
		text-align: center!important;
		margin-left: auto!important;
		margin-right: auto!important;
		padding-bottom: 20px!important;
	}
}
';
} else {
	echo '
@media (max-width: 600px) {
	.som-video-wrap.som-video-medium {
		float: none!important;
		text-align: center!important;
		margin-left: auto!important;
		margin-right: auto!important;
		padding-bottom: 20px!important;
	}
}
';
}

if (strpos($small, '%') != true) {
	str_replace( "px" , "", $small );
	$small = $small + 150;
	echo '
@media (max-width: ' . $small . 'px) {
	.som-video-wrap.som-video-small {
		float: none!important;
		text-align: center!important;
		margin-left: auto!important;
		margin-right: auto!important;
		padding-bottom: 20px!important;
	}
}
';
} else {
	echo '
@media (max-width: 400px) {
	.som-video-wrap.som-video-small {
		float: none!important;
		text-align: center!important;
		margin-left: auto!important;
		margin-right: auto!important;
		padding-bottom: 20px!important;
	}
}
';
}

echo '
</style>
';

	if ( $somryvsettings == 'som-responsive-youtube-videos' && $somryvsettingscolours == 'colour_settings' && ! $preview ) {
		
		echo '
<style>
.somryv-settings-style-videoimg {
	background-image: url("' . $videobg . '")!important;
}
.somryv-settings-desc-wrap .somryv-desc-wrap .somryv-desc {
	color: ' . $font . ';
	border-color: ' . $border . ';
	background-color: ' . $bg . ';
}
.somryv-desc-wrap.somryv-desc-wrap-4 .somryv-desc-corner-1  {
	border-color: ' . $border . ' transparent transparent transparent;
}

.somryv-desc-wrap.somryv-desc-wrap-5 .somryv-desc-corner-1 {
	border-color: ' . $border . ' transparent transparent transparent;
}

.somryv-desc-wrap.somryv-desc-wrap-5 .somryv-desc-corner-4 {
	border-color: transparent transparent ' . $border . ' transparent;
}

.somryv-desc-wrap.somryv-desc-wrap-6 .somryv-desc-corner-4 {
	background-color: ' . $border . ';
}
';
	}

	if ( $somryvsettings == 'som-responsive-youtube-videos' ) {
		echo '
<style>
.som-gen-shortcode-form-top {
	background-image: url("' . $youtubeicon . '")!important;
}
.somryv-settings-style-videoimg {
	background-image: url("' . $videobg . '")!important;
}
#wpfooter {
	display: none!important;
}
</style>
		';

	$ql_options = get_option( 'somryv_qload_settings' );
	$style = ( isset( $ql_options['somryv_play_button'] ) && $ql_options['somryv_play_button'] ) ? $ql_options['somryv_play_button'] : 1 ;
	$default_prime = somryv_get_default_qload_styles( $style, 'primary' );
	$default_arrow = somryv_get_default_qload_styles( $style, 'arrow' );
	$default_second = somryv_get_default_qload_styles( $style, 'secondary' );
	
	$ql_colours = get_option( 'somryv_qload_colour_settings' );
	$primary = ( isset( $ql_colours['somryv_prime_colour'] ) && $ql_colours['somryv_prime_colour'] ) ? $ql_colours['somryv_prime_colour'] : $default_prime ;
	$arrow = ( isset( $ql_colours['somryv_arrow_colour'] ) && $ql_colours['somryv_arrow_colour'] ) ? $ql_colours['somryv_arrow_colour'] : $default_arrow ;
	$secondary = ( isset( $ql_colours['somryv_second_colour'] ) && $ql_colours['somryv_second_colour'] ) ? $ql_colours['somryv_second_colour'] : $default_second ;

	echo '
<style>
.som-video-wrap .som-resp-video:hover .som-resp-video-play .som-resp-video-play-icon,
.som-video-wrap .som-resp-video-play.som-resp-video-play-nohover .som-resp-video-play-icon {
	border-color: rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) ' . $arrow . ';
}
.som-video-wrap .som-resp-video:hover .som-resp-video-play.som-resp-video-play,
.som-video-wrap .som-resp-video .som-resp-video-play.som-resp-video-play-nohover {
	background-color: ' . $primary . ';
}

.som-video-wrap .som-resp-video:hover .som-resp-video-play-3.som-resp-video-play,
.som-video-wrap .som-resp-video:hover .som-resp-video-play-4.som-resp-video-play,
.som-video-wrap .som-resp-video .som-resp-video-play-3.som-resp-video-play-nohover,
.som-video-wrap .som-resp-video .som-resp-video-play-4.som-resp-video-play-nohover {
	background-color: ' . $primary . ';
	border-color: ' . $secondary . ';
}
</style>
	';

	}

}

function getvideodescription( $desc, $descstyle ) {

	$description = '<div class="somryv-desc-wrap somryv-desc-wrap-' . $descstyle . '"><div class="somryv-desc-corner-1"></div><div class="somryv-desc-corner-2"></div><p class="somryv-desc somryv-desc-' . $descstyle . '">' . $desc . '</p><div class="somryv-desc-corner-3"></div><div class="somryv-desc-corner-4"></div></div>';

	return $description;

}

function somryv_get_colours_style_preview() {

	$descoptions = get_option( 'somryv_desc_settings' );
	$optionvalue = $descoptions['somryv_video_desc_style'];

	$desc = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
	$desccontent = getvideodescription( $desc, $optionvalue );?>
	<h3>Description Preview</h3>
	<div class="somryv-settings-style-videoimg"></div>
	<?php echo '<div class="somryv-settings-desc-wrap somryv-settings-preview">';
	echo $desccontent;
	echo '</div>';
	
}


function somryv_reset_colours( $value, $old_value ) {
	if ( $value != $old_value ) {
		$colouroptions = get_option( 'somryv_desc_colour_settings' );
		$colouroptions = somryv_set_default_styles( $colouroptions, $value['somryv_video_desc_style'], true );
	}
	return $value;
}

function somryv_set_default_styles( $colouroptions, $defaultstyle, $reset = false ) {

	/**
	 * ID, Font, BG, Border
	 */
	 
	$colours = somryv_get_default_colours();
	
	if ( !$colouroptions['somryv_video_desc_font'] || $reset ) {
		$colouroptions['somryv_video_desc_font'] = $colours[$defaultstyle]['font'];
	}
	if ( !$colouroptions['somryv_video_desc_border'] || $reset ) {
		$colouroptions['somryv_video_desc_border'] = $colours[$defaultstyle]['border'];
	}
	if ( !$colouroptions['somryv_video_desc_bg'] || $reset ) {
		$colouroptions['somryv_video_desc_bg'] = $colours[$defaultstyle]['bg'];
	}

	update_option('somryv_desc_colour_settings', $colouroptions); // update all the options

	return $colouroptions;

}

function somryv_get_default_styles( $defaultstyle, $type = '' ) {

	$colours = somryv_get_default_colours();
	
	if ( 'font' == $type ) {
		return $colours[$defaultstyle]['font'];
	} elseif ( 'border' == $type ) {
		return $colours[$defaultstyle]['border'];
	} elseif ( 'bg' == $type ) {
		return $colours[$defaultstyle]['bg'];
	} else {
		return $colours;
	}
}

function somryv_get_default_colours() {

	$colours = array
	(
	'1' => array(
		'font' => '#444',
		'bg' => '#eee',
		'border' => '#2679ce'
		),
	'2' => array(
		'font' => '#444',
		'bg' => '#eee',
		'border' => '#444'
		),
	'3' => array(
		'font' => '#444',
		'bg' => '#eee',
		'border' => '#cd201f'
		),
	'4' => array(
		'font' => '#333',
		'bg' => 'transparent',
		'border' => '#333'
		),
	'5' => array(
		'font' => '#333',
		'bg' => '#eee',
		'border' => '#333'
		),
	'6' => array(
		'font' => '#444',
		'bg' => 'transparent',
		'border' => '#444'
		),
	'7' => array(
		'font' => '#444',
		'bg' => '#eee',
		'border' => '#444'
		),
	'8' => array(
		'font' => '#444',
		'bg' => '#eee',
		'border' => '#2679ce'
		)
	);

	return $colours;

}

function somryv_set_default_qload_styles( $colouroptions, $defaultstyle, $reset = false ) {

	/**
	 * ID, Font, BG, Border
	 */
	 
	$colours = somryv_get_default_qload_styles();
	
	if ( !$colouroptions['somryv_video_desc_font'] || $reset ) {
		$colouroptions['somryv_video_desc_font'] = $colours[$defaultstyle]['primary'];
	}
	if ( !$colouroptions['somryv_video_desc_border'] || $reset ) {
		$colouroptions['somryv_video_desc_border'] = $colours[$defaultstyle]['secondary'];
	}

	update_option( 'somryv_desc_colour_settings', $colouroptions ); // update all the options

	return $colouroptions;

}

function somryv_get_default_qload_styles( $defaultstyle, $type = '' ) {

	$colours = somryv_get_default_qload_colours();
	
	if ( 'primary' == $type ) {
		return $colours[$defaultstyle]['primary'];
	} elseif ( 'arrow' == $type ) {
		return $colours[$defaultstyle]['arrow'];
	} elseif ( 'secondary' == $type ) {
		return $colours[$defaultstyle]['secondary'];
	} else {
		return $colours;
	}
}

function somryv_get_default_qload_colours() {

	$colours = array
	(
	'1' => array(
		'primary' => '#b31217',
		'arrow' => '#fff',
		'secondary' => '#fff'
		),
	'2' => array(
		'primary' => '#b31217',
		'arrow' => '#fff',
		'secondary' => '#fff'
		),
	'3' => array(
		'primary' => '#2d5986',
		'arrow' => '#fff',
		'secondary' => '#fff'
		),
	'4' => array(
		'primary' => '#2d5986',
		'arrow' => '#fff',
		'secondary' => '#fff'
		)
	);

	return $colours;

}