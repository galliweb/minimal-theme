<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

        <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Zum Inhalt springen', 'starter-theme'); ?></a>

        <header class="main-header">
            <div class="wrapper">
                <?php get_template_part('template-parts/site-branding'); ?>
                <?php get_template_part('template-parts/nav'); ?>
            </div>
        </header>

 <div id="content" class="site-content">