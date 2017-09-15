<?php


/**
 *Set the default behaviour of embedded tweets.
 * 
 * @param array $out Parsed user-defined valid attributes or default attribute value
 * @param array $pairs supported attributes and their default values
 * @param array $attributes user-defined attributes in the shortcode tag
 *
 * @return array options array with our customization applied
 */
function jb_embedded_tweet_custom_options( $out, $pairs, $attributes )
{
  $out['width'] = 200;
  $out['link_color'] = 'FF0000';
  return $out;
}
add_filter( 'shortcode_atts_tweet', 'jb_embedded_tweet_custom_options', 10, 3 );


// 'oembed_remote_get_args', array $args, string $url

function jb_wrap_tweet_embeds( $html, $url, $attr, $post_ID ) {

	// https://twitter.com/ColterReed/status/65168340622552268
	if( strpos( $url, 'https://twitter.com' ) === 0 ) {
		// Twitter Embed - could be anything: status, list, etc
		$html = '<div class="fullwidth-embed">' . $html . '</div>';
	}

	return $html;
}
add_filter( 'embed_oembed_html', 'jb_wrap_tweet_embeds', 10, 4 );

//  'embed_oembed_html', mixed $cache, string $url, array $attr, int $post_ID