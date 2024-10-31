var somryv_default_size_js;
var somryv_default_align_js;

var defaultString = " (default)";

var smallVar = "Small";
var mediumVar = "Medium";
var largeVar = "Large";
var fullVar = "Full";

var aleftVar = "Left";
var afleftVar = "Float Left";
var acentreVar = "Center";
var arightVar = "Right";
var afrightVar = "Float Right";

function somryvSetMCEDefaults() {
	somryv_default_size_js = defaultSizeVar;
	somryv_default_align_js = defaultAlignVar;

	if (somryv_default_size_js == "small") {
		smallVar = "Small" + defaultString;
	} else if (somryv_default_size_js == "medium") {
		mediumVar = "Medium" + defaultString;
	} else if (somryv_default_size_js == "large") {
		largeVar = "Large" + defaultString;
	} else if (somryv_default_size_js == "full") {
		fullVar = "Full" + defaultString;
	}

	if (somryv_default_align_js == "left") {
		aleftVar = "Left" + defaultString;
	} else if (somryv_default_align_js == "leftfloat") {
		afleftVar = "Float Left" + defaultString;
	} else if (somryv_default_align_js  == "center") {
		acentreVar = "Center" + defaultString;
	} else if (somryv_default_align_js == "right") {
		arightVar = "Right" + defaultString;
	} else if (somryv_default_align_js == "rightfloat") {
		afrightVar = "Float Right" + defaultString;
	}

}

function urlIsEmpty() {
	var urlElem = document.getElementById('somryv-videourl-box');
	urlElem.style.borderColor = 'red';
	urlElem.placeholder='URL Required';
	urlElem.select();
}

function setDefaultBorder() {
	var urlElem = document.getElementById('somryv-videourl-box');

	if (urlElem.style.removeProperty) {
    		urlElem.style.removeProperty('border-color');
	} else {
		urlElem.style.removeAttribute('border-color');
	}
	urlElem.placeholder='';
}

function getVimeoVideoID(url) {
	vimeo_id = url.split(/video\/|https?:\/\/vimeo\.com\//)[1].split(/[?&]/)[0];
	return vimeo_id;
}

function getYouTubeVideoID(url) {
	var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11,11}).*/;
	var match = url.match(regExp);
	if (match) if (match.length >= 2) return match[2];
	return url;
}

function getContentForEditor( videotype, videourl, videosize, videoalign, videolink, videodesc, videostart ) {

	var videotypevar = videotype;
	var videourlvar = videourl;
	var videosizevar = videosize;
	var videoalignvar = videoalign;
	var videolinkvar = videolink;
	var videodescvar = videodesc;
	var videostartvar = videostart;
	
	if ( videotypevar == 'youtube' ) {
		var shortcodefull = '[somryv url="' + getYouTubeVideoID(videourlvar) + '"';
	} else if ( videotypevar == 'vimeo' ) {
		var shortcodefull = '[somryv type="vimeo" url="' + getVimeoVideoID(videourlvar) + '"';
	}

	shortcodefull = shortcodefull.concat(' size="' + videosizevar + '"');
	shortcodefull = shortcodefull.concat(' align="' + videoalignvar + '"');
	if ( videodescvar !== '' ) {
		shortcodefull = shortcodefull.concat( ' desc="' + videodesc +'"');	
	}
	if ( videostartvar !== '' ) {
		shortcodefull = shortcodefull.concat( ' start="' + videostart +'"');	
	}
	shortcodefull = shortcodefull.concat(']');

	return shortcodefull;

}

function getContentForPreview( videotype, videourl, videosize, videoalign, videolink, videodesc, videostart ) {

	var videotypevar = videotype;
	var videourlvar = videourl;
	var videosizevar = videosize;
	var videoalignvar = videoalign;
	var videolinkvar = videolink;
	var videodescvar = videodesc;
	var videostartvar = videostart;

	if ( videotypevar == 'youtube' ) {
		var shortcodefull = '&type=youtube&url=' + getYouTubeVideoID(videourlvar);
	} else if ( videotypevar == 'vimeo' ) {
		var shortcodefull = '&type=vimeo&url=' + getVimeoVideoID(videourlvar);
	}

	shortcodefull = shortcodefull.concat('&size=' + videosizevar);
	shortcodefull = shortcodefull.concat('&align=' + videoalignvar);
	if ( videodescvar !== '' ) {
		shortcodefull = shortcodefull.concat('&desc=' + videodesc);	
	}
	if ( videostartvar !== '' ) {
		shortcodefull = shortcodefull.concat('&start=' + videostartvar);	
	}
	
	return shortcodefull;

}