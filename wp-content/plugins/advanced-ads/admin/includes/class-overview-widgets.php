<?php
/**
 * container class for callbacks for overview widgets
 *
 * @package WordPress
 * @subpackage Advanced Ads Plugin
 * @since 1.4.3
 */
class Advanced_Ads_Overview_Widgets_Callbacks {

	 /**
	 * set the overview page to one column layout so widgets can get ordered horizontally
	 *
	 * @since 1.4.3
	 * @param arr $columns columns array
	 * @return int $columns
	 */
	static function one_column_overview_page( $columns ) {
		// $columns['toplevel_page_advanced-ads'] = 1;
		return $columns;
	}

	/**
	 * set the overview page to one column layout so widgets can get ordered horizontally
	 *  this overwrites user settings
	 *
	 * @since 1.4.3
	 * @return int $columns
	 */
	function one_column_overview_page_user() {
		// return 1;
	}

	/**
	 * register the plugin overview widgets
	 *
	 * @since 1.4.3
	 * @param obj $screen
	 */
	public static function setup_overview_widgets($screen){

		// abort if not on the overview page
		if ( ! isset($screen->id) || $screen->id !== 'toplevel_page_advanced-ads' ) { return; }

		add_meta_box('advads_overview_news', __( 'Tips and Tutorials', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_subscribe'), $screen->id, 'normal', 'high');
		add_meta_box('advads_overview_addon_help', __( 'Setup and Optimization Help', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_help'), $screen->id, 'normal', 'high');
		add_meta_box('advads_overview_support', __( 'Manual and Support', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_support'), $screen->id, 'normal', 'high');

		// add widgets for pro add ons
		add_meta_box('advads_overview_addon_pro', __( 'Advanced Ads Pro', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_pro'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_tracking', __( 'Tracking and Stats', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_tracking'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_responsive', __( 'Responsive and Mobile ads', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_responsive'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_geotargeting', __( 'Geo Targeting', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_geotargeting'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_sticky', __( 'Sticky ads', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_sticky'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_layer', __( 'PopUps and Layers', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_layer'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_slider', __( 'Ad Slider', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_slider'), $screen->id, 'side', 'high');
		add_meta_box('advads_overview_addon_sellingads', __( 'Selling Ads', 'advanced-ads' ),
		array('Advanced_Ads_Overview_Widgets_Callbacks', 'render_add_on_sellingads'), $screen->id, 'side', 'high');
		
		do_action( 'advanced-ads-overview-widgets-after', $screen );
	}

	/**
	 * subscribe widget
	 *
	 * @since 1.5.4
	 */
	public static function render_subscribe(){

		$is_subscribed = Advanced_Ads_Admin_Notices::get_instance()->is_subscribed();
		$options = Advanced_Ads_Admin_Notices::get_instance()->options();

		$_notice = 'nl_free_addons';
		if ( ! isset($options['closed'][ $_notice ] ) && ! $is_subscribed ) {
			?><div class="advads-admin-notice">
			    <p><?php _e( 'Get 2 <strong>free add-ons</strong> for joining the newsletter.', 'advanced-ads' ); ?></p>
			    <button type="button" class="button-primary advads-notices-button-subscribe" data-notice="<?php echo $_notice ?>"><?php _e('Join now', 'advanced-ads'); ?></button>
			</div><?php
		}

		$_notice = 'nl_adsense';
		if ( ! isset($options['closed'][ $_notice ] ) ) {
			?><div class="advads-admin-notice">
			    <p><?php _e( 'Learn more about how and <strong>how much you can earn with AdSense</strong> and Advanced Ads from the dedicated newsletter group.', 'advanced-ads' ); ?></p>
			    <button type="button" class="button-primary advads-notices-button-subscribe" data-notice="<?php echo $_notice ?>"><?php _e('Subscribe me now', 'advanced-ads'); ?></button>
			</div><?php
		}

		$_notice = 'nl_first_steps';
		if ( ! isset($options['closed'][ $_notice ] ) && ! $is_subscribed  ) {
			?><div class="advads-admin-notice">
			    <p><?php _e( 'Get the first steps and more tutorials to your inbox.', 'advanced-ads' ); ?></p>
			    <button type="button" class="button-primary advads-notices-button-subscribe" data-notice="<?php echo $_notice ?>"><?php _e('Send it now', 'advanced-ads'); ?></button>
			</div><?php
		}

		$model = Advanced_Ads::get_instance()->get_model();
		$recent_ads = $model->get_ads();

		// get next steps
		self::render_next_steps( $recent_ads );
	}

	/**
	 * render next-steps
	 */
	private static function render_next_steps($recent_ads = array()){
		$model = Advanced_Ads::get_instance()->get_model();
		$groups = $model->get_ad_groups();
		$placements = $model->get_ad_placements_array();

		$next_steps = array();

		if ( count( $recent_ads ) == 0 ) :
			$next_steps[] = '<p><a class="button button-primary" href="' . admin_url( 'post-new.php?post_type=' . Advanced_Ads::POST_TYPE_SLUG ) .
			'">' . __( 'Create your first ad', 'advanced-ads' ) . '</a></p>';
		endif;
		if ( count( $groups ) == 0 ) :
			$next_steps[] = '<p class="description">' . __( 'Ad Groups contain ads and are currently used to rotate multiple ads on a single spot.', 'advanced-ads' ) . '</p>' .
				'<p><a class="button button-primary" href="' . admin_url( 'admin.php?action=edit&page=advanced-ads-groups' ) .
				'">' . __( 'Create your first group', 'advanced-ads' ) . '</a></p>';
		endif;
		if ( count( $placements ) == 0 ) :
			$next_steps[] = '<p class="description">' . __( 'Ad Placements are the best way to manage where to display ads and groups.', 'advanced-ads' ) . '</p>'
				. '<p><a class="button button-primary" href="' . admin_url( 'admin.php?action=edit&page=advanced-ads-placements' ) .
				'">' . __( 'Create your first placement', 'advanced-ads' ) . '</a></p>';
		endif;

		// display all options
		if ( count( $next_steps ) > 0 ){
		    ?><br/><h4><?php _e( 'Next steps', 'advanced-ads' ); ?></h4><?php
foreach ( $next_steps as $_step ){
	echo $_step;
}
		}
	}

	/**
	 * support widget
	 */
	public static function render_support(){
		?><ul>
            <li><?php printf( __( '<a href="%s" target="_blank">Manual</a>', 'advanced-ads' ), ADVADS_URL . 'manual/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-manual' ); ?></li>
            <li><?php printf( __( '<a href="%s" target="_blank">FAQ and Support</a>', 'advanced-ads' ), ADVADS_URL . 'support/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-manual' ); ?></li>
            <li><?php printf( __( 'Vote for a <a href="%s" target="_blank">feature</a>', 'advanced-ads' ), ADVADS_URL . 'feature-requests/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-manual' ); ?></li>
            <li><?php printf( __( 'Thank the developer with a &#9733;&#9733;&#9733;&#9733;&#9733; review on <a href="%s" target="_blank">wordpress.org</a>', 'advanced-ads' ), 'https://wordpress.org/support/view/plugin-reviews/advanced-ads' ); ?></li>
        </ul><?php
	}

	/**
	 * help widget
	 */
	public static function render_help(){

		?><p><?php _e( 'Need help to set up and optimize your ads? Need custom coding on your site? Ask me for a quote.', 'advanced-ads' ); ?></p>
		<p><a class="button button-primary" href="mailto:support@wpadvancedads.com?subject=<?php printf( __( 'Help with ads on %s', 'advanced-ads' ), home_url()); ?>"><?php
			_e( 'Get an offer', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * pro add-on widget
	 */
	public static function render_add_on_pro(){

		?><p><?php _e( 'Ad management for advanced websites.', 'advanced-ads' ); ?></p><ul class='list'>
            <li><?php _e( 'Cache-busting', 'advanced-ads' ); ?></li>
            <li><?php _e( 'Advanced visitor conditions', 'advanced-ads' ); ?></li>
            <li><?php _e( 'Flash ads with fallback', 'advanced-ads' ); ?></li>
        </ul><p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/advanced-ads-pro/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get Pro', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * tracking add-on widget
	 */
	public static function render_add_on_tracking(){

		?><p><?php _e( 'Track the impressions of and clicks on your ads.', 'advanced-ads' ); ?></p><ul class='list'>
            <li><?php _e( '2 methods to count impressions', 'advanced-ads' ); ?></li>
            <li><?php _e( 'beautiful stats for all or single ads', 'advanced-ads' ); ?></li>
            <li><?php _e( 'group stats by day, week or month', 'advanced-ads' ); ?></li>
        </ul><p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/tracking/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the Tracking add-on', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * responsive add-on widget
	 */
	public static function render_add_on_responsive(){

		?><p><?php _e( 'Display ads based on the size of your visitor’s browser or device.', 'advanced-ads' ); ?></p><ul class='list'>
            <li><?php _e( 'set a range (from … to …) pixels for the browser size', 'advanced-ads' ); ?></li>
            <li><?php _e( 'set custom sizes for AdSense responsive ads', 'advanced-ads' ); ?></li>
            <li><?php _e( 'list all ads by their responsive settings', 'advanced-ads' ); ?></li>
        </ul><p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/responsive-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the Responsive add-on', 'advanced-ads' ); ?></a></p><?php
	}
	
	/**
	 * geo targeting add-on widget
	 */
	public static function render_add_on_geotargeting(){

		?><p><?php _e( 'Target visitors by their geo location.', 'advanced-ads' ); ?></p><ul class='list'>
        </ul><p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/geo-targeting/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the Geo Targeting add-on', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * sticky add-on widget
	 */
	public static function render_add_on_sticky(){

		?><p><?php _e( 'Fix ads to the browser while users are scrolling and create best performing anchor ads.', 'advanced-ads' ); ?></p><ul class='list'>
            <li><?php _e( 'position ads that don’t scroll with the screen', 'advanced-ads' ); ?></li>
            <li><?php _e( 'build anchor ads not only on mobile devices', 'advanced-ads' ); ?></li>
        </ul><p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/sticky-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the Sticky add-on', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * layer add-on widget
	 */
	public static function render_add_on_layer(){

		?><p><?php _e( 'Display content and ads in layers and popups on custom events.', 'advanced-ads' ); ?></p><ul class='list'>
            <li><?php _e( 'display a popup after a user interaction like scrolling', 'advanced-ads' ); ?></li>
            <li><?php _e( 'optional background overlay', 'advanced-ads' ); ?></li>
            <li><?php _e( 'allow users to close the popup', 'advanced-ads' ); ?></li>
        </ul><p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/popup-and-layer-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the PopUp and Layer add-on', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * slider add-on widget
	 */
	public static function render_add_on_slider(){

		?><p><?php _e( 'Create a beautiful and simple slider from your ads.', 'advanced-ads' ); ?></p>
		<p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/slider/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the Slider add-on', 'advanced-ads' ); ?></a></p><?php
	}

	/**
	 * selling ads add-on widget
	 */
	public static function render_add_on_sellingads(){
		?><p><?php _e( 'Let advertisers purchase ad space directly on the frontend of your site.', 'advanced-ads' ); ?></p>
		<p><a class="button button-primary" href="<?php echo ADVADS_URL; ?>add-ons/selling-ads/#utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-add-ons" target="_blank"><?php
			_e( 'Get the Selling Ads add-on', 'advanced-ads' ); ?></a></p><?php
	}

}
