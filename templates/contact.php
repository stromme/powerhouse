<?php
/**
 * Template Name: Contact
 * Description:
 *
 * @package WordPress
 * @subpackage Hatch
 * @since
 */

get_header(); ?>
<div class="static-banner">
  <img src="<?=get_template_directory_uri()?>/images/static_banner.jpg" />
  <div class="caption">New York's<br /><strong>most experienced</strong><br />paving team</div>
</div>
<div class="container contact-details">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
      <div class="contact-cta">
        <div><span class="dark"><span class="glyphicon glyphicon-question-sign"></span> HAVE QUESTIONS?</span></div>
        <div><a href="tel:<?=format_phone_plain(get_contact_number())?>"><span class="glyphicon glyphicon-earphone"></span> <?=get_contact_number()?></a></div>
        <div><a href="mailto:support@powerhousepaving.com"><span class="glyphicon glyphicon-envelope"></span> support@powerhousepaving.com</a></div>
        <a class="button cta" href="" data-toggle="modal" data-target="#estimate" onclick="javascript:if(typeof ga!='undefined' && ga){ga('send', 'event', 'Interest', 'Open web lead', 'Body');}">GET A QUOTE</a>
      </div>
      <div class="shadow"></div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
      <div class="address">
        <div class="map">
          <img src="http://maps.google.com/maps/api/staticmap?center=23+West+Beech+Street+Islip%2C+NY+11751&amp;zoom=11&amp;size=400x300&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:A%7C23+West+Beech+Street+Islip%2C+NY+11751&amp;sensor=false&amp;key=AIzaSyDsgeBIjdh92uqzr0jWMHz_2YRljj_4sxc" />
        </div>
        <div class="details">
          <span class="glyphicon glyphicon-info-sign"></span>
          <div class="content">
            VISIT POWERHOUSE PAVING<br /><br />
            23 West Beech Street</br >
            Islip, NY 11751</br >
            USA
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="shadow"></div>
    </div>
  </div>
</div>
<div class="container contact-block">
  <?php
  $teams = get_posts(array(
    'post_type' => 'team',
    'numberposts' => -1,
    'order_by' => 'ID',
    'order' => 'ASC'
  ));
  if(count($teams)>0){
    foreach($teams as $i=>$t){
      $terms = wp_get_post_terms($t->ID, 'position');
      $order = get_post_meta($t->ID, 'order', true);
      $teams[$i]->term_id = isset($terms[0]->term_id)?$terms[0]->term_id:'';
      $teams[$i]->term_name = isset($terms[0]->name)?$terms[0]->name:'';
      $teams[$i]->term_parent_id = isset($terms[0]->parent)?$terms[0]->parent:'';
      $teams[$i]->order = ($order>0)?intval($order):999;
    }
  }
  uasort($teams, "compare_order");
  $parent_terms = get_terms('position');
  if(count($parent_terms)>0){
    foreach($parent_terms as $pt){
      if($pt->parent==0){
  ?>
  <div class="row">
    <div class="col-xs-12">
      <fieldset><legend><h2 class="title"><?=$pt->name?></h2></legend></fieldset>
    </div>
      <?php
        foreach($teams as $t){
          if($t->term_parent_id==$pt->term_id){
            $post_meta = get_post_meta($t->ID);
            $fb = isset($post_meta['facebook'][0])?$post_meta['facebook'][0]:'';
            $gp = isset($post_meta['googleplus'][0])?$post_meta['googleplus'][0]:'';
            $tw = isset($post_meta['twitter'][0])?$post_meta['twitter'][0]:'';
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($t->ID), 'large');
      ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="contact-item">
        <div class="background">
          <div class="photo">
            <img src="<?=isset($thumb[0])?$thumb[0]:get_template_directory_uri().'/images/no-photo.jpg'?>" />
          </div>
          <div class="details">
            <a href="<?=$t->guid?>" class="name"><?=$t->post_title?></a>
            <div class="position"><?=$t->term_name?></div>
            <?php if($t->post_excerpt!=''){ ?>
            <p class="excerpt"><?=get_excerpt($t->post_excerpt, 63)?>... <a href="<?=$t->guid?>">Read more</a></p>
            <?php } ?>
            <div class="social-contact">
              <?php if($fb!=''){ ?><a href="<?=$fb?>" class="social facebook"></a><?php } ?>
              <?php if($gp!=''){ ?><a href="<?=$gp?>" class="social google_plus"></a><?php } ?>
              <?php if($tw!=''){ ?><a href="<?=$tw?>" class="social twitter"></a><?php } ?>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
      <?php
          }
        }
      ?>
  </div>
  <?php
      }
    }
  }
  ?>
</div>
<?php get_footer();