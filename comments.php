<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
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
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();


			switch(count($comments)) {
				case 1:
					$comments_title = 'Whisper about';
					break;
				case 2:
				case 3:
					$comments_title = 'Whispers about';
					break;
				case 4:
				case 5:
					$comments_title = 'Chitchat about';
					break;
				case 6:
				case 7:
					$comments_title = 'Conversation about';
					break;
				default:
					$comments_title = 'The Melee about';
					break;
						
			}

			echo $comments_title . ' &ldquo;<span>' . get_the_title() . '</span>&rdquo;'

			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'avatar_size' => 48
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', '_s' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().



	comment_form( [ 
		'title_reply' => 'What do you think?',
		'label_submit' => 'Submit Thoughts',
		'comment_notes_before' => ''
	] );
	?>

</div><!-- #comments -->
