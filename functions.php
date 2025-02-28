<?php

/**
 * Classic Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Include admin enhancements
 */
require_once get_template_directory() . '/admin-enhancements/admin-enhancements.php';
require_once get_template_directory() . '/admin-enhancements/remove-comments.php';
require_once get_template_directory() . '/admin-enhancements/dashboard.php';

/**
 * Theme Setup
 */
function classic_theme_setup()
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
        'main-navigation' => __('Main Navigation', 'classic-theme'),
        'mobile-navigation' => __('Mobile Navigation', 'classic-theme'),
        'footer-navigation' => __('Footer Navigation', 'classic-theme'),
    ));
}
add_action('after_setup_theme', 'classic_theme_setup');

/**
 * Enqueue scripts and styles
 */
function classic_theme_scripts()
{
    // Enqueue main stylesheet
    wp_enqueue_style(
        'classic-theme-style',
        get_template_directory_uri() . '/css/style.css',
        array(),
        filemtime(get_template_directory() . '/css/style.css')
    );

    // Enqueue main JavaScript file (no jQuery dependency)
    wp_enqueue_script('classic-theme-script', get_template_directory_uri() . '/js/main.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'classic_theme_scripts');

// Remove classic theme styles completely
function remove_classic_theme_styles()
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
add_action('wp_enqueue_scripts', 'remove_classic_theme_styles', 100);
add_action('enqueue_block_assets', 'remove_classic_theme_styles', 100);




/**
 * Disable Block Editor and related styles
 */
function classic_theme_disable_block_editor()
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
add_action('wp_enqueue_scripts', 'classic_theme_disable_block_editor', 100);
add_action('admin_init', 'classic_theme_disable_block_editor', 100);

/**
 * Enable Classic Widgets
 */
// This function will run when the theme is activated
function classic_theme_enable_classic_widgets()
{
    update_option('use_widgets_block_editor', false);
}
add_action('after_switch_theme', 'classic_theme_enable_classic_widgets');

/**
 * Enable Classic Editor
 */
function classic_theme_enable_classic_editor()
{
    update_option('classic-editor-replace', 'classic');
    update_option('classic-editor-allow-users', 'disallow');
}
add_action('after_switch_theme', 'classic_theme_enable_classic_editor');

/**
 * Add body classes
 */
function classic_theme_body_classes($classes)
{
    // Add a class if we're on a single post
    if (is_single()) {
        $classes[] = 'single-post-view';
    }

    return $classes;
}
add_filter('body_class', 'classic_theme_body_classes');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function classic_theme_page_menu_args($args)
{
    $args['show_home'] = true;
    return $args;
}
add_filter('wp_page_menu_args', 'classic_theme_page_menu_args');

/**
 * Adds custom classes to the array of body classes.
 */
function classic_theme_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'classic_theme_pingback_header');

/**
 * Enqueue admin.css for admin pages only
 */
function classic_theme_admin_styles()
{
    // Get the CSS file path
    $admin_css = get_template_directory_uri() . '/admin-enhancements/css/admin.css';

    // Enqueue the admin CSS file
    wp_enqueue_style(
        'classic-theme-admin-styles',
        $admin_css,
        array(),
        filemtime(get_template_directory() . '/admin-enhancements/css/admin.css'),
        'all'
    );
}
// Hook into admin_enqueue_scripts which only fires on admin pages
add_action('admin_enqueue_scripts', 'classic_theme_admin_styles');

/**
 * Enqueue login.css for the login page only
 */
function classic_theme_login_styles()
{
    // Get the CSS file path
    $login_css = get_template_directory_uri() . '/admin-enhancements/css/login.css';

    // Enqueue the login CSS file
    wp_enqueue_style(
        'classic-theme-login-styles',
        $login_css,
        array(),
        filemtime(get_template_directory() . '/admin-enhancements/css/login.css'),
        'all'
    );
}
// Hook into login_enqueue_scripts which only fires on the login page
add_action('login_enqueue_scripts', 'classic_theme_login_styles');

remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); //removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action('wp_head', 'feed_links', 2); //removes feed links.
remove_action('wp_head', 'feed_links_extra', 3);  //removes comments feed. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Removes prev and next links