(function($) {

	var elementsize = document.getElementById('shortgensize');
	var elementalign = document.getElementById('shortgenalign');
	var defaultString = ' (default)';

	if (elementsize) {
		var elementsizevalue = document.getElementById('shortgensize').value;
		if (elementsizevalue  == defaultSizeVar) {
		$('#shortgensize').val(defaultSizeVar);
		elementsize.options[elementsize.selectedIndex].value = defaultSizeVar;
		var newsizevalue = elementsize.options[elementsize.selectedIndex].text + defaultString;
		elementsize.options[elementsize.selectedIndex].text = newsizevalue;
		}
	}
	    
	if (elementalign) {
		var elementalignvalue = document.getElementById('shortgenalign').value;
		if (elementalignvalue == defaultAlignVar) {
		$('#shortgenalign').val(defaultAlignVar);
		elementalign.options[elementalign.selectedIndex].value = defaultAlignVar;
		var newalignvalue = elementalign.options[elementalign.selectedIndex].text + defaultString;
		elementalign.options[elementalign.selectedIndex].text = newalignvalue;
		}
	}

	$('#somryv-open-shortcode').click(function(){ openGenerateShortcode(); });
	$('#somryv-cancel').click(function(event){ cancelGenerateShortcode(event); });
	$('#somryv-icon-close').click(function(event){ cancelGenerateShortcode(event); });
	$('#somryv-cancel-final').click(function(event){ cancelGenerateShortcode(event); });
	$('#somryv-get-shortcode-back').click(function(event){ backGenerateShortcode(event); });
	$('#somryv-get-shortcode').click(function(event){ somryvGenerateShortcode(event); });
	
	$('.somryv-preview').click(function(event){ somryvGetPreview(); });
	
	$('.somryv-preview-close-button').click(function(event){ somryvClosePreview(); });

	$( "#somryv-videourl-box" ).keypress(function() {
		setDefaultBorder();
	});
	
	$('#somryv-copy').click(function () {

		var targetid = $(this).attr('copytarget');
		var target =  $('#' + targetid);

		if (target && target.select()) {

			target.select();
			var success = false;

			try {
				success = document.execCommand('copy');
			}
			catch (err) {
				success = false;
			}
	
			if (success) {
				somryvCopySuccess();
			} else {
				alert('Press Ctrl/Cmd+C to copy');
			}
		}

	});

	$( 'input[type="radio"].somryv-desc-style-radio' ).change( function( e ) {
		$someval = $( 'input[type="radio"].somryv-desc-style-radio:checked' ).val();
		$( '.somryv-desc-wrap' ).removeClass().addClass( 'somryv-desc-wrap somryv-desc-wrap-' + $someval );
	});

	$( 'input[type="radio"].somryv-play-button-type' ).change( function( e ) {
		$someval = $( 'input[type="radio"].somryv-play-button-type:checked' ).val();
		if ( $( '.somryv-qload-settings-preview .som-resp-video-play' ).hasClass( 'som-resp-video-play-hover' ) ) {
			$( '.somryv-qload-settings-preview .som-resp-video-play' ).removeClass().addClass( 'som-resp-video-play som-resp-video-play-' + $someval + ' som-resp-video-play-hover' );
		} else {
			$( '.somryv-qload-settings-preview .som-resp-video-play' ).removeClass().addClass( 'som-resp-video-play som-resp-video-play-' + $someval + ' som-resp-video-play-nohover' );
		}
		
	});

	$( 'input[type="radio"].somryv-play-title-type' ).change( function( e ) {
		$someval = $( 'input[type="radio"].somryv-play-title-type:checked' ).val();
		$( '.som-resp-video-title' ).removeClass().addClass( 'som-resp-video-title som-resp-title-option-' + $someval );
	});

	$( 'input[type="radio"].somryv-play-hover-type' ).change( function( e ) {
		$someval = $( 'input[type="radio"].somryv-play-hover-type:checked' ).val();
		if ( $someval == 1 ) {
			$( '.somryv-qload-settings-preview .som-resp-video-play' ).removeClass( 'som-resp-video-play-hover som-resp-video-play-nohover' ).addClass( 'som-resp-video-play-hover' );
		} else {
			$( '.somryv-qload-settings-preview .som-resp-video-play' ).removeClass( 'som-resp-video-play-hover som-resp-video-play-nohover' ).addClass( 'som-resp-video-play-nohover' );
		}
	});

	function somryvCopySuccess() {
		$( '#somryv-copy-confirm' ).addClass( 'somryv-copied' ).delay( 1000 ).queue( function() {
			$( '#somryv-copy-confirm' ).removeClass( 'somryv-copied' );
			$( '#somryv-copy-confirm' ).dequeue();
		});
	}


	$ (document ).on( 'click', '#som-gen-shortcode-form-wrap.generate-shortcode-open', function( event ) {
			cancelGenerateShortcode(event);
		}).on( 'click', '#som-gen-shortcode-form', function( e ) {
			e.stopPropagation();
	});



	var wrap;
	var middle;
	var wrapbottom;

	var videotypeobj;
	var videourlobj;
	var videosizeobj;
	var videoalignobj;
	var videolinkobj;
	var videodescobj;
	var videostartobj;

	var shortcodefullobj;

	function somryvDeclareVars() {

		wrap = document.getElementById('som-gen-shortcode-form-wrap');
		middle = document.getElementById('som-gen-shortcode-form-middle');
		wrapbottom = document.getElementById('som-gen-shortcode-form-bottom');

		videotypeobj = document.getElementById('shorttype');
		videourlobj = document.getElementById('somryv-videourl-box');
		videosizeobj = document.getElementById('shortgensize');
		videoalignobj = document.getElementById('shortgenalign');
		videolinkobj = document.getElementById('videolink');
		videodescobj = document.getElementById('videodesc');
		videostartobj = document.getElementById('videostart');
	
		shortcodefullobj = document.getElementById('shortcodefull');

	}

	function openGenerateShortcode() {

		somryvDeclareVars();

		$(wrapbottom).addClass( "som-gen-shortcode-form-hidden" );
		$(wrap).addClass( "generate-shortcode-open" );
	
		$(videotypeobj).select();

	}

	function cancelGenerateShortcode(event) {
		event.preventDefault();
		$(wrap).removeClass( "generate-shortcode-open" );
		$(middle).removeClass( "som-gen-shortcode-form-hidden" );
		$(wrapbottom).removeClass( "som-gen-shortcode-form-hidden" );
		clearGeneratorForm();
	}

	function somryvGenerateShortcode(event) {

		var videourl = $(videourlobj).val();
		if ( !videourl ) {
			event.preventDefault();
			urlIsEmpty();
			return;
		}
	
		var shortcode = getShortcodeFromGenerator();
	
		$(shortcodefullobj).val(shortcode);
	
		$(middle).addClass( "som-gen-shortcode-form-hidden" );
		$(wrapbottom).removeClass( "som-gen-shortcode-form-hidden" );

	}

	function backGenerateShortcode(event) {	
		$(middle).removeClass( "som-gen-shortcode-form-hidden" );
		$(wrapbottom).addClass( "som-gen-shortcode-form-hidden" );
		$(shortcodefullobj).val('');
	}

	function getShortcodeFromGenerator(preview = false) {

		var videotype = $(videotypeobj).val();
		var videourl = $(videourlobj).val();
		var videosize = $(videosizeobj).val();
		var videoalign = $(videoalignobj).val();
		var videolink = $(videolinkobj).is(':checked');
		var videodesc = $(videodescobj).val();
		var videostart = $(videostartobj).val();

		var generatedshortcode;
	
		if (preview) {
			generatedshortcode = getContentForPreview( videotype, videourl, videosize, videoalign, videolink, videodesc, videostart );
		} else {
			generatedshortcode = getContentForEditor( videotype, videourl, videosize, videoalign, videolink, videodesc, videostart );
		}
	
		return generatedshortcode;
	
	}

	function somryvGetPreview() {

		var videourl = $(videourlobj).val();
		if ( !videourl ) {
			event.preventDefault();
			urlIsEmpty();
			return;
		}

		var shortcode = getShortcodeFromGenerator(true);

		var previewurl = document.getElementById('somryv-preview-link').value;
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

	function clearGeneratorForm() {

		setDefaultBorder();
		$(videourlobj).val('');
		$(videolinkobj).attr('checked', false);
		$(videodescobj).val('');
		$(videostartobj).val('');
		$(shortcodefullobj).val('');
		$(videosizeobj).val(defaultSizeVar);
		$(videoalignobj).val(defaultAlignVar);
	
	}

})( jQuery );

