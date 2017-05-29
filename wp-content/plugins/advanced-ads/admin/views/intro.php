<?php
/* wp_enqueue_style( 'wp-mediaelement' );
wp_enqueue_script( 'wp-mediaelement' );
wp_localize_script( 'mediaelement', '_wpmejsSettings', array(
	'pluginPath' => includes_url( 'js/mediaelement/', 'relative' ),
	'pauseOtherPlayers' => ''
) );

$video_url = 'https://videopress.com/embed/T54Iy7Tw';
$locale    = str_replace( '_', '-', get_locale() );
if ( 'en' !== $locale ) {
	$video_url = add_query_arg( 'defaultLangCode', $locale, $video_url );
}*/

$minor_features = array(
	array(
		'src'         => ADVADS_BASE_URL . '/admin/assets/img/intro/5-star-usability.png',
		'heading'     => __( '5-Star Usability', 'advanced-ads' ),
		'description' => __( 'Advanced Ads is powerful and easy to use, because it is build on WordPress standards. If you know how to publish a post then you know how to create an ad.', 'advanced-ads' ),
	),
	array(
		'src'         => ADVADS_BASE_URL . '/admin/assets/img/intro/5-star-support.png',
		'heading'     => __( '5-Star Support', 'advanced-ads' ),
		'description' => __( 'I promise you the best supported ad management plugin for WordPress. Whether a pro user or not, you can reach me easily through the support page, in the chat on the homepage or replying to a newsletter.', 'advanced-ads' ),
	),
	array(
		'src'         => ADVADS_BASE_URL . '/admin/assets/img/intro/5-star-experience.png',
		'heading'     => __( '5-Star Experience', 'advanced-ads' ),
		'description' => __( 'Advanced Ads was built out of my own experience. I am personally using it to serve millions of ad impressions per month and constantly test new ways to optimize ad settings.', 'advanced-ads' ),
	),
);
?>
<div class="wrap about-wrap">
	<h1><?php printf( __( 'Welcome to <strong>Advanced Ads</strong>' ), ADVADS_VERSION ); ?></h1>

	<div class="about-text"><?php _e( 'Let me give you an introduction into your future ad management solution.' ); ?></div>

	<?php /* <h2 class="nav-tab-wrapper">
		<a href="about.php" class="nav-tab nav-tab-active"><?php _e( 'What&#8217;s New' ); ?></a>
		<a href="credits.php" class="nav-tab"><?php _e( 'Credits' ); ?></a>
		<a href="freedoms.php" class="nav-tab"><?php _e( 'Freedoms' ); ?></a>
	</h2>

	<div class="headline-feature feature-video">
		<iframe width="1050" height="591" src="<?php echo esc_url( $video_url ); ?>" frameborder="0" allowfullscreen></iframe>
		<script src="https://videopress.com/videopress-iframe.js"></script>
	</div>*/ ?>

	<hr/>

	<div class="feature-section three-col">
		<?php foreach ( $minor_features as $feature ) : ?>
		<div class="col">
			<img src="<?php echo esc_attr( $feature['src'] ); ?>" width="314" height="180"/>
			<h3><?php echo $feature['heading']; ?></h3>
			<p><?php echo $feature['description']; ?></p>
		</div>
		<?php endforeach; ?>
	</div>
	<hr/>
	<h2><?php _e( 'Next Steps', 'advanced-ads' ); ?></h2>
	<div class="feature-section three-col">
	    <div class="col">
		<h3>1. <?php _e( 'Subscribe to the Mailing List', 'advanced-ads' ); ?></h3>
		<p><?php _e( 'Subscribe to the newsletter and instantly', 'advanced-ads' ); ?></p>
		<ul>
		    <li><?php _e( 'get 2 free add-ons.', 'advanced-ads' ); ?></li>
		    <li><?php _e( 'reply to the welcome message with a question.', 'advanced-ads' ); ?></li>
		    <li><?php _e( 'subscribe to a dedicated group for the tutorial or AdSense tips.', 'advanced-ads' ); ?></li>
		</ul>
		<div class="advads-admin-notice">
		    <p>
			<button type="button" class="button button-hero button-primary advads-notices-button-subscribe" data-notice="nl_free_addons"><?php echo __('Subscribe me now', 'advanced-ads'); ?></button>
		    </p>
		</div>
	    </div>
	    <div class="col">
		<h3>2. <?php _e( 'Create your first ad', 'advanced-ads' ); ?></h3>
		<p><?php printf(__( 'Get started by creating an ad <a href="%1$s" target="blank">right now</a> or watch the <a href="%2$s" target="blank">tutorial video (3:29min)</a> first.', 'advanced-ads' ), admin_url( 'post-new.php?post_type=' . Advanced_Ads::POST_TYPE_SLUG ), ADVADS_URL . 'manual/first-ad/#utm_source=advanced-ads&utm_medium=link&utm_campaign=intro' ); ?></p>
	    </div>
	    <div class="col">
		<h3>3. <?php _e( 'Display your ad', 'advanced-ads' ); ?></h3>
		<p><?php _e( 'You can display your ad using a shortcode, widget or one of the powerful placements. Placements help you to inject ads into the content or place them on your site without coding.', 'advanced-ads' ); ?></p>
		<ul>
		    <li><a href="<?php echo ADVADS_URL . '/manual/placements/#utm_source=advanced-ads&utm_medium=link&utm_campaign=intro'; ?>" target="_blank"><?php _e( 'List of all available placements', 'advanced-ads' ); ?></a></li>
		    <li><a href="<?php echo admin_url( 'admin.php?page=advanced-ads-placements' ); ?>" target="_blank"><?php _e( 'Create a placement', 'advanced-ads' ); ?></a></li>
		</ul>
	    </div>
	</div>
</div>