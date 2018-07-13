<?php
/**
 * @package Custom Multisite Quotes
 * @version 1.0
 */
/*
Plugin Name: Custom Multisite Quotes
Description: Custom Multisite Quotes
Author: mortalis
Version: 1.0
*/

function custom_quotes_gettext_with_context ( $s, $original, $context, $domain ) {
  if ( ( 'opening curly double quote' == $context || 'opening curly quote' == $context ) && '&#8220;' == $original ) 
    return $original;
  if ( ( 'closing curly double quote' == $context || 'closing curly quote' == $context ) && '&#8221;' == $original ) 
    return $original;
  return $s;
} 
add_filter( 'gettext_with_context', 'custom_quotes_gettext_with_context', 10, 4 );
