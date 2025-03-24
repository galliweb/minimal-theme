<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/includes/admin-enhancements.php';
require_once get_template_directory() . '/includes/remove-comments.php';
require_once get_template_directory() . '/includes/remove-dashboard-widgets.php';
require_once get_template_directory() . '/includes/remove-wordpress-defaults.php';
require_once get_template_directory() . '/includes/login-tweaks.php';

require_once get_template_directory() . '/includes/theme-setup.php';
require_once get_template_directory() . '/includes/editor-config.php';
require_once get_template_directory() . '/includes/helpers.php';

// Main Stylesheet and Script File
add_action('wp_enqueue_scripts', function() {
    $manifestPath = get_theme_file_path('dist/.vite/manifest.json');
    
    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
        
        if (isset($manifest['src/scripts/main.js'])) {
            // Main JS
            wp_enqueue_script(
                'fastpage',
                get_theme_file_uri('dist/' . $manifest['src/scripts/main.js']['file']),
                array(), 
                null,    
                true     
            );
            // Main CSS
            if (isset($manifest['src/scripts/main.js']['css']) && !empty($manifest['src/scripts/main.js']['css'])) {
                wp_enqueue_style(
                    'fastpage',
                    get_theme_file_uri('dist/' . $manifest['src/scripts/main.js']['css'][0]),
                    array(), 
                    null     
                );
            }
        }
    }
});

// Admin and Login Stylesheet
function fastpage_admin_enqueue() {
    $manifestPath = get_theme_file_path('dist/.vite/manifest.json');
    
    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
        
        if (isset($manifest['src/styles/admin.scss'])) {
            wp_enqueue_style(
                'fastpage-admin',
                get_theme_file_uri('dist/' . $manifest['src/styles/admin.scss']['file']),
                array(),
                null     
            );
        }
    }
}

add_action('admin_enqueue_scripts', 'fastpage_admin_enqueue');
add_action('login_enqueue_scripts', 'fastpage_admin_enqueue');