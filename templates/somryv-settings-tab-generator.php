<?php
/**
 * Responsive YouTube Videos - Settings Shortcode Generator
 *
 * The content and layout for the plugin shortcode generator page
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="somryv-container">
	<div class="somryv-row">
		<div class="somryv-col-4">
		
		<p>Use this intuitive, easy-to-use generator to create a video shortcode you can place in any post, page, or in a Reponsive YouTube Videos widget.</p>

<input id="somryv-open-shortcode" class="button button-primary" type="button" value="Get Started">
<div id="som-gen-shortcode-form-wrap" class="shortcode-wrap">
	<div id="som-gen-shortcode-form" class="som-gen-shortcode-form">
		<div class="som-inline-form som-gen-shortcode-form-top">
			<h2>Shortcode Generator</h2><a href="" id="somryv-icon-close" class="somryv-icon-close"><span class="dashicons dashicons-no"></span></a>
		</div>
		<div id="som-gen-shortcode-form-middle" class="som-gen-shortcode-form-middle">
		<div id="som-gen-shortcode-form-middle-wrap" class="som-gen-shortcode-form-middle-wrap">
			<div class="som-inline-form">
				<label for="shorttype">Type</label>
					<select name="shorttype" id="shorttype">
						<option value="youtube" selected>YouTube</option>
						<option value="vimeo">Vimeo</option>
					</select>
			</div>
			<div class="som-inline-form">
				<label for="somryv-videourl-box">Video url</label>
				<input type="text" id="somryv-videourl-box" spellcheck="false" value="">
			</div>
			<div class="som-inline-form">
				<label for="shortgensize">Size</label>
				<?php somryv_video_size_default_render("shortgensize"); ?>
			</div>
			<div class="som-inline-form">
				<label for="shortgenalign">Alignment</label>
				<?php somryv_video_align_default_render("shortgenalign"); ?>
			</div>
			<div class="som-inline-form" style="display: none!important;">
				<label for="videolink">Include link?</label>
				<input type="checkbox" id="videolink">
			</div>
			<div class="som-inline-form">
				<label for="videodesc">Description</label>
				<input type="text" id="videodesc" placeholder="(Optional)" value="">
			</div>
			<div class="som-inline-form">
				<label for="videostart">Start time (s)</label>
				<input type="text" spellcheck="false" id="videostart" placeholder="(Optional)">
			</div>
			<div class="som-inline-form button-center">
				<input class="somryv-preview button" type="button" value="Full Preview">
				<?php $previewurl = get_admin_url() . 'plugins.php?page=som-responsive-youtube-videos'; ?>
				<input type="hidden" id="somryv-preview-link" value="<?php echo $previewurl; ?>">
			</div>
		</div>
			<div class="som-inline-form bottom button-center">
				<input id="somryv-get-shortcode" class="button button-primary" type="button" value="Generate">
				<input id="somryv-cancel" class="button" type="button" value="Cancel">
			</div>
		</div>
		<div id="som-gen-shortcode-form-bottom" class="som-gen-shortcode-form-bottom">
			<div class="som-inline-form som-inline-form-pad-top">
				<label for="shortcodefull" class="som-inline-form-label-center">Copy the below:</label>
				<textarea id="shortcodefull" spellcheck="false"></textarea>

				<?php 
				/**
				 * The button to copy the shortcode
				 * doesn't work on Safari.
				 * The below check will only create
				 * the button on non Safari browsers.
				 */

				$safari = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
				$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;
				if ( !$safari || $chrome ) { ?>
				<button copytarget="shortcodefull" id="somryv-copy" class="button" type="button">Copy to Clipboard</button>
					<div id="somryv-copy-confirm"><span class="dashicons dashicons-yes"></span></div>
				<?php } ?>
			</div>	
			<div class="som-inline-form button-center">
				<input class="somryv-preview button" type="button" value="Full Preview">
				<?php $previewurl = get_admin_url() . 'plugins.php?page=som-responsive-youtube-videos'; ?>
				<input type="hidden" id="somryv-preview-link" value="<?php echo $previewurl; ?>">
			</div>
			<div class="som-inline-form bottom button-center">
				<input id="somryv-get-shortcode-back" class="button" type="button" value="Back">
				<input id="somryv-cancel-final" class="button button-primary" type="button" value="Close">
			</div>
		</div>
	</div>
</div>

		</div>
	</div>
</div>