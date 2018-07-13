<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter
 */
?>

<section class="<?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
    <div class="index-box">
      <header class="entry-header">
        <h1 class="entry-title">
            <?php
            if ( is_404() ) { _e( 'Page not available','starter' );

            } else if ( is_search() ) {
              /* translators: %s = search query */
              printf( __( 'Nothing found for <em>"%s"</em>','starter'), get_search_query());
            } else {
              _e( 'Nothing Found' );
            }
            ?>
        </h1>
      </header><!-- .page-header -->

      <div class="entry-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
          <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'starter' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
        <?php elseif ( is_404() ) : ?>
          <p><?php _e( 'You seem to be lost. To find what you are looking for use a search:', 'starter' ); ?></p>
          <?php get_search_form(); ?>
        <?php elseif ( is_search() ) : ?>
          <p><?php _e( 'Nothing matched your search terms. Try searching for something else:', 'starter' ); ?></p>
          <?php get_search_form(); ?>
        <?php else : ?>
          <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'starter' ); ?></p>
          <?php get_search_form(); ?>
        <?php endif; ?>
      </div><!-- .entry-content -->
    </div><!-- .index-box -->
</section><!-- .no-results -->
