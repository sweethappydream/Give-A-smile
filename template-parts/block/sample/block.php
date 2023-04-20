<?php
/**
* Block Name: Sample
* Description: Description
* Icon:
* Keywords: sample
* Supports: { "align":false, "anchor":true }
*
* @package unik
*
* @var array $block
*/

$slug = 'sample';

$simpleText = get_field('simple_text');
?>

<section class="<?= $slug ?>" style="height: 100vw"><h1><?= $simpleText ?: '' ?></h1></section>