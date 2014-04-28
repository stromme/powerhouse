<?php
/**
 * Powerhouse 2.0 Functions definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package Powrhouse
 * @subpackage Powerhouse_v2
 * @since Powerhouse 1.0
 */

/**
 * Powerhouse 2.0 only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'powerhouse_v2_setup' ) ) :

/* Load the theme CSS.
 * Don't load theme CSS in the context of the toolbox.
 *
 */

function load_css_js() {
  wp_enqueue_style('theme-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
  wp_enqueue_style('theme-styling', get_stylesheet_directory_uri().'/css/theme.min.css');
  // Load Bootstrap Framework
  wp_register_script( 'theme-bootstrap-js', get_template_directory_uri().'/bootstrap/dist/js/bootstrap.min.js', array('jquery'));
  wp_enqueue_script( 'theme-bootstrap-js' );
  wp_register_script( 'theme-js', get_template_directory_uri().'/js/theme.js', array('jquery'));
  wp_enqueue_script( 'theme-js' );
  wp_localize_script('theme-js', 'ajaxurl', admin_url('admin-ajax.php'));
}

/**
 * Powerhouse 2.0 setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Powerhouse 1.0
 */
function powerhouse_v2_setup() {
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'powerhouse-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'header'   => __( 'Header menu', 'powerhouse_v2' ),
		'footer' => __( 'Footer menu', 'powerhouse_v2' ),
		'learn' => __( 'Learn more menu', 'powerhouse_v2' ),
		'learn-footer' => __( 'Learn more on footer', 'powerhouse_v2' ),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	));

  include_once('inc/class.services.php');
  include_once('inc/class.videos.php');
  include_once('inc/class.news.php');
  include_once('inc/class.team.php');
  include_once('inc/class.standard.php');
  include_once('inc/theme-functions.php');

  add_action( 'wp_enqueue_scripts', 'load_css_js' );
  add_action( 'wp_head', 'add_header' );

}

function add_header(){
  echo '<link rel="icon" href="'.get_template_directory_uri().'/images/favicon.png" type="image/png" />';
}

endif; // powerhouse_v2_setup
add_action( 'after_setup_theme', 'powerhouse_v2_setup' );