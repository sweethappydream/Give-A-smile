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
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48" class="done-all-svg"><path d="M294-242 70-466l43-43 181 181 43 43-43 43Zm170 0L240-466l43-43 181 181 384-384 43 43-427 427Zm0-170-43-43 257-257 43 43-257 257Z"/></svg>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="swiper-navig <?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">
            <div class="swiper-navig-container">
                <div class="swiper-pagination" aria-label="Pagination" role="list"></div>
                <div class="swiper-buttons" role="navigation">
                    <div class="swiper-button-prev" aria-label="Previous Slide" data-prev-slide-message="Previous Slide">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M480-160 160-480l320-320 42 42-248 248h526v60H274l248 248-42 42Z"/></svg>
                    </div>
                    <div class="swiper-button-next" aria-label="Next Slide" data-next-slide-message="Next Slide">
                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="m480-160-42-43 247-247H160v-60h525L438-757l42-43 320 320-320 320Z"/></svg>
                    </div>
                </div>
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