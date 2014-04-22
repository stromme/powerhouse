<?php
/**
 * Template Name: Home
 * Description: 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); ?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <div class="overlay">
        The #1 choice for parking lot and roadway paving in NY for over 50 years.
      </div>
      <img src="<?=get_template_directory_uri()?>/images/slide_home.jpg" alt="Number one choice for parking lot and roadway paving in NY for over 50 years.">
    </div>
    <div class="item">
      <img src="<?=get_template_directory_uri()?>/images/slide_home.jpg" alt="Number one choice for parking lot and roadway paving in NY for over 50 years.">
    </div>
    <div class="item">
      <img src="<?=get_template_directory_uri()?>/images/slide_home.jpg" alt="Number one choice for parking lot and roadway paving in NY for over 50 years.">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 static-ads">
      <h3>Concrete Installation & Repair</h3>
      <p>From sidewalks to roadways. Powerhouse has the <strong>manpower and equipment</strong> to handle concrete projects of any scale.</p>
      <a href="" class="chevron left">Learn more <b class="tux-icon chevron"></b></a>
      <a href="" class="chevron right">Request a quote <b class="tux-icon chevron"></b></a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 static-ads">
      <h3>Asphalt Paving & Maintenance</h3>
      <p>Infrared repair, sawcut, or miling repair. Whatever the need is Powerhouse crews provide asphalt repair with <strong>minimal traffic flow disturbance.</strong></p>
      <a href="" class="chevron left">Learn more <b class="tux-icon chevron"></b></a>
      <a href="" class="chevron right">Request a quote <b class="tux-icon chevron"></b></a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 static-ads">
      <h3>Drainage Installation & Repair</h3>
      <p>Our heavy equipment fleet can handle all size of precast including 12' in diameter. <strong>Get the job done right the first time</strong> with Powerhouse.</p>
      <a href="" class="chevron left">Learn more <b class="tux-icon chevron"></b></a>
      <a href="" class="chevron right">Request a quote <b class="tux-icon chevron"></b></a>
    </div>
  </div>
</div>
<div class="container article">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <h2 class="title">The Powerhouse Paving Difference.</h2>
      <div class="subtitle">Personal attention, quality, integrity and reliability.</div>
      <p>
        With a large staff of highly skilled and experienced individuals and a
        fleet over 150 vehicles and pieces of heavy equipment, we can
        handle any size job. Our central location to our service area and our
        extensive facility, allow us to be ready to serve you at a moments notice.
      </p>
      <p>
        You will also notice the neat and professional appearance of our
        equipment and staff. You will see from the first time you meet with
        one of our experienced estimators that quality is what Powerhouse is all about.
      </p>
      <p>
        We stand behind our work and that has proved to be a success by
        our <strong>over 50 years in the business with many of same loyal customers.</strong>
      </p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <figure><img src="<?=get_template_directory_uri()?>/images/home_photo.jpg" /><figcaption>Powerhouse crews resurfacing the Lowes parking lot.</figcaption></figure>
    </div>
  </div>
</div>
<div class="container video-block">
  <div class="row">
    <div class="col-xs-12">
      <fieldset>
        <legend><h2 class="title">Parking Lot University Videos for Property Managers</h2></legend>
        <div class="subtitle">Learn how to protect and maintain your asphalt.</div>
      </fieldset>
    </div>
    <?php
    $videos = get_items('videos', 3);
    if(count($videos)>0){
      foreach($videos as $v){
        $youtube_url = get_post_meta($v->ID, 'youtube_url', true);
        $duration = get_post_meta($v->ID, 'duration', true);
        $youtube_thumb = get_youtube_thumb($youtube_url);
    ?>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
      <a href="<?=$v->guid?>" class="video-container">
        <img src="<?=$youtube_thumb?>" />
        <span class="video-button"></span>
      </a>
      <div class="duration"><?=$duration?> <span class="glyphicon glyphicon-time"></span></div>
      <div class="share">Share <a href=""><span class="social google_plus"></span></a><a href=""><span class="social twitter"></span></a><a href=""><span class="social facebook"></span></a></div>
      <div class="clearfix"></div>
      <p><?=$v->post_title?></p>
    </div>
    <?php } } ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <a href="<?=get_home_url()?>/videos/" class="watch-more"><span class="glyphicon glyphicon-th-large"></span> Watch more videos</a>
    </div>
  </div>
</div>
<div class="container news-block">
  <div class="row">
    <div class="col-xs-12">
      <fieldset>
        <legend><h2 class="title">Powerhouse Paving in the News</h2></legend>
        <div class="subtitle">Leading the roadway and parking lot paving for over 50 years.</div>
      </fieldset>
    </div>
    <?php
    $news = get_items('news', 3);
    ?>
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
      <?php if(isset($news[0])){
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($news[0]->ID), 'large');
        $source_name = get_post_meta($news[0]->ID, 'source_name', true);
        $source_url = get_post_meta($news[0]->ID, 'source_url', true);
      ?>
      <div class="news-item feature">
        <a href="" class="thumb" style="background-image: url(<?=isset($thumb[0])?$thumb[0]:''?>);"></a>
        <div class="content">
          <div class="date"><?=date('M d, Y', strtotime($news[0]->post_date))?></div>
          <?php if($source_name!='' && $source_url!=''){ ?><ul class="category"><li><a href="<?=$source_url?>" target="_blank" rel="nofollow"><?=$source_name?></a></li></ul><?php } ?>
          <a href="<?=$news[0]->guid?>" class="title"><?=$news[0]->post_title?></a>
          <p><?=substr($news[0]->post_excerpt, 0, strpos($news[0]->post_excerpt, ' ', 180))?>... <a href="<?=$news[0]->guid?>">Read more</a></p>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
      <?php if(isset($news[1])){
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($news[1]->ID), 'large');
        $source_name = get_post_meta($news[1]->ID, 'source_name', true);
        $source_url = get_post_meta($news[1]->ID, 'source_url', true);
      ?>
      <div class="news-item">
        <a href="" class="thumb" style="background-image: url(<?=isset($thumb[0])?$thumb[0]:''?>);background-position:center center;"></a>
        <div class="content">
          <div class="date"><?=date('M d, Y', strtotime($news[1]->post_date))?></div>
          <?php if($source_name!='' && $source_url!=''){ ?><ul class="category"><li><a href="<?=$source_url?>" target="_blank" rel="nofollow"><?=$source_name?></a></li></ul><?php } ?>
          <a href="<?=$news[1]->guid?>" class="title"><?=$news[1]->post_title?></a>
        </div>
      </div>
      <?php } ?>
      <?php if(isset($news[2])){
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($news[2]->ID), 'large');
        $source_name = get_post_meta($news[2]->ID, 'source_name', true);
        $source_url = get_post_meta($news[2]->ID, 'source_url', true);
      ?>
      <div class="news-item">
        <a href="" class="thumb" style="background-image: url(<?=isset($thumb[0])?$thumb[0]:''?>);"></a>
        <div class="content">
          <div class="date"><?=date('M d, Y', strtotime($news[2]->post_date))?></div>
          <?php if($source_name!='' && $source_url!=''){ ?><ul class="category"><li><a href="<?=$source_url?>" target="_blank" rel="nofollow"><?=$source_name?></a></li></ul><?php } ?>
          <a href="<?=$news[2]->guid?>" class="title"><?=$news[2]->post_title?></a>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <a href="<?=get_home_url()?>/news/" class="read-more"><span class="glyphicon glyphicon-th-large"></span> Read older articles</a>
    </div>
  </div>
</div>
<?php get_footer();