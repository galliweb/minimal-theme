<?php

/**
 * Add custom SEO meta tags to wp_head using ACF fields
 */
function custom_acf_seo_tags()
{
  // Only proceed if ACF functions exist
  if (!function_exists('get_field')) {
    return;
  }

  // Check if we're on a single post or page and have a valid post ID
  if (is_singular()) {
    global $post;
    $post_id = $post->ID;

    // Get the ACF field values for this post/page
    // Note: Make sure field names exactly match what's in ACF
    $meta_title = get_field('meta-titel', $post_id);
    $meta_description = get_field('meta-beschreibung', $post_id);

    // For debugging - check if fields are being retrieved
    // echo "<!-- Debug: Title: " . esc_html($meta_title) . " -->";
    // echo "<!-- Debug: Description: " . esc_html($meta_description) . " -->";

    // For title, we'll use wp_head filter rather than removing the action
    if (!empty($meta_title)) {
      // Instead of trying to remove the default title, let's override it
      add_filter('pre_get_document_title', function () use ($meta_title) {
        return esc_html($meta_title);
      }, 999);

      // Also add Open Graph title
      echo '<meta property="og:title" content="' . esc_attr($meta_title) . '" />' . "\n";
    }

    // Output the description meta tag if meta-beschreibung exists
    if (!empty($meta_description)) {
      echo '<meta name="description" content="' . esc_attr($meta_description) . '" />' . "\n";
      // Also add Open Graph description
      echo '<meta property="og:description" content="' . esc_attr($meta_description) . '" />' . "\n";
    }
  }
}

// Add the function to wp_head hook with priority 5
add_action('wp_head', 'custom_acf_seo_tags', 5);
