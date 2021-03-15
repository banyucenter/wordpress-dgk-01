<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xooapp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/Article" itemscope="itemscope">
	<div class="blog-post video-format">

		<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$video   = false;

		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		?>

		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() && empty( $video ) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('full'); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<?php
	if( ! is_single() ) {
	// If not a single post, highlight the video file.
		if ( ! empty( $video ) ) {
			foreach ( $video as $video_html ) {
				echo '<div class="entry-video">';
				echo html_entity_decode( $video_html );
				echo '</div>';
			}
		};
	};
	?>
	<?php if ( ! is_single() ) { ?>
		<header class="entry-header p-left-20 p-right-20 p-top-20">
			<?php
			if (  'post' === get_post_type() ) : ?>
				<div class="entry-meta m-bottom-10">
					<?php
					xooapp_posted_on();
					xooapp_posted_one_cat();
					?>
				</div><!-- .entry-meta -->
			<?php endif;
			the_title( '<h4 class="entry-title m-bottom-10"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			?>
		</header><!-- .entry-header -->
	<?php } elseif( is_single() && !is_page_template()) { ?>
		<header class="entry-header blog-post-txt">
			<?php if(has_category()) { ?>
				<span class="single-post-cat"><?php the_category( ' ' ) ?></span>
			<?php } ?>
			<?php

			the_title( '<h1 class="m-bottom-10">', '</h1>' );
			if (  'post' === get_post_type() ) : ?>
				<div class="entry-meta m-bottom-30 grey-color">
					<?php
					xooapp_posted_on();
					xooapp_posted_by();
					xooapp_post_comments_love();
					?>
				</div>
				<!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

	<?php } ?>

	<div class="content-area">
		<div class="entry-content blog-post-txt m-bottom-10 p-left-20 p-right-20" itemprop="articleBody">
			<?php
			if ( is_single() || empty( $video ) ) {
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
		<?php if( !is_home() && !is_archive() ) { ?>
			<footer class="entry-footer">
				<div class="clearfix"></div>
				<?php xooapp_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php } ?>

	</div>
	<?php if(!is_singular()) { ?>
		<hr>
		<div class="blog-post-meta clearfix p-bottom-20">
			<?php 
			if( is_single() && function_exists('xooapp_framework_init')) {
				if(xooapp_get_option('xooapp_social_share')) {
					echo '<div class="text-left float-left">';
					xooapp_social_share();
					echo '</div>';
				}
			}
			?>
			<div class="text-right p-left-20 p-right-20">
				<?php xooapp_post_comments_love(); ?>
			</div>
		</div>
	<?php } ?>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
