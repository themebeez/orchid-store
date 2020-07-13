<?php
/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */


?>
<header class="masterheader desktop-header header-style-1">
    <div class="header-inner">
        <?php
        $orchid_store_display_top_header = orchid_store_get_option( 'display_top_header' );
        if( $orchid_store_display_top_header == true ) {
            ?>
            <div class="top-header">
                <div class="__os-container__">
                    <div class="os-row">
                        <div class="os-col left-col">
                           <div class="topbar-items">
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
                            </div><!-- .topbar-items -->
                        </div><!-- .os-col.left-col -->
                        <?php
                        $orchid_store_social_links = orchid_store_get_option( 'top_header_social_links' );

                        if( !empty( $orchid_store_social_links ) ) {

                            $orchid_store_social_links_array = explode( ',', $orchid_store_social_links );
                            ?>
                            <div class="os-col right-col">
                                 <div class="social-icons">
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
                            </div><!-- .os-col.right-col -->
                            <?php
                        }
                        ?>
                    </div><!-- .os-row -->
                </div><!-- .__os-container__ -->
            </div><!-- .top-header -->
            <?php
        }
        ?>
        <div class="mid-header">
            <div class="__os-container__">
                <div class="os-row <?php orchid_store_logo_row_class(); ?>">
                    <div class="os-col logo-col">
                        <?php
                        /**
                        * Hook - orchid_store_desktop_site_identity.
                        *
                        * @hooked orchid_store_desktop_site_identity_action - 10
                        */
                        do_action( 'orchid_store_desktop_site_identity' );
                        ?>
                    </div><!-- .os-col.logo-col -->
                    <?php
                    $orchid_store_display_product_search = orchid_store_get_option( 'display_product_search_form' );
                    $orchid_store_display_wishlist_icon = orchid_store_get_option( 'display_wishlist' );
                    $orchid_store_display_minicart = orchid_store_get_option( 'display_mini_cart' );

                    if( $orchid_store_display_product_search == true || ( ( $orchid_store_display_minicart == true && class_exists( 'WooCommerce' ) ) || ( $orchid_store_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) ) {
                        ?>
                        <div class="os-col extra-col">
                            <div class="aside-right">
                                <?php
                                if( $orchid_store_display_product_search == true ) {

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
                                }

                                if( ( $orchid_store_display_minicart == true && class_exists( 'WooCommerce' ) ) || ( $orchid_store_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) { 
                                    ?>
                                    <div class="wishlist-minicart-wrapper">
                                        <div class="wishlist-minicart-inner">
                                        <?php
                                        if( $orchid_store_display_wishlist_icon == true ) {

                                            /**
                                            * Hook - orchid_store_wishlist_icon.
                                            *
                                            * @hooked orchid_store_wishlist_icon_action - 10
                                            */
                                            do_action( 'orchid_store_wishlist_icon' );
                                        }

                                        if( $orchid_store_display_minicart == true ) {

                                            /**
                                            * Hook - orchid_store_mini_cart.
                                            *
                                            * @hooked orchid_store_mini_cart_action - 10
                                            */
                                            do_action( 'orchid_store_mini_cart' );
                                        }
                                        ?>
                                        </div><!-- . wishlist-minicart-inner -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- .aside-right -->
                        </div><!-- .os-col.extra-col -->
                        <?php
                    }
                    ?>
                </div><!-- .os-row -->
            </div><!-- .__os-container__ -->
        </div><!-- .mid-header -->
        <div class="bottom-header">
            <div class="main-navigation"> 
                <div class="__os-container__">
                    <div class="os-row os-nav-row <?php orchid_store_menu_row_class(); ?>">
                        <?php
                        $orchid_store_display_special_menu = orchid_store_get_option( 'display_special_menu' );
                        if( $orchid_store_display_special_menu == true ) {
                            ?>
                            <div class="os-col os-nav-col-left">
                                <div class="category-navigation">
                                    <button class="cat-nav-trigger">
                                        <?php
                                        $orchid_store_special_menu_title = orchid_store_get_option( 'special_menu_title' );
                                        if( !empty( $orchid_store_special_menu_title ) ) {
                                            ?>
                                            <span class="title"><?php echo esc_html( $orchid_store_special_menu_title ); ?></span>
                                            <?php
                                        }
                                        ?>
                                        <span class="icon">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                        </span>
                                    </button><!-- . cat-nav-trigger -->
                                    
                                    <?php
                                    /**
                                    * Hook - orchid_store_secondary_navigation.
                                    *
                                    * @hooked orchid_store_secondary_navigation_action - 10
                                    */
                                    do_action( 'orchid_store_secondary_navigation' );
                                    ?>
                                </div><!-- .site-navigation category-navigation -->
                            </div><!-- .os-col.os-nav-col-left -->
                            <?php
                        }
                        ?>
                        <div class="os-col os-nav-col-right">
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
                        </div><!-- // os-col os-nav-col-right -->
                    </div><!-- // os-row os-nav-row -->
                </div><!-- .__os-container__ -->
            </div><!-- .main-navigation -->
        </div><!-- .bottom-header -->
    </div><!-- .header-inner -->
</header><!-- .masterheader.header-style-1 -->