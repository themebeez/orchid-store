/**
 * File admin-scripts.js.
 *
 * Contains custom admin scripts.
 */

( function( $ ) {

	'use strict';

	jQuery( document ).ready( function() {

		jQuery( 'body' ).on( 'click', '.sldr-elmnt-page', function() {

			if( jQuery( this ).is( ":checked" ) ) {

                var fieldContainer = jQuery( this ).parent().find( '.sldr-elmnt-btn-wrapper' );

                fieldContainer.removeClass( 'sldr-elmnt-btn-wrapper-hide' ).addClass( 'sldr-elmnt-btn-wrapper-show' );

                if( fieldContainer.hasClass( 'os-temp-sldr-fields' ) ) {

                    var titleBtnName = fieldContainer.find( '.original-button-title-name' ).val();
                    var linkBtnName = fieldContainer.find( '.original-button-link-name' ).val();

                    fieldContainer.find( '.sldr-elmnt-btn-title input' ).attr( 'name', titleBtnName );
                    fieldContainer.find( '.sldr-elmnt-btn-link input' ).attr( 'name', linkBtnName );

                    fieldContainer.removeClass( 'os-temp-sldr-fields' );
                    fieldContainer.find( '.original-button-title-name' ).remove();  
                    fieldContainer.find( '.original-button-link-name' ).remove();  
                }
	        } else {

                var fieldContainer = jQuery( this ).parent().find( '.sldr-elmnt-btn-wrapper' );

                fieldContainer.removeClass( 'sldr-elmnt-btn-wrapper-show' ).addClass( 'sldr-elmnt-btn-wrapper-hide' );

                fieldContainer.find( '.sldr-elmnt-btn-title input' ).attr( 'name', 'temp_button_titles' );
                fieldContainer.find( '.sldr-elmnt-btn-link input' ).val( 'name', 'temp_button_links' );
	        }
		} );

		jQuery( 'body' ).on( 'click', '.show-offer-contents', function() {

			if( jQuery( this ).is( ":checked" ) ) {
				jQuery( '.os-elements-container-wrapper' ).removeClass( 'hide-wrapper' ).addClass( 'show-wrapper' );
			} else {
				jQuery( '.os-elements-container-wrapper' ).removeClass( 'show-wrapper' ).addClass( 'hide-wrapper' );
			}
		} );

		/**
		 * Function for image upload in admin
		 */
		function media_upload( button_class ) {

            var _custom_media = false,

            _orig_send_attachment = wp.media.editor.send.attachment;

            jQuery('body').on( 'click', button_class, function(e) {

            	var currentBtn = jQuery( this );

                var button_id ='#'+jQuery(this).attr('id');

                var self = jQuery(button_id);

                var send_attachment_bkp = wp.media.editor.send.attachment;

                var button = jQuery(button_id);

                var id = button.attr('id').replace('_button', '');

                _custom_media = true;

                wp.media.editor.send.attachment = function(props, attachment){

                    if ( _custom_media  ) {

                        currentBtn.parent( '.os-image-uploader-container' ).find( '.os-upload-image-url-holder' ).val(attachment.url).trigger('change');

                        currentBtn.parent( '.os-image-uploader-container' ).find( '.os-upload-image-holder' ).css( 'background-image', 'url('+attachment.url+')' );

                        currentBtn.parent( '.os-image-uploader-container' ).find( '.os-remove-btn' ).removeClass( 'os-btn-hide' ).addClass( 'os-btn-show' );

                        currentBtn.removeClass( 'os-btn-show' ).addClass( 'os-btn-hide' );

                    } else {

                        return _orig_send_attachment.apply( button_id, [props, attachment] );
                    }
                }

                wp.media.editor.open(button);

                return false;
            });
        }

        media_upload('.os-upload-btn');

        jQuery( 'body' ).on( 'click', '.os-remove-btn', function(e) {

            e.preventDefault();

            jQuery( this ).parent( '.os-image-uploader-container' ).find( '.os-upload-image-url-holder' ).val('').trigger('change');

            jQuery( this ).parent( '.os-image-uploader-container' ).find( '.os-upload-image-holder' ).css( 'background-image', 'url()' );

            jQuery( this ).parent( '.os-image-uploader-container' ).find( '.os-upload-btn' ).removeClass( 'os-btn-hide' ).addClass( 'os-btn-show' );

            jQuery( this ).removeClass( 'os-btn-show' ).addClass( 'os-btn-hide' );
        } );

        jQuery( 'body' ).on( 'click', '.os-collapse-icon', function(e) {

            e.preventDefault();

            jQuery( this ).parents( '.os-fields-wrapper' ).find( '.os-fields' ).slideToggle();
        } );

	} );
} )( jQuery );