<?php
/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */
?>
<header class="masterheader mobile-header header-style-1 mobile-header-style-1">
    <div class="header-inner">
         <?php
            $orchid_store_display_top_header = orchid_store_get_option( 'display_top_header' );
            if( $orchid_store_display_top_header == true ) {
                ?>
                <div class="top-header top-block">
                    <div class="__os-container__">
                        <div class="block-entry os-row">
                            <?php
                                $orchid_store_social_links = orchid_store_get_option( 'top_header_social_links' );

                                if( !empty( $orchid_store_social_links ) ) {

                                    $orchid_store_social_links_array = explode( ',', $orchid_store_social_links );
                                    ?>
                                    <div class="social-icons flex-col">
                                        <ul class="social-icons-list">
                                        <?php
                                            foreach( $orchid_store_social_links_array as $orchid_store_social_link ) {
                                            ?>
                                            <li>
                                                <a href="<?php echo esc_url( $orchid_store_social_link ); ?>"></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div><!-- // social-icons -->
                                    <?php 
                                }
                            ?>
                        </div><!-- // block-entry -->
                    </div><!-- // __os-container__ -->
                </div><!-- // top-block -->
                <?php 
            }
        ?>
        <div class="mid-block">
            <div class="__os-container__">
                <div class="block-entry os-row">
                    <div class="branding flex-col">
                        <?php
                        /**
                        * Hook - orchid_store_mobile_site_identity.
                        *
                        * @hooked orchid_store_mobile_site_identity_action - 10
                        */
                        do_action( 'orchid_store_mobile_site_identity' );
                        ?>
                    </div><!-- .branding flex-col -->
                    <?php 
                        $orchid_store_display_wishlist_icon = orchid_store_get_option( 'display_wishlist' );
                        $orchid_store_display_minicart = orchid_store_get_option( 'display_mini_cart' );

                         if( $orchid_store_display_minicart == true && class_exists( 'WooCommerce' )  || ( $orchid_store_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) {
                            ?>
                            <div class="header-items flex-col">
                                <div class="flex-row">
                                    <?php 

                                     if( ( $orchid_store_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) { 
                                        ?>
                                        <div class="wishlist-column flex-col">
                                            <?php
                                            if( $orchid_store_display_wishlist_icon == true ) {

                                                /**
                                                * Hook - orchid_store_wishlist_icon.
                                                *
                                                * @hooked orchid_store_wishlist_icon_action - 10
                                                */
                                                do_action( 'orchid_store_wishlist_icon' );
                                            }
                                            ?>
                                        </div><!-- // wishlist-column flex-column -->
                                        <?php 
                                    }
                                    
                                    if( ( $orchid_store_display_minicart == true && class_exists( 'WooCommerce' ) ) ) { 
                                        ?>
                                        <div class="minicart-column flex-col">
                                            <?php
                            
                                            if( $orchid_store_display_minicart == true ) {

                                                /**
                                                * Hook - orchid_store_mini_cart.
                                                *
                                                * @hooked orchid_store_mini_cart_action - 10
                                                */
                                                do_action( 'orchid_store_mini_cart' );
                                            }
                                            ?>
                                        </div><!-- // mincart-column flex-col -->
                                        <?php 
                                        }
                                    ?>
                                </div><!-- // flex-row -->
                            </div><!-- // header-items -->
                            <?php 
                        }
                    ?>
                </div><!-- // block-entry -->
            </div><!-- // __os-container__ -->
        </div><!-- // mid-block -->
        <div class="bottom-block">
            <div class="__os-container__">
                <div class="block-entry">
                    <div class="flex-row">
                        <div class="flex-col left">
                        <div class="nav-col">
                            <div class="menu-toggle">
                                <button class="mobile-menu-toggle-btn">
                                    <span class="hamburger-bar"></span>
                                    <span class="hamburger-bar"></span>
                                    <span class="hamburger-bar"></span>
                                </button>
                            </div><!-- .meu-toggle -->
                            <?php
                            /**
                            * Hook - orchid_store_primary_navigation.
                            *
                            * @hooked orchid_store_primary_navigation_action - 10
                            */
                            do_action( 'orchid_store_primary_navigation' );
                            ?>
                        </div><!-- // nav-col -->
                        </div><!-- // flex-col left -->
                        <div class="flex-col right">
                            <div class="flex-row">
                                <?php 
                                $orchid_store_display_special_menu = orchid_store_get_option( 'display_special_menu' );
                                if( $orchid_store_display_special_menu == true ) {
                                    ?>
                                    <div class="cat-menu-col flex-col">
                                         <div class="special-cat-menu">
                                             <button class="cat-nav-trigger">
                                                <span class="icon">
                                                    <span class="line"></span>
                                                    <span class="line"></span>
                                                    <span class="line"></span>
                                                </span>
                                            </button>
                                        </div><!-- // special-cat-menu -->
                                    </div><!-- // cat-menu-col -->
                                    <?php 
                                }

                                if( orchid_store_get_option( 'display_product_search_form_on_mobile' ) == true && orchid_store_get_option( 'display_product_search_form' ) == true ) {
                                    ?>
                                    <div class="search-col flex-col">
                                        <button class="search-toggle"><i class='bx bx-search'></i></button>
                                    </div><!-- // search-col flex-col -->
                                    <?php
                                }
                                ?>
                            </div><!-- // flex-row -->
                        </div><!-- // flex-col right -->
                    </div><!-- // fex-row -->
                </div><!-- // block-entry -->
            </div><!-- // __os-container__ -->
            <?php
            if( orchid_store_get_option( 'display_product_search_form' ) == true && orchid_store_get_option( 'display_product_search_form_on_mobile' ) == true ) {
                ?>
                <div class="mobile-header-search">
                    <?php
                    if( class_exists( 'WooCommerce' ) ) {

                        if( orchid_store_get_option( 'select_search_form' ) == 'product_search' ) {

                            /**
                            * Hook - orchid_store_product_search.
                            *
                            * @hooked orchid_store_product_search_action - 10
                            */
                            do_action( 'orchid_store_product_search' );
                        } else {

                            /**
                            * Hook - orchid_store_default_search.
                            *
                            * @hooked orchid_store_default_search_action - 10
                            */
                            do_action( 'orchid_store_default_search' );
                        }
                    } else {

                        /**
                        * Hook - orchid_store_default_search.
                        *
                        * @hooked orchid_store_default_search_action - 10
                        */
                        do_action( 'orchid_store_default_search' );
                    }  
                    ?>
                </div><!-- // mobile-header-search -->
                <?php
            }

            if( orchid_store_get_option( 'display_special_menu' ) ==  true ) {
                ?>
                <nav class="category-navigation special-navigation">
                    <?php
                    /**
                    * Hook - orchid_store_secondary_navigation.
                    *
                    * @hooked orchid_store_secondary_navigation_action - 10
                    */
                    do_action( 'orchid_store_secondary_navigation' );
                    ?>
                </nav><!-- // special-navigation -->
                <?php
            }
            ?>
        </div><!-- // bottom-block -->
    </div><!-- // header-inner -->
</header><!-- .mobile-header header-style-1 -->
<aside class="mobile-navigation canvas" data-auto-focus="true">
    <div class="canvas-inner">
        <div class="canvas-container-entry">
            <div class="canvas-close-container">
                <button class="trigger-mob-nav-close"><i class='bx bx-x'></i></button>
            </div><!-- // canvas-close-container -->
            <div class="top-header-menu-entry">
                <?php

                $orchid_store_top_header_left_item = orchid_store_get_option( 'display_menu_or_login_register_link' );

                if( $orchid_store_top_header_left_item == 'login_register' ) {
                    /**
                    * Hook - orchid_store_user_links.
                    *
                    * @hooked orchid_store_user_links_action - 10
                    */
                    do_action( 'orchid_store_user_links' );
                } else {
                    /**
                    * Hook - orchid_store_top_header_menu.
                    *
                    * @hooked orchid_store_top_header_menu_action - 10
                    */
                    do_action( 'orchid_store_top_header_menu' );
                }
                ?>
            </div><!-- // secondary-navigation -->
            <div class="mobile-nav-entry">
                <?php
                   /**
                    * Hook - orchid_store_secondary_navigation.
                    *
                    * @hooked orchid_store_secondary_navigation_action - 10
                    */
                    do_action( 'orchid_store_primary_navigation' );
                ?>
            </div><!-- // mobile-nav-entry -->
        </div><!-- // canvas-container-entry -->
    </div><!-- // canvas-inner -->
</aside><!-- // mobile-navigation-canvas -->
<div class="mobile-navigation-mask"></div><!-- // mobile-navigation-mask -->