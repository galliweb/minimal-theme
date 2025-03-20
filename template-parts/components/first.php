<?php
/**
 * First Layout Component
 */

// Get field values
$title = get_sub_field('title');
$description = get_sub_field('description');
?>

<section class="component first-layout">
  <div class="container">
    <?php if ($title) : ?>
      <h2 class="component-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    
    <div class="component-content">
      <?php if ($description) : ?>
        <div class="component-description">
          <?php echo $description; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>