<?php

// Remove all default dashboard widgets
function remove_default_dashboard_widgets()
{
  global $wp_meta_boxes;

  // Remove "Welcome" panel
  remove_action('welcome_panel', 'wp_welcome_panel');

  // Remove widgets from the normal core section
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);      // Site Health Status
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);        // At a Glance
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);         // Activity
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);  // Recent Comments
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);   // Incoming Links
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);          // Plugins

  // Remove widgets from the side core section
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);        // Quick Draft
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);      // Recent Drafts
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);            // WordPress Events & News
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);          // Other WordPress News

  // Remove widgets from the high priority sections (both normal and side)
  if (isset($wp_meta_boxes['dashboard']['normal']['high'])) {
    foreach ($wp_meta_boxes['dashboard']['normal']['high'] as $key => $widget) {
      if ($key !== 'custom_dashboard_widget') {
        unset($wp_meta_boxes['dashboard']['normal']['high'][$key]);
      }
    }
  }

  if (isset($wp_meta_boxes['dashboard']['side']['high'])) {
    unset($wp_meta_boxes['dashboard']['side']['high']);
  }
}
add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets', 999);

// Disable the welcome panel completely
function disable_welcome_panel()
{
  update_user_meta(get_current_user_id(), 'show_welcome_panel', 0);
}
add_action('load-index.php', 'disable_welcome_panel');
