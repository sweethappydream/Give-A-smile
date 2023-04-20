<?php

/**
 * Block Name: Content Image
 * Description: Content Image
 * Icon: align-pull-right
 * Keywords: content image block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'content-image';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
?>
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>">
    <div class="container">
        <h3 class="block-title"><?php the_field( 'title' ); ?></h3>
        <div class="flex-row">
            <div class="<?= $slug . '__content' ?> flex-col"><?php the_field( 'content' ); ?></div>
            <div class="<?= $slug . '__image' ?> flex-col">
                <?php $image = get_field( 'image' ); ?>
                <?php if ( $image ) : ?>
                    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
