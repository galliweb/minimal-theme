<?php

/**
 * First Layout Template Part
 */

// Get field values
$title = get_sub_field('title');
$description = get_sub_field('description');
?>

<div class="component firstlayout">
  <?php if ($title): ?>
    <h2><?php echo esc_html($title); ?></h2>
  <?php endif; ?>

  <?php if ($description): ?>
    <div class="description">
      <?php echo wp_kses_post($description); ?>
    </div>
  <?php endif; ?>
</div>