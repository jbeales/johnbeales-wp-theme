<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package johnbeales
 */

if ( ! function_exists( 'johnbeales_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function johnbeales_posted_on() {

		$updated_string = '';

		$anchor_start = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'johnbeales' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'
		);

		$published_classes = 'published';
		if ( get_the_time( 'U' ) === get_the_modified_time( 'U' ) ) {
			$published_classes = 'published updated';
		}
		$time_string = '<time class="entry-date %1$s" title="Published" datetime="%2$s">%3$s</time>';
		$time_string = sprintf( $time_string,
			$published_classes,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$time_string = $anchor_start . $time_string . '</a>';

		$posted_on = $time_string;


		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$updated_string = '<time class="updated" title="Updated" datetime="%1$s">%2$s</time>';
			$updated_string = sprintf( $updated_string,
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$updated_string = $anchor_start . $updated_string . '</a>';

			$posted_on .= ' / ' . $updated_string;
		}

		

		


		echo '<span class="posted-on">' . $posted_on . '</span>'; 

	}
endif;

if ( ! function_exists( 'johnbeales_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function johnbeales_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'johnbeales' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'johnbeales' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'johnbeales' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'johnbeales' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'johnbeales' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

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
	}
endif;

