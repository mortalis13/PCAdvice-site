<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
    <?php //var_dump($wp_query->request); ?>

    <?php 
      $front_type=get_option('show_on_front');
      
      global $wpdb;
      $key='post_views_count';
      $post_viewes=$wpdb->get_col("select meta_value from $wpdb->postmeta where meta_key='".$key."'");
      $have_viewes=false;
      
      if($post_viewes){
        foreach($post_viewes as $pv){
          if($pv>0){
            $have_viewes=true;
            break;
          }
        }
      }
      
      // check if some of posts have views more that 0
      // if front page type is 'most_viewed' show them
      // if no most viewed posts yet then just show all (regular blog view)

      if($front_type=='most_viewed' && $have_viewes):                    // Most Viewed branch
        $posts_count=get_option('most_viewed_count','3');
        $args=array(
          'posts_per_page'=>$posts_count,
          'meta_key'=>'post_views_count',
          'meta_value'=>0,
          'meta_compare'=>'>',
          'orderby'=>'post_views_count',
          'order'=>'DESC',
        );
        $wp_query=new WP_Query($args);
    ?>
        <?php if ( $wp_query->have_posts() ) : ?>
          <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <?php
              get_template_part( 'content', get_post_format() );
            ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>

      <?php else: ?>                                                   <!-- Latest Posts (default) branch -->
        
        <?php if ( have_posts() ) : ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <?php
              /* Include the Post-Format-specific template for the content.
               * If you want to override this in a child theme, then include a file
               * called content-___.php (where ___ is the Post Format name) and that will be used instead.
               */
              get_template_part( 'content', get_post_format() );
            ?>
          <?php endwhile; ?>

          <?php starter_paging_nav(); ?>
        <?php else : ?>
          <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>

      <?php endif; ?> <!-- if($front_type=='most_viewed' && $have_viewes) -->

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
