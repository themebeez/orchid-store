<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="inner-page-wrap __os-woo-page-wrap__">
	<?php
    /**
	* Hook - orchid_store_woocommerce_title_breadcrumb.
	*
	* @hooked orchid_store_woocommerce_title_breadcrumb_action - 10
	*/
	do_action( 'orchid_store_woocommerce_title_breadcrumb' );
	?>
	<div class="inner-entry">
		<div class="__os-container__">
			<div class="row">
				<div class="<?php orchid_store_content_container_class(); ?>">
                    <div id="primary" class="content-area">
                        <div id="main" class="site-main">
                            <div class="<?php orchid_store_content_entry_class(); ?>">
                            	<?php
								if( orchid_store_get_option( 'display_page_header' ) == false && ! is_product() ) {
			                		?>
			                		<h1 class="entry-title page-title"><?php woocommerce_page_title(); ?></h1>
			                		<?php
			                	}