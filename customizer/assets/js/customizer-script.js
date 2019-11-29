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