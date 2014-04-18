<?php

class Powerhouse_Services {

  function __construct() {
    add_action( 'init', array( &$this, 'register_post_type' ) );
  }

  /**
 	 * Register 'services' post type
 	 *
 	 * @since 0.0.1
 	 */
 	function register_post_type() {
 		register_post_type('services',
 			array(
 				'labels' => array(
 					'name' => __('Services'),
 					'singular_name' => __('Service'),
 				),
        'hierarchical' => true,
        'menu_position' => 4,
 				'public' => true,
 				'show_ui' => true,
 				'show_in_menu' => true,
        'show_in_nav_menus' => true,
 				'publicly_queryable' => true,
 				'rewrite' => array('slug' => 'services'),
 				'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt'),
        'taxonomies' => array('category')
 			)
 		);
 	}
}
new Powerhouse_Services();