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