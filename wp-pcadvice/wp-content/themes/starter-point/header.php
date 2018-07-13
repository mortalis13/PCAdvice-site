<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Starter
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php 
  $home_url=get_home_url();
  if(is_multisite())
    $home_url=network_home_url();
  $home_url=esc_url($home_url).'/';
?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

  <header id="masthead" class="site-header" role="banner">
    <?php 
      // adjust header image size in relation to the header height chosen in the customizer
    
      if (get_header_image()) { 
        $image=get_header_image();
        $height='auto;';
        
        $tmp=get_option('starter_scheme_options');
        $h=$tmp['header_min_height'];
        if($h=='250px') 
          $height=$tmp['header_min_height'];
        
        $style="background-image:url(".$image."); ";
      }else{
        $style="";
      }
    ?>

    <div class="site-branding" style="<?php echo $style ?>">
      <?php 
        // if no menu was assigned or the menu has no items then output just the search form
        
        $menu_items_count=0;
        $locations = get_nav_menu_locations();
        
        if( isset($locations['primary']) ){
          $the_menu = wp_get_nav_menu_object( $locations['primary'] ); 
          $menu_items_count=$the_menu->count;
        }

        if(!has_nav_menu('primary') || !$menu_items_count){
          get_search_form(); 
        }
      ?>

      <div class="title-box">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
      </div>
    </div>

    <?php if(has_nav_menu('primary') && $menu_items_count): ?>
      <nav id="site-navigation" class="main-navigation clear" role="navigation">
        <h1 class="menu-toggle"><a href="#"><?php _e( 'Menu', 'starter' ); ?></a></h1>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        <?php get_search_form(); ?>
      </nav><!-- #site-navigation -->
    <?php endif; ?>
    
  </header><!-- #masthead -->

  <div id="content" class="site-content">
