<?php

class Powerhouse_Videos {

  function __construct() {
    add_action( 'init', array( &$this, 'register_post_type' ) );
    add_action( 'admin_init', array( &$this, 'register_meta_box' ) );
  }

  /**
 	 * Register 'videos' meta box
 	 *
 	 * @since 0.0.1
 	 */
 	function register_meta_box() {
 		add_meta_box('services_meta', 'Video Info',  array( &$this, 'render_meta_box_content' ), 'videos');
 	}

 	/**
 	 * Add content to meta box
 	 *
 	 * @since 0.0.1
 	 */
 	function render_meta_box_content($post) {
    if($post->post_type=='videos'){
      $custom_val = get_post_custom($post->ID);
      ?>
      <h4>Youtube URL</h4>
    	<p><input type="text" name="youtube_url" value="<?php echo $custom_val['youtube_url'][0]; ?>" style="width:100%"></p>
    	<h4>Duration</h4>
    	<p><input type="text" name="duration" value="<?php echo $custom_val['duration'][0]; ?>" style="width:25%"></p>
      <?php
    }
 	}

 	/**
 	 * Save custom meta data
 	 *
 	 * @since 0.0.1
 	 */
 	function insert_post_meta_data($post_id, $post = null) {
     if($post->post_type=='videos'){
       $meta_keys = array(
         'video_url',
         'duration'
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
 	 * Register 'videos' post type
 	 *
 	 * @since 0.0.1
 	 */
 	function register_post_type() {
 		register_post_type('videos',
 			array(
 				'labels' => array(
 					'name' => __('Videos'),
 					'singular_name' => __('Video'),
 				),
        'has_archive' => true,
        'hierarchical' => true,
 				'public' => true,
 				'show_ui' => true,
 				'show_in_menu' => true,
 				'publicly_queryable' => true,
 				'rewrite' => array('slug' => 'videos', 'with_front' => true),
 				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
 			)
 		);
    flush_rewrite_rules( false );
 		add_action('wp_insert_post', array( &$this, 'insert_post_meta_data'), 10, 2 );
 	}
}
new Powerhouse_Videos();