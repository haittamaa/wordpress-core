/**
 * Advanced Ads.
 *
 * @author    Thomas Maier <thomas.maier@webgilde.com>
 * @license   GPL-2.0+
 * @link      http://webgilde.com
 * @copyright 2013-2015 Thomas Maier, webgilde GmbH
 */
;
(function ($) {
	"use strict";

	// On DOM ready
	$(function () {
		$( document ).on('click', '#submit-pastecode', function(ev){
			ev.preventDefault();
			var rawContent = $( '#pastecode-content' ).val();

			var parseResult = parseAdContent( rawContent );
			if (false === parseResult) {
				// Not recognized ad code
				$( '#pastecode-msg' ).append( $( '<p />' ).css( 'color', 'red' ).html( gadsenseData.msg.unknownAd ) );
			} else {
				setDetailsFromAdCode( parseResult );
			}

		});

		$( document ).on('click', '#advanced-ad-type-adsense', function(){
			$( '#advanced-ads-ad-parameters' ).on('paramloaded', function(){
				var content = $( '#advanced-ads-ad-parameters input[name="advanced_ad[content]"]' ).val();
				var parseResult = parseAdContent( content );
				if (false !== parseResult) {
					setDetailsFromAdCode( parseResult );
				}
			});
		});

		$( document ).on('change', '#unit-type, #unit-code', function (ev) {
			advads_update_adsense_type();
		});

		$( document ).on('click', '#show-pastecode-div', function(ev){
			ev.preventDefault();
			$( '#pastecode-div' ).show( 500 );
		});

		$( document ).on('click', '#hide-pastecode-div', function(ev){
			ev.preventDefault();
			$( '#pastecode-div' ).hide( 500 );
			$( '#pastecode-content' ).val( '' );
			$( '#pastecode-msg' ).empty();
		});

		function parseAdContent(content) {
			var rawContent = ('undefined' != typeof(content))? content.trim() : '';
			var theAd = {};
			var theContent = $( '<div />' ).html( rawContent );
			var adByGoogle = theContent.find( 'ins' );
			theAd.slotId = adByGoogle.attr( 'data-ad-slot' );
			if ('undefined' != typeof(adByGoogle.attr( 'data-ad-client' ))) {
				theAd.pubId = adByGoogle.attr( 'data-ad-client' ).substr( 3 );
			}
			if (undefined !== theAd.slotId && '' != theAd.pubId) {
				theAd.display = adByGoogle.css( 'display' );
				theAd.format = adByGoogle.attr( 'data-ad-format' );
				theAd.style = adByGoogle.attr( 'style' );
                
				if ('undefined' == typeof(theAd.format) && -1 != theAd.style.indexOf( 'width' )) {
					/* normal ad */
					theAd.type = 'normal';
					theAd.width = adByGoogle.css( 'width' ).replace( 'px', '' );
					theAd.height = adByGoogle.css( 'height' ).replace( 'px', '' );
					return theAd;
				}

				if ('undefined' != typeof(theAd.format) && 'auto' == theAd.format) {
					/* Responsive ad, auto resize */
					theAd.type = 'responsive';
					return theAd;
				}
				
				
				/* older link unit format; for new ads the format type is no longer needed; link units are created through the AdSense panel */
				if ('undefined' != typeof(theAd.format) && 'link' == theAd.format) {
					
					if( -1 != theAd.style.indexOf( 'width' ) ){
					// is fixed size
					    theAd.width = adByGoogle.css( 'width' ).replace( 'px', '' );
					    theAd.height = adByGoogle.css( 'height' ).replace( 'px', '' );
					    theAd.type = 'link';
					} else {
					// is responsive
					    theAd.type = 'link-responsive';
					}
					return theAd;
				}
				
				if ('undefined' != typeof(theAd.format) && 'autorelaxed' == theAd.format) {
					/* Responsive Matched Content */
					theAd.type = 'matched-content';
					return theAd;
				}
			}
			return false;
		}

		/**
		 * Set ad parameters fields from the result of parsing ad code
		 */
		function setDetailsFromAdCode(theAd) {
			$( '#unit-code' ).val( theAd.slotId );
			$( '#advads-adsense-pub-id' ).val( theAd.pubId );
			if ('normal' == theAd.type) {
				$( '#unit-type' ).val( 'normal' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[width]"]' ).val( theAd.width );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[height]"]' ).val( theAd.height );
			}
			if ('responsive' == theAd.type) {
				$( '#unit-type' ).val( 'responsive' );
				$( '#ad-resize-type' ).val( 'auto' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[width]"]' ).val( '' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[height]"]' ).val( '' );
			}
			if ('link' == theAd.type) {
				$( '#unit-type' ).val( 'link' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[width]"]' ).val( theAd.width );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[height]"]' ).val( theAd.height );
			}
			if ('link-responsive' == theAd.type) {
				$( '#unit-type' ).val( 'link-responsive' );
				$( '#ad-resize-type' ).val( 'auto' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[width]"]' ).val( '' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[height]"]' ).val( '' );
			}
			if ('matched-content' == theAd.type) {
				$( '#unit-type' ).val( 'matched-content' );
				$( '#ad-resize-type' ).val( 'auto' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[width]"]' ).val( '' );
				$( '#advanced-ads-ad-parameters-size input[name="advanced_ad[height]"]' ).val( '' );
			}
			var storedPubId = gadsenseData.pubId;
			if ('' !== storedPubId && theAd.pubId != storedPubId) {
				$( '#adsense-ad-param-error' ).text( gadsenseData.msg.pubIdMismatch );
			} else {
				$( '#adsense-ad-param-error' ).empty();
			}
			$( '#unit-type' ).trigger( 'change' );
			$( '#hide-pastecode-div' ).trigger( 'click' );
		}

		/**
		 * Format the post content field
		 *
		 */
		window.gadsenseFormatAdContent = function () {
			var slotId = $( '#ad-parameters-box #unit-code' ).val();
			if ('' == slotId) { return false; }
			var unitType = $( '#ad-parameters-box #unit-type' ).val();
			var adContent = {
				slotId: slotId,
				unitType: unitType,
			};
			if ('responsive' == unitType) {
				var resize = $( '#ad-parameters-box #ad-resize-type' ).val();
				if (0 == resize) { resize = 'auto'; }
				adContent.resize = resize;
			}
			if ('undefined' != typeof(adContent.resize) && 'auto' != adContent.resize) {
				$( document ).trigger( 'gadsenseFormatAdResponsive', [adContent] );
			}
			if ('undefined' != typeof(window.gadsenseAdContent)) {
				adContent = window.gadsenseAdContent;
				delete( window.gadsenseAdContent );
			}
			$( '#advads-ad-content-adsense' ).val( JSON.stringify( adContent, false, 2 ) );
		}
		
		function advads_update_adsense_type(){
		    var type = $( '#unit-type' ).val();
			if ( 'responsive' == type || 'link-responsive' == type || 'matched-content' == type ) {
				$( '#advanced-ads-ad-parameters-size' ).css( 'display', 'none' );
				$( '#advanced-ads-ad-parameters-size' ).prev('.label').css( 'display', 'none' );
				$( '#advanced-ads-ad-parameters-size' ).next('.hr').css( 'display', 'none' );
			} else if ( 'normal' == type || 'link' == type ) {
				$( '#advanced-ads-ad-parameters-size' ).css( 'display', 'block' );
				$( '#advanced-ads-ad-parameters-size' ).prev('.label').css( 'display', 'block' );
				$( '#advanced-ads-ad-parameters-size' ).next('.hr').css( 'display', 'block' );
			}
			$( document ).trigger( 'gadsenseUnitChanged' );
			window.gadsenseFormatAdContent();
			
			// show / hide position warning
			var position = $( '#advanced-ad-output-position input[name="advanced_ad[output][position]"]:checked' ).val();
			if ('responsive' == type && ( 'left' == position || 'right' == position ) ){
				$('#ad-parameters-box-notices .advads-ad-notice-responsive-position').show();
			} else {
				$('#ad-parameters-box-notices .advads-ad-notice-responsive-position').hide();
			}
		}
		advads_update_adsense_type();

	});

})(jQuery);
