<?php
// inc/setup.php
function minimal_theme_setup()
{
  // Add default posts and comments RSS feed links to head
  add_theme_support('automatic-feed-links');
  // Let WordPress manage the document title
  add_theme_support('title-tag');
  // Enable support for Post Thumbnails on posts and pages
  add_theme_support('post-thumbnails');
  // Switch default core markup to valid HTML5
  add_theme_support('html5', array(
    'search-form',
    'gallery',
    'caption',
    'style',
    'script',
  ));
  // Register menu locations
  register_nav_menus(array(
    'main-navigation' => __('Main Navigation', 'minimal-theme'),
    'mobile-navigation' => __('Mobile Navigation', 'minimal-theme'),
    'footer-navigation' => __('Footer Navigation', 'minimal-theme'),
  ));
}
add_action('after_setup_theme', 'minimal_theme_setup');
