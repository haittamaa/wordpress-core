<?php
/**
 * Advanced Ads overview page in the dashboard
 */

/** Load WordPress dashboard API */
require_once(ABSPATH . 'wp-admin/includes/dashboard.php');

do_action( 'advanced-ads-admin-overview-before' );

wp_enqueue_script( 'dashboard' );
if ( current_user_can( 'edit_theme_options' ) ) {
	wp_enqueue_script( 'customize-loader' ); }
if ( current_user_can( 'install_plugins' ) ) {
	wp_enqueue_script( 'plugin-install' ); }
if ( current_user_can( 'upload_files' ) ) {
	wp_enqueue_script( 'media-upload' ); }
add_thickbox();

if ( wp_is_mobile() ) {
	wp_enqueue_script( 'jquery-touch-punch' ); }

$title = __( 'Ads Dashboard', 'advanced-ads' );

?><div class="wrap">
    <h1><?php echo esc_html( $title ); ?></h1>

    <div id="dashboard-widgets-wrap">
    <?php wp_dashboard(); ?>
    </div><!-- dashboard-widgets-wrap -->
    <?php do_action( 'advanced-ads-admin-overview-after' ); ?>
</div><!-- wrap -->