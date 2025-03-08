<?php
/**
 * Template part for displaying the main navigation
 */

// Make sure the custom walker class is available
if (!class_exists('Accessible_Walker_Nav_Menu')) {
    require_once get_template_directory() . '/inc/class-accessible-walker-nav-menu.php';
}
?>

<nav id="main-navigation" 
     class="main-navigation" 
     aria-label="<?php esc_attr_e('Main Navigation', 'minimal-theme'); ?>">
    <?php 
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'walker'         => new Accessible_Walker_Nav_Menu(),
        )
    );
    ?>
</nav>