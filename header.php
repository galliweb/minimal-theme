<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skiplink" href="#main-content">zum Inhalt springen</a>

<header class="main-header">
     <div class="wrapper row-between">
        <?php get_template_part('template-parts/theme/site-branding'); ?>
        <?php get_template_part('template-parts/theme/header-nav'); ?>
    </div>
</header>