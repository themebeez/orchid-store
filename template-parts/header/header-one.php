<?php
/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */
?>
<header class="masterheader header-style-1">
    <div class="header-inner">
        <div class="top-header">
            <div class="__os-container__">
                <div class="os-row">
                    <div class="os-col left-col">
                        <div class="topbar-items">
                            <?php
                            /**
                            * Hook - orchid_store_secondary_navigation.
                            *
                            * @hooked orchid_store_secondary_navigation_action - 10
                            */
                            do_action( 'orchid_store_secondary_navigation' );
                            ?>
                        </div><!-- .topbar-items -->
                    </div><!-- .os-col.left-col -->
                    <div class="os-col right-col">
                        <div class="topbar-items">
                            <?php
                            /**
                            * Hook - orchid_store_user_links.
                            *
                            * @hooked orchid_store_user_links_action - 10
                            */
                            do_action( 'orchid_store_user_links' );
                            ?>
                        </div><!-- .topbar-items -->
                    </div><!-- .os-col.right-col -->
                </div><!-- .os-row -->
            </div><!-- .__os-container__ -->
        </div><!-- .top-header -->
        <div class="mid-header">
            <div class="__os-container__">
                <div class="os-row">
                    <div class="os-col logo-col">
                        <?php
                        /**
                        * Hook - orchid_store_site_identity.
                        *
                        * @hooked orchid_store_site_identity_action - 10
                        */
                        do_action( 'orchid_store_site_identity' );
                        ?>
                    </div><!-- .os-col.logo-col -->
                    <div class="os-col extra-col">
                        <div class="aside-right">
                            <?php
                            /**
                            * Hook - orchid_store_product_search.
                            *
                            * @hooked orchid_store_product_search_action - 10
                            */
                            do_action( 'orchid_store_product_search' );

                            /**
                            * Hook - orchid_store_mini_cart.
                            *
                            * @hooked orchid_store_mini_cart_action - 10
                            */
                            do_action( 'orchid_store_mini_cart' );
                            ?>
                        </div><!-- .aside-right -->
                    </div><!-- .os-col.extra-col -->
                </div><!-- .os-row -->
            </div><!-- .__os-container__ -->
        </div><!-- .mid-header -->
        <div class="bottom-header">
            <div class="main-navigation">
                <div class="__os-container__">
                    <div class="menu-toggle">
                        <span class="hamburger-bar"></span>
                        <span class="hamburger-bar"></span>
                        <span class="hamburger-bar"></span>
                    </div><!-- .meu-toggle -->
                    <?php
                    /**
                    * Hook - orchid_store_primary_navigation.
                    *
                    * @hooked orchid_store_primary_navigation_action - 10
                    */
                    do_action( 'orchid_store_primary_navigation' );
                    ?>
                </div><!-- .__os-container__ -->
            </div><!-- .main-navigation -->
        </div><!-- .bottom-header -->
    </div><!-- .header-inner -->
</header><!-- .masterheader.header-style-1 -->