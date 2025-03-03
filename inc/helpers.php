<?php

// inc/template-helpers.php
function minimal_theme_body_classes($classes)
{
  // Add a class if we're on a single post
  if (is_single()) {
    $classes[] = 'single-post-view';
  }
  return $classes;
}
add_filter('body_class', 'minimal_theme_body_classes');

function minimal_theme_page_menu_args($args)
{
  $args['show_home'] = true;
  return $args;
}
add_filter('wp_page_menu_args', 'minimal_theme_page_menu_args');

function minimal_theme_pingback_header()
{
  if (is_singular() && pings_open()) {
    echo '
<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
  }
}
add_action('wp_head', 'minimal_theme_pingback_header');

// Add user ID to admin body class
function add_user_id_to_admin_body_class($classes)
{
  // Get the current user ID
  $current_user_id = get_current_user_id();

  // Append the user ID as a class
  if ($current_user_id) {
    $classes .= ' user-id-' . $current_user_id;
  }

  return $classes;
}
add_filter('admin_body_class', 'add_user_id_to_admin_body_class');


// user role body class
function add_user_role_body_class($classes)
{
  // Check if the user is logged in
  if (is_admin() && is_user_logged_in()) {
    $user = wp_get_current_user();
    if (!empty($user->roles)) {
      // Add the first role as a class (WordPress allows multiple roles, usually the first one is primary)
      $classes .= ' user-role-' . sanitize_html_class($user->roles[0]);
    }
  }
  return $classes;
}
add_filter('admin_body_class', 'add_user_role_body_class');


// post type class

function add_custom_post_type_body_class($classes)
{
  // Check if we're in the block editor
  if (is_admin() && function_exists('get_current_screen')) {
    $screen = get_current_screen();
    if ($screen && $screen->post_type) {
      // Add the custom post type class
      $classes .= ' post-type-' . sanitize_html_class($screen->post_type);
    }
  }
  return $classes;
}
add_filter('admin_body_class', 'add_custom_post_type_body_class');
