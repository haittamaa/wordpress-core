<fieldset class="inline-edit-col-left">
	<div class="inline-edit-col <?php echo $html_classes; ?>">
		<?php if ( $post_future ) : ?>
			<p><?php printf( __( 'starts %s', 'advanced-ads' ), date( $expiry_date_format, $post_future ) ); ?></p>
		<?php endif; ?>
        <?php if ( $expiry ) : ?>
            <?php
            $tz_option = get_option( 'timezone_string' );
            $expiry_date = date_create( '@' . $expiry );
            if ( $tz_option ) {
                $expiry_date->setTimezone( Advanced_Ads_Admin::get_wp_timezone() );
            } else {
                $tz_name = Advanced_Ads_Admin::timezone_get_name( Advanced_Ads_Admin::get_wp_timezone() );
                $tz_offset = substr( $tz_name, 3 );
                $off_time = date_create( $expiry_date->format( 'Y-m-d\TH:i:s' ) . $tz_offset );
                $offset_in_sec = date_offset_get( $off_time );
                $expiry_date = date_create( '@' . ( $expiry + $offset_in_sec ) );
            }
            ?>
            <?php if ( $expiry > time() ) :?>
                <p><?php printf( __( 'expires %s', 'advanced-ads' ), $expiry_date->format( $expiry_date_format ) ); ?></p>
            <?php else : ?>
                <p><?php printf( __( '<strong>expired</strong> %s', 'advanced-ads' ), $expiry_date->format( $expiry_date_format ) ); ?></p>
            <?php endif; ?>
        <?php endif; ?>
        <?php echo $content_after; ?>
	</div>
</fieldset>