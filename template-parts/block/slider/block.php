<?php
/**
 * Block Name: Slider Block
 * Description: Block with slider
 * Icon: slides
 * Keywords: slider block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'slider-block';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

$slides = get_field('slides');

if (is_array($slides) && !empty($slides)): ?>

    <section <?= $blockId ? 'id="' . $blockId . '"' : '' ?>
            class="<?= $slug ?> <?= $blockClass ?: '' ?> function-slider js-banner-slider swiper"
            data-type="slider-block">
      <div class="swiper-wrapper">
        <?php foreach ($slides as $slide):
            $bgImg = $slide['background_image'];
            $content = $slide['slide_content'];
            $contentSubscribe = $slide['content_subscribe'];
            $btn = $slide['slide_button'];
            $img = $slide['slide_image'];
            $imgSubscribe = $slide['image_subscribe'];
            $mobileImg = $slide['mobile_background_image'];

            if ($bgImg || $content || $contentSubscribe || $btn || $img || $imgSubscribe || $mobileImg):
                ?>

                <div class="<?= $slug . '__bg' ?> swiper-slide" style="background-image:url('<?= $bgImg ?: '' ?>');">
                    <div class="container">
                        <div class="<?= $slug . '__row' ?>">
                            <?php if ($content || $contentSubscribe || $btn): ?>
                                <div class="<?= $slug . '__col' ?>">
                                    <?= $content ? '<div class="' . $slug . '__content">' . $content . '</div>' : '' ?>
                                    <?= $contentSubscribe ? '<div class="' . $slug . '__content-subscribe">' . $contentSubscribe . '</div>' : '' ?>

                                    <?php if (is_array($btn) && !empty($btn)): ?>
                                        <a href="<?= $btn['url'] ?: '#' ?>" class="<?= $slug . '__btn' ?> btn"
                                            <?= $btn['target'] ? 'target="_blank" rel="nofollow"' : '' ?>>
                                            <?= $btn['title'] ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <!-- /.col -->
                            <?php endif; ?>

                            <?php if ($img || $imgSubscribe): ?>
                                <div class="<?= $slug . '__col' ?>">
                                    <div class="<?= $slug . '__img-container' ?>">
                                        <?php if ($mobileImg): ?>
                                            <div class="<?= $slug . '__mob-img' ?> lg-show"
                                                 style="background-image: url('<?= $mobileImg ?>');"></div>
                                        <?php endif; ?>

                                        <?= $img ? '<div class="' . $slug . '__img">' . wp_get_attachment_image($img, 'smile_400x400') . '</div>' : '' ?>
                                        <?= $imgSubscribe ? '<h2 class="' . $slug . '__img-subscribe">' . $imgSubscribe . '</h2>' : '' ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container -->
                </div>

            <?php endif;
        endforeach; ?>

      </div>
      <div class="swiper-pagination"></div>
    </section>

<?php endif;