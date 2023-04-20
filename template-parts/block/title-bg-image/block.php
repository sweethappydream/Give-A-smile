<?php
/**
 * Block Name: Title with Background Image
 * Description: Title with background image.
 * Icon: format-image
 * Keywords: title background image block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'title-bg-image';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

$fields = get_fields();

$title = $fields['title'] ?? null;
$bgImg = $fields['background_image'] ?? null;
$mobBgImg = $fields['mobile_background_image'] ?? null;
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>" style="background-image: url('<?= $bgImg ?: '' ?>');">
    <div class="<?= $slug . '__mob-bg' ?> sm-show" style="background-image:url('<?= $mobBgImg ?>');"></div>
    <div class="container">
        <h1><?= $title ?: '' ?></h1>
    </div>
</section>