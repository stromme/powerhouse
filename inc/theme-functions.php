<?php

function count_menu($location){
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[$location] );
  $menu_items = array();
  $menu_count = 0;
  if($menu && !is_wp_error($menu)){
    $menu_items = wp_get_nav_menu_items($menu->term_id, array('update_post_term_cache'=>false));
    $menu_count = count($menu_items);
  }
  $counter = array('parent' => 0, 'items' => array());
  if($menu_count>0){
    foreach($menu_items as $m){
      if(!isset($counter['items']['item-'.$m->menu_item_parent])){
        $counter['items']['item-'.$m->menu_item_parent] = array(
          'parent' => $m->menu_item_parent,
          'child' => 0
        );
      }
      if($m->menu_item_parent==0){
        $counter['parent']++;
      }
      $counter['items']['item-'.$m->menu_item_parent]['child']++;
    }
  }
  return $counter;
}