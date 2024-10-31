<?php
/**
 * Responsive YouTube Videos - Settings Preview Page
 *
 * The content and layout for the plugin shortcode preview page
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
$urlfull = '';

$type = isset( $_GET['type'] ) ? $_GET['type'] : '' ;
$urlfull .= ' type="' . $type .'"';

$url_raw = isset( $_GET['url'] ) ? $_GET['url'] : '' ;

$url = ' url="' . $url_raw .'"';
$urlfull .= $url;

$size_raw = isset( $_GET['size'] ) ? $_GET['size'] : '' ;
$size = ' size="' . $size_raw  . '"';

$urlfull .= $size;

$align_raw = isset( $_GET['align'] ) ? $_GET['align'] : '' ;
$align = ' align="' . $align_raw . '"';

$urlfull .= $align;

$link = isset( $_GET['link'] ) ? $_GET['link'] : '' ;
if ( $link ) {
	$link = ' link="' . $link . '"';
	$urlfull .= $link;
}
$desc = isset( $_GET['desc'] ) ? $_GET['desc'] : '' ;
if ( $desc ) {
	$desc = ' desc="' . $desc . '"';
	$urlfull .= $desc;
}
$start = isset( $_GET['start'] ) ? $_GET['start'] : '' ;
if ( $start ) {
	$start = ' start="' . $start . '"';
	$urlfull .= $start;
}
 
?>
<?php $logo = plugins_url( '/assets/images/logo-white.png', dirname(__FILE__) ); ?>
<div class="somryv-preview-close-wrap fixed">
	<img class="som-brand-img" src="<?php echo $logo ?>">
	<input class="somryv-preview-close-button button button-primary" type="button" value="Close Preview">
</div>

<div class="somryv-container somryv-preview">
	<div class="somryv-row">
		<div class="somryv-col-12">
	<h1>Square One Media<br>Responsive Videos</h1>
	<h2>Preview</h2>
	<div class="description"><p>Below is a demo preview of how your video will appear if it were in a post.<br>
	Note: Your theme will change the text font and link styles on your live site.</p></div>
		</div>
	</div>
</div>

<div class="somryv-container somryv-preview-container-wrap">
	<div class="somryv-row">
		<div class="somryv-col-12 somryv-preview-container">
		<h1>Some post title</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean interdum lacinia tortor, non fermentum lectus volutpat ac. Pellentesque sit amet diam tortor. Aenean sit amet venenatis mauris, eget auctor tellus. Etiam porta nisl at purus hendrerit elementum. Vestibulum fermentum at turpis nec auctor. Etiam eleifend diam quis mi sagittis, eu vehicula odio ornare. Vestibulum fermentum interdum urna vitae rutrum. Nunc at lobortis nisi, ornare tincidunt arcu.</p>

		<?php echo do_shortcode('[somryv' . $urlfull . ']'); ?>

		<p>Maecenas dapibus libero at ex faucibus, vitae consequat odio porta. Sed sodales pellentesque enim, dignissim viverra sem egestas id. Fusce a feugiat mi. Ut semper ante sit amet libero consectetur condimentum. Quisque sit amet volutpat nisl, vitae scelerisque quam. Mauris accumsan purus eget finibus posuere. Maecenas dapibus leo et sapien iaculis, nec tempor sem euismod. Cras non diam eget justo rhoncus finibus iaculis sed eros.</p>
		<p>Praesent auctor ac erat sit amet dictum. Praesent vitae lorem nec sem aliquam tempus id ut dolor. Ut suscipit lorem non neque dapibus, vitae rhoncus dui fringilla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non cursus turpis, eu sodales tortor.</p>
		
		<p>Proin ut orci vestibulum, euismod tortor vel, posuere nunc. Mauris interdum mauris ut dignissim volutpat. Sed ut fermentum arcu, et dapibus metus. Duis consequat aliquam metus, quis elementum purus. Donec facilisis arcu nisi, commodo pharetra erat cursus et. Curabitur vitae condimentum diam. Suspendisse facilisis quam eget eros elementum, at fringilla magna ullamcorper. Nam et ipsum a nunc pellentesque interdum.</p>
		
		</div>
	</div>
</div>

<div class="somryv-preview-close-wrap abs">
	<input class="somryv-preview-close-button button button-primary" type="button" value="Close Preview">
</div>