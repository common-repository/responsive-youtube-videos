(function() {

	tinymce.PluginManager.add('som_responsive_ytbutton', function( editor, url ) {
		somryvSetMCEDefaults();
		editor.addButton( 'som_responsive_ytbutton', {

			title: 'Responsive Video',
			icon : 'icon somryv-youtube-button',
			onclick: function() {
				var window;
				window = editor.windowManager.open( {
				title: 'Responsive Video',
				classes: 'som-responsive-youtube-mce',
				body: [
				{
					type: 'listbox',
					name: 'videotype',
					label: 'Type',
					id: 'somryv-videotype-box',
					'values': [
						{text: 'YouTube', value: 'youtube'},
						{text: 'Vimeo', value: 'vimeo'}
					],
						value: 'youtube'
				},
				{
					type: 'textbox',
					id: 'somryv-videourl-box',
					name: 'videourl',
					label: 'Video url',
					value: '',
					onkeypress: function() { setDefaultBorder(); }
				},
				{
					type: 'listbox',
					name: 'videosize',
					label: 'Size',
					id: 'somryv-videosize-box',
					'values': [
						{text: smallVar, value: 'small'},
						{text: mediumVar, value: 'medium'},
						{text: largeVar, value: 'large'},
						{text: fullVar, value: 'full'}
					],
						value: somryv_default_size_js
				},
				{
					type: 'listbox',
					name: 'videoalign',
					label: 'Alignment',
					id: 'somryv-videoalign-box',
					'values': [
						{text: aleftVar, value: 'left'},
						{text: afleftVar, value: 'leftfloat'},
						{text: acentreVar, value: 'center'},
						{text: arightVar, value: 'right'},
						{text: afrightVar, value: 'rightfloat'}
					],
						value: somryv_default_align_js
				},
				{
					type: 'textbox',
					id: 'somryv-video-desc',
					name: 'videodesc',
					label: 'Description',
					value: '',
					placeholder: '(Optional)'
				},
				{
					type: 'textbox',
					id: 'somryv-video-starttime',
					name: 'starttime',
					label: 'Start time (s)',
					value: '',
					placeholder: '(Optional)'
				},
				{
					type: 'checkbox',
					name: 'videopreview',
					id: 'somryv-videopreview-box',
					checked: false,
					text: 'Preview first?',
					value: ''
        			}],

        onsubmit: function( e ) {
	if ( e.data.videourl == '' ) {
		e.preventDefault();
		urlIsEmpty();
		return;
	}
	if ( e.data.videopreview == true ) {
        	e.preventDefault();
        	somryvGetPreviewMCE(e);
       	 	return;	
	}
            editor.insertContent( getContentForEditor( e.data.videotype, e.data.videourl, e.data.videosize, e.data.videoalign, e.data.videolink, e.data.videodesc, e.data.starttime ) );
        }

    });

}

        });

    });

})();

function getShortcodeFromMCE(e, preview = false) {

	var videotype = e.data.videotype;
	var videourl = e.data.videourl;
	var videosize = e.data.videosize;
	var videoalign = e.data.videoalign;
	var videolink = e.data.videolink;
	var videodesc = e.data.videodesc;
	var videostart = e.data.starttime;

	var generatedshortcode;
	
	if (preview) {
		generatedshortcode = getContentForPreview( videotype, videourl, videosize, videoalign, videolink, videodesc, videostart );
	} else {
		generatedshortcode = getContentForEditor( videotype, videourl, videosize, videoalign, videolink, videodesc, videostart );
	}
	
	return generatedshortcode;
	
}

function somryvGetPreviewMCE(e) {

	var videotype = e.data.videotype;
	var videourl = e.data.videourl;
	var videosize = e.data.videosize;
	var videoalign = e.data.videoalign;
	var videolink = e.data.videolink;
	var videodesc = e.data.videodesc;
	var videostart = e.data.starttime;
	
	if ( !videourl ) {
		urlIsEmpty();
		return;
	}

	var shortcode = getShortcodeFromMCE(e, true);

	var previewurl = 'plugins.php?page=som-responsive-youtube-videos';
	var newpreviewurl = previewurl.concat('&somryvpreview=true', shortcode);
	openInNewTab(newpreviewurl);
}

function somryvClosePreview() {
	close();
}

function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}