<?php
/**
 * Template Name: Standard
 * Description:
 *
 * @package WordPress
 * @subpackage Hatch
 * @since
 */

get_header();
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
?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">New York's<br /><strong>most experienced</strong><br />paving team</div>
</div>
<?php while ( have_posts() ) : the_post(); ?>
<div class="container article-content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
      <h2 class="title"><?php the_title(); ?></h2>
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
        <div><a href="" data-toggle="modal" data-target="#estimate" onclick="javascript:if(typeof ga!='undefined' && ga){ga('send', 'event', 'Interest', 'Open web lead', 'Header');}" class="button cta">GET AN ESTIMATE</a></div>
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
    </div>
  </div>
</div>
<?php endwhile;
get_footer();