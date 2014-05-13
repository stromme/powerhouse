<?php get_header();
$per_page = 8;
$news = get_items('news', $per_page+1);
?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">Long Island's<br /><strong>most experienced</strong><br />pavement maintenance team</div>
</div>
<div class="container news-block news-page">
  <div class="row">
    <div class="col-xs-12">
      <fieldset>
        <legend><h2 class="title">Powerhouse Paving in the News</h2></legend>
        <div class="subtitle">Leading the Asphalt Maintenance and Site Work business for over 50 Years.</div>
      </fieldset>
    </div>
    <?php if(count($news)>0){
      $i = 0;
      foreach($news as $n){
        if($i<$per_page){
          $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($n->ID), 'medium');
          $source_name = get_post_meta($n->ID, 'source_name', true);
          $source_url = get_post_meta($n->ID, 'source_url', true);
    ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="news-item">
        <a href="<?=$n->guid?>" class="thumb" style="background-image: url(<?=isset($thumb[0])?$thumb[0]:''?>);"></a>
        <div class="content">
          <div class="date"><?=date('F d, Y', strtotime($n->post_date))?></div>
          <?php if($source_name!='' && $source_url!=''){ ?><ul class="category"><li><a href="<?=$source_url?>" target="_blank" rel="nofollow"><?=$source_name?></a></li></ul><?php } ?>
          <a href="<?=get_home_url()?>/news/<?=$n->post_name?>/" class="title"><?=$n->post_title?></a>
        </div>
      </div>
    </div>
    <?php } $i++; } } ?>
    <?php if(count($news)>$per_page){ ?>
    <div id="news-pivot" class="clearfix"></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <a href="" class="read-more"><span class="glyphicon glyphicon-refresh"></span> See older news items</a>
    </div>
    <?php } ?>
  </div>
</div>
<?
get_footer();