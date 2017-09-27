<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package johnbeales
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">I have read:</h1>
				<div class="archive-description">	
		<p>My list of what I've read.  Everything goes in here, even the embarrasing stuff.  That way I, (hopefully), don't get duplicates as gifts, and eventually I can be proud of my long list.</p>
		<p>This page uses my Dead Trees WordPress plugin. To use it on your blog <a href="http://wordpress.org/extend/plugins/dead-trees/">get it from wordpress.org</a> or search for DeadTrees in the Add Plugin section of your wp-admin.</p>
	</div>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
