<?php
/**
 * @package Test Plugin
 * @version 1.0
 */
/*
Plugin Name: Test Plugin
Description: Plugin for debug
Author: mortalis
Version: 1.0
*/

function tfnab_smart_quotes_gettext_with_context ( $s, $original, $context, $domain )
{
  
  $x=1;
  
  // if ( 'default' != $domain ) return $s;
  // list( $quote1, $quote2, $quotes_set ) = tfnab_smart_quotes_get_option();
  // if ( !$quotes_set ) return $s;
  
  if ( ( 'opening curly double quote' == $context || 'opening curly quote' == $context ) && '&#8220;' == $original ) 
    return $original;
    
  if ( ( 'closing curly double quote' == $context || 'closing curly quote' == $context ) && '&#8221;' == $original ) 
    return $original;
    
  return $s;
} // function tfnab_smart_quotes_gettext_with_context
add_filter( 'gettext_with_context', 'tfnab_smart_quotes_gettext_with_context', 10, 4 );


// function wptuts_add_buttons($plugin_array) {
//   $plugin_array['preButton'] = plugins_url() . '/test-plugin/wptuts-editor-buttons/wptuts-plugin.js';
//   return $plugin_array;
// }

// function wptuts_register_buttons($buttons) {
//   array_push( $buttons, 'pre');
//   return $buttons;
// }

// function wptuts_buttons() {
//   add_filter("mce_external_plugins", "wptuts_add_buttons");
//   add_filter('mce_buttons', 'wptuts_register_buttons');
// }
// add_action( 'init', 'wptuts_buttons' );
