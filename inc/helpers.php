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
