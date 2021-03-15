<?php
/**
 * The template for displaying home page content.
 * Template Name: Full Page - No Sidebar
 * Template Post Type: post
 * @package xooapp
 */
get_header('custom'); ?>


<div id="single-post-page-full" class="single-post-section">
	<!-- Content area -->
	<div class="inner-page-sidebar section-bg">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
			<header class="entry-header blog-post-txt text-center">
				<?php if(has_category()) { ?>
					<span class="single-post-cat"><?php the_category( ' ' ) ?></span>
				<?php } ?>
				<?php

				the_title( '<h1 class="m-bottom-10">', '</h1>' );
				if (  'post' === get_post_type() ) : ?>
					<div class="entry-meta d-flex justify-content-center m-bottom-50 grey-color">
						<?php
						xooapp_posted_on();
						xooapp_posted_by();
						?>
					</div>
					<!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile;endif; ?>
		<?php 
		if ( comments_open() || get_comments_number() ) : ?>
			<div class="comment-section container">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>
		
	</div>
</div>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package xooapp
 */
?>

<?php

$page_settings = get_post_meta( get_the_ID(), '_custom_page_options', true );

if( !empty( $page_settings ) && isset($page_settings['footer_color']) && !empty($page_settings['footer_color']) ) {
	$footer_clr = '#fff';
	$footer_clr = (isset($page_settings['footer_color']) ) ? $page_settings['footer_color'] : '#fff';
	$footer_bg = 'style="background-color: '. esc_attr( $footer_clr ) .' "';
} else {
	$footer_bg = '';
}
?>
<footer id="footer-1" class="p-bottom-60 m-top-60 footer division" <?php echo wp_kses_stripslashes( $footer_bg ) ?>>

	<?php 

	if(function_exists('xooapp_framework_init')) {

		$xooapp_inner_subscription = xooapp_get_option('xooapp_inner_subscription');
		if($xooapp_inner_subscription) {
			?>


			<section id="newsletter-2" class="bg-scroll bg-green newsletter-section division">
				<div class="container white-color">
					<div class="row d-flex align-items-center">


						<!-- NEWSLETTER TEXT -->
						<div class="col-lg-6">
							<div class="newsletter-txt">

								<!-- Title -->
								<h3 class="h3-xs">
									<?php if(function_exists('xooapp_framework_init')) { ?>
										<?php echo xooapp_get_option('xooapp_subs_title'); ?>
									<?php } ?>
								</h3>

							</div>
						</div>
						<?php 
						$subs_id = xooapp_get_option('xooapp_subs_id');
						?>

						<!-- NEWSLETTER FORM -->
						<div class="col-lg-6">
							<?php echo do_shortcode( '[mc4wp_form id="'.$subs_id.'"]' ) ?>
						</div>


					</div>	  <!-- End row -->
				</div>	   <!-- End container -->	
			</section>	<!-- END NEWSLETTER-2 -->
			<?php 
		}
	}
	?>
	
	<?php
	if ( is_active_sidebar( 'footer-one' ) ) {
		
		?>
		<div class="container">
			<div class="row footer-widget-area">
				<!-- Footer widget area -->
				<?php dynamic_sidebar( 'footer-one' ); ?>

				<!-- FOOTER INFO -->
			</div>
		</div>
	<?php } ?>

	<!-- FOOTER COPYRIGHT -->
	<div class="container bottom-footer">
		<div class="row">
			<div class="col-md-5">	
				<div class="footer-copyright">
					<?php if ( function_exists( 'xooapp_framework_init' )) { ?>
						<?php echo wp_kses_stripslashes( xooapp_get_option( 'copyrights' ) ); ?>
					<?php } ?>
				</div>	

			</div>
			<div class="col-md-7">
				<div class="footer-links text-right">
					<?php
					if( function_exists( 'xooapp_framework_init' ) ) {
						$show_footer_link = get_post_meta( get_the_ID(), '_custom_page_options', true );
						$footer_menu = '';
						$footer_menu = xooapp_get_option('footer_menu');
						if(!empty($footer_menu) && isset($show_footer_link['show_footer_link']) ) {
							?>
							<ul class="foo-links clearfix">
								<?php foreach ($footer_menu as $value) {
									?>
									<li><a href="<?php echo esc_url( $value['footer_menu_link'] ) ?>" class="<?php echo esc_attr( $value['footer_menu_title'] ) ?>"><?php echo esc_html( $value['footer_menu_title'] ) ?></a></li>
								<?php } ?>
							</ul>
						<?php }
					} ?>
				</div>	
			</div>
		</div>	<!-- END BOTTOM FOOTER -->

	</div>
</footer>


</div> 
<!-- end page  -->

<?php wp_footer();?>

</body>
</html>