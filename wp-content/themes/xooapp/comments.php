<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package xooapp
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php // You can start editing here -- including this comment! ?>

<?php if ( have_comments() ) : ?>

	<div class="single-post-comment">
		<div class="comment-number pb40">
			<h3 class="commets-title count-comments">
				<?php
				$comment_count = get_comments_number();
				if ( 1 === $comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html_e( 'Comment', 'xooapp' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
						printf( // WPCS: XSS OK.
							/* translators: 1: comment count number, 2: title. */
							esc_html( _nx( '%1$s Comment', '%1$s Comments', $comment_count, 'comments title', 'xooapp' ) ),
							number_format_i18n( $comment_count ),
							'<span>' . get_the_title() . '</span>'
						);
					}
					?>
					
				</h3>
			</div>
			<div class="comment-area">
				<ul id="submited-comment" class="single-post-comments m-top-50">
					<?php
					wp_list_comments( array(
						'style'       => 'li',
						'short_ping'  => true,
						'callback' => 'xooapp_comment',
						'avatar_size' => 64
					) );
					?>
				</ul><!-- .comment-list -->
			</div>
		</div>

		<?php 

		// are there comments to navigate through 
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav id="comment-nav-above" class="comment-navigation">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'xooapp' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'xooapp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'xooapp' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'xooapp' ); ?></p>
	<?php endif; ?>

<?php endif; // have_comments() ?>

<?php if ( comments_open() ) { ?>
	<div class="clearfix"></div>

	<div class="leave-reply m-top-40">
		<div id="leave-comment" class="post-comment-box leave-comment">

			<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$fields =  array(
				'author' => '
				<div class="col-md-6 comment-field">
				<input id="author" class="form-control" name="author" type="text" placeholder="'.esc_attr__( 'Your Name', 'xooapp' ).'" size="30"' . $aria_req . '/><i class="fa fa-user"></i>
				</div>
				',
				'email'  => '
				<div class="col-md-6 comment-field">
				<input id="email" class="form-control" name="email" type="email" placeholder="'.esc_attr__( 'Your Mail', 'xooapp' ).'" size="30"' . $aria_req . '/><i class="fa fa-envelope"></i>
				</div>
				',
			);

			$comments_args = array(
				
				'id_form'          		=> 'add-comment',
				'class_form'			=> 'comment-form row p-top-20',
				'title_reply_before'	=> '<h3 class="commets-title">',
				'title_reply'       	=> esc_html__( 'Leave A Comment', 'xooapp' ),
				'title_reply_after'		=> '</h3>',
				'title_reply_to'    	=> '',
				'cancel_reply_link' 	=> esc_html__( 'Cancel Comment', 'xooapp' ),
				'label_submit'      	=> esc_html__( 'Post Comment', 'xooapp' ),
				'comment_notes_before'  => '',
				'comment_notes_after'   => '',
				'comment_field'        	=> '
				<div id="post-name" class="col-md-12 comment-field">
				<textarea id="message" class="form-control required" name="comment" rows="4" cols="30" placeholder="'.esc_attr__( 'Your Comment', 'xooapp' ).'" required></textarea><i class="fa fa-pencil"></i>
				</div>',
				'submit_button'         => '
				<div class="col-md-12 comment-form-btn m-top-20">
				<button value="'.esc_attr__( 'Submit', 'xooapp' ).'" class="%3$s btn btn-green btn-arrow submit">'.esc_html__( 'Send your comment', 'xooapp' ).'</button>
				</div>
				',
				'submit_field'          => '<div class="contact-info"><input type="hidden" name="form_botcheck" class="form-control" value=""> %1$s %2$s</div>',
				'format'                => 'xhtml',
				'fields' 				=>  $fields
			);
			ob_start();
			comment_form($comments_args);
			?>

		</div><!-- #comments -->
	</div>  

	<?php } ?>