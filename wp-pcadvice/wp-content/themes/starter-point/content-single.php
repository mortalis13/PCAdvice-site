<?php
/**
 * Outputs the single post content. Displayed by single.php.
 * 
 * @package Starter
 */
?>

  <?php $category_list = starter_get_the_category_list( ', ',true," &raquo " ); ?>
  <div class="category-list-single">
    <?php echo $category_list ?>
  </div> 
  
  <?php 
    if(!is_user_logged_in())
      setPostViews(get_the_Id());
  ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header clear">
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

      <div class="entry-meta">
        <?php starter_posted_on(); ?>
        <?php 
          if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
            echo ' | <span class="comments-link">';
            starter_get_comments_link();
            echo '</span>';
          }
        ?>
        <?php edit_post_link( sprintf( '%s', __( 'Edit', 'starter' ) ), '<span class="edit-link"> | ', '</span>' ); ?>
      </div>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <?php the_content(); ?>
      
      <?php 
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
        $tags = get_the_tag_list( 
          '<ul class="tag-list"><li><i class="dashicons dashicons-tag"></i>', 
          '</li><li><i class="dashicons dashicons-tag"></i>', 
          '</li></ul>' 
        );
        echo $tags;
      ?>
    </footer><!-- .entry-footer -->
  </article><!-- #post-## -->
