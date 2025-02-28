<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

    <main id="primary" class="site-main">
        <div class="container">
            <?php
            while (have_posts()) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                        <div class="entry-meta">
                            <?php
                            echo '<span class="posted-on">' . esc_html__('Posted on', 'classic-theme') . ' ' . get_the_date() . '</span>';
                            echo '<span class="byline"> ' . esc_html__('by', 'classic-theme') . ' ' . get_the_author() . '</span>';
                            
                            $categories_list = get_the_category_list(', ');
                            if ($categories_list) {
                                echo '<span class="cat-links"> ' . esc_html__('in', 'classic-theme') . ' ' . $categories_list . '</span>';
                            }
                            ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'classic-theme'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post(get_the_title())
                            )
                        );

                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'classic-theme'),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php
                        $tags_list = get_the_tag_list('', ', ');
                        if ($tags_list) {
                            echo '<div class="tags-links">' . esc_html__('Tagged:', 'classic-theme') . ' ' . $tags_list . '</div>';
                        }
                        ?>
                        
                        <div class="post-navigation-container">
                            <?php
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'classic-theme') . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'classic-theme') . '</span> <span class="nav-title">%title</span>',
                                )
                            );
                            ?>
                        </div>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            endwhile; // End of the loop.
            ?>
        </div><!-- .container -->
    </main><!-- #main -->

<?php
get_footer();