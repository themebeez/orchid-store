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
                            * Hook - orchid_store_user_links.
                            *
                            * @hooked orchid_store_user_links_action - 10
                            */
                            do_action( 'orchid_store_user_links' );
                            ?>
                        </div><!-- .topbar-items -->
                    </div><!-- .os-col.left-col -->
                    <?php
                    $social_links = orchid_store_get_option( 'top_header_social_links' );

                    if( !empty( $social_links ) ) {

                        $social_links_array = explode( ',', $social_links );
                        ?>
                        <div class="os-col right-col">
                             <div class="social-icons">
                                <ul class="social-icons-list">
                                    <?php
                                    foreach( $social_links_array as $social_link ) {
                                        ?>
                                        <li>
                                            <a href="<?php echo esc_url( $social_link ); ?>"></a>
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
                            ?>
                            <div class="wishlist-minicart-wrapper">
                                <div class="wishlist-minicart-inner">
                                <?php
                                /**
                                * Hook - orchid_store_wishlist_icon.
                                *
                                * @hooked orchid_store_wishlist_icon_action - 10
                                */
                                do_action( 'orchid_store_wishlist_icon' );

                                /**
                                * Hook - orchid_store_mini_cart.
                                *
                                * @hooked orchid_store_mini_cart_action - 10
                                */
                                do_action( 'orchid_store_mini_cart' );
                                ?>
                                </div><!-- . wishlist-minicart-inner -->
                            </div>
                        </div><!-- .aside-right -->
                    </div><!-- .os-col.extra-col -->
                </div><!-- .os-row -->
            </div><!-- .__os-container__ -->
        </div><!-- .mid-header -->
        <div class="bottom-header">
            <div class="main-navigation"> 
                <div class="__os-container__">
                    <div class="os-row os-nav-row">
                        <div class="os-col os-nav-col-left">
                            <div class="category-navigation">
                                <button class="cat-nav-trigger">
                                    <span class="title">All departments</span>
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
                        <div class="os-col os-nav-col-right">
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
                    </div><!-- // os-col os-nav-col-right -->
                </div><!-- // os-row os-nav-row -->
                </div><!-- .__os-container__ -->
            </div><!-- .main-navigation -->
        </div><!-- .bottom-header -->
    </div><!-- .header-inner -->
</header><!-- .masterheader.header-style-1 -->