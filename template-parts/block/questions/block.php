<?php

/**
 * Block Name: Questions
 * Description: Questions
 * Icon: editor-justify
 * Keywords: questions block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'questions';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$headline = get_field('h2');
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>" role="region" aria-multiselectable="true">
    <div class="container">
    <?php if (is_array($headline) && !empty($headline)): ?>
    <h2><?= $headline ?></h2>
    <?php endif; ?>
        <?php if ( have_rows( 'list' ) ) : ?>
        <ul class="<?= $slug . '__tabs' ?>" style="list-style:none;">
            <?php $index = 0; ?>
            <?php while ( have_rows( 'list' ) ) : the_row(); ?>
            <li class="<?= $slug . '__item' ?>" role="presentation">
                <div class="<?= $slug . '__title' ?>" role="button" aria-controls="<?= $slug . '__content-' . $index ?>" aria-expanded="false">
                    <h3><?php the_sub_field( 'title' ); ?></h3>
                </div>
                <div id="<?= $slug . '__content-' . $index ?>" class="<?= $slug . '__content' ?>" role="region" aria-hidden="true">
                    <div>
                        <p><?php the_sub_field( 'descriptions' ); ?></p>
                    </div>
                </div>
        </li>
            <?php $index++; ?>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </div>
</section>
<script>
  (function() {
    var accordionItems = document.querySelectorAll('.<?= $slug . '__item' ?>');
    
    accordionItems.forEach(function(item) {
      var title = item.querySelector('.<?= $slug . '__title' ?>');
      var content = item.querySelector('.<?= $slug . '__content' ?>');
      
      title.addEventListener('click', function() {
        var expanded = title.getAttribute('aria-expanded') === 'true';
        
        title.setAttribute('aria-expanded', !expanded);
        content.setAttribute('aria-hidden', expanded);
      });
      
      title.addEventListener('keydown', function(event) {
        if (event.keyCode === 13 || event.keyCode === 32) { // Enter or Space key
          event.preventDefault();
          title.click();
        }
      });
    });
  })();
</script>


