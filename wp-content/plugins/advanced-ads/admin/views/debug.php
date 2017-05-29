<?php
/**
 * the view for the debug page
 */
?><div class="wrap">
    <h1><?php _e( 'Debug Page', 'advanced-ads' ); ?></h1>
    <p><?php _e( 'Work in progress', 'advanced-ads' ); ?></p>
    <?php screen_icon(); ?>

    <h2><?php _e( 'Settings', 'advanced-ads' ); ?></h2>
    <pre><?php print_r( $plugin_options ); ?></pre>

    <?php do_action('advanced-ads-debug-after', $plugin_options); ?>
</div>