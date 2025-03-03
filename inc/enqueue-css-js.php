<?php
// Main Stylesheet und Scripts
// inc/enqueue.php
function minimal_theme_scripts()
{
  // Enqueue main stylesheet
  wp_enqueue_style(
    'minimal-theme-style',
    get_template_directory_uri() . '/assets/css/main.css',
    array(),
    filemtime(get_template_directory() . '/assets/css/main.css')
  );
  // Enqueue main JavaScript file (no jQuery dependency)
  wp_enqueue_script('minimal-theme-script', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'minimal_theme_scripts');

// Admin Styles
// inc/admin-styles.php
function minimal_theme_admin_styles()
{
  $admin_css_path = get_template_directory() . '/cms/css/admin.css';
  if (file_exists($admin_css_path)) {
    wp_enqueue_style(
      'minimal-theme-admin-styles',
      get_template_directory_uri() . '/cms/css/admin.css',
      array(),
      filemtime($admin_css_path),
      'all'
    );
  }
}
add_action('admin_enqueue_scripts', 'minimal_theme_admin_styles');

function minimal_theme_login_styles()
{
  $login_css_path = get_template_directory() . '/cms/css/login.css';
  if (file_exists($login_css_path)) {
    wp_enqueue_style(
      'minimal-theme-login-styles',
      get_template_directory_uri() . '/cms/css/login.css',
      array(),
      filemtime($login_css_path),
      'all'
    );
  }
}
add_action('login_enqueue_scripts', 'minimal_theme_login_styles');
