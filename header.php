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

                <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'classic-theme'); ?>">
                    <button class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="screen-reader-text"><?php esc_html_e('Menu', 'classic-theme'); ?></span>
                        <svg class="burger-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    <?php if (!wp_is_mobile()): ?>
                        <div class="desktop-menu-container">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'main-navigation',
                                    'menu_id'        => 'primary-menu',
                                    'container'      => false,
                                    'menu_class'     => 'menu',
                                    'fallback_cb'    => 'wp_page_menu',
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="' . esc_attr__('Primary menu', 'classic-theme') . '">%3$s</ul>',
                                )
                            );
                            ?>
                        </div>
                    <?php endif; ?>
                </nav><!-- #site-navigation -->
            </div><!-- .container -->
        </header><!-- #masthead -->

        <!-- Mobile Navigation -->
        <div id="mobile-navigation" class="mobile-nav-container" aria-hidden="true" tabindex="-1">
            <div class="mobile-nav-inner">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'mobile-navigation',
                        'menu_id'        => 'mobile-menu',
                        'container'      => 'nav',
                        'container_class' => 'mobile-navigation',
                        'menu_class'     => 'mobile-menu',
                        'depth'          => 3,
                        'fallback_cb'    => 'wp_page_menu',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="' . esc_attr__('Mobile menu', 'classic-theme') . '">%3$s</ul>',
                    )
                );
                ?>
                <button class="close-mobile-nav" aria-label="<?php esc_attr_e('Close menu', 'classic-theme'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>

        <div id="content" class="site-content">