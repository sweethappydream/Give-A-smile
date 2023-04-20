<?php

/**
 * Block Name: Contact Form
 * Description: Contact Form
 * Icon: edit-page
 * Keywords: contact form block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'contact-form';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>">
    <div class="container">
        <h4 class="<?= $slug . '__title' ?>"><?php the_field( 'title' ); ?></h4>
        <p class="<?= $slug . '__subtitle' ?>"><?php the_field( 'subtitle' ); ?></p>
        <?php the_field( 'form_shortcode' ); ?>
    </div>
</section>