<?php

// inc/editor.php
function minimal_theme_disable_block_editor()
{
  // Disable Gutenberg on the back end
  add_filter('use_block_editor_for_post', '__return_false', 10);
  // Disable Gutenberg for widgets
  add_filter('use_widgets_block_editor', '__return_false');
  // Disable block library CSS
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style');
  wp_dequeue_style('global-styles');
  // Remove editor styles
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}
add_action('wp_enqueue_scripts', 'minimal_theme_disable_block_editor', 100);
add_action('admin_init', 'minimal_theme_disable_block_editor', 100);

// Enable Classic Widgets
function minimal_theme_enable_classic_widgets()
{
  update_option('use_widgets_block_editor', false);
}
add_action('after_switch_theme', 'minimal_theme_enable_classic_widgets');

// Enable Classic Editor
function minimal_theme_enable_classic_editor()
{
  update_option('classic-editor-replace', 'classic');
  update_option('classic-editor-allow-users', 'disallow');
}
add_action('after_switch_theme', 'minimal_theme_enable_classic_editor');
