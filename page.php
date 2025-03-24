<?php get_header(); ?>

<main id="main-content" class="main-content wrapper">
  <?php 
  if (have_posts()) :
    while (have_posts()) : the_post();
      
      // Get the flexible content field
      if (have_rows('components')) :
        // Loop through the components
        while (have_rows('components')) : the_row();
          
          // Get the layout name/type
          $layout = get_row_layout();
          
          // Map layout names to file names
          $template_file = '';
          
          if ($layout === 'firstlayout') {
            $template_file = 'first';
          } elseif ($layout === 'secondlayout') {
            $template_file = 'second';
          } elseif ($layout === 'thirdlayout') {
            $template_file = 'third';
          }
          
          // Include the appropriate component template if mapping exists
          if ($template_file) {
            get_template_part('template-parts/components/' . $template_file);
          }
          
        endwhile;
      endif;
      
    endwhile;
  endif;
  ?>
</main>

<?php get_footer(); ?>