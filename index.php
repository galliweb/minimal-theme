<?php
/**
 * The main template file
 */

get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <?php
            if (have_posts()) :

                if (is_home() && !is_front_page()) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;

                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

                            <?php if ('post' === get_post_type()) : ?>
                                <div class="entry-meta">
                                    <?php
                                    echo '<span class="posted-on">' . esc_html__('Posted on', 'classic-theme') . ' ' . get_the_date() . '</span>';
                                    echo '<span class="byline"> ' . esc_html__('by', 'classic-theme') . ' ' . get_the_author() . '</span>';
                                    ?>
                                </div><!-- .entry-meta -->
                            <?php endif; ?>
                        </header><!-- .entry-header -->

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More', 'classic-theme'); ?></a>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                    <?php

                endwhile;

                the_posts_navigation(array(
                    'prev_text' => '&larr; ' . esc_html__('Older posts', 'classic-theme'),
                    'next_text' => esc_html__('Newer posts', 'classic-theme') . ' &rarr;',
                ));

            else :
                ?>
                <div class="no-results">
                    <h1 class="page-title"><?php esc_html_e('Nothing Found', 'classic-theme'); ?></h1>
                    <div class="page-content">
                        <?php
                        if (is_home() && current_user_can('publish_posts')) :
                            printf(
                                '<p>' . wp_kses(
                                    /* translators: 1: link to WP admin new post page. */
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'classic-theme'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ) . '</p>',
                                esc_url(admin_url('post-new.php'))
                            );
                        else :
                            ?>
                            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'classic-theme'); ?></p>
                            <?php
                        endif;
                        ?>
                    </div><!-- .page-content -->
                </div><!-- .no-results -->
                <?php
            endif;
            ?>
        </div><!-- .container -->
    </main><!-- #main -->

<?php
get_footer();