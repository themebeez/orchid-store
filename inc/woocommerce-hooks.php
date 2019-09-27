<?php
/**
 * Load custom woocommerce hooks necessary for theme.
 *
 * @package Orchid_Store
 */

if( ! function_exists( 'orchid_store_product_search_action' ) ) {

	function orchid_store_product_search_action() {

		if( ! class_exists( 'WooCommerce' ) ) {
			return;
		}
		?>
		<div class="custom-search">
	        <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) );?>">
	            <div class="custom-search-entry">
	                <input type="search" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Search Product', 'orchid-store' ); ?>" />
	                <input type="hidden" value="product" name="post_type" id="post_type"/>
	                <button type="submit"><i class='bx bx-search-alt'></i></button>
	            </div><!-- .custom-search-entry -->
	        </form><!-- #searchform -->
	    </div><!-- .custom-search -->
		<?php
	}
}
add_action( 'orchid_store_product_search', 'orchid_store_product_search_action', 10 );

if( ! function_exists( 'orchid_store_wishlist_icon_action' ) ) {

    function orchid_store_wishlist_icon_action() {

        if( function_exists( 'YITH_WCWL' ) ) {
            ?>
            <div class="wishlist-icon-container">
                <a href="<?php echo esc_url( home_url() . '/wishlist' ); ?>"><i class='bx bx-heart'></i></a>
            </div><!-- .wishlist-icon-container -->
            <?php
        }
    }
}
add_action( 'orchid_store_wishlist_icon', 'orchid_store_wishlist_icon_action', 10 );


if( ! function_exists( 'orchid_store_mini_cart_action' ) ) {

	function orchid_store_mini_cart_action() {

		if( ! class_exists( 'WooCommerce' ) ) {

			return;
		}
		?>
		<div class="mini-cart">
            <button class="trigger-mini-cart">
            	<i class='bx bx-cart'></i>
            </button><!-- .trigger-mini-cart -->
            <span class="cart-amount"><?php esc_html_e( 'Total:', 'orchid-store' ); ?>
	            <span class="price">
	                <span class="woocommerce-Price-amount amount">
	                	<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
	            	</span><!-- woocommerce-Price-amount.amount -->
	            </span><!-- .price -->
            </span><!-- .cart-amount -->
            <?php
            if( ! is_cart() && ! is_checkout() ) {
                ?>
                <div class="mini-cart-open">
                    <div class="mini-cart-items">
                        <?php

                        $instance = array( 'title' => '' );

                        the_widget( 'WC_Widget_Cart', $instance );
                        ?>
                    </div><!-- .mini-cart-tems -->
                </div><!-- .mini-cart-open -->
                <?php
            }
            ?>
        </div><!-- .mini-cart -->
		<?php
	}
}
add_action( 'orchid_store_mini_cart', 'orchid_store_mini_cart_action', 10 );


if ( ! function_exists( 'orchid_store_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function orchid_store_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php orchid_store_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}
add_action( 'orchid_store_woocommerce_header_cart', 'orchid_store_woocommerce_template_header_cart', 10 );


if( ! function_exists( 'orchid_store_user_links_action' ) ) {

	function orchid_store_user_links_action() {

		if( ! class_exists( 'WooCommerce' ) && ! function_exists( 'YITH_WCWL' ) ) {

			return;
		}
		?>
        <nav>
            <ul>
            	<?php
            	if( class_exists( 'WooCommerce' ) ) {
            		?>
                    <li>
                    	<?php
                    	if( is_user_logged_in() ) {
                    		?>
                    		<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class='bx bx-user'></i> <?php esc_html_e( 'My account', 'orchid-store' ); ?></a>
                    		<?php
                    	} else {
                    		?>
                    		<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><i class='bx bx-user'></i> <?php esc_html_e( 'Login / Register', 'orchid-store' ); ?></a>
                    		<?php
                    	}
                    	?>
                    </li>
                    <?php
                }
            	if( function_exists( 'YITH_WCWL' ) ) {
            		?>
                	<li><a href="<?php echo esc_url( home_url() . '/wishlist' ); ?>"><i class='bx bx-heart'></i> <?php esc_html_e( 'My Wishlist', 'orchid-store' ); ?></a></li>
                	<?php
                }
                ?>
            </ul>
        </nav>
		<?php
	}
}
add_action( 'orchid_store_user_links', 'orchid_store_user_links_action', 10 );


if( ! function_exists( 'orchid_store_product_categories_list_action' ) ) {

    function orchid_store_product_categories_list_action() {

        if( ! has_nav_menu( 'menu-3' ) ) {
            return;
        }
        ?>
        <div class="category-nav">
            <div class="cat-nav-entry overflow-hidden">
                <?php
                wp_nav_menu( array( 
                    'theme_location' => 'menu-3',
                    'container' => '', 
                    'menu_class' => 'overflow-hidden',
                    'menu_id' => '',
                    'depth' => 1,
                ) );
                ?>
            </div><!-- .cat-nav-entry -->
        </div><!-- .category-nav -->
        <?php
    }
}
add_action( 'orchid_store_product_categories_list', 'orchid_store_product_categories_list_action', 10 );


if ( ! function_exists( 'orchid_store_template_loop_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail for the loop.
     */
    function orchid_store_template_loop_product_thumbnail() {

        /**
         * Hook: orchid_store_loop_product_link_open.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'orchid_store_loop_product_link_open' );

        echo woocommerce_get_product_thumbnail(); // phpcs:ignore.

        /**
         * Hook: orchid_store_loop_product_link_close.
         *
         * @hooked woocommerce_template_loop_product_link_close - 10
         */
        do_action( 'orchid_store_loop_product_link_close' );
    }
}


if( ! function_exists( 'orchid_store_template_loop_product_title' ) ) {

    function orchid_store_template_loop_product_title() {

        /**
         * Hook: orchid_store_loop_product_link_open.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'orchid_store_loop_product_link_open' );

        echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        /**
         * Hook: orchid_store_loop_product_link_close.
         *
         * @hooked woocommerce_template_loop_product_link_close - 10
         */
        do_action( 'orchid_store_loop_product_link_close' );
    }
}

if( ! function_exists( 'orchid_store_template_loop_product_quick_link' ) ) {

    function orchid_store_template_loop_product_quick_link() {

        if( !defined( 'YITH_WCWL' ) && ! defined( 'YITH_WCQV' ) ) {

            return;
        }

        global $product;
        ?>
        <div class="product-hover-items">
            <ul>
                <?php
                if( defined( 'YITH_WCQV' ) ) {
                    ?>
                    <li>
                        <a class="os-tooltip view-product yith-wcqv-button" data-product_id="<?php echo absint( $product->get_id() );?>" data-tippy-content="<?php esc_attr_e( 'Quick view', 'orchid-store' ); ?>" href="#"><i class="bx bx-search"></i></a>
                    </li>
                    <?php
                }
                if( defined( 'YITH_WCWL' ) ) {
                    ?>
                    <li><?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]'); ?></li>
                    <?php
                }
                ?>
            </ul>
        </div><!-- .product-hover-items -->
        <?php
    }
}


if( ! function_exists( 'orchid_store_woocommerce_title_breadcrumb_action' ) ) {

    function orchid_store_woocommerce_title_breadcrumb_action() {

        if( ! class_exists( 'WooCommerce' ) ) {

            return;
        }

        if( is_product() ) {

            return;
        }
        ?>
        <div class="os-breadcrumb-wrap" <?php if( has_header_image() ) { ?>style="background-image: url(<?php header_image(); ?>);" <?php } ?>>
            <div class="__os-container__">
                <div class="breadcrumb-inner">                    
                    <div class="title">
                        <h1 class="entry-title page-title"><?php woocommerce_page_title(); ?></h1>
                    </div><!-- .title -->
                    <div class="os-breadcrumb">
                        <?php
                        /**
                        * Hook - orchid_store_woocommerce_breadcrumb.
                        *
                        * @hooked woocommerce_breadcurmb - 20
                        */
                        do_action( 'orchid_store_woocommerce_breadcrumb' );
                        ?>
                    </div><!-- .os-breadcrumb -->
                </div><!-- .breadcrumb-inner -->
            </div><!-- .os-container -->
             <div class="mask"></div>
        </div><!-- .os-breadcrumb-wrap -->
        <?php
    }
}
add_action( 'orchid_store_woocommerce_title_breadcrumb', 'orchid_store_woocommerce_title_breadcrumb_action', 10 );