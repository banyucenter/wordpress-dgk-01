<?php
/**
 * The template for displaying search results pages.
 *
 * @package xooapp
 */

get_header('custom'); ?>


<!-- Start Blog Page -->
<div id="blog-page" class="blog-page-section">

  

  <div class="container blog-container">
    <!-- Blog listing page -->
    <div class="post-listing">
      <div class="row">
        <!-- Blog Content area -->

        <?php 
        if( function_exists( 'xooapp_framework_init' ) ) {
          $blog_layout = xooapp_get_option('blog_layout');
          if ( $blog_layout == 'left-sidebar' ) {
            get_sidebar();
            $col   = '9';
          } elseif ( $blog_layout == 'right-sidebar' ) {
            $col   = '9';
          } elseif ( $blog_layout == 'full-width' ) {
            $col   = '12';
          } else {
            $col   = '9';
          }
        } else {
          $col   = '9';
        }
        ?>

        <main class="site-main col-md-12 col-lg-<?php echo esc_attr($col); ?>">


          <div class="posts-holder p-right-60">

            <!-- ========== blog - start ========== -->
            <?php if ( have_posts() ) : ?>
             <?php while ( have_posts() ) : the_post(); ?>
              <?php
            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'template-parts/content', 'search' );
            ?>

          <?php endwhile; ?>

          <?php echo xooapp_paging_nav(); ?>

          <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

          <?php endif; ?>
          <!-- ========== blog - end ========== -->
        </div>
      </main>

      <!-- Start Blog Sidebar -->
      <?php 
      if( function_exists( 'xooapp_framework_init' ) ) {
        $blog_layout = xooapp_get_option('blog_layout');
        if ( $blog_layout == 'left-sidebar' ||  $blog_layout == 'right-sidebar' ) {
          get_sidebar('right');
        } elseif ($blog_layout == 'full-width') {

        } else {
          get_sidebar('right');
        }
      } else {
       get_sidebar('right'); 
     }
     ?>
   </div>
 </div>
 <!--/ Blog listing page -->
</div>
<!--/ Blog Area -->

<?php get_footer(); ?>