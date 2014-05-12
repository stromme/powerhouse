<?php

class Powerhouse_Team {

  function __construct() {
    add_action( 'init', array( &$this, 'register_post_type' ) );
    add_action( 'init', array( &$this, 'register_taxonomy' ) );
    add_action( 'admin_init', array( &$this, 'register_meta_box' ) );
  }

  /**
 	 * Register 'leads' meta box
 	 *
 	 * @since 0.0.1
 	 */
 	function register_meta_box() {
 		add_meta_box('team_meta', 'Team Meta',  array( &$this, 'render_meta_box_content' ), 'team');
 	}

 	/**
 	 * Add content to meta box
 	 *
 	 * @since 0.0.1
 	 */
 	function render_meta_box_content($post) {
    if($post->post_type=='team'){
      $custom_val = get_post_custom($post->ID);
      ?>
      <h4>Phone</h4>
      <p><input type="text" name="phone" value="<?php echo $custom_val['phone'][0]; ?>" style="width:100%"></p>
      <h4>Email</h4>
      <p><input type="text" name="email" value="<?php echo $custom_val['email'][0]; ?>" style="width:100%"></p>
      <h4>Google+</h4>
      <p><input type="text" name="googleplus" value="<?php echo $custom_val['googleplus'][0]; ?>" style="width:100%"></p>
      <h4>Facebook</h4>
      <p><input type="text" name="facebook" value="<?php echo $custom_val['facebook'][0]; ?>" style="width:100%"></p>
      <h4>Twitter</h4>
      <p><input type="text" name="twitter" value="<?php echo $custom_val['twitter'][0]; ?>" style="width:100%"></p>
      <h4>Order</h4>
      <p><input type="text" name="order" value="<?php echo $custom_val['order'][0]; ?>" style="width:50px"></p>
      <?php
    }
 	}

  /**
 	 * Register 'lead-source' taxonomy
 	 *
 	 * @since 0.0.1
 	 */

 	function register_taxonomy() {
 	  $labels = array(
 	    'name' => _x( 'Position', 'taxonomy general name' ),
 	    'singular_name' => _x( 'Position', 'taxonomy singular name' ),
 	    'search_items' =>  __( 'Search Position' ),
 	    'all_items' => __( 'All Position' ),
 	    'parent_item' => __( 'Parent Position' ),
 	    'parent_item_colon' => __( 'Parent Position:' ),
 	    'edit_item' => __( 'Edit Position' ),
 	    'update_item' => __( 'Update Position' ),
 	    'add_new_item' => __( 'Add New Position' ),
 	    'new_item_name' => __( 'New Position' ),
 	    'menu_name' => __( 'Position' ),
 	  );

 	  register_taxonomy('position',array('team'), array(
 	    'hierarchical' => true,
 	    'labels' => $labels,
 	    'show_ui' => true,
 	    'show_admin_column' => true,
 	    'query_var' => true,
 	    'rewrite' => array( 'slug' => 'position' ),
 	  ));
 	}

 	/**
 	 * Save custom meta data
 	 *
 	 * @since 0.0.1
 	 */
 	function insert_post_meta_data($post_id, $post = null) {
     if($post->post_type=='team'){
       $meta_keys = array(
         'phone',
         'email',
         'googleplus',
         'facebook',
         'twitter',
         'order'
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
 	 * Register 'team' post type
 	 *
 	 * @since 0.0.1
 	 */
 	function register_post_type() {
 		register_post_type('team',
 			array(
 				'labels' => array(
 					'name' => __('Team'),
 					'singular_name' => __('Team'),
 				),
 				'public' => true,
 				'show_ui' => true,
 				'show_in_menu' => true,
 				'publicly_queryable' => true,
 				'rewrite' => array('slug' => 'team', 'with_front' => true),
 				'supports' => array('title', 'thumbnail', 'editor', 'excerpt')
 			)
 		);
    flush_rewrite_rules( false );
 		add_action('wp_insert_post', array( &$this, 'insert_post_meta_data'), 10, 2 );
 	}
}
new Powerhouse_Team();