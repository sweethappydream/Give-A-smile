<?php
/**
 * Template part for displaying a single partner in the Our Partners block.
 *
 * @package unik
 */

$partner = get_queried_object();
$partnerImgId = get_field('partner_logo', 'partners_' . $partner->term_id);
$partnerName = $partner->name;
$partnerLink = get_term_link($partner->term_id, 'partners');
?>

<li class="our-partners__partner">
    <div class="our-partners__img">
        <?php if ($partnerImgId): ?>
            <img src="<?= wp_get_attachment_image_url($partnerImgId, 'full') ?>" alt="<?= $partnerName ?>" loading="lazy" width="170">
        <?php endif; ?>
    </div>

    <?php if ($partnerName): ?>
        <div class="our-partners__title"><?= $partnerName ?></div>
    <?php endif; ?>

    
</li>
