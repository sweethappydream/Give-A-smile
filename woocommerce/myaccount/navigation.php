<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation">

    <ul class="desktop">
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mobile">

        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <?php $classes = explode(' ', wc_get_account_menu_item_classes($endpoint)) ?>
            <?php if (array_search('is-active', $classes) !== false): ?>
                <div class="active-tab">
                    <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?> <?php display_svg(get_template_directory_uri() . '/assets/icon/arrow-down.svg'); ?></a>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <div class="other">
            <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>

                <?php $classes = explode(' ', wc_get_account_menu_item_classes($endpoint)) ?>
                <?php if (!array_search('is-active', $classes)): ?>

                    <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>
