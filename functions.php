<?php
/**
 * johnbeales functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package johnbeales
 */



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function johnbeales_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on johnbeales, use a find and replace
	 * to change 'johnbeales' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'johnbeales', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'johnbeales' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
//		'gallery',
		'caption',
	) );

	// 960 = 60em * 16px base font size
	johnbeales_add_image_sizes( 'jb_content_image', 960, 960, false, [750, 640, 510, 400, 320] );

}

add_action( 'after_setup_theme', 'johnbeales_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function johnbeales_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'johnbeales_content_width', 960 );
}
add_action( 'after_setup_theme', 'johnbeales_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function johnbeales_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'johnbeales' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'johnbeales' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'johnbeales_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function johnbeales_scripts() {
	wp_enqueue_style( 'johnbeales-adobe-fonts', 'https://use.typekit.net/uta8oqn.css' );
	
	wp_enqueue_style( 'johnbeales-style', get_stylesheet_uri(), array(), johnbeales_theme_version() );

	wp_enqueue_script( 'johnbeales-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'johnbeales-prism', get_template_directory_uri() . '/js/prism.js', [], '1.22.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'johnbeales_scripts' );


function johnbeales_theme_version() {
	static $version = false;
	if ( ! $version ) {
		$theme = wp_get_theme();
		$version = $theme->Version;	
	}
	return $version;
}


// Add the Book CPT to the main feed.
add_filter( 'pre_get_posts', 'jb_add_books_to_main_feed' );

function jb_add_books_to_main_feed( $query ) {
	if ( $query->is_feed() ) {
		
		$post_types = $query->get('post_type');
		if ( empty( $post_types ) ) {
			$post_types = array();
		} else if( ! is_array( $post_types ) ) {
			$post_types = array( $post_types );
		}
		
		
		if ( ! in_array( 'post', $post_types ) ) {
			$post_types[] = 'post';
		}
		$post_types[] = 'dt_book';
		
		$query->set( 'post_type', $post_types );
		
	}
		
	return $query;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Images file
 */
require get_template_directory() . '/inc/images.php';

/**
 * Load functions for embedded media.
 */
require get_template_directory() . '/inc/embeds.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
