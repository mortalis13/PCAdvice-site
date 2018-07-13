<?php
/**
 * @package Starter
 */
?>

<tr>
  <td class="date">
    <?php starter_posted_on(); ?>
  </td>
  <td>
    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
  </td>
  <td class="comments">
    <?php echo get_comments_number(get_the_ID()); ?>
  </td>
  <td class="views">
    <?php echo getPostViews(get_the_ID()); ?>
  </td>
  
  <?php if(is_user_logged_in()){ ?>
    <td class="views">
      <?php edit_post_link( __( 'Edit', 'starter' ), '<span class="edit-link">', '</span>',get_the_ID()); ?>
    </td>
  <?php } ?>
</tr>
