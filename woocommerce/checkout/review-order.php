<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>

<div>
    <div class="c-add-smile">
        <div class="c-add-smile__text"><?php _e('If You’re Satisfied and Want to Show It, Add a Tip for the Smile Association', THEME_TD); ?></div>
        <div class="c-add-smile__img">
            <img class="is-img" src="<?php echo get_template_directory_uri(); ?>/assets/icon/smile.svg"
                 alt="">
        </div>
        <div class="c-add-smile__plus" data-modal="#add-tip">
            <span><?php _e('To Add Tip', THEME_TD); ?></span>
            +
        </div>
    </div>
	
    <div class="l-checkout__total">

        <div class="c-info">
            <span>?</span>
            <div class="c-info__box">
                <p class="c-info__title"><?php _e('What is goal in supporting Smile?', THEME_TD); ?></p>
                <p><?php _e('The SUMIT Payments Gateway is a simple and powerful checkout solution.', THEME_TD); ?></p>
            </div>
        </div>
        <div class="l-checkout__total-head">
            <div class="l-checkout__total-head__left">
                <span class="is-name"><?php _e('Name of Gift', THEME_TD); ?></span>
            </div>
            <div class="l-checkout__total-head__right">
                <span class="is-quantity"><?php _e('Quantity', THEME_TD); ?></span>
                <span class="c-price"><?php _e('Price', THEME_TD); ?></span>
            </div>
        </div>

        <div class="l-checkout__total-body">
            <?php


            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                $type = get_fields($cart_item['product_id']);
                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key) && $type['product_type'] !== 'tip') :
                    ?>
                    <div class="l-checkout__total-body__left">
                        <p>
                            <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
                            <?php if ($type['product_type'] == 'tip' && $_product->get_price() == 0): ?>
                                <span class="js-add-tip"><?php _e('Add', THEME_TD); ?></span>
                                <span class="js-add-tip-finish"><?php _e('Finish', THEME_TD); ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="l-checkout__total-body__right">
                                      <span class="is-quantity">
                                        <?php if ($type['product_type'] !== 'tip'): ?>
                                            <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); ?>
                                        <?php endif; ?>
                                      </span>
                        <?php if ($type['product_type'] !== 'tip'): ?>
                            <span class="c-price"><?php echo $_product->get_price_html(); ?></span>
                        <?php else: ?>
                            <div class="c-price">
                                <input
                                        type="number"
                                        class="is-add-tip-input"
                                        disabled
                                        placeholder="0"
                                        onkeypress="return event.charCode >= 48" min="1"
                                        value="<?php if ($type['product_type'] === 'tip'): echo $_product->get_price(); endif; ?>"
                                >
                                <span>₪</span>
                            </div>

                        <?php endif; ?>
                    </div>

                <?php endif;

            endforeach; ?>



            <?php if (WC()->cart->has_discount()): ?>
                <?php
                 $all_coupone = WC()->cart->get_applied_coupons();
                 $coupone_code = array_shift($all_coupone);
                 if($coupone_code){
                     $coupon_obj =  new WC_Coupon($coupone_code);
                     $coupon_obj_amaount =  $coupon_obj->get_amount();
                 }
                ?>
                <div id="coupon" class="product-tip l-checkout__total-body" data-coupon-amount="<?= ($coupon_obj_amaount) ? $coupon_obj_amaount : ''; ?>">
                    <div class="product-name l-checkout__total-body__left">
                        <?php _e('Magic Gift', THEME_TD); ?>
                    </div>
                    <div class="product-total l-checkout__total-body__right">

                        <?php
                        $coupon = WC()->cart->get_coupon_discount_totals();
                        $discount = array_shift($coupon);
                        ?>

                        <?php if ($discount): ?>
                            <span class="magic-discount">
                                <?= $discount . ' ' . get_woocommerce_currency_symbol(); ?>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
            <?php endif ?>
            <?php
            $tipProduct = wc_get_product(776);

            if (is_object($tipProduct)): ?>
                <div class="product-tip l-checkout__total-body">
                    <div class="product-name l-checkout__total-body__left">
                        <?php echo $tipProduct->get_name() ?>
                        <span class="tip-add show"><?php _e('ADD', 'woocommerce'); ?></span>
                        <span class="tip-finish"><?php _e('FINISH', 'woocommerce'); ?></span>
                        <span class="tip-error"><?php _e('Please enter a value greater than 0 or equal to 1.', 'woocommerce'); ?></span>
                    </div>
                    <div class="product-total l-checkout__total-body__right">
                        <input type="number" name="tip" value="0" readonly>
                        <?= get_woocommerce_currency_symbol() ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            //check if using smile card
            if (isset($_POST['gift']) && $_POST['gift'] && is_can_to_use_coupon($_POST['gift'])):
                $code = $_POST['gift'];
                $coupon = new WC_Coupon($code);
                WC()->cart->apply_coupon($code);
                ?>
                <div class="l-checkout__total-body__left">
                    <p><?= __('Magic Gift', THEME_TD); ?></p>
                </div>
                <div class="l-checkout__total-body__right">
                                      <span class="is-quantity">
                                      </span>
                    <span class="c-price">-<?php echo $coupon->get_amount() . ' ' . get_woocommerce_currency_symbol(); ?></span>

                </div>
            <?php endif; ?>
        </div>

        <div class="l-checkout__total-bottom">
			
			
            <span class="is-total"><?php _e('Total', THEME_TD); ?></span>
            <span class="c-price" data-attr-price="<?php echo WC()->cart->get_cart_contents_total(); ?>">
                      <?php echo WC()->cart->get_cart_total(); ?>
                    </span>
        </div>
		
		
    </div>
</div>


