<?php
get_header();
while ( have_posts() ) : the_post();
$post_meta = get_post_meta(get_the_ID());
$source = isset($post_meta['source_name'][0])?$post_meta['source_name'][0]:'';
$url = isset($post_meta['source_url'][0])?$post_meta['source_url'][0]:'';
$thumb_id = get_post_thumbnail_id(get_the_ID());
$thumb = wp_get_attachment_image_src($thumb_id, 'full');
$featured_image = '';
if(isset($thumb[0])) $featured_image = $thumb[0];
$recent = get_posts(array(
  'post_type' => 'news',
  'numberposts' => 5,
  'order_by' => 'created',
  'order' => 'DESC',
  'exclude' => get_the_ID()
));
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=525073757548923";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container full news-banner-6040">
  <div class="p40" style="background-image:url(<?=$featured_image?>);"></div>
  <div class="p60">
    <?php
    $prev_post = get_adjacent_post();
    $next_post = get_adjacent_post(false, '', false);
    ?>
    <?php if($prev_post!=''){ ?><div class="prev"><a href="<?=get_permalink($prev_post)?>"><span class="glyphicon glyphicon-collapse-down"></span> Previous article</a></div><?php } ?>
    <?php if($next_post!=''){ ?><div class="next"><a href="<?=get_permalink($next_post)?>">Next article <span class="glyphicon glyphicon-expand"></span></a></div><?php } ?>
    <div class="clearfix"></div>
    <h1><?=get_the_title()?></h1>
    <?php if($source && $url){ ?><a href="<?=$url?>" class="source" rel="nofollow"><?=$source?></a> <?php } ?><span class="date">| January 15, 2014</span>
    <p class="excerpt"><?=get_the_excerpt();?></p>
    <div class="social-share">
      <div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
      <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="container article-content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
      <?php the_content(); ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
      <div class="sidebar">
        <div class="dark">
          <div class="glyphicon glyphicon-question-sign"></div>
          <div class="title">HAVE QUESTIONS?</div>
        </div>
        <a href="tel:<?=format_phone_plain('(631) 206-0046')?>"><span class="glyphicon glyphicon-earphone"></span> Talk to a specialist</a>
        <a href="mailto:support@powerhousepaving.com"><span class="glyphicon glyphicon-envelope"></span> Email us your question</a>
        <div><a href="" class="button cta">GET AN ESTIMATE</a></div>
        <div class="shadow"></div>
      </div>
      <?php if(count($recent)>0){ ?>
      <div class="sidebar">
        <div class="dark">
          <div class="glyphicon glyphicon-info-sign"></div>
          <div class="title">RECENT POWERHOUSE NEWS</div>
        </div>
        <?php foreach($recent as $r){ ?>
        <a href="<?=$r->guid?>" class="indent"><?=$r->post_title?></a>
        <?php } ?>
        <div class="shadow"></div>
      </div>
      <?php } ?>
      <?php
      $terms = wp_get_post_terms(get_the_ID(), 'category');
      $term_id = isset($terms[0]->term_id)?$terms[0]->term_id:'';
      if($term_id!=''){
        $services = get_posts(array(
          'post_type' => 'services',
          'numberposts' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'category',
              'field' => 'id',
              'terms' => $term_id
            )
          ),
          'exclude' => get_the_ID()
        ));
        if(count($services)>0){
      ?>
      <div class="sidebar">
        <div class="glyphicon glyphicon-cog"></div>
        <div class="list">
          <div class="title">RELATED SERVICES</div>
          <ul>
            <?php foreach($services as $s){ ?>
            <li><a href="<?=$s->guid?>"><?=$s->post_title?></a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="shadow"></div>
      </div>
      <?php } } ?>
    </div>
  </div>
</div>
<?php endwhile;
get_footer();