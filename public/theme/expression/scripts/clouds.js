var scrollSpeed = 50;
var cloud_bottom_step = 1;
var cloud_bottom_current = 0;
var cloud_bottom_imageWidth = 512;
var cloud_bottom_headerWidth = 800;

var cloud_top_step = 0.5;
var cloud_top_current = 0;
var cloud_top_imageWidth = 256;
var cloud_top_headerWidth = 800;

function scrollBg(){
	cloud_bottom_current -= cloud_bottom_step;
	cloud_top_current += cloud_top_step;
	if (cloud_bottom_current == -cloud_bottom_imageWidth){
		cloud_bottom_current = 0;
	}
	if (cloud_top_current == cloud_top_imageWidth){
		cloud_top_current = 0;
	}

	$('.headerbar').css("background-position",cloud_bottom_current+"px 0");
	$('.headerbar_overlay').css("background-position",cloud_top_current+"px 0");
}

var init = setInterval("scrollBg()", scrollSpeed);