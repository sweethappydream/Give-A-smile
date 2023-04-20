<?php

/**
 * My Account Magic tab
 */

defined('ABSPATH') || exit;

?>

<?php
$customer_orders = get_posts(
    apply_filters(
        'woocommerce_my_account_my_orders_query',
        array(
            'meta_key' => '_customer_user',
            'meta_value' => get_current_user_id(),
            'post_type' => wc_get_order_types('view-orders'),
            'post_status' => array('wc-completed'),
        )
    )
);
?>

<?php if ($customer_orders): ?>
    <h2 class="border-title"><span><?php _e('Used Magic GIFT', THEME_TD); ?></span></h2>
    <div class="orders-account-header orders-account-table">
        <div class="item price"><?php _e('Amount Donated', THEME_TD); ?></div>
        <div class="item name"><?php _e('Magic GIFT type', THEME_TD); ?></div>
        <div class="item empty"><?php _e('Ex. code', THEME_TD); ?></div>
        <div class="item date"><?php _e('Date', THEME_TD); ?></div>
        <div class="item empty"><?php _e('Greeting card', THEME_TD); ?></div>
    </div>

    <?php  $i = 1; foreach ($customer_orders as $item): ?>
        <?php
        $order = new WC_Order($item->ID);

        $products = $order->get_items();
        $date_order = get_the_date('d.m.y', $item->ID);
        ?>
        <?php if ($products): ?>

            <?php foreach ($products as $product): ?>
                <?php
                    $greeting_card = get_post_meta($item->ID, '_greeting_card', true);
                    $several_receivers_url = get_post_meta($item->ID, 'several_receivers_url', true);
                    $i++;
                ?>

                <div class="orders-account-table orders-account-item">
                    <div class="item price">
                        <?= '<span>' . $product->get_total() . '</span><span>' . get_woocommerce_currency_symbol() . '</span>'; ?>
                    </div>
                    <div class="item name">
                        <?= $product['name']; ?>
                    </div>
                    <div class="item id">
                        <span class="mobile-col"><?= _e('Ex. code:', THEME_TD); ?></span>
                        <?= $item->ID; ?>
                    </div>
                    <div class="item date">
                        <?= $date_order; ?>
                    </div>
                    <div class="item certificate magic-certificate">
                        <?php if ($several_receivers_url): ?>
                            <?php foreach ($several_receivers_url as $url): ?>
                                <?php ?>
                                <a class="show-certificate" data-fancybox="gallery-<?= $i; ?>" data-type="pdf"
                                   href="<?= $url; ?>">
                                    <?php _e('View  card'); ?>
                                </a>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <a class="show-certificate" data-fancybox href="<?= $greeting_card; ?>" data-type="pdf">
                                <?php _e('View  card'); ?>
                            </a>
                        <?php endif ?>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
    <?php endforeach; ?>
<?php else: ?>
    <h4 class="title-no-order"><?php _e('You haven\'t ordered anything yet', THEME_TD); ?></h4>
<?php endif ?>

