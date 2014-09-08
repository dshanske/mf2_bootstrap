<?php
/**
 * mf2_bootstrap functions and definitions
 *
 * @package mf2_bootstrap
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'mf2_bootstrap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mf2_bootstrap_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mf2_bootstrap, use a find and replace
	 * to change 'mf2_bootstrap' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mf2_bootstrap', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top_menu' => __( 'Top Menu', 'mf2_bootstrap' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mf2_bootstrap_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


}
endif; // mf2_bootstrap_setup
add_action( 'after_setup_theme', 'mf2_bootstrap_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mf2_bootstrap_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mf2_bootstrap' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'mf2_bootstrap_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

   // remove wp version param from any enqueued scripts
   function eh_remove_wp_ver_css_js( $src ) {
       if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
           $src = remove_query_arg( 'ver', $src );
       return $src;
   }
   add_filter( 'style_loader_src', 'eh_remove_wp_ver_css_js', 9999 );
   add_filter( 'script_loader_src', 'eh_remove_wp_ver_css_js', 9999 );

function mf2_bootstrap_scripts() {
	// Add Genericons font, for use in the main stylesheet.
	// wp_enqueue_style( 'genericons', '//cdn.jsdelivr.net/genericons/3.1/genericons.css', array(), '3.1' );
           wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), null );

	wp_enqueue_script( 'mf2_bootstrap-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'mf2_bootstrap-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Add bootstrap support
// CDN Bootstrap
  //      wp_register_script( 'bootstrap-js', "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js", array('jquery'), null, true);

     wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.1.1', true );
        // CDN Bootstrap
   //     wp_register_style( 'bootstrap-css', "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" );

     wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.1.1', 'all' );

     wp_enqueue_script( 'bootstrap-js' );

     wp_enqueue_style( 'bootstrap-css' );



}
add_action( 'wp_enqueue_scripts', 'mf2_bootstrap_scripts' );

if (!function_exists('mf2_bootstrap_styles') ) {
  function mf2_bootstrap_styles()
    {
       wp_enqueue_style( 'mf2_bootstrap-style', get_template_directory_uri() . '/css/mf2_bootstrap.css' );
       wp_enqueue_style( 'menu-social-style', get_template_directory_uri() . '/css/menu-social.css' );

    }
add_action( 'wp_enqueue_scripts', 'mf2_bootstrap_styles' );
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom entry meta functions for this theme.
 */
require get_template_directory() . '/inc/entry-meta.php';

/**
 * Custom navigation functions for this theme.
 */
require get_template_directory() . '/inc/navigation.php';



/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Load Bootstrap Navwalker */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/* Load Bootstrap Comments */
require get_template_directory() . '/inc/bootstrap_comments.php';

/* Load Custom Widget Locations */
require get_template_directory() . '/inc/custom_widget.php';


/* Load Nav Menus */
require get_template_directory() . '/inc/nav-menus.php';

/* Load Custom Functions for Specific Plugins */
require get_template_directory() . '/inc/plugins.php';

/* Load Query for Standard Post Format */
require get_template_directory() . '/inc/query-standard-format.php';


?>
