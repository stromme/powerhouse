<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Powerhouse 2.0
 * @subpackage Powerhouse_v2
 * @since Powerhouse 1.0
 */

get_header();
?>
<div class="row">
  <div class="col-xs-12 col-md-12 col-lg-12"><?php
if ( have_posts() ) :
// Start the Loop.
while ( have_posts() ) : the_post();
the_excerpt();
endwhile;
endif; ?>
  </div>
</div>
<?
get_footer();