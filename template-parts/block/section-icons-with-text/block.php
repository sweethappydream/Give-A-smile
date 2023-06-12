<?php
/**
 * Block Name: Section Block With Title and icons.
 * Description: Section Block With Title and icons with a button to cta. inculding darkmode.
 * Icon: database-export
 * Keywords: Section Block With Title and icons.
 * Supports: { "align":false, "anchor":true, "customBackgroundColor":true }
 *
 * @package your-theme
 *
 * @var array $block
 */

$slug = 'values-with-icons';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$headline = get_field('h2');
$items = get_field('values');
$button = get_field('button_with_values');
$mode = get_field('mode'); // Assuming 'mode' is the ACF field name
?>

<!-- Start Values Section -->
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="mx <?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">
<div class="container">
    <h2><?= $headline ?></h2>
    <ul class="<?= $slug . '__list' ?>">
        <?php if ($items): ?>
            <?php foreach ($items as $item): ?>
                <?php
                $image = $item['image'];
                $heading = $item['h3'];
                $paragraph = $item['p'];
                ?>
                <li class="<?= $slug . '__item' ?>">
                    <img class="iconcounter" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                    <h3><?= $heading ?></h3>
                    <p><?= $paragraph ?></p>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <?php if (is_array($button) && !empty($button)): ?>
            <button class="bt gift-li">
                <a href="<?= $button['url'] ?: '#' ?>" <?= $button['target'] ? 'target="_blank" rel="nofollow"' : '' ?>>
                    <?= $button['title'] ?>
                </a>
            </button>
        <?php endif; ?>
</div>
</section>
<!-- End Values section -->
