<?php

/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

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

<?php $i = 1; if ($customer_orders) : ?>
    <h2 class="border-title"><span><?php _e('Gift I Bought', THEME_TD); ?></span></h2>
    <div class="orders-account-header orders-account-table">
        <div class="item empty "></div>
        <div class="item date"><?php _e('Date', THEME_TD); ?></div>
        <div class="item name"><?php _e('Gift I Purchased', THEME_TD); ?></div>
        <div class="item qty"><?php _e('Amount', THEME_TD); ?></div>
        <div class="item price"><?php _e('Amount Donated', THEME_TD); ?></div>
    </div>

    <?php foreach ($customer_orders as $item) : ?>
        <?php
        $order = new WC_Order($item->ID);
        $order_id = $order->get_id();
        $greeting_card = get_post_meta($order_id, '_greeting_card',true);

        $several_receivers_url = get_post_meta($order_id, 'several_receivers_url',true);

        $products = $order->get_items();
        $date_order = get_the_date('d.m.y', $item->ID);
        ?>
        <?php if ($products) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="orders-account-table orders-account-item ">
                    <div class="item certificate">
                        <?php if($several_receivers_url):?>
                            <?php foreach ($several_receivers_url as $url): ?>
                                <a data-fancybox="gallery-<?= $i; ?>" data-type="pdf" href="<?= $url; ?>">
                                  <?php display_svg( $url ); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a data-fancybox data-type="pdf" href="<?= $greeting_card; ?>">
                                <?php display_svg( $greeting_card ); ?>
                            </a>
                        <?php endif?>
                    </div>
                    <div class="item date order-date">
                        <?= $date_order; ?>
                    </div>
                    <div class="item name order-name">
                        <?= $product['name']; ?>
                    </div>
                    <div class="item qty order-qty">
                        <?= 'X' . $product->get_quantity(); ?>
                    </div>
                    <div class="item price order-price">
                        <?= '<span>' . $product->get_total() . '</span><span>' . get_woocommerce_currency_symbol() . '</span>'; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif ?>

    <?php $i++; endforeach; ?>
<?php else : ?>
    <h4 class="title-no-order"><?php _e('You haven/t order any gift yet, you can choose one here', THEME_TD); ?></h4>
<?php endif ?>