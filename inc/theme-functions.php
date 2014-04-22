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

function get_items($post_type, $max){
  $videos = get_posts(array(
    'post_type' => $post_type,
    'numberposts' => $max,
    'order_by' => 'created',
    'order' => 'DESC'
  ));
  if(count($videos)>0){
    return $videos;
  }
  return false;
}

/**
 * Get youtube screenshot url
 *
 * @param $youtube_url
 * @return mixed
 */
function get_youtube_thumb($youtube_url){
  return preg_replace('/http(s)?:\/\/www\.youtube\.com\/watch\?v=([A-Za-z0-9\-_]+).*$/', 'http://img.youtube.com/vi/$2/0.jpg', $youtube_url);
}

add_action('wp_ajax_load_more_videos', 'load_more_videos_callback');
add_action('wp_ajax_nopriv_load_more_videos', 'load_more_videos_callback');

function load_more_videos_callback(){
  $html = '';
  $done = false;
  $page = isset($_POST['page'])?intval($_POST['page']):'';
  if($page>1){
    $per_page = 8;
    $posts_args = array(
      'orderby'		     => 'date',
      'order'			     => 'DESC',
      'post_type'		   => 'videos',
      'post_status'	   => 'publish',
      'posts_per_page' => $per_page,
      'paged'          => $page
    );

    $total_posts = wp_count_posts('videos');
    $total_posts = $total_posts->publish;
    $posts = get_posts($posts_args);
    $count = count($posts);
    if($count>0){
      if($total_posts<=$page*$per_page){
        $done = true;
      }
      foreach($posts as $v){
        $youtube_url = get_post_meta($v->ID, 'youtube_url', true);
        $duration = get_post_meta($v->ID, 'duration', true);
        $youtube_thumb = get_youtube_thumb($youtube_url);
        $html .= '
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 video-item">
      <a href="'.$v->guid.'" class="video-container">
        <img src="'.$youtube_thumb.'" />
        <span class="video-button"></span>
      </a>
      <div class="duration">'.$duration.' <span class="glyphicon glyphicon-time"></span></div>
      <div class="share">Share <a href=""><span class="social google_plus"></span></a><a href=""><span class="social twitter"></span></a><a href=""><span class="social facebook"></span></a></div>
      <div class="clearfix"></div>
      <p>'.$v->post_title.'</p>
    </div>';
      }
      $status_code = 1;
      $status_message = 'success';
    }
    else {
      $status_code = 1;
      $status_message = 'success';
      $done = true;
    }
  }
  else {
    $status_code = 1;
    $status_message = 'success';
    $done = true;
  }

  // Return ajax response as json string
  die(json_encode(
    array(
      'status'         => $status_code,
      'status_message' => $status_message,
      'done'           => $done,
      'html'           => $html
    )
  ));
}

add_action('wp_ajax_load_more_news', 'load_more_news_callback');
add_action('wp_ajax_nopriv_load_more_news', 'load_more_news_callback');

function load_more_news_callback(){
  $html = '';
  $done = false;
  $page = isset($_POST['page'])?intval($_POST['page']):'';
  if($page>1){
    $per_page = 8;
    $posts_args = array(
      'orderby'		     => 'date',
      'order'			     => 'DESC',
      'post_type'		   => 'news',
      'post_status'	   => 'publish',
      'posts_per_page' => $per_page,
      'paged'          => $page
    );

    $total_posts = wp_count_posts('news');
    $total_posts = $total_posts->publish;
    $posts = get_posts($posts_args);
    $count = count($posts);
    if($count>0){
      if($total_posts<=$page*$per_page){
        $done = true;
      }
      foreach($posts as $n){
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($n->ID), 'large');
        $source_name = get_post_meta($n->ID, 'source_name', true);
        $source_url = get_post_meta($n->ID, 'source_url', true);
        $html .= '
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="news-item">
        <a href="" class="thumb" style="background-image: url('.(isset($thumb[0])?$thumb[0]:'').');"></a>
        <div class="content">
          <div class="date">'.date('M d, Y', strtotime($n->post_date)).'</div>';
          if($source_name!='' && $source_url!=''){ $html .= '<ul class="category"><li><a href="'.$source_url.'" target="_blank" rel="nofollow">'.$source_name.'</a></li></ul>'; }
        $html .= '
          <a href="'.$n->guid.'" class="title">'.$n->post_title.'</a>
        </div>
      </div>
    </div>';
      }
      $status_code = 1;
      $status_message = 'success';
    }
    else {
      $status_code = 1;
      $status_message = 'success';
      $done = true;
    }
  }
  else {
    $status_code = 1;
    $status_message = 'success';
    $done = true;
  }

  // Return ajax response as json string
  die(json_encode(
    array(
      'status'         => $status_code,
      'status_message' => $status_message,
      'done'           => $done,
      'html'           => $html
    )
  ));
}

function get_excerpt($exc, $length){
  return substr($exc,0,($dot_pos=strrpos(substr($exc, 0, $length), '.'))?$dot_pos:(($space_pos=strrpos(substr($exc, 0, $length), '.'))?$space_pos:$length));
}

function format_phone_plain($number) {
  // Clear all non number characters
  return preg_replace('/[^0-9]/', '', $number);
}