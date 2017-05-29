<div id="advanced-ads-feedback-overlay" style="display: none;">
    <div id="advanced-ads-feedback-content">
	<form action="" method="post">
	    <p><strong><?php _e('Why did you decide to disable Advanced Ads?', 'advanced-ads'); ?></strong></p>
	    <ul>
		<li><label><input type="radio" name="advanced_ads_disable_reason" value="temporary"/><?php _e('It is only temporary', 'advanced-ads'); ?></label></li>
		<li class="advanced_ads_disable_technical_issue"><label><input type="radio" name="advanced_ads_disable_reason" value="technical issue"/><?php _e('I have a problem', 'advanced-ads'); ?></label></li>
		<li><textarea name="advanced_ads_disable_text[]" placeholder="<?php _e('Please let us know how we can help', 'advanced-ads'); ?>"></textarea></li>
		<?php if( $email ) : ?>
		    <?php $mailinput = '<input type="email" name="advanced_ads_disable_reply_email" value="'. $email .'"/>'; ?>
		    <li class="advanced_ads_disable_reply"><label><input type="checkbox" name="advanced_ads_disable_reply" value="1" checked="checked"/><?php printf(__('Send me free help to %s', 'advanced-ads'), $mailinput ); ?></label></li>
		<?php endif; ?>
		<li><label><input type="radio" name="advanced_ads_disable_reason" value="missing feature"/><?php _e('I miss a feature', 'advanced-ads'); ?></label></li>
		<li><input type="text" name="advanced_ads_disable_text[]" value="" placeholder="Which one?"/></li>
		<li><label><input type="radio" name="advanced_ads_disable_reason" value="stopped showing ads"/><?php _e('I don’t use ads on my site', 'advanced-ads'); ?></label></li>
		<li><label><input type="radio" name="advanced_ads_disable_reason" value="other plugin"/><?php _e('I switched to another plugin', 'advanced-ads'); ?></label></li>
		<li><input type="text" name="advanced_ads_disable_text[]" value="" placeholder="Which one?"/></li>
		<li><label><input type="radio" name="advanced_ads_disable_reason" value="other"/><?php _e('other reason', 'advanced-ads'); ?></label></li>
		<li><textarea name="advanced_ads_disable_text[]" placeholder="<?php _e('Please specify, if possible', 'advanced-ads'); ?>"></textarea></li>
	    </ul>
	    <?php if ($from) : ?>
    	    <input type="hidden" name="advanced_ads_disable_from" value="<?php echo $from; ?>"/>
	    <?php endif; ?>
	    <input id="advanced-ads-feedback-submit" class="button button-primary" type="submit" name="advanced_ads_disable_submit" value="<?php _e('Submit & Deactivate', 'advanced-ads'); ?>"/>
	    <a class="button"><?php _e('Only Deactivate', 'advanced-ads'); ?></a>
	    <a class="advanced-ads-feedback-not-deactivate" href="#"><?php _e('don’t deactivate', 'advanced-ads'); ?></a>
	</form>
    </div>
</div>