<?php

/**
 * Minimal Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Include admin enhancements
 */
require_once get_template_directory() . '/inc/cms/admin-enhancements.php';
require_once get_template_directory() . '/inc/cms/remove-comments.php';
require_once get_template_directory() . '/inc/cms/remove-dashboard-widgets.php';
require_once get_template_directory() . '/inc/templates/seo.php';

/**
 * Theme Setup
 */
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

/**
 * Enqueue scripts and styles
 */
function minimal_theme_scripts()
{
    // Enqueue main stylesheet
    wp_enqueue_style(
        'minimal-theme-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // Enqueue main JavaScript file (no jQuery dependency)
    wp_enqueue_script('minimal-theme-script', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'minimal_theme_scripts');

// Remove classic theme styles completely
function minimal_theme_remove_styles()
{
    wp_dequeue_style('classic-theme-styles');
    wp_deregister_style('classic-theme-styles');

    // Remove the wp-block-library CSS as well (it often works together with classic styles)
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');

    // This removes global styles too
    wp_dequeue_style('global-styles');
    wp_deregister_style('global-styles');
}

// Apply at multiple hook points to ensure it's removed
add_action('wp_enqueue_scripts', 'minimal_theme_remove_styles', 100);
add_action('enqueue_block_assets', 'minimal_theme_remove_styles', 100);

/**
 * Disable Block Editor and related styles
 */
function minimal_theme_disable_block_editor()
{
    // Disable Gutenberg on the back end
    add_filter('use_block_editor_for_post', '__return_false', 10);

    // Disable Gutenberg for widgets
    add_filter('use_widgets_block_editor', '__return_false');

    // Disable block library CSS
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS if using WooCommerce
    wp_dequeue_style('global-styles'); // Remove global styles

    // Remove editor styles
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}
add_action('wp_enqueue_scripts', 'minimal_theme_disable_block_editor', 100);
add_action('admin_init', 'minimal_theme_disable_block_editor', 100);

/**
 * Enable Classic Widgets
 */
// This function will run when the theme is activated
function minimal_theme_enable_classic_widgets()
{
    update_option('use_widgets_block_editor', false);
}
add_action('after_switch_theme', 'minimal_theme_enable_classic_widgets');

/**
 * Enable Classic Editor
 */
function minimal_theme_enable_classic_editor()
{
    update_option('classic-editor-replace', 'classic');
    update_option('classic-editor-allow-users', 'disallow');
}
add_action('after_switch_theme', 'minimal_theme_enable_classic_editor');

/**
 * Add body classes
 */
function minimal_theme_body_classes($classes)
{
    // Add a class if we're on a single post
    if (is_single()) {
        $classes[] = 'single-post-view';
    }

    return $classes;
}
add_filter('body_class', 'minimal_theme_body_classes');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function minimal_theme_page_menu_args($args)
{
    $args['show_home'] = true;
    return $args;
}
add_filter('wp_page_menu_args', 'minimal_theme_page_menu_args');

/**
 * Adds custom classes to the array of body classes.
 */
function minimal_theme_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'minimal_theme_pingback_header');

/**
 * Enqueue admin.css for admin pages only
 */
function minimal_theme_admin_styles()
{
    // Check if the file exists
    $admin_css_path = get_template_directory() . '/cms/css/admin.css';
    if (file_exists($admin_css_path)) {
        // Get the CSS file path
        $admin_css = get_template_directory_uri() . '/cms/css/admin.css';

        // Enqueue the admin CSS file
        wp_enqueue_style(
            'minimal-theme-admin-styles',
            $admin_css,
            array(),
            filemtime($admin_css_path),
            'all'
        );
    }
}
// Hook into admin_enqueue_scripts which only fires on admin pages
add_action('admin_enqueue_scripts', 'minimal_theme_admin_styles');

/**
 * Enqueue login.css for the login page only
 */
function minimal_theme_login_styles()
{
    // Check if the file exists
    $login_css_path = get_template_directory() . '/cms/css/login.css';
    if (file_exists($login_css_path)) {
        // Get the CSS file path
        $login_css = get_template_directory_uri() . '/cms/css/login.css';

        // Enqueue the login CSS file
        wp_enqueue_style(
            'minimal-theme-login-styles',
            $login_css,
            array(),
            filemtime($login_css_path),
            'all'
        );
    }
}
// Hook into login_enqueue_scripts which only fires on the login page
add_action('login_enqueue_scripts', 'minimal_theme_login_styles');

// Remove unnecessary WordPress header tags
remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); //removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action('wp_head', 'feed_links', 2); //removes feed links.
remove_action('wp_head', 'feed_links_extra', 3);  //removes comments feed. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Removes prev and next links

/**
 * Remove WordPress Dashicons from the frontend
 */
function minimal_theme_remove_dashicons_frontend()
{
    // Only remove Dashicons for non-admin users
    if (!is_admin() && !is_customize_preview() && !is_user_logged_in()) {
        wp_deregister_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'minimal_theme_remove_dashicons_frontend', 999);
