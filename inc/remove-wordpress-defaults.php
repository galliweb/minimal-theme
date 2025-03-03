<?php

// inc/cleanup.php
// Remove classic theme styles completely
function minimal_theme_remove_styles()
{
  wp_dequeue_style('classic-theme-styles');
  wp_deregister_style('classic-theme-styles');
  // Remove the wp-block-library CSS as well
  wp_dequeue_style('wp-block-library');
  wp_deregister_style('wp-block-library');
  // This removes global styles too
  wp_dequeue_style('global-styles');
  wp_deregister_style('global-styles');
}
add_action('wp_enqueue_scripts', 'minimal_theme_remove_styles', 100);
add_action('enqueue_block_assets', 'minimal_theme_remove_styles', 100);

// Remove unnecessary WordPress header tags
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

function minimal_theme_remove_dashicons_frontend()
{
  if (!is_admin() && !is_customize_preview() && !is_user_logged_in()) {
    wp_deregister_style('dashicons');
  }
}
add_action('wp_enqueue_scripts', 'minimal_theme_remove_dashicons_frontend', 999);
