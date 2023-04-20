<?php

/**
 * Block Name: Custom List
 * Description: Custom List
 * Icon: editor-ol
 * Keywords: custom list block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'custom-list';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>">
    <?php if ( have_rows( 'list' ) ) : ?>
        <?php while ( have_rows( 'list' ) ) : the_row(); ?>
            <div class="<?= $slug . '__item' ?>">
                <h3 class="<?= $slug . '__title' ?>"><?php the_sub_field( 'title' ); ?></h3>
                <div class="<?= $slug . '__content' ?>">
                    <?php the_sub_field( 'content' ); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>