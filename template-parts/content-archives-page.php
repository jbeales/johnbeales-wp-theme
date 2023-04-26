<?php
/**
 * Template part for displaying the contents of the Archives page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package johnbeales
 */

?>
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
