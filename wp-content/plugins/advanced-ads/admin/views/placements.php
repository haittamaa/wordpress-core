<?php
/**
 * the view for the placements page
 */
?><div class="wrap">
<?php if ( isset($_GET['message'] ) ) :
	if ( $_GET['message'] === 'error' ) :
	?><div id="message" class="error"><p><?php _e( 'Couldn’t create the new placement. Please check your form field and whether the name is already in use.', 'advanced-ads' ); ?></p></div><?php
	elseif ( $_GET['message'] === 'updated' ) :
	?><div id="message" class="updated"><p><?php _e( 'Placements updated', 'advanced-ads' ); ?></p></div><?php
	endif; ?>
<?php endif; ?>
    <?php screen_icon(); ?>
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <p class="description"><?php _e( 'Placements are physically places in your theme and posts. You can use them if you plan to change ads and ad groups on the same place without the need to change your templates.', 'advanced-ads' ); ?></p>
    <p class="description"><?php printf( __( 'See also the manual for more information on <a href="%s">placements</a>.', 'advanced-ads' ), ADVADS_URL . 'manual/placements/#utm_source=advanced-ads&utm_medium=link&utm_campaign=placements' ); ?></p>
<?php if ( isset($placements) && is_array( $placements ) && count( $placements ) ) :
	do_action( 'advanced-ads-placements-list-before', $placements ); ?>
        <h2><?php _e( 'Placements', 'advanced-ads' ); ?></h2>
        <form method="POST" action="">
            <table class="widefat advads-placements-table striped">
                <thead>
                    <tr>
                        <th><?php _e( 'Type', 'advanced-ads' ); ?></th>
                        <th><?php _e( 'Name', 'advanced-ads' ); ?></th>
                        <th><?php _e( 'Options', 'advanced-ads' ); ?></th>
                        <?php do_action( 'advanced-ads-placements-list-column-header' ); ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
    <?php // order by slug
    ksort( $placements );
    foreach ( $placements as $_placement_slug => $_placement ) :
			$type_missing = false;
			if( isset( $_placement['type'] ) && ! isset( $placement_types[$_placement['type']] )) {
				$missed_type = $_placement['type'];
				$_placement['type'] = 'default';
				$type_missing = true;
			}
		?><tr id="single-placement-<?php echo $_placement_slug; ?>">
                            <td><?php
				if( $type_missing ) :  // type is not given
				    ?><p class="advads-error-message"><?php printf(__( 'Placement type "%s" is missing and was reset to "default".<br/>Please check if the responsible add-on is activated.', 'advanced-ads' ), $missed_type ); ?></p><?php
				elseif( isset($_placement['type'] )) :
				    if( isset( $placement_types[$_placement['type']]['image'] )) :
					    ?><img src="<?php echo $placement_types[$_placement['type']]['image'];
					    ?>" title="<?php echo $placement_types[$_placement['type']]['title']; 
					    ?>" alt="<?php echo $placement_types[$_placement['type']]['title']; ?>"/><?php
				    else :
					echo $placement_types[$_placement['type']]['title'];
				    endif;
				else :
				    __( 'default', 'advanced-ads' );
				endif;
				?></td>
                            <td><?php echo $_placement['name']; ?><br/>
				<?php if( ! isset( $_placement['type'] ) || 'default' === $_placement['type']) :
				    $_placement['type'] = 'default';
				    ?><a class="usage-link"><?php _e( 'show usage', 'advanced-ads' ); ?></a><div class="hidden advads-usage">
				    <label><?php _e( 'shortcode', 'advanced-ads' ); ?>
					<code><input type="text" onclick="this.select();" value='[the_ad_placement id="<?php echo $_placement_slug; ?>"]'/></code>
				    </label>
				    <label><?php _e( 'template', 'advanced-ads' ); ?>
					<code><input type="text" onclick="this.select();" value="the_ad_placement('<?php echo $_placement_slug; ?>');"/></code>
				    </label>
				</div><?php
				 endif;
			    ?></td>
                            <td class="advads-placements-table-options">
                                <?php do_action( 'advanced-ads-placement-options-before', $_placement_slug, $_placement ); ?>
                                <label for="adsads-placements-item-<?php echo $_placement_slug; ?>"><?php _e( 'Item', 'advanced-ads' ); ?></label>
                                <select id="adsads-placements-item-<?php echo $_placement_slug; ?>" name="advads[placements][<?php echo $_placement_slug; ?>][item]">
                                    <option value=""><?php _e( '--not selected--', 'advanced-ads' ); ?></option>
                                        <?php if ( isset($items['groups']) ) : ?>
                                        <optgroup label="<?php _e( 'Ad Groups', 'advanced-ads' ); ?>">
                                            <?php foreach ( $items['groups'] as $_item_id => $_item_title ) : ?>
                                                <option value="<?php echo $_item_id; ?>" <?php if ( isset($_placement['item']) ) { selected( $_item_id, $_placement['item'] ); } ?>><?php echo $_item_title; ?></option>
                                        <?php endforeach; ?>
                                        </optgroup>
                                        <?php endif; ?>
                                        <?php if ( isset($items['ads']) ) : ?>
                                        <optgroup label="<?php _e( 'Ads', 'advanced-ads' ); ?>">
                                        <?php foreach ( $items['ads'] as $_item_id => $_item_title ) : ?>
                                                <option value="<?php echo $_item_id; ?>" <?php if ( isset($_placement['item']) ) { selected( $_item_id, $_placement['item'] ); } ?>><?php echo $_item_title; ?></option>
                                        <?php endforeach; ?>
                                        </optgroup>
                                        <?php endif; ?>
                                </select><br/>
                                <?php
								switch ( $_placement['type'] ) :
									case 'post_content' :
										?><div class="advads-placement-options"><?php
										_e( 'Inject', 'advanced-ads' );
										$_positions = array('after' => __( 'after', 'advanced-ads' ), 'before' => __( 'before', 'advanced-ads' )); ?>
                                        <select name="advads[placements][<?php echo $_placement_slug; ?>][options][position]">
                                            <?php foreach ( $_positions as $_pos_key => $_pos ) : ?>
                                            <option value="<?php echo $_pos_key; ?>" <?php if ( isset($_placement['options']['position']) ) { selected( $_placement['options']['position'], $_pos_key ); } ?>><?php echo $_pos; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="number" name="advads[placements][<?php echo $_placement_slug; ?>][options][index]" value="<?php
										echo (isset($_placement['options']['index'])) ? $_placement['options']['index'] : 1;
										?>"/>.

                                        <?php $tags = Advanced_Ads_Placements::tags_for_content_injection(); ?>
                                        <select name="advads[placements][<?php echo $_placement_slug; ?>][options][tag]">
                                            <?php foreach ( $tags as $_tag_key => $_tag ) : ?>
                                            <option value="<?php echo $_tag_key; ?>" <?php if ( isset($_placement['options']['tag']) ) { selected( $_placement['options']['tag'], $_tag_key ); } ?>><?php echo $_tag; ?></option>
                                            <?php endforeach; ?>
                                        </select>

					<p><label><input type="checkbox" name="advads[placements][<?php echo $_placement_slug; ?>][options][start_from_bottom]" value="1" <?php
					if (isset($_placement['options']['start_from_bottom'])) { checked( $_placement['options']['start_from_bottom'], 1); }
					?>/><?php _e( 'start counting from bottom', 'advanced-ads' ); ?></label></p>
                                        </div>
					<?php if( ! function_exists( 'mb_convert_encoding' ) ) : ?>
					<p><span class="advads-error-message"><?php _e( 'Important Notice', 'advanced-ads' ); ?>: </span><?php _e( 'Your server is missing an extension. This might break the content injection.<br/>Ignore this warning if everything works fine or else ask your hosting provider to enable <em>mbstring</em>.', 'advanced-ads' ); ?></p>
					   <?php endif;
										break;
								endswitch;
								do_action( 'advanced-ads-placement-options-after', $_placement_slug, $_placement );
			    ob_start();
				do_action( 'advanced-ads-placement-options-after-advanced', $_placement_slug, $_placement );
			    $advanced_options = ob_get_clean();
			    if( $advanced_options ) :
				?><a class="advads-toggle-link" onclick="advads_toggle('.advads-placements-advanced-options-<?php
				echo $_placement_slug; ?>')">- <?php _e( 'advanced options', 'advanced-ads' ); ?> –</a>
				<div class="advads-placements-advanced-options-<?php echo $_placement_slug; ?>" style="display: none"><?php
				    echo $advanced_options;
				?></div><?php
			    endif;
                            ?></td>
                            <?php do_action( 'advanced-ads-placements-list-column', $_placement_slug, $_placement ); ?>
                            <td>
                                <input type="checkbox" id="adsads-placements-item-delete-<?php echo $_placement_slug; ?>" name="advads[placements][<?php echo $_placement_slug; ?>][delete]" value="1"/>
                                <label for="adsads-placements-item-delete-<?php echo $_placement_slug; ?>"><?php _ex( 'delete', 'checkbox to remove placement', 'advanced-ads' ); ?></label>
                            </td>
                        </tr>
    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="submit" id="advads-save-placements-button" class="button button-primary" value="<?php _e( 'Save Placements', 'advanced-ads' ); ?>"/>
	    <?php wp_nonce_field( 'advads-placement', 'advads_placement', true ) ?>
	    <button type="button" title="<?php _e( 'Create a new placement', 'advanced-ads' ); ?>" class="button-secondary" onclick="advads_toggle('.advads-placements-new-form')"><?php
	    _e( 'New Placement', 'advanced-ads' ); ?></button>
	    <?php do_action( 'advanced-ads-placements-list-buttons', $placements ); ?>
        </form>
	<?php do_action( 'advanced-ads-placements-list-after', $placements );
endif;

    ?><form method="POST" action="" onsubmit="return advads_validate_placement_form();" class="advads-placements-new-form"<?php if ( isset($placements) && count( $placements ) ) echo ' style="display: none;"' ; ?>>
	<h3>1. <?php _e( 'Choose a placement type', 'advanced-ads' ); ?></h3>
	<p class="description"><?php printf(__( 'Placement types define where the ad is going to be displayed. Learn more about the different types from the <a href="%s">manual</a>', 'advanced-ads' ), ADVADS_URL . 'manual/placements/#utm_source=advanced-ads&utm_medium=link&utm_campaign=placements' ); ?></p>
	<div class= "advads-new-placement-types advads-buttonset">
	<?php
	if ( is_array( $placement_types ) ) {
		foreach ( $placement_types as $_key => $_place ) :
		    if( isset( $_place['image'] )) :
			    $image = '<img src="' . $_place['image'] . '" alt="' . $_place['title'] . '"/>';
		    else :
			    $image = '<strong>' . $_place['title'] . '</strong><br/><p class="description">' . $_place['description'] . '</p>';
		    endif;
		    ?><div class="advads-placement-type"><label for="advads-placement-type-<?php echo $_key; ?>"><?php echo $image; ?></label>
			<input type="radio" id="advads-placement-type-<?php echo $_key; ?>" name="advads[placement][type]" value="<?php echo $_key; ?>"/>
			<p class="advads-placement-description"><strong><?php echo $_place['title'] ?></strong><br/><?php echo $_place['description']; ?></p>
		    </div><?php
		endforeach; };
		?></div>
	<div class="clear"></div>
	<p class="advads-error-message advads-placement-type-error"><?php _e( 'Please select a placement type.', 'advanced-ads' ); ?></p>
	<br/>
	<h3>2. <?php _e( 'Choose a Name', 'advanced-ads' ); ?></h3>
	<p class="description"><?php _e( 'The name of the placement is only visible to you. Tip: choose a descriptive one, e.g. <em>Below Post Headline</em>.', 'advanced-ads' ); ?></p>
        <p><input name="advads[placement][name]" class="advads-new-placement-name" type="text" value="" placeholder="<?php _e( 'Placement Name', 'advanced-ads' ); ?>"/></p>
	<p class="advads-error-message advads-placement-name-error"><?php _e( 'Please enter a name for your placement.', 'advanced-ads' ); ?></p>
	<h3>3. <?php _e( 'Choose the Ad or Group', 'advanced-ads' ); ?></h3>
	<p class="description"><?php _e( 'The ad or group that should be displayed.', 'advanced-ads' ); ?></p>
	<p><select name="advads[placement][item]">
	    <option value=""><?php _e( '--not selected--', 'advanced-ads' ); ?></option>
		<?php if ( isset($items['groups']) ) : ?>
		<optgroup label="<?php _e( 'Ad Groups', 'advanced-ads' ); ?>">
		    <?php foreach ( $items['groups'] as $_item_id => $_item_title ) : ?>
			<option value="<?php echo $_item_id; ?>"><?php echo $_item_title; ?></option>
		<?php endforeach; ?>
		</optgroup>
		<?php endif; ?>
		<?php if ( isset($items['ads']) ) : ?>
		<optgroup label="<?php _e( 'Ads', 'advanced-ads' ); ?>">
		<?php foreach ( $items['ads'] as $_item_id => $_item_title ) : ?>
			<option value="<?php echo $_item_id; ?>"><?php echo $_item_title; ?></option>
		<?php endforeach; ?>
		</optgroup>
		<?php endif; ?>
	    </select></p>
	<?php wp_nonce_field( 'advads-placement', 'advads_placement', true ) ?>
        <input type="submit" class="button button-primary" value="<?php _e( 'Save New Placement', 'advanced-ads' ); ?>"/>
    </form>
</div>
