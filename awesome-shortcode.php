<?php
/*
 *  Awesome Responsive Photo Gallery 1.0.5
 *  @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// remove unnecessary data 
remove_filter('the_content', 'wptexturize');
remove_filter('the_content', 'wpautop');

// Registering Shortcode
function awesome_gallery_shortcode( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$output = apply_filters( 'post_gallery', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}
	
	$html5 = current_theme_supports( 'html5', 'gallery' );

	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => 1,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	$gallery_lists = get_option('galleryTables');
	$gallery_lists = explode(', ', $gallery_lists);
	$gallery = isset($gallery_lists[$id-1]) ? $gallery_lists[$id-1] : '';
	$gallery_id = strtolower($gallery) . '-' .$id;
	$gallery_options = get_option($gallery.'_options');
	$my_gallery = $gallery_options['mygal'] != '' ? $gallery_options['mygal'] : 'awesome';
	$image_width = $gallery_options['imgwd'] != '' ? $gallery_options['imgwd'] : 250;
	$image_height = $gallery_options['imght'] != '' ? $gallery_options['imght'] : 250;
	$thumb_title = $gallery_options['thttl'] != '' ? $gallery_options['thttl'] : 'false';
	$thumb_caption = $gallery_options['thcap'] != '' ? $gallery_options['thcap'] : 'false';

	if(isset($gallery_options) && $gallery_options != '') {
		if($my_gallery == 'awesome') {
			wp_register_script('awesomegallery', plugins_url( '/assets/js/awesomegallery.min.js', __FILE__ ), array('jquery'), '1.0.5', true);
			wp_register_script('arpg-mousewheel', plugins_url( '/assets/js/jquery.mousewheel.min.js', __FILE__ ), array('jquery'), '3.1.12', true);
			wp_enqueue_script('awesomegallery');
			wp_enqueue_script('arpg-mousewheel');
			wp_enqueue_style('awesomegallery', plugins_url('/assets/css/awesomegallery.min.css', __FILE__), '', '1.0.5', false);
		} elseif($my_gallery == 'lightcase') {
			wp_register_script('lightcase', plugins_url( '/assets/js/lightcase.min.js', __FILE__ ), array('jquery'), '2.5.0', true);
			wp_enqueue_script('lightcase');
			wp_enqueue_style('lightcase', plugins_url('/assets/css/lightcase.min.css', __FILE__), '', '2.5.0', false);
		} else {
			wp_register_script('jgallery', plugins_url( '/assets/js/jgallery.min.js', __FILE__ ), array('jquery'), '1.6.4', true);
			wp_register_script('touchswipe', plugins_url( '/assets/js/touchswipe.min.js', __FILE__ ), array('jquery'), '1.6.9', true);
			wp_enqueue_script('jgallery');
			wp_enqueue_script('touchswipe');
			wp_enqueue_style('jgallery', plugins_url('/assets/css/jgallery.min.css', __FILE__), '', '1.6.4', false);
		}
		if($my_gallery == 'awesome' || $my_gallery == 'jgallery') {
			wp_enqueue_style('fontawesome', plugins_url('/assets/css/fontawesome.min.css', __FILE__), '', '5.0.9', false);
		}
	}
	
	$size = $gallery_options['image'] != '' ? $gallery_options['image'] : $atts['size'];

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		}
		return $output;
	}

	$selector = "gallery-{$instance}";

	$imgdetails = $gallery_style = $gallery_div = '';

	$size_class = sanitize_html_class( $size );
	$cats = array();
	
	echo arpg_process_option($gallery, $my_gallery, $size, $id);

	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	if($my_gallery != 'jgallery') {
		if($my_gallery == 'awesome') $gallery_class = 'arp_gallery';
		else $gallery_class = 'lcs_gallery';
	} else $gallery_class = 'j_gallery';
	if($my_gallery != 'jgallery') {
		$output .= "
		<ul id='arpGallery$id' class='$gallery_class'>
			";
	} else {
		$output .= "
		<div id='arpGallery$id' class='$gallery_class'>";
	}

	$i = 0; $lcid = $id;
	foreach ( $attachments as $id => $attachment ) {
		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		$awesome_full_image = wp_get_attachment_url( $id,'full' );
		$awesome_big_image  = wp_get_attachment_image_src( $id, 'large', false);
		$awesome_medium_image = wp_get_attachment_image_src( $id, 'medium', false);
		$jgallery_thumb = wp_get_attachment_image_src( $id, $size, false);
		$awesome_title = $attachment->post_title != '' ? $attachment->post_title : '';
		$awesome_description = $attachment->post_content != '' ?$attachment->post_content : '';
		$awesome_caption = $attachment->post_excerpt != '' ?$attachment->post_excerpt : '';

		if ( $thumb_title != 'false' || $thumb_caption != 'false' ) {
			$imgdetails = "
					<figcaption>";
				if($thumb_title != 'false') { $imgdetails .= "<h2>$awesome_title</h2>"; }
				if($thumb_caption != 'false') { $imgdetails .= "<p>$awesome_caption</p>"; }
			$imgdetails .= "</figcaption>";
		}

		if($my_gallery == 'awesome') {
			$awesome_video = get_post_meta($id, '_arpg_video_url', true);
		} else {
			$awesome_video = get_post_meta($id, '_arpg_video_url', true);
			$video_format = arpg_parseVideos($awesome_video, $lcid);
			if ($video_format) {
				foreach($video_format as $key => $video) {
					$video[$key] = $video;
				}
				$video_url = $video['url'];
			} else
				$video_url = $awesome_video;
		}

		if($size != 'custom') {
			if($my_gallery != 'jgallery') {
				if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
					$image_output = wp_get_attachment_link( $id, $size, false, false, false, $attr );
				} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
					$image_output = wp_get_attachment_image( $id, $size, false, $attr );
				} else {
					$image_output = wp_get_attachment_link( $id, $size, true, false, false, $attr );
				}
			} else {
				$img_src = "
				<img class='ag-thumbnail' src='$jgallery_thumb[0]' alt='$awesome_title'>
				<div class='awesome-gallery-poster'>$imgdetails
					<img src=".ARPG_PLUGIN_PATH."assets/images/zoom.png alt='zoom'>
				</div>
				";
				$image_output = arpg_filter_image_send_to_editor( $id, $awesome_full_image, $img_src );
			}
		} else {
			$awesome_thumb = aq_resize( $awesome_full_image, $image_width, $image_height, true, true, true );
			if ($awesome_video && $my_gallery != 'jgallery') {
				if($my_gallery == 'awesome') {
					$image_output = "
			<li data-title='$awesome_title' data-desc='$awesome_description' data-responsive-src='$awesome_medium_image[0]' data-src='$awesome_video'>
				<img class='ag-thumbnail' src='$awesome_thumb' alt='$awesome_title'>
				<div class='awesome-video-poster'>$imgdetails
					<img src=".ARPG_PLUGIN_PATH."assets/images/play-button.png alt='play'>
				</div>
			</li>";
				} else {
					$image_output = 
			"<li href='$video_url' data-rel='lightcase:myCollection$lcid' title='$awesome_title' caption='$awesome_description'>
				<img class='ag-thumbnail' src='$awesome_thumb' alt='$awesome_title'>
				<div class='awesome-video-poster'>$imgdetails
					<img src=".ARPG_PLUGIN_PATH."assets/images/play-button.png alt='play'>
				</div>
			</li>";
				}
			} else {
				if($my_gallery == 'awesome') {
					$image_output = "<li data-title='$awesome_title' data-desc='$awesome_description' data-responsive-src='$awesome_medium_image[0]' data-src='$awesome_full_image'>
				<img class='ag-thumbnail' src='$awesome_thumb' alt='$awesome_title'>
				<div class='awesome-gallery-poster'>$imgdetails
					<img src=".ARPG_PLUGIN_PATH."assets/images/zoom.png alt='zoom'>
				</div>
			</li>";
				} elseif($my_gallery == 'lightcase') {
					$image_output = 
			"<li href='$awesome_full_image' data-rel='lightcase:myCollection$lcid' title='$awesome_title' caption='$awesome_description'>
				<img class='ag-thumbnail' src='$awesome_thumb' alt='$awesome_title'>
				<div class='awesome-gallery-poster'>$imgdetails
					<img src=".ARPG_PLUGIN_PATH."assets/images/zoom.png alt='zoom'>
				</div>
			</li>";
				} else {
				$image_output ="
			<a href='$awesome_full_image'>
				<img class='ag-thumbnail' src='$awesome_thumb' alt='$awesome_title'>
				<div class='awesome-gallery-poster'>$imgdetails
					<img src=".ARPG_PLUGIN_PATH."assets/images/zoom.png alt='zoom'>
				</div>
			</a>
			";
				}
			}
		}

		$image_meta  = wp_get_attachment_metadata( $id );
		
		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}

		if($size == 'custom') {
			$output .= "$image_output";
		} else {
			if ($awesome_video && $my_gallery != 'jgallery') {
				if($my_gallery == 'awesome') {
					$output .= 
			"<li class='awesome-video' data-title='$awesome_title' data-desc='$awesome_description' data-responsive-src='$awesome_medium_image[0]' data-src='$awesome_video'>
				<div class='overlay_thumb'></div>
				<div class='awesome-video-icon'></div>$imgdetails
				$image_output
			</li>
			";
				} else {
					$output .= 
			"<li class='awesome-video' href='$video_url' data-rel='lightcase:myCollection$lcid' title='$awesome_title' caption='$awesome_description'>
				<div class='overlay_thumb'></div>
				<div class='awesome-video-icon'></div>$imgdetails
				$image_output
			</li>
			";
				}
			} else {
				if($my_gallery == 'awesome') {
					$output .= 
			"<li class='awesome-gallery' data-title='$awesome_title' data-desc='$awesome_description' data-responsive-src='$awesome_medium_image[0]' data-src='$awesome_big_image[0]'>
				<div class='overlay_thumb'></div>
				<div class='awesome-gallery-icon'></div>$imgdetails
				$image_output
			</li>
			";
				} elseif($my_gallery == 'lightcase') {
					$output .= 
			"<li class='awesome-gallery' href='$awesome_big_image[0]' data-rel='lightcase:myCollection$lcid' title='$awesome_title' caption='$awesome_description'>
				<div class='overlay_thumb'></div>
				<div class='awesome-gallery-icon'></div>$imgdetails
				$image_output
			</li>
			";
				} else {
					$output .= "
			$image_output";
				}
			}
		}
	}
	if($my_gallery != 'jgallery') {
		$output .= "
		</ul>\n";
	} else {
		$output .= "
		</div>\n";
	}

	$output .= arpg_process_gallery($gallery, $my_gallery, $lcid);
	do_action('arpg_after_gallery');
	return $output;
}
add_shortcode('gallery', 'awesome_gallery_shortcode');
add_action('wp_enqueue_scripts', 'awesome_gallery_shortcode');
?>