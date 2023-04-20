<?php
/**
 * Ajax handlers
 *
 */
if (wp_doing_ajax()) {
    add_action('wp_ajax_save_svg', 'save_svg_ajax_handler');
    add_action('wp_ajax_nopriv_save_svg', 'save_svg_ajax_handler');
}
function save_svg_ajax_handler()
{
    if (!empty($_POST['template'])) {
        $data = $_POST['template'];
        $uniqueId = md5(uniqid());
        $upload_dir = wp_upload_dir();
        $file = $upload_dir['basedir'] . '/greeting-cards/svg-' . $uniqueId . '.svg';
        $fileUrl = $upload_dir['baseurl'] . '/greeting-cards/svg-' . $uniqueId . '.svg';

        if (file_put_contents($file, stripslashes($data))) {
            echo $fileUrl;
        } else {
            echo "Failed to save file";
        }
    }
    wp_die();
}

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{
    global $woocommerce;

    WC()->cart->empty_cart( true );

    ob_start();
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['variation_id']));
    $quantity = absint($_POST['quantity']);
    $product_status = get_post_status($product_id);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);
        $items = $woocommerce->cart->get_cart();
        wc_setcookie('woocommerce_items_in_cart', count($items));
        wc_setcookie('woocommerce_cart_hash', md5(json_encode($items)));
        do_action('woocommerce_set_cart_cookies', true);

        define('WOOCOMMERCE_CHECKOUT', true);


        if (WC()->cart->needs_payment()) {
            $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
            WC()->payment_gateways()->set_current_gateway($available_gateways);
        } else {
            $available_gateways = array();
        }
        ?>
        <form
                name="checkout"
                method="post"
                class="checkout woocommerce-checkout l-checkout"
                action="<?php echo esc_url(wc_get_checkout_url()); ?>"
                enctype="multipart/form-data">

            <input type="hidden" name="lang" value="en">

            <div class="l-checkout__payment js-tab-payment">
                <h1 class="u-h2"><?php _e('Payment', THEME_TD); ?></h1>
                <p><?php _e('Payment Method?', THEME_TD); ?></p>

                <div class="c-tab">
                    <?php if (!empty($available_gateways)) { ?>
                        <div class="c-tab__nav">
                            <?php foreach ($available_gateways as $gateway) { ?>
                                <label
                                        for="payment_method_<?php echo esc_attr($gateway->id); ?>"
                                        class="c-tab__item <?php if ($gateway->chosen) echo 'is-active'; ?>"
                                        data-tab="#<?php echo $gateway->id; ?>">
                                    <input
                                            id="payment_method_<?php echo esc_attr($gateway->id); ?>"
                                            type="radio"
                                            class="u-radio"
                                            name="payment_method"
                                            value="<?php echo esc_attr($gateway->id); ?>"
                                            data-tab="#<?php echo $gateway->id; ?>"
                                            data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>"
                                        <?php checked($gateway->chosen, true); ?>
                                    />
                                    <?php echo $gateway->get_title(); ?>
                                </label>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <div class="c-tab__container">
                        <?php if (!empty($available_gateways)) { ?>
                            <?php foreach ($available_gateways as $gateway) { ?>
                                <div id="<?php echo $gateway->id; ?>"
                                     class="c-tab__content <?php if ($gateway->chosen) echo 'is-active'; ?>">
                                    <div class="l-checkout__payment-img">
                                        <?php echo $gateway->get_icon(); ?>
                                    </div>

                                    <div id="payment" class="woocommerce-checkout-payment">
                                        <ul class="wc_payment_methods payment_methods methods">
                                            <li class="wc_payment_method payment_method_<?php echo esc_attr($gateway->id); ?>">
                                                <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
                                                    <div class="payment_box payment_method_<?php echo esc_attr($gateway->id); ?>">
                                                        <?php $gateway->payment_fields(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>

                    <button
                            type="submit"
                            class="u-btn is-big is-pink"
                            id="place_order"
                            name="woocommerce_checkout_place_order">
                        <?php _e('Payment', THEME_TD); ?>
                    </button>

                    <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                </div>
            </div>

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
                            <span class="is-quantity"><?php _e('quantity', THEME_TD); ?></span>
                            <span class="c-price"><?php _e('Price', THEME_TD); ?></span>
                        </div>
                    </div>

                    <div class="l-checkout__total-body">
                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $type = get_fields($cart_item['product_id']);
                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) :
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
        </form>
        <?php
        wp_die();
    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors.
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),
        );

        wp_send_json($data);
    }
}

add_action('wp_ajax_wishlist', 'wishlist_handler');
add_action('wp_ajax_nopriv_wishlist', 'wishlist_handler');

function wishlist_handler()
{

    if (isset($_POST['id']) && $_POST['id']) {
        if (is_user_logged_in()) {

            $add = $_POST['add'];
            $user_id = get_current_user_id();
            $arr_wish = get_user_meta($user_id, 'wish_list', true);

            // add element
            if ($add === 'true') {
                if ($arr_wish && is_array($arr_wish)) {
                    $arr_wish[] = $_POST['id'];
                    update_user_meta($user_id, 'wish_list', $arr_wish);
                } else {
                    update_user_meta($user_id, 'wish_list', array($_POST['id']));
                }
            } else {
                update_user_meta($user_id, 'wish_list', array_diff($arr_wish, [$_POST['id']]));
            }


        } else {
            die;
        }

    }
    die;
}

add_action('wp_ajax_check_giftcard', 'check_giftcard');
add_action('wp_ajax_nopriv_check_giftcard', 'check_giftcard');

function check_giftcard()
{
    global $woocommerce;
    if (isset($_POST['giftcard_id']) && !empty($_POST['giftcard_id'])) {
        $coupon_code = sanitize_text_field($_POST['giftcard_id']);
        $c = new WC_Coupon($coupon_code);
        $amount = $c->get_amount();

        if (is_can_to_use_coupon($coupon_code)) {
            echo $amount;
        } else {
            return false;
        }

    }
    wp_die();
}

add_action('wp_ajax_update_cart_quantity', 'smile_update_product_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'smile_update_product_quantity');
function smile_update_product_quantity()
{
    if (!empty($_POST['receiversQuantity']) && $_POST['receiversQuantity'] > 0) {
        foreach (WC()->cart->get_cart() as $key => $item) {
            $type = get_fields($item['product_id']);

            if ($type['product_type'] !== 'tip') {
                WC()->cart->set_quantity($key, $_POST['receiversQuantity']);
            }
        }
    }
}


add_action('wp_ajax_ajax_order', 'submited_ajax_order_data');
add_action('wp_ajax_nopriv_ajax_order', 'submited_ajax_order_data');
function submited_ajax_order_data()
{
    if (!empty($_POST['orderId'])) {
        $order_id = $_POST['orderId'];
        $order = wc_get_order($order_id);

        if ($order->get_status() === 'processing') {
            $fields = get_fields('option');
            $fields = $fields['greeting_card'];
            $default_card_url = $fields['default_greeting_card'];

            if (isset($_POST['magic_gift']) && filter_var(
                    $_POST['magic_gift'],
                    FILTER_VALIDATE_BOOLEAN,
                    FILTER_NULL_ON_FAILURE
                )) {

                $num_receivers = count($_POST['receivers']);
                $amount = (int)$_POST['amount'];
                if ($num_receivers == 1) {

                    $coupon_code = wc_generate_coupon_code();

                    magic_gift_create_coupon(
                        $coupon_code,
                        array(
                        'coupon_amount' => $amount,
                        'discount_type' => 'fixed_cart',
//                    'usage_limit' => 1
                        )
                    );
                //Save the coupon code as order meta
                } else {

                    $coupon_code = array();
                    for ($i = 0; $i < $num_receivers; $i++) {
                        $coupon_code[$i] = wc_generate_coupon_code();

                        magic_gift_create_coupon(
                            $coupon_code[$i],
                            array(
                            'coupon_amount' => $amount,
                            'discount_type' => 'fixed_cart',
    //                    'usage_limit' => 1
                            )
                        );
                    }

                }
                update_post_meta($order_id, 'user-coupon', $coupon_code);
            }

            if (!empty($_POST['type_send'])) {
                update_post_meta($order_id, 'type_send', $_POST['type_send']);
            }

            if (!empty($_POST['template'])) {
                if ($_POST['template'] == 'default') {
                    if (!empty($default_card_url)) {
                        update_post_meta($order_id, '_greeting_card', $default_card_url[0]);
                        update_post_meta($order_id, '_default_card', true);

                        $fileUrl = $default_card_url;
                    }
                } elseif ($_POST['type_send'] !== 'For Several Receivers') {
                    $fileUrl = createSmileCard($_POST['template'], $order_id);
                }

                if ($fileUrl && $_POST['type_send'] !== 'For Several Receivers'){
                    update_post_meta($order_id, 'file_url', $fileUrl);
                }

                if (!empty($_POST['steps_fields'])) {
                    update_post_meta($order_id, '_fields', $_POST['steps_fields']);
                }

                if (!empty($_POST['receivers'])):
                    $sender_data = [
                        'name' => '',
                        'phone' => '',
                        'receiver-name' => '',
                        'lang' => !empty($_POST['lang']) ? $_POST['lang'] : '',
                        'couponCode' => !empty($coupon_code) ? $coupon_code : null,
                    ];

                    if (!empty($_POST['steps_fields']['from-name'])) {
                        $sender_data['name'] = $_POST['steps_fields']['from-name'];
                    }
                    if (!empty($_POST['steps_fields']['sender-name'])) {
                        $sender_data['name'] = $_POST['steps_fields']['sender-name'];
                    }
                    if (!empty($_POST['sender_phone'])) {
                        $sender_data['phone'] = $_POST['sender_phone'];
                    }
                    if (!empty($_POST['steps_fields']['receiver-name'])) {
                        $sender_data['receiver-name'] = $_POST['steps_fields']['receiver-name'];
                    }


                    if ($_POST['time_send'] === 'now'){
                        sendAllCard($_POST['receivers'], $_POST['type_send'], $_POST['template'],$order_id, $fileUrl, $sender_data);
                    } else {
                        $several_receivers_url = [];

                        foreach ($_POST['receivers'] as $key => $receiver) {
                            if ($_POST['template'] === 'default') {
                                $_POST['receivers'][$key]['cardUrl'] = $fileUrl;

                                if ($receiver['id']){
                                    $several_receivers_url[$receiver['id']] = $fileUrl;
                                }
                            } else {
                                $_POST['receivers'][$key]['cardUrl'] = createSmileCard($receiver['template'], $order_id);

                                if ($receiver['id']){
                                    $several_receivers_url[$receiver['id']] = $_POST['receivers'][$key]['cardUrl'];
                                }
                            }
                        }

                        update_post_meta($order_id, 'several_receivers_url', $several_receivers_url);
                    }


                    if (!empty($_POST['time_send'])) {
                        if ($_POST['time_send'] === 'now') {
                            $_POST['time_send'] = date("m/d/Y H:i", time());
                        }

                        update_post_meta($order_id, 'time_send', $_POST['time_send']);
                    }


                    update_post_meta($order_id, 'order_receivers',  $_POST['receivers']);
                    update_post_meta($order_id, 'sender_data',  $sender_data);



                    smile_change_coupons_amount($order);

                endif;
            } else {
                smile_change_coupons_amount($order);
                $order->update_status('completed');
            }

            $invoiceEmail = new Smile_WC_Email_Customer_Invoice();
            $invoiceEmail->trigger($order_id, $order, get_post_meta( $order_id, 'receipt_email', true ));
        }
    }
    wp_die();
}

if (!function_exists('wc_generate_coupon_code')) {
    function wc_generate_coupon_code($isOrderKey = false)
    {
        $woocommerce_admin_meta_boxes_coupon = [
            'characters' => apply_filters('woocommerce_coupon_code_generator_characters', '123456789'),
            'char_length' => apply_filters('woocommerce_coupon_code_generator_character_length', 8),
            'prefix' => apply_filters('woocommerce_coupon_code_generator_prefix', ''),
            'suffix' => apply_filters('woocommerce_coupon_code_generator_suffix', ''),
        ];

        if ($isOrderKey) {
            $woocommerce_admin_meta_boxes_coupon['characters'] = apply_filters('woocommerce_coupon_code_generator_characters', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
        }

        $result = '';

        for ($i = 0; $i < $woocommerce_admin_meta_boxes_coupon['char_length']; $i++) {
            $result .= substr($woocommerce_admin_meta_boxes_coupon['characters'], rand(-1, count(str_split($woocommerce_admin_meta_boxes_coupon['characters']))), 1);
        }

        return $woocommerce_admin_meta_boxes_coupon['prefix'] . $result . $woocommerce_admin_meta_boxes_coupon['suffix'];
    }
}

function createSmileCard($template, $order_id)
{
    $data = stripslashes($template);
    $uniqueId = md5(uniqid());
    $upload_dir = wp_upload_dir();
    $file = $upload_dir['basedir'] . '/greeting-cards/svg-' . $uniqueId . '.svg';
    $fileUrl = $upload_dir['baseurl'] . '/greeting-cards/svg-' . $uniqueId . '.svg';

    // edit svg, remove unneded width, height
    $svgTag = [];
    preg_match('/<svg(.+?)>/m', $data, $svgTag);
    $editedTag = preg_replace(['/width="(.+?)"/', '/height="(.+?)"/'], '', $svgTag[0]);
    $data = str_replace($svgTag[0], $editedTag, $data);

    if (file_put_contents($file, $data)) {
        update_post_meta($order_id, '_greeting_card', $fileUrl);
    } else {
        echo "Failed to save file";
    }

    return $fileUrl;
}
// Smile Coupons
function smile_change_coupons_amount($order)
{
    foreach ($order->get_coupon_codes() as $coupon_code) {

        $coupon = new WC_Coupon($coupon_code);
        $couponNewAmount = $coupon->get_amount() - $order->get_total_discount();
        if ($couponNewAmount < 0) $couponNewAmount = 0;
        $coupon->set_amount($couponNewAmount);
        $coupon->save();

    }
}


// Twillo Send Card
function sendAllCard ($receivers, $type_send, $template = null, $order_id, $fileUrl, $sender_data){
    $auth_data = [
        'sid' => "AC0ffbed6938d83694bc56d13be1ddfc94",
        'token' => "4195cf809e2a4f4ff1a772ce3b85b500",
        'number_from' => '+19794267479',
    ];
    $order = wc_get_order($order_id);

    $several_receivers_url = array();

    $couponCode = $sender_data['couponCode'];
    $r = 0;

    foreach ($receivers as $receiver):
        if (!empty($receiver['name'])) $sender_data['receiver-name'] = $receiver['name'];

        if ($type_send === 'For Several Receivers' && $template !== 'default') {
            if (!empty($receiver['cardUrl'])) {
                $card_url = $receiver['cardUrl'];
            } else {
                $receiverTemplate = $receiver['template'] ?? $template;

                $card_url = createSmileCard($receiverTemplate, $order_id);
            }
        } else {
            $card_url = $fileUrl;
        }

        if($type_send === 'For Several Receivers'){
            if ($receiver['id']){
                $several_receivers_url[$receiver['id']] = $card_url;
            }
            $sender_data['couponCode'] = $couponCode[$r++];
        }

        if ($receiver['email']) {
            send_email_card($receiver['email'], null, $sender_data, $card_url);
        }
        if ($receiver['sms']) {
            send_sms_card($receiver['sms'], $card_url, $auth_data, $sender_data);
        }
        if ($receiver['whatsapp']) {
            send_whatsapp_card($receiver['whatsapp'], $card_url, $auth_data, $sender_data);
        }

    endforeach;

    update_post_meta($order_id, 'several_receivers_url', $several_receivers_url);

    $order->update_status('completed');
}

// Thank You With Ajax
add_action('wp_ajax_thank_you_content', 'thank_you_content');
add_action('wp_ajax_nopriv_thank_you_content', 'thank_you_content');

function thank_you_content() {

    $order_id = $_POST['order_id'];
    $page_id = $_POST['page_id'];
	$lang = apply_filters( 'wpml_current_language', NULL );
	if ($lang == 'he') {
   	$page_id = 865;
	} else {
	$page_id = 738;
	}
    $key = $_POST['orderKey'];
    $sender_data = get_post_meta($order_id, 'sender_data', true);
    $type_send = get_post_meta($order_id, 'type_send', true);
    $orderKey = get_post_meta($order_id, 'order_key', true);

    if ($orderKey !== $key) exit;

    if ($type_send != '' && ($sender_data != '' || $type_send == 'For Me' )) {

        $sender = get_post_meta($order_id, 'sender-name', true);
        $couponCode = $sender_data['couponCode'];
        if ($couponCode == '') {
            $txt = get_field ('text_for_non_magic_gift_template_messege', $page_id);
            $h2_txt = get_field ('text_after_the_title', $page_id);           
        } else {
            $txt = get_field ('text_for_template_messege_with_magic_gift', $page_id);
            $h2_txt = get_field ('text_after_the_title_for_magic_gift_only', $page_id);
        }
        echo '<h3 class="text-text_after_the_title">'. $h2_txt .'</h3>';


        echo '<div class="thank_you_cards">';
        if ($type_send == 'For Several Receivers') {
            $receivers = get_post_meta($order_id, 'order_receivers', true);
            $srcs = get_post_meta($order_id, 'several_receivers_url', true);
            $i = 0;
            foreach ($srcs as $src) {
                $receiver = $receivers[$i]['name'];
                show_card ($src, $sender, $receiver, $txt, $couponCode[$i++]);
            }

        } else if ($type_send == 'For One Receiver') {
            $receiver = $sender_data['receiver-name'];
            $src = get_post_meta($order_id, 'file_url', true);
            show_card ($src, $sender, $receiver, $txt, $couponCode);

        } else if ($type_send == 'For Me') {
        //    op (get_post_meta($order_id));
         //   $receiver = $sender_data['receiver-name'];
         //   $src = get_post_meta($order_id, 'file_url', true);
         //   show_card ($src, $sender, $receiver);
        }

        echo '</div>';

    } else {
        echo $order_id . ' '. $type_send;
    }

 //       op (get_post_meta($order_id));

    exit;
}
// Show Greeting card
function show_card ($src, $sender, $receiver, $txt="Copy to Clipboard", $couponCode) {
    $imgId = smile_get_image_id($src);

    echo '<div class="card_box">';

    if (strpos($src, '.svg') !== false) {

        if ($imgId) {
            $imgPath = wp_get_original_image_path($imgId);
        } else {
            $imgPath = str_replace(get_site_url(), ABSPATH, $src);
        }

        echo file_get_contents($imgPath);
    } else {
        echo ' <img src="'. $src .'" />' ;
    }

    $txt = str_replace ("#customerName#", $sender, $txt);
    $txt = str_replace ("#recipientName#", $receiver, $txt);
    $txt = str_replace ("#cardLink#", $src, $txt);
    $txt = str_replace ("#couponCode#", $couponCode, $txt);

    echo ' <button data-txt="'. $txt .'">'. __('Copy to Clipboard', THEME_TD) .'</button>';
    if ($couponCode != '') {
        echo '<p class="couponCode">'. __('Your coupon code is : ', THEME_TD).  $couponCode. '</p>';
    }
    echo '</div>';
}


// Test if it works
function op ($output, $t="") {
	echo $t.'<pre style="direction:ltr; lline-height:0px;">'. print_r ($output, true) . '</pre>';
}