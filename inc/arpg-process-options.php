<?php
/*
 *  Awesome Responsive Photo Gallery Pro 1.0.5
 *  @realwebcare - https://www.realwebcare.com/
 */
if ( ! defined( 'ABSPATH' ) ) exit;
function arpg_process_gallery_option() {
	$awesome_gallery = $_POST['awsmgallery'];
	$awesome_gallery_name = ucwords(str_replace('_', ' ', $awesome_gallery));
	$gallery_options = get_option($awesome_gallery.'_options');
	$gallery_awesome = get_option($awesome_gallery.'_awesome');
	$gallery_lightcs = get_option($awesome_gallery.'_lightcs');
	$gallery_jgalery = get_option($awesome_gallery.'_jgalery');
	$hover_effects = arpg_thumbnail_hover_effect();
	$overlay_effects = arpg_thumbnail_overlay_effect();
	$border_styles = arpg_border_style();
	$transition_effects = arpg_transition_effects();
	$lc_transitions = arpg_lightcase_transitions();
	$thumb_positions = arpg_thumbnails_position();
	$jg_transitions = arpg_jgallery_transitions(); ?>
	<div id="settinggallerydiv">
		<div id="tabs">
			<ul>
				<li><a href="#general"><?php _e('General Settings', 'arpg'); ?></a></li>
				<li><a href="#awesome"><?php _e('Awesome Gallery', 'arpg'); ?></a></li>
				<li><a href="#lightcs"><?php _e('Lightcase Gallery', 'arpg'); ?></a></li>
				<li><a href="#jgalery"><?php _e('jGallery (Only Photo)', 'arpg'); ?></a></li>
			</ul>

			<div id="general" class="gallery-input">
                <div id="gn-accordion" class="arpg-accordion">
                    <h3>General</h3>
                    <div class="accordion-input">
                    	<h4>Gallery Setup</h4>
                        <label class="label-title"><?php _e('Modify Gallery Name', 'arpg'); ?></label>
                        <input type="text" name="gallery_name" class="medium" id="gallery_name" value="<?php echo $awesome_gallery_name; ?>">
                        <label class="label-title"><?php _e('Select Which Gallery to Use', 'arpg'); ?></label>
                        <select name="my_gallery" id="my_gallery" class="gallery-dir">
                            <?php if($gallery_options['mygal'] == 'lightcase') { ?>
                            <option value="awesome"><?php _e('Awesome Gallery', 'arpg'); ?></option>
                            <option value="lightcase" selected><?php _e('Lightcase Gallery', 'arpg'); ?></option>
                            <option value="jgallery"><?php _e('J Gallery (Only Photo)', 'arpg'); ?></option>
                            <?php } elseif($gallery_options['mygal'] == 'jgallery') { ?>
                            <option value="awesome"><?php _e('Awesome Gallery', 'arpg'); ?></option>
                            <option value="lightcase"><?php _e('Lightcase Gallery', 'arpg'); ?></option>
                            <option id="jgallery_on" value="jgallery" selected><?php _e('J Gallery (Only Photo)', 'arpg'); ?></option>
                            <?php } else { ?> { ?>
                            <option value="awesome" selected><?php _e('Awesome Gallery', 'arpg'); ?></option>
                            <option value="lightcase"><?php _e('Lightcase Gallery', 'arpg'); ?></option>
                            <option value="jgallery"><?php _e('J Gallery (Only Photo)', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                    	<h4>Structure</h4>
                        <label class="label-title"><?php _e('Gallery Container Width', 'arpg'); ?></label>
                        <input type="number" name="container_width" class="medium" id="container_width" value="<?php echo $gallery_options['cwdth']; ?>" min="1" max="100" placeholder="e.g. 100">
                        <label class="label-title"><?php _e('Gallery Top Space', 'arpg'); ?></label>
                        <input type="number" name="top_space" class="medium" id="top_space" value="<?php echo $gallery_options['tpspc']; ?>" min="0" max="1000" placeholder="e.g. 30">
                        <label class="label-title"><?php _e('Gallery Bottom Space', 'arpg'); ?></label>
                        <input type="number" name="bottom_space" class="medium" id="bottom_space" value="<?php echo $gallery_options['btspc']; ?>" min="0" max="1000" placeholder="e.g. 30">
					</div>
                    <h3>Thumbnail</h3>
                    <div class="accordion-input">
                    	<h4>Thumbnail Size</h4>
                        <label class="label-title"><?php _e('Image Size', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('Set the image thumbnail size from here depends on how you want to display your gallery thumbnail.', 'arpg'); ?>"></a></label>
                        <select name="image_size" id="image_size" class="gallery-dir">
                            <?php if($gallery_options['image'] == 'thumbnail') { ?>
                            <option value="thumbnail" selected><?php _e('Thumbnail', 'arpg'); ?></option>
                            <option value="medium"><?php _e('Medium', 'arpg'); ?></option>
                            <option value="large"><?php _e('Large', 'arpg'); ?></option>
                            <option value="full"><?php _e('Full Size', 'arpg'); ?></option>
                            <option value="custom"><?php _e('Custom', 'arpg'); ?></option>
                            <?php } elseif($gallery_options['image'] == 'medium') { ?>
                            <option value="thumbnail"><?php _e('Thumbnail', 'arpg'); ?></option>
                            <option value="medium" selected><?php _e('Medium', 'arpg'); ?></option>
                            <option value="large"><?php _e('Large', 'arpg'); ?></option>
                            <option value="full"><?php _e('Full Size', 'arpg'); ?></option>
                            <option value="custom"><?php _e('Custom', 'arpg'); ?></option>
                            <?php } elseif($gallery_options['image'] == 'large') { ?>
                            <option value="thumbnail"><?php _e('Thumbnail', 'arpg'); ?></option>
                            <option value="medium"><?php _e('Medium', 'arpg'); ?></option>
                            <option value="large" selected><?php _e('Large', 'arpg'); ?></option>
                            <option value="full"><?php _e('Full Size', 'arpg'); ?></option>
                            <option value="custom"><?php _e('Custom', 'arpg'); ?></option>
                            <?php } elseif($gallery_options['image'] == 'full') { ?>
                            <option value="thumbnail"><?php _e('Thumbnail', 'arpg'); ?></option>
                            <option value="medium"><?php _e('Medium', 'arpg'); ?></option>
                            <option value="large"><?php _e('Large', 'arpg'); ?></option>
                            <option value="full" selected><?php _e('Full Size', 'arpg'); ?></option>
                            <option value="custom"><?php _e('Custom', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="thumbnail"><?php _e('Thumbnail', 'arpg'); ?></option>
                            <option value="medium"><?php _e('Medium', 'arpg'); ?></option>
                            <option value="large"><?php _e('Large', 'arpg'); ?></option>
                            <option value="full"><?php _e('Full Size', 'arpg'); ?></option>
                            <option id="custom_size" value="custom" selected><?php _e('Custom', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <div id="imageWidthHeight">
                            <label class="label-title"><?php _e('Gallery Thumbnail Width (in px)', 'arpg'); ?></label>
                            <input type="number" name="image_width" class="medium" id="image_width" value="<?php echo $gallery_options['imgwd']; ?>" min="1" max="10000" placeholder="e.g. 250">
                            <label class="label-title"><?php _e('Gallery Thumbnail Height (in px)', 'arpg'); ?></label>
                            <input type="number" name="image_height" class="medium" id="image_height" value="<?php echo $gallery_options['imght']; ?>" min="1" max="10000" placeholder="e.g. 250">
                        </div>
                        <label class="label-title"><?php _e('Space Between Thumbnails (in px)', 'arpg'); ?></label>
                        <input type="number" name="thumb_space" class="medium" id="thumb_space" value="<?php echo $gallery_options['mrgin']; ?>" min="0" max="50" placeholder="e.g. 10">
                        <h4>Thumbnail Effect</h4>
                        <label class="label-title"><?php _e('Thumbnail Hover Image Effect', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('Select a hover effect for gallery thumbnails.', 'arpg'); ?>"></a></label>
                        <select name="hover_effect" id="hover_effect" class="gallery-dir"><?php
                            foreach($hover_effects as $key => $effect) { ?>
                                <option value="<?php echo $key; ?>"<?php if($gallery_options['hveft'] == $key) { ?> selected<?php } ?>><?php echo $effect; ?></option><?php
                            } ?>
                        </select>
                        <label class="label-title"><?php _e('Thumbnail Hover Overlay Effect', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('Select a hover effect for gallery thumbnails.', 'arpg'); ?>"></a></label>
                        <select name="overlay_effect" id="overlay_effect" class="gallery-dir"><?php
                            foreach($overlay_effects as $key => $effect) { ?>
                                <option value="<?php echo $key; ?>"<?php if($gallery_options['oveft'] == $key) { ?> selected<?php } ?>><?php echo $effect; ?></option><?php
                            } ?>
                        </select>
                        <h4>Thumbnail Info</h4>
                        <label class="label-title"><?php _e('Enable Thumbnail Title', 'arpg'); ?></label>
                        <select name="thumb_title" id="thumb_title" class="gallery-dir">
                            <?php if($gallery_options['thttl'] == 'true') { ?>
                            <option id="title_yes" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Enable Thumbnail Caption', 'arpg'); ?></label>
                        <select name="thumb_caption" id="thumb_caption" class="gallery-dir">
                            <?php if($gallery_options['thcap'] == 'true') { ?>
                            <option id="cap_on" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Info Background Opacity', 'arpg'); ?></label>
                        <input type="number" name="opacity_caption" class="medium" id="opacity_caption" value="<?php echo $gallery_options['opccp']; ?>" min="0" max="100" placeholder="e.g. 92">
                        <h4>Thumbnail Border</h4>
                        <label class="label-title"><?php _e('Thumbnail Border Style', 'arpg'); ?></label>
                        <select name="border_style" id="border_style" class="gallery-dir">
							<option id="none_on" value="none"><?php _e('None', 'arpg'); ?></option><?php
                            foreach($border_styles as $key => $style) { ?>
                                <option value="<?php echo $key; ?>"<?php if($gallery_options['brsle'] == $key) { ?> selected<?php } ?>><?php echo $style; ?></option><?php
                            } ?>
                        </select>
                        <div id="thumbBorderWidth">
                            <label class="label-title"><?php _e('Thumbnail Border Width', 'arpg'); ?></label>
                            <input type="number" name="border_width" class="medium" id="border_width" value="<?php echo $gallery_options['brwdh']; ?>" min="1" max="50" placeholder="e.g. 10">
                        </div>
                        <label class="label-title"><?php _e('Thumbnail Border Radius (in \'%\')', 'arpg'); ?></label>
                        <input type="number" name="thumb_radius" class="medium" id="thumb_radius" value="<?php echo $gallery_options['thrad']; ?>" min="0" max="100" placeholder="e.g. 3">
                        <h4>Thumbnail Shadow</h4>
                        <label class="label-title"><?php _e('Enable Thumbnail Shadow', 'arpg'); ?></label>
                        <select name="thumb_shadow" id="thumb_shadow" class="gallery-dir">
                            <?php if($gallery_options['shade'] == 'true') { ?>
                            <option id="shade_on" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <div id="thumbnailShadow">
                            <label class="label-title"><?php _e('Shadow Horizontal &amp; Vertical Length', 'arpg'); ?></label>
                            <input type="number" name="shadow_length" class="medium" id="shadow_length" value="<?php echo $gallery_options['shlen']; ?>" min="-200" max="200" placeholder="e.g. 2">
                            <label class="label-title"><?php _e('Shadow Blur Radius', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('If set to 0 the shadow will be sharp, the higher the number, the more blurred it will be, and the further out the shadow will extend. For instance a shadow with 5px of horizontal offset that also has a 5px blur radius will be 10px of total shadow.', 'arpg'); ?>"></a></label>
                            <input type="number" name="blur_radius" class="medium" id="blur_radius" value="<?php echo $gallery_options['blrad']; ?>" min="0" max="300" placeholder="e.g. 6">
                            <label class="label-title"><?php _e('Shadow Spread Radius', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('(optional), positive values increase the size of the shadow, negative values decrease the size. Default is 0 (the shadow is same size as blur).', 'arpg'); ?>"></a></label>
                            <input type="number" name="spread_radius" class="medium" id="spread_radius" value="<?php echo $gallery_options['sprad']; ?>" min="-200" max="200" placeholder="e.g. 1">
                            <label class="label-title"><?php _e('Shadow Color Opacity', 'arpg'); ?></label>
                            <input type="number" name="shadow_opacity" class="medium" id="shadow_opacity" value="<?php echo $gallery_options['shopc']; ?>" min="1" max="100" placeholder="e.g. 75">
                        </div>
                    </div>
                    <h3>Color</h3>
                    <div class="accordion-input">
                        <table>
                            <!--Gallery Color -->
                            <tr class="galtab-header">
                                <td colspan="2"><?php _e('Gallery Thumbnail Colors', 'arpg'); ?></td>
                            </tr>
                            <tr class="galtab-input">
                                <th><label class="label-title"><?php _e('Thumbnail Overlay Color', 'arpg'); ?></label></th>
                                <td><input type="text" name="overlay_color" class="overlay_color" id="overlay_color" value="<?php echo $gallery_options['thlay']; ?>"></td>
                            </tr>
                            <tr class="galtab-input">
                                <th><label class="label-title"><?php _e('Thumbnail Border Color', 'arpg'); ?></label></th>
                                <td><input type="text" name="border_color" class="border_color" id="border_color" value="<?php echo $gallery_options['brclr']; ?>"></td>
                            </tr>
                            <tr class="galtab-input">
                                <th><label class="label-title"><?php _e('Thumbnail Shadow Color', 'arpg'); ?></label></th>
                                <td><input type="text" name="shadow_color" class="shadow_color" id="shadow_color" value="<?php echo $gallery_options['shclr']; ?>"></td>
                            </tr>
                            <tr class="galtab-input">
                                <th><label class="label-title"><?php _e('Thumbnail Info BG Color', 'arpg'); ?></label></th>
                                <td><input type="text" name="info_bg" class="info_bg" id="info_bg" value="<?php echo $gallery_options['infbg']; ?>"></td>
                            </tr>
                            <tr class="galtab-input">
                                <th><label class="label-title"><?php _e('Thumbnail Info Title Color', 'arpg'); ?></label></th>
                                <td><input type="text" name="info_title" class="info_title" id="info_title" value="<?php echo $gallery_options['inftt']; ?>"></td>
                            </tr>
                            <tr class="galtab-input">
                                <th><label class="label-title"><?php _e('Thumbnail Info Caption Color', 'arpg'); ?></label></th>
                                <td><input type="text" name="info_caption" class="info_caption" id="info_caption" value="<?php echo $gallery_options['infcp']; ?>"></td>
                            </tr>
                        </table>
                    </div>
				</div>
			</div> <!--#general -->

			<div id="awesome" class="gallery-input">
                <div id="gl-accordion" class="arpg-accordion">
                    <h3>General</h3>
                    <div class="accordion-input">
                        <label class="label-title"><?php _e('Transition Effect Between Images', 'arpg'); ?></label>
                        <select name="tran_effect" id="tran_effect" class="gallery-dir"><?php
                            foreach($transition_effects as $key => $effect) { ?>
                                <option value="<?php echo $key; ?>"<?php if($gallery_awesome['treft'] == $key) { ?> selected<?php } ?>><?php echo $effect; ?></option><?php
                            } ?>
                        </select>
                        <label class="label-title"><?php _e('Loop back to the Beginning', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('If false, will disable the ability to loop back to the beginning of the gallery when on the last element.', 'arpg'); ?>"></a></label>
                        <select name="loop_back" id="loop_back" class="gallery-dir">
                            <?php if($gallery_awesome['loop'] == 'false') { ?>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Transition duration (in ms)', 'arpg'); ?></label>
                        <input type="number" name="tran_duration" class="medium" id="tran_duration" value="<?php echo $gallery_awesome['speed']; ?>" min="100" max="10000" placeholder="e.g. 600">
                        <label class="label-title"><?php _e('Video Maximal Width (in px)', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('Set limit for video maximal width. Default: 855px.', 'arpg'); ?>"></a></label>
                        <input type="number" name="videomax_width" class="medium" id="videomax_width" value="<?php echo $gallery_awesome['vmaxw']; ?>" min="50" max="2000" placeholder="e.g. 855">
                    </div>
                    <h3>Show/Hide</h3>
                    <div class="accordion-input">
                        <label class="label-title"><?php _e('Show/Hide Download Button', 'arpg'); ?></label>
                        <select name="downloadimg" id="downloadimg" class="gallery-dir">
                            <?php if($gallery_awesome['dload'] == 'true') { ?>
                            <option value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Show/Hide Fulscreen Button', 'arpg'); ?></label>
                        <select name="fullscreen" id="fullscreen" class="gallery-dir">
                            <?php if($gallery_awesome['fscrn'] == 'true') { ?>
                            <option value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Show/Hide Index Number', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('Whether to show total number of images and index number of currently displayed image.', 'arpg'); ?>"></a></label>
                        <select name="index_number" id="index_number" class="gallery-dir">
                            <?php if($gallery_awesome['index'] == 'false') { ?>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <option value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Show/Hide Share Button', 'arpg'); ?></label>
                        <select name="shareimg" id="shareimg" class="gallery-dir">
                            <?php if($gallery_awesome['share'] == 'true') { ?>
                            <option id="share_on" value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <div id="shareSocialMedia">
                            <label class="label-check"><?php _e('Show/Hide Different Social Media Share', 'arpg'); ?>:</label>
                            <div class="gallery-onoff-check">
                                <label for="facebook" class="player_param"><span><?php _e('Facebook', 'arpg'); ?></span><input type="checkbox" name="facebook" value="1"<?php if($gallery_awesome['fbook'] == 1) { ?> checked<?php } ?>></label>
                                <label for="googlePlus" class="player_param"><span><?php _e('Google Plus', 'arpg'); ?></span><input type="checkbox" name="google_plus" value="1"<?php if($gallery_awesome['gplus'] == 1) { ?> checked<?php } ?>></label>
                                <label for="twitter" class="player_param"><span><?php _e('Twitter', 'arpg'); ?></span><input type="checkbox" name="twitter" value="1"<?php if($gallery_awesome['twter'] == 1) { ?> checked<?php } ?>></label>
                                <label for="pinterest" class="player_param"><span><?php _e('Pinterest', 'arpg'); ?></span><input type="checkbox" name="pinterest" value="1"<?php if($gallery_awesome['pntrs'] == 1) { ?> checked<?php } ?>></label>
                            </div>
                        </div>
                        <label class="label-title"><?php _e('Disable Thumbnails for the Gallery', 'arpg'); ?></label>
                        <select name="thumbnails" id="thumbnails" class="gallery-dir">
                            <?php if($gallery_awesome['thumb'] == 'false') { ?>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <option id="on_thumb" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div> <!--#accordion -->
			</div> <!--#awesome -->

			<div id="lightcs" class="gallery-input">
                <div id="lc-accordion" class="arpg-accordion">
                    <h3>General</h3>
                    <div class="accordion-input">
                    	<h4>Effect</h4>
                        <label class="label-title"><?php _e('Transition Effect Between Sequences', 'arpg'); ?></label>
                        <select name="lc_effect" id="lc_effect" class="gallery-dir"><?php
                            foreach($lc_transitions as $key => $effect) { ?>
                                <option value="<?php echo $key; ?>"<?php if($gallery_lightcs['lctrn'] == $key) { ?> selected<?php } ?>><?php echo $effect; ?></option><?php
                            } ?>
                        </select>
                    	<h4>Structure</h4>
                        <label class="label-title"><?php _e('Maximum Width for the Media Content', 'arpg'); ?></label>
                        <input type="number" name="lc_maxwidth" class="medium" id="lc_maxwidth" value="<?php echo $gallery_lightcs['lmaxw']; ?>" min="250" max="3000" placeholder="e.g. 800">
                        <label class="label-title"><?php _e('Maximum Height for the Media Content', 'arpg'); ?></label>
                        <input type="number" name="lc_maxheight" class="medium" id="lc_maxheight" value="<?php echo $gallery_lightcs['lmaxh']; ?>" min="250" max="3000" placeholder="e.g. 500">
					</div>
                    <h3>Show/Hide</h3>
                    <div class="accordion-input">
                        <label class="label-title"><?php _e('Show/Hide Title', 'arpg'); ?></label>
                        <select name="lc_title" id="lc_title" class="gallery-dir">
                            <?php if($gallery_lightcs['lcttl'] == 'false') { ?>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Show/Hide Caption', 'arpg'); ?></label>
                        <select name="lc_desc" id="lc_desc" class="gallery-dir">
                            <?php if($gallery_lightcs['lcdsc'] == 'false') { ?>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Show/Hide Sequence Info', 'arpg'); ?></label>
                        <select name="lc_seqinfo" id="lc_seqinfo" class="gallery-dir">
                            <?php if($gallery_lightcs['sinfo'] == 'false') { ?>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <h3>Video</h3>
                    <div class="accordion-input">
                    	<h4>iFrame</h4>
                        <label class="label-title"><?php _e('Enable iframe Element', 'arpg'); ?></label>
                        <select name="lc_iframe" id="lc_iframe" class="gallery-dir">
                            <?php if($gallery_lightcs['lcfrm'] == 'true') { ?>
                            <option id="iframe_on" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <div id="lcIframeElement">
                            <label class="label-title"><?php _e('Video Frame Width', 'arpg'); ?></label>
                            <input type="number" name="frame_width" class="medium" id="frame_width" value="<?php echo $gallery_lightcs['fwdth']; ?>" min="50" max="2000" placeholder="e.g. 800">
                            <label class="label-title"><?php _e('Video Frame Height', 'arpg'); ?></label>
                            <input type="number" name="frame_height" class="medium" id="frame_height" value="<?php echo $gallery_lightcs['fhigh']; ?>" min="50" max="2000" placeholder="e.g. 500">
                        </div>
                    	<h4>HTML5 Video</h4>
                        <label class="label-title"><?php _e('Enable HTML5 Video Options', 'arpg'); ?></label>
                        <select name="lc_voption" id="lc_voption" class="gallery-dir">
                            <?php if($gallery_lightcs['lvopt'] == 'false') { ?>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <option id="video_on" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <div id="lcVideoOption">
                            <label class="label-title"><?php _e('Video Width', 'arpg'); ?></label>
                            <input type="number" name="lc_vwidth" class="medium" id="lc_vwidth" value="<?php echo $gallery_lightcs['lvwdh']; ?>" min="100" max="3000" placeholder="e.g. 400">
                            <label class="label-title"><?php _e('Video Height', 'arpg'); ?></label>
                            <input type="number" name="lc_vheight" class="medium" id="lc_vheight" value="<?php echo $gallery_lightcs['lvhgt']; ?>" min="100" max="3000" placeholder="e.g. 225">
						</div>
                    </div>
				</div>
			</div> <!--#lightcase -->

			<div id="jgalery" class="gallery-input">
                <div id="jg-accordion" class="arpg-accordion">
                    <h3>General</h3>
                    <div class="accordion-input">
                        <label class="label-title"><?php _e('Transition Effect Between Images', 'arpg'); ?></label>
                        <select name="jg_transition" id="jg_transition" class="gallery-dir"><?php
                            foreach($jg_transitions as $transition) { ?>
                                <option value="<?php echo $transition; ?>"<?php if($gallery_jgalery['jgtrn'] == $transition) { ?> selected<?php } ?>><?php echo $transition; ?></option><?php
                            } ?>
                        </select>
                        <label class="label-title"><?php _e('Duration of Transition Between Photos', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('Value will be divided by 10. If you give 7 it will be 0.7', 'arpg'); ?>"></a></label>
                        <input type="number" name="tran_interval" class="medium" id="tran_interval" value="<?php echo $gallery_jgalery['trivl']; ?>" min="1" max="600" placeholder="e.g. 1">
                        <label class="label-title"><?php _e('Maximum Mobile Width', 'arpg'); ?></label>
                        <input type="number" name="max_mobile" class="medium" id="max_mobile" value="<?php echo $gallery_jgalery['maxmb']; ?>" min="250" max="767" placeholder="e.g. 767">
                    </div>
                    <h3>Show/Hide</h3>
                    <div class="accordion-input">
                    	<h4>Title</h4>
                        <label class="label-title"><?php _e('Show/Hide Image Title', 'arpg'); ?></label>
                        <select name="show_title" id="show_title" class="gallery-dir">
                            <?php if($gallery_jgalery['imttl'] == 'false') { ?>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option id="title_on" value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                    	<h4>Icon</h4>
                        <label class="label-title"><?php _e('Show/Hide Close Icon', 'arpg'); ?></label>
                        <select name="can_close" id="can_close" class="gallery-dir">
                            <?php if($gallery_jgalery['close'] == 'false') { ?>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <label class="label-title"><?php _e('Show/Hide Zoom Icon', 'arpg'); ?></label>
                        <select name="can_zoom" id="can_zoom" class="gallery-dir">
                            <?php if($gallery_jgalery['czoom'] == 'false') { ?>
                            <option value="true"><?php _e('Show', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Hide', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option id="zoom_on" value="true" selected><?php _e('Show', 'arpg'); ?></option>
                            <option value="false"><?php _e('Hide', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <h3>Thumbnials</h3>
                    <div class="accordion-input">
                        <label class="label-title"><?php _e('Display Thumbnail Toggle', 'arpg'); ?></label>
                        <select name="jg_thumbnail" id="jg_thumbnail" class="gallery-dir">
                            <?php if($gallery_jgalery['jthum'] == 'false') { ?>
                            <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                            <?php } else { ?>
                            <option id="thumb_on" value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                            <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                            <?php } ?>
                        </select>
                        <div id="jgalleryThumbnails">
                    		<h4>Position</h4>
                            <label class="label-title"><?php _e('Thumbnails Position', 'arpg'); ?></label>
                            <select name="thumb_position" id="thumb_position" class="gallery-dir"><?php
                                foreach($thumb_positions as $key => $position) { ?>
                                    <option value="<?php echo $key; ?>"<?php if($gallery_jgalery['thpos'] == $key) { ?> selected<?php } ?>><?php echo $position; ?></option><?php
                                } ?>
                            </select>
                    		<h4>Mobile</h4>
                            <label class="label-title"><?php _e('Hide Thumbnail on Mobile', 'arpg'); ?><a href="#" class="arpg_tooltip" rel="<?php _e('If set as \'true\', thumbnails will be hidden when width of window <= \'maxMobileWidth\' parameter (default value - 767px).', 'arpg'); ?>"></a></label>
                            <select name="mobile_thumb" id="mobile_thumb" class="gallery-dir">
                                <?php if($gallery_jgalery['mobth'] == 'false') { ?>
                                <option value="true"><?php _e('Enable', 'arpg'); ?></option>
                                <option value="false" selected><?php _e('Disable', 'arpg'); ?></option>
                                <?php } else { ?>
                                <option value="true" selected><?php _e('Enable', 'arpg'); ?></option>
                                <option value="false"><?php _e('Disable', 'arpg'); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div> <!--#accordion -->
			</div> <!--#jgallery -->
		</div> <!--#tabs -->
	</div> <!--#settinggallerydiv -->
	<div class="arpg-clear"></div>
	<input type="hidden" name="awesome_gallery" value="<?php echo $awesome_gallery; ?>"><?php
	if(isset($gallery_options) && $gallery_options != '') { ?>
		<input type="submit" id="arpg_process" name="arpg_process" class="button-primary" value="<?php _e('Update Gallery Options', 'arpg'); ?>"><?php
	} else { ?>
		<input type="submit" id="arpg_process" name="arpg_process" class="button-primary" value="<?php _e('Add Gallery Options', 'arpg'); ?>"><?php
	}
	die;
}
add_action( 'wp_ajax_nopriv_arpg_process_gallery_option', 'arpg_process_gallery_option' );
add_action( 'wp_ajax_arpg_process_gallery_option', 'arpg_process_gallery_option' );

if(isset($_POST['arpg_edit_process']) && $_POST['arpg_edit_process'] == "editprocess") {
	if( isset( $_POST['arpg_process'] ) ) { arpg_set_gallery_options(); }
}
?>