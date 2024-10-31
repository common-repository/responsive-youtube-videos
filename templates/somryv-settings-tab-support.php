<?php
/**
 * Responsive YouTube Videos - Support Tab
 *
 * The content for plugin support
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

			<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'guide'; ?>

			<ul class="subsubsub">
				<li><a href="?page=som-responsive-youtube-videos&section=support_section&tab=guide" class="<?php echo $active_tab == 'guide' ? 'nav-tab-active' : ''; ?>">Guide</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=support_section&tab=shortcode" class="<?php echo $active_tab == 'shortcode' ? 'nav-tab-active' : ''; ?>">Shortcode</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=support_section&tab=widget" class="<?php echo $active_tab == 'widget' ? 'nav-tab-active' : ''; ?>">Widget</a> | </li>
				<li><a href="?page=som-responsive-youtube-videos&section=support_section&tab=other" class="<?php echo $active_tab == 'other' ? 'nav-tab-active' : ''; ?>">Other</a></li>
			</ul>

		</div>
	</div>

	<div class="somryv-row">
		<div class="somryv-col-12">

	<form class="somryv-settings-form" action='options.php' method='post'>

	<?php

	if( $active_tab == 'guide' ) { ?>
	
		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6 some-main-plugin-content">
					
					<?php $youtubeicon = plugins_url( '/assets/images/youtube-icon.png', dirname(__FILE__) ); ?>

					<h2>User Guide</h2>
					<p>The easiest way to generate a video shortcode is to use the YouTube icon <img class="somryv-text-img" src="<?php echo $youtubeicon; ?>"> button on post and page text editors, or use the shortcode generator on this plugin page. The shortcode generator requires that you have JavaScript enabled in your browser.</p>
					
					<h2>Shortcode Generator</h2>
					<ul>
						<li><h3>Video Type</h3>Either YouTube or Vimeo.</li>
						<li><h3>Video URL</h3>The full URL of the YouTube or Vimeo video, or the video ID number.<br><br>For example: <strong>https://www.youtube.com/watch?v=h9XJx2rvUO8</strong><br><br>Or simply: <strong>h9XJx2rvUO8</strong></li>
						<li><h3>Size</h4>How big it should appear on a page. Whatever size is chosen, the video will always be responsive and never overflow other content. For example, if you choose Large but your content area is only small, the video will fill to the edges of that area, and never go outside. Full size means 100% width of the available space.</li>
						<li><h3>Alignment</h3>The position of the video on the page. Depending on the screen size, videos will automatically become centered when the video width is the same as the screen width.</li>
						<li><h3>Include Link</h3>Whether a direct link to the video is displayed below it.</li>
						<li><h3>Description</h3>An optional field. Text that will display below the video, styled as chosen in the Description settings tab.</li>
						<li><h3>Start Time (s)</h3>In seconds, what point the video should start to play from. For example, if you want to start the video 1 minute in, put 60 in this box.</li>
						<li><h3>Preview</h3>A new page will open showing a preview of how the video will look. Good for checking the URL is working and how your size/alignment settings look.</li>
					</ul>

				</div>
				
				<div class="somryv-col-6 some-main-plugin-content">
					<div class="somryv-settings-img-wrap">
						<?php $generatorimage = plugins_url( '/screenshot-3.png', dirname(__FILE__) ); ?>
						<img src="<?php echo $generatorimage; ?>" alt="image of shortcode generator">
						<p><em>Shortcode generator from the text editor.</em></p>
					</div>
						<div class="somryv-settings-img-wrap">
						<?php $settingsgeneratorimage = plugins_url( '/screenshot-5.png', dirname(__FILE__) ); ?>
						<img src="<?php echo $settingsgeneratorimage; ?>" alt="image of shortcode generator">
						<p><em>Shortcode generator from the settings page.</em></p>
					</div>
				</div>
				
			</div>
		</div>
		
	<?php } elseif ( $active_tab == 'shortcode' ) { ?>
		
			<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6 some-main-plugin-content">

					<h2>Shortcode</h2>
					<p>The shortcode works like any other plugin shortcode. Below is a guide on how it is made, for your information or if you have to write one out manually.</p>
					
					<h2>Full Example</h2>
					<p><strong>[somryv url="bNCT6pA5I9A" size="large" align="center" link="true" desc="Some description text." start="60"]</strong></p>
					<p>The only required value is url. Everything else if left out will be their default values. Example:</p>
					<p><strong>[somryv url="bNCT6pA5I9A"]</strong></p>
					<ul>
						<li><h3>somryv</h3>This is the first word after the opening bracket. Without it the shortcode won't work.</li>
						<li><h3>url</h3>The only required option. This needs to be the YouTube video ID number. The shortcode generators can pull this from the link, but when writing this manually use only the video ID.</li>
						<li><h3>size</h4>Available sizes: small, medium, large, full. Default if blank will be your chosen default size. Full size means 100% width of the available space.</li>
						<li><h3>align</h3>Available alignments: left, leftfloat, center, right, rightfloat. Default if blank will be your chosen video alignment.</li>
						<li><h3>link</h3>Either true or false. Default if blank is false.</li>
						<li><h3>description</h3>Optional, write a simple text description.</li>
						<li><h3>start</h3>How many seconds into the video it should start from. Default if blank will be 0.</li>
					</ul>

				</div>
				
			</div>
		</div>

		<?php } elseif ( $active_tab == 'widget' ) { ?>
		
			<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6 some-main-plugin-content">

					<h2>Widget</h2>
					<p>This plugin adds a cool widget that you can place a shortcode in to display a video anywhere on your site that has widgets. It's called Responsive Video. Just use the shortcode generator (link provided on the widget also) and place it in the text box. Done!</p>

					<p>Whatever size you choose, the video will never be larger than the widget area, just like anywhere else on your site.</p>

				</div>
				
				<div class="somryv-col-6 some-main-plugin-content">
					<div class="somryv-settings-img-wrap">
						<?php $widgetimage = plugins_url( '/screenshot-4.png', dirname(__FILE__) ); ?>
						<img src="<?php echo $widgetimage; ?>" alt="image of widget">
					</div>
				</div>
				
			</div>
		</div>
	
	<?php } else { ?>

		<div class="somryv-container">
			<div class="somryv-row">
			
				<div class="somryv-col-6 some-main-plugin-content">

					<h2>Other</h2>
					<p>If you need further support please visit the support forum for this plugin over at <a href="https://wordpress.org/support/plugin/responsive-youtube-videos" target="_blank">WordPress.org</a></p>

				</div>
				
			</div>
		</div>
		
	<?php } ?>

	</form>
	
		</div>
	</div>
</div>

