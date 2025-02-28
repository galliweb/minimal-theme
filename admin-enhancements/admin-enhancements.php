<?php

/**
 * Remove WordPress Admin Help Button
 */
function remove_admin_help_button()
{
  // This targets the help tab in the admin panel
  $screen = get_current_screen();
  $screen->remove_help_tabs();
}
add_action('admin_head', 'remove_admin_help_button');


/**
 * Remove WordPress Logo from Admin Bar
 */
function remove_wp_logo_from_admin_bar()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_node('wp-logo');
}
add_action('wp_before_admin_bar_render', 'remove_wp_logo_from_admin_bar');



// Disable pingbacks and trackbacks completely
function disable_pingback_trackback($links)
{
  foreach ($links as $l => $link)
    if (strpos($link, 'trackback') !== false || strpos($link, 'pingback') !== false)
      unset($links[$l]);
  return $links;
}
add_filter('pre_ping', 'disable_pingback_trackback');

// Disable pingback functionality
function disable_pingbacks()
{
  // Disable pingback URL
  add_filter('bloginfo_url', function ($output, $show) {
    if ($show == 'pingback_url') return '';
    return $output;
  }, 10, 2);

  // Disable XMLRPC pingback methods
  add_filter('xmlrpc_methods', function ($methods) {
    unset($methods['pingback.ping']);
    unset($methods['pingback.extensions.getPingbacks']);
    return $methods;
  });

  // Remove X-Pingback header
  add_filter('wp_headers', function ($headers) {
    unset($headers['X-Pingback']);
    return $headers;
  });
}
add_action('init', 'disable_pingbacks');

// Disable XML-RPC completely
add_filter('xmlrpc_enabled', '__return_false');

// Remove XML-RPC headers
add_filter('wp_headers', function ($headers) {
  unset($headers['X-Pingback']);
  return $headers;
});


function dequeue_unnecessary_assets()
{
  // WordPress Emoji
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

  // WordPress embeds
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');

  // Remove WP version
  remove_action('wp_head', 'wp_generator');

  // Remove wlwmanifest link
  remove_action('wp_head', 'wlwmanifest_link');

  // Remove RSD link
  remove_action('wp_head', 'rsd_link');

  // Remove shortlink
  remove_action('wp_head', 'wp_shortlink_wp_head');

  // Remove REST API link
  remove_action('wp_head', 'rest_output_link_wp_head');
}
add_action('init', 'dequeue_unnecessary_assets');

// Disable self pingbacks
function disable_self_pingbacks(&$links)
{
  $home = get_option('home');
  foreach ($links as $l => $link)
    if (strpos($link, $home) !== false)
      unset($links[$l]);
}
add_action('pre_ping', 'disable_self_pingbacks');

// Remove Settings > Writing menu from WordPress admin
function remove_writing_settings_page()
{
  global $submenu;

  // Remove Writing submenu from Settings
  if (isset($submenu['options-general.php'])) {
    foreach ($submenu['options-general.php'] as $key => $item) {
      // 'options-writing.php' is the slug for the Writing settings page
      if ($item[2] === 'options-writing.php') {
        unset($submenu['options-general.php'][$key]);
        break;
      }
    }
  }
}
add_action('admin_menu', 'remove_writing_settings_page', 999);

// Redirect users trying to access the writing settings page directly
function block_writing_settings_access()
{
  // Check if current page is the writing settings page
  $current_screen = get_current_screen();

  if ($current_screen && $current_screen->id === 'settings-writing') {
    // Redirect to dashboard or another page
    wp_redirect(admin_url('index.php'));
    exit;
  }
}
add_action('current_screen', 'block_writing_settings_access');


// Remove RSS feed links from wp_head
function disable_rss_feeds()
{
  // Remove feed links from wp_head
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);

  // Remove feed discovery links
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');

  // Disable REST API link in headers
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('init', 'disable_rss_feeds');

// Redirect all feed requests to home page
function redirect_feeds()
{
  if (is_feed()) {
    wp_redirect(home_url(), 301);
    exit;
  }
}
add_action('template_redirect', 'redirect_feeds');
