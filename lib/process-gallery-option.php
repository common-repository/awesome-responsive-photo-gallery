<?php
/*
 * Awesome Responsive Photo Gallery Pro 1.0.5
 * @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function arpg_process_gallery($gallery_name, $gallery, $id) {
	$gallery_options = get_option($gallery_name.'_options');
	if($gallery == 'awesome') {
		$gallery_awesome = get_option($gallery_name.'_awesome');
		$transition_effect = $gallery_awesome['treft'] != '' ? $gallery_awesome['treft'] : 'slide';
		$loop_back = $gallery_awesome['loop'] != '' ? $gallery_awesome['loop'] : 'true';
		$tran_duration = $gallery_awesome['speed'] != '' ? $gallery_awesome['speed'] : '';
		$download = $gallery_awesome['dload'] != '' ? $gallery_awesome['dload'] : 'true';
		$fullscreen = $gallery_awesome['fscrn'] != '' ? $gallery_awesome['fscrn'] : 'true';
		$index_number = $gallery_awesome['index'] != '' ? $gallery_awesome['index'] : 'true';
		$shareimg = $gallery_awesome['share'] != '' ? $gallery_awesome['share'] : 'true';
		$facebook = $gallery_awesome['fbook'] != '' ? $gallery_awesome['fbook'] : 0;
		$google_plus = $gallery_awesome['gplus'] != '' ? $gallery_awesome['gplus'] : 0;
		$twitter = $gallery_awesome['twter'] != '' ? $gallery_awesome['twter'] : 0;
		$pinterest = $gallery_awesome['pntrs'] != '' ? $gallery_awesome['pntrs'] : 0;
		$thumbnails = $gallery_awesome['thumb'] != '' ? $gallery_awesome['thumb'] : 'true';
		$videomax_width = $gallery_awesome['vmaxw'] != '' ? $gallery_awesome['vmaxw'] . 'px' : '855px';
		$gallery_div = "
		<script type='text/javascript'>
		jQuery(document).ready(function() {";
			$gallery_div .= "
			jQuery('#arpGallery$id').arpGallery({
				mode: '$transition_effect',";
				if($loop_back != 'true') { $gallery_div .= "
				";
				$gallery_div .= "loop: $loop_back,"; }
				if($tran_duration != '') { $gallery_div .= "
				";
				$gallery_div .= "speed: $tran_duration,"; }
				if($index_number != 'true') { $gallery_div .= "
				";
				$gallery_div .= "counter: $index_number,"; }
				if($download != 'true') { $gallery_div .= "
				";
				$gallery_div .= "download: $download,"; }
				if($fullscreen != 'true') { $gallery_div .= "
				";
				$gallery_div .= "fullScreen: $fullscreen,"; }
				if($shareimg != 'true') { $gallery_div .= "
				";
				$gallery_div .= "share: $shareimg,"; }
				else {
				if($facebook != 1) { $gallery_div .= "
				";
				$gallery_div .= "facebook: $facebook,"; }
				if($google_plus != 1) { $gallery_div .= "
				";
				$gallery_div .= "googlePlus: $google_plus,"; }
				if($twitter != 1) { $gallery_div .= "
				";
				$gallery_div .= "twitter: $twitter,"; }
				if($pinterest != 1) { $gallery_div .= "
				";
				$gallery_div .= "pinterest: $pinterest,"; } }
				if($thumbnails != 'true') { $gallery_div .= "
				";
				$gallery_div .= "thumbnail: $thumbnails,"; }
				if($videomax_width != '855px') { $gallery_div .= "
				";
				$gallery_div .= "videoMaxWidth: '$videomax_width',"; }
				$gallery_div .= "
				currentPagerPosition : 'left'
			});
		});
		</script>";
	} elseif($gallery == 'lightcase') {
		$gallery_lightcs = get_option($gallery_name.'_lightcs');
		$lc_effect = $gallery_lightcs['lctrn'] != '' ? $gallery_lightcs['lctrn'] : 'none';
		$lc_maxwidth = $gallery_lightcs['lmaxw'] != '' ? $gallery_lightcs['lmaxw'] : 800;
		$lc_maxheight = $gallery_lightcs['lmaxh'] != '' ? $gallery_lightcs['lmaxh'] : 500;
		$lc_title = $gallery_lightcs['lcttl'] != '' ? $gallery_lightcs['lcttl'] : 'true';
		$lc_desc = $gallery_lightcs['lcdsc'] != '' ? $gallery_lightcs['lcdsc'] : 'true';
		$lc_seqinfo = $gallery_lightcs['sinfo'] != '' ? $gallery_lightcs['sinfo'] : 'true';
		$lc_iframe = $gallery_lightcs['lcfrm'] != '' ? $gallery_lightcs['lcfrm'] : 'false';
		$frame_width = $gallery_lightcs['fwdth'] != '' ? $gallery_lightcs['fwdth'] : 800;
		$frame_height = $gallery_lightcs['fhigh'] != '' ? $gallery_lightcs['fhigh'] : 500;
		$lc_voption = $gallery_lightcs['lvopt'] != '' ? $gallery_lightcs['lvopt'] : 'false';
		$lc_vwidth = $gallery_lightcs['lvwdh'] != '' ? $gallery_lightcs['lvwdh'] : 400;
		$lc_vheight = $gallery_lightcs['lvhgt'] != '' ? $gallery_lightcs['lvhgt'] : 225;
		$gallery_div = "
		<script type='text/javascript'>
		jQuery(document).ready(function() {";
		$gallery_div .= "
			jQuery('#arpGallery$id li[data-rel^=lightcase]').lightcase({";
				if($lc_effect != 'none') { $gallery_div .= "
				";
				$gallery_div .= "transition: '$lc_effect',"; }
				if($lc_maxwidth != 800) { $gallery_div .= "
				";
				$gallery_div .= "maxWidth: $lc_maxwidth,"; }
				if($lc_maxheight != 500) { $gallery_div .= "
				";
				$gallery_div .= "maxHeight: $lc_maxheight,"; }
				if($lc_title != 'true') { $gallery_div .= "
				";
				$gallery_div .= "showTitle: $lc_title,"; }
				if($lc_desc != 'true') { $gallery_div .= "
				";
				$gallery_div .= "showCaption: $lc_desc,"; }
				if($lc_seqinfo != 'true') { $gallery_div .= "
				";
				$gallery_div .= "showSequenceInfo: $lc_seqinfo,"; }
				if($lc_iframe != 'false') { $gallery_div .= "
				";
				$gallery_div .= "iframe: {";
				$gallery_div .= "
				";
				$gallery_div .= "width: $frame_width,";
				$gallery_div .= "
				";
				$gallery_div .= "height: $frame_height,";
				$gallery_div .= "
				";
				$gallery_div .= "},"; }
				if($lc_voption != 'false') { $gallery_div .= "
				";
				$gallery_div .= "video: {";
				$gallery_div .= "
				";
				$gallery_div .= "width: $lc_vwidth,";
				$gallery_div .= "
				";
				$gallery_div .= "height: $lc_vheight,";
				$gallery_div .= "
				";
				$gallery_div .= "}"; }
				$gallery_div .= "
			});
		});
		</script>";
	} else {
		$gallery_jgalery = get_option($gallery_name.'_jgalery');
		$jg_transition = $gallery_jgalery['jgtrn'] != '' ? $gallery_jgalery['jgtrn'] : 'moveToLeft_moveFromRight';
		$tran_interval = $gallery_jgalery['trivl'] != '' ? $gallery_jgalery['trivl']/10 . 's' : '0.7s';
		$max_mobile = $gallery_jgalery['maxmb'] != '' ? $gallery_jgalery['maxmb'] : 767;
		$can_close = $gallery_jgalery['close'] != '' ? $gallery_jgalery['close'] : 'true';
		$can_zoom = $gallery_jgalery['czoom'] != '' ? $gallery_jgalery['czoom'] : 'true';
		$show_title = $gallery_jgalery['imttl'] != '' ? $gallery_jgalery['imttl'] : 'true';
		$jg_thumbnail = $gallery_jgalery['jthum'] != '' ? $gallery_jgalery['jthum'] : 'true';
		$mobile_thumb = $gallery_jgalery['mobth'] != '' ? $gallery_jgalery['mobth'] : 'true';
		$thumb_position = $gallery_jgalery['thpos'] != '' ? $gallery_jgalery['thpos'] : 'bottom';
		$gallery_div = "
		<script type='text/javascript'>
		jQuery(document).ready(function() {";
		$gallery_div .= "
			jQuery('#arpGallery$id').jGallery({";
				if($jg_transition != 'moveToLeft_moveFromRight') { $gallery_div .= "
				";
				$gallery_div .= "transition: '$jg_transition',"; }
				if($tran_interval != '0.7s') { $gallery_div .= "
				";
				$gallery_div .= "transitionDuration: '$tran_interval',"; }
				if($max_mobile != 767) { $gallery_div .= "
				";
				$gallery_div .= "maxMobileWidth: $max_mobile,"; }
				if($can_close != 'false') { $gallery_div .= "
				";
				$gallery_div .= "canClose: $can_close,"; }
				if($can_zoom != 'true') { $gallery_div .= "
				";
				$gallery_div .= "canZoom: $can_zoom,"; }
				if($show_title != 'true') { $gallery_div .= "
				";
				$gallery_div .= "title: $show_title,"; }
				if($jg_thumbnail != 'true') { $gallery_div .= "
				";
				$gallery_div .= "thumbnails: $jg_thumbnail,"; }
				if($mobile_thumb != 'true') { $gallery_div .= "
				";
				$gallery_div .= "thumbnailsHideOnMobile: $mobile_thumb,"; }
				if($thumb_position != 'bottom') { $gallery_div .= "
				";
				$gallery_div .= "thumbnailsPosition: '$thumb_position',"; }
				$gallery_div .= "
			});
		});
		</script>";
	}
	return $gallery_div;
}
?>