<?php

/**
 * Minimal Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}



add_action('wp_enqueue_scripts', function(){
    $manifestPath = get_theme_file_path('dist/.vite/manifest.json');

    // Check if the manifest file exists and is readable before using it
    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
 
        // Check if the file is in the manifest before enqueuing
        if (isset($manifest['src/scripts/main.js'])) {
            wp_enqueue_script(
                'mytheme', 
                get_theme_file_uri('dist/' . $manifest['src/scripts/main.js']['file']),
                array(), // dependencies
                null,    // version
                true     // in footer
            );
            // Enqueue the CSS file
            wp_enqueue_style('mytheme', get_theme_file_uri('dist/' . $manifest['src/scripts/main.js']['css'][0]));
        }
    }
});


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