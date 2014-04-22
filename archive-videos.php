<?php get_header();
$per_page = 8;
$videos = get_items('videos', $per_page+1);
?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">New York's<br /><strong>most experienced</strong><br />paving team</div>
</div>
<div class="container video-block videos-page">
  <div class="row">
    <div class="col-xs-12">
      <fieldset>
        <legend><h2 class="title">Parking Lot University Videos for Property Managers</h2></legend>
        <div class="subtitle">Learn how to protect and maintain your asphalt.</div>
      </fieldset>
    </div>

    <?php if(count($videos)>0){
      $i = 0;
      foreach($videos as $v){
        if($i<$per_page){
          $youtube_url = get_post_meta($v->ID, 'youtube_url', true);
          $duration = get_post_meta($v->ID, 'duration', true);
          $youtube_thumb = get_youtube_thumb($youtube_url);
    ?>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 video-item">
      <a href="<?=$v->guid?>" class="video-container">
        <img src="<?=($youtube_thumb!='')?$youtube_thumb:get_template_directory_uri().'/images/video_thumb.jpg'?>" />
        <span class="video-button"></span>
      </a>
      <div class="duration"><?=$duration?> <span class="glyphicon glyphicon-time"></span></div>
      <div class="share">Share
        <a onclick="share_project('googleplus', '<?=($youtube_url!='')?$youtube_url:$v->guid?>', '<?='Great video: '.$v->post_title.' '.(($youtube_url!='')?$youtube_url:$v->guid)?>');" href="javascript:void(0);"><span class="social google_plus"></span></a>
        <a onclick="share_project('twitter', '<?=($youtube_url!='')?$youtube_url:$v->guid?>', '<?='Great video: '.$v->post_title?>');" href="javascript:void(0);"><span class="social twitter"></span></a>
        <a onclick="share_project('facebook', '<?=($youtube_url!='')?$youtube_url:$v->guid?>', '<?=str_replace("'", '\\\'', $v->post_title).' '.(($youtube_url!='')?$youtube_url:$v->guid)?>');" href="javascript:void(0);"><span class="social facebook"></span></a>
      </div>
      <div class="clearfix"></div>
      <p><?=$v->post_title?></p>
    </div>
    <?php } $i++; } } ?>
    <?php if(count($videos)>$per_page){ ?>
    <div id="video-pivot" class="clearfix"></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <a href="" class="watch-more"><span class="glyphicon glyphicon-refresh"></span> Watch more videos</a>
    </div>
    <?php } ?>
  </div>
</div>
<?php
get_footer();