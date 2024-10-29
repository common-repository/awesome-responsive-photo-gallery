<?php
/*
 *  Awesome Responsive Photo Gallery Pro 1.0.5
 *  @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
$gallery_table = get_option('galleryTables'); ?>
<div class="wrap">
	<div id="add_new_gallery" class="postbox-container">
	<h2 class="gallery-header"><?php _e('Awesome Gallery', 'arpg'); ?> <a href="#" id="arp_gallery" class="add-new-h2"><?php _e('Add New', 'arpg'); ?></a><span id="arpg-loading-image"></span></h2>
	<form id='arpg_new' method="post" action="">
		<input type="hidden" name="new_awesome_gallery" value="newgallery">
		<div id="gallerynamediv">
			<div class="gallerynamewrap">
				<h3><?php _e('Awesome Gallery Name', 'arpg'); ?></h3>
				<input type="text" name="awesome_gallery" size="30" value="" id="awesome_gallery" autocomplete="off" placeholder="<?php _e('Enter Gallery Name','arpg'); ?>" required>
			</div>
			<input type="submit" id="arpg_add_new" name="arpg_add_new" class="button-primary" value="<?php _e('Add Gallery', 'arpg'); ?>">
		</div>
	</form><?php
	if($gallery_table) { ?>
		<div class="gallery_list">
			<form id='arpg_edit_form' method="post" action="" enctype="multipart/form-data">
				<input type="hidden" name="arpg_edit_process" value="editprocess">
				<table id="arpg_list" class="form-table">
					<thead>
						<tr>
							<th><?php _e('SN', 'arpg'); ?></th>
							<th><?php _e('Gallery Name', 'arpg'); ?></th>
							<th><?php _e('Gallery ID', 'arpg'); ?></th>
						</tr>
					</thead><?php
					$gallery_lists = explode(', ', $gallery_table);
					foreach($gallery_lists as $key => $list) {
						$list_item = ucwords(str_replace('_', ' ', $list));
						$gallery_options = get_option($list.'_options');
						$galleryId = $key + 1;
						if($gallery_options != '') { ?>
							<tbody id="arpg_<?php echo $list; ?>">
								<tr <?php if($galleryId % 2 == 0) { echo 'class="alt"'; } ?>>
									<td><?php echo $galleryId; ?></td>
									<td class="gallery_name" id="<?php echo $list; ?>">
										<div onclick="arpgprocessgallery('<?php echo $list; ?>', 'arpg_process_gallery_option')"><?php echo $list_item; ?></div>
										<span id="option_gallery" onclick="arpgprocessgallery('<?php echo $list; ?>', 'arpg_process_gallery_option')"><?php _e('Edit Options', 'arpg'); ?></span>
										<span id="remTable" onclick="arpgdeletegallery('<?php echo $list; ?>')"><?php _e('Delete', 'arpg'); ?></span>
									</td>
									<td><input type="text" name="arpg_galid" class="arpg_galid" value="<?php echo esc_html($galleryId); ?>"></td>
								</tr>
							</tbody><?php
						} else { ?>
							<tbody id="arpg_<?php echo $list; ?>">
								<tr <?php if($galleryId % 2 == 0) { echo 'class="alt"'; } ?>>
									<td><?php echo $galleryId; ?></td>
									<td class="gallery_name" id="<?php echo $list; ?>">
										<div onclick="arpgprocessgallery('<?php echo $list; ?>', 'arpg_process_gallery_option')"><?php echo $list_item; ?></div>
										<span id="option_gallery" onclick="arpgprocessgallery('<?php echo $list; ?>', 'arpg_process_gallery_option')"><?php _e('Add Options', 'arpg'); ?></span>
										<span id="remTable" onclick="arpgdeletegallery('<?php echo $list; ?>')"><?php _e('Delete', 'arpg'); ?></span>
									</td>
									<td class="arpg_notice"><span><?php _e('Mouseover on the gallery name in the left and clicked on <strong>Add Options</strong> link. After adding gallery options you will get the <strong>GALLERY ID</strong> here.', 'arpg'); ?></span></td>
								</tr>
							</tbody><?php
						}
					} ?>
				</table>
			</form>
		</div>
        <div class="gallery_list">
            <p class="get_started"><?php _e('To create photo gallery go to <b>Pages >> Add New</b>. Click on <b>Add Media</b> button to open media uploader. Now click on <b>Create Gallery</b> and select <b>Upload Files</b> if you don\'t have any images. Upload your photos and after completing upload click on <b>Create a New Gallery</b> button. In the right side enter image <b>Title</b>, <b>Alt Text</b>, <b>Description</b>, <b>Caption</b> and <b>Video URL</b>, which you want. Now, click <b>Insert Gallery</b> button. In the gallery shortcode insert your desired <b>Gallery ID</b> (depends on how you want to show your gallery) from the above Gallery ID, like [gallery <b>id="1"</b> ids="114,115,112,113,110"]. You can click on <b>Gallery ID</b> button in <b>text mode</b> to insert gallery id. Finally, <b>Publish</b> your gallery. Click <b>View Page</b> then you can see an awesome image gallery :). The image gallery will act according to the settings of that perticular Gallery ID. If you want another gallery just create an unique id and input in shortcode like, [gallery <b>id="2"</b> ids="506,505,502,503"] or [gallery <b>id="3"</b> ids="506,505,502,503"]', 'arpg'); ?></p>
        </div><?php
	} else { ?>
		<div class="gallery_list">
			<p class="get_started"><?php _e('You didn\'t add any gallery yet! Click on <strong>Add New</strong> button to get started.<br>If you need any support, feel free to share your problem in <a href="https://wordpress.org/support/plugin/awesome-responsive-photo-gallery" target="_blank">WordPress Support</a>. We&#39;d be happy to help you.', 'arpg'); ?></p>
		</div><?php
	} ?>
	</div><!-- End postbox-container --><?php
	arpg_sidebar(); ?>
</div>