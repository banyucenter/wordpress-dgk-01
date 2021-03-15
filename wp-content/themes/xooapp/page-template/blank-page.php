<?php
/**
 * The template for displaying home page content.
 * Template Name: Blank Page - With Header
 * @package xooapp
 */
get_header('custom'); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?> 
	<?php the_content(); ?>
<?php endwhile;endif; ?>
<?php  get_template_part('footers/footer', 'inner'); ?>
