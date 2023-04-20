<?php
/**
 * Block Name: Counters
 * Description: Counters
 * Icon: database-export
 * Keywords: counters numbers block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'counter-block';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

$giftLink = get_field('magic_gift_link');

if (have_rows('counters')):
    ?>

    <section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?>">
        <div class="container counter flex-colm">
            <ul class="<?= $slug . '__row' ?>" role="list" aria-label="summaries">

                <?php while (have_rows('counters')): the_row();
                    $text = get_sub_field('text');
                    $currency = null;

                    switch (get_row_layout()) {
                        case 'projects_counter':
                            $number = '20';
                            break;

                        case 'money_counter':
                            $number = smile_woo_get_total_sales();
                            $currency = get_woocommerce_currency_symbol();
                            break;

                        case 'orders_counter':
                            $number = smile_woo_get_total_orders();
                            break;

                        default:
                            $number = get_sub_field('number');
                    }

                    if ($number || $number === 0):
                        ?>

                        <div class="<?= $slug . '__counter' ?>" role="listitem">
                            <div class="<?= $slug . '__number' ?>">
                                <?= $currency ? '<span class="' . $slug . '__currency">' . $currency . '</span>' : '' ?>

                                <span class="function-counter" data-speed="300" data-value="<?= $number ?>">0</span>
                            </div>

                            <?= $text ? '<div class="' . $slug . '__text">' . $text . '</div>' : '' ?>
                        </div>

                    <?php
                    endif;
                endwhile; ?>

            </ul>
        </div>
        <!-- /.container -->
    </section>

<?php endif; ?>

 <?php if (is_array($giftLink) && !empty($giftLink)): ?>
 	<div class="inner-gift-link sm-show">
        <div class="container">
            <a href="<?= $giftLink['url'] ?: '#' ?>" class="inner-gift-link__link"
                <?= $giftLink['target'] ? 'target="_blank" rel="nofollow"' : '' ?>>
                <?= $giftLink['title'] ?: '' ?>
            </a>
        </div>
        <!-- /.container -->
    </div>
 <?php endif; ?>
