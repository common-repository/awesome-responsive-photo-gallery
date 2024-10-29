<?php
/*
 * Awesome Responsive Photo Gallery Pro 1.0.5
 * @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function arpg_process_option($gallery_name, $gallery, $size, $id) {
	$gallery_options = get_option($gallery_name.'_options');
	$container = $gallery_options['cwdth'] != '' ? $gallery_options['cwdth'] . '%' : '100%';
	$top_space = $gallery_options['tpspc'] != '' ? $gallery_options['tpspc'] . 'px' : '0px';
	$bottom_space = $gallery_options['btspc'] != '' ? $gallery_options['btspc'] . 'px' : '0px';
	$image_width = $gallery_options['imgwd'] != '' ? $gallery_options['imgwd'] : 250;
	$image_height = $gallery_options['imght'] != '' ? $gallery_options['imght'] : 250;
	$hover_effect = $gallery_options['hveft'] != '' ? $gallery_options['hveft'] : 'none';
	$overlay_effect = $gallery_options['oveft'] != '' ? $gallery_options['oveft'] : 'none';
	$opacity_caption = $gallery_options['opccp'] != '' ? $gallery_options['opccp']/100 : '0.92';
	$margin = $gallery_options['mrgin'] != '' ? $gallery_options['mrgin'] . 'px' : '0';
	$border_style = $gallery_options['brsle'] != '' ? $gallery_options['brsle'] : 'none';
	$border_width = $gallery_options['brwdh'] != '' ? $gallery_options['brwdh'] . 'px' : '1px';
	$thumb_shadow = $gallery_options['shade'] != '' ? $gallery_options['shade'] : 'false';
	$shadow_length = $gallery_options['shlen'] != '' ? $gallery_options['shlen'] . 'px' : '0';
	$blur_radius = $gallery_options['blrad'] != '' ? $gallery_options['blrad'] . 'px' : '0';
	$spread_radius = $gallery_options['sprad'] != '' ? $gallery_options['sprad'] . 'px' : '0';
	$shadow_opacity = $gallery_options['shopc'] != '' ? $gallery_options['shopc']/100 : 1;
	$thumb_radius = $gallery_options['thrad'] != '' ? $gallery_options['thrad'] : 0;
	$thumblay = $gallery_options['thlay'] != '' ? $gallery_options['thlay'] : '#666';
	$border_color = $gallery_options['brclr'] != '' ? $gallery_options['brclr'] : '#000';
	$shadow_color = $gallery_options['shclr'] != '' ? $gallery_options['shclr'] : '#000';
	$info_bg = $gallery_options['infbg'] != '' ? $gallery_options['infbg'] : '#2c3f52';
	$info_title = $gallery_options['inftt'] != '' ? $gallery_options['inftt'] : '#fff';
	$info_caption = $gallery_options['infcp'] != '' ? $gallery_options['infcp'] : '#fff';
	
	$overlay_color = arpg_hex2rgba($thumblay, 0.25);
	$box_shadow = arpg_hex2rgba($shadow_color, $shadow_opacity);
	$caption_opc = arpg_hex2rgba($info_bg, $opacity_caption);
	$title_border = arpg_hex2rgba($info_title, 0.75);

	$margin_b = (int)$margin . 'px';
	$margin_r = (int)$margin . 'px';

	if($hover_effect == "slideleft") {
		$transition = "max-width: none;width: -webkit-calc(100% + 50px);width: calc(100% + 50px);-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;transition: opacity 0.35s, transform 0.35s;-webkit-transform: translate3d(-40px,0, 0);transform: translate3d(-40px,0,0);";
		$transition_hover = "-webkit-transform: translate3d(0,0,0);transform: translate3d(0,0,0);";
	} elseif($hover_effect == "zoompan") {
		$transition = "-webkit-transition: all 0.4s linear;-moz-transition: all 0.4s linear;-o-transition: all 0.4s linear;-ms-transition: all 0.4s linear;transition: all 0.4s linear";
		$transition_hover = "-webkit-transform: scale(1.1,1.1);-moz-transform: scale(1.1,1.1);-o-transform: scale(1.1,1.1);-ms-transform: scale(1.1,1.1);transform: scale(1.1,1.1)";
	} elseif($hover_effect == "shrink") {
		$transition = "-webkit-transition: opacity 0.85s, -webkit-transform 0.85s;transition: opacity 0.85s, transform 0.85s;-webkit-transform: scale(1.15);transform: scale(1.15)";
		$transition_hover = "-webkit-transform: scale(1);transform: scale(1)";
	} else {
		$transition = $transition_hover = "";
	}

	if($overlay_effect == "lefttoright") {
		$figcaption = "right: 50%;left: unset;width: 100%;height: 100%;background: $caption_opc;text-align: center;-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=0)';filter: alpha(opacity=0);-moz-opacity: 0;-khtml-opacity: 0;opacity: 0;-webkit-transition: all .5s ease;-moz-transition: all .5s ease;-o-transition: all .5s ease;transition: all .5s ease;";
		$figcaption_hover = "background-color: $caption_opc;right: 0;-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=100)';filter: alpha(opacity=100);-moz-opacity: 1;-khtml-opacity: 1;opacity: 1;";
		$imgtitle = "color: $info_title;";
		$imgcap = "color: $info_caption;";
		$imgtitle_hover = $imgdetails = $imgdetails_hover = $imgcap_hover = "";
	} elseif($overlay_effect == "fadeinmid") {
		$figcaption = "width: 100%;height: 100%;background-color: $caption_opc;-webkit-transition: all 0.5s linear;-moz-transition: all 0.5s linear;-o-transition: all 0.5s linear;-ms-transition: all 0.5s linear;transition: all 0.5s linear;-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=0)';filter: alpha(opacity=0);opacity: 0;";
		$figcaption_hover = "-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=100)';filter: alpha(opacity=100);opacity: 1;";
		$imgtitle = "color: $info_title;border-bottom: 1px solid $title_border;background: transparent;margin: 20px 40px 10px;-webkit-transform: scale(0);-moz-transform: scale(0);-o-transform: scale(0);-ms-transform: scale(0);transform: scale(0);-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=0)';filter: alpha(opacity=0);opacity: 0;";
		$imgtitle_hover = "";
		$imgdetails = "text-align: center;-webkit-transition: all 0.5s linear;-moz-transition: all 0.5s linear;-o-transition: all 0.5s linear;-ms-transition: all 0.5s linear;transition: all 0.5s linear;";
		$imgdetails_hover = "-webkit-transform: scale(1);-moz-transform: scale(1);-o-transform: scale(1);-ms-transform: scale(1);transform: scale(1);-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=100)';filter: alpha(opacity=100);opacity: 1;";
		$imgcap = "color: $info_caption;-ms-filter: 'progid: DXImageTransform.Microsoft.Alpha(Opacity=0)';filter: alpha(opacity=0);opacity: 0;-webkit-transform: scale(0);-moz-transform: scale(0);-o-transform: scale(0);-ms-transform: scale(0);transform: scale(0);";
		$imgcap_hover = "";
	} elseif($overlay_effect == "capfadeleft") {
		$figcaption = "width: 100%;height: 100%;";
		$figcaption_hover = "background-color: $caption_opc;";
		$imgtitle = "color: $info_title;position: absolute;right: 0;bottom: 0;padding: 1em 1.2em;";
		$imgtitle_hover = $imgdetails = $imgdetails_hover = "";
		$imgcap = "color: $info_caption;padding: 0 10px 0 0;width: 50%;border-right: 1px solid #fff;text-align: right;opacity: 0;-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;transition: opacity 0.35s, transform 0.35s;-webkit-transform: translate3d(-40px,0,0);transform: translate3d(-40px,0,0);";
		$imgcap_hover = "opacity: 1;-webkit-transform: translate3d(0,0,0);transform: translate3d(0,0,0);";
	} else {
		$figcaption = $figcaption_hover = $imgtitle = $imgtitle_hover = $imgdetails = $imgdetails_hover = $imgcap = $imgcap_hover = "display:none;";
	}

	if($gallery != 'jgallery') {
		$gallery_div = "
		<style type='text/css'>
			#arpGallery$id{width:$container;margin:0 auto;}
			";if($top_space != '0px' || $bottom_space != '0px') {$gallery_div .= "#arpGallery$id{";if($top_space != '0px') {$gallery_div .= "margin-top: $top_space !important;"; }if($bottom_space != '0px') {$gallery_div .= "margin-bottom: $bottom_space !important;"; }$gallery_div .= "}"; }
		if($size == 'custom') {
			$gallery_div .= "
			#arpGallery$id > li .awesome-gallery-poster, arpGallery$id > li .awesome-video-poster{background-color: $overlay_color}
			#arpGallery$id > li{";if($border_style != 'none') {$gallery_div .= "border: $border_width $border_style $border_color;"; }if($thumb_radius != 0) {$gallery_div .= "-moz-border-radius: $thumb_radius%;-webkit-border-radius: $thumb_radius%;border-radius: $thumb_radius%;"; }$gallery_div .= "margin: 0 $margin $margin_b 0;";if($thumb_shadow == 'true') {$gallery_div .= "-webkit-box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;-moz-box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;"; }$gallery_div .= "}
			#arpGallery$id > li img.ag-thumbnail{ $transition;}
			#arpGallery$id > li:hover > img.ag-thumbnail { $transition_hover;}";
			if($figcaption != '') {$gallery_div .= "
			#arpGallery$id > li .awesome-gallery-poster > figcaption,
			#arpGallery$id > li .awesome-video-poster > figcaption { $figcaption}";
			} if($figcaption_hover != '') {$gallery_div .= "
			#arpGallery$id > li:hover .awesome-gallery-poster > figcaption,
			#arpGallery$id > li:hover .awesome-video-poster > figcaption { $figcaption_hover}";
			} if($imgdetails != '') {$gallery_div .= "
			#arpGallery$id > li .awesome-gallery-poster > figcaption h2,
			#arpGallery$id > li .awesome-video-poster > figcaption h2,
			#arpGallery$id > li .awesome-gallery-poster > figcaption p,
			#arpGallery$id > li .awesome-video-poster > figcaption p { $imgdetails}";
			} if($imgdetails_hover != '') {$gallery_div .= "
			#arpGallery$id > li:hover .awesome-gallery-poster > figcaption h2,
			#arpGallery$id > li:hover .awesome-video-poster > figcaption h2,
			#arpGallery$id > li:hover .awesome-gallery-poster > figcaption p,
			#arpGallery$id > li:hover .awesome-video-poster > figcaption p { $imgdetails_hover}";
			}$gallery_div .= "
			#arpGallery$id > li .awesome-gallery-poster > figcaption h2,
			#arpGallery$id > li .awesome-video-poster > figcaption h2 { $imgtitle}";
			if($imgtitle_hover != '') {$gallery_div .= "
			#arpGallery$id > li:hover .awesome-gallery-poster > figcaption h2,
			#arpGallery$id > li:hover .awesome-video-poster > figcaption h2 { $imgtitle_hover}";
			}$gallery_div .= "
			#arpGallery$id > li .awesome-gallery-poster > figcaption p,
			#arpGallery$id > li .awesome-video-poster > figcaption p { $imgcap}
			#arpGallery$id > li:hover .awesome-gallery-poster > figcaption p,
			#arpGallery$id > li:hover .awesome-video-poster > figcaption p { $imgcap_hover}";
		} else {
			$gallery_div .= "
			#arpGallery$id > .awesome-gallery, #arpGallery$id > .awesome-video{";if($border_style != 'none') {$gallery_div .= "border: $border_width $border_style $border_color;"; }if($thumb_radius != 0) {$gallery_div .= "-moz-border-radius: $thumb_radius%;-webkit-border-radius: $thumb_radius%;border-radius: $thumb_radius%;"; }$gallery_div .= "margin: 0 $margin $margin 0;";if($thumb_shadow == 'true') {$gallery_div .= "-webkit-box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;-moz-box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;"; }$gallery_div .= "}
			#arpGallery$id > .awesome-gallery .overlay_thumb, #arpGallery$id > .awesome-video .overlay_thumb{background-color:$overlay_color}
			#arpGallery$id > .awesome-gallery a > img, #arpGallery$id > .awesome-video a > img { $transition;}
			#arpGallery$id > .awesome-gallery:hover a > img, #arpGallery$id > .awesome-video:hover a > img { $transition_hover;}";
			if($figcaption != '') {$gallery_div .= "
			#arpGallery$id > .awesome-gallery > figcaption,
			#arpGallery$id > .awesome-video > figcaption { $figcaption}";
			} if($figcaption_hover != '') {$gallery_div .= "
			#arpGallery$id > .awesome-gallery:hover > figcaption,
			#arpGallery$id > .awesome-video:hover > figcaption { $figcaption_hover}";
			} if($imgdetails != '') {$gallery_div .= "
			#arpGallery$id > .awesome-gallery > figcaption h2,
			#arpGallery$id > .awesome-video > figcaption h2,
			#arpGallery$id > .awesome-gallery > figcaption p,
			#arpGallery$id > .awesome-video > figcaption p { $imgdetails}";
			} if($imgdetails_hover != '') {$gallery_div .= "
			#arpGallery$id > .awesome-gallery:hover > figcaption h2,
			#arpGallery$id > .awesome-video:hover > figcaption h2,
			#arpGallery$id > .awesome-gallery:hover > figcaption p,
			#arpGallery$id > .awesome-video:hover > figcaption p { $imgdetails_hover}";
			}$gallery_div .= "
			#arpGallery$id > .awesome-gallery > figcaption h2,
			#arpGallery$id > .awesome-video > figcaption h2 { $imgtitle}";
			if($imgtitle_hover != '') {$gallery_div .= "
			#arpGallery$id > .awesome-gallery:hover > figcaption h2,
			#arpGallery$id > .awesome-video:hover > figcaption h2 { $imgtitle_hover}";
			}$gallery_div .= "
			#arpGallery$id > .awesome-gallery > figcaption p,
			#arpGallery$id > .awesome-video > figcaption p { $imgcap}
			#arpGallery$id > .awesome-gallery:hover > figcaption p,
			#arpGallery$id > .awesome-video:hover > figcaption p { $imgcap_hover}";
		}
		$gallery_div .= "
		</style>
			";	
	} else {
		$gallery_div = "
		<style type='text/css'>
			@media (min-width: 991px) {#arpGallery$id{width:$container;}}
			";if($top_space != '0px' || $bottom_space != '0px') {$gallery_div .= "#arpGallery$id{";if($top_space != '0px') {$gallery_div .= "margin-top: $top_space;"; }if($bottom_space != '0px') {$gallery_div .= "margin-bottom: $bottom_space;"; }$gallery_div .= "}"; }$gallery_div .= "
			#arpGallery$id > a{";if($border_style != 'none') {$gallery_div .= "border: $border_width $border_style $border_color;"; }if($thumb_radius != 0) {$gallery_div .= "-moz-border-radius: $thumb_radius%;-webkit-border-radius: $thumb_radius%;border-radius: $thumb_radius%;"; }$gallery_div .= "margin:0 $margin_r $margin_b 0;";if($thumb_shadow == 'true') {$gallery_div .= "-webkit-box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;-moz-box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;box-shadow: $shadow_length $shadow_length $blur_radius $spread_radius $box_shadow;"; }$gallery_div .= "}
			#arpGallery$id > a .awesome-gallery-poster{background-color: $overlay_color}
			#arpGallery$id > a img.ag-thumbnail{ $transition;}
			#arpGallery$id > a:hover > img.ag-thumbnail { $transition_hover;}";
			if($figcaption != '') {$gallery_div .= "
			#arpGallery$id > a .awesome-gallery-poster > figcaption { $figcaption}";
			} if($figcaption_hover != '') {$gallery_div .= "
			#arpGallery$id > a:hover .awesome-gallery-poster > figcaption { $figcaption_hover}";
			} if($imgdetails != '') {$gallery_div .= "
			#arpGallery$id > a .awesome-gallery-poster > figcaption h2,
			#arpGallery$id > a .awesome-gallery-poster > figcaption p { $imgdetails}";
			} if($imgdetails_hover != '') {$gallery_div .= "
			#arpGallery$id > a:hover .awesome-gallery-poster > figcaption h2,
			#arpGallery$id > a:hover .awesome-gallery-poster > figcaption p { $imgdetails_hover}";
			} $gallery_div .= "
			#arpGallery$id > a .awesome-gallery-poster > figcaption h2 { $imgtitle}";
			if($imgtitle_hover != '') {$gallery_div .= "
			#arpGallery$id > a:hover .awesome-gallery-poster > figcaption h2 { $imgtitle_hover}";
			} $gallery_div .= "
			#arpGallery$id > a .awesome-gallery-poster > figcaption p { $imgcap}
			#arpGallery$id > a:hover .awesome-gallery-poster > figcaption p { $imgcap_hover}
		</style>
			";
	}
	return $gallery_div;
}
?>
