<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Starter
 */

if ( ! function_exists( 'starter_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function starter_paging_nav() {
  // Don't print empty markup if there's only one page.
  if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
    return;
  }

  $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
  $pagenum_link = html_entity_decode( get_pagenum_link() );
  $query_args   = array();
  $url_parts    = explode( '?', $pagenum_link );

  if ( isset( $url_parts[1] ) ) {
    wp_parse_str( $url_parts[1], $query_args );
  }

  $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
  $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

  $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
  $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

  // Set up paginated links.
  $links = paginate_links( array(
    'base'     => $pagenum_link,
    'format'   => $format,
    'total'    => $GLOBALS['wp_query']->max_num_pages,
    'current'  => $paged,
    'mid_size' => 2,
    'add_args' => array_map( 'urlencode', $query_args ),
    'prev_text' => '&larr; '.__( 'Previous', 'starter' ),
    'next_text' => __( 'Next', 'starter' ).' &rarr;',
    'type'      => 'list',
  ) );

  if ( $links ) :

  ?>
  <nav class="navigation paging-navigation" role="navigation">
    <h1 class="screen-reader-text"><?php _e( 'Page navigation', 'starter' ); ?></h1>
      <?php echo $links; ?>
  </nav><!-- .navigation -->
  <?php
  endif;
}
endif;

if ( ! function_exists( 'starter_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function starter_post_nav() {
  // Don't print empty markup if there's nowhere to navigate.
  $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );

  if ( ! $next && ! $previous ) {
    return;
  }
  ?>

  <nav class="navigation post-navigation" role="navigation">
    <div class="post-nav-box clear">
      <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'starter' ); ?></h1>
      <div class="nav-links">
        <?php
          previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . __( 'Previous Post', 'starter' ).':' . '</div><h1>%link</h1></div>', '%title',true );
          next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . __( 'Next Post', 'starter' ).':' . '</div><h1>%link</h1></div>', '%title',true );
        ?>
      </div><!-- .nav-links -->
    </div><!-- .post-nav-box -->
  </nav><!-- .navigation -->

  <?php
}
endif;

if ( ! function_exists( 'starter_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function starter_posted_on() {
  $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date( _x('d.m.Y', 'Posted on date', 'starter') ) )
  );

  $time_title=esc_html( get_the_date( _x('H:i', 'Posted on time', 'starter') ) );

  // Translators: Text wrapped in mobile-hide class is hidden on wider screens.
  printf( _x( '<span class="posted-on">%1$s</span><span class="mobile-hide"></span>', 'mobile-hide class is used to hide connecting elements like "on" and "." on wider screens.', 'starter' ),
    sprintf( '<a href="%1$s" rel="bookmark" title="%3$s" >%2$s</a>',
      esc_url( get_permalink() ),
      $time_string,
      $time_title
    )
  );
}
endif;

if ( ! function_exists( 'starter_categorized_blog' ) ) :
/**
 * Returns true if a blog has more than 1 category.
 */
function starter_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,
      
      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'all_the_cool_cats', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so starter_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so starter_categorized_blog should return false.
    return false;
  }
}
endif;

if ( ! function_exists( 'starter_category_transient_flusher' ) ) :
/**
 * Flush out the transients used in starter_categorized_blog.
 */
function starter_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'all_the_cool_cats' );
}
endif;
add_action( 'edit_category', 'starter_category_transient_flusher' );
add_action( 'save_post',     'starter_category_transient_flusher' );

if ( ! function_exists( 'starter_get_sortable_headers' ) ) :
/**
 * Sortable headers (links and titles) in the category table
 *
 * Returns the $links array with this structure:
 * array(
 *   '[header]'=>array(
 *     'orderby'=>'[header]',
 *     'order'=>'[asc|desc]',
 *     'label'=>'[label]'
 *   ),
 *   ...
 * )
 *
 */
function starter_get_sortable_headers() {
  $columns=array('date','title','comments','views');
  $labels=array(
    __('Date','starter'),
    __('Title','starter'),
    __('Comments','starter'),
    __('Views','starter'),
  );
  $link_data=array_fill_keys($columns, array_fill_keys(array('orderby','order','label'),''));
  
  foreach($columns as $key=>$col){
    $link_data[$col]['orderby']=$col;
    $link_data[$col]['order']='asc';
    $link_data[$col]['label']=$labels[$key];
  }
  
  $links=array();
  $current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
  
  foreach($columns as $col){
    $orderby=$link_data[$col]['orderby'];
    $order=$link_data[$col]['order'];
    $label=$link_data[$col]['label'];
    $dir='';
    
    if(isset($_GET['orderby'])){
      $url_orderby=$_GET['orderby'];
      $url_order=$_GET['order'];
      
      if($url_orderby==$orderby){
        switch ($url_order) {
          case 'asc':
            $dir='<i class="fa fa-caret-up"></i>';
            break;
          case 'desc':
            $dir='<i class="fa fa-caret-down"></i>';
            break;
        }
        $order=$url_order=='asc'?'desc':'asc';
      }
    }
    
    $link=esc_url( add_query_arg( compact( 'orderby', 'order' ), $current_url ) );
    $link='<a href="'.$link.'">'.$label;
    
    $link.='</a>';
    $link.='&nbsp;'.$dir;
    
    $links[$col]=$link;
  } 
  
  return $links;
}
endif;

if ( ! function_exists( 'starter_get_post_class' ) ) :
/**
 * Get post class for a blog/home page. 
 * Returns the default class for all posts except the last one to apply custom layout styles.
 */
function starter_get_post_class($home=true) {
  global $wp_query;
  $class='class="' . join( ' ', get_post_class('',null ) );
  
  if($home){
    $front_type=get_option('show_on_front');
    if(is_front_page() || is_home()){
      if($front_type!='most_viewed' && $wp_query->current_post == $wp_query->post_count-1)
        $class.=' last-post';
    }
  }
  else{
    if( $wp_query->current_post == $wp_query->post_count-1 )
      $class.=' last-post';
  }
  
  $class.='"';
  
  return $class;
}
endif;

if ( ! function_exists( 'starter_get_category_parents' ) ) :
/**
 * Get category parents 
 * Override of /wp-includes/category-template.php::get_category_parents()
 */
function starter_get_category_parents( $id, $link = false, $separator = '/',$class='') {
  $chain = '';
  $parent = get_term( $id, 'category' );
  if ( is_wp_error( $parent ) )
    return $parent;
  
  $name = $parent->name;

  if ( $parent->parent && ( $parent->parent != $parent->term_id )) {
    $chain .= starter_get_category_parents( $parent->parent, $link, $separator,$class );
  }

  $chain .= '<span class='.$class.'>'.$name.'</span>'.$separator;
  return $chain;
}
endif;

if ( ! function_exists( 'starter_get_the_category_list' ) ) :
/**
 * Get category list 
 * Override of /wp-includes/category-template.php::get_the_category_list()
 */
function starter_get_the_category_list( $separator = '', $parents=false, $parent_separator='',$post_id = false ) {
  global $wp_rewrite;
  if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
    /** This filter is documented in wp-includes/category-template.php */
    return apply_filters( 'the_category', '', $separator, $parents );
  }

  $categories = get_the_category( $post_id );
  if ( empty( $categories ) ) {
    /** This filter is documented in wp-includes/category-template.php */
    return apply_filters( 'the_category', __( 'Uncategorized','starter' ), $separator, $parents );
  }

  $rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

  $thelist = '';
  if ( '' != $separator ) {
    $i = 0;
    foreach ( $categories as $category ) {
      $class='class="cat-'.$category->term_id.'"';
      if ( 0 < $i ) $thelist .= $separator;
      
      if ($parents) {
        if ( $category->parent )
          $thelist .= starter_get_category_parents( $category->parent, false, $parent_separator,'dimmed' );
        $thelist .= '<em><a '.$class.' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>';
        $thelist .= $category->name."</a></em>";
      }else{    
        $thelist .= '<em><a '.$class.' href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a></em>';
      }
      
      ++$i;
    }
  }

  return apply_filters( 'the_category', $thelist, $separator, $parents );
}
endif;

if ( ! function_exists( 'starter_get_comments_link' ) ) :
/**
 * Print comments link (link to comments from posts meta)
 * Override of /wp-includes/comment-template.php::comments_popup_link()
 */
function starter_get_comments_link() {
  $id = get_the_ID();
  $number = get_comments_number( $id );
  
  $none = __( 'Comments Off' );
  if ( 0 == $number && !comments_open() && !pings_open() ) {
    echo '<span>' . $none . '</span>';
    return;
  }

  if ( post_password_required() ) {
    echo __('Enter your password to view comments.');
    return;
  }

  echo '<a href="';
  if ( 0 == $number )
    echo get_permalink() . '#respond';
  else
    comments_link();
  echo '"';

  $title = the_title_attribute( array('echo' => 0 ) );

  $attributes = '';
  echo apply_filters( 'comments_popup_link_attributes', $attributes );

  echo ' title="' . esc_attr( sprintf( __('Comment on %s'), $title ) ) . '">';

  if ( $number >= 1 )
    $output=sprintf(_n('1 Comment','%s Comments',$number,'starter'),$number);
  else
    $output=__('Leave a Reply');
  
  echo apply_filters( 'comments_number', $output, $number );

  echo '</a>';
}
endif;
