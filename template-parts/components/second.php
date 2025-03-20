<?php
/**
 * Second Layout Component
 */

// Get field values
$image_id = get_sub_field('bild'); // Returns image ID
$image_caption = get_sub_field('bildtext'); // Image caption/text
?>

<section class="component second-layout">
  <div class="container">
    <?php if ($image_id) : 
      // Get the image data using the ID
      $image = wp_get_attachment_image(
        $image_id, 
        'large', 
        false, 
        array('class' => 'second-layout-image')
      );
    ?>
      <div class="component-image">
        <?php echo $image; ?>
        
        <?php if ($image_caption) : ?>
          <div class="component-caption">
            <?php echo $image_caption; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>