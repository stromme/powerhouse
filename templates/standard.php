<?php
/**
 * Template Name: Standard
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
<?php while ( have_posts() ) : the_post(); ?>
<div class="container article-content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
      <h2 class="title"><?php the_title(); ?></h2>
      <?php the_content(); ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
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