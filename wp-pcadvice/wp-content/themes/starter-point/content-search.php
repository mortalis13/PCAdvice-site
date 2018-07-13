<?php
/**
 * @package Starter
 */
?>

  <?php $class=starter_get_post_class(false); ?>

  <article id="post-<?php the_ID(); ?>" <?php echo $class ?>>
    <div class="index-box">
      <header class="entry-header clear">
        <?php
          $category_list = starter_get_the_category_list(', ');
          if ( starter_categorized_blog() && 'post' == get_post_type()) {
              echo '<div class="category-list">' . $category_list . '</div>';
          }
        ?>
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php 
          if(get_post_type()=='page'){
            echo '<div class="page-label">'._x('Page','Search results label','starter').'</div>';
          } 
        ?>
      </header><!-- .entry-header -->

      <div class="entry-content">
          <?php 
            the_excerpt(); 
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
                        // comments_popup_link( __( 'Leave a comment', 'starter' ), __( '1 Comment', 'starter' ), __( '% Comments', 'starter' ) );
                        
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
              $continueRead=__('Continue Reading', 'starter');
              $title=$continueRead. get_the_title();
              $text=$continueRead . '<i class="fa fa-arrow-circle-o-right"></i>';
              
              if(get_post_type()=='page')
                $text='<em>'.$text.'</em>';
            ?>
            
            <a href="<?php echo get_permalink() ?>" title="<?php echo $title ?>" rel="bookmark">
              <?php echo $text ?><span class="screen-reader-text"> <?php echo get_the_title() ?></span>
            </a>
          </div>

      </footer><!-- .entry-footer -->
    </div>
    
    <div class="article-divider"></div>
</article><!-- #post-## -->
