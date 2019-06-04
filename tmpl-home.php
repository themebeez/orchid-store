<?php
/**
 * Template Name: Frontpage 
 *
 * This is a custom page template. It is for setting up frontpage with frontpage widgets.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */

get_header();

if( is_active_sidebar( 'sidebar-2' ) ) {
	
	dynamic_sidebar( 'sidebar-2' );
}

get_footer();