<?php
/*
 * Awesome Responsive Photo Gallery Pro 1.0.5
 * @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
function arpg_add_new_gallery() {
	$awesome_gallery = $_POST['awesome_gallery'] != '' ? trim(preg_replace('/[^A-Za-z0-9-\w_]+/', '_', sanitize_text_field( $_POST['awesome_gallery'] ))) : '';
	if($awesome_gallery) {
		$gallery_table = get_option('galleryTables');
		$gallery_lists = explode(', ', $gallery_table);
		if(!isset($gallery_table)) {
			add_option('galleryTables', $awesome_gallery);
		} elseif(empty($gallery_table)){
			update_option('galleryTables', $awesome_gallery);
		} else {
			if(in_array($awesome_gallery, $gallery_lists)) {
				$new_awesome_gallery = 'another_' . $awesome_gallery;
				$awesome_gallery_lists = $gallery_table . ', ' . $new_awesome_gallery;
				update_option('galleryTables', $awesome_gallery_lists);
			} else {
				$awesome_gallery_lists = $gallery_table . ', ' . $awesome_gallery;
				update_option('galleryTables', $awesome_gallery_lists);
			}
		}
	}
}
function arpg_set_gallery_options() {
	$awesome_gallery = $_POST['awesome_gallery'] != '' ? $_POST['awesome_gallery'] : '';
	$option_name = $awesome_gallery.'_options';
	$gallery_options = get_option($option_name);

	$gallery_name = $_POST['gallery_name'] != '' ? trim(preg_replace('/[^A-Za-z0-9-\w_]+/', '_', sanitize_text_field( $_POST['gallery_name'] ))) : $awesome_gallery;

	$awesome_gallery = arpg_edit_gallery_name($awesome_gallery, $gallery_name);

	$my_gallery = isset($_POST['my_gallery']) ? $_POST['my_gallery'] : 'awesome';

	$gallery_option_entry = array( 'mygal' => 'my_gallery', 'cwdth' => 'container_width', 'tpspc' => 'top_space', 'btspc' => 'bottom_space', 'gpbdr' => 'gap_border', 'image' => 'image_size', 'imgwd' => 'image_width', 'imght' => 'image_height', 'hveft' => 'hover_effect', 'oveft' => 'overlay_effect', 'thttl' => 'thumb_title', 'thcap' => 'thumb_caption', 'opccp' => 'opacity_caption', 'mrgin' => 'thumb_space', 'brsle' => 'border_style', 'brwdh' => 'border_width', 'shade' => 'thumb_shadow', 'shlen' => 'shadow_length', 'blrad' => 'blur_radius', 'sprad' => 'spread_radius', 'shopc' => 'shadow_opacity', 'thrad' => 'thumb_radius', 'thlay' => 'overlay_color', 'brclr' => 'border_color', 'shclr' => 'shadow_color', 'infbg' => 'info_bg', 'inftt' => 'info_title', 'infcp' => 'info_caption' );
	foreach($gallery_option_entry as $key => $value) {
		if( isset( $_POST[$value] ) ) {
			$gallery_option_value[$key] = sanitize_text_field( $_POST[$value] );
		}
	}

	if(isset($gallery_options) && $gallery_options != '') {
		update_option($option_name, $gallery_option_value);
	} else {
		add_option($option_name, $gallery_option_value);
	}

	if($my_gallery == 'awesome') {
		$option_awsm = $awesome_gallery.'_awesome';
		$gallery_awesome = get_option($option_awsm);
		$gallery_awsm_entry = array( 'treft' => 'tran_effect', 'hveft' => 'hover_effect', 'loop' => 'loop_back', 'speed' => 'tran_duration', 'dload' => 'downloadimg', 'fscrn' => 'fullscreen', 'index' => 'index_number', 'share' => 'shareimg', 'thumb' => 'thumbnails', 'vmaxw' => 'videomax_width' );
		foreach($gallery_awsm_entry as $key => $value) {
			if( isset( $_POST[$value] ) ) {
				$gallery_awsm_value[$key] = sanitize_text_field( $_POST[$value] );
			}
		}

		$facebook = isset($_POST['facebook']) ? $_POST['facebook'] : 0;
		$google_plus = isset($_POST['google_plus']) ? $_POST['google_plus'] : 0;
		$twitter = isset($_POST['twitter']) ? $_POST['twitter'] : 0;
		$pinterest = isset($_POST['pinterest']) ? $_POST['pinterest'] : 0;

		$gallery_awsm_check = array( 'fbook' => $facebook, 'gplus' => $google_plus, 'twter' => $twitter, 'pntrs' => $pinterest );

		$galleryAwesome = array_merge($gallery_awsm_check, $gallery_awsm_value);

		if(isset($gallery_awesome) && $gallery_awesome != '') {
			update_option($option_awsm, $galleryAwesome);
		} else {
			add_option($option_awsm, $galleryAwesome);
		}
	} elseif($my_gallery == 'lightcase') {
		$option_lcas = $awesome_gallery.'_lightcs';
		$gallery_lightcs = get_option($option_lcas);
		$gallery_lcas_entry = array( 'lctrn' => 'lc_effect', 'lmaxw' => 'lc_maxwidth', 'lmaxh' => 'lc_maxheight', 'lcttl' => 'lc_title', 'lcdsc' => 'lc_desc', 'sinfo' => 'lc_seqinfo', 'lcfrm' => 'lc_iframe', 'fwdth' => 'frame_width', 'fhigh' => 'frame_height', 'lvopt' => 'lc_voption', 'lvwdh' => 'lc_vwidth', 'lvhgt' => 'lc_vheight' );
		foreach($gallery_lcas_entry as $key => $value) {
			if( isset( $_POST[$value] ) ) {
				$gallery_lcas_value[$key] = sanitize_text_field( $_POST[$value] );
			}
		}

		if(isset($gallery_lightcs) && $gallery_lightcs != '') {
			update_option($option_lcas, $gallery_lcas_value);
		} else {
			add_option($option_lcas, $gallery_lcas_value);
		}
	} else {
		$option_jgal = $awesome_gallery.'_jgalery';
		$gallery_jgalery = get_option($option_jgal);
		$gallery_jgal_entry = array( 'jgtrn' => 'jg_transition', 'trivl' => 'tran_interval', 'maxmb' => 'max_mobile', 'close' => 'can_close', 'czoom' => 'can_zoom', 'imttl' => 'show_title', 'jthum' => 'jg_thumbnail', 'mobth' => 'mobile_thumb', 'thpos' => 'thumb_position' );
		foreach($gallery_jgal_entry as $key => $value) {
			if( isset( $_POST[$value] ) ) {
				$gallery_jgal_value[$key] = sanitize_text_field( $_POST[$value] );
			}
		}

		if(isset($gallery_jgalery) && $gallery_jgalery != '') {
			update_option($option_jgal, $gallery_jgal_value);
		} else {
			add_option($option_jgal, $gallery_jgal_value);
		}
	}
}
function arpg_edit_gallery_name($edited_gallery, $awesome_gallery) {
	if($awesome_gallery && $awesome_gallery != $edited_gallery) {
		$gallery_table = get_option('galleryTables');
		$table_item = explode(', ', $gallery_table);
		foreach($table_item as $key => $value) {
			if($value == $edited_gallery) {
				if(in_array($awesome_gallery, $table_item)) {
					$awesome_gallery = 'another_' . $awesome_gallery;
					$new_gallery_table[$key] = $awesome_gallery;
				} else {
					$new_gallery_table[$key] = $awesome_gallery;
				}
			} else {
				$new_gallery_table[$key] = $value;
			}
		}
		$new_gallery_table = implode(', ', $new_gallery_table);
		update_option('galleryTables', $new_gallery_table);
		$edited_option_value = get_option($edited_gallery.'_options');
		if($edited_option_value) {
			delete_option($edited_gallery.'_options');
			add_option($awesome_gallery.'_options', $edited_option_value);
		}
		return $awesome_gallery;
	} else {
		return $edited_gallery;
	}
}
function arpg_delete_awesome_gallery() {
	$awesome_gallery = $_POST['awsmgallery'];
	$awesome_gallery_lists = get_option('galleryTables');
	$gallery_option_lists = get_option($awesome_gallery.'_options');
	$gallery_awsm_lists = get_option($awesome_gallery.'_awesome');
	$gallery_lcas_lists = get_option($awesome_gallery.'_lightcs');
	$gallery_jgal_lists = get_option($awesome_gallery.'_jgalery');
	$gallery_option_names = array('_options' => '$gallery_option_lists', '_awesome' => '$gallery_awsm_lists', '_lightcs' => '$gallery_lcas_lists', '_jgalery' => '$gallery_jgal_lists');
	foreach($gallery_option_names as $key => $option_name) {
		if(isset($option_name)) { delete_option($awesome_gallery.$key); }
	}
	$awesome_gallery_lists = explode(', ', $awesome_gallery_lists);
	$awesome_gallery_diff = array_diff($awesome_gallery_lists, array($awesome_gallery));
	if($awesome_gallery_diff) {
		$new_awesome_gallery_lists = implode(', ', $awesome_gallery_diff);
		update_option('galleryTables', $new_awesome_gallery_lists);
	} else {
		delete_option('galleryTables');
	}
	die;
}
add_action( 'wp_ajax_nopriv_arpg_delete_awesome_gallery', 'arpg_delete_awesome_gallery' );
add_action( 'wp_ajax_arpg_delete_awesome_gallery', 'arpg_delete_awesome_gallery' );
?>