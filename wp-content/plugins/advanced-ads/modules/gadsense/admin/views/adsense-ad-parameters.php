<?php
if ( ! defined( 'WPINC' ) ) {
	die();
}
$is_responsive = ('responsive' == $unit_type) ? true : false;
$is_link_responsive_unit = ('link-responsive' == $unit_type) ? true : false;
$is_matched_content = ('matched-content' == $unit_type) ? true : false;
$use_manual_css = ('manual' == $unit_resize) ? true : false;
if ( $is_responsive || $is_link_responsive_unit || $is_matched_content ) {
    echo '<style type="text/css"> #advanced-ads-ad-parameters-size {display: none;}	</style>';
}

$use_paste_code = true;
$use_paste_code = apply_filters( 'advanced-ads-gadsense-use-pastecode', $use_paste_code );

$db = Advanced_Ads_AdSense_Data::get_instance();
$sizing_array = $db->get_responsive_sizing();

?>
<input type="hidden" id="advads-ad-content-adsense" name="advanced_ad[content]" value="<?php echo esc_attr( $json_content ); ?>" />
<input type="hidden" name="unit_id" id="unit_id" value="<?php echo esc_attr( $unit_id ); ?>" />
<?php
if ( $use_paste_code ) {
    echo '<a class="button" href="#" id="show-pastecode-div">' . __( 'Copy&Paste existing ad code', 'advanced-ads' ) . '</a>';
}
?>
<p id="adsense-ad-param-error"></p>
<?php ob_start(); ?>
<label class="label"><?php _e( 'Ad Slot ID', 'advanced-ads' ); ?></label>
<div>
    <input type="text" name="unit-code" id="unit-code" value="<?php echo $unit_code; ?>" />
    <input type="hidden" name="advanced_ad[output][adsense-pub-id]" id="advads-adsense-pub-id" value="" />
    <?php if( $pub_id ) : ?>
	<?php printf(__( 'Publisher ID: %s', 'advanced-ads' ), $pub_id ); ?>
    <?php endif; ?>
</div>
<hr/>
<?php
$unit_code_markup = ob_get_clean();
echo apply_filters( 'advanced-ads-gadsense-unit-code-markup', $unit_code_markup, $unit_code );
if( $pub_id_errors ) : ?>
	    <p>
	<span class="advads-error-message">
	    <?php echo $pub_id_errors; ?>
	</span>
	<?php printf(__( 'Please <a href="%s" target="_blank">change it here</a>.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#adsense' )); ?>
    </p>
<?php endif; ?>
    <label class="label" id="unit-type-block"><?php _e( 'Type', 'advanced-ads' ); ?></label>
    <div>
	<select name="unit-type" id="unit-type">
	    <option value="normal" <?php selected( $unit_type, 'normal' ); ?>><?php _e( 'Normal', 'advanced-ads' ); ?></option>
	    <option value="responsive" <?php selected( $unit_type, 'responsive' ); ?>><?php _e( 'Responsive', 'advanced-ads' ); ?></option>
	    <option value="matched-content" <?php selected( $unit_type, 'matched-content' ); ?>><?php _e( 'Responsive (Matched Content)', 'advanced-ads' ); ?></option>
	    <option value="link" <?php selected( $unit_type, 'link' ); ?>><?php _e( 'Link ads', 'advanced-ads' ); ?></option>
	    <option value="link-responsive" <?php selected( $unit_type, 'link-responsive' ); ?>><?php _e( 'Link ads (Responsive)', 'advanced-ads' ); ?></option>
	</select>
	<a href="<?php echo ADVADS_URL . 'manual/adsense-ads/#adsense-ad-types'; ?>" target="_blank"><?php _e( 'manual', 'advanced-ads' ); ?></a>
    </div>
    <hr/>
<?php if ( ! defined( 'AAR_SLUG' ) ) : ?>
    <p><?php printf( __( 'Use the <a href="%s" target="_blank">Responsive add-on</a> in order to define the exact size for each browser width or choose between horizontal, vertical, or rectangle formats.', 'advanced-ads' ), ADVADS_URL . 'add-ons/responsive-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=edit-adsense' ); ?></p>
<?php else : ?>
<?php endif; ?>
    <label class="label" <?php if ( ! $is_responsive || 2 > count( $sizing_array ) ) { echo 'style="display: none;"'; } ?> id="resize-label"><?php _e( 'Resizing', 'advanced-ads' ); ?></label>
    <div <?php if ( ! $is_responsive || 2 > count( $sizing_array ) ) { echo 'style="display: none;"'; } ?>>
	<select name="ad-resize-type" id="ad-resize-type">
	<?php foreach ( $sizing_array as $key => $desc ) : ?>
	    <option value="<?php echo $key; ?>" <?php selected( $key, $unit_resize ); ?>><?php echo $desc; ?></option>
	<?php endforeach; ?>
	</select>
    </div>
    <hr/>
    <?php do_action( 'advanced-ads-gadsense-extra-ad-param', $extra_params, $content ); ?>
<?php if ( $use_paste_code ) : ?>
<div id="pastecode-div" style="display: none;">
	<div id="pastecode-container">
		<h3><?php _e( 'Copy the ad code from your AdSense account and paste it in the area below', 'advanced-ads' ); ?></h3>
		<hr />
		<textarea rows="15" cols="55" id="pastecode-content"></textarea><hr />
		<button class="button button-primary" id="submit-pastecode"><?php _e( 'Get details', 'advanced-ads' ); ?></button>&nbsp;&nbsp;
		<button class="button button-secondary" id="hide-pastecode-div"><?php _e( 'Close', 'advanced-ads' ); ?></button>
		<div id="pastecode-msg"></div>
	</div>
</div><!-- #pastecode-div -->
<?php endif;
