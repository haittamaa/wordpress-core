<?php

class Advanced_Ads_Frontend_Checks {
	/**
	 * True if 'the_content' was invoked, false otherwise.
	 *
	 * @var bool
	 */
	private $did_the_content = false;

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		if ( ! is_admin()
			&& is_admin_bar_showing()
			&& current_user_can( Advanced_Ads_Plugin::user_cap( 'advanced_ads_manage_options' ) )
		) {
			add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_menu' ), 1000 );
			add_filter( 'the_content', array( $this, 'set_did_the_content' ) );
			add_filter( 'wp_footer', array( $this, 'check_adblocker' ), -101 );
			add_filter( 'advanced-ads-ad-output', array( $this, 'after_ad_output' ), 10, 2 );
		}
	}

	/**
	 * List current ad situation on the page in the admin-bar.
	 *
	 * @param obj $wp_admin_bar WP_Admin_Bar
	 */
	public function add_admin_bar_menu( $wp_admin_bar ) {
		global $wp_the_query, $post, $wp_scripts;

		$options = Advanced_Ads_Plugin::get_instance()->options();
		$display_fine = true;

		$wp_admin_bar->add_node( array(
			'id'    => 'advanced_ads_ad_health',
			'title' => __( 'Ad Health', 'advanced-ads' ),
		) );

		// Hidden, will be shown using js.
		$wp_admin_bar->add_node( array(
			'parent' => 'advanced_ads_ad_health',
			'id'    => 'advanced_ads_ad_health_jquery',
			'title' => __( 'jQuery not in header', 'advanced-ads' ),
			'href'  => 'https://wpadvancedads.com/manual/common-issues#frontend-issues-javascript',
			'meta'   => array(
				'class' => 'hidden advanced_ads_ad_health_warning',
				'target' => '_blank'
			)
		) );

		// Hidden, will be shown using js.
		$wp_admin_bar->add_node( array(
			'parent' => 'advanced_ads_ad_health',
			'id'     => 'advanced_ads_ad_health_adblocker_enabled',
			'title'  => __( 'Ad blocker enabled', 'advanced-ads' ),
			// 'href'   => 'https://wpadvancedads.com/support',
			'meta'   => array(
				'class' => 'hidden advanced_ads_ad_health_warning',
				'target' => '_blank'
			)
		) );

		if ( $wp_the_query->is_singular() ) {
		    
			if ( ! $this->did_the_content ) {
				$wp_admin_bar->add_node( array(
					'parent' => 'advanced_ads_ad_health',
					'id'    => 'advanced_ads_ad_health_the_content_not_invoked',
					'title' => sprintf( __( '<em>%s</em> filter does not exist', 'advanced-ads' ), 'the_content' ),
					'href'  => 'https://wpadvancedads.com/manual/ads-not-showing-up/#frontend-issues-the-content-filter',
					'meta'   => array(
						'class' => 'advanced_ads_ad_health_warning',
						'target' => '_blank'
					)
				) );
				$display_fine = false;
			}
		    
			if ( ! empty( $post->ID ) ) {
				$ad_settings = get_post_meta( $post->ID, '_advads_ad_settings', true );

				if ( ! empty( $ad_settings['disable_ads'] ) ) {
					$wp_admin_bar->add_node( array(
						'parent' => 'advanced_ads_ad_health',
						'id'    => 'advanced_ads_ad_health_disabled_on_page',
						'title' => __( 'Ads are disabled on this page', 'advanced-ads' ),
						'href'  => get_edit_post_link( $post->ID ) . '#advads-ad-settings',
						'meta'   => array(
							'class' => 'advanced_ads_ad_health_warning',
							'target' => '_blank'
						)
					) );
					$display_fine = false;
				}

				if ( ! empty( $ad_settings['disable_the_content'] ) ) {
					$wp_admin_bar->add_node( array(
						'parent' => 'advanced_ads_ad_health',
						'id'    => 'advanced_ads_ad_health_disabled_in_content',
						'title' => __( 'Ads are disabled in the content of this page', 'advanced-ads' ),
						'href'  => get_edit_post_link( $post->ID ) . '#advads-ad-settings',
						'meta'   => array(
							'class' => 'advanced_ads_ad_health_warning',
							'target' => '_blank'
						)
					) );
					$display_fine = false;
				}
			} else {
				$wp_admin_bar->add_node( array(
					'parent' => 'advanced_ads_ad_health',
					'id'    => 'advanced_ads_ad_health_post_zero',
					'title' => __( 'the current post ID is 0 ', 'advanced-ads' ),
					'href'  => 'https://wpadvancedads.com/manual/known-plugin-conflicts/#frontend-issue-post-id-empty',
					'meta'   => array(
						'class' => 'advanced_ads_ad_health_warning',
						'target' => '_blank'
					)
				) );
				$display_fine = false;
			}
		}

		if ( $wp_the_query->is_404() && ! empty( $options['disabled-ads']['404'] ) ) {
			$wp_admin_bar->add_node( array(
				'parent' => 'advanced_ads_ad_health',
				'id'    => 'advanced_ads_ad_health_no_404',
				'title' => __( 'Ads are disabled on 404 pages', 'advanced-ads' ),
				'href'  => admin_url( 'admin.php?page=advanced-ads-settings' ),
				'meta'   => array(
					'class' => 'advanced_ads_ad_health_warning',
					'target' => '_blank'
				)
			) );
			$display_fine = false;
		}

		if ( ! $wp_the_query->is_singular() && ! empty( $options['disabled-ads']['archives'] ) ){
			$wp_admin_bar->add_node( array(
				'parent' => 'advanced_ads_ad_health',
				'id'    => 'advanced_ads_ad_health_no_archive',
				'title' => __( 'Ads are disabled on non singular pages', 'advanced-ads' ),
				'href'  => admin_url( 'admin.php?page=advanced-ads-settings' ),
				'meta'   => array(
					'class' => 'advanced_ads_ad_health_warning',
					'target' => '_blank'
				)
			) );
			$display_fine = false;
		}

		if ( ! extension_loaded( 'dom' ) ) {
			$wp_admin_bar->add_node( array(
				'parent' => 'advanced_ads_ad_health',
				'id'    => 'advanced_ads_ad_health_no_dom_document',
				'title' => sprintf( __( 'The %s extension(s) is not loaded', 'advanced-ads' ), 'dom' ),
				'href'  => 'http://php.net/manual/en/book.dom.php',
				'meta'   => array(
					'class' => 'advanced_ads_ad_health_warning',
					'target' => '_blank'
				)
			) );
			$display_fine = false;
		}
		
		$display_fine = apply_filters( 'advanced-ads-ad-health-display-fine', $display_fine );

		if ( $display_fine ) {
			$wp_admin_bar->add_node( array(
				'parent' => 'advanced_ads_ad_health',
				'id'    => 'advanced_ads_ad_health_fine',
				'title' => __( 'Everything is fine', 'advanced-ads' ),
				'href'  => false,
				'meta'   => array(
					'target' => '_blank',
				)
			) );
		}

		$wp_admin_bar->add_node( array(
			'parent' => 'advanced_ads_ad_health',
			'id'    => 'advanced_ads_ad_health_debug_dfp',
			'title' => __( 'debug DFP ads', 'advanced-ads' ),
			'href'  => esc_url( add_query_arg( 'googfc', '' ) ),
			'meta'   => array(
				'class' => 'hidden advanced_ads_ad_health_debug_dfp_link',
				'target' => '_blank',
			)
		) );

		$wp_admin_bar->add_node( array(
			'parent' => 'advanced_ads_ad_health',
			'id'    => 'advanced_ads_ad_health_highlight_ads',
			'title' => sprintf( '<label style="color: inherit;"><input id="advanced_ads_highlight_ads_checkbox" type="checkbox"> %s</label>', __( 'highlight ads', 'advanced-ads' ) )
		) );
	}

	/**
	 * Set variable to 'true' when 'the_content' filter is invoked.
	 *
	 * @param string $content
	 * @return string $content
	 */
	public function set_did_the_content( $content ) {
		if ( ! $this->did_the_content ) {
			$this->did_the_content = true;
		}
		return $content;
	}

	/**
	 * Check conditions and display warning. Conditions: AdBlocker enabled, jQuery is included in header
	 */
	public function check_adblocker() { ?>
		<!--noptimize--><style>.hidden { display: none; } .advads-adminbar-is-warnings { background: #a54811 ! important; color: #fff !important; }
		.advanced-ads-highlight-ads { outline:4px solid blue !important; }</style>
		<script type="text/javascript" src="<?php echo ADVADS_BASE_URL . 'admin/assets/js/advertisement.js' ?>"></script>
		<script>
		(function(d, w) {
				var not_head_jQuery = typeof jQuery === 'undefined';

				var addEvent = function( obj, type, fn ) {
					if ( obj.addEventListener )
						obj.addEventListener( type, fn, false );
					else if ( obj.attachEvent )
						obj.attachEvent( 'on' + type, function() { return fn.call( obj, window.event ); } );
				};

				function highlight_ads() {
					try {
					    var ad_wrappers = document.querySelectorAll('div[id^="<?php echo Advanced_Ads_Plugin::get_instance()->get_frontend_prefix();?>"]')
					} catch ( e ) { return; }
				    for ( i = 0; i < ad_wrappers.length; i++ ) {
				        if ( this.checked ) {
				            ad_wrappers[i].className += ' advanced-ads-highlight-ads';
				        } else {
				            ad_wrappers[i].className = ad_wrappers[i].className.replace( 'advanced-ads-highlight-ads', '' );
				        }
				    }
				}

				addEvent( w, 'load', function() {
					var adblock_item = d.getElementById( 'wp-admin-bar-advanced_ads_ad_health_adblocker_enabled' ),
						jQuery_item = d.getElementById( 'wp-admin-bar-advanced_ads_ad_health_jquery' ),
						fine_item = d.getElementById( 'wp-admin-bar-advanced_ads_ad_health_fine' ),
						hide_fine = false;

					var highlight_checkbox = d.getElementById( 'advanced_ads_highlight_ads_checkbox' );
					if ( highlight_checkbox ) {
						addEvent( highlight_checkbox, 'change', highlight_ads );
					}

					if ( adblock_item && typeof advanced_ads_adblocker_test === 'undefined' ) {
						// show hidden item
						adblock_item.className = adblock_item.className.replace( /hidden/, '' );
						hide_fine = true;
					}

					if ( jQuery_item && not_head_jQuery ) {
						// show hidden item
						jQuery_item.className = jQuery_item.className.replace( /hidden/, '' );
						hide_fine = true;
					}

					if ( hide_fine && fine_item ) {
						fine_item.className += ' hidden';
					}

					showCount();
				});

				var showCount = function() {
					try {
						// select not hidden warning items, exclude the 'fine_item'
						var warning_count = document.querySelectorAll( '.advanced_ads_ad_health_warning:not(.hidden)' ).length;
					} catch ( e ) { return; }

					if ( warning_count ) {
						var header = document.querySelector( '#wp-admin-bar-advanced_ads_ad_health > div' );

						if ( header ) {
							header.innerHTML += ' <i>(' + warning_count + ')</i>';
							header.className += ' advads-adminbar-is-warnings';
						}
					}
				};
		})(document, window);
		</script><!--/noptimize-->
		<?php
	}

	/**
	 * Allow DFP debugging by showing a link that points to the current URL with the 'googfc' parameter.
	 *
	 * @param str $content ad content
	 * @param obj $ad Advanced_Ads_Ad
	 * @return str $content ad content
	 */
	public function after_ad_output( $content = '', Advanced_Ads_Ad $ad ) {
		if ( $ad->type === 'plain' && preg_match( '/gpt\.js/', $content ) ) {
			ob_start(); ?>
			<!--noptimize--><script>
			var advads_dfp_link = document.querySelector( '.advanced_ads_ad_health_debug_dfp_link.hidden' );
			if ( advads_dfp_link ) {
				advads_dfp_link.className = advads_dfp_link.className.replace( 'hidden', '' );
			}
			</script><!--/noptimize-->
			<?php
			$content .= ob_get_clean();
		}
		return $content;
	}

}
