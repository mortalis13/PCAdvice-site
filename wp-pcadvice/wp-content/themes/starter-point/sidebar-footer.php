<?php
/**
 * The Masonry-powered footer sidebar
 *
 * @package Starter
 */

$starter_footer_widgets_option = get_option( 'footer_widgets_option' );
if(!$starter_footer_widgets_option) 
  $starter_footer_widgets_option='footer-widgets-off';

if ( ! is_active_sidebar( 'sidebar-2' ) || $starter_footer_widgets_option=='footer-widgets-off') {
  return;
}
?>

<div id="supplementary">
  <div id="footer-widgets" class="footer-widgets widget-area clear" role="complementary">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
  </div><!-- #footer-sidebar -->
</div><!-- #supplementary -->