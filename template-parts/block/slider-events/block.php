<?php
/**
 * Block Name: Slider Recet Event
 * Description:  Slider Recet Even Slider with darkmode options.
 * Icon: database-export
 * Keywords:  Swiper Slider, Slider Recet Event
 * Supports: { "align": true, "anchor": true, "customBackgroundColor": true }
 *
 * @package unik
 *
 * @var array $block
 */


$slug = 'slider-event';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$headline = get_field('h2_headline');
$items = get_field('event_slider');
$mode = get_field('mode');
?>
<!-- Start Slider Section -->
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">
        <h2><?= $headline ?></h2>
        <div class="swiper-container" aria-label="Image Slider" role="region">
            <ul class="swiper-wrapper events">
                <?php if ($items): ?>
                    <?php foreach ($items as $item): ?>
                        <?php
                        $image = $item['$bgImg'];
                        $text = $item['text'];


                        ?>
                        <li class="swiper-slide">
                            <div class="bg-swiper-container" style="background-image: url('<?php echo $bgImg ?: '' ?>')">
                            <p class="swiper-love-us"><?= $text ?></p>
                            </div>
                            <h3 class="swiper-love-us"><?= $text ?></h3>
                            <p class="swiper-love-us"><?= $text ?></p>
                            
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                    </ul>

        </div>
        <div class="swiper-nav">
                <div class="swiper-button-next" aria-label="Next Slide" data-next-slide-message="Next Slide"></div>
                <div class="swiper-button-prev" aria-label="Previous Slide" data-prev-slide-message="Previous Slide"></div>
            </div>
    </div>
</section>
<!-- End Slider Section -->