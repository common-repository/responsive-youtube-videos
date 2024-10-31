(function($) {

	$('.somryv-color-picker.somryv-font-picker').wpColorPicker({
		width: 250,
		hide: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the color
			$(".somryv-desc-wrap .somryv-desc").css( 'color', ui.color.toString());
		}
	});

	$('.somryv-color-picker.somryv-border-picker').wpColorPicker({
		width: 250,
		hide: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the color
			$border = ui.color.toString();
			$(".somryv-desc-corner-1").css( 'border-color', '' + $border + ' transparent transparent transparent' );
			$(".somryv-desc-corner-1").css( 'border-color', '' + $border + ' transparent transparent transparent' );
			$(".somryv-desc-corner-4").css( 'border-color', 'transparent transparent ' + $border + ' transparent' );
			$(".somryv-desc-corner-4").css( 'border-color', 'transparent transparent ' + $border + ' transparent' );
			$(".somryv-desc-wrap-6 .somryv-desc-corner-4").css( 'background-color', $border );
			$(".somryv-desc-wrap .somryv-desc").css( 'border-color', $border );
		}
	});

	$('.somryv-color-picker.somryv-bg-picker').wpColorPicker({
		width: 250,
		hide: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the color
			$(".somryv-desc-wrap .somryv-desc").css( 'background-color', ui.color.toString());
		}
	});
	
	$('.somryv-color-picker.somryv-primary-picker').wpColorPicker({
		width: 250,
		hide: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the color
			//$( '.somryv-desc-wrap .somryv-desc' ).css( 'color', ui.color.toString() );
			$( '.somryv-qload-colour-preview .som-resp-video-play' ).css( 'background-color', ui.color.toString() );
		}
	});

	$('.somryv-color-picker.somryv-arrow-picker').wpColorPicker({
		width: 250,
		hide: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the color
			$( '.somryv-qload-colour-preview .som-resp-video-play .som-resp-video-play-icon' ).css(
				'border-color', 'rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) ' + ui.color.toString()
			);
		}
	});

	$('.somryv-color-picker.somryv-secondary-picker').wpColorPicker({
		width: 250,
		hide: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object

			// change the color
			$( '.somryv-qload-colour-preview .som-resp-video-play' ).css( 'border-color', ui.color.toString() );
		}
	});

	$(window).load(function() {
		$( '.somryv-qload-colour-preview .som-resp-video-play' ).removeClass( 'som-resp-video-play-hover' ).addClass( 'som-resp-video-play-nohover' );
	});

})( jQuery );