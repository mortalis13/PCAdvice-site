<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Starter
 */

$starter_sidebar_option = get_option( 'sidebar_option' );
if(!$starter_sidebar_option) 
  $starter_sidebar_option='sidebar-off';

if ( ! is_active_sidebar( 'sidebar-1' ) || $starter_sidebar_option=='sidebar-off') {
  return;
}
?>
  <div id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div><!-- #secondary -->

