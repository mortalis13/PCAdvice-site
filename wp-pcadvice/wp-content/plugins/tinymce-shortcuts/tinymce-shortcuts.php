<?php
/**
 * @package TinyMCE Shortcuts
 * @version 1.0
 */
/*
Plugin Name: TinyMCE Shortcuts
Description: Adds additional shortcuts for general TinyMCE buttons
Author: mortalis
Version: 1.0
Released under the GPL version 2.0, http://www.gnu.org/licenses/gpl-2.0.html
*/

function mce_shortcuts_add_shortcuts($plugin_array) {
  $plugin_array['mceShortcuts'] = plugins_url('mce-shortcuts',__FILE__) . '/plugin.js';
  return $plugin_array;
}


function mce_shortcuts_init() {
  add_filter("mce_external_plugins", "mce_shortcuts_add_shortcuts");
}
add_action( 'init', 'mce_shortcuts_init' );
