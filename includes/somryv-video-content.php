<?php
/**
 * Responsive YouTube Videos - Video content
 *
 * Styling and content for how the video appears in a post/page.
 *
 * @version	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gets the html code to display the YouTube video,
 *
 * @param $url the YouTube video ID
 * @param $size the video width
 * @param $align the css class name for alignment styles
 * @param bool $link whether to display a link to the video
 * @param $desc the video description if applicable
 *
 * @return the responsive video html code, concatenated from strings
 */
function somryv_get_video( $videotype, $url, $size, $width, $align, $link = false, $desc, $start ) {

	$responsivevideofull = '';

	$options = get_option( 'somryv_qload_settings' );

	$quickload = ( isset( $options['somryv_enable_qload'] ) && $options['somryv_enable_qload'] ) ? true : false ;

	if ( $quickload ) {
		$responsivevideofull .= getvideocontent_lazy( $videotype, $url, $size, $width, $align, $start );
	} else {
		$responsivevideofull .= getvideocontent( $videotype, $url, $size, $width, $align, $start );
	}

	$responsivevideodesc = getvideodescriptionpart( $desc );
	if ( $responsivevideodesc  ) {
		$responsivevideofull .= $responsivevideodesc; 
	}

	$responsivevideolink = getlinktovideo( $url, $link, $start );
	if ( $responsivevideolink ) {
		$responsivevideofull .= $responsivevideolink ;
	}
	
	$responsivevideofull .= '</div>';

	return $responsivevideofull;

}

/**
 * The opening html code and main video content.
 *
 * @return the starting html code with video
 */
function getvideocontent( $videotype, $url, $size, $width, $align, $start ) {

	if ( $start ) {
		$start = '&start=' . $start;
	}

	if ( $videotype == 'youtube' ) {
		$video_url_full = 'https://www.youtube.com/embed/' . $url;
	} elseif ( $videotype == 'vimeo' ) {
		$video_url_full = 'https://player.vimeo.com/video/' . $url;
	} else {
		$video_url_full = 'https://www.youtube.com/embed/' . $url;
	}
	
	$iframe_content = '';
	
	if ( $videotype == 'youtube' ) {
		$iframe_content = 'frameborder="0" allowfullscreen';
	} elseif ( $videotype == 'vimeo' ) {
		$iframe_content = 'frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen';
	} else {
		$iframe_content = 'frameborder="0" allowfullscreen';
	}

	$responsivevideostart = '

		<div class="som-video-wrap som-video-' . $align . ' som-video-' . $size . '" style="width: ' . $width . ';">
			<div class="som-resp-video">
				<iframe src="' . $video_url_full . $start . '" ' . $iframe_content . '></iframe>
			</div>

	';

	return $responsivevideostart;

}

function getvideocontent_lazy( $videotype, $url, $size, $width, $align, $start ) {

	$options = get_option( 'somryv_qload_settings' );
	$title_option = ( isset( $options['somryv_video_title'] ) && $options['somryv_video_title'] ) ? $options['somryv_video_title'] : 1 ;
	$play_action = ( isset( $options['somryv_play_button_action'] ) && $options['somryv_play_button_action'] ) ? $options['somryv_play_button_action'] : '' ;
	$play_option = ( isset( $options['somryv_play_button'] ) && $options['somryv_play_button'] ) ? $options['somryv_play_button'] : 1 ;
	
	$play_hover = '';
	
	if ( $play_action == 2 ) {
		$play_hover = ' som-resp-video-play-nohover';
	} else {
		$play_hover = ' som-resp-video-play-hover';
	}

	if ( $videotype == 'vimeo' ) {
		$video_url_full = 'https://player.vimeo.com/video/' . $url;
	} else {
		$video_url_full = 'https://www.youtube.com/embed/' . $url;
	}

	$start_full = '';

	//$thumb_url = 'https://img.youtube.com/vi/' . $url .'/sddefault.jpg';

	$thumb_url = get_video_thumbnail( $video_url_full, $size );

	$title = '';

	if ( $videotype == 'vimeo' ) {
		$video_url_full = 'https://vimeo.com/' . $url;
		$video_id = substr(parse_url($video_url_full, PHP_URL_PATH), 1);
		$hash = json_decode(file_get_contents("https://vimeo.com/api/v2/video/{$video_id}.json"));
		$raw_title = $hash[0]->title;
		$title = '<span class="som-resp-video-title som-resp-title-option-' . $title_option . '">' . $raw_title . '</span>';
	} else {
		if ( $content = @file_get_contents( 'https://youtube.com/get_video_info?video_id=' . $url ) ) {
			parse_str( $content, $ytarr );
			$raw_title = $ytarr['title'];
			$title = '<span class="som-resp-video-title som-resp-title-option-' . $title_option . '">' . $raw_title . '</span>';
		}
	}

	//echo '<pre>';
	//print_r($ytarr);
	//echo '</pre>';
	//return;

	if ( $start ) {
		$start_full = ' data-start="' . $start . '"';
	}


$init = 685;
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;

//echo "$hours:$minutes:$seconds";


	$responsivevideostart = '
		<div class="som-video-wrap som-video-'. $videotype . ' som-video-' . $align . ' som-video-' . $size . '" style="width: ' . $width . ';">
			<div class="som-resp-video" data-type="' . $videotype . '" data-embed="' . $url . '"' . $start_full .'>
				<div class="som-resp-video-thumb" style="background-image: url(' . $thumb_url . ')"></div>
				' . $title . '
				<div class="som-resp-video-play som-resp-video-play-' . $play_option . $play_hover . '"><div class="som-resp-video-play-icon"></div></div>
			</div>
	';

	return $responsivevideostart;

}

/**
 * Whether a link to the video is displayed.
 *
 * @return either a link, or a spacing divider
 */
function getlinktovideo( $url, $link = false, $start ) {

	$responsivevideolink = '';

	if ( $start ) {
		$start = '&start=' . $start;
	}

	if ( $link == 'true' ) {
		$responsivevideolink = '<span class="som-resp-video-link"><a href="https://www.youtube.com/watch?v=' . $url . $start . '" target="_blank">Link to video</a></span>';
	}
	return $responsivevideolink;
	
}

function getvideodescriptionpart( $desc, $descstyle = 0, $settings = false ) {

	$description = '';

	if ( ($desc != '') && (!$settings) ) {

		$descoptions = get_option( 'somryv_desc_settings' );
		$descstyle = $descoptions['somryv_video_desc_style'];

		if ( ! $descstyle ) { // Failsafe, if no style set, default to 1
			$descstyle = '1';
		}

		$description = getvideodescription( $desc , $descstyle );
		
	}

	return $description;

}

/**
 * The CSS for the video is only enqueued when
 * the shortcode is being used, saving HTTP requests.
 *
 * Action called from som_responsive_video();
 */
add_action( 'somryv_load_video_css', 'somryv_import_page_css' );

function somryv_import_page_css() {
	wp_register_style( 'somryv_video_css', plugins_url( '/assets/css/somryv_video_css.css', dirname(__FILE__) ) );
	wp_enqueue_style( 'somryv_video_css' );
}

add_action( 'wp_enqueue_scripts', 'somryv_import_page_scripts' );

function somryv_import_page_scripts() {
	$mainscript = plugins_url( 'assets/js/main.js', dirname(__FILE__) );
	wp_enqueue_script( 'somryv_frontend_script', $mainscript, array( 'jquery' ), '1.0.0', true );
	wp_register_style( 'somryv_video_css', plugins_url( '/assets/css/somryv_video_css.css', dirname(__FILE__) ) );
	wp_enqueue_style( 'somryv_video_css' );
}

function get_video_thumbnail( $src, $size ) {
	$url_pieces = explode('/', $src);
	
	if ( $url_pieces[2] == 'player.vimeo.com' ) { // If Vimeo
		$id = $url_pieces[4];
		$hash = unserialize(file_get_contents('https://vimeo.com/api/v2/video/' . $id . '.php'));
		$thumbnail = $hash[0]['thumbnail_small'];
		$thumbnailSD = $hash[0]['thumbnail_medium'];
		$thumbnailHD = $hash[0]['thumbnail_large'];
		if ( remoteFileExists( $thumbnailHD ) ) {
			$thumbnail = $thumbnailHD;
		} elseif ( remoteFileExists( $thumbnailSD ) ) {
			$thumbnail = $thumbnailSD;
		}
	} elseif ( $url_pieces[2] == 'www.youtube.com' ) { // If Youtube
		$extract_id = explode('?', $url_pieces[4]);
		$id = $extract_id[0];
		$thumbnail = 'https://i3.ytimg.com/vi/' . $id . '/mqdefault.jpg';
		$thumbnailHQ = 'https://i3.ytimg.com/vi/' . $id . '/hqdefault.jpg';
		$thumbnailSD = 'https://i3.ytimg.com/vi/' . $id . '/sddefault.jpg';
		$thumbnailHD = 'https://i3.ytimg.com/vi/' . $id . '/maxresdefault.jpg';
		if ( remoteFileExists( $thumbnailHD ) ) {
			$thumbnail = $thumbnailHD;
		} elseif ( remoteFileExists( $thumbnailSD ) ) {
			$thumbnail = $thumbnailSD;
		} elseif ( remoteFileExists( $thumbnailHQ ) ) {
			$thumbnail = $thumbnailHQ;
		}
	}

	if ( ( $size != 'full' && $size != 'large' ) && $thumbnail == $thumbnailHD ) {
		$thumbnail = $thumbnailSD;
	}

	return $thumbnail;
}

function remoteFileExists($url) {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    //do request
    $result = curl_exec($curl);

    $ret = false;

    //if request did not fail
    if ($result !== false) {
        //if request was ok, check response code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  

        if ($statusCode == 200) {
            $ret = true;   
        }
    }

    curl_close($curl);

    return $ret;
}
