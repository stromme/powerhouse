<?php get_header(); ?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">New York's<br /><strong>most experienced</strong><br />paving team</div>
</div>
<?php
global $wp_query;
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
        'numberposts' => -1,
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
              <?php foreach($news as $n){ ?>
              <li><a href="<?=$n->guid?>"><?=$n->post_title?></a></li>
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
    ?>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="sidebar">
          <div class="glyphicon glyphicon-cog"></div>
          <div class="list">
            <div class="title">SERVICES</div>
            <ul>
              <?php foreach($services as $s){ ?>
              <li><a href="<?=$s->guid?>"><?=$s->post_title?></a></li>
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