<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package xooapp
 */

get_header('custom');
?>

<!-- Start Blog Page -->
<div class="blog-area" id="single-post-page">
	<main id="main" class="container site-main">
		<section class="error-404 not-found m-top-160">

			<div class="col-md-10 offset-md-1 section-title">	
				<header class="page-header">
					<!-- Title 	-->	
					<h2 class="h2-lg">
						<?php if( function_exists( 'xooapp_framework_init' ) ) { ?>
							<?php echo esc_html( xooapp_get_option( '404_page_title' ) ); ?>
						<?php } else { ?>
							<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'xooapp' ); ?>
						<?php } ?>
					</h2>	
				</header>

				<?php if( function_exists( 'xooapp_framework_init' ) ) { ?>
					<p><?php echo esc_html( xooapp_get_option( 'xooapp_404_desc' ) ); ?></p>

				<?php } else { ?>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'xooapp' ); ?></p>
				<?php } ?>
				<?php
				get_search_form();

				?>
				<br>
				<br>
				
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>