<?php
/**
 * Block Name: Slider Love Us
 * Description:  Slider Love Us Slider with darkmode options.
 * Icon: database-export
 * Keywords:  Swiper Slider, LOVE US
 * Supports: { "align": false, "anchor": true, "customBackgroundColor": true }
 *
 * @package unik
 *
 * @var array $block
 */


$slug = 'slider-love-us';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$headline = get_field('h2_headline');
$paragraphs = get_field('paragrpah_headline');
$spanText = get_field('after_headline');
$items = get_field('quotes_slider');
$mode = get_field('mode');
?>
<!-- Start Slider Section -->
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">
    <div class="class-headline">
        <h2><?= $headline ?></h2>
        <span class="biggest"><?= $spanText ?></span>
        <p><?= $paragraphs ?></p>
    </div>
    <div class="class-slider-quotes">
        <div class="swiper-container" aria-label="Image Slider" role="region">
            <div class="swiper-wrapper">
                <?php if ($items): ?>
                    <?php foreach ($items as $item): ?>
                        <?php
                        $image = $item['image'];
                        $text = $item['text'];
                        ?>
                        <div class="swiper-slide">
                            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                            <p><?= $text ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
        <div class="swiper-nav">
                <div class="swiper-button-next" aria-label="Next Slide" data-next-slide-message="Next Slide"></div>
                <div class="swiper-button-prev" aria-label="Previous Slide" data-prev-slide-message="Previous Slide"></div>
            </div>
    </div>
</section>
<!-- End Slider Section -->