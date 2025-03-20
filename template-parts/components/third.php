<?php
/**
 * Third Layout Component
 */

// Get field values
$titel1 = get_sub_field('titel1');
$titel2 = get_sub_field('titel2');
$titel3 = get_sub_field('titel3');
?>

<section class="component third-layout">
  <div class="container">
    <div class="component-content third">
      <?php if ($titel1) : ?>
        <p class="component-text titel1">
          <?php echo $titel1; ?>
        </p>
      <?php endif; ?>
      
      <?php if ($titel2) : ?>
        <p class="component-text titel2">
          <?php echo $titel2; ?>
        </p>
      <?php endif; ?>
      
      <?php if ($titel3) : ?>
        <p class="component-text titel3">
          <?php echo $titel3; ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>