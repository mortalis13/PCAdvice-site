<?php

add_action( 'admin_init', 'starter_options_init' );
add_action( 'admin_menu', 'starter_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function starter_options_init(){
  register_setting('starter_options_group', 'starter_general_options','theme_options_validate');
}

/**
 * Load up the menu page
 */
function starter_options_add_page() {
  add_theme_page( __( 'Starter Point Options', 'starter' ), __( 'Starter Point Options', 'starter' ), 'edit_theme_options', 'theme_options', 'starter_options_do_page' );
}

/**
 * Create the options page and process requests
 */
function starter_options_do_page() {
  if(isset($_GET['subpage'])){
    $subpage=$_GET['subpage'];
    switch($subpage){
      case 'editor_shortcuts':
        require(dirname(__FILE__).'/editor-shortcuts.php');
        break;
      case 'css_snippets':
        require(dirname(__FILE__).'/css-snippets.php');
        break;
      case 'emmet_abbr':
        require(dirname(__FILE__).'/emmet-abbr.php');
        break;
    }
  }
  else{
  ?>
  
  <div class="wrap">
    <h2><?php echo wp_get_theme()  .': '. __( 'Theme Options', 'starter' )?></h2>

    <?php if ( !empty($_GET['status']) && $_GET['status'] == 'reset' ) : ?>
      <div class="updated fade"><p><strong><?php _e( 'Style Has Been Reset', 'starter' ); ?></strong></p></div>
    <?php endif; ?>
    
    <form method="post" id="options_form" action="options.php">
      <?php settings_fields('starter_options_group') ?>

      <p class="starter-option">
        <label for="starter_general_options[disable_image_cropping]"><?php _e('Disable Image Cropping','starter') ?></label>&nbsp;
        <input type="checkbox" id="starter_general_options[disable_image_cropping]" name="starter_general_options[disable_image_cropping]" <?php checked('1',starter_opt('disable_image_cropping')) ?> />
        <p class="description"><?php _e('Disables thumbnails creation on image uploads in the Media manager','starter'); ?></p>
      </p>
      
      <p class="starter-option">
        <p><?php _e('Custom CSS','starter') ?></p>
        
        <div id="custom_css_container">
          <div name="custom_css_div" id="custom_css_div"></div>
        </div>
        
        <textarea name="starter_general_options[custom_css]" id="custom_css_textarea" cols="60" rows="20"><?php echo esc_textarea( starter_opt('custom_css')) ?></textarea>
      </p>
      
      <div class="editor_help">
        <div><a href="<?php echo admin_url( 'themes.php?page=theme_options&subpage=editor_shortcuts' ) ?>"><?php _e('Ace Editor Shortcuts','starter') ?></a></div>
        <div><a href="<?php echo admin_url( 'themes.php?page=theme_options&subpage=css_snippets' ) ?>"><?php _e('Ace Editor CSS Snippets','starter') ?></a></div>
        <div><a href="<?php echo admin_url( 'themes.php?page=theme_options&subpage=emmet_abbr' ) ?>"><?php _e('Emmet CSS Abbreviations','starter') ?></a></div>
        <div><a href="http://docs.emmet.io/cheat-sheet/"><?php _e('Emmet CSS [Full List]','starter') ?></a></div>
      </div>
      
      <p>
        <label for="starter_general_options[use_custom_css]"><?php _e('Use Custom CSS','starter') ?></label>&nbsp;
        <input type="checkbox" id="starter_general_options[use_custom_css]" name="starter_general_options[use_custom_css]" <?php checked('1',starter_opt('use_custom_css')) ?> />
      </p>
      
      <p class="starter-option">
        <label for="starter_general_options[use_category_colors]"><?php _e('Use Category Colors','starter') ?></label>&nbsp;
        <input type="checkbox" id="starter_general_options[use_category_colors]" name="starter_general_options[use_category_colors]" <?php checked('1',starter_opt('use_category_colors')) ?> />
        <p class="description"><?php _e('Category link colors can be selected in each category edit page','starter'); ?></p>
      </p>
      
      <p>
        <?php submit_button(); ?>
      </p>
    </form>
    
    <form method="post">
      <input type="hidden" name="starter_reset_customizer" value="starter_reset_customizer_settings" />
      <?php wp_nonce_field( 'starter_reset_customizer_nonce', 'starter_reset_customizer_nonce' ); ?>
      <p>
        <?php submit_button( __( 'Restore Factory Style', 'starter' ), 'button', 'submit', false ); ?>
      </p>
    </form>
  </div>
  
  <?php
  }
}

/**
 * Validation function for checkboxes and textarea
 */
function theme_options_validate( $input ) {
  $checkboxes=array(
    'disable_image_cropping',
    'use_custom_css',
    'use_category_colors'
  );
  
  foreach($checkboxes as $ch){
    if(!isset($input[$ch])) $input[$ch] = null;
    $input[$ch]=($input[$ch]? 1 : 0 );
  }
  
  $input['custom_css'] = wp_filter_post_kses( $input['custom_css'] );
  
  return $input;
}

/**
 * Restore factory color scheme
 */
function starter_reset_customizer_settings() {
  if( empty( $_POST['starter_reset_customizer'] ) || 'starter_reset_customizer_settings' !== $_POST['starter_reset_customizer'] )
    return;
  if( ! wp_verify_nonce( $_POST['starter_reset_customizer_nonce'], 'starter_reset_customizer_nonce' ) )
    return;
  if( ! current_user_can( 'manage_options' ) )
    return;
  
  delete_option('starter_scheme_options');
  wp_safe_redirect( admin_url( 'themes.php?page=theme_options&status=reset' ) ); exit;
}
add_action( 'admin_init', 'starter_reset_customizer_settings' );
