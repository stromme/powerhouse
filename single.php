<?php get_header(); ?>
<?php the_post(); ?>
<div class="container article-content">
  <div class="row">
    <div class="col-xs-12">
    <h1><?php the_title(); ?></h1>
    <div class="small"><?php the_date(); ?> <?php get_the_term_list(get_the_ID(), 'category'); ?></div><br />

    <?php the_content(); ?>
    </div>
  </div>
</div>
<? get_footer();