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
require_once get_template_directory() . '/inc/admin-enhancements.php';
require_once get_template_directory() . '/inc/remove-comments.php';
require_once get_template_directory() . '/inc/remove-dashboard-widgets.php';
require_once get_template_directory() . '/inc/remove-wordpress-defaults.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/helpers/login-tweaks.php';

/**
 * Include core theme files
 */
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/enqueue-css-js.php';
require_once get_template_directory() . '/inc/editor-config.php';
require_once get_template_directory() . '/inc/helpers.php';
