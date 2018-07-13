<?php
/**
 * The template for displaying image attachments
 *
 * @package Starter
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
      ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php 
            // Previous/next post navigation.
            the_post_navigation( array(
              'prev_text' => _x( '<span class="post-title"><em>%title</em></span>', 'Parent post link', 'starter' ),
            ) ); 
          ?>

          <nav id="image-navigation" class="navigation image-navigation">
            <div class="nav-links">
              <div class="nav-previous"><?php previous_image_link( false, __( '<i class="fa fa-long-arrow-left"></i> Previous Image', 'starter' ) ); ?></div>
              <div class="nav-next"><?php next_image_link( false, __( 'Next Image <i class="fa fa-long-arrow-right"></i>', 'starter' ) ); ?></div>
            </div><!-- .nav-links -->
          </nav><!-- .image-navigation -->

          <header class="entry-header text-center">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <div class="entry-attachment text-center">
              <?php
                $image_size = apply_filters( 'starter_attachment_size', 'large' );
                echo wp_get_attachment_image( get_the_ID(), $image_size );
              ?>

              <?php if ( has_excerpt() ) : ?>
                <div class="entry-caption">
                  <?php the_excerpt(); ?>
                </div><!-- .entry-caption -->
              <?php endif; ?>

            </div><!-- .entry-attachment -->

            <?php
              the_content();
              wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'starter' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'starter' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
              ) );
            ?>
          </div><!-- .entry-content -->

          <footer class="entry-footer">
            <?php 
              if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
                starter_posted_on();
              }

              if ( is_attachment() && wp_attachment_is_image() ) {
                // Retrieve attachment metadata.
                $metadata = wp_get_attachment_metadata();

                printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
                  _x( 'Full size', 'Used before full size attachment link.', 'starter' ),
                  esc_url( wp_get_attachment_url() ),
                  $metadata['width'],
                  $metadata['height']
                );
              }
            ?>

            <?php edit_post_link( __( 'Edit', 'starter' ), '<span class="edit-link">', '</span>' ); ?>
          </footer><!-- .entry-footer -->

        </article><!-- #post-## -->

        <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
        // End the loop.
        endwhile;
      ?>

    </main><!-- .site-main -->
  </div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
