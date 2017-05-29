<?php if ( $is_main_site ): ?>
<input id="advanced-ads-use-adblocker" type="checkbox" value="1" name="<?php echo ADVADS_SLUG; ?>[use-adblocker]" <?php checked( $checked, 1, true ); ?>>
<?php else: ?>
<?php _e( 'The ad block disguise can only be set by the super admin on the main site in the network.', 'advanced-ads' ); ?>
<?php endif ?>
<p class="description"><?php _e( 'Prevents ad block software from breaking your website when blocking asset files (.js, .css).', 'advanced-ads' ); ?></p>