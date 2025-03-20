    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-navigation-container">
                    <nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer Navigation', 'classic-theme'); ?>">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-navigation',
                                'menu_id'        => 'footer-menu',
                                'container'      => false,
                                'menu_class'     => 'footer-menu',
                                'depth'          => 1,
                                'fallback_cb'    => false,
                                'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="' . esc_attr__('Footer menu', 'classic-theme') . '">%3$s</ul>',
                            )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>