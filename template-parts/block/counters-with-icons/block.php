<?php
/**
 * Block Name: Counters With Icons
 * Description: Counters With Icons
 * Icon: database-export
 * Keywords: counters numbers block with icons
 * Supports: { "align":false, "anchor":true, "customBackgroundColor":true } // Added "customBackgroundColor" support
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'counter-block-with-icons';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$giftLink = get_field('magic_gift_link');
$headlinecounters = get_field('headline-area');

$mode = get_field('mode'); // Assuming 'mode' is the ACF field name

if (have_rows('counters')):
    ?>
    <!--Start Counters Section-->
    <section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> <?= $mode ? 'dark-mode' : '' ?>">
    <div class="container">
        <h2 class="headline-counters">
            <?= $headlinecounters ?>
        </h2>
        <ul class="<?= $slug . '__row' ?>" aria-label="summaries" style="list-style:none;">
            <?php while (have_rows('counters')): the_row();
                $text = get_sub_field('text');
                $currency = null;
                $sign = null;

                switch (get_row_layout()) {
                    case 'projects_counter':
                        $number = '20';
                        break;
                    case 'money_counter':
                        $number = smile_woo_get_total_sales();
                        $currency = get_woocommerce_currency_symbol();
                        $sign = '+';
                        break;
                    case 'orders_counter':
                        $number = smile_woo_get_total_orders();
                        break;
                    default:
                        $number = get_sub_field('number');
                }

                if ($number || $number === 0):
                    $image_counters = get_sub_field('icon');
                    ?>
                    <li class="<?= $slug . '__counter' ?>">
                        <img class="iconcounter" src="<?= $image_counters['url']; ?>" alt="<?= $image_counters['alt']; ?>">
                        <div class="<?= $slug . '__number' ?>">
                            <?= $sign ?>
                            <span class="function-counter" data-speed="300" data-value="<?= $number ?>">0</span>
                            <?= $currency ? '<span class="' . $slug . '__currency">' . $currency . '</span>' : '' ?>
                        </div>
                        <?= $text ? '<p class="' . $slug . '__text">' . $text . '</p>' : '' ?>
                    </li>
                <?php
                endif;
            endwhile; ?>
        </ul>
        <?php if (is_array($giftLink) && !empty($giftLink)): ?>
            <button class="bt gift-li" aria-label="<?= $giftLink['title'] ?>">
                <a href="<?= $giftLink['url'] ?: '#' ?>" <?= $giftLink['target'] ? 'target="_blank" rel="nofollow"' : '' ?>>
                    <?= $giftLink['title'] ?>
                </a>
            </button>
        <?php endif; ?>
    </div>
    </section>
    <!--End Counters Section-->
<?php endif; ?>