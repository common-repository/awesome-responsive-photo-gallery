<?php
/*
 * Awesome Responsive Photo Gallery Pro 1.0.5
 * @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function arpg_thumbnail_hover_effect() {
	$thumbnail_hover_effect = array( 'none' => 'None', 'slideleft' => 'Slide Left', 'zoompan' => 'Zoom Pan', 'shrink' => 'Shrink' );
	foreach($thumbnail_hover_effect as $key => $effect) {				
		$hover_effect[$key] = $effect;
	}
	return $hover_effect;
}

function arpg_thumbnail_overlay_effect() {
	$thumbnail_overlay_effect = array( 'none' => 'None', 'lefttoright' => 'Left to Right', 'fadeinmid' => 'Fade In Middle', 'capfadeleft' => 'Caption Fade In Left' );
	foreach($thumbnail_overlay_effect as $key => $effect) {				
		$overlay_effect[$key] = $effect;
	}
	return $overlay_effect;
}

function arpg_border_style() {
	$border_style_values = array( 'dashed' => 'Dashed', 'dotted' => 'Dotted', 'double' => 'Double', 'groove' => 'Groove', 'inset' => 'Inset', 'outset' => 'Outset', 'ridge' => 'Ridge', 'solid' => 'Solid' );
	foreach($border_style_values as $key => $value) {				
		$border_style[$key] = $value;
	}
	return $border_style;
}

function arpg_transition_effects() {
	$ag_transition_effects = array( 'slide' => 'Slide', 'fade' => 'Fade' );
	foreach($ag_transition_effects as $key => $effect) {				
		$gallery_transition[$key] = $effect;
	}
	return $gallery_transition;
}

function arpg_lightcase_transitions() {
	$lc_transition_values = array( 'none' => 'None', 'fade' => 'Fade', 'scrollHorizontal' => 'Scroll Horizontal' );
	foreach($lc_transition_values as $key => $value) {				
		$transition_value[$key] = $value;
	}
	return $transition_value;
}

function arpg_thumbnails_position() {
	$thumb_position_values = array( 'bottom' => 'Bottom', 'right' => 'Right' );
	foreach($thumb_position_values as $key => $value) {				
		$thumb_position[$key] = $value;
	}
	return $thumb_position;
}

function arpg_jgallery_transitions() {
	$jgallery_transitions = array( 'moveToLeft_moveFromRight', 'moveToRight_moveFromLeft', 'moveToTop_moveFromBottom', 'moveToBottom_moveFromTop' );
	foreach($jgallery_transitions as $value) {				
		$jg_transition[$value] = $value;
	}
	return $jg_transition;
}

/* Add “data-” attribute to image links */
function arpg_filter_image_send_to_editor($id, $url, $img) {
	$html = sprintf("<a href='$url'>$img</a>");
	return $html;
}
add_filter('image_send_to_editor', 'arpg_filter_image_send_to_editor', 10, 8);

/* Add Video URL fields to media uploader */
function arpg_attachment_video_field( $form_fields, $post ) {
	$form_fields['arpg-video-url'] = array(
		'label' => 'Video URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, '_arpg_video_url', true ),
		'helps' => 'Add Youtube or Vimeo URL',
	);
	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'arpg_attachment_video_field', 10, 2 );

/* Save values of Video URL in media uploader */
function arpg_attachment_video_field_save( $post, $attachment ) {
	if( isset( $attachment['arpg-video-url'] ) )
		update_post_meta( $post['ID'], '_arpg_video_url', esc_url( $attachment['arpg-video-url'] ) );
	return $post;
}
add_filter( 'attachment_fields_to_save', 'arpg_attachment_video_field_save', 10, 2 );

/* Check the video URL and get workable URL and thumbnail */
function arpg_parseVideos($videoString = 'null', $id) {
    $videos = array();	// return data
	$gallery_lists = get_option('galleryTables');
	$gallery_lists = explode(', ', $gallery_lists);
	$gallery = $gallery_lists[$id-1];
	$gallery_options = get_option($gallery.'_options');
	$gallery_lightcs = get_option($gallery.'_lightcs');

    if (!empty($videoString)) {
        // split on line breaks
        $videoString = stripslashes(trim($videoString));
        $videoString = explode("\n", $videoString);
        $videoString = array_filter($videoString, 'trim');
        // check each video for proper formatting
        foreach ($videoString as $video) {
            // check for iframe to get the video url
            if (strpos($video, 'iframe') !== FALSE) {
                // retrieve the video url
                $anchorRegex = '/src="(.*)?"/isU';
                $results = array();
                if (preg_match($anchorRegex, $video, $results)) {
                    $link = trim($results[1]);
                }
            } else {
                $link = $video;		// we already have a url
            }
            // if we have a URL, parse it down
            if (!empty($link)) {
                // initial values
                $video_id = NULL;
                $videoIdRegex = NULL;
                $results = array();
                // check for type of youtube link
                if (strpos($link, 'youtu') !== FALSE) {
                    $videoIdRegex = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
                    if ($videoIdRegex !== NULL) {
                        if (preg_match($videoIdRegex, $link, $results)) {
							$video_str = 'http://www.youtube.com/embed/%s?wmode=opaque&enablejsapi=1';
                            $thumbnail_str = 'http://img.youtube.com/vi/%s/2.jpg';
                            $fullsize_str = 'http://img.youtube.com/vi/%s/0.jpg';
                            $video_id = $results[1];
                        }
                    }
                }
                // handle vimeo videos
                else if (strpos($video, 'vimeo') !== FALSE) {
                    if (strpos($video, 'player.vimeo.com') !== FALSE) {
                        // works on:
                        // http://player.vimeo.com/video/37985580?title=0&amp;byline=0&amp;portrait=0
                        $videoIdRegex = '/player.vimeo.com\/video\/([0-9]+)\??/i';
                    } else {
                        // works on:
                        // http://vimeo.com/37985580
                        $videoIdRegex = '/vimeo.com\/([0-9]+)\??/i';
                    }
                    if ($videoIdRegex !== NULL) {
                        if (preg_match($videoIdRegex, $link, $results)) {
                            $video_id = $results[1];
                            // get the thumbnail
                            try {
                                $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
                                if (!empty($hash) && is_array($hash)) {
									$video_str = '//player.vimeo.com/video/%s?api=1';
                                    $thumbnail_str = $hash[0]['thumbnail_small'];
                                    $fullsize_str = $hash[0]['thumbnail_large'];
                                } else {
                                    // don't use, couldn't find what we need
                                    //unset($video_id);
									$video_str = "//player.vimeo.com/video/$video_id";
                                }
                            } catch (Exception $e) {
                                unset($video_id);
                            }
                        }
                    }
                }
                // check if we have a video id, if so, add the video metadata
                if (!empty($video_id)) {
                    // add to return
                    $videos[] = array(
                        'url' => sprintf($video_str, $video_id),
                        'thumbnail' => sprintf($thumbnail_str, $video_id),
                        'fullsize' => sprintf($fullsize_str, $video_id)
                    );
                }
            }
        }
    }
    // return array of parsed videos
    return $videos;
}

/* Add Gallery ID Buttons to WordPress Text Editor */
function arpg_gallery_id_button_script() {
	if(wp_script_is("quicktags")) { ?>
	<script type="text/javascript">
		//this function is used to retrieve the selected text from the text editor
		function getSel() {
			var txtarea = document.getElementById("content");
			var start = txtarea.selectionStart;
			var finish = txtarea.selectionEnd;
			return txtarea.value.substring(start, finish);
		}
		QTags.addButton( 
			"galleryid", 
			"Gallery ID", 
			callback
		);
		function callback() {
			var selected_text = getSel(),
				number = prompt("Enter Gallery ID"),
				return_text = '';
			if (number !== null) {
				number = parseInt(number);
				if (number > 0 && number <= 99999) {
					QTags.insertContent('id="' + number + '"');
				}
				else {
					alert("The number value is invalid. It should be from 1 to 99999.");
				}
			}
		}
	</script><?php
	}
}
add_action("admin_print_footer_scripts", "arpg_gallery_id_button_script");
?>