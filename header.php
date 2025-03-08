<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    // Check if ACF plugin is active
    if (function_exists('get_field')) {
        // Get the value of the abwesenheitsnews button group
        $abwesenheitsnews = get_field('abwesenheitsnews', 'option');

        // Get the news content
        $news_content = get_field('news', 'option');

        // Check if news should be displayed (abwesenheitsnews set to "anzeigen" and news content exists)
        if ($abwesenheitsnews === 'anzeigen' && !empty($news_content)) {
    ?>
            <div class="top-header" style="background-color: #000000; color: #ffffff; padding: 10px 0;">
                <div class="container">
                    <div class="top-header-content">
                        <?php echo wp_kses_post($news_content); ?>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'classic-theme'); ?></a>

        <header id="masthead" class="site-header">
            <div class="container">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                    ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        $classic_theme_description = get_bloginfo('description', 'display');
                        if ($classic_theme_description || is_customize_preview()) :
                        ?>
                            <p class="site-description"><?php echo $classic_theme_description; ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div><!-- .site-branding -->
                            <?php
/**
 * Navigation template for WordPress using Harvard Web Publishing (HWP) style
 */
?>
<nav class="hwp-main-menu" aria-label="<?php esc_attr_e('Main', 'classic-theme'); ?>">
  <div class="hwp-main-menu__container">
    <?php
    // Custom walker to generate the HWP-style menu structure
    class HWP_Menu_Walker extends Walker_Nav_Menu {
        public function start_lvl(&$output, $depth = 0, $args = null) {
            $output .= '<ul class="hwp-main-menu__list-submenu" tabindex="-1">';
        }
        
        public function end_lvl(&$output, $depth = 0, $args = null) {
            $output .= '</ul>';
        }
        
        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            
            // Check if item has children
            $has_children = in_array('menu-item-has-children', $classes);
            
            // Add HWP-specific classes
            $class_names = 'hwp-main-menu__item';
            if ($has_children) {
                $class_names .= ' hwp-main-menu__item--has-submenu';
            }
            
            // Start the menu item
            $output .= '<li class="' . esc_attr($class_names) . '">';
            
            // For items with children at top level, wrap link in a div
            if ($has_children && $depth === 0) {
                $output .= '<div data-level="' . esc_attr($depth) . '" class="hwp-expanded-item--wrapper">';
            }
            
            // Add the menu link
            $atts = array();
            $atts['href'] = !empty($item->url) ? $item->url : '';
            $atts['class'] = 'hwp-main-menu__link';
            
            if (in_array('current-menu-item', $classes)) {
                $atts['class'] .= ' is-active';
                $atts['aria-current'] = 'page';
            }
            
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            $title = apply_filters('the_title', $item->title, $item->ID);
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            
            // Add dropdown toggle button for parent items
            if ($has_children) {
                $item_output .= '<button class="js-hwp-main-menu__submenu-trigger hwp-main-menu__submenu-trigger-icon" aria-expanded="false">';
                $item_output .= '<span class="hwp-visually-hidden">' . esc_html($title) . '</span>';
                $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="!hwp-block" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>';

                $item_output .= '</button>';
            }
            
            // Close the wrapper div for parent items at top level
            if ($has_children && $depth === 0) {
                $item_output .= '</div>';
            }
            
            $output .= $args->before . $item_output . $args->after;
        }
        
        public function end_el(&$output, $item, $depth = 0, $args = null) {
            $output .= '</li>';
        }
    }
    
    // Generate the menu
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'menu_class'     => 'hwp-main-menu__list',
            'fallback_cb'    => 'wp_page_menu',
            'walker'         => new HWP_Menu_Walker(),
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        )
    );
    ?>
  </div>
</nav>

<?php
// Mobile menu button code can be placed elsewhere in your header if needed
?>
<button class="js-header-site__menu-trigger hwp-header-site__menu-trigger" aria-expanded="false">
  <div>Menu</div>
</button>
            </div><!-- .container -->
        </header><!-- #masthead -->

        <div id="content" class="site-content">