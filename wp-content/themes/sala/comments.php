<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
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

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Comment', 'comments title', 'sala' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'Comment (%1$s)',
						'Comments (%1$s)',
						$comments_number,
						'comments title',
						'sala'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 50,
						'callback' 	  => 'Sala_Templates::render_comments',
					)
				);
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sala' ); ?></p>
	<?php endif; ?>

	<?php
	// Comment Form
	$args = array(
		'fields'         => apply_filters(
            'comment_form_default_fields', array(
                'author' 	=> '<p class="comment-form-author form-row col-xs-12 col-sm-4"><input id="author" class="input-text" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="43" placeholder="'. esc_attr__('Your Name*','sala') .'" /></p>',
                'email'  	=> '<p class="comment-form-email form-row col-xs-12 col-sm-4"><input id="email" class="input-text" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="43" placeholder="'. esc_attr__('Your Email*','sala') .'" /></p>',
				'website'  	=> '<p class="comment-form-website form-row col-xs-12 col-sm-4"><input id="website" class="input-text" name="website" type="url" value="" size="43" placeholder="'. esc_attr__('Your website','sala') .'" /></p>',
            )
        ),
		'comment_field'  => '<p class="comment-form-comment form-row col-xs-12"><textarea id="comment" class="input-text" name="comment" cols="45" rows="7" aria-required="true" placeholder="'. esc_attr__('Comment','sala') .'" ></textarea></p>',
        'title_reply'  => esc_html__('Leave a reply','sala'),
        'class_form'   => 'row',
        'class_submit' => 'sala-button full-filled',
        'label_submit' => esc_html__('Post Comment','sala'),
    );

    comment_form( $args );
	?>

</div><!-- .comments-area -->
