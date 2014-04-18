<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Powerhouse
 * @subpackage Powerhouse_v2
 * @since Powerhouse 1.0
 */
?>
		</div><!-- #main -->

		<div id="footer" class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
          <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 side-footer">
          <div class="title">CONTACT US</div>
          <div class="address">
            Powerhouse Paving LLC.<br />
            West Beech Street<br />
            Islip, NY 11751<br /><br />
            Phone: (631) 206-0046<br />
            Fax: &nbsp; &nbsp; (631) 206-0049
          </div>
          <div class="title">AFFILIATES</div>
          <a href="http://www.orangeseweranddrain.com" class="affiliate-link">
            <img src="<?=get_template_directory_uri()?>/images/orange_logo.jpg" />
          </a>
          <a href="http://www.pamsweeping.com" class="affiliate-link">
            <img src="<?=get_template_directory_uri()?>/images/pam_logo.jpg" />
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
          <div class="line"></div>
          <ul class="learn-more">
            <li class="title">LEARN MORE</li>
            <?php wp_nav_menu( array( 'theme_location' => 'learn-footer', 'container' => 'false', 'items_wrap' => '%3$s') ); ?>
          </ul>
          <div class="site-info">
            Powerhouse Paving is a leading provider of asphalt paving in the New York area.
            Our response teams are available 24/7.<br />All rights reserved &copy; 2014 <a href="<?=get_home_url()?>">Powerhouse Paving</a>
          </div><!-- .site-info -->
        </div>
      </div>
		</div><!-- #colophon -->
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>