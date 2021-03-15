<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xooapp
 */

if ( ! function_exists( 'xooapp_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function xooapp_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'xooapp' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on m-right-30"><i class="fa fa-calendar-o"></i> ' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'xooapp_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function xooapp_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'xooapp' ),
			'<span class="author vcard m-bottom-0 m-right-30" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><i class="fa fa-user-o"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author"><span itemprop="name">' . esc_html( get_the_author() ) . '</span></a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;


if( ! function_exists('xooapp_posted_cat') ) :
	/**
	 * which category post display
	 */
	function xooapp_posted_cat() {
		$categories_list = get_the_category_list( esc_html__( ' , ', 'xooapp' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links m-right-30"><i class="fa fa-bookmark-o"></i>' . esc_html__( ' %1$s', 'xooapp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
	
endif;


if( ! function_exists('xooapp_posted_one_cat') ) :
	/**
	 * which category post display
	 */
	function xooapp_posted_one_cat() {
		$categories_list = get_the_category();
		if ( ! empty( $categories_list )  ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links m-right-30"><i class="fa fa-bookmark-o"></i>' . esc_html__( ' %1$s', 'xooapp' ) . '</span>', $categories_list[0]->name ); // WPCS: XSS OK.
		}
	}
	
endif;


if ( ! function_exists( 'xooapp_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function xooapp_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'xooapp' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fa fa-tag"></i>' . esc_html__( ' %1$s', 'xooapp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

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
	}
endif;



if ( ! function_exists( 'xooapp_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function xooapp_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'xooapp' ); ?></h2>
		<div class="nav-links">
			<?php
			previous_post_link( '<div class="nav-previous">%link</div>', '-- %title' );
			next_post_link( '<div class="nav-next">%link</div>', '%title --' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function xooapp_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation next-prev">

		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous old-entries"><i class="fa fa-angle-left"></i><?php next_posts_link( esc_html__( 'Older posts', 'xooapp' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next new-entries"><?php previous_posts_link( esc_html__( 'Newer posts', 'xooapp' ) ); ?> <i class="fa fa-angle-right"></i></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}


/**
 * display comments and love sign
 *
 * This function will display commments count with link and user 
 * Love reaction
 */
if ( ! function_exists( 'xooapp_post_comments_love' )) :

	function xooapp_post_comments_love() {
		?>
		<?php if( !is_singular() ) { ?>
			<!-- Post Link -->
			<a class="more-detail" href="<?php the_permalink() ?>"><?php esc_html_e( 'More Details', 'xooapp' ) ?></a>
		<?php } ?>
		<?php if(function_exists('xooapp_get_simple_likes_button')) { ?>
			<?php echo xooapp_get_simple_likes_button( get_the_ID() ); ?>
		<?php } ?>
		
		<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
			<span class="comments-count">
				<i class="fa fa-comment-o"></i>  <?php comments_popup_link( '0', '1', '%') ?>
			</span>								
		<?php } ?>

		<?php
	}
endif;


/**
 * love counter for homepage
 *
 * @since 1.0 
 */

if ( ! function_exists( 'xooapp_post_comments_love_homepage' )) :

	function xooapp_post_comments_love_homepage() {
		?>
		
		<?php if(function_exists('xooapp_get_simple_likes_button')) { ?>
			<?php echo xooapp_get_simple_likes_button( get_the_ID() ); ?>
		<?php } ?>
		
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
			<span>
				<i class="fa fa-comment-o"></i>  <?php comments_popup_link( '0', '1', '%') ?>
			</span>								
		<?php } ?>

		<!-- Post Link -->
		<a class="more-detail" href="<?php the_permalink() ?>"><?php esc_html_e( 'More Details', 'xooapp' ) ?></a>

		<?php
	}
endif;




if ( ! function_exists( 'xooapp_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function xooapp_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			if( has_post_thumbnail() ) {
				?>
				<div class="blog-post-img m-bottom-25 post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .post-thumbnail -->
			<?php } ?>
			<?php else : ?>
				<div class="blog-post-img m-bottom-25 post-thumbnail">

					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php
						the_post_thumbnail( 'post-thumbnail', array(
							'alt' => the_title_attribute( array(
								'echo' => false,
							) ),
						) );
						?>
					</a>
				</div>
				<?php
		endif; // End is_singular().
	}
endif;


/**
 * tag cloud counter
 *
 * @return void 
 */

function xooapp_set_wp_generate_tag_cloud($content='', $tags='', $args='') { 
	$count=0;
	$output=preg_replace_callback('(</a\s*>)', 
		function($match) use ($tags, &$count) {
			return "<span class=\"tagcount\">".$tags[$count++]->count."</span></a>";  
		}
		, $content);

	return $output;
}
add_filter('wp_generate_tag_cloud','xooapp_set_wp_generate_tag_cloud', 10, 3); 
