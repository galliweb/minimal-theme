<?php

/**
 * Completely disable comments in WordPress
 * Add this code to your theme's functions.php file
 */

// Main function to disable comments completely
function completely_disable_comments()
{
  // Remove comment support from all post types
  $post_types = get_post_types();
  foreach ($post_types as $post_type) {
    if (post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }

  // Remove comments page and discussion settings from admin menu
  remove_menu_page('edit-comments.php');
  remove_submenu_page('options-general.php', 'options-discussion.php');

  // Remove comments metabox from dashboard
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

  // Disable comments widgets
  unregister_widget('WP_Widget_Recent_Comments');
  add_filter('show_recent_comments_widget_style', '__return_false');
}
add_action('admin_init', 'completely_disable_comments');

// Admin bar modifications
function disable_comments_admin_bar()
{
  global $wp_admin_bar;
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    $wp_admin_bar->remove_menu('comments');
  }
}
add_action('wp_before_admin_bar_render', 'disable_comments_admin_bar');

// Redirect any user trying to access comments or discussion pages
function disable_comments_admin_redirect()
{
  global $pagenow;
  if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
    wp_redirect(admin_url());
    exit;
  }
}
add_action('admin_init', 'disable_comments_admin_redirect');

// Close comments on the front-end
function disable_comments_frontend()
{
  return false;
}
add_filter('comments_open', 'disable_comments_frontend', 20, 2);
add_filter('pings_open', 'disable_comments_frontend', 20, 2);

// Hide existing comments
function disable_comments_hide_existing($comments)
{
  return array();
}
add_filter('comments_array', 'disable_comments_hide_existing', 10, 2);

// Dequeue comment scripts
function disable_comments_scripts()
{
  wp_dequeue_script('comment-reply');
  wp_deregister_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'disable_comments_scripts');

// Remove comment columns
function disable_comments_columns($columns)
{
  unset($columns['comments']);
  return $columns;
}
// Apply to all post types that might have columns
add_filter('manage_posts_columns', 'disable_comments_columns');
add_filter('manage_pages_columns', 'disable_comments_columns');
add_filter('manage_media_columns', 'disable_comments_columns');

// Remove comment-related REST API endpoints
function disable_comments_rest_api($endpoints)
{
  if (isset($endpoints['/wp/v2/comments'])) {
    unset($endpoints['/wp/v2/comments']);
  }
  if (isset($endpoints['/wp/v2/comments/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/comments/(?P<id>[\d]+)']);
  }
  return $endpoints;
}
add_filter('rest_endpoints', 'disable_comments_rest_api');

// Disable comments UI elements on init
function disable_comments_init()
{
  // Disable comments widgets
  add_action('widgets_init', function () {
    unregister_widget('WP_Widget_Recent_Comments');
    add_filter('show_recent_comments_widget_style', '__return_false');
  });
}
add_action('init', 'disable_comments_init');
