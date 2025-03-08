<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'classic-theme'); ?></a>

        <header id="masthead" class="">
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
                <!-- #site-navigation -->
                <?php get_template_part('template-parts/nav'); ?>

            </div><!-- .container -->
        </header><!-- #masthead -->
        <div id="content" class="site-content">