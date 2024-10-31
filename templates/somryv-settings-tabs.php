<?php
/**
 * Responsive YouTube Videos - Settings Page Tabs
 *
 * The tabbed page content
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php $active_section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : 'general_section'; ?>


<div class="somryv-container">
	<div class="somryv-row">
		<div class="somryv-col-12">
		
<h2 class="nav-tab-wrapper">
	<a href="?page=som-responsive-youtube-videos&section=general_section" class="nav-tab <?php echo $active_section == 'general_section' ? 'nav-tab-active' : ''; ?>">Home</a>
	<a href="?page=som-responsive-youtube-videos&section=settings_section" class="nav-tab <?php echo $active_section == 'settings_section' ? 'nav-tab-active' : ''; ?>">Settings</a>
	<a href="?page=som-responsive-youtube-videos&section=generator_section" class="nav-tab <?php echo $active_section == 'generator_section' ? 'nav-tab-active' : ''; ?>">Shortcode Generator</a>
	<a href="?page=som-responsive-youtube-videos&section=support_section" class="nav-tab <?php echo $active_section == 'support_section' ? 'nav-tab-active' : ''; ?>">Support</a>
</h2>

		</div>
	</div>
</div>

	<?php if ( $active_section == 'general_section' ) { ?>
	
		<?php include_once( SOMRYV_PATH . 'templates/somryv-settings-tab-main.php' ); ?>

	<?php } elseif ( $active_section == 'settings_section' ) { ?>
	
		<?php include_once( SOMRYV_PATH . 'templates/somryv-settings-tab-settings.php' ); ?>

	<?php } elseif ( $active_section == 'generator_section' ) { ?>
	
		<?php include_once( SOMRYV_PATH . 'templates/somryv-settings-tab-generator.php' ); ?>

	<?php } elseif ( $active_section == 'support_section' ) { ?>
	
		<?php include_once( SOMRYV_PATH . 'templates/somryv-settings-tab-support.php' ); ?>

	<?php } else { ?>
	
	
	<?php } ?>