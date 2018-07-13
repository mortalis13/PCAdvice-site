<?php
/**
 * @package HTML Post Editor
 * @version 1.0
 */
/*
Plugin Name: HTML Post Editor
Description: Adds ACE Editor to the post content editor for syntax-highlighting and more
Version: 1.0.0
Author: mortalis
*/

class HTMLPostEditor {
	
	public function __construct() {
		global $pagenow;
		
		if ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) {
			add_action( 'admin_head', array($this, 'hpe_inline_css') );
			add_action( 'admin_print_scripts-post.php', array($this, 'hpe_scripts') );
			add_action( 'admin_print_scripts-post-new.php', array($this, 'hpe_scripts') );			
      // add_action( 'load-post.php', array($this,'custom_edit_post' ));
    }
    
  }
  
	public function hpe_inline_css() {
    ?>
      <style>
        .ace-active .switch-ace{
            background: none repeat scroll 0% 0% #F5F5F5;
            color: #555;
            border-bottom-color: #F5F5F5;
        }
        
        #ace-editor{
          position: absolute;
          left: 0px;
          bottom: 0px;
          right: 0px;
          top: 0px;
          
          font-size:14px;
          border: 1px solid #DFDFDF; 
          -moz-border-radius: 3px; 
          -webkit-border-radius: 3px; 
          border-radius: 3px; 
          width: 100%; 
          /*height: 900px;*/
        }
        
        #ace-editor.ace_editor.fullScreen {
            height: 100%;
            width: 100%;
            border: 0;
            border-radius: 0;
            margin: 0;
            position: fixed !important;
            top: 32px;
            bottom: 0;
            left: 160px;
            right: 0;
            z-index: 10;
        }

        @media(max-width:960px){
          #ace-editor.ace_editor.fullScreen {
              top: 32px;
              left: 36px;
          }
        }

        @media(max-width:782px){
          #ace-editor.ace_editor.fullScreen {
              top: 46px;
              left: 0px;
          }
        }

        .fullScreen {
            overflow: hidden
        }
        
        .wp-switch-editor:disabled{
          background: #FFE1E1;
          cursor:default;
        }
      </style>
    <?php
	}
	
	public function hpe_scripts() {
    wp_enqueue_style( 'ui-theme' , plugins_url( '/css/jquery-ui.min.css', __FILE__ ) );
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-resizable');
    
    wp_enqueue_script( 'emmet_js', plugins_url( '/js/emmet.min.js', __FILE__ ), '', '1.0', true );
    wp_enqueue_script( 'beautify', plugins_url( '/js/beautify-html.min.js', __FILE__ ), array('jquery'), '1.1', true );
    wp_enqueue_script( 'ace_theme', plugins_url('/js/theme-sublime.js', __FILE__ ), array( 'ace_js' ), '1.0.0', true );
  
    wp_enqueue_script( 'ace_js', plugins_url( '/ace-min/ace.js', __FILE__ ), '', '1.0', true );
    // wp_enqueue_script( 'ace_language_tools', plugins_url( '/ace-min/ext-language_tools.js', __FILE__ ), array( 'ace_js' ), '1.0.0', true );
    wp_enqueue_script( 'ace_emmet', plugins_url('/ace-min/ext-emmet.js', __FILE__ ), array( 'ace_js' ), '1.0.0', true );
    
    
    // wp_enqueue_style( 'ui-theme' , plugins_url( '/css/jquery-ui.css', __FILE__ ) );
    
    // wp_enqueue_script( 'beautify', plugins_url( '/js/beautify-html.js', __FILE__ ), array('jquery'), '1.1', true );
    // wp_enqueue_script( 'emmet_js', plugins_url( '/js/emmet.js', __FILE__ ), '', '1.0', true );
    
    // wp_enqueue_script( 'ace_js', plugins_url( '/ace/ace.js', __FILE__ ), '', '1.0', true );
    // wp_enqueue_script( 'ace_language_tools', plugins_url( '/ace/ext-language_tools.js', __FILE__ ), array( 'ace_js' ), '1.0.0', true );
    // wp_enqueue_script( 'ace_emmet', plugins_url('/ace/ext-emmet.js', __FILE__ ), array( 'ace_js' ), '1.0.0', true );
    // wp_enqueue_script( 'ace_theme', plugins_url('/ace/theme-sublime.js', __FILE__ ), array( 'ace_js' ), '1.0.0', true );
    
    wp_enqueue_script( 'html_editor', plugins_url( 'editor.js', __FILE__ ), array('ace_js'), '1.1', true );
	}
		
}

if ( is_admin() && is_multisite() ){
  global $pagenow;
  
  if(!$pagenow){
    preg_match('#/wp-admin/?(.*?)$#i', $PHP_SELF, $self_matches);
    $pagenow = $self_matches[1];
    // $pagenow = trim($pagenow, '/');
  }
  
  new HTMLPostEditor();
}
