<?php
/**
 * Template part for displaying the contents of the Archives page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package johnbeales
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">


		<p class="tag_cloud">
			<?php wp_tag_cloud(''); ?>
		</p>
		<?php get_search_form(); ?>

		<section class="by-subject">
			<h2>Archives by Subject:</h2>
			<ul>
				 <?php wp_list_categories('title_li='); ?>
			</ul>
		</section>

		<section class="by-month">
			<h2>Archives by Month:</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</section>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'johnbeales' ),
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
