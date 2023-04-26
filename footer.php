<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package johnbeales
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <aside class="widget-area">
    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
    </aside>
	<div class="site-info">
		<p>Generally &copy; 2005 onwards John Beales. See the <a href="/about/">about page</a> for full details. | <a href="/privacy/">Privacy Policy</a></p>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>
