( function($) {

	jQuery( document ).ready( function() {

		function customizer_label( id, title ) {

			$( '#customize-control-'+ id ).prepend('<p class="option-group-title customize-control"><strong>'+ title +'</strong></p>');
		}

		customizer_label( 'custom_logo', fieldHeaders.logo_setup );
		customizer_label( 'site_icon', fieldHeaders.favicon );
		customizer_label( 'orchid_store_field_enable_home_content', fieldHeaders.home_content );
		customizer_label( 'orchid_store_field_blog_display_cats', fieldHeaders.post_meta );
		customizer_label( 'orchid_store_field_archive_display_cats', fieldHeaders.post_meta );
		customizer_label( 'orchid_store_field_search_display_cats', fieldHeaders.post_meta );
		customizer_label( 'orchid_store_field_display_post_cats', fieldHeaders.post_meta );
		customizer_label( 'orchid_store_field_blog_sidebar_position', fieldHeaders.sidebar );
		customizer_label( 'orchid_store_field_archive_sidebar_position', fieldHeaders.sidebar );
		customizer_label( 'orchid_store_field_search_sidebar_position', fieldHeaders.sidebar );
		customizer_label( 'orchid_store_field_enable_global_sidebar_position', fieldHeaders.sidebar );
		customizer_label( 'orchid_store_field_enable_post_common_sidebar_position', fieldHeaders.sidebar );
		customizer_label( 'orchid_store_field_enable_page_common_sidebar_position', fieldHeaders.sidebar );
		customizer_label( 'orchid_store_field_enable_parallax_page_header_background', fieldHeaders.breadcrumb_background );
		customizer_label( 'background_color', fieldHeaders.body_background );

		// Install and activate AFC plugin. @since 1.4.2
		jQuery('body').on( 'click', '#os-install-afc', function(event) {
			event.preventDefault();

			jQuery('#os-afc-error').addClass('afc-hide').removeClass('afc-display');

			var thisButton = jQuery(this);

			thisButton.attr('disabled', 'disabled');

			thisButton.html(fieldHeaders.installingPlugin);
			//jQuery ajax POST request code
			var data = {
				action: 'wp_ajax_install_plugin',
				_ajax_nonce: fieldHeaders.plugin_nonce, // nonce
				slug: 'addonify-floating-cart', // e.g. woocommerce
			};

			jQuery.post( fieldHeaders.ajax_url, data, function (response) {

				// console.log(response);

				if (response.success === true) {

					thisButton.html(fieldHeaders.installedPlugin);

					setTimeout(function() {

						thisButton.html(fieldHeaders.activatingPlugin);
					}, 1500);
					

					setTimeout(function () {
						var data = {
							action: 'orchid_store_activate_plugin',
							_ajax_nonce: fieldHeaders.plugin_nonce
						};

						jQuery.post(fieldHeaders.ajax_url, data, function (response) {
							// console.log(response);
							if (response.success === true) {

								thisButton.html(fieldHeaders.activatedPlugin);

								setTimeout(function(){
									jQuery('#os-afc-install').removeClass('afc-display').addClass('afc-hide');
									jQuery('#os-afc-activated').addClass('afc-display').removeClass('afc-hide');
								}, 1500 );
								
							} else {
								jQuery('#os-afc-error p').html(response.message);
								jQuery('#os-afc-error').removeClass('afc-hide').addClass('afc-display');
							}
						});
					}, 1500 );					
				} else {
					jQuery('#os-afc-error p').html( response.errorMessage );
					jQuery('#os-afc-error').removeClass('afc-hide').addClass('afc-display');
				}
			} );
		});
		
		// Activate AFC plugin. @since 1.4.2
		jQuery('body').on( 'click', '#os-activate-afc', function(event) {

			event.preventDefault();

			var thisButton = jQuery(this);

			thisButton.html(fieldHeaders.activatingPlugin);

			thisButton.attr('disabled', 'disabled');

			jQuery('#os-afc-error').addClass('afc-hide').removeClass('afc-display');

			var data = {
				action: 'orchid_store_activate_plugin',
				_ajax_nonce: fieldHeaders.plugin_nonce
			};

			jQuery.post( fieldHeaders.ajax_url, data, function (response) {
				// console.log(response);
				if (response.success === true) {

					thisButton.html(fieldHeaders.activatedPlugin);

					setTimeout(function () {
						jQuery('#os-afc-activate').removeClass('afc-display').addClass('afc-hide');
						jQuery('#os-afc-activated').addClass('afc-display').removeClass('afc-hide');
					}, 1500);
				} else {
					jQuery('#os-afc-error p').html(response.message);
					jQuery('#os-afc-error').removeClass('afc-hide').addClass('afc-display');
				}
			} );
		});
	} );

	wp.customize.sectionConstructor['wptrt-customize-pro'] = wp.customize.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );




} ) ( jQuery );