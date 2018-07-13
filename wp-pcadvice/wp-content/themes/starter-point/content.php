<?php
/**
 * @package Starter
 */
?>

  <?php $class=starter_get_post_class(); ?>

  <article id="post-<?php the_ID(); ?>" <?php echo $class; ?>>
    <div class="index-box">
      <header class="entry-header clear">
        <?php
          /* translators: used between list items, there is a space after the comma */
          $category_list = starter_get_the_category_list(', ');
          if ( starter_categorized_blog() ) {
              echo '<div class="category-list">' . $category_list . '</div>';
          }
        ?>
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
      </header><!-- .entry-header -->

      <div class="entry-content">
          <?php 
            // show excerpt if present or the content (with or without Read More)
          
            if(has_excerpt(get_the_ID())){
              the_excerpt(); 
            } else {
              the_content('');
            }
            
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

      <footer class="entry-footer continue-reading">
          <?php if ( 'post' == get_post_type() ) : ?>
            <div class="entry-meta">
              <?php 
                if ( is_sticky() && is_home() && ! is_paged() ) {
                  printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'starter' ) );
                }
                starter_posted_on(); 
              ?>

              <?php 
                $show_comments=!post_password_required() && (comments_open() || '0' != get_comments_number());
                $can_edit=current_user_can( 'edit_post', $post->ID );

                if($show_comments || $can_edit): 
              ?>
                  <div class="meta-second-line">
                    <?php
                      if ($show_comments){
                        starter_get_comments_link();
                        if($can_edit) echo ' | ';
                      }
                      edit_post_link( sprintf( '%s', __( 'Edit', 'starter' ) ), '<span class="edit-link">', '</span>' );
                    ?>
                  </div> 
                <?php endif; ?>
            </div><!-- .entry-meta -->
          <?php endif; ?>

          <div class="continue-read">
            <?php
              // different Continue Read labels for excerpt/read more/full content
            
              if (has_excerpt(get_the_ID())) {
                $title=__('Continue Reading', 'starter') .' '. get_the_title();
                $text=__('Continue Reading...', 'starter');
              } else {
                $title=_x('Read', 'First part of "Read *article title* in title tag of Read more link', 'starter').' '.get_the_title();

                if(starter_has_read_more($post->post_content))
                  $text=__('Continue<span aria-hidden="true"> reading</span>...', 'starter');
                else
                  $text=__('Read <span aria-hidden="true">the article</span>', 'starter').'<i class="fa fa-arrow-circle-o-right"></i>';
              }
            ?>
              <a href="<?php echo get_permalink() ?>" title="<?php echo $title ?>" rel="bookmark">
                <?php echo $text ?><span class="screen-reader-text"> <?php echo get_the_title() ?></span>
              </a>
          </div>
          
          <?php
            $tags = get_the_tag_list( 
              '<ul class="tag-list"><li><i class="dashicons dashicons-tag"></i>', 
              '</li><li><i class="dashicons dashicons-tag"></i>', 
              '</li></ul>' 
            );
            echo $tags;
          ?>
      </footer><!-- .entry-footer -->
    </div>
    
    <div class="article-divider"></div>
</article><!-- #post-## -->
