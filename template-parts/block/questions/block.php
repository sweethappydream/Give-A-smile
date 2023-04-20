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
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>">
    <div class="container">
        <?php if ( have_rows( 'list' ) ) : ?>
        <div class="<?= $slug . '__tabs' ?>">
            <?php while ( have_rows( 'list' ) ) : the_row(); ?>
            <div class="<?= $slug . '__item' ?>">
                <div class="<?= $slug . '__title' ?>">
                    <h3><?php the_sub_field( 'title' ); ?></h3>
                </div>
                <div class="<?= $slug . '__content' ?>">
                    <div>
                        <p><?php the_sub_field( 'descriptions' ); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
