<?php get_header(); ?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">New York's<br /><strong>most experienced</strong><br />paving team</div>
</div>
<?php while ( have_posts() ) : the_post();
$post_meta = get_post_meta(get_the_ID());
$phone = isset($post_meta['phone'][0])?$post_meta['phone'][0]:'';
$email = isset($post_meta['email'][0])?$post_meta['email'][0]:'';
$fb = isset($post_meta['facebook'][0])?$post_meta['facebook'][0]:'';
$gp = isset($post_meta['googleplus'][0])?$post_meta['googleplus'][0]:'';
$tw = isset($post_meta['twitter'][0])?$post_meta['twitter'][0]:'';
$terms = wp_get_post_terms(get_the_ID(), 'position');
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
?>
<div class="container contact-person">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      <div class="photo">
        <img src="<?=isset($thumb[0])?$thumb[0]:get_template_directory_uri().'/images/no-photo.jpg'?>" />
      </div>
      <div class="details">
        <div class="name"><?=get_the_title()?></div>
        <div class="position"><?=isset($terms[0]->name)?$terms[0]->name:''?></div>
        <div class="phone"><?php if($phone!=''){ ?><a href="tel:<?=format_phone_plain($phone)?>"><span class="glyphicon glyphicon-earphone"></span> <?=$phone?></a><?php } ?></div>
        <div class="email"><?php if($email!=''){ ?><a href="mailto:<?=$email?>"><span class="glyphicon glyphicon-envelope"></span> <?=$email?></a><?php } ?></div>
        <div class="social-contact">
          <?php if($fb!=''){ ?><a href="<?=$fb?>" class="social facebook"></a><?php } ?>
          <?php if($gp!=''){ ?><a href="<?=$gp?>" class="social google_plus"></a><?php } ?>
          <?php if($tw!=''){ ?><a href="<?=$tw?>" class="social twitter"></a><?php } ?>
          <div class="clearfix"></div>
        </div>
        <p>
          <?php the_content(); ?>
        </p>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      <div class="sidebar">
        <div class="glyphicon glyphicon-cog"></div>
        <div class="list">
          <div class="title">LEARN MORE</div>
          <?php wp_nav_menu( array( 'theme_location' => 'learn', 'container' => 'false') ); ?>
        </div>
        <div class="shadow"></div>
      </div>
    </div>
  </div>
</div>
<?php endwhile;
get_footer();