<?php
/**
 * The template for displaying home page content.
 * Template Name: Full Page - No Sidebar With Header
 * @package xooapp
 */
get_header('custom'); ?>


<div id="single-post-page" class="single-post-section">
	<!-- Content area -->
	<div class="inner-page-sidebar section-bg">
		<div class="container">
				<div class="blog-container">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
						<?php the_content(); ?>
					<?php endwhile;endif; ?>
				</div>
		</div>
	</div>
</div>
<?php  get_template_part('footers/footer', 'inner'); ?>
