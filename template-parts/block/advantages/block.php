<?php

/**
 * Block Name: Advantages
 * Description: Advantages
 * Icon: screenoptions
 * Keywords: advantages block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'advantages-block';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
?>
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> text-center bg-gray">
    <div class="container">
        <h3 class="block-title"><?php the_field( 'title' ); ?></h3>
        <?php if ( have_rows( 'list' ) ) : ?>
        <div class="row <?= $slug . '__list' ?>">
            <?php while ( have_rows( 'list' ) ) : the_row(); ?>
            <div class="col col-3 <?= $slug . '__item' ?>">
                <?php $icon = get_sub_field( 'icon' ); ?>
                <?php if ( $icon ) : ?>
                    <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" />
                <?php endif; ?>
                <p><?php the_sub_field( 'title' ); ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <div class="<?= $slug . '__content' ?>"><?php the_field( 'content' ); ?></div>
        <div class="<?= $slug . '__btn' ?>">
            <?php $button_url = get_field( 'button_url' ); ?>
            <?php if ( $button_url ) : ?>
                <a href="<?php echo esc_url( $button_url['url'] ); ?>" class="btn"><?php the_field( 'button_title' ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
