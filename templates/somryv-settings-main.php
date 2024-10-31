<?php
/**
 * Responsive YouTube Videos - Settings Main Page
 *
 * The content and layout for the plugin settings main page
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php include_once( SOMRYV_PATH . 'templates/somryv-settings-header.php' ); ?>
	
<div class="som-settings-main-wrap">

<div class="somryv-container">
	<div class="somryv-row">
		<div class="somryv-col-12 some-main-plugin-content">
			<h1>Responsive Videos</h1>
		</div>
	</div>
</div>

<div class="somryv-container somryv-errors">
	<div class="somryv-row">
		<div class="somryv-col-12">
			<?php settings_errors(); ?>
		</div>
	</div>
</div>

<div class="somryv-container som-no-java">
	<div class="somryv-row">
		<div class="somryv-col-12">
			<h3>The shortcode generator features in this plugin require javascript to work.</h3>
		</div>
	</div>
</div>

<div class="somryv-container">
	<div class="somryv-row">
		<div class="somryv-col-12">
			<?php include_once( SOMRYV_PATH . 'templates/somryv-settings-tabs.php' ); ?>
		</div>
	</div>
</div>

</div>