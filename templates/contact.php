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
        <div><a href="" class="dark"><span class="glyphicon glyphicon-question-sign"></span> HAVE QUESTIONS?</a></div>
        <div><a href=""><span class="glyphicon glyphicon-earphone"></span> (631) 206-0046</a></div>
        <div><a href=""><span class="glyphicon glyphicon-envelope"></span> support@powerhousepaving.com</a></div>
        <a class="button cta" href="">GET AN ESTIMATE</a>
      </div>
      <div class="shadow"></div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
      <div class="address">
        <div class="map">
          <img src="<?=get_template_directory_uri()?>/images/map.jpg" />
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
      $teams[$i]->term_id = isset($terms[0]->term_id)?$terms[0]->term_id:'';
      $teams[$i]->term_name = isset($terms[0]->name)?$terms[0]->name:'';
      $teams[$i]->term_parent_id = isset($terms[0]->parent)?$terms[0]->parent:'';
    }
  }
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
            <img src="<?=isset($thumb[0])?$thumb[0]:''?>" />
          </div>
          <div class="details">
            <div class="name"><?=$t->post_title?></div>
            <div class="position"><?=$t->term_name?></div>
            <?php if($t->post_excerpt!=''){ ?>
            <p class="excerpt"><?=get_excerpt($t->post_excerpt, 80)?>... <a href="<?=$t->guid?>">Read more</a></p>
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
  <!--div class="row">
    <div class="col-xs-12">
      <fieldset><legend><h2 class="title">Orange Industries Team</h2></legend></fieldset>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="contact-item">
        <div class="background">
          <div class="photo">
            <img src="<?=get_template_directory_uri()?>/images/photo-amandavega.jpg" />
          </div>
          <div class="details">
            <div class="name">Amanda Vega</div>
            <div class="position">Project Manager</div>
            <div class="social-contact">
              <a href="" class="social facebook"></a>
              <a href="" class="social google_plus"></a>
              <a href="" class="social twitter"></a>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="contact-item">
        <div class="background">
          <div class="photo">
            <img src="<?=get_template_directory_uri()?>/images/photo-amandavega.jpg" />
          </div>
          <div class="details">
            <div class="name">Amanda Vega</div>
            <div class="position">Project Manager</div>
            <div class="social-contact">
              <a href="" class="social facebook"></a>
              <a href="" class="social google_plus"></a>
              <a href="" class="social twitter"></a>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="contact-item">
        <div class="background">
          <div class="photo">
            <img src="<?=get_template_directory_uri()?>/images/photo-amandavega.jpg" />
          </div>
          <div class="details">
            <div class="name">Amanda Vega</div>
            <div class="position">Project Manager</div>
            <div class="social-contact">
              <a href="" class="social facebook"></a>
              <a href="" class="social google_plus"></a>
              <a href="" class="social twitter"></a>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="contact-item">
        <div class="background">
          <div class="photo">
            <img src="<?=get_template_directory_uri()?>/images/photo-amandavega.jpg" />
          </div>
          <div class="details">
            <div class="name">Amanda Vega</div>
            <div class="position">Project Manager</div>
            <div class="social-contact">
              <a href="" class="social facebook"></a>
              <a href="" class="social google_plus"></a>
              <a href="" class="social twitter"></a>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div-->
</div>
<?php get_footer();