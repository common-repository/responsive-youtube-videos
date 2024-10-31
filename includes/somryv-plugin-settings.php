<?php
/**
 * Responsive YouTube Videos - Settings
 *
 * Settings fields and sections
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_enqueue_scripts', 'somryv_settings_includes' );

add_action( 'admin_menu', 'somryv_add_admin_menu' );
function somryv_add_admin_menu(  ) {
	add_plugins_page( 'Responsive Videos', 'Responsive Videos', 'manage_options', 'som-responsive-youtube-videos', 'somryv_options_page' );

}

add_action( 'admin_init', 'somryv_settings_init' );
function somryv_settings_init(  ) {

	register_setting( 'somryv_gen_settings', 'somryv_gen_settings' );
	
	register_setting( 'somryv_desc_settings', 'somryv_desc_settings' );
	
	register_setting( 'somryv_desc_colour_settings', 'somryv_desc_colour_settings' );

	register_setting( 'somryv_adv_settings', 'somryv_adv_settings' );

	register_setting( 'somryv_qload_settings', 'somryv_qload_settings' );

	register_setting( 'somryv_qload_colour_settings', 'somryv_qload_colour_settings' );

	add_settings_section(
		'somryv_general_settings_section', 
		__( 'General Settings', 'som-ryv' ), 
		'somryv_general_settings_section_callback', 
		'somryv_gen_settings'
	);

	add_settings_field( 
		'somryv_video_size_default', 
		__( 'Default video size', 'som-ryv' ), 
		'somryv_video_size_default_render', 
		'somryv_gen_settings', 
		'somryv_general_settings_section' 
	);

	add_settings_field( 
		'somryv_video_align_default', 
		__( 'Default video alignment', 'som-ryv' ), 
		'somryv_video_align_default_render', 
		'somryv_gen_settings', 
		'somryv_general_settings_section' 
	);

	add_settings_section(
		'somryv_desc_settings_section', 
		__( 'Description Settings', 'som-ryv' ), 
		'somryv_desc_settings_section_callback', 
		'somryv_desc_settings'
	);

	add_settings_field( 
		'somryv_video_desc_style', 
		__( 'Style', 'som-ryv' ), 
		'somryv_video_desc_style_render', 
		'somryv_desc_settings', 
		'somryv_desc_settings_section' 
	);

	add_settings_section(
		'somryv_desc_colour_settings_section', 
		__( 'Description Colour Settings', 'som-ryv' ), 
		'somryv_desc_colour_settings_section_callback', 
		'somryv_desc_colour_settings'
	);

	add_settings_field( 
		'somryv_video_desc_font', 
		__( 'Text Colour', 'som-ryv' ), 
		'somryv_video_desc_font_render', 
		'somryv_desc_colour_settings', 
		'somryv_desc_colour_settings_section' 
	);
	
	add_settings_field( 
		'somryv_video_desc_border', 
		__( 'Border Colour', 'som-ryv' ), 
		'somryv_video_desc_border_render', 
		'somryv_desc_colour_settings', 
		'somryv_desc_colour_settings_section' 
	);
	
	add_settings_field( 
		'somryv_video_desc_bg', 
		__( 'Background Colour', 'som-ryv' ), 
		'somryv_video_desc_bg_render', 
		'somryv_desc_colour_settings', 
		'somryv_desc_colour_settings_section' 
	);

	add_settings_section(
		'somryv_adv_settings_section', 
		__( 'Advanced Settings', 'som-ryv' ), 
		'somryv_adv_settings_section_callback', 
		'somryv_adv_settings'
	);

	add_settings_field( 
		'somryv_video_size_small', 
		__( 'Small size (px or %)', 'som-ryv' ), 
		'somryv_video_size_small_render', 
		'somryv_adv_settings', 
		'somryv_adv_settings_section' 
	);

	add_settings_field( 
		'somryv_video_size_medium', 
		__( 'Medium size (px or %)', 'som-ryv' ), 
		'somryv_video_size_medium_render', 
		'somryv_adv_settings', 
		'somryv_adv_settings_section' 
	);

	add_settings_field( 
		'somryv_video_size_large', 
		__( 'Large size (px or %)', 'som-ryv' ), 
		'somryv_video_size_large_render', 
		'somryv_adv_settings', 
		'somryv_adv_settings_section'  
	);

	add_settings_section(
		'somryv_qload_settings_section', 
		__( 'Quick Load Settings', 'som-ryv' ), 
		'somryv_qload_settings_section_callback', 
		'somryv_qload_settings'
	);

	add_settings_field( 
		'somryv_enable_qload', 
		__( 'Global Setting', 'som-ryv' ), 
		'somryv_enable_qload_render', 
		'somryv_qload_settings', 
		'somryv_qload_settings_section' 
	);

	add_settings_field( 
		'somryv_video_title', 
		__( 'Video Titles', 'som-ryv' ),
		'somryv_video_title_render', 
		'somryv_qload_settings', 
		'somryv_qload_settings_section' 
	);

	add_settings_section(
		'somryv_qload_settings_section_button', 
		__( 'Quick Load Play Button', 'som-ryv' ), 
		'somryv_qload_settings_section_two_callback', 
		'somryv_qload_settings'
	);

	add_settings_field( 
		'somryv_play_button', 
		__( 'Button Type', 'som-ryv' ), 
		'somryv_play_button_render', 
		'somryv_qload_settings', 
		'somryv_qload_settings_section_button',
		array( 'class' => 'somryv-play-tr' )
	);

	add_settings_field( 
		'somryv_play_button_action', 
		__( 'Hover Behaviour', 'som-ryv' ), 
		'somryv_play_button_action_render', 
		'somryv_qload_settings', 
		'somryv_qload_settings_section_button',
		array( 'class' => 'somryv-play-tr' )
	);

	add_settings_section(
		'somryv_qload_colour_settings_section', 
		__( 'Quick Load Colours', 'som-ryv' ), 
		'somryv_qload_colour_settings_section_callback', 
		'somryv_qload_colour_settings'
	);

	add_settings_field( 
		'somryv_prime_colour', 
		__( 'Background Colour', 'som-ryv' ), 
		'somryv_prime_colour_render', 
		'somryv_qload_colour_settings', 
		'somryv_qload_colour_settings_section'
	);

	add_settings_field( 
		'somryv_arrow_colour', 
		__( 'Play Icon Colour', 'som-ryv' ), 
		'somryv_arrow_colour_render', 
		'somryv_qload_colour_settings', 
		'somryv_qload_colour_settings_section'
	);

	add_settings_field( 
		'somryv_second_colour', 
		__( 'Secondary Colour', 'som-ryv' ), 
		'somryv_second_colour_render', 
		'somryv_qload_colour_settings', 
		'somryv_qload_colour_settings_section'
	);

}

function somryv_general_settings_section_callback() {
	echo __( '<p>Change the default video size and alignment for your videos. Shortcode generators will update to reflect this change.</p>', 'som-ryv' );
}

function somryv_desc_settings_section_callback() {
	echo __( '<p>Change the appearance of your video descriptions. The preview will update in real-time. Once you\'ve saved your choice, you can then go on to colours.</p>', 'som-ryv' );
}

function somryv_desc_colour_settings_section_callback() {
	echo __( '<p>Change the default colours for your chosen description style. The preview will update in real-time.</p>', 'som-ryv' );
}

function somryv_adv_settings_section_callback() {
	somryv_check_blank_video_sizes();
	echo __( '<p>Change the widths for each of the video sizes. Pixel or percentage values are accepted. Whatever sizes are entered, the video will always be responsive.<br><br>Empty values will be set to their defaults.</p>', 'som-ryv' );
}

function somryv_qload_settings_section_callback() {
	echo __( '<p><strong><em>Quick Load</em></strong> works by loading a video thumbnail first on the webpage, instead of the video. This allows the page to load quicker! Users then click the thumbnail to start the video.</p><p>The below preview will update in real-time. Once you\'ve saved your choice, you can then go on to Quick Load Colours.</p>', 'som-ryv' );
}

function somryv_qload_settings_section_two_callback() {
	echo __( '<p>Select which <em>play button</em> style you prefer.</p>', 'som-ryv' );
}

function somryv_qload_colour_settings_section_callback() {
	echo __( '<p>Customise the <em>Quick Load</em> colours. The preview will update in real-time.</p><p>For the purpose of this page the button is always visible.</p>', 'som-ryv' );
}


function somryv_video_size_default_render( $elemid = '' ) {

	$genoptions = get_option( 'somryv_gen_settings' );
	
	if ( ! $elemid ) { ?>
	<select name='somryv_gen_settings[somryv_video_size_default]'>
	<?php } else { ?>
	<select name='somryv_gen_settings[somryv_video_size_default]' id='<?php echo $elemid ?>'>
	<?php } ?>
		<option value='small' <?php selected( $genoptions['somryv_video_size_default'], 'small' ); ?>>Small</option>
		<option value='medium' <?php selected( $genoptions['somryv_video_size_default'], 'medium' ); ?>>Medium</option>
		<option value='large' <?php selected( $genoptions['somryv_video_size_default'], 'large' ); ?>>Large</option>
		<option value='full' <?php selected( $genoptions['somryv_video_size_default'], 'full' ); ?>>Full</option>
	</select>

	<?php

}

function somryv_video_align_default_render($elemid = '') {

	$genoptions = get_option( 'somryv_gen_settings' );
	
	if ( !$elemid ) { ?>
		<select name='somryv_gen_settings[somryv_video_align_default]'>
	<?php } else { ?>
	<select name='somryv_gen_settings[somryv_video_align_default]' id='<?php echo $elemid ?>'>
	<?php } ?>
		<option value='left' <?php selected( $genoptions['somryv_video_align_default'], 'left' ); ?>>Left</option>
		<option value='leftfloat' <?php selected( $genoptions['somryv_video_align_default'], 'leftfloat' ); ?>>Float Left</option>
		<option value='center' <?php selected( $genoptions['somryv_video_align_default'], 'center' ); ?>>Center</option>
		<option value='right' <?php selected( $genoptions['somryv_video_align_default'], 'right' ); ?>>Right</option>
		<option value='rightfloat' <?php selected( $genoptions['somryv_video_align_default'], 'rightfloat' ); ?>>Float Right</option>
	</select>

		<?php

}

function somryv_video_desc_font_render() {

	$descoptions = get_option( 'somryv_desc_settings' );
	$colours = get_option( 'somryv_desc_colour_settings' );
	$optionvalue = $colours['somryv_video_desc_font'];
	$style = $descoptions['somryv_video_desc_style'];

	$defaultfont = somryv_get_default_styles( $style, 'font' );

	//echo 'optionvalue = ' . $optionvalue . '<br><br>';
	//echo 'style = ' . $style . '<br><br>';
	//echo 'defaultfont = ' . $defaultfont . '<br><br>';
	
	?>

	<div class="somryv-wp-picker-container">
		<input type="text" name="somryv_desc_colour_settings[somryv_video_desc_font]" id="somryv-desc-font-colour" value="<?php echo $optionvalue; ?>" class="somryv-color-picker somryv-font-picker" data-default-color="<?php echo $defaultfont; ?>">
	</div>

<?php

}

function somryv_video_desc_border_render() {

	$descoptions = get_option( 'somryv_desc_settings' );
	$colours = get_option( 'somryv_desc_colour_settings' );
	$optionvalue = $colours['somryv_video_desc_border'];
	$style = $descoptions['somryv_video_desc_style'];

	$defaultborder = somryv_get_default_styles( $style, 'border' );

	//echo 'optionvalue = ' . $optionvalue . '<br><br>';
	//echo 'style = ' . $style . '<br><br>';
	//echo 'defaultborder = ' . $defaultborder . '<br><br>';
	
	?>

	<div class="somryv-wp-picker-container">
		<input type="text" name="somryv_desc_colour_settings[somryv_video_desc_border]" id="somryv-desc-border-colour" value="<?php echo $optionvalue; ?>" class="somryv-color-picker somryv-border-picker" data-default-color="<?php echo $defaultborder; ?>">
	</div>

<?php

}

function somryv_video_desc_bg_render() {

	$descoptions = get_option( 'somryv_desc_settings' );
	$colours = get_option( 'somryv_desc_colour_settings' );
	$optionvalue = $colours['somryv_video_desc_bg'];
	$style = $descoptions['somryv_video_desc_style'];

	$defaultbg = somryv_get_default_styles( $style, 'bg' );

	//echo 'optionvalue = ' . $optionvalue . '<br><br>';
	//echo 'style = ' . $style . '<br><br>';
	//echo 'defaultbg = ' . $defaultbg . '<br><br>';
	
	?>

	<div class="somryv-wp-picker-container">
		<input type="text" name="somryv_desc_colour_settings[somryv_video_desc_bg]" id="somryv-desc-bg-colour" value="<?php echo $optionvalue; ?>" class="somryv-color-picker somryv-bg-picker" data-default-color="<?php echo $defaultbg; ?>">
	</div>

<?php

}

function somryv_video_desc_style_render() {

	$descoptions = get_option( 'somryv_desc_settings' );
	$optionvalue = $descoptions['somryv_video_desc_style'];

	$i = 1;

	while ( $i <= 8 ) {

		$desc = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
		$desccontent = getvideodescription( $desc, $i ); ?>
			
		<div class="somryv-settings-style-wrap">
			<label for="somryv_desc_style_<?php echo $i; ?>">Style <?php echo $i; ?></label>
				<input type="radio" class="somryv-desc-style-radio" id="somryv_desc_style_<?php echo $i; ?>" name="somryv_desc_settings[somryv_video_desc_style]" value="<?php echo $i; ?>" <?php checked( $i, $optionvalue, true ); ?>>
		</div>
		<?php $i++;
	
	}
	
		//<div class="somryv-colour-settings-preview">
		//somryv_get_colours_style_preview();
		//</div>

}

function somryv_video_desc_colours_render() {
	
	$descoptions = get_option( 'somryv_desc_settings' );
	
	print_r($descoptions['somryv_video_desc_style']);
	
}


function somryv_video_size_small_render() {

	$advoptions = get_option( 'somryv_adv_settings' );
	$smallsize = $advoptions['somryv_video_size_small'];

	?>

	<input type='text' name='somryv_adv_settings[somryv_video_size_small]' value='<?php echo $smallsize; ?>'>

	<?php

}

function somryv_video_size_medium_render() {

	$advoptions = get_option( 'somryv_adv_settings' );
	$mediumsize = $advoptions['somryv_video_size_medium'];

	?>

	<input type='text' name='somryv_adv_settings[somryv_video_size_medium]' value='<?php echo $mediumsize; ?>'>

	<?php

}

function somryv_video_size_large_render() {

	$advoptions = get_option( 'somryv_adv_settings' );
	$largesize = $advoptions['somryv_video_size_large'];

	?>

	<input type='text' name='somryv_adv_settings[somryv_video_size_large]' value='<?php echo $largesize; ?>'>

	<?php

}

function somryv_enable_qload_render() {

	$options = get_option( 'somryv_qload_settings' ); ?>
	
	<label for="somryv_qload_settings[somryv_enable_qload]">
	<input type="checkbox" name="somryv_qload_settings[somryv_enable_qload]" id="somryv_qload_settings[somryv_enable_qload]"
	<?php $checked = isset( $options['somryv_enable_qload'] ) ? checked( $options['somryv_enable_qload'], true ) : '' ; ?>
		value="1">
		Enable Quick Load
	</label>
	<p class="description">Choose whether to enable or disable this feature.</p>
	<?php

}

function somryv_video_title_render() { ?>

	<p>Choose how to display the video title on the <em>Quick Load</em> thumbnail.<br><br></p>

	<?php

	$options = get_option( 'somryv_qload_settings' );
	$optionvalue = ( isset( $options['somryv_video_title'] ) && $options['somryv_video_title'] ) ? $options['somryv_video_title'] : 1 ;

	?>

	<div class="somryv-setting-wrapper">
	<label for="somryv_video_title_1">

	<input type="radio" class="somryv-play-title-type" id="somryv_video_title_1" name="somryv_qload_settings[somryv_video_title]" value="1" <?php checked( 1, $optionvalue, true ); ?>>

	Don't show the video title
	</label>
	<p class="description">Disable the display of the video title (default).</p>
	
	</div>
	
	<div class="somryv-setting-wrapper">

	<label for="somryv_video_title_2">

	<input type="radio" class="somryv-play-title-type" id="somryv_video_title_2" name="somryv_qload_settings[somryv_video_title]" value="2" <?php checked( 2, $optionvalue, true ); ?>>

	Always show the title
	</label>
	<p class="description">The title of the video will be displayed on the thumbnail.</p>

	</div>

	<div class="somryv-setting-wrapper">

	<label for="somryv_video_title_3">

	<input type="radio" class="somryv-play-title-type" id="somryv_video_title_3" name="somryv_qload_settings[somryv_video_title]" value="3" <?php checked( 3, $optionvalue, true ); ?>>

	Show only on mouse over
	</label>
	<p class="description">Only show the title when the mouse hovers over the thumbnail.</p>

	</div>

	<?php

}

function somryv_play_button_render() {

	$options = get_option( 'somryv_qload_settings' );

	$button = ( isset( $options['somryv_play_button'] ) && $options['somryv_play_button'] ) ? $options['somryv_play_button'] : 1 ;

	$i = 1; ?>
	
	<h3>Play Button Style</h3>
	
	<div class="somryv-settings-radios-wrap">

	<?php while ( $i <= 4 ) {

	?>
			
		<div class="somryv-settings-style-wrap">
			<label for="somryv_desc_style_<?php echo $i; ?>">Style <?php echo $i; ?></label>
				<input type="radio" class="somryv-desc-style-radio somryv-play-button-type" id="somryv_desc_style_<?php echo $i; ?>" name="somryv_qload_settings[somryv_play_button]" value="<?php echo $i; ?>" <?php checked( $i, $button, true ); ?>>
		</div>
		<?php $i++;
		
	} ?>
	
	</div>

	<div class="somryv-qload-settings-preview">
		<?php echo do_shortcode( '[somryv url="h9XJx2rvUO8" size="full" align="center"]' ); ?>
	</div>
	
	<?php

}

function somryv_play_button_action_render() { ?>

	<h3>Play Button Behaviour</h3>

	<p>Choose how the play button behaves when hovered with the mouse.<br><br></p>

	<?php

	$options = get_option( 'somryv_qload_settings' );
	$optionvalue = ( isset( $options['somryv_play_button_action'] ) && $options['somryv_play_button_action'] ) ? $options['somryv_play_button_action'] : 1 ;

	?>

	<div class="somryv-setting-wrapper">
	<label for="somryv_play_button_action_1">

	<input type="radio" class="somryv-play-hover-type" id="somryv_play_button_action_1" name="somryv_qload_settings[somryv_play_button_action]" value="1" <?php checked( 1, $optionvalue, true ); ?>>

	Fade in colour on hover
	</label>
	<p class="description">Initially muted, changes colour when hovered with mouse (default).</p>
	
	</div>
	
	<div class="somryv-setting-wrapper">

	<label for="somryv_play_button_action_2">

	<input type="radio" class="somryv-play-hover-type" id="somryv_play_button_action_2" name="somryv_qload_settings[somryv_play_button_action]" value="2" <?php checked( 2, $optionvalue, true ); ?>>

	Always full colour
	</label>
	<p class="description">Play button remains full colour, no hover behaviour.</p>

	</div>

	<?php

}

function somryv_prime_colour_render() {

	$ql_options = get_option( 'somryv_qload_settings' );
	$style = ( isset( $ql_options['somryv_play_button'] ) && $ql_options['somryv_play_button'] ) ? $ql_options['somryv_play_button'] : 1 ;
	$defaultcolour = somryv_get_default_qload_styles( $style, 'primary' );

	$colours = get_option( 'somryv_qload_colour_settings' );
	$optionvalue = ( isset( $colours['somryv_prime_colour'] ) && $colours['somryv_prime_colour'] ) ? $colours['somryv_prime_colour'] : $defaultcolour ;

	?>

	<div class="somryv-wp-picker-container">
		<input type="text" name="somryv_qload_colour_settings[somryv_prime_colour]" value="<?php echo $optionvalue; ?>" class="somryv-color-picker somryv-primary-picker" data-default-color="<?php echo $defaultcolour; ?>">
	</div>

<?php


}

function somryv_arrow_colour_render() {

	$ql_options = get_option( 'somryv_qload_settings' );
	$style = ( isset( $ql_options['somryv_play_button'] ) && $ql_options['somryv_play_button'] ) ? $ql_options['somryv_play_button'] : 1 ;
	$defaultcolour = somryv_get_default_qload_styles( $style, 'arrow' );

	$colours = get_option( 'somryv_qload_colour_settings' );
	$optionvalue = ( isset( $colours['somryv_arrow_colour'] ) && $colours['somryv_arrow_colour'] ) ? $colours['somryv_arrow_colour'] : $defaultcolour ;

	?>

	<div class="somryv-wp-picker-container">
		<input type="text" name="somryv_qload_colour_settings[somryv_arrow_colour]" value="<?php echo $optionvalue; ?>" class="somryv-color-picker somryv-arrow-picker" data-default-color="<?php echo $defaultcolour; ?>">
	</div>

<?php

}

function somryv_second_colour_render() {

	$ql_options = get_option( 'somryv_qload_settings' );
	$style = ( isset( $ql_options['somryv_play_button'] ) && $ql_options['somryv_play_button'] ) ? $ql_options['somryv_play_button'] : 1 ;
	$defaultcolour = somryv_get_default_qload_styles( $style, 'secondary' );

	$colours = get_option( 'somryv_qload_colour_settings' );
	$optionvalue = ( isset( $colours['somryv_second_colour'] ) && $colours['somryv_second_colour'] ) ? $colours['somryv_second_colour'] : $defaultcolour ;

	?>

	<div class="somryv-wp-picker-container">
		<input type="text" name="somryv_qload_colour_settings[somryv_second_colour]" value="<?php echo $optionvalue; ?>" class="somryv-color-picker somryv-secondary-picker" data-default-color="<?php echo $defaultcolour; ?>">
	</div>

<?php

}