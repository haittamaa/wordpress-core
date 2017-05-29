<div id="advads-first-ad-links" class="postbox advads-ad-metabox" style="clear: both; margin: 10px 20px 0 2px;">
    <h2><?php _e( 'Not many ads here yet. Get help from the following resources:', 'advanced-ads' ); ?></h2>
    <button type="button" id="advads-first-ad-video-link" class="button-primary"><?php _e( 'Watch the “First Ad” Tutorial (Video)', 'advanced-ads'); ?></button>
    <a href="<?php echo ADVADS_URL . '/manual/ad-templates#utm_source=advanced-ads&utm_medium=link&utm_campaign=first-ad-import'; ?>" target="_blank"><button type="button" class="button-primary"><?php _e( 'Import Ads (Link)', 'advanced-ads'); ?></button></a>
    <a href="<?php echo ADVADS_URL . '/codex/ad-placeholder#utm_source=advanced-ads&utm_medium=link&utm_campaign=first-ad-dummy'; ?>" target="_blank"><button type="button" class="button-primary"><?php _e( 'Get dummy ad content (Link)', 'advanced-ads'); ?></button></a>
    <br class="clear"/>
</div>
<script>
    jQuery('#advads-first-ad-video-link').click(function(){
	jQuery( '<br/><iframe width="420" height="315" src="https://www.youtube-nocookie.com/embed/R-LZuEB7MUQ?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>' ).appendTo('#advads-first-ad-links');
    });
</script>