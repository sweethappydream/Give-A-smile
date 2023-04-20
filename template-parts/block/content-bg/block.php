<?php
/**
 * Block Name: Content with Background
 * Description: Content with background image.
 * Icon: format-image
 * Keywords: content background image block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'content-background-block';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

$fields = get_fields();

$content = $fields['content'] ?? null;
$btn = $fields['button'] ?? null;
$bgImg = $fields['background_image'] ?? null;
$mobBgImg = $fields['mobile_background_image'] ?? null;

if ($content || $btn):
    ?>

    <section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>"
                                                            style="background-image: url('<?= $bgImg ?: '' ?>');">
        <div class="<?= $slug . '__mob-bg' ?> sm-show" style="background-image:url('<?= $mobBgImg ?>');"></div>

        <div class="container">
            <div class="<?= $slug . '__container' ?>">
                <?= $content ? '<div class="' . $slug . '__content">' . $content . '</div>' : '' ?>

                <?php if (is_array($btn) && !empty($btn)): ?>
                    <a href="<?= $btn['url'] ?: '#' ?>" class="<?= $slug . '__btn' ?> btn"
                        <?= $btn['target'] ? 'target="_blank" rel="nofollow"' : '' ?>
                    >
                        <?= $btn['title'] ?: '' ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.container -->
    </section>

<?php endif;