<?php
/**
 * Load custom woocommerce hooks necessary for theme.
 *
 * @package Orchid_Store
 */

if( ! function_exists( 'orchid_store_product_search_action' ) ) {

	function orchid_store_product_search_action() {

        $mobile_product_search_class = '';

        if( orchid_store_get_option( 'display_product_search_form_on_mobile' ) ) {

            $mobile_product_search_class = 'os-mobile-show';
        }
		?>
		<div class="custom-search <?php echo esc_attr( $mobile_product_search_class ); ?>">
	        <?php get_product_search_form(); ?>
	    </div><!-- .custom-search -->
		<?php
	}
}
add_action( 'orchid_store_product_search', 'orchid_store_product_search_action', 10 );

if( ! function_exists( 'orchid_store_wishlist_icon_action' ) ) {

    function orchid_store_wishlist_icon_action() {

        if ( ! class_exists( 'YITH_WCWL' ) ) {
            return;
        }

        $wishlist_page_url = orchid_store_get_yith_wishlist_page_url();

        if ( $wishlist_page_url ) {
            ?>
            <div class="wishlist-icon-container">
                <a href="<?php echo esc_url( $wishlist_page_url ); ?>"><i class='bx bx-heart'></i> 
                    <?php if ( orchid_store_get_option( 'display_wishlist_items_count' ) ) { ?>
                        <span class="item-count wishlist-items-count"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></span>
                    <?php } ?>
                </a>
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
                <?php if ( orchid_store_get_option( 'display_cart_items_count' ) ) { ?>
                    <span class="item-count cart-items-count"><?php echo WC()->cart->get_cart_contents_count(); ?><span>
                <?php } ?>
            </button><!-- .trigger-mini-cart -->
            <span class="cart-amount"><?php esc_html_e( 'Total:', 'orchid-store' ); ?>
	            <span class="price">	                
                    <span class="woocommerce-Price-amount amount os-minicart-amount"><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?></span>
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

		if( ! class_exists( 'WooCommerce' ) && ! class_exists( 'YITH_WCWL' ) ) {

			return;
		}
		?>
        <nav class="login_register_link">
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
            	if( class_exists( 'YITH_WCWL' ) ) {

                    $wishlist_page_url = orchid_store_get_yith_wishlist_page_url();
                    if ( $wishlist_page_url ) {
                		?>
                    	<li><a href="<?php echo esc_url( $wishlist_page_url ); ?>"><i class='bx bx-heart'></i> <?php esc_html_e( 'My Wishlist', 'orchid-store' ); ?></a></li>
                       	<?php
                    }
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

        global $product;

        if( get_theme_mod( 'orchid_store_field_display_out_of_stock_notice', false ) == true ) {

            if( ! $product->is_in_stock() ) {

                echo wc_get_stock_html( $product );
            }
        }

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

        echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . wp_kses_post( get_the_title() ) . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

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

        if( !class_exists( 'YITH_WCWL' ) && ! class_exists( 'YITH_WCQV' ) ) {

            return;
        }

        global $product;
        ?>
        <div class="product-hover-items">
            <ul>
                <?php
                if( class_exists( 'YITH_WCQV' ) ) {
                    ?>
                    <li>
                        <a class="os-tooltip view-product yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() );?>" data-tippy-content="<?php echo esc_attr( get_option( 'yith-wcqv-button-label' ) ); ?>" href="#"><i class="bx bx-search"></i></a>
                    </li>
                    <?php
                }
                if( class_exists( 'YITH_WCWL' ) ) {
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

            $display_breadcrumb = orchid_store_get_option( 'display_breadcrumb' );

            if( $display_breadcrumb == true ) {
                ?>
                <div class="os-page-breadcrumb-wrap">
                    <div class="__os-container__">
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
                    </div><!-- .__os-container__ -->
                </div><!-- .os-product-single-breadcrumb-wrap -->
                <?php
            }

        } else {

            if( orchid_store_get_option( 'display_page_header' ) == true ) {
                ?>
                <div class="os-breadcrumb-wrap" <?php if( has_header_image() ) { ?>style="background-image: url(<?php header_image(); ?>);" <?php } ?>>
                    <div class="__os-container__">
                        <div class="breadcrumb-inner">                    
                            <div class="title">
                                <h1 class="entry-title page-title"><?php woocommerce_page_title(); ?></h1>
                            </div><!-- .title -->
                            <?php
                            $display_breadcrumb = orchid_store_get_option( 'display_breadcrumb' );

                            if( $display_breadcrumb == true ) {
                                ?>
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
                                <?php
                            }
                            ?>
                        </div><!-- .breadcrumb-inner -->
                    </div><!-- .os-container -->
                     <div class="mask"></div>
                </div><!-- .os-breadcrumb-wrap -->
                <?php
            } else {
                
                $display_breadcrumb = orchid_store_get_option( 'display_breadcrumb' );

                if( $display_breadcrumb == true ) {
                    ?>
                    <div class="os-page-breadcrumb-wrap">
                        <div class="__os-container__">
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
                        </div><!-- .__os-container__ -->
                    </div><!-- .os-product-single-breadcrumb-wrap -->
                    <?php
                }
            }
        }
    }
}
add_action( 'orchid_store_woocommerce_title_breadcrumb', 'orchid_store_woocommerce_title_breadcrumb_action', 10 );



if( ! function_exists( 'orchid_store_quantity_minus' ) ) {

    function orchid_store_quantity_minus() {
        
        global $product;

        if( $product->is_sold_individually() ) {

            return;
        }
        ?>
        <div class="os-quantity-wrapper">
            <button type="button" class="woo-quantity-btn woo-quantity-minus" ><i class='bx bx-minus' ></i></button>
       <?php
    }
}


if( ! function_exists( 'orchid_store_quantity_plus' ) ) {

    function orchid_store_quantity_plus() {

        global $product;

        if( $product->is_sold_individually() ) {

            return;
        }
        ?>
        
            <button type="button" class="woo-quantity-btn woo-quantity-plus" ><i class='bx bx-plus'></i></button>
        </div>
       <?php
    }
}


if( ! function_exists( 'orchid_store_get_woocommerce_sidebar' ) ) {

    function orchid_store_get_woocommerce_sidebar() {
        
        $sidebar_position = orchid_store_sidebar_position();

        if( $sidebar_position == 'none' ) {

            return;
        }
        ?>
        <div class="<?php orchid_store_sidebar_class(); ?>">
            <aside id="secondary" class="secondary-widget-area os-woocommerce-sidebar">
                <?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
            </aside><!-- #secondary -->
        </div><!-- .col -->
        <?php
    }
}


if ( ! function_exists( 'orchid_store_get_yith_wishlist_page_url' ) ) {

    function orchid_store_get_yith_wishlist_page_url() {

        if ( ! class_exists( 'YITH_WCWL' ) ) {
            return;
        }

        $wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );

        if ( $wishlist_page_id ) {

            return get_page_link( absint( $wishlist_page_id ) );
        }
    }
}



if ( defined( 'YITH_WCWL' ) && ! function_exists( 'orchid_store_update_wishlist_count' ) ) {

    function orchid_store_update_wishlist_count() {

        wp_send_json( array(
            'count' => yith_wcwl_count_all_products()
        ) );
    }
    add_action( 'wp_ajax_orchid_store_update_wishlist_count', 'orchid_store_update_wishlist_count' );
    add_action( 'wp_ajax_nopriv_orchid_store_update_wishlist_count', 'orchid_store_update_wishlist_count' );
}



if ( ! function_exists( 'orchid_store_refresh_cart_count' ) ) {

    function orchid_store_refresh_cart_count( $fragments ) {
        ob_start();
            ?>
            <span class="item-count cart-items-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            <?php
            $fragments['.trigger-mini-cart span.cart-items-count'] = ob_get_clean();
            return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'orchid_store_refresh_cart_count' );
}