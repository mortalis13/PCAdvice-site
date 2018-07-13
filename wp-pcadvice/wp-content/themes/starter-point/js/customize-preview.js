/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
  var $style = $( '#starter-color-scheme-css' ),
  api = wp.customize;

  if ( ! $style.length ) {
    $style = $( 'head' ).append( '<style type="text/css" id="starter-color-scheme-css" />' )
      .find( '#starter-color-scheme-css' );
  }

  // Site title.
  api( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );

  // Site tagline.
  api( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );

  // Header text color.
  api( 'header_textcolor', function( value ) {
    value.bind( function( to ) {
      if ( 'blank' === to ) {
        $( '.site-branding' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        } );
      } else {
        $( '.site-branding, .site-title a ,.site-description' ).css( {
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        } );
      }
    } );
  } );

  // Color Scheme CSS.
  // Incorporate the inline style to finally preview the scheme change
  api.bind( 'preview-ready', function() {
    api.preview.bind( 'update-color-scheme-css', function( css ) {
      $style.html( css );
    } );
  } );

} )( jQuery );
