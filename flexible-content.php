<?php get_header(); ?>

<main id="main-content" class="site-main">
  <?php 
  if (have_posts()) :
    while (have_posts()) : the_post();
      
      // Get the flexible content field
      if (have_rows('components')) :
        // Loop through the components
        while (have_rows('components')) : the_row();
          
          // Get the layout name/type
          $layout = get_row_layout();
          
          // Include the appropriate component template
          get_template_part('template-parts/components/' . $layout);
          
        endwhile;
      endif;
      
    endwhile;
  endif;
  ?>
</main>

<?php get_footer(); ?>