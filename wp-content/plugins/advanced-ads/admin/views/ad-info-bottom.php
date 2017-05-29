<div id="advads-wizard-controls" class="hidden">
    <button type="button" id="advads-wizard-controls-prev" class="button button-secondary button-large"><span class="dashicons dashicons-controls-back"></span>&nbsp;<?php _ex( 'previous', 'wizard navigation', 'advanced-ads' ); ?></button>
    <button type="button" class="advads-stop-wizard button button-large"><?php _ex( 'Stop Wizard', 'advanced-ads' ); ?></button>
    <input type="submit" id="advads-wizard-controls-save" class="button button-primary button-large" value="<?php _ex( 'save', 'wizard navigation', 'advanced-ads' ); ?>"/>
    <button type="button" id="advads-wizard-controls-next" class="button button-primary button-large"><?php _ex( 'next', 'wizard navigation', 'advanced-ads' ); ?>&nbsp;<span class="dashicons dashicons-controls-forward"></span></button>
</div>
<?php // start the wizard if it was never closed
if( $this->start_wizard_automatically() ) : ?>
<script>
  advads_wizard.start();
</script>
<?php endif;