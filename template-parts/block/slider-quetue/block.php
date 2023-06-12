<?php
/**
 * Block Name: Quotes Slider
 * Description: Quotes Slider with darkmode options.
 * Icon: database-export
 * Keywords:  Swiper Slider, quotes
 * Supports: { "align": false, "anchor": true, "customBackgroundColor": true }
 *
 * @package unik
 *
 * @var array $block
 */


$slug = 'quotes-slider';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$headline = get_field('h2');
$items = get_field('quotes_slider');
$button = get_field('quotes_slider_button');
$mode = get_field('mode');
?>
<!-- Start Slider Section -->
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="mx <?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">
<div class="container">
    <h2><?= $headline ?></h2>
    <div class="swiper-container quotes" aria-label="Image Slider" role="region">
        <div class="swiper-wrapper quotes">
            <?php if ($items): ?>
                <?php foreach ($items as $item): ?>
                    <?php
                    $image = $item['image'];
                    $quoteImage = $item['quote_image'];
                    $quoteText = $item['quote_text'];
                    ?>
                    <div class="swiper-slide quote" aria-label="<?= $quoteText ?>">
                        <img class="slider-image" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                        <div class="queue">
                            <img src="<?= $quoteImage['url'] ?>" alt="<?= $quoteImage['alt'] ?>">
                            <p><?= $quoteText ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="swiper-navig <?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">

            <div class="swiper-pagination" aria-label="Pagination" role="list"></div>
            <div class="swiper-buttons" role="navigation">
            <div class="swiper-button-next" aria-label="Next Slide" data-next-slide-message="Next Slide"></div>
            <div class="swiper-button-prev" aria-label="Previous Slide" data-prev-slide-message="Previous Slide"></div>
            </div>
        </div>
    </div>
    <?php if (is_array($button) && !empty($button)): ?>
            <a class="bt gift-li" href="<?= $button['url'] ?: '#' ?>" <?= $button['target'] ? 'target="_blank" rel="nofollow"' : '' ?>>
                <?= $button['title'] ?>
            </a>
    <?php endif; ?>
    </div>
</section>
<!-- End Slider Section -->