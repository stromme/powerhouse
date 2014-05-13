<?php
get_header();
global $wp_query;
?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">
  <?php if(isset($wp_query->queried_object->slug) && $wp_query->queried_object->slug=='professional-services') { ?>
  Long Island's<br /><strong>most experienced</strong><br />asphalt maintenance and site work team
  <?php } else { ?>
  New York's<br /><strong>most experienced</strong><br />paving team
  <?php } ?>
  </div>
</div>
<?php
if(isset($wp_query->queried_object->term_id)){
?>
<div class="container article-content">
  <div class="row">
    <?php if(isset($wp_query->queried_object->name)){ ?>
    <div class="col-xs-12"><h1><?=$wp_query->queried_object->name?></h1><br /></div>
    <?php } ?>
    <?php
      $term_id = $wp_query->queried_object->term_id;

      $news = get_posts(array(
        'post_type' => 'news',
        'numberposts' => 11,
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $term_id
          )
        )
      ));
      if(count($news)>0){
    ?>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="sidebar">
          <div class="glyphicon glyphicon-cog"></div>
          <div class="list">
            <div class="title">NEWS</div>
            <ul>
              <?php $i=0; foreach($news as $n){ if($i<10){ ?>
              <li><a href="<?=get_home_url()?>/news/<?=$n->post_name?>/"><?=$n->post_title?></a></li>
              <?php } $i++; } ?>
              <?php if(count($news)>10){ ?>
              <li><a href="<?=get_home_url()?>/news/">Read More News &raquo;</a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="shadow"></div>
        </div>
      </div>
    <?php
      }

      $services = get_posts(array(
        'post_type' => 'services',
        'numberposts' => -1,
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $term_id
          )
        )
      ));
      if(count($services)>0){
        foreach($services as $i=>$s){
          $order = get_post_meta($s->ID, 'order', true);
          $services[$i]->order = ($order>0)?intval($order):0;
        }
        uasort($services, "compare_order");
    ?>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="sidebar">
          <div class="glyphicon glyphicon-cog"></div>
          <div class="list">
            <div class="title">SERVICES</div>
            <ul>
              <?php foreach($services as $s){ ?>
              <li><a href="<?=get_home_url()?>/services/<?=$s->post_name?>/"><?=$s->post_title?></a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="shadow"></div>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
</div>
<?php
}
get_footer();