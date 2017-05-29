/*
 * global js functions for Advanced Ads
 */
jQuery( document ).ready(function () {

	/**
	 * ADMIN NOTICES
	 */
	// close button
	jQuery(document).on('click', '.advads-admin-notice button.notice-dismiss', function(){
	    var messagebox = jQuery(this).parents('.advads-admin-notice');
	    if( messagebox.attr('data-notice') === undefined) return;

	    var query = {
		action: 'advads-close-notice',
		notice: messagebox.attr('data-notice')
	    };
	    // send query
	    jQuery.post(ajaxurl, query, function (r) {
		// messagebox.fadeOut();
	    });

	});
	// autoresponder button
	jQuery('.advads-notices-button-subscribe').click(function(){
	    if(this.dataset.notice === undefined) return;
	    var messagebox = jQuery(this).parents('.advads-admin-notice');
	    messagebox.find('p').append( '<span class="spinner advads-spinner"></span>' );

	    var query = {
		action: 'advads-subscribe-notice',
		notice: this.dataset.notice
	    };
	    // send and close message
	    jQuery.post(ajaxurl, query, function (r) {
		if(r === '1'){
		    messagebox.fadeOut();
		} else {
		    messagebox.find('p').html(r);
		    // don’t change class on intro page
		    if( ! jQuery('.admin_page_advanced-ads-intro').length ){
			    messagebox.removeClass('updated').addClass('error');
		    }
		}
	    });

	});
	
	/**
	 * DEACTIVATION FEEDBACK FORM
	 */
	// show overlay when clicked on "deactivate"
	advads_deactivate_link = jQuery('.wp-admin.plugins-php tr[data-slug="advanced-ads"] .row-actions .deactivate a');
	advads_deactivate_link_url = advads_deactivate_link.attr( 'href' );
	advads_deactivate_link.click(function ( e ) {
		e.preventDefault();
		// only show feedback form once per 30 days
		var c_value = advads_admin_get_cookie( "advads_hide_deactivate_feedback" );
		if (c_value === undefined){
		    jQuery( '#advanced-ads-feedback-overlay' ).show();
		} else {
		    // click on the link
		    window.location.href = advads_deactivate_link_url;
		}
	});
	// show text fields
	jQuery('#advanced-ads-feedback-content input[type="radio"]').click(function () {
		// show text field if there is one
		jQuery(this).parents('li').next('li').children('input[type="text"], textarea').show();
	});
	// handle technical issue feedback in particular
	jQuery('#advanced-ads-feedback-content .advanced_ads_disable_technical_issue input[type="radio"]').click(function () {
		// show text field if there is one
		jQuery(this).parents('li').siblings('.advanced_ads_disable_reply').show();
	});
	// send form or close it
	jQuery('#advanced-ads-feedback-content .button').click(function ( e ) {
		e.preventDefault();
		// set cookie for 30 days
		var exdate = new Date();
		exdate.setSeconds( exdate.getSeconds() + 2592000 );
		document.cookie = "advads_hide_deactivate_feedback=1; expires=" + exdate.toUTCString() + "; path=/";
			
		jQuery( '#advanced-ads-feedback-overlay' ).hide();
		if ( 'advanced-ads-feedback-submit' === this.id ) {
			// show text field if there is one
			jQuery.ajax({
			    type: 'POST',
			    url: ajaxurl,
			    dataType: 'json',
			    data: {
				action: 'advads_send_feedback',
				formdata: jQuery( '#advanced-ads-feedback-content form' ).serialize()
			    },
			    complete: function (MLHttpRequest, textStatus, errorThrown) {
				    // deactivate the plugin and close the popup
				    jQuery( '#advanced-ads-feedback-overlay' ).remove();
				    window.location.href = advads_deactivate_link_url;

			    }
			});
		} else {
			jQuery( '#advanced-ads-feedback-overlay' ).remove();
			window.location.href = advads_deactivate_link_url;
		}
	});
	// close form without doing anything
	jQuery('.advanced-ads-feedback-not-deactivate').click(function ( e ) {
		jQuery( '#advanced-ads-feedback-overlay' ).hide();
	});

});

function advads_admin_get_cookie (name) {
	var i, x, y, ADVcookies = document.cookie.split( ";" );
	for (i = 0; i < ADVcookies.length; i++)
	{
		x = ADVcookies[i].substr( 0, ADVcookies[i].indexOf( "=" ) );
		y = ADVcookies[i].substr( ADVcookies[i].indexOf( "=" ) + 1 );
		x = x.replace( /^\s+|\s+$/g, "" );
		if (x === name)
		{
			return unescape( y );
		}
	}
}