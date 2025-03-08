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
require_once get_template_directory() . '/includes/admin-enhancements.php';
require_once get_template_directory() . '/includes/remove-comments.php';
require_once get_template_directory() . '/includes/remove-dashboard-widgets.php';
require_once get_template_directory() . '/includes/remove-wordpress-defaults.php';
require_once get_template_directory() . '/includes/helpers/accessible-walker-nav-menu.php';
require_once get_template_directory() . '/includes/helpers/login-tweaks.php';

/**
 * Include core theme files
 */
require_once get_template_directory() . '/includes/theme-setup.php';
require_once get_template_directory() . '/includes/enqueue-css-js.php';
require_once get_template_directory() . '/includes/editor-config.php';
require_once get_template_directory() . '/includes/helpers.php';
