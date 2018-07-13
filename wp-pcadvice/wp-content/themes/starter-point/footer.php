<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Starter
 */
?>

  </div><!-- #content -->

  <footer id="colophon" class="site-footer" role="contentinfo">
    <?php if(has_nav_menu('footer')): ?>
      <nav id="footer-navigation" class="footer-navigation clear" role="navigation">
        <?php wp_nav_menu( array( 
          'theme_location' => 'footer',
          'container_class'=>'footer-menu-container',
          'link_before'     => '<span class="screen-reader-text">',
          'link_after'      => '</span>',
        ) ); ?>
      </nav>
    <?php endif; ?>
    
    <div class="footer-content">
      <?php $date = date('Y', time()); ?>
      <div class="footer-info">&copy; <?php echo $date?></div>
      <div class="footer-text">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      </div>
    </div>
    
    <?php get_sidebar( 'footer' ); ?>
    
    <?php $image=get_template_directory_uri().'/images/to-top@2x.png'; ?>
    <a id="toTop" href="#"></a>
  </footer><!-- #colophon -->
  
  
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>