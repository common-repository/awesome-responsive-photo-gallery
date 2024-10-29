<?php
/*
 *  Awesome Responsive Photo Gallery Pro 1.0.5
 *  @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'admin_menu', 'arpg_register_menu' );
function arpg_register_menu() {
	add_menu_page('ARPG Gallery', __('Awesome Gallery', 'arpg' ), 'add_users', __FILE__, 'arpg_plugin_menu', 'dashicons-format-gallery');
	add_submenu_page(__FILE__, __('Gallery Lists', 'arpg' ), __('All Galleries', 'arpg' ), 'add_users', 'arpg-settings', 'arpg_plugin_menu');
}
function arpg_plugin_menu() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'arpg' ) );
	}
	include ( plugin_dir_path( __FILE__ ) . 'arpg-process.php' );
}
include ( plugin_dir_path( __FILE__ ) . '../lib/store-gallery.php' );
include ( plugin_dir_path( __FILE__ ) . '../lib/functions.php' );
include ( plugin_dir_path( __FILE__ ) . '../lib/process-option.php' );
include ( plugin_dir_path( __FILE__ ) . '../lib/process-gallery-option.php' );
include ( plugin_dir_path( __FILE__ ) . 'arpg-process-options.php' );
if(isset($_POST['new_awesome_gallery']) && $_POST['new_awesome_gallery'] == "newgallery") {
	if( isset( $_POST['arpg_add_new'] ) ) { arpg_add_new_gallery(); }
}
?>