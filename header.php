<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Powerhouse
 * @subpackage Powerhouse_v2
 * @since Powerhouse 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=wp_title( '|', false, 'right' ).get_bloginfo()?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
  <div id="header" class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
      <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img src="<?=(get_header_image())?header_image():get_template_directory_uri().'/images/logo@2x.png'?>" width="427" alt="<?php bloginfo( 'name' ); ?>">
      </a>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7 main-nav-container">
        <div class="main-nav">
          <span class="dropdown services-menu">
            <a href="#" data-toggle="dropdown" class="button hover dropdown-toggle"><span class="glyphicon glyphicon-cog"></span> SERVICES<div class="arrow"></div></a>
            <?php $menu_count = count_menu('header'); ?>
            <div class="dropdown-menu menu-column-<?=$menu_count['parent']?>">
              <div class="arrow"></div>
              <?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'menu_class' => '' ) ); ?>
            </div>
          </span>
          <span class="dropdown learn-menu">
            <a href="#" data-toggle="dropdown" class="button hover dropdown-toggle"><span class="glyphicon glyphicon-align-justify"></span> LEARN</a>
            <div class="dropdown-menu">
              <div class="arrow"></div>
              <?php wp_nav_menu( array( 'theme_location' => 'learn', 'container' => false, 'menu_class' => '' ) ); ?>
            </div>
          </span>
          <a href="" data-toggle="modal" data-target="#estimate" onclick="javascript:if(typeof ga!='undefined' && ga){ga('send', 'event', 'Interest', 'Open web lead', 'Header');}" class="button cta">GET A QUOTE</a>
          <a href="tel:<?=format_phone_plain(get_contact_number())?>" class="button phone"><span class="glyphicon glyphicon-earphone"></span> <?=get_contact_number()?></a>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
	<div id="body" class="container full">