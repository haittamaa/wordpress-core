<?php
/**
 * Module Name:     MarketPress License
 * Description:		Advanced Ads - License Management by MarketPress GmbH - main.php
 * Author:          MarketPress
 * Version:         1.0
 * License:         GPLv3
 * Author URI:      https://marketpress.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( class_exists( 'Advanced_Ads', false ) ) {

	add_action( 'init', 'marketpress_advanced_ads_init' );

	/**
	 * Init module
	 *
	 * @wp-hook init
	 * @return void
	 */
	function marketpress_advanced_ads_init() {

		// Actions and Filters

		// Activate, deactivate MarketPress Bundle License
		add_filter( 'advanced_ads_license_marketpress-advanced-ads', 'marketpress_advanced_license_manager', 10, 5 );

	}

	/**
	 * License Management for MarketPress bundle
	 *
	 * @wp-hook advanced_ads_license_marketpress-advanced-ads
	 *
	 * @param Mixed $return_value
	 * @param String $method_name
	 * @param String $plugin_name
	 * @param String $options_slug
	 * @param String $license_key
	 *
	 * @return Mixed
	 */
	function marketpress_advanced_license_manager ( $return_value, $method_name, $plugin_name, $options_slug, $license_key ) {

		// Remove class from method name
		$method_name = str_replace( 'Advanced_Ads_Admin_Licenses::', '', $method_name );

		switch ( $method_name ) {

			case 'activate_license':

				// Licence Management by MarketPress for 

				$url_key_check = 'http://marketpress.com/mp-key/' . $license_key . '/advanced-ads/' . sanitize_title_with_dashes( network_site_url() );
				$remote = wp_remote_get( $url_key_check);
				$response = json_decode( wp_remote_retrieve_body( $remote ) );

				// If the remote is not reachable or any other errors occured
				// Same check as Advanced Ads does
				if ( is_wp_error( $remote ) ) {
					return __( 'License couldn’t be activated. Please try again later.', 'advanced-ads' );
				}

				// Status is true
				if ( $response->status == 'true' ) {

					// New request to get expires date
					$url_version_check = 'http://marketpress.com/mp-version/' . $license_key . '/advanced-ads/' . sanitize_title_with_dashes( network_site_url() );

					$remote_version = wp_remote_get( $url_version_check );

					if ( is_wp_error( $remote_version ) ) {
						return __( 'License couldn’t be activated. Please try again later.', 'advanced-ads' );
					}
					
					// Resonse status is always true, because it was before true
					$response_version = json_decode( wp_remote_retrieve_body( $remote_version ) );
					
					// Expires date
					$expires_date = $response_version->access_expires;

					// Update options
					update_option( 'marketpress-advanced-ads-license-status', 'valid', false );
					update_option( 'marketpress-advanced-ads-license-expires', $expires_date , false );

					// Get licenses
					if ( is_multisite() ) {
					    global $current_site;
					    $licenses = get_blog_option( $current_site->blog_id, ADVADS_SLUG . '-licenses', array() );
					    
				    } else {
					    $licenses = get_option( ADVADS_SLUG . '-licenses', array() );
				    }
					
					// Save license
					$licenses[ 'marketpress-advanced-ads' ] = $license_key;

				    // Now activate every module!
				    $add_ons = apply_filters( 'advanced-ads-add-ons', array() );
				   	
				   	foreach ( $add_ons as $key => $add_on ) {
				   		
				   		update_option( $add_on[ 'options_slug' ] . '-license-status', 'valid', false );
						update_option( $add_on[ 'options_slug' ] . '-license-expires', $expires_date , false );
						$licenses[ $key ] = $license_key;
				   	}

				    // Save licenses
				    if ( is_multisite() ) {
					    update_blog_option( $current_site->blog_id, ADVADS_SLUG . '-licenses', $licenses );
				    } else {
					    update_option( ADVADS_SLUG . '-licenses', $licenses );
				    }

				    Advanced_Ads_Admin_Notices::get_instance()->remove_from_queue( 'license_expires' );
				    Advanced_Ads_Admin_Notices::get_instance()->remove_from_queue( 'license_expired' );
				    Advanced_Ads_Admin_Notices::get_instance()->remove_from_queue( 'license_invalid' );

					return 1;

				} else {

					update_option( 'marketpress-advanced-ads-license-status', 'invalid', false );

					if ( $response->status == 'urllimit' ) {
						return __( 'There are no activations left.', 'advanced-ads' );
					} else {
						return __( 'This is not the correct key for this add-on.', 'advanced-ads' );
					}

				}

				break;

			case 'deactivate_license':

				delete_option( 'marketpress-advanced-ads-license-status' );
		   		delete_option( 'marketpress-advanced-ads-license-expires' );
		   		Advanced_Ads_Admin_Notices::get_instance()->remove_from_queue( 'license_expires' );
		    	
		    	// Get licenses
				if ( is_multisite() ) {
				    global $current_site;
				    $licenses = get_blog_option( $current_site->blog_id, ADVADS_SLUG . '-licenses', array() );
				    
			    } else {
				    $licenses = get_option( ADVADS_SLUG . '-licenses', array() );
			    }

			    $marketpress_key = $licenses[ 'marketpress-advanced-ads' ];

		    	// Now deactivate every module!
		    	$add_ons = apply_filters( 'advanced-ads-add-ons', array() );
				   	
				foreach ( $add_ons as $key => $add_on ) {

			   		if ( $licenses[ $key] == $marketpress_key ) {
			   			delete_option( $add_on[ 'options_slug' ] . '-license-status' );
	   					delete_option( $add_on[ 'options_slug' ] . '-license-expires' );
	   					Advanced_Ads_Admin_Notices::get_instance()->remove_from_queue( 'license_expires' );
			   		}

				}

				return 1;
				break;

		}

	}

}
