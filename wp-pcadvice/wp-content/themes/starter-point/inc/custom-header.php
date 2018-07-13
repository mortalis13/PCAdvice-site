<?php
/**
 * Custom header feature
 * @package Starter
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses starter_header_style()
 */
function starter_custom_header_setup() {
  $width=1200;
  $height=170;

  // get header height set in the customizer
  
  $opt=get_option('starter_scheme_options');
  if(isset($opt['header_min_height'])){
    $tmp=$opt['header_min_height'];
    $height=$tmp;
  }
  
  // if($tmp) $height=$tmp;

  add_theme_support( 'custom-header', apply_filters( 'starter_custom_header_args', array(
    'default-image'          => '',
    'default-text-color'     => 'ffffff',
    'width'                  => $width,
    'height'                 => $height,
    'flex-height'            => false,
    'wp-head-callback'       => 'starter_header_style',
  ) ) );
}
add_action( 'after_setup_theme', 'starter_custom_header_setup' );

if ( ! function_exists( 'starter_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see starter_custom_header_setup().
 */
function starter_header_style() {
  $header_text_color = get_header_textcolor();

  // If no custom options for text are set, let's bail
  // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
  if ( HEADER_TEXTCOLOR == $header_text_color ) {
    return;
  }

  // If we get this far, we have custom styles. Let's do this.
  ?>
  <style type="text/css">
  <?php
    // Has the text been hidden?
    if ( 'blank' == $header_text_color ) :
  ?>
    .site-branding {
      position: absolute;
      clip: rect(1px, 1px, 1px, 1px);
    }
  <?php
    // If the user has set a custom color for the text use that
    else :
  ?>
    .site-title a,
        .site-title a:hover,
        .site-title a:active,
        .site-title a:focus,
    .site-description {
      color: #<?php echo $header_text_color; ?>;
    }
  <?php endif; ?>
  </style>
  <?php
}
endif; // starter_header_style
