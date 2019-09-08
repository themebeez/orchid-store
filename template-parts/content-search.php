<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Orchid_Store
 */
$show_categories    = orchid_store_get_option( 'search_display_cats' );
$show_excerpt       = orchid_store_get_option( 'search_display_excerpt' );
$show_author        = orchid_store_get_option( 'search_display_author' );
$show_date          = orchid_store_get_option( 'search_display_date' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="os-row">
        <?php
        if( has_post_thumbnail() ) {
            ?>
            <div class="os-col thumb-col">
                <div class="thumb imghover">
                    <a href="<?php the_permalink(); ?>">
                    	<?php 
                    	the_post_thumbnail( 'orchid-store-thumbnail-extra-large', array(
    						'alt' => the_title_attribute( array(
    							'echo' => false,
    						) ),
    					) ); 
    					?>
    			</a>
                </div><!-- .thumb.imghover -->
            </div><!-- .os-col.thumb-col -->
            <?php
        }
        ?>
        <div class="os-col content-col">
            <div class="box">
                <?php
                if( $show_categories == true ) {
                    /**
                    * Hook - orchid_store_post_categories.
                    *
                    * @hooked orchid_store_post_categories_action - 10
                    */
                    do_action( 'orchid_store_post_categories' );
                }
                ?>
                <div class="title">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div><!-- .title -->
                <?php
                if( $show_excerpt == true ) {
                    /**
                    * Hook - orchid_store_excerpt.
                    *
                    * @hooked orchid_store_excerpt_action - 10
                    */
                    do_action( 'orchid_store_excerpt' );
                }

                if( $show_author == true || $show_date == true ) {
                    ?>
                    <div class="entry-metas">
                        <ul>
                            <?php
                            if( $show_author == true ) {
                                /**
                                * Hook - orchid_store_post_author.
                                *
                                * @hooked orchid_store_post_author_action - 10
                                */
                                do_action( 'orchid_store_post_author' );
                            }

                            if( $show_date == true ) {
                                /**
                                * Hook - orchid_store_post_date.
                                *
                                * @hooked orchid_store_post_date_action - 10
                                */
                                do_action( 'orchid_store_post_date' );
                            }
                            ?>
                        </ul>
                    </div><!-- .entry-metas -->
                    <?php
                }
                ?>
            </div><!-- .box -->
        </div><!-- .os-col -->
    </div><!-- .os-row -->
</article><!-- #post-<?php the_ID(); ?> -->
