<?php

/**
 * Block Name: Hero Event
 * Description: Hero Event Block
 * Icon: editor-ol
 * Keywords: custom hero event block
 * Supports: { "align":true, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'hero-event';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$fields = get_fields();
$bgImg = $fields['background_image'] ?? null;
$title = $fields['title'] ?? null;
$varod = $fields['varod'] ?? null;
$button_1 = $fields['button_1'] ?? null;
?>

<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>" style="background-image: url('<?php echo $bgImg ?: '' ?>');">
<span class="varod-span"><?php echo $varod; ?></span>
<h1><?php echo $title; ?></h1>
<?php if (is_array($button_1) && !empty($button_1)): ?>
    <a href="<?php echo $button_1['url']; ?>" role="button" aria-label="<?php echo $button_1['title']; ?>" class="button"><?php echo $button_1['title']; ?></a>
  <?php endif; ?>

</section>