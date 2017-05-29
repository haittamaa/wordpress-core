<tr class="hidden advads-ad-group-form">
    <td colspan="3">
        <label><strong><?php _e( 'Name', 'advanced-ads' ); ?></strong><input type="text" name="advads-groups[<?php
			echo $group->id; ?>][name]" value="<?php echo $group->name; ?>"/></label><br/>
        <label><strong><?php _e( 'Description', 'advanced-ads' ); ?></strong><input type="text" name="advads-groups[<?php
			echo $group->id; ?>][description]" value="<?php echo $group->description; ?>"/></label><br/>
        <strong><?php _e( 'Type', 'advanced-ads' ); ?></strong>
        <ul class="advads-ad-group-type"><?php foreach ( $this->types as $_type_key => $_type ) :
			?><li><label><input type="radio" name="advads-groups[<?php echo $group->id;
				?>][type]" value="<?php echo $_type_key; ?>" <?php checked( $group->type, $_type_key )?>/><?php
				echo $_type['title']; ?></label>
                <p class="description"><?php echo $_type['description']; ?></p>
            </li><?php
		endforeach; ?></ul><div class="clear"></div>
	<div class="advads-ad-group-number">
	    <label><strong><?php _e( 'Number of visible ads', 'advanced-ads' ); ?></strong>
	    <select name="advads-groups[<?php echo $group->id; ?>][ad_count]"><?php
		    $max = ( count( $ad_form_rows ) >= 10 ) ? count( $ad_form_rows ) + 2 : 10;
		    for ( $i = 1; $i <= $max; $i++ ) : ?>
		    <option <?php selected( $group->ad_count, $i ); ?>><?php echo $i; ?></option>
		<?php endfor;
		    ?><option <?php selected( $group->ad_count, 'all' ); ?> value="all"><?php _ex('all', 'option to display all ads in an ad groups', 'advanced-ads'); ?></option>
		    </select>
	    </label>
	    <p class="description"><?php _e( 'Number of ads that are visible at the same time', 'advanced-ads' ); ?></p>
	</div>
	<?php do_action( 'advanced-ads-group-form-options', $group ); ?>
        <h3><?php _e( 'Ads', 'advanced-ads' ); ?></h3>

        <table class="advads-group-ads">
            <thead><tr><th><?php _e( 'Ad', 'advanced-ads' );
			?></th><th colspan="2"><?php _e( 'weight', 'advanced-ads' ); ?></th></tr></thead>
			<tbody>
			<?php
			if ( count( $ad_form_rows ) ) {
				foreach ( $ad_form_rows as $_row ) {
					echo $_row;
				}
			} ?>
			</tbody>
		</table>

		<?php if ( $ads_for_select ): ?>
			<fieldset class="advads-group-add-ad">
				<legend><?php _e( 'New Ad', 'advanced-ads' ); ?></legend>
				<select class="advads-group-add-ad-list-ads">
					<?php foreach ( $ads_for_select as $_ad_id => $_ad_title ) {
						echo '<option value="advads-groups[' . $group->id . '][ads][' . $_ad_id . ']">' . $_ad_title . '</option>';
					} ?>
				</select>
				<?php echo $new_ad_weights; ?>
				<button type="button" class="button"><?php _e( 'add', 'advanced-ads' ); ?></button>
			</fieldset>
		<?php endif; ?>
    </td>
</tr>