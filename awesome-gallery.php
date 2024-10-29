<?php
/*
Plugin Name: Awesome Responsive Photo Gallery
Plugin URI: https://wordpress.org/plugins/awesome-responsive-photo-gallery/
Description: Lightweight, touch-friendly, responsive, lightbox gallery jQuery plugin for displaying a photo gallery in fullscreen with CSS3 transition effects.
Version: 1.0.5
Author: Realwebcare
Author URI: https://www.realwebcare.com/
Text Domain: arpg
Domain Path: /languages/
*/

/*  Copyright 2018  Realwebcare  (email : realwebcare@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
ob_start();
/* Adding necessary scripts and css */
define('ARPG_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

// This code enable for widget shortcode support
add_filter('widget_text', 'do_shortcode');

/* Internationalization */
function arpg_textdomain() {
	$domain = 'arpg';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
	load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'arpg_textdomain' );

/* Add plugin action links */
function arpg_plugin_actions( $links ) {
	$links[] = '<a href="'.menu_page_url('arpg-settings', false).'">'. __('Settings','arpg') .'</a>';
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'arpg_plugin_actions' );

/* Enqueue CSS & JS For Admin */
function arpg_admin_adding_style() {
	wp_register_script( 'arpg-admin', ARPG_PLUGIN_PATH . 'assets/js/arpg-admin.min.js', array('jquery'), '1.0.5', true );
	wp_enqueue_script( 'arpg-admin' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script( 'wp-color-picker' );
	wp_localize_script( 'arpg-admin', 'arpgajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'jquery-ui', ARPG_PLUGIN_PATH . 'assets/css/jquery-ui.css', '', '1.12.0', false );
	wp_enqueue_style( 'arpg_admin', ARPG_PLUGIN_PATH . 'assets/css/arpg-admin.min.css', '', '1.0.5', false );
}
add_action( 'admin_enqueue_scripts', 'arpg_admin_adding_style' );

/* Convert hexdec color string to rgb(a) string */
function arpg_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
		return $default;

	//Sanitize $color if "#" is provided
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	//Check if color has 6 or 3 characters and get values
	if (strlen($color) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}
	//Convert hexadec to rgb
	$rgb =  array_map('hexdec', $hex);
	//Check if opacity is set(rgba or rgb)
	if($opacity) {
		if(abs($opacity) > 1)
			$opacity = 1.0;

		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}
	//Return rgb(a) color string
	return $output;
}

/* Sidebar */
add_action( 'arpg_settings_content', 'arpg_sidebar' );
if( !function_exists( 'arpg_sidebar' ) ){
	function arpg_sidebar() { ?>
		<div id="arpg-sidebar" class="postbox-container">
			<div id="arpgusage-premium" class="arpgusage-sidebar">
				<div class="arpg">The Pro version has been developed to display Image Gallery in a lot more professional way.</div>
				<a href="http://code.realwebcare.com/item/image-gallery-responsive-photo-gallery-pro/" target="_blank">Pro Details</a>
			</div>
			<div id="arpgusage-info" class="arpgusage-sidebar">
				<h3><?php _e('Plugin Info', 'arpg'); ?></h3>
				<ul class="arpgusage-list">
					<li><?php _e('Version: 1.0.5', 'arpg'); ?></li>
					<li><?php _e('Requires: Wordpress 3.5+', 'arpg'); ?></li>
					<li><?php _e('First release: 8 March, 2018', 'arpg'); ?></li>
					<li><?php _e('Last Update: 19 May, 2018', 'arpg'); ?></li>
					<li><?php _e('By', 'arpg'); ?>: <a href="https://www.realwebcare.com/" target="_blank"><?php _e('Realwebcare', 'arpg'); ?></a></li>
					<li><a href="https://www.facebook.com/realwebcare" target="_blank"><?php _e('Facebook Page', 'arpg'); ?></a></li>
				</ul>
			</div>
		</div><?php
	}
}
require_once dirname( __FILE__ ) . '/awesome-shortcode.php';
require_once dirname( __FILE__ ) . '/class/arpg_aq_resizer.php';
require_once dirname( __FILE__ ) . '/inc/arpg-admin.php';
?>