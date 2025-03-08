<?php
// Main Stylesheet und Scripts
function starter_theme_scripts()
{
  // Enqueue main stylesheet
  wp_enqueue_style(
    'starter-theme-style',
    get_template_directory_uri() . '/assets/css/frontend.css',
    array(),
    filemtime(get_template_directory() . '/assets/css/frontend.css')
  );

  wp_enqueue_script('starter-theme-script', get_template_directory_uri() . '/assets/js/script.min.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'starter_theme_scripts');

// Admin Styles
function starter_theme_admin_styles()
{
  $admin_css_path = get_template_directory() . '/assets/css/admin.css';
  if (file_exists($admin_css_path)) {
    wp_enqueue_style(
      'starter-theme-admin-styles',
      get_template_directory_uri() . '/assets/css/admin.css',
      array(),
      filemtime($admin_css_path),
      'all'
    );
  }
}
add_action('admin_enqueue_scripts', 'starter_theme_admin_styles');

function starter_theme_login_styles()
{
  $login_css_path = get_template_directory() . '/assets/css/login.css';
  if (file_exists($login_css_path)) {
    wp_enqueue_style(
      'starter-theme-login-styles',
      get_template_directory_uri() . '/assets/css/login.css',
      array(),
      filemtime($login_css_path),
      'all'
    );
  }
}
add_action('login_enqueue_scripts', 'starter_theme_login_styles');
