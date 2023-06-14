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
        <div class="swiper swiper-container" aria-label="Image Slider" role="region">
            <div class="swiper-wrapper quote">
                <?php if ($items): ?>
                    <?php foreach ($items as $item): ?>
                        <?php
                        $image = $item['image'];
                        $text = $item['text'];
                        ?>
                        <div class="swiper-slide">
                            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                            <p class="swiper-love-us"><?= $text ?></p>
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48" class="done-all-svg"><path d="M294-242 70-466l43-43 181 181 43 43-43 43Zm170 0L240-466l43-43 181 181 384-384 43 43-427 427Zm0-170-43-43 257-257 43 43-257 257Z"/></svg>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
        <div class="swiper-nav">
                <div class="swiper-button-prev" aria-label="Previous Slide" data-prev-slide-message="Previous Slide">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M440-160v-487L216-423l-56-57 320-320 320 320-56 57-224-224v487h-80Z"/></svg>
                </div>
                <div class="swiper-button-next" aria-label="Next Slide" data-next-slide-message="Next Slide">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M480-160 160-480l56-57 224 224v-487h80v487l224-224 56 57-320 320Z"/></svg>
                </div>
            </div>
    </div>
</section>
<!-- End Slider Section -->