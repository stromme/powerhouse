<?php

class Powerhouse_News {

  function __construct() {
    add_action( 'init', array( &$this, 'register_post_type' ) );
    add_action( 'admin_init', array( &$this, 'register_meta_box' ) );
  }

  /**
 	 * Register 'leads' meta box
 	 *
 	 * @since 0.0.1
 	 */
 	function register_meta_box() {
 		add_meta_box('news_meta', 'News Source',  array( &$this, 'render_meta_box_content' ), 'news');
 	}

 	/**
 	 * Add content to meta box
 	 *
 	 * @since 0.0.1
 	 */
 	function render_meta_box_content($post) {
    if($post->post_type=='news'){
      $custom_val = get_post_custom($post->ID);
      ?>
      <h4>Source Name</h4>
      <p><input type="text" name="source_name" value="<?php echo $custom_val['source_name'][0]; ?>" style="width:100%"></p>
      <h4>Source URL</h4>
      <p><input type="text" name="source_url" value="<?php echo $custom_val['source_url'][0]; ?>" style="width:100%"></p>
      <?php
    }
 	}

 	/**
 	 * Save custom meta data
 	 *
 	 * @since 0.0.1
 	 */
 	function insert_post_meta_data($post_id, $post = null) {
     if($post->post_type=='news'){
       $meta_keys = array(
         'source_name',
         'source_url'
       );
       if (count($meta_keys) > 0) {
         foreach ($meta_keys as $key) {
           $val = isset($_POST[$key]) ? $_POST[$key] : null;
           if (empty($val)) {
             delete_post_meta($post_id, $key);
           } else {
             update_post_meta($post_id, $key, $val, get_post_meta($post_id, $key, true));
           }
         }
       }
     }
 		return $post_id;
 	}

  /**
 	 * Register 'news' post type
 	 *
 	 * @since 0.0.1
 	 */
 	function register_post_type() {
 		register_post_type('news',
 			array(
 				'labels' => array(
 					'name' => __('News'),
 					'singular_name' => __('News'),
 				),
        'has_archive' => true,
        'hierarchical' => true,
 				'public' => true,
 				'show_ui' => true,
 				'show_in_menu' => true,
 				'publicly_queryable' => true,
 				'rewrite' => array('slug' => 'news', 'with_front' => true),
 				'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt'),
        'taxonomies' => array('category')
 			)
 		);
    flush_rewrite_rules( false );
 		add_action('wp_insert_post', array( &$this, 'insert_post_meta_data'), 10, 2 );
 	}
}
new Powerhouse_News();