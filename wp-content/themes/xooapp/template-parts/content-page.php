<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xooapp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/Article" itemscope="itemscope">

	<?php xooapp_post_thumbnail(); ?>

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<?php 
	wp_link_pages( array(
		'before' => '<div class="page-links">',
		'after'  => '</div>',
		'link_before'      => '<span>',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'pagelink'         => '%',
		'echo'             => 1
	) ); 
	?>
	
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'xooapp' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
