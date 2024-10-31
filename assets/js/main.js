(function($) {

	var youtube = document.querySelectorAll( '.som-resp-video' );
	
	for (var i = 0; i < youtube.length; i++) {
		/*
		var source = 'https://img.youtube.com/vi/'+ youtube[i].dataset.embed +'/sddefault.jpg';

		var video_thumbnail = document.createElement('div');
		
		//var image = new Image();
				//image.src = source;
				video_thumbnail.className = 'som-resp-video-thumb';
				video_thumbnail.style.backgroundImage = 'url(' + source + ')';
				video_thumbnail.addEventListener( 'load', function() {
					//youtube[ i ].appendChild( image );

					var wrapper = youtube[ i ];
					//$( wrapper ).css({
					//	'background-image': 'url(' + image.src + ')'
					//});

					//youtube[ i ].appendChild( video_thumbnail );
				}( i ) );
		*/
				youtube[i].addEventListener( 'click', function() {

					var player = this;

					this.style.backgroundColor = 'rgba(0, 0, 0, 1.0)';

					var iframe = document.createElement( 'iframe' );

					var video_start = '';

					if ( this.dataset.type == 'vimeo' ) {

						if ( this.dataset.start ) {

							var time = this.dataset.start;
							var minutes = Math.floor(time / 60);
							var seconds = time - minutes * 60;
							var start_full = minutes + 'm' + seconds + 's'; 
							video_start = '#t=' + start_full + '&';
						}

						iframe.setAttribute( 'frameborder', '0' );
						iframe.setAttribute( 'webkitAllowFullScreen', '' );
						iframe.setAttribute( 'mozallowfullscreen', '' );
						iframe.setAttribute( 'allowfullscreen', '' );
						iframe.setAttribute( 'src', 'http://player.vimeo.com/video/'+ this.dataset.embed +'?&autoplay=1'+ video_start );
						
					} else {

						iframe.setAttribute( 'frameborder', '0' );
						iframe.setAttribute( 'allowfullscreen', '' );
						iframe.setAttribute( 'src', 'https://www.youtube.com/embed/'+ this.dataset.embed +'?'+ video_start +'rel=0&showinfo=1&autoplay=1' );

						if ( this.dataset.start ) {
							video_start = '&start=' + this.dataset.start + '&';
						}

					}



					this.innerHTML = '';
					this.appendChild( iframe );

					iframe.onload = function() {
						player.style.backgroundColor = 'rgba(0, 0, 0, 0)';
					};

				} );
	};

	$(window).load(function() {

		$( '.som-resp-video' ).each(function() {
			var player_width = $( this ).width();
			$( this ).css({
				'height': player_width * 9/16,
				'padding-bottom': 0
			});

		});

	});

	$(window).resize(function() {

		$( '.som-resp-video' ).each(function() {
			var player_width = $( this ).width();
			$( this ).css({
				'height': player_width * 9/16,
				'padding-bottom': 0
			});
		});

	});

	//$( 'body' ).trigger( 'somryv_reset_heights' );
	$( 'body' ).on( 'somryv_reset_heights', function () {

		$( '.som-resp-video' ).each(function() {
			var player_width = $( this ).width();
			$( this ).css({
				'height': player_width * 9/16,
				'padding-bottom': 0
			});
		});
		//console.log('Triggered somryv_reset_heights');

	});


/*
var Youtube = (function () {
    'use strict';

    var video, results;

    var getThumb = function (url, size) {
        if (url === null) {
            return '';
        }
        size    = (size === null) ? 'big' : size;
        results = url.match('[\\?&]v=([^&#]*)');
        video   = (results === null) ? url : results[1];

        if (size === 'small') {
            return 'http://img.youtube.com/vi/' + video + '/2.jpg';
        }
        return 'http://img.youtube.com/vi/' + video + '/0.jpg';
    };

    return {
        thumb: getThumb
    };
}());
*/
//Example of usage:
//Example of usage:

//var thumb = Youtube.thumb('http://www.youtube.com/watch?v=F4rBAf1wbq4', 'small');

})( jQuery );