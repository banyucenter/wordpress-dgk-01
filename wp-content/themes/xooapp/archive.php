<?php
/**
* The template for displaying archive pages
*
* Used to display archive-type pages if nothing more specific matches a query.
* For example, puts together date-based pages if no date.php file exists.
*
* If you'd like to further customize these archive views, you may create a
* new template file for each one. For example, tag.php (Tag archives),
* category.php (Category archives), author.php (Author archives), etc.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package WordPress
* @subpackage Xooapp
* @since XooApp 1.0
*/

get_header('custom'); ?>


<!-- Start Blog Page -->
<div id="blog-page" class="blog-page-section">

  <div class="container blog-container">
    <!-- Blog listing page -->
    <div class="post-listing">
        <div class="row justify-content-md-center">
        
        <!-- Blog Content area -->
        <?php if ( have_posts() ) : ?>

          <?php 
          if( function_exists( 'xooapp_framework_init' ) ) {
            $blog_layout = xooapp_get_option('blog_layout');
            if ( $blog_layout == 'left-sidebar' ) {
              get_sidebar();
              $col   = '9';
              $p = 'p-left-60';
            } elseif ( $blog_layout == 'right-sidebar' ) {
              $col   = '9';
              $p = 'p-right-60';
            } elseif ( $blog_layout == 'full-width' ) {
              $col   = '12';
              $p = '';
            } else {
              $col   = '9';
              $p = 'p-right-60';
            }
          } else {
            $col   = '9';
            $p = 'p-right-60';
          }
          ?>

          <main class="site-main col-md-12 col-lg-<?php echo esc_attr($col); ?> <?php echo esc_attr($p) ?>">

            <div class="posts-holder">
              <!-- ========== blog - start ========== -->

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

                <?php echo xooapp_paging_nav(); ?>

                <!-- ========== blog - end ========== -->
              </div>

            </main>

            <!-- Start Blog Sidebar -->
            <?php 
            if( function_exists( 'xooapp_framework_init' ) ) {
              $blog_layout = xooapp_get_option('blog_layout');
              if ( $blog_layout == 'left-sidebar' ||  $blog_layout == 'right-sidebar' ) {
                get_sidebar();
              } elseif ($blog_layout == 'full-width') {

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
        <!--/ Blog listing page -->
      </div>
    </div>
    <!--/ Blog Area -->

    <?php get_footer(); ?>