<?php

class Advanced_Ads_AdSense_Public {

	private $data; // options

	private static $instance = null;

	private function __construct() {
		$this->data = Advanced_Ads_AdSense_Data::get_instance();
		add_action( 'wp_head', array( $this, 'inject_header' ), 20 );
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * inject page-level header code
	 *
	 * @since 1.6.9
	 */
	public function inject_header(){
		$options = $this->data->get_options();
		$pub_id = trim( $this->data->get_adsense_id() );

		if( ! defined( 'ADVADS_ADS_DISABLED' ) && $pub_id && isset( $options['page-level-enabled'] ) && $options['page-level-enabled'] ){
			$pub_id = $this->data->get_adsense_id();
			$client_id = 'ca-' . $pub_id;
			include GADSENSE_BASE_PATH . 'public/templates/page-level.php';
		}
	}
}
