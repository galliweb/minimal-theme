<?php

/**
 * Second Layout Template Part
 */

// Get field values
$image_id = get_sub_field('bild');
$bildbeschriftung = get_sub_field('bildtext');

?>

<div class="component secondlayout">
  <?php if ($image_id): ?>
    <div class="image-container">
      <?php echo wp_get_attachment_image($image_id, 'large'); ?>
    </div>
    <?php if ($bildbeschriftung): ?>
      <h3 class="title-1"><?php echo esc_html($bildbeschriftung); ?></h3>
    <?php endif; ?>
  <?php endif; ?>
</div>