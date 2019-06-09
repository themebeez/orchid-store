<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Orchid_Store
 */

get_header();
?>
<div class="inner-page-wrap error-404-wrap">
    <?php
    /**
    * Hook - orchid_store_title_breadcrumb.
    *
    * @hooked orchid_store_title_breadcrumb_action - 10
    */
    do_action( 'orchid_store_title_breadcrumb' );
    ?>
    <div class="inner-entry">
        <div id="primary" class="content-area">
            <div id="main" class="site-main">
                <div class="__os-container__">
                    <div class="entry-404">
                        <div class="top-block">
                            <div class="title">
                                <h1 class="entry-title"><?php esc_html_e( '4', 'orchid-store' ); ?><span><?php esc_html_e( '0', 'orchid-store' ); ?></span><?php esc_html_e( '4', 'orchid-store' ); ?></h1>
                            </div><!-- .title -->
                            <div class="sub-title">
                                <h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'orchid-store' ); ?></h2>
                            </div><!-- .sub-title -->
                            <div class="excerpt">
                                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'orchid-store' ); ?></p>
                            </div><!-- .excerpt -->
                        </div><!-- .top-block -->
                        <div class="bottom-block">
                            <div class="search-form-entry">
                                <?php get_search_form(); ?>
                            </div>
                        </div><!-- .bottom-block -->
                    </div><!-- .entry-404 -->
                </div><!-- .__os-container__ -->
            </div><!-- #main.site-main -->
        </div><!-- #primary.content-area -->
    </div><!-- .inner-entry -->
</div><!-- .inner-page-wrap -->
<?php
get_footer();
