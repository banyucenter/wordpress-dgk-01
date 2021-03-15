<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package xooapp
 */
get_header('custom'); ?>


<!-- Start of blog section
  ============================================= -->
  <!-- Start Blog Page -->
  <div id="single-post-page" class="single-post-section">
    
    <!-- Content area -->
    <div class="inner-page-sidebar section-bg">
      <div class="container">
        <div class="row">
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
          <div class="blog-container">
            <div class="blog-posts post-page">
               <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                 <?php
        						/*
        						 * Include the Post-Format-specific template for the content.
        						 * If you want to override this in a child theme, then include a file
        						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        						 */
                    get_template_part( 'template-parts/content', 'page' ); ?>
                  <?php endwhile; ?>
                  <?php echo xooapp_paging_nav(); ?>
                  <?php else : ?>
                   <?php get_template_part( 'template-parts/content', 'none' ); ?>
                 <?php endif; ?>
             </div>

             <?php 
             if ( comments_open() || get_comments_number() ) : ?>
              <div class="comment-section">
                <?php comments_template(); ?>
              </div>
            <?php endif; ?>
          </div>
        </main>
        <!-- /col-md-8 -->

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
 </div>
</div>
<!-- End of blog-section 
  ============================================= -->


  <?php get_template_part('footers/footer', 'inner'); ?>
