<nav class="navigation">
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_class'     => 'navigation__list',
            'container'      => false,
            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
            'walker'         => new Custom_Nav_Walker(),
        )
    );
    ?>
</nav>