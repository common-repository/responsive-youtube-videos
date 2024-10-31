<?php
/**
 * Responsive YouTube Videos - Main Tab
 *
 * The content for plugin main tab
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php $youtubeicon = plugins_url( '/assets/images/youtube-icon.png', dirname(__FILE__) ); ?>

<div class="somryv-container">
	<div class="somryv-row">
	
		<div class="somryv-col-6 some-main-plugin-content">
			<div class="description">
				<p>This plugin provides users with an easy way to embed YouTube and Vimeo videos in their website that are completely mobile responsive, ready for any device. Videos will look great on PC, laptop, tablet, or smartphone. Users can also customise the size and presentation of their video.</p>
				<p>Use the simple and intuitive <img class="somryv-text-img" src="<?php echo $youtubeicon; ?>"> button provided on post and page text editors to insert a shortcode right inside your post editor, or generate a shortcode using the shortcode generator on this page.</p>
				<p>A new widget called Responsive Video can also be added, and a video shortcode placed in there.</p>
				<p>The shortcode can even be previewed before it is generated, allowing users to tweak it as needed.</p>
			</div>
		</div>
		
		<div class="somryv-col-6 some-main-plugin-content somryv-video-guide">
			<h3>Demo Example</h3>
			<?php echo do_shortcode( '[somryv url="h9XJx2rvUO8" size="medium" align="center" desc="Post pagination in WordPress."]' ); ?>
		</div>
		
	</div>
</div>
