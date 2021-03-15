<?php
/**
 * The template for displaying all single posts.
 *
 * @package xooapp
 */

get_header('custom'); 

?>

<!-- Start Blog Page -->
<div id="single-post-page" class="single-post-section">
    <div class="container">
        <div class="row justify-content-md-center">
           <?php if ( have_posts() ) : ?>

            <?php 
            if( function_exists( 'xooapp_framework_init' ) ) {
                $blog_layout = xooapp_get_option('blog_layout');
                if ( $blog_layout == 'left-sidebar' ) {
                    get_sidebar();
                    $col = '9';
                } elseif ( $blog_layout == 'right-sidebar' ) {
                    $col = '9';
                } elseif ( $blog_layout == 'full-width' ) {
                    $col = '12';
                } else {
                    $col = '9';
                }
            } else {
                $col = '9';
            }
            ?>

            <main id="primary" class="site-main post-holder p-right-30 col-md-12 col-lg-<?php echo esc_attr($col); ?>">

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );
                    ?>
                <?php endwhile; ?>

                <?php 
                if ( comments_open() || get_comments_number() ) : ?>
                    <div class="comment-section">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </main>

            <!-- Start Blog Sidebar -->
            <?php 
            
            if( function_exists( 'xooapp_framework_init' ) ) {

                $blog_layout = xooapp_get_option('blog_layout');
                if ( ( $blog_layout == 'left-sidebar' ||  $blog_layout == 'right-sidebar' ) ) {
                    get_sidebar();
                } else {
                    get_sidebar();
                }
            } else {
                get_sidebar();
            }
            ?>

            <?php else : ?>

                <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>

        </div>
    </div>
</div>
<!--/ Blog Area -->


<?php get_footer(); ?>