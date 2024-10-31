<?php
/**
 * Responsive YouTube Videos - Settings Tab
 *
 * The content for plugin settings tab
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="somryv-container">
	<div class="somryv-row">
		<div class="somryv-col-12">

			<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings'; ?>

			<ul class="subsubsub">
				<li><a href="?page=som-responsive-youtube-videos&section=settings_section&tab=general_settings" class="<?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>">General</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=settings_section&tab=description_settings" class="<?php echo $active_tab == 'description_settings' ? 'nav-tab-active' : ''; ?>">Descriptions</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=settings_section&tab=colour_settings" class="<?php echo $active_tab == 'colour_settings' ? 'nav-tab-active' : ''; ?>">Description Colours</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=settings_section&tab=advanced_settings" class="<?php echo $active_tab == 'advanced_settings' ? 'nav-tab-active' : ''; ?>">Advanced</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=settings_section&tab=quickload_settings" class="<?php echo $active_tab == 'quickload_settings' ? 'nav-tab-active' : ''; ?>">Quick Load</a> <span class="somdn-ui-new" style="">New</span> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=settings_section&tab=quickload_colour_settings" class="<?php echo $active_tab == 'quickload_colour_settings' ? 'nav-tab-active' : ''; ?>">Quick Load Colours</a> <span class="somdn-ui-new" style="">New</span></li>
			</ul>

		</div>
	</div>

	<div class="somryv-row">
		<div class="somryv-col-12">

	<form class="somryv-settings-form" action='options.php' method='post'>

	<?php

	if( $active_tab == 'general_settings' ) { ?>
	
		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6">

					<div class="somryv-gen-settings-form-wrap">
						<?php do_settings_sections( 'somryv_gen_settings' );
						settings_fields( 'somryv_gen_settings' ); ?>
					</div>
					
				</div>
				
			</div>
		</div>
		
	<?php } elseif ( $active_tab == 'description_settings' ) { ?>
	
		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6">
	
					<div class="somryv-desc-settings-form-wrap">
						<?php do_settings_sections( 'somryv_desc_settings' );
						settings_fields( 'somryv_desc_settings' ); ?>
					</div>
					
				</div>
					
				<div class="somryv-col-6">
				
					<div class="somryv-colour-settings-preview">
						<?php somryv_get_colours_style_preview(); ?>
					</div>	
									
				</div>
					
			</div>
		</div>
		
		<div class="somryv-style-settings-warning">
			<p>&#42; Saving a new style will reset any colour changes.</p>
		</div>
		
	<?php } elseif ( $active_tab == 'colour_settings' ) { ?>
	
		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6">
	
					<div class="somryv-colour-settings-form-wrap">
						<?php do_settings_sections( 'somryv_desc_colour_settings' );
						settings_fields( 'somryv_desc_colour_settings' ); ?>
					</div>
					
				</div>
				
				<div class="somryv-col-6">
				
					<div class="somryv-colour-settings-preview">
						<?php somryv_get_colours_style_preview(); ?>
					</div>
					
				</div>
				
			</div>
		</div>
		
	<?php } elseif ( $active_tab == 'advanced_settings' ) { ?>

		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6">

					<div class="somryv-adv-settings-form-wrap">
						<?php do_settings_sections( 'somryv_adv_settings' );
						settings_fields( 'somryv_adv_settings' ); ?>
					</div>
					
				</div>

			</div>
		</div>

	<?php } elseif ( $active_tab == 'quickload_settings' ) { ?>
	
		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-8">
	
					<div class="somryv-qload-settings-form-wrap">
						<?php do_settings_sections( 'somryv_qload_settings' );
						settings_fields( 'somryv_qload_settings' ); ?>
					</div>
					
				</div>
					
			</div>
		</div>

	<?php } elseif ( $active_tab == 'quickload_colour_settings' ) { ?>
	
		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6">
	
					<div class="somryv-qload-settings-form-wrap">
						<?php do_settings_sections( 'somryv_qload_colour_settings' );
						settings_fields( 'somryv_qload_colour_settings' ); ?>
					</div>
					
				</div>

				<div class="somryv-col-6">
	
					<div class="somryv-qload-settings-preview somryv-qload-colour-preview">
						<?php echo do_shortcode( '[somryv url="h9XJx2rvUO8" size="full" align="center"]' ); ?>
						<p class="description" style="padding-top: 15px;">Note: Mouse hover feature disabled for colour preview.</p>
					</div>
					
				</div>
					
			</div>
		</div>

	<?php }
	
		submit_button();
	
	?>

	</form>
	
		</div>
	</div>
</div>