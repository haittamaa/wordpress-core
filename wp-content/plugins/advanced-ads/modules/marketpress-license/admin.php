<?php

/**
 * Module Name:     MarketPress License
 * Description:		Advanced Ads - License Management by MarketPress GmbH - admin.php
 * Author:          MarketPress
 * Version:         1.0
 * License:         GPLv3
 * Author URI:      https://marketpress.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( class_exists( 'Advanced_Ads', false ) ) {

	add_action( 'admin_init', 'marketpress_advanced_ads_license_settings_field', 20 );
	
	/**
	 * Add settings section
	 *
	 * @wp-hook admin_init
	 * @return void
	 */
	function marketpress_advanced_ads_license_settings_field() {

		$add_ons = apply_filters( 'advanced-ads-add-ons', array() );

		if ( count( $add_ons ) >= 1 ) {

			register_setting( 'marketpress-advanced-ads', 'marketpress-advanced-ads' );
			register_setting( 'marketpress-advanced-ads-license', 'marketpress-advanced-ads-license' );

			add_settings_field(
				'marketpress-license', __( 'MarketPress Bundle License', 'advanced-ads' ), 'render_settings_marketpress_license_callback', 'advanced-ads-settings-license-page', 'advanced_ads_settings_license_section'
			);

		}

	}

	/**
	 * Render MarketPress License settings field
	 *
	 * @add_settings_field
	 * @return void
	 */
	function render_settings_marketpress_license_callback() {

		?><style>
		    div#licenses table tr:first-of-type td span.advads-license-activate-error a { display: none; }
		</style>
		<?php
		$licenses = get_option( ADVADS_SLUG . '-licenses', array() );
		$license_key = isset( $licenses[ 'marketpress-advanced-ads' ] ) ? $licenses[ 'marketpress-advanced-ads' ] : '';
		$license_status = get_option( 'marketpress-advanced-ads-license-status', false );

		$index = 'marketpress-advanced-ads';
		$plugin_name = 'MarketPress Advanced Ads';
		$options_slug = 'marketpress-advanced-ads';
		$plugin_url = 'https://marketpress.com/shop/plugins/advanced-ads';

		// template in main plugin
		include ADVADS_BASE_PATH . 'admin/views/setting-license.php';

		?><p class="description"><?php echo __( 'Enter your key here, if you have purchased the bundle through MarketPress.', 'advanced-ads' ); ?></p><?php
		if( $license_key === '' ) :
		?></td>
		<p class="description"><?php echo __( 'Enter your key here, if you have purchased the bundle through MarketPress.', 'advanced-ads' ); ?></p>
		<td>
		<a class="advads-licenses-marketpress-show" href="javascript:void(0)"><?php echo __( 'Click here if you purchased a Bundle key through <strong>MarketPress</strong>.', 'advanced-ads' ); ?></a>
		<script>jQuery('.advads-licenses-marketpress-show').parents('td').prev('td').hide().prev('th').css('text-indent', '-9999px'); jQuery('.advads-licenses-marketpress-show').click(function(){ jQuery(this).parents('td').hide().prev('td').show().prev('th').css('text-indent', '0').show(); });</script>
		<?php endif;

	}

}
