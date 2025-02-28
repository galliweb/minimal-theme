<?php

/**
 * Third Layout Template Part
 */

// Get field values
$titel1 = get_sub_field('titel1');
$titel2 = get_sub_field('titel2');
$titel3 = get_sub_field('titel3');
?>

<div class="component thirdlayout">
  <div class="titles-container">
    <?php if ($titel1): ?>
      <h3 class="title-1"><?php echo esc_html($titel1); ?></h3>
    <?php endif; ?>

    <?php if ($titel2): ?>
      <h3 class="title-2"><?php echo esc_html($titel2); ?></h3>
    <?php endif; ?>

    <?php if ($titel3): ?>
      <h3 class="title-3"><?php echo esc_html($titel3); ?></h3>
    <?php endif; ?>
  </div>
</div>