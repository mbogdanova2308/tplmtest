<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jewelrycustom
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

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$jewelrycustom_comment_count = get_comments_number();
			if ( '1' === $jewelrycustom_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One Comment', 'jewelrycustom' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Comment', '%1$s Comments', $jewelrycustom_comment_count, 'comments title', 'jewelrycustom' ) ),
					number_format_i18n( $jewelrycustom_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ul',
					'callback' => 'custom_comment',
					'avatar_size' => 61,
				)
			);
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jewelrycustom' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$comments_args = array(
		'fields' => array(
	        'author' => '<div class="row-input"><input type="text" id="author" name="author" aria-required="true" placeholder="' . __( 'Name', 'jewelrycustom' ) . '"></input>',
	        'email' => '<input type="email" id="email" name="email" aria-required="true" placeholder="' . __( 'Email', 'jewelrycustom' ) . '"></input></div>',
	        'url' => '',
	        'cookies' => '',
	    ),
        'label_submit' => __( 'Send Comment', 'jewelrycustom' ),
        'title_reply' => __( 'Send Comment', 'jewelrycustom' ),
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'comment_field' => '<textarea id="comment" name="comment" rows="1" aria-required="true" placeholder="' . __( 'Comment', 'jewelrycustom' ) . '"></textarea>',
	);
	comment_form( $comments_args );
	?>

</div><!-- #comments -->
