<?php

/**
 * Minimal Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Main Stylesheet und Scripts
function starter_theme_scripts()
{
  // Enqueue main stylesheet
  wp_enqueue_style(
    'fastpage-style',
    get_template_directory_uri() . '/main.css',
    array(),
    filemtime(get_template_directory() . '/main.css')
  );

  wp_enqueue_script('fastpage-script', get_template_directory_uri() . '/main.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'starter_theme_scripts');

// Admin Styles
function starter_theme_admin_styles()
{
  $admin_css_path = get_template_directory() . '/assets/css/admin.css';
  if (file_exists($admin_css_path)) {
    wp_enqueue_style(
      'fastpage-admin-styles',
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
      'fastpage-login-styles',
      get_template_directory_uri() . '/assets/css/login.css',
      array(),
      filemtime($login_css_path),
      'all'
    );
  }
}
add_action('login_enqueue_scripts', 'starter_theme_login_styles');

/* Software Includes */
require_once get_template_directory() . '/includes/admin-enhancements.php';
require_once get_template_directory() . '/includes/remove-comments.php';
require_once get_template_directory() . '/includes/remove-dashboard-widgets.php';
require_once get_template_directory() . '/includes/remove-wordpress-defaults.php';
require_once get_template_directory() . '/includes/login-tweaks.php';

/* Views */
require_once get_template_directory() . '/includes/theme-setup.php';
require_once get_template_directory() . '/includes/editor-config.php';
require_once get_template_directory() . '/includes/helpers.php';
