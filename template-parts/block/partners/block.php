<?php
/**
 * Block Name: Our Partners
 * Description: Partners slider.
 * Icon: admin-users
 * Keywords: partners block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'our-partners';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

$title = get_field('title');
$partners = get_terms([
    'taxonomy' => 'partners',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
]);

if (is_array($partners) && !empty($partners)): ?>

    <section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> ">
        <div class="container">
            <?= $title ? '<h2 class="' . $slug . '__header">' . $title . '</h2>' : '' ?>

            <div class="<?= $slug . '__partners' ?> function-slider js-partners-slider swiper" data-type="partners">
                <div class="swiper-wrapper">
                    <?php foreach ($partners as $partner):
                        $partnerImgId = get_field('partner_logo', $partner);
                        $partnerName = $partner->name;
                        $partnerLink = get_term_link($partner);
                        ?>
                        <article class="<?= $slug . '__partner' ?> swiper-slide">
                            <div class="<?= $slug . '__img' ?>">
                                <?= $partnerImgId ? wp_get_attachment_image($partnerImgId, 'smile_400x400') : '' ?>
                            </div>

                            <?= $partnerName ? '<div class=" ' . $slug . '__title">' . $partnerName . '</div>' : '' ?>

                            <?php if ($partnerLink): ?>
                                <a href="<?= $partnerLink ?>" class="<?= $slug . '__link' ?>">
                                    <?php _e('Go to the partner page', THEME_TD); ?>
                                </a>
                            <?php endif; ?>
                        </article>
                        <!-- /.partner -->
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            
        </div>
        <!-- /.container -->
    </section>

<?php endif;