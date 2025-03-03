<?php

/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'minimal-classic'); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try going back to the home page?', 'minimal-classic'); ?></p>

            <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
                <?php esc_html_e('Return to Home', 'minimal-classic'); ?>
            </a>
        </div><!-- .page-content -->
    </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
