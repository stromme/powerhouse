<?php

class Powerhouse_Services {

  function __construct() {
    add_action( 'init', array( &$this, 'register_post_type' ) );
    add_action( 'admin_init', array( &$this, 'add_meta_box' ) );
  }

  /**
   * Add meta box
   */
  function add_meta_box(){
    for ($i = 1; $i <= 10; $i++) {
      add_meta_box('resource_'.$i, 'Resource #'.$i, array($this, 'resource_meta_box'), 'services', 'normal', 'low', array($i));
    }
  }

  /**
 	 * Save custom meta data
 	 *
 	 * @since 0.0.1
 	 */
 	function insert_post_meta_data($post_id, $post = null) {
    if($post->post_type=='services'){
      //var_dump($_POST);
      $meta_keys = array();
      for ($i = 1; $i <= 10; $i++) {
        $meta_keys[] = 'resource_name_'.$i;
        $meta_keys[] = 'resource_url_'.$i;
        $meta_keys[] = 'resource_type_'.$i;
      }
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

  function resource_meta_box($post, $args) {
    if($post->post_type=='services'){
      $i = $args['args'][0];
      $custom_val = get_post_custom($post->ID);
      ?>
      <div style="margin-bottom:10px;">
        <label for="resource_name_<?php echo $i; ?>" style="float:left;line-height:28px;font-weight:bold;">Name</label>
        <div style="margin-left: 50px">
          <input type="text" id="resource_name_<?php echo $i; ?>" name="resource_name_<?php echo $i; ?>" value="<?php echo $custom_val['resource_name_'.$i][0]; ?>" style="width:100%">
        </div>
      </div>
      <div style="margin-bottom:10px;">
        <label for="resource_url_<?php echo $i; ?>" style="float:left;line-height:28px;font-weight:bold;">URL</label>
        <div style="margin-left: 50px">
          <input type="text" name="resource_url_<?php echo $i; ?>" value="<?php echo $custom_val['resource_url_'.$i][0]; ?>" style="width:100%">
        </div>
      </div>
      <div>
        <label for="resource_type_<?php echo $i; ?>" style="float:left;line-height:28px;font-weight:bold;">Type</label>
        <div style="margin-left: 50px">
          <select name="resource_type_<?php echo $i; ?>" style="width:150px;"><option value="link" <?=($custom_val['resource_type_'.$i][0]=='link')?'selected="selected"':''?>>Link</option><option value="file" <?=($custom_val['resource_type_'.$i][0]=='file')?'selected="selected"':''?>>File</option></select>
        </div>
      </div>
      <?php
    }
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
 				'rewrite' => array('slug' => 'services', 'with_front' => true),
 				'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'excerpt'),
        'taxonomies' => array('category')
 			)
 		);
    flush_rewrite_rules( false );
    add_action('wp_insert_post', array( &$this, 'insert_post_meta_data'), 10, 2 );
 	}
}
new Powerhouse_Services();