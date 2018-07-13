<?php
/**
 * @package Custom media manager style
 * @version 1.0
 */
/*
Plugin Name: Custom media manager style
Description: Custom media manager style
Author: mortalis
Version: 1.0
*/

function custom_media_manager_style()
{
  ?>
  <style id="media-custom">
    .media-frame-menu{
      width:150px !important;
    }
    .media-frame-title,
    .media-frame-router,
    .media-frame-content {
      left:150px !important;
    }
    .media-sidebar {
      width:467px !important;
    }   
    .attachments-browser .attachments{
      right:500px !important;
    }
    .setting[data-setting="caption"]{
      display: none !important;
    }
  </style>
  <?php
}
add_action( 'print_media_templates', 'custom_media_manager_style' );


function custom_media_uploader( $strings ) {
  return $strings;
}
add_filter( 'media_view_strings', 'custom_media_uploader' );

function custom_media_settings( $settings ) {
  return $settings;
}
add_filter( 'media_view_settings', 'custom_media_settings' );
