<?php
/**
 * @package PC Advice Custom
 * @version 1.0
 */

/*
Plugin Name: PC Advice Custom
Description: Custom javascript and styles for PC Advice site
Author: mortalis
Version: 1.0
*/

function pcadvice_scripts() {
  wp_enqueue_style( 'pcadvice-addtoany', plugins_url('/css/add-to-any.css', __FILE__ ));
  
  wp_enqueue_script( 'pcadvice-masonry', plugins_url('/js/masonry.pkgd.min.js', __FILE__ ), '', '20150317', true );
  wp_enqueue_script( 'pcadvice-masonry-settings', plugins_url('/js/masonry-settings.js', __FILE__ ), array('jquery'), '20150317', true );
}
add_action( 'wp_enqueue_scripts', 'pcadvice_scripts' );
