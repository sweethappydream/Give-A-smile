<?php

/**
 * Block Name: Event Form
 * Description: Event Form
 * Icon: edit-page
 * Keywords: contact form block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'event-form';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>">
    <div class="container">
        <h2 class="<?= $slug . '__title' ?>"><?php the_field( 'headline' ); ?></h2>
        <p class="<?= $slug . '__subtitle' ?>"><?php the_field( 'text_area' ); ?></p>
        <div class="container form">
        <div class="form-group">
        <?php the_field( 'form_shortcode' ); ?>
        </div>
        </div>
    </div>
</section>