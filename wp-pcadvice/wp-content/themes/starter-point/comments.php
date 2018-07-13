<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Starter
 */

/*
 * If the current post is protected by a password and 
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>
    
    <h2 class="comments-title">
      <?php
        printf( _nx( 'One comment:', '%1$s comments:', get_comments_number(), 'comments title', 'starter' ),
          number_format_i18n( get_comments_number() ) );
      ?>
    </h2>

    <ol class="comment-list">
      <?php
        $comments=wp_list_comments( array(
          'style'      => 'ol',
          'short_ping' => true,
          'avatar_size'=> 50,
        ) );
      ?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
      <nav id="comment-nav-below" class="comment-navigation clear" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'starter' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( sprintf( '<i class="fa fa-arrow-circle-o-left"></i>%s', __( 'Older Comments', 'starter' ) ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( sprintf( '%s<i class="fa fa-arrow-circle-o-right"></i> ', __( 'Newer Comments', 'starter' ) ) ); ?></div>
      </nav><!-- #comment-nav-below -->
    <?php endif; // check for comment navigation ?>

  <?php endif; // have_comments() ?>

  <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>
    <p class="no-comments"><?php _e( 'Comments are closed.', 'starter' ); ?></p>
  <?php endif; ?>

  <?php 
    comment_form(
      array(
        'comment_notes_before'=>'',
        'logged_in_as'=>'<p class="logged-in-as">'
          .sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>.<br><a href="%3$s" title="Log out of this account">Log out</a>','starter' ), 
            get_edit_user_link(), $user_identity, 
            wp_logout_url(apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ))
          ) 
          .'</p>',
      )
    ); 
  ?>
</div><!-- #comments -->
