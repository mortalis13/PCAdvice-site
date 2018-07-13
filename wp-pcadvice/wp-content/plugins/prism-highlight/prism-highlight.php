<?php
/**
 * @package Prism Highlight
 * @version 1.0
 */
/*
Plugin Name: Prism Highlight
Description: Prism.js syntax highlight
Author: mortalis
Version: 1.0
*/

function prism_add_scripts() {
  global $post, $wp_query;
  $post_content = '';

  if ( is_singular() ) {
    $post_content = $post->post_content;
  }
  elseif(is_home()){
    $posts=$wp_query->posts;
    if($posts){
      foreach($posts as $post){
        $post_content.=$post->post_content.' ';
      }
    }
  }

  $load_prism=false;
  
  if(preg_match('/<pre class=.*[^-]\bcode-/', $post_content) ||
    preg_match('/<pre class=.*[^-]\bline-numbers\b[^-]/', $post_content) ||
    preg_match('/<pre class=.*[^-]\blanguage-/', $post_content)){
    $load_prism=true;
  }
  
  if ($load_prism) {
    wp_enqueue_script( 'markup', plugins_url( '/js/markup.js', __FILE__ ), array('jquery'), '1.0', true );
    wp_enqueue_style( 'prism-css' , plugins_url( '/css/prism.css', __FILE__ ) );
    wp_enqueue_script( 'prism_js', plugins_url( '/js/prism.js', __FILE__ ), '', '1.0', true );
  }
}
add_action( 'wp_enqueue_scripts', 'prism_add_scripts',15 );
