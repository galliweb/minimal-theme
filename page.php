<?php

/**
 * The template for displaying all pages
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
                </header><!-- .entry-header -->

                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'classic-theme'),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <div class="main-content">
                    <?php
                    // Check if the flexible content field has rows of data
                    if (have_rows('components')):

                        // Loop through the rows of data
                        while (have_rows('components')): the_row();

                            // Get the current layout
                            $layout = get_row_layout();

                            // Include the layout file
                            get_template_part('template-parts/components/' . $layout);

                        endwhile;

                    endif;
                    ?>
                </div>

                <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer">
                        <?php
                        edit_post_link(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Edit <span class="screen-reader-text">%s</span>', 'classic-theme'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post(get_the_title())
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    </footer><!-- .entry-footer -->
                <?php endif; ?>
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        endwhile; // End of the loop.
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
