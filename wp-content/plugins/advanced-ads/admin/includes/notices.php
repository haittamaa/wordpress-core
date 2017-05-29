<?php
/**
 * array with admin notices
 */
$advanced_ads_admin_notices = apply_filters( 'advanced-ads-notices', array(
    // email tutorial
    'nl_intro' => array(
	'type' => 'info',
	'text' => sprintf(__( 'Advanced Ads successfully installed. Take a look at the <a href="%s">First Steps</a>.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-intro' )),
	'global' => true
    ),
    // email tutorial
    'nl_first_steps' => array(
	'type' => 'subscribe',
	'text' => __( 'Thank you for activating <strong>Advanced Ads</strong>. Would you like to receive the first steps via email?', 'advanced-ads' ),
	'confirm_text' => __( 'Yes, send it', 'advanced-ads' ),
	'global' => true
    ),
    // free add-ons
    'nl_free_addons' => array(
	'type' => 'subscribe',
	'text' => __( 'Thank you for using <strong>Advanced Ads</strong>. Stay informed and receive <strong>2 free add-ons</strong> for joining the newsletter.', 'advanced-ads' ),
	'confirm_text' => __( 'Add me now', 'advanced-ads' ),
	'global' => true
    ),
    // adsense newsletter group
    'nl_adsense' => array(
	'type' => 'subscribe',
	'text' => __( 'Learn more about how and <strong>how much you can earn with AdSense</strong> and Advanced Ads from my dedicated newsletter.', 'advanced-ads' ),
	'confirm_text' => __( 'Subscribe me now', 'advanced-ads' ),
	'global' => true
    ),
    // if users updated from a previous version to 1.7
    '1.7' => array(
	'type' => 'update',
	'text' => 'Advanced Ads 1.7 made changes to the Display Conditions interface. Please check your settings and the <a href="https://wpadvancedads.com/manual/display-conditions/" target="_blank">manual</a>, if you are using them.',
    ),
    // missing license codes
    'license_invalid' => array(
	'type' => 'plugin_error',
	'text' => __( 'One or more license keys for <strong>Advanced Ads add-ons are invalid or missing</strong>.', 'advanced-ads' ) . ' ' . sprintf( __( 'Please add valid license keys <a href="%s">here</a>.', 'advanced-ads' ), get_admin_url( 1, 'admin.php?page=advanced-ads-settings#top#licenses' ) ),
	'global' => true
    ),
    // license expires
    'license_expires' => array(
	'type' => 'plugin_error',
	'text' => sprintf( __( 'One or more licenses for your <strong>Advanced Ads add-ons are expiring soon</strong>. Don’t risk to lose support and updates and renew your license before it expires with a significant discount on <a href="%s" target="_blank">the add-on page</a>.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#licenses' ) ),
	'global' => true
    ),
    // license expired
    'license_expired' => array(
	'type' => 'plugin_error',
	'text' => sprintf( __( '<strong>Advanced Ads</strong> license(s) expired. Support and updates are disabled. Please visit <a href="%s"> the license page</a> for more information.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#licenses' ) ),
	'global' => true
    ),
    // please review
    'review' => array(
	'type' => 'info',
	'text' => sprintf( __( '<img src="%3$s" alt="Thomas" width="80" height="115" class="advads-review-image"/>You are using <strong>Advanced Ads</strong> for some time now. Thank you! If you need my help then please visit the <a href="%1$s" target="_blank">Support page</a> to get free help.</p><h3>Thanks for your Review</h3><p>If you share my passion and find Advanced Ads useful then please <a href="%2$s" target="_blank">leave a 5-star review on wordpress.org</a>.</p><p><em>Thomas</em>', 'advanced-ads' ), ADVADS_URL . 'support/#utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-review', 'https://wordpress.org/support/view/plugin-reviews/advanced-ads#postform', ADVADS_BASE_URL . 'admin/assets/img/thomas.png' ),
	'global' => false
    ),
    // adblocker assets expired
    'assets_expired' => array(
	'type' => 'update',
	'text' => sprintf( __('Some assets were changed. Please <strong>rebuild the asset folder</strong> in the <a href="%s">Advanced Ads settings</a> to update the ad blocker disguise.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings' ) ),
	'global' => true
    ),

));

