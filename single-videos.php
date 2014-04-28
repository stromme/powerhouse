<?php
get_header();
while ( have_posts() ) : the_post();
global $post;
$post = get_post(get_the_ID());
$post_meta = get_post_meta(get_the_ID());
$duration = isset($post_meta['duration'][0])?$post_meta['duration'][0]:'';
$url = isset($post_meta['youtube_url'][0])?$post_meta['youtube_url'][0]:'';
$recent = get_posts(array(
  'post_type' => 'videos',
  'numberposts' => 5,
  'order_by' => 'created',
  'order' => 'DESC',
  'exclude' => get_the_ID()
));
?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">New York's<br /><strong>most experienced</strong><br />paving team</div>
</div>
<div class="container article-content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
      <h1><?php the_title(); ?></h1><br />

      <?=($url!='')?wp_oembed_get($url):'<p>Sorry, video not found.</p>';?>
      <br /><br />
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
      <div class="sidebar">
        <div class="dark">
          <div class="glyphicon glyphicon-question-sign"></div>
          <div class="title">HAVE QUESTIONS?</div>
        </div>
        <a href="tel:<?=format_phone_plain('(631) 206-0046')?>"><span class="glyphicon glyphicon-earphone"></span> Talk to a specialist</a>
        <a href="mailto:support@powerhousepaving.com"><span class="glyphicon glyphicon-envelope"></span> Email us your question</a>
        <div><a href="" data-toggle="modal" data-target="#estimate" onclick="javascript:if(typeof ga!='undefined' && ga){ga('send', 'event', 'Interest', 'Open web lead', 'Header');}" class="button cta">GET AN ESTIMATE</a></div>
        <div class="shadow"></div>
      </div>
      <?php if(count($recent)>0){ ?>
      <div class="sidebar">
        <div class="dark">
          <div class="glyphicon glyphicon-info-sign"></div>
          <div class="title">RECENT POWERHOUSE VIDEOS</div>
        </div>
        <?php foreach($recent as $r){ ?>
        <a href="<?=$r->guid?>" class="indent"><?=$r->post_title?></a>
        <?php } ?>
        <div class="shadow"></div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php endwhile;
get_footer();