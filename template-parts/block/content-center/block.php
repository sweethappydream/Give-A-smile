<?php

/**
 * Block Name: Content Center
 * Description: Content Center
 * Icon: editor-aligncenter
 * Keywords: content center block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'content-center-block';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
?>
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> text-center">
    <div class="container">
        <?php the_field( 'content' ); ?>
    </div>
</section>
