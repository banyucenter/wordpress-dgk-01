<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xooapp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/Article" itemscope="itemscope">
	
	<div class="blog-post">

		<?php xooapp_post_thumbnail(); ?>
		<div class="content-area">
			<header class="entry-header blog-post-txt m-bottom-10">
				<?php

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						xooapp_posted_on();
						xooapp_posted_cat();
						xooapp_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif;

				if ( is_singular() ) :
					the_title( '<h4 class="entry-title m-bottom-20">', '</h4>' );
				else :
					the_title( '<h4 class="entry-title m-bottom-20"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
				endif;
				?>
			</header><!-- .entry-header -->

			<div class="entry-content blog-post-txt m-bottom-10">
				<?php
				if( is_single() ) {
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'xooapp' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
				} else {
					the_excerpt();
				}

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
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php xooapp_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			<hr>

			<div class="blog-post-meta text-right clearfix">
				<?php xooapp_post_comments_love(); ?>
			</div>

		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
