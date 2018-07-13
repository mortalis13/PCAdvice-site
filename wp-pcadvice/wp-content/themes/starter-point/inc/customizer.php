<?php
/**
 * starter Theme Customizer
 *
 * @package Starter
 */

function starter_customize_register($wp_customize) {
  $default_colors=starter_get_scheme_settings('default')['colors'];
  $default_layout=starter_get_scheme_settings('default')['layout'];

  $wp_customize->remove_section('colors');

// -------------------------- panels ------------------------------

  $wp_customize->add_panel('starter_colors_panel', array(
    'capability'=> 'edit_theme_options',
    'title'=> _x('Theme Colors','Customizer: Labels','starter'),
  ));

  $wp_customize->add_panel('starter_layout_panel', array(
    'capability'=> 'edit_theme_options',
    'title'=> _x('Layout','Customizer: Labels','starter'),
  ));

// --------------------------- sections -----------------------------

  $labels=starter_get_customizer_labels('sections');

  add_custom_section($wp_customize,'starter_colors_panel','base_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','container_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','nav_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','footer_nav_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','links_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','widget_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','other_colors',$labels);
  add_custom_section($wp_customize,'starter_colors_panel','color_settings',$labels);

  add_custom_section($wp_customize,'starter_layout_panel','margins',$labels);
  add_custom_section($wp_customize,'starter_layout_panel','paddings',$labels);
  add_custom_section($wp_customize,'starter_layout_panel','header',$labels);
  add_custom_section($wp_customize,'starter_layout_panel','footer',$labels);
  add_custom_section($wp_customize,'starter_layout_panel','widgets',$labels);
  
// -------------------------- color settings --------------------------
  
  $labels=starter_get_customizer_labels('colors');

  starter_add_color_setting($wp_customize,'base_colors','body_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'base_colors','body_foreground',$labels,$default_colors);

  starter_add_color_setting($wp_customize,'container_colors','header_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'container_colors','header_foreground',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'container_colors','container_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'container_colors','post_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'container_colors','footer_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'container_colors','footer_foreground',$labels,$default_colors);

  starter_add_color_setting($wp_customize,'nav_colors','nav_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'nav_colors','nav_foreground',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'nav_colors','nav_current_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'nav_colors','nav_current_foreground',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'nav_colors','nav_hover_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'nav_colors','nav_hover_foreground',$labels,$default_colors);
  
  starter_add_color_setting($wp_customize,'footer_nav_colors','footer_nav_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'footer_nav_colors','footer_nav_foreground',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'footer_nav_colors','footer_nav_hover_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'footer_nav_colors','footer_nav_hover_foreground',$labels,$default_colors);

  starter_add_color_setting($wp_customize,'links_colors','links_color',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'links_colors','links_hover',$labels,$default_colors);
  
  starter_add_color_setting($wp_customize,'widget_colors','footer_widgets_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'widget_colors','footer_widgets_foreground',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'widget_colors','footer_widgets_links',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'widget_colors','footer_widgets_border',$labels,$default_colors);

// other
  
  starter_add_color_setting($wp_customize,'other_colors','table_hover',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'other_colors','pre_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'other_colors','pre_foreground',$labels,$default_colors);

  starter_add_color_setting($wp_customize,'other_colors','fields_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'other_colors','fields_foreground',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'other_colors','author_comment_background',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'other_colors','borders_color',$labels,$default_colors);
  starter_add_color_setting($wp_customize,'other_colors','dimmed_color',$labels,$default_colors);
  
  starter_add_scheme_setting($wp_customize,'color_settings','color_scheme',$labels,'default');
  starter_add_checkbox_setting($wp_customize,'color_settings','use_category_colors',$labels,false,false);

// -------------------------- layout settings --------------------------

  $labels=starter_get_customizer_labels('layout');

  starter_add_text_setting($wp_customize,'margins','content_area_top_margin',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'margins','content_area_bottom_margin',$labels,$default_layout);
  
  starter_add_text_setting($wp_customize,'margins','blog_post_margin',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'margins','last_post_bottom_margin',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'margins','single_post_bottom_margin',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'margins','single_page_bottom_margin',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'margins','post_nav_bottom_margin',$labels,$default_layout,false);
  starter_add_text_setting($wp_customize,'margins','post_nav_left_right_margin',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'margins','paging_nav_top_margin',$labels,$default_layout);
  
  starter_add_text_setting($wp_customize,'paddings','site_content_bottom_padding',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'paddings','category_bottom_padding',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'paddings','sidebar_left_padding',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'paddings','sidebar_right_padding',$labels,$default_layout);
  
  starter_add_select_setting($wp_customize,'header','header_min_height',$labels,starter_get_header_height_list(),false);
  starter_add_text_setting($wp_customize,'header','menu_dropdown_width',$labels,$default_layout);
  
  starter_add_text_setting($wp_customize,'footer','footer_menu_width',$labels,$default_layout);
  starter_add_text_setting($wp_customize,'footer','footer_menu_left_margin',$labels,$default_layout);
  
  starter_add_widget_options($wp_customize, 'widgets');

// -------------------------- front page option --------------------------

  starter_add_frontpage_option($wp_customize);
}
add_action('customize_register', 'starter_customize_register');


// ----------------------------------------------- helpers ---------------------------------------------------------


function starter_add_widget_options($wp_customize, $section){
  $wp_customize->add_setting('sidebar_option', array(
    'default'=> 'sidebar-off',
    'capability'=> 'manage_options',
    'type'=> 'option',
    'sanitize_callback'=> 'starter_sanitize_sidebar_options',
  ));

  $wp_customize->add_control('sidebar_option', array(
    'label'=> _x('Sidebar Layout','Customizer: Widgets Layout','starter'),
    'section'=> $section,
    'type'=> 'radio',
    'choices'=>array(
      'left-sidebar'=> _x('Left','Customizer: Widgets Layout','starter'),
      'right-sidebar'=> _x('Right','Customizer: Widgets Layout','starter'),
      'sidebar-off'=> _x('Off','Customizer: Widgets Layout','starter'),  
    ),
  ));
  
  
  $wp_customize->add_setting('footer_widgets_option', array(
    'default'=> 'footer-widgets-off',
    'capability'=> 'manage_options',
    'type'=> 'option',
    'sanitize_callback'=> 'starter_sanitize_footer_widgets_options',
  ));

  $wp_customize->add_control('footer_widgets_option', array(
    'label'=> _x('Footer Widgets Layout','Customizer: Widgets Layout','starter'),
    'section'=> $section,
    'type'=> 'radio',
    'choices'=>array(
      'footer-widgets-on'=> _x('On','Customizer: Widgets Layout','starter'),
      'footer-widgets-off'=> _x('Off','Customizer: Widgets Layout','starter'),  
    ),
  ));
}

function starter_add_frontpage_option($wp_customize){
  $wp_customize->remove_section('static_front_page');
  
  $wp_customize->add_section(
    'frontpage_option',
    array(
      'title'=> _x('Front Page Option','Customizer: Front Page','starter'),
      'capability'=> 'edit_theme_options',
    )
  );

  // ------------------------- taken from /wp-includes/class-wp-customize-manager.php:1210 ----------------------------
  
  $wp_customize->add_setting('show_on_front', array(
    'default'=> get_option('show_on_front'),
    'capability'=> 'manage_options',
    'type'=> 'option',
    'sanitize_callback'=> 'starter_sanitize_frontpage_option',
  ));

  $wp_customize->add_control('show_on_front', array(
    'label'=> _x('Front page displays','Customizer: Front Page','starter'),
    'section'=> 'frontpage_option',
    'type'=> 'radio',
    'choices'=>starter_get_frontpage_choices(),
  ));

  $wp_customize->add_setting('page_on_front', array(
    'type'=> 'option',
    'capability'=> 'manage_options',
    'sanitize_callback' => 'absint'
  ));

  $wp_customize->add_control('page_on_front', array(
    'label'=> _x('Front page','Customizer: Front Page','starter'),
    'section'=> 'frontpage_option',
    'type'=> 'dropdown-pages',
  ));

  $wp_customize->add_setting('page_for_posts', array(
    'type'=> 'option',
    'capability'=> 'manage_options',
    'sanitize_callback' => 'absint'
  ));

  $wp_customize->add_control('page_for_posts', array(
    'label'=> _x('Posts page','Customizer: Front Page','starter'),
    'section'=> 'frontpage_option',
    'type'=> 'dropdown-pages',
  ));

  // ---------------------- custom option [most_viewed]-------------------------------

  $wp_customize->add_setting(
    'most_viewed_count',
    array(
      'default'=> '3',
      'capability'=> 'manage_options',
      'type'=>'option',
      'sanitize_callback'=> 'sanitize_text_field',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'most_viewed_count',
      array(
        'label'=> _x('Posts Count','Customizer: Front Page','starter'),
        'section'=> 'frontpage_option',
        'settings'=> 'most_viewed_count',
        'type'=> 'number',
      )
    )
  );
}

function add_custom_section($wp_customize,$panel,$id,$labels){
  $label=$labels[$id];
  $wp_customize->add_section(
    $id,
    array(
      'title'=> $label,
      'capability'=> 'edit_theme_options',
      'panel'=> $panel
   )
 );
}

function starter_add_checkbox_setting($wp_customize,$section,$id,$labels,$default,$postMessage=true){
  $label=$labels[$id];
  $settings='starter_general_options['.$id.']';
  $transport=$postMessage?'postMessage':'refresh';

  $wp_customize->add_setting(
    $settings,
    array(
      'default'=> $default,
      'transport'=> $transport,
      'type'=>'option',
      'sanitize_callback'=> 'starter_sanitize_checkbox',
   )
 );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      $id,
      array(
        'label'=> $label,
        'section'=> $section,
        'settings'=> $settings,
        'type'=>'checkbox'
     )
   )
 );
}

function starter_add_color_setting($wp_customize,$section,$id,$labels,$defaults,$postMessage=true){
  $default=$defaults[$id];
  $label=$labels[$id];
  $settings='starter_scheme_options['.$id.']';
  $transport=$postMessage?'postMessage':'refresh';

  $wp_customize->add_setting(
    $settings,
    array(
      'default'=> $default,
      'transport'=> $transport,
      'type'=>'option',
      'sanitize_callback'=> 'sanitize_hex_color',
   )
 );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      $id,
      array(
        'label'=> $label,
        'section'=> $section,
        'settings'=> $settings
     )
   )
 );
}

function starter_add_select_setting($wp_customize,$section,$id,$labels,$options,$postMessage=true){
  $label=$labels[$id];
  $settings='starter_scheme_options['.$id.']';
  $transport=$postMessage?'postMessage':'refresh';

  $wp_customize->add_setting(
    $settings,
    array(
      'default'=> $options['140px'],
      'transport'=> $transport,
      'type'=>'option',
      'sanitize_callback'=> 'starter_sanitize_select',
   )
 );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      $id,
      array(
        'label'=> $label,
        'section'=> $section,
        'settings'=> $settings,
        'type'=>'select',
        'choices'=>$options,
     )
   )
 );
}

function starter_add_scheme_setting($wp_customize,$section,$id,$labels,$default,$postMessage=true){
  $label=$labels[$id];
  $settings='starter_scheme_options['.$id.']';
  $transport=$postMessage?'postMessage':'refresh';


  $wp_customize->add_setting(
    $settings,
    array(
      'default'=> $default,
      'transport'=> $transport,
      'type'=>'option',
      'sanitize_callback'=> 'starter_sanitize_color_scheme',
   )
 );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      $id,
      array(
        'label'=> $label,
        'section'=> $section,
        'settings'=> $settings,
        'type'=>'select',
        'choices'=>starter_get_color_schemes_list(),
     )
   )
 );
}

function starter_add_text_setting($wp_customize,$section,$id,$labels,$defaults,$postMessage=true){
  $default=$defaults[$id];
  $label=$labels[$id];
  $settings='starter_scheme_options['.$id.']';
  $transport=$postMessage?'postMessage':'refresh';

  $wp_customize->add_setting(
    $settings,
    array(
      'default'=> $default,
      'transport'=> $transport,
      'type'=>'option',
      'sanitize_callback'=> 'sanitize_text_field',
   )
 );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      $id,
      array(
        'label'=> $label,
        'section'=> $section,
        'settings'=> $settings
     )
   )
 );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function starter_set_transport($wp_customize) {
  $wp_customize->get_setting('blogname')->transport         = 'postMessage';
  $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
  $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}
add_action('customize_register', 'starter_set_transport');


// ----------------------------------------------- sanitize ---------------------------------------------------------


function starter_sanitize_color_scheme($value) {
  $schemes = starter_get_color_schemes_list();
  if (!array_key_exists($value, $schemes)) {
    $value = 'default';
  }
  return $value;
}

function starter_sanitize_checkbox($value) {
  if($value) $value='1';
  else $value=false;
  return $value;
}

function starter_sanitize_select($value) {
  $list = starter_get_header_height_list();
  if (!array_key_exists($value, $list)) {
    $value = '140px';
  }
  return $value;
}

function starter_sanitize_text($value) {
  return sanitize_text_field($value);
}

function starter_sanitize_frontpage_option($value) {
  $frontpage_choices=array_keys(starter_get_frontpage_choices());
  if (! in_array($value, $frontpage_choices))
    $value = 'posts';
  return $value;
}

function starter_sanitize_sidebar_options($value) {
  $choices=array(
    'left-sidebar',
    'right-sidebar',
    'sidebar-off',
  );
  
  if (! in_array($value, $choices))
    $value = 'sidebar-off';
  return $value;
}

function starter_sanitize_footer_widgets_options($value) {
  $choices=array(
    'footer-widgets-on',
    'footer-widgets-off',
  );
  
  if (! in_array($value, $choices))
    $value = 'footer-widgets-off';
  return $value;
}

// -------------------------------------------------- styles ---------------------------------------------------------

/**
 * Add inline styles for color scheme and category colors
 */
function starter_add_custom_style() {
  $opt=get_option('starter_scheme_options');             
  if($opt){
    foreach($opt as $key=>$value)
      $data[$key]=$value;
    $css=starter_get_color_scheme_css($data,true);

    ?>
      <style id='color-scheme'>
        <?php echo $css ?>
      </style>
    <?php
  }
  
  $opt=get_option('starter_general_options');
  if($opt){
    $use_category_colors=$opt['use_category_colors'];
    if($use_category_colors){
      global $wpdb;
      $table_name=$wpdb->prefix.'category_meta';
      
      $cat_meta=$wpdb->get_results('select * from '. $table_name .' where use_custom_color=1');
      if($cat_meta){
        $cat_css=starter_get_category_colors_css($cat_meta);
        ?>
          <style id='category-colors'>
            <?php echo $cat_css ?>
          </style>
        <?php
      }
    }
  }
}
add_action('wp_head', 'starter_add_custom_style');

function starter_get_category_colors_css($cat_meta) {
  $cat_css='';
  foreach($cat_meta as $item){
    $cat_css.=<<<CSS
    
      .cat-{$item->cat_id}{
        color:{$item->meta_color};
      }

CSS;
  }
  return $cat_css;
}

function starter_fill_scheme_empty_props($data){
  $settings=array(
    'body_background'=>'',
    'body_foreground'=>'',
    'header_background'=>'',
    'header_foreground'=>'',
    'container_background'=>'',
    'post_background'=>'',
    
    'nav_background'=>'',
    'nav_foreground'=>'',
    'nav_current_background'=>'',
    'nav_current_foreground'=>'',
    'nav_hover_background'=>'',
    'nav_hover_foreground'=>'',
    
    'footer_nav_background'=>'',
    'footer_nav_foreground'=>'',
    'footer_nav_hover_background'=>'',
    'footer_nav_hover_foreground'=>'',
    
    'links_color'=>'',
    'links_hover'=>'',
    
    'footer_widgets_background'=>'',
    'footer_widgets_foreground'=>'',
    'footer_widgets_links'=>'',
    'footer_widgets_border'=>'',
    
    'footer_background'=>'',
    'footer_foreground'=>'',
    'pre_background'=>'',
    'pre_foreground'=>'',
    'table_hover'=>'',
    'fields_background'=>'',
    'fields_foreground'=>'',
    'author_comment_background'=>'',
    'borders_color'=>'',
    'dimmed_color'=>'',

    // +++ layout +++

    'content_area_top_margin'=>'',
    'content_area_bottom_margin'=>'',
    
    'blog_post_margin'=>'',
    'last_post_bottom_margin'=>'',
    
    'single_post_bottom_margin'=>'',
    'single_page_bottom_margin'=>'',
    'post_nav_bottom_margin'=>'',
    'post_nav_left_right_margin'=>'',
    'paging_nav_top_margin'=>'',
    'header_min_height'=>'',
    'menu_dropdown_width'=>'',
    
    'footer_menu_width'=>'',
    'footer_menu_left_margin'=>'',
    
    'site_content_bottom_padding'=>'',
    'category_bottom_padding'=>'',
    'sidebar_left_padding'=>'',
    'sidebar_right_padding'=>'',
  );

  $add_properties=array(
    'color_scheme'=>'',
    'header_height_1'=>'',
    'header_height_2'=>'',
  );

  $data=wp_parse_args($data, $settings);
  $data=wp_parse_args($data, $add_properties);
  return $data;
}

function starter_get_color_scheme_css($data,$useFullData=false) {
  // if useFullData is true, don't merge the $data from 'colors' and 'layout' arrays, just use the prepared data
 
  if(!$useFullData){
    $colors=$data['colors'];
    $layout=$data['layout'];
    $data=array_merge($colors,$layout);
  }
  $data=starter_fill_scheme_empty_props($data);
  
  $color_scheme=$data['color_scheme'];

  // conditional post bottom margin in relation to the disabled/enabled comments state

  $customPostNavMargin=$data['single_post_bottom_margin'];    
  if (starter_are_comments_disabled()){
    $customPostNavMargin=$data['post_nav_bottom_margin'];
  }

  // responsive styles for the header when the Customizer header height option is used

  $title_padding=false;
  $header_height=$data['header_min_height'];

  switch($header_height){
    case '140px':
      $header_height_1='96px';
      $header_height_2='76px';
      break;
    case '170px':
      $header_height_1='126px';
      $header_height_2='100px';

      if(!get_bloginfo('description', 'display')){
        $title_padding='5.7rem';
        $title_padding_1='3.5rem';
      }
      break;
    case '250px':
      $header_height_1='200px';
      $header_height_2='150px';
      break;
    default:
      $header_height_1=$data['header_height_1'];
      $header_height_2=$data['header_height_2'];
  }
  

  $css = <<<CSS
  /* Color Scheme */

  /* Background Color */
    body{
      color:{$data['body_foreground']};
      background:{$data['body_background']};
    }
    a{
      color:{$data['links_color']};
    }
    a:hover,
    a:active,
    a:focus{
      color:{$data['links_hover']};
    }
    
    .site-content .widget a {
      color:{$data['links_color']};
    }
    .site-content .widget a:hover,
    .site-content .widget a:active,
    .site-content .widget a:focus{
      color:{$data['links_hover']};
    }
    
    /*.footer-widgets .widget-title,
    .footer-widgets .widget a:hover,
    .footer-widgets .widget a:focus {
      color:{$data['links_hover']};
      border-color:{$data['borders_color']};
    }*/
    
    input[type="text"], 
    input[type="email"], 
    input[type="url"], 
    input[type="password"], 
    input[type="search"], 
    textarea {
      color: {$data['fields_foreground']};
      background: {$data['fields_background']};
    }
    input[type="text"]:focus, 
    input[type="email"]:focus, 
    input[type="url"]:focus, 
    input[type="password"]:focus, 
    input[type="search"]:focus, 
    textarea:focus {
      color: {$data['fields_foreground']};
      background: {$data['fields_background']};
    }

    .site-header{
      background:{$data['header_background']};
    }
    .site-header,
    .site-description,
    .site-branding a,
    .site-branding a:hover,
    .site-branding a:focus,
    .site-branding a:active {
      color:{$data['header_foreground']};
    }
    .site-header input[type="search"]{
      background:{$data['body_background']};
    }

    .entry-title{
      color:{$data['body_foreground']};
    }
    .entry-title a{
      border-bottom-color: {$data['links_color']};
    }

    .main-navigation,
    .main-navigation ul ul {
      background:{$data['nav_background']};
    }
    .main-navigation,
    .main-navigation a{
      color:{$data['nav_foreground']};
    }
    .main-navigation li:hover > a,
    .main-navigation li > a:focus,
    .menu-toggle a:hover,
    .menu-toggle a:focus {
      color:{$data['nav_hover_foreground']};
      background:{$data['nav_hover_background']};
    }
    .main-navigation.toggled .nav-menu {
      border-top: 1px solid {$data['nav_foreground']};
    }
    
    .main-navigation .current-menu-item > a,
    .main-navigation .current-menu-item > a:hover,
    .main-navigation .current-menu-item > a:focus,
    .main-navigation .current-menu-item > a:active,
    .main-navigation .current_page_item > a,
    .main-navigation .current_page_item > a:hover,
    .main-navigation .current_page_item > a:focus,
    .main-navigation .current_page_item > a:active{
      color:{$data['nav_current_foreground']};
      background:{$data['nav_current_background']};
    }
    .main-navigation .current-menu-ancestor > a,
    .main-navigation .current-menu-ancestor > a:hover,
    .main-navigation .current-menu-ancestor > a:focus,
    .main-navigation .current_page_ancestor > a,
    .main-navigation .current_page_ancestor > a:hover,
    .main-navigation .current_page_ancestor > a:focus{
      color:{$data['nav_current_foreground']};
      background:{$data['nav_current_background']};
    }
    
    .search-results .page-label{
      color:{$data['nav_foreground']};
      background: {$data['nav_background']};
    }
    
    .site-content{
      background:{$data['container_background']};
    }
    .site-content .widget-area,   /*+++*/
    .page.type-page,
    .post.type-post,
    .page .comments-area,
    .single-attachment .attachment,
    .single-attachment .comments-area,
    .single-post .comments-area,
    .paging-navigation,
    .single-post .post-navigation,
    .archive .category-content, 
    .category .category-content, 
    .error404 .not-found, 
    .search .not-found {
      background:{$data['post_background']};
    }
    .category-list-single,
    .search-results .page-header{
      background: {$data['post_background']};
    }
    .lazy{
      background-color:{$data['post_background']};
    }
    
    .site-footer .footer-content{
      background:{$data['footer_background']};
    }
    .site-footer,
    .site-footer a,
    .site-footer a:hover,
    .site-footer a:focus,
    .site-footer a:active{
      color:{$data['footer_foreground']};
    }
    
    .footer-navigation{
      background:{$data['footer_nav_background']};
    }
    .footer-navigation,
    .footer-navigation a{
      color:{$data['footer_nav_foreground']};
    }
    .footer-navigation li:hover > a,
    .footer-navigation li > a:focus{
      color:{$data['footer_nav_hover_foreground']};
      background:{$data['footer_nav_hover_background']};
    }

    pre,code{
      color:{$data['pre_foreground']};
      background:{$data['pre_background']};
    }
    
    pre a,
    pre a:hover,
    pre a:focus,
    pre a:active,
    code a,
    code a:hover,
    code a:focus,
    code a:active{
      color:{$data['pre_foreground']};
    }
    pre a:hover,
    code a:hover{
      text-decoration: none;
    }

    .articles tbody tr:hover{
      background:{$data['table_hover']};
    }

    .bypostauthor > .comment-body {
      background:{$data['author_comment_background']};
    }

    /* ------- footer widgets ------- */
    
    .footer-widgets {
      background: {$data['footer_widgets_background']};
      color: {$data['footer_widgets_foreground']};
    }

    .footer-widgets .widget-title,
    .footer-widgets .widget a,
    .footer-widgets .widget a:hover,
    .footer-widgets .widget a:focus, 
    .footer-widgets .widget a:active {
      color: {$data['footer_widgets_links']};
      border-color: {$data['footer_widgets_border']};
    }
    
    .footer-widgets table th, table td, 
    .footer-widgets .widget_nav_menu a, .widget_pages a{
      border-color: {$data['footer_widgets_border']};
    }
    
    /* ------- other ------- */

    ins{
      color:{$data['nav_hover_foreground']};
      background:{$data['nav_hover_background']};
    }

    .wp-caption .wp-caption-text, .gallery-caption{
      color:{$data['pre_foreground']};
      background:{$data['pre_background']};
    }
    .wp-caption .wp-caption-text a, .gallery-caption a {
      color:{$data['pre_foreground']};
    }

    .page-links a {
      color:{$data['pre_foreground']};
      background:{$data['pre_background']};
    }
    .page-links a:hover,
    .page-links a:focus {
      color:{$data['nav_hover_foreground']};
      background:{$data['nav_hover_background']};
    }

    table th,
    table td{
      border-color: {$data['borders_color']};
    }
    blockquote,
    .single-post .post-navigation{
      border-top-color:{$data['borders_color']};
      border-bottom-color:{$data['borders_color']};
    }
    .site-content .widget-title {
      border-bottom-color:{$data['borders_color']};  /*+++*/
    }
    .widget_pages a {
      border-bottom-color:{$data['borders_color']};  /*+++*/
    }
    .comment-body,
    .article-divider{
      border-bottom-color:{$data['borders_color']};
    }
    .page .entry-footer{
      border-top-color:{$data['borders_color']};
    }
    .comment-navigation .nav-next,
    .post-navigation .nav-next { 
      border-top-color:{$data['borders_color']};
    }
    .comment-navigation{ 
      border-top-color:{$data['borders_color']};
      border-bottom-color:{$data['borders_color']};
    }
    .attachment .entry-footer,
    .footer-navigation{
      border-top-color:{$data['borders_color']};
    }
    
    .dimmed{
      color:{$data['dimmed_color']};
    }

    /* ---------------------------- layout ---------------------------- */

    .blog .post,
    .search-results .post,
    .search-results .page{
      margin-bottom:{$data['blog_post_margin']};
    }
    .blog .post.last-post{
      margin-bottom:{$data['last_post_bottom_margin']};
    }
    
    .site-content{
      padding-bottom:{$data['site_content_bottom_padding']};
    }
    
    .site-content .widget-area{
      margin-top:{$data['content_area_top_margin']};  /*+++*/
      padding-left: {$data['sidebar_left_padding']};
      padding-right: {$data['sidebar_right_padding']};
    }
    .content-area{
      margin-top:{$data['content_area_top_margin']};
      margin-bottom:{$data['content_area_bottom_margin']};
    }
    .search-results .page-header{
      margin-bottom:{$data['content_area_bottom_margin']};
    }
    
    .page.type-page,
    .page .comments-area{
      margin-bottom:{$data['single_page_bottom_margin']};
    }
    
    .archive .category-content,
    .category .category-content{
      padding-bottom:{$data['category_bottom_padding']};
    }
    
    .site-main .paging-navigation{
      margin-top:{$data['paging_nav_top_margin']};
    }
    
    .single .post,
    .single .attachment{
      margin-bottom:{$data['single_post_bottom_margin']};
    }
    
    .single-post .post-navigation{
      margin-left:{$data['post_nav_left_right_margin']};
      margin-right:{$data['post_nav_left_right_margin']};
      margin-bottom:{$customPostNavMargin};
    }
    
    .main-navigation ul ul li{
      width:{$data['menu_dropdown_width']};
    }
    
    .footer-navigation{
      width:{$data['footer_menu_width']};
      margin-left:{$data['footer_menu_left_margin']};
    }

    .site-branding{
      min-height:{$header_height};
    }
    @media (max-width:620px){
      .site-branding{
        min-height:{$header_height_1};
      }
    }
    @media (max-width:400px){
      .site-branding{
        min-height:{$header_height_2};
      }
    }
    
CSS;

// keep the title centered vertically

if($title_padding){
  $css.=<<<CSS
    .title-box{
      padding-top: {$title_padding};
      padding-bottom: {$title_padding};
    }
    @media (max-width:620px){
      .title-box{
        padding-top: {$title_padding_1};
        padding-bottom: {$title_padding_1};
      }
    }

CSS;
}

if($color_scheme=='blue'){
  $css.=<<<CSS
    .page-header{
      /*margin-top: 0;*/
    }

CSS;
}

  return $css;
}

/**
 * CSS template for the wp.teplate() function in the color-scheme-control.js.
 * Used to fill the data.[id] fields and add the calculated inline style to the customizer page.
 * This allows the live preview of colors and layout
 */
function starter_color_scheme_css_template() {
  $data = starter_get_scheme_settings('preview');
  ?>
    <script type="text/html" id="tmpl-starter-color-scheme">
      <?php echo starter_get_color_scheme_css($data); ?>
    </script>
  <?php
}
add_action('customize_controls_print_footer_scripts', 'starter_color_scheme_css_template');

/**
 * Load the .js file to perform live preview.
 * wp_localize_script() part allows pass scheme data to the JS script
 */
function starter_customize_control_js() {
  wp_enqueue_script('color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array('customize-controls', 'iris', 'underscore', 'wp-util'), '20141216', true);
  wp_localize_script('color-scheme-control', 'colorScheme', starter_get_scheme_settings('',true));
}
add_action('customize_controls_enqueue_scripts', 'starter_customize_control_js');

/**
 * The script loads the inline CSS created from the template got in the starter_color_scheme_css_template() function
 * This results in the live preview
 */
function starter_customize_scheme_preview_js() {
  wp_enqueue_script('starter-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array('customize-preview'), '20141216', true);
}
add_action('customize_preview_init', 'starter_customize_scheme_preview_js');


//-------------------------------------------------------------- settings -----------------------------------------------------

function starter_get_color_schemes_list() {
  $schemes=array(
    'default'=> _x('Default','Customizer: Scheme','starter'),
    'dark'=> _x('Dark','Customizer: Scheme','starter'),
    'blue'=> _x('Blue','Customizer: Scheme','starter'),
    'custom'=> _x('Custom','Customizer: Scheme','starter'),
 );
  return $schemes;
}

function starter_get_header_height_list() {
  $heights=array(
    '140px'=> '140px',
    '170px'=> '170px',
    '250px'=> '250px',
 );
  return $heights;
}

function starter_get_frontpage_choices() {
  $choices=array(
    'posts'=> _x('Your latest posts','Customizer: Front Page','starter'),
    'page'=> _x('A static page','Customizer: Front Page','starter'),
    'most_viewed'=> _x('Most viewed posts','Customizer: Front Page','starter'),
  );
  return $choices;
}

function starter_get_scheme_settings($scheme,$all=false) {
  $default=array(
    'color_scheme'=>'default',
    'colors'=>array(
      'body_background'=>'#fff',
      'body_foreground'=>'#000',
      'header_background'=>'#eee',
      'header_foreground'=>'#000',
      'container_background'=>'#fff',
      'post_background'=>'#fff',
      'footer_background'=>'#6B6B6B',
      'footer_foreground'=>'#eee',
      
      'nav_background'=>'#6B6B6B',
      'nav_foreground'=>'#fff',
      'nav_current_background'=>'#eee',
      'nav_current_foreground'=>'#000',
      'nav_hover_background'=>'#828282',
      'nav_hover_foreground'=>'#fff',
      
      'footer_nav_background'=>'#fff',
      'footer_nav_foreground'=>'#444',
      'footer_nav_hover_background'=>'#828282',
      'footer_nav_hover_foreground'=>'#fff',
      
      'links_color'=>'#000',
      'links_hover'=>'#000',
      
      'footer_widgets_background'=>'#444',
      'footer_widgets_foreground'=>'#eee',
      'footer_widgets_links'=>'#eee',
      'footer_widgets_border'=>'#ddd',
      
      'table_hover'=>'#eee',
      'pre_background'=>'#eee',
      'pre_foreground'=>'#000',
      'fields_background'=>'#fff',
      'fields_foreground'=>'#000',
      'author_comment_background'=>'#ccc',
      'borders_color'=>'#888',
      'dimmed_color'=>'#888',
    ),
    'layout'=>array(
      // 'content_area_margin'=>'0',
      'content_area_top_margin'=>'0',
      'content_area_bottom_margin'=>'0',
      
      'blog_post_margin'=>'1em',
      'last_post_bottom_margin'=>'0',
      
      'single_post_bottom_margin'=>'0',
      'single_page_bottom_margin'=>'0',
      'post_nav_bottom_margin'=>'2rem',
      'post_nav_left_right_margin'=>'0',
      'paging_nav_top_margin'=>'0',
      'header_min_height'=>'140px',
      'menu_dropdown_width'=>'18rem',
      
      'footer_menu_width'=>'100%',
      'footer_menu_left_margin'=>'0',
      
      'site_content_bottom_padding'=>'1rem',
      'category_bottom_padding'=>'2rem',
      'sidebar_left_padding'=>'3rem',
      'sidebar_right_padding'=>'0',
    )
  );

  $dark=array(
    'color_scheme'=>'dark',
    'colors'=>array(
      'body_background'=>'#333333',
      'body_foreground'=>'#ffffff',
      'header_background'=>'#202020',
      'header_foreground'=>'#e2e2e2',
      'container_background'=>'#3a3a3a',
      'post_background'=>'#3a3a3a',
      'footer_background'=>'#202020',
      'footer_foreground'=>'#e2e2e2',
      
      'nav_background'=>'#111111',
      'nav_foreground'=>'#a0a0a0',
      'nav_current_background'=>'#202020',
      'nav_current_foreground'=>'#e2e2e2',
      'nav_hover_background'=>'#003942',
      'nav_hover_foreground'=>'#f9f9f9',
      
      'footer_nav_background'=>'#333333',
      'footer_nav_foreground'=>'#a0a0a0',
      'footer_nav_hover_background'=>'#098598',
      'footer_nav_hover_foreground'=>'#fff',
      
      'links_color'=>'#e0e0e0',
      'links_hover'=>'#ffffff',
      
      'footer_widgets_background'=>'#444',
      'footer_widgets_foreground'=>'#eee',
      'footer_widgets_links'=>'#eee',
      'footer_widgets_border'=>'#ddd',
      
      'table_hover'=>'#444444',
      'pre_background'=>'#2d2d2d',
      'pre_foreground'=>'#ffffff',
      'fields_background'=>'#565656',
      'fields_foreground'=>'#ffffff',
      'author_comment_background'=>'#333',
      'borders_color'=>'#999',
      'dimmed_color'=>'#bbb',
    ),
    'layout'=>array(
      // 'content_area_margin'=>'0',
      'content_area_top_margin'=>'0',
      'content_area_bottom_margin'=>'0',
      
      'blog_post_margin'=>'1em',
      'last_post_bottom_margin'=>'0',
      
      'single_post_bottom_margin'=>'0',
      'single_page_bottom_margin'=>'0',
      'post_nav_bottom_margin'=>'2rem',
      'post_nav_left_right_margin'=>'0',
      'paging_nav_top_margin'=>'0',
      'header_min_height'=>'140px',
      'menu_dropdown_width'=>'18rem',
      
      'footer_menu_width'=>'100%',
      'footer_menu_left_margin'=>'0',
      
      'site_content_bottom_padding'=>'3rem',
      'category_bottom_padding'=>'2rem',
      'sidebar_left_padding'=>'3rem',
      'sidebar_right_padding'=>'0',
    )
  );

  $blue=array(
    'color_scheme'=>'blue',
    'colors'=>array(
      'body_background'=>'#5081b5',
      'body_foreground'=>'#020202',
      'header_background'=>'#22558c',
      'header_foreground'=>'#e0e0e0',
      'container_background'=>'#5081b5',
      'post_background'=>'#d1ebff',
      
      'nav_background'=>'#0d3d70',
      'nav_foreground'=>'#ffffff',
      'nav_current_background'=>'#22558c',
      'nav_current_foreground'=>'#e0e0e0',
      'nav_hover_background'=>'#36689e',
      'nav_hover_foreground'=>'#f9f9f9',
      
      'footer_nav_background'=>'#5081b5',
      'footer_nav_foreground'=>'#eee',
      'footer_nav_hover_background'=>'#36689e',
      'footer_nav_hover_foreground'=>'#f9f9f9',
      
      'links_color'=>'#020202',
      'links_hover'=>'#0B4789',
      
      'footer_widgets_background'=>'#1D456F',
      'footer_widgets_foreground'=>'#eee',
      'footer_widgets_links'=>'#eee',
      'footer_widgets_border'=>'#ABCEF2',
      
      'footer_background'=>'#22558c',
      'footer_foreground'=>'#e2e2e2',
      'pre_background'=>'#0d3d70',
      'pre_foreground'=>'#ffffff',
      'table_hover'=>'#C6E5FE',
      'fields_background'=>'#22558c',
      'fields_foreground'=>'#ffffff',
      'author_comment_background'=>'#B9E1FF',
      'borders_color'=>'#ABCEF2',
      'dimmed_color'=>'#66707a',
    ),
    'layout'=>array(
      // 'content_area_margin'=>'2em',
      'content_area_top_margin'=>'2em',
      'content_area_bottom_margin'=>'0',
      
      'blog_post_margin'=>'2em',
      'last_post_bottom_margin'=>'0',
      
      'single_post_bottom_margin'=>'2em',
      'single_page_bottom_margin'=>'2em',
      'post_nav_bottom_margin'=>'2em',
      'post_nav_left_right_margin'=>'0',
      'paging_nav_top_margin'=>'3rem',
      'header_min_height'=>'140px',
      'menu_dropdown_width'=>'18rem',
      
      'footer_menu_width'=>'100%',
      'footer_menu_left_margin'=>'0',
      
      'site_content_bottom_padding'=>'0',
      'category_bottom_padding'=>'5rem',
      'sidebar_left_padding'=>'3rem',
      'sidebar_right_padding'=>'1rem',
    )
  );

  $preview=array(
    'color_scheme'=>'preview',
    'colors'=>array(
      'body_background'=>'{{ data.body_background }}',
      'body_foreground'=>'{{ data.body_foreground }}',
      'header_background'=>'{{ data.header_background }}',
      'header_foreground'=>'{{ data.header_foreground }}',
      'container_background'=>'{{ data.container_background }}',
      'post_background'=>'{{ data.post_background }}',
      'footer_background'=>'{{ data.footer_background }}',
      'footer_foreground'=>'{{ data.footer_foreground }}',
      
      'nav_background'=>'{{ data.nav_background }}',
      'nav_foreground'=>'{{ data.nav_foreground }}',
      'nav_current_background'=>'{{ data.nav_current_background }}',
      'nav_current_foreground'=>'{{ data.nav_current_foreground }}',
      'nav_hover_background'=>'{{ data.nav_hover_background }}',
      'nav_hover_foreground'=>'{{ data.nav_hover_foreground }}',
      
      'footer_nav_background'=>'{{ data.footer_nav_background }}',
      'footer_nav_foreground'=>'{{ data.footer_nav_foreground }}',
      'footer_nav_hover_background'=>'{{ data.footer_nav_hover_background }}',
      'footer_nav_hover_foreground'=>'{{ data.footer_nav_hover_foreground }}',
      
      'links_color'=>'{{ data.links_color }}',
      'links_hover'=>'{{ data.links_hover }}',
      
      'footer_widgets_background'=>'{{ data.footer_widgets_background }}',
      'footer_widgets_foreground'=>'{{ data.footer_widgets_foreground }}',
      'footer_widgets_links'=>'{{ data.footer_widgets_links }}',
      'footer_widgets_border'=>'{{ data.footer_widgets_border }}',
      
      'table_hover'=>'{{ data.table_hover }}',
      'pre_background'=>'{{ data.pre_background }}',
      'pre_foreground'=>'{{ data.pre_foreground }}',
      'fields_background'=>'{{ data.fields_background }}',
      'fields_foreground'=>'{{ data.fields_foreground }}',
      'author_comment_background'=>'{{ data.author_comment_background }}',
      'borders_color'=>'{{ data.borders_color }}',
      'dimmed_color'=>'{{ data.dimmed_color }}',
    ),
    'layout'=>array(
      // 'content_area_margin'=>'{{ data.content_area_margin }}',
      'content_area_top_margin'=>'{{ data.content_area_top_margin }}',
      'content_area_bottom_margin'=>'{{ data.content_area_bottom_margin }}',
      
      'blog_post_margin'=>'{{ data.blog_post_margin }}',
      'last_post_bottom_margin'=>'{{ data.last_post_bottom_margin }}',
      
      'single_post_bottom_margin'=>'{{ data.single_post_bottom_margin }}',
      'single_page_bottom_margin'=>'{{ data.single_page_bottom_margin }}',
      'paging_nav_top_margin'=>'{{ data.paging_nav_top_margin }}',
      'post_nav_left_right_margin'=>'{{ data.post_nav_left_right_margin }}',
      'header_min_height'=>'{{ data.header_min_height }}',
      'header_height_1'=>'{{ data.header_height_1 }}',
      'header_height_2'=>'{{ data.header_height_2 }}',
      'menu_dropdown_width'=>'{{ data.menu_dropdown_width }}',
      
      'footer_menu_width'=>'{{ data.footer_menu_width }}',
      'footer_menu_left_margin'=>'{{ data.footer_menu_left_margin }}',

      'site_content_bottom_padding'=>'{{ data.site_content_bottom_padding }}',
      'category_bottom_padding'=>'{{ data.category_bottom_padding }}',
      'sidebar_left_padding'=>'{{ data.sidebar_left_padding }}',
      'sidebar_right_padding'=>'{{ data.sidebar_right_padding }}',
    ),
  );

  if($all){
    $opt=get_option('starter_scheme_options');
    $opt=starter_fill_scheme_empty_props($opt);

    $custom=array(
      'color_scheme'=>'custom',
      'colors'=>array(
        'body_background'=>$opt['body_background'],
        'body_foreground'=>$opt['body_foreground'],
        'header_background'=>$opt['header_background'],
        'header_foreground'=>$opt['header_foreground'],
        'container_background'=>$opt['container_background'],
        'post_background'=>$opt['post_background'],
        
        'nav_background'=>$opt['nav_background'],
        'nav_foreground'=>$opt['nav_foreground'],
        'nav_current_background'=>$opt['nav_current_background'],
        'nav_current_foreground'=>$opt['nav_current_foreground'],
        'nav_hover_background'=>$opt['nav_hover_background'],
        'nav_hover_foreground'=>$opt['nav_hover_foreground'],
        
        'footer_nav_background'=>$opt['footer_nav_background'],
        'footer_nav_foreground'=>$opt['footer_nav_foreground'],
        'footer_nav_hover_background'=>$opt['footer_nav_hover_background'],
        'footer_nav_hover_foreground'=>$opt['footer_nav_hover_foreground'],
        
        'links_color'=>$opt['links_color'],
        'links_hover'=>$opt['links_hover'],
        
        'footer_widgets_background'=>$opt['footer_widgets_background'],
        'footer_widgets_foreground'=>$opt['footer_widgets_foreground'],
        'footer_widgets_links'=>$opt['footer_widgets_links'],
        'footer_widgets_border'=>$opt['footer_widgets_border'],
        
        'footer_background'=>$opt['footer_background'],
        'footer_foreground'=>$opt['footer_foreground'],
        'pre_background'=>$opt['pre_background'],
        'pre_foreground'=>$opt['pre_foreground'],
        'table_hover'=>$opt['table_hover'],
        'fields_background'=>$opt['fields_background'],
        'fields_foreground'=>$opt['fields_foreground'],
        'author_comment_background'=>$opt['author_comment_background'],
        'borders_color'=>$opt['borders_color'],
        'dimmed_color'=>$opt['dimmed_color'],
      ),
      'layout'=>array(
        // 'content_area_margin'=>$opt['content_area_margin'],
        'content_area_top_margin'=>$opt['content_area_top_margin'],
        'content_area_bottom_margin'=>$opt['content_area_bottom_margin'],
        
        'blog_post_margin'=>$opt['blog_post_margin'],
        'last_post_bottom_margin'=>$opt['last_post_bottom_margin'],
        
        'single_post_bottom_margin'=>$opt['single_post_bottom_margin'],
        'single_page_bottom_margin'=>$opt['single_page_bottom_margin'],
        'post_nav_bottom_margin'=>$opt['post_nav_bottom_margin'],
        'post_nav_left_right_margin'=>$opt['post_nav_left_right_margin'],
        'paging_nav_top_margin'=>$opt['paging_nav_top_margin'],
        'header_min_height'=>$opt['header_min_height'],
        'menu_dropdown_width'=>$opt['menu_dropdown_width'],
        
        'footer_menu_width'=>$opt['footer_menu_width'],
        'footer_menu_left_margin'=>$opt['footer_menu_left_margin'],
        
        'site_content_bottom_padding'=>$opt['site_content_bottom_padding'],
        'category_bottom_padding'=>$opt['category_bottom_padding'],
        'sidebar_left_padding'=>$opt['sidebar_left_padding'],
        'sidebar_right_padding'=>$opt['sidebar_right_padding'],
      )
    );
    return array('default'=>$default,'dark'=>$dark,'blue'=>$blue,'custom'=>$custom);
  }

  switch($scheme){
    case 'default':
      $_scheme=$default;
      break;
    case 'dark':
      $_scheme=$dark;
      break;
    case 'blue':
      $_scheme=$blue;
      break;
    case 'preview':
      $_scheme=$preview;
      break;
  }
  
  return $_scheme;
}

function starter_get_customizer_labels($type){
  switch($type){
    case 'sections':
      $ids=array(
        'base_colors',
        'container_colors',
        'nav_colors',
        'footer_nav_colors',
        'links_colors',
        'widget_colors',
        'other_colors',
        'color_settings',
        'margins',
        'paddings',
        'header',
        'footer',
        'widgets',
     );
      
      $labels=array(
        _x('Base Colors','Customizer: Sections','starter'),
        _x('Cotnainer Colors','Customizer: Sections','starter'),
        _x('Navigation Colors','Customizer: Sections','starter'),
        _x('Footer Navigation Colors','Customizer: Sections','starter'),
        _x('Links Colors','Customizer: Sections','starter'),
        _x('Widget Colors','Customizer: Sections','starter'),
        _x('Other Colors','Customizer: Sections','starter'),
        _x('Color Setting','Customizer: Sections','starter'),
        _x('Margins','Customizer: Sections','starter'),
        _x('Paddings','Customizer: Sections','starter'),
        _x('Header','Customizer: Sections','starter'),
        _x('Footer','Customizer: Sections','starter'),
        _x('Widgets','Customizer: Sections','starter'),
     );
      
      break;
    case 'colors':
      $ids=array(
        'body_background',
        'body_foreground',
        'header_background',
        'header_foreground',
        'container_background',
        'post_background',
        'footer_background',
        'footer_foreground',
        
        'nav_background',
        'nav_foreground',
        'nav_current_background',
        'nav_current_foreground',
        'nav_hover_background',
        'nav_hover_foreground',
        
        'footer_nav_background',
        'footer_nav_foreground',
        'footer_nav_hover_background',
        'footer_nav_hover_foreground',
        
        'links_color',
        'links_hover',
        
        'footer_widgets_background',
        'footer_widgets_foreground',
        'footer_widgets_links',
        'footer_widgets_border',
        
        'table_hover',
        'pre_background',
        'pre_foreground',
        'fields_background',
        'fields_foreground',
        'author_comment_background',
        'borders_color',
        'dimmed_color',
        
        'color_scheme',
        'use_category_colors',
     );
      
      $labels=array(
        _x('Body Background','Customizer: Colors','starter'),
        _x('Body Foreground','Customizer: Colors','starter'),
        _x('Header Background','Customizer: Colors','starter'),
        _x('Header Foreground','Customizer: Colors','starter'),
        _x('Container Background','Customizer: Colors','starter'),
        _x('Post Background','Customizer: Colors','starter'),
        _x('Footer Background','Customizer: Colors','starter'),
        _x('Footer Foreground','Customizer: Colors','starter'),
        
        _x('Background','Customizer: Colors','starter'),
        _x('Foreground','Customizer: Colors','starter'),
        _x('Current Background','Customizer: Colors','starter'),
        _x('Current Foreground','Customizer: Colors','starter'),
        _x('Nav Hover Background','Customizer: Colors','starter'),
        _x('Nav Hover Foreground','Customizer: Colors','starter'),
        
        _x('Background','Customizer: Colors','starter'),
        _x('Foreground','Customizer: Colors','starter'),
        _x('Nav Hover Background','Customizer: Colors','starter'),
        _x('Nav Hover Foreground','Customizer: Colors','starter'),
        
        _x('Links Color','Customizer: Colors','starter'),
        _x('Links Hover','Customizer: Colors','starter'),
        
        _x('Footer Widgets Background','Customizer: Colors','starter'),
        _x('Footer Widgets Foreground','Customizer: Colors','starter'),
        _x('Footer Widgets Links','Customizer: Colors','starter'),
        _x('Footer Widgets Border','Customizer: Colors','starter'),
        
        _x('Table Hover','Customizer: Colors','starter'),
        _x('Predefined Background','Customizer: Colors','starter'),
        _x('Predefined Foreground','Customizer: Colors','starter'),
        _x('Fields Background','Customizer: Colors','starter'),
        _x('Fields Foreground','Customizer: Colors','starter'),
        _x('Author Comment Background','Customizer: Colors','starter'),
        _x('Borders Color','Customizer: Colors','starter'),
        _x('Dimmed Color','Customizer: Colors','starter'),
        _x('Select Scheme','Customizer: Colors','starter'),
        _x('Use Category Colors','Customizer: Colors','starter'),
     );

      break;
    case 'layout':
      $ids=array(
        'content_area_top_margin',
        'content_area_bottom_margin',
        'site_content_bottom_padding',
        
        'blog_post_margin',
        'last_post_bottom_margin',
        
        'single_post_bottom_margin',
        'single_page_bottom_margin',
        'post_nav_bottom_margin',
        'post_nav_left_right_margin',
        'paging_nav_top_margin',
        'header_min_height',
        'menu_dropdown_width',
        
        'footer_menu_width',
        'footer_menu_left_margin',
        
        'category_bottom_padding',
        'sidebar_left_padding',
        'sidebar_right_padding',
      );
      
      $labels=array(
        _x('Content Area Top Margin','Customizer: Layout','starter'),
        _x('Content Area Bottom Margin','Customizer: Layout','starter'),
        _x('Site Content Bottom Padding','Customizer: Layout','starter'),
        
        _x('Blog Post Margin','Customizer: Layout','starter'),
        _x('Last Post Bottom Margin','Customizer: Layout','starter'),
        
        _x('Single Post Bottom Margin','Customizer: Layout','starter'),
        _x('Single Page Bottom Margin','Customizer: Layout','starter'),
        _x('Post Nav Bottom Margin','Customizer: Layout','starter'),
        _x('Post Nav Left-Right Margin','Customizer: Layout','starter'),
        _x('Paging Nav Bottom Margin','Customizer: Layout','starter'),
        _x('Header Min Height','Customizer: Layout','starter'),
        _x('Menu Dropdown Width','Customizer: Layout','starter'),
        
        _x('Footer Menu Width','Customizer: Layout','starter'),
        _x('Footer Menu Left Margin','Customizer: Layout','starter'),
        
        _x('Category Bottom Padding','Customizer: Layout','starter'),
        _x('Sidebar Left Padding','Customizer: Layout','starter'),
        _x('Sidebar Right Padding','Customizer: Layout','starter'),
      );
      
      break;
  }
  
  $labels=array_combine($ids, $labels);
  return $labels;
}
