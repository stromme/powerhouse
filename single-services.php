<?php
get_header();
while ( have_posts() ) : the_post();
$post_meta = get_post_meta(get_the_ID());
$resources = array();
for($i=1;$i<=10;$i++){
  if(isset($post_meta['resource_name_'.$i][0]) && isset($post_meta['resource_url_'.$i][0]) && $post_meta['resource_name_'.$i][0]!='' && $post_meta['resource_url_'.$i][0]){
    $resources[] = array(
      'name' => $post_meta['resource_name_'.$i][0],
      'url' => $post_meta['resource_url_'.$i][0],
      'type' => $post_meta['resource_type_'.$i][0]
    );
  }
}
$thumb_id = get_post_thumbnail_id(get_the_ID());
$slide_images = array();
$thumb = wp_get_attachment_image_src($thumb_id, 'full');
if(isset($thumb[0])) $slide_images[] = $thumb[0];
$args = array(
  'post_type' => 'attachment',
  'posts_per_page' => -1,
  'post_parent' => get_the_ID()
);
if($thumb_id){
  $args['exclude'] = $thumb_id;
}
$attachments = get_posts($args);
if(count($attachments)>0){
  foreach($attachments as $a){
    $image = wp_get_attachment_image_src($a->ID, 'full');
    $slide_images[] = $image[0];
  }
}
$slide_images = array_unique($slide_images);
$count_slide = count($slide_images);
if($count_slide>0){
?>
<div class="container full slide6040">
  <div class="p60">
    <div id="carousel-service" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for($i=0;$i<$count_slide;$i++){ ?>
        <li data-target="#carousel-service" data-slide-to="<?=$i?>"<?=($i==0)?' class="active"':''?>></li>
        <?php } ?>
      </ol>
      <div class="carousel-inner">
        <?php
        $i=0;
        foreach($slide_images as $s){
        ?>
        <div class="item<?=($i==0)?' active':''?>">
          <img src="<?=$s?>">
        </div>
        <?php $i++; } ?>
      </div>
    </div>
  </div>
  <div class="p40 cta">
    <div class="excerpt"><?=get_the_excerpt();?><br /><a href="" class="chevron">Get a quick estimate <b class="tux-icon chevron"></b></a></div>
  </div>
  <div class="clearfix"></div>
</div>
<?php } ?>
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
        <a href=""><span class="glyphicon glyphicon-earphone"></span> Talk to a specialist</a>
        <a href=""><span class="glyphicon glyphicon-envelope"></span> Email us your question</a>
        <div><a href="" class="button cta">GET AN ESTIMATE</a></div>
        <div class="shadow"></div>
      </div>
      <?php if(count($resources)>0){ ?>
      <div class="sidebar">
        <div class="dark">
          <div class="glyphicon glyphicon-info-sign"></div>
          <div class="title">RESOURCES</div>
        </div>
        <?php foreach($resources as $r){ ?>
        <a href="<?=$r['url']?>"><span class="glyphicon glyphicon-<?=($r['type']=='file')?'cloud-download':'link'?>"></span> <?=$r['name']?></a>
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