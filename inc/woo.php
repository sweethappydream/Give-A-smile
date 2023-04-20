<?php
/**
 * Woo Extra
 */
if (class_exists('woocommerce')) {

function wc_redirect_to_account_details( $redirect ) {
    $redirect = wc_get_account_endpoint_url('edit-account');
    return $redirect;
}
add_filter( 'woocommerce_registration_redirect', 'wc_redirect_to_account_details' );
//    if (!function_exists('smile_woo_validate_phone_field')) {
//        add_action('woocommerce_register_post', 'smile_woo_validate_phone_field', 10, 3);
//
//        function smile_woo_validate_phone_field($username, $email, $validation_errors)
//        {
//            if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
//                $validation_errors->add('billing_first_name_error', __('<strong>Error</strong>: First name is required!', 'woocommerce'));
//            }
//            return $validation_errors;
//        }
//    }
add_action( 'woocommerce_registration_redirect', 'registration_redirect_home' );
function registration_redirect_home( $redirect ) {
    return home_url();
}
  

    if (!function_exists('smile_woo_save_phone_register_fields')) {
        add_action('woocommerce_created_customer', 'smile_woo_save_phone_register_fields');
        function smile_woo_save_phone_register_fields($customer_id)
        {
            if (isset($_POST['billing_phone'])) {
                $phone = sanitize_text_field($_POST['billing_phone']);
                update_user_meta($customer_id, 'billing_phone', $phone);
            }
        }
    }

    if (!function_exists('smile_woo_get_total_sales')) {
        function smile_woo_get_total_sales(): int
        {
            global $wpdb;

            $order_totals = apply_filters('woocommerce_reports_sales_overview_order_totals', $wpdb->get_row("

SELECT SUM(meta.meta_value) AS total_sales, COUNT(posts.ID) AS total_orders FROM {$wpdb->posts} AS posts

LEFT JOIN {$wpdb->postmeta} AS meta ON posts.ID = meta.post_id

WHERE meta.meta_key = '_order_total'

AND posts.post_type = 'shop_order'

AND posts.post_status IN ( '" . implode("','", array('wc-completed', 'wc-processing', 'wc-on-hold')) . "' )

"));

            return absint($order_totals->total_sales);

        }
    }

    if (!function_exists('smile_woo_get_total_orders')) {
        function smile_woo_get_total_orders()
        {
            global $wpdb;

            return apply_filters('woocommerce_reports_sales_overview_order_items', absint($wpdb->get_var("
	SELECT SUM( order_item_meta.meta_value )
	FROM {$wpdb->prefix}woocommerce_order_items as order_items
	LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
	LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
	LEFT JOIN {$wpdb->term_relationships} AS rel ON posts.ID = rel.object_ID
	LEFT JOIN {$wpdb->term_taxonomy} AS tax USING( term_taxonomy_id )
	LEFT JOIN {$wpdb->terms} AS term USING( term_id )
	WHERE 	term.slug IN ('" . implode("','", apply_filters('woocommerce_reports_order_statuses', array('completed', 'processing', 'on-hold'))) . "')
	AND 	posts.post_status 	= 'publish'
	AND 	tax.taxonomy		= 'shop_order_status'
	AND 	order_items.order_item_type = 'line_item'
	AND 	order_item_meta.meta_key = '_qty'
")));
        }
    }
}

/**
 * Change the breadcrumb separator
 */
add_filter('woocommerce_breadcrumb_defaults', 'smile_change_breadcrumb_delimiter');
function smile_change_breadcrumb_delimiter($defaults)
{
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = '<span class="delimiter"></span>';
    return $defaults;
}

add_filter( 'woocommerce_get_breadcrumb', 'smile_prefix_wc_remove_uncategorized_from_breadcrumb' );

function smile_prefix_wc_remove_uncategorized_from_breadcrumb( $crumbs ) {
    $category 	= get_option( 'default_product_cat' );
    $caregory_link 	= get_category_link( $category );

    foreach ( $crumbs as $key => $crumb ) {
        if ( in_array( $caregory_link, $crumb ) ) {
            unset( $crumbs[ $key ] );
        }
    }
    return array_values( $crumbs );
}



add_action('woocommerce_product_after_variable_attributes', 'donation_variation_settings_fields', 10, 3);

function donation_variation_settings_fields($loop, $variation_data, $variation)
{
    wp_nonce_field(basename(__FILE__), 'elex-wfp-variable-field-nonce');
    ?>
    <?php if (in_array($variation_data['attribute_pa_donation-type'], ['custom-price-he', 'custom-price'])): ?>
    <div class="wrap">
    <span class="elex_cpp_custom_title_heading"><?php echo esc_html_e(__('Donation settings', 'smile')); ?></span>

    <div class="wrap">
    <?php
    woocommerce_wp_text_input(
        array(
            'id' => 'donate_text_field[' . $variation->ID . ']',
            'label' => __('Set Min Price ', 'smile') . '(' . get_woocommerce_currency_symbol() . ')',
            'type' => 'number',
            'placeholder' => __('Enter Your Price', 'smile'),
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '00',
            ),
            'desc_tip' => true,
            'description' => __('Set the minimum price of your product.', 'smile'),
            'value' => get_post_meta($variation->ID, 'donate_min_price', true),
        )
    );
    echo '</div>';
endif;
}

add_action('woocommerce_save_product_variation', 'donation_save_variation_settings_fields', 10, 2);

function donation_save_variation_settings_fields($post_id)
{
    if (!(isset($_REQUEST['elex-wfp-variable-field-nonce']) || wp_verify_nonce(sanitize_key($_REQUEST['elex-wfp-variable-field-nonce']), 'woocommerce_save_data'))) {
        return false;
    }
    $donate_min_price = isset($_POST['donate_text_field'][$post_id]) ? sanitize_text_field($_POST['donate_text_field'][$post_id]) : 0;
    update_post_meta($post_id, 'donate_min_price', $donate_min_price);
}


//  Checkout page

add_filter('woocommerce_product_add_to_cart_url', 'smile_fix_for_individual_products', 10, 2);

function smile_fix_for_individual_products($add_to_cart_url, $product)
{

    if ($product->get_sold_individually() // if individual product
        && WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->id)) // if in the cart
        && $product->is_purchasable() // we also need these two conditions
        && $product->is_in_stock()) {
        $add_to_cart_url = wc_get_checkout_url();
    }

    return $add_to_cart_url;

}

add_filter('woocommerce_add_cart_item_data', 'catch_and_save_submited_donation', 10, 2);

function catch_and_save_submited_donation($cart_item_data, $product_id)
{

    // Get the WC_Product Object
    $product = wc_get_product($product_id);

    // Get an set the product active price
    $cart_item_data['active_price'] = (float)$product->get_price();
    // Get the donation amount and set it
    $cart_item_data['donation'] = (float)esc_attr($_REQUEST['donation']);
    $cart_item_data['unique_key'] = md5(microtime() . rand()); // Make each item unique

    return $cart_item_data;
}


//add_filter('woocommerce_add_to_cart_validation', 'smile_validation_handler', 10, 2);

function smile_validation_handler($is_valid, $product_id) {
            WC()->cart->empty_cart();
    return $is_valid;
}

//add_action( 'wp_head', 'wc_clear_cart' );
function wc_clear_cart() {
if (is_singular('product')) {
    WC()->cart->empty_cart( true );
}
}

add_filter( 'woocommerce_create_order', 'lg_smile_add_tips_for_order', 10, 2 );
function lg_smile_add_tips_for_order($null, $that) {
    if (!empty($_POST['tip']) && $_POST['tip'] >= 1) {
        $isTipInCart = false;

        foreach (WC()->cart->get_cart() as $item) {
            $type = get_fields($item['product_id']);

            if($type['product_type'] === 'tip') {
                $isTipInCart = true;
            }
        }

        if (!$isTipInCart) WC()->cart->add_to_cart(776);
    }
}

add_action('woocommerce_before_calculate_totals', 'add_donation_to_item_price', 10, 1);

function add_donation_to_item_price($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    // Loop through cart items
    foreach ($cart->get_cart() as $item) {
        $type = get_fields($item['product_id']);
        // Add the donation to the product price
        if (isset($item['donation']) && isset($item['active_price'])) {
            $item['data']->set_price($item['active_price'] + $item['donation']);
        }

        if($type['product_type'] === 'tip') {
            if(!empty($_POST['tip']) && $_POST['tip'] >= 1) $item['data']->set_price($_POST['tip']);
        }
    }
}


/**
 * @snippet Simplify Checkout if Only Virtual Products
 */

add_filter('woocommerce_checkout_fields', 'smile_simplify_checkout_virtual');

function smile_simplify_checkout_virtual($fields)
{

    $only_virtual = true;

    if ($only_virtual) {

        unset($fields['billing']['billing_first_name']);

        unset($fields['billing']['billing_last_name']);

        unset($fields['billing']['billing_email']);

        unset($fields['billing']['billing_company']);

        unset($fields['billing']['billing_address_1']);

        unset($fields['billing']['billing_address_2']);

        unset($fields['billing']['billing_city']);

        unset($fields['billing']['billing_postcode']);

        unset($fields['billing']['billing_country']);

        unset($fields['billing']['billing_state']);

        unset($fields['billing']['billing_phone']);

        add_filter('woocommerce_enable_order_notes_field', '__return_false');

    }
    return $fields;

}

add_action( 'woocommerce_admin_order_data_after_order_details', 'smile_display_order_data_in_admin' );

function show_g_card ($src) {
    echo '<a href="'. $src .'" target="_blank" ><img src="'. $src .'" style="width: 100px; height: auto; "/></a>';
}

function smile_display_order_data_in_admin( $order ){
    $order_id = $order->get_id();
$card = get_post_meta( $order->get_id(), '_greeting_card', true );
$default_card = get_post_meta( $order->get_id(), '_default_card', true );?>

    <div class="form-field-wide">
        <h4 style="margin: 10px 0; display: inline-block;"><?php _e( 'Donation Type:', THEME_TD ); ?></h4>
            <div class="row" style="padding: 8px; display: flex; align-items: center; border: 1px solid #8c8f94; border-radius: 4px;">
<pre>
<?=get_post_meta( $order->get_id(), 'type_send', true );?>
</pre>
           </div>

    </div>
<?php if(!empty($card)):?>
    <div class="form-field-wide">
        <h4 style="margin: 10px 0; display: inline-block;"><?php _e( 'Greeting Card(s)', THEME_TD ); ?></h4>

 


            <div class="row" style="display: flex; align-items: center; border: 1px solid #8c8f94; border-radius: 4px;">
<!--
            <div class="preview" style="width: 100px; height: 100px; display: flex; align-content: center;justify-content: center; padding: 5px;">
            <img src="<?=get_post_meta( $order->get_id(), '_greeting_card', true );?>" alt="preview">
            </div>

            <div class="link">
            <a target="_blank" href="<?=get_post_meta( $order->get_id(), '_greeting_card', true );?>">
            <?= $default_card ? __( 'Default Card', THEME_TD ) : __( 'Greeting Card', THEME_TD ); ?>
            </a>
            </div>

-->

            <?php

            
    $type_send = get_post_meta($order_id, 'type_send', true);
    if ($type_send != '') {
        if ($type_send == 'For Several Receivers') {
            $srcs = get_post_meta($order_id, 'several_receivers_url', true);
            foreach ($srcs as $src) {
                show_g_card ($src);
            }

        } else if ($type_send == 'For One Receiver') {
            $src = get_post_meta($order_id, 'file_url', true);
            show_g_card ($src);             
        }
    }

?>
           </div>
    </div>
<?php
endif;

          $send_date = get_post_meta( $order->get_id(), 'time_send', true );
          $utc2Time = date("m/d/Y H:i", strtotime('+2 hours', strtotime($send_date)));
          ?>
         <?php if($utc2Time):?>
             <h4><?php _e( 'Send date', THEME_TD ); ?></h4>
         <input type="datetime-local" name="time_send" value="<?= date("Y-m-d\TH:i", strtotime($utc2Time)) ?>">
         <?php endif;

$coupon = get_post_meta( $order->get_id(), 'user-coupon', true );
if(!empty($coupon)):
?>
    <div class="form-field-wide">
        <h4 style="margin: 10px 0; display: inline-block;"><?php _e( 'Magic Gift Code:', THEME_TD ); ?></h4>
            <div class="row" style="padding: 8px; display: flex; align-items: center; border: 1px solid #8c8f94; border-radius: 4px;">
<?php if (is_array($coupon)) {
    foreach ($coupon as $c) { echo '<pre>'. $c .'</pre> &nbsp;&nbsp;'; }
} else {          
    echo '<pre>'. $coupon .'</pre>';
}   ?>
           </div>

    </div>
<?php endif;
 $fields = get_post_meta( $order->get_id(), '_fields' );

 if(isset($fields[0]) && $fields[0]):
?>
    <div class="form-field-wide">
        <h4 style="margin: 10px 0; display: inline-block;"><?php _e( 'Order Fields', THEME_TD ); ?></h4>
            <div class="row" style=" border: 1px solid #8c8f94; border-radius: 4px; padding: 8px;">

<?php


$receiver_name = '';
$receiver_table = '';

 foreach ($fields[0] as $key=>$value): ?>
 <?php
switch ($key) {
        case 'select-happening':
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Chosen Celebration', THEME_TD ). ':</h6><br>';
        echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'receiver-name':
            $receiver_name = $value;   
//        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Receiver Name', THEME_TD ). ':</h6><br>';
//              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'email-value':
            $value = $value?$value:'---';
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Receiver Email', THEME_TD ). ':</h6><br>';
              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'sms-value':
            $value = $value?$value:'---';
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Receiver Sms', THEME_TD ). ':</h6><br>';
              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'whatsapp-value':
            $value = $value?$value:'---';
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Receiver Whatsapp', THEME_TD ). ':</h6><br>';
              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'sender-name':
            $value = $value?$value:'---';
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Sender Name', THEME_TD ). ':</h6><br>';
              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'sender-phone':
            $value = $value?$value:'---';
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Sender Phone', THEME_TD ). ':</h6><br>';
              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'dispatch-time':
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Time to send', THEME_TD ). ':</h6><br>';
              echo '<span style="font-size: 11px;">'.$value.'</span></div>';
        break;

        case 'receivers':
            foreach ($value as $val) {
                if ($receiver_name == '') $receiver_name = $val['name'];
                $receiver_table .= '<tr><td>'. $receiver_name .'</td><td>'. $val['email'] .'</td><td>'. $val['sms'] .'</td><td>'. $val['whatsapp'] .'</td></tr>';
                $receiver_name = '';
 //               show_field_value ('Receiver Email', $val['email']);                
//                show_field_value ('Receiver Sms', $val['sms']);
  //              show_field_value ('Receiver Whatsapp', $val['whatsapp']);
            }
            break;

        default:
        echo '<!-- '. $key .' : '. print_r($value, true).' -->';
        break;
}?>
<?php endforeach;

    if ($receiver_table != '') {
        echo '<h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( 'Receiver(s) Details', THEME_TD ). ':</h6>';
        echo '<table><tr><th>'. __( 'Name', THEME_TD ) .'</th><th>'. __( 'Email', THEME_TD ) .'</th><th>'. __( 'SMS', THEME_TD ) .'</th><th>'. __( 'Whatsapp', THEME_TD ) .'</th></tr>';
        echo $receiver_table . '</table>';
    }

?>
           </div>
    </div>
<?php endif; }

 /**
 * Trim zeros in price decimals
 **/
 add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

function show_field_value ($title, $value) {
    if ($value != '') {
        echo '<div style="margin-bottom: 7px;"><h6 style="font-size: 12px; font-weight: 600; margin: 0 0 5px; display: inline-block;">'. __( $title, THEME_TD ). ':</h6><br>';
        echo '<span style="font-size: 11px;">'.$value.'</span></div>'; 
    }
}
function magic_gift_create_coupon( $coupon_name, $args = array() ) {

  $coupon_args = array(
    'post_title' => $coupon_name,
    'post_content' => '',
    'post_status' => 'publish',
    'post_author' => 1,
    'post_type' => 'shop_coupon'
  );

  $coupon_id = wp_insert_post( $coupon_args );

  if ( !empty( $coupon_id ) && !is_wp_error( $coupon_id )) {
    foreach ( $args as $key => $val ) {
      update_post_meta( $coupon_id, $key, $val );
    }
  }

  return $coupon_id;
}

add_action( 'woocommerce_thankyou', 'lg_smile_order_redirect');
function lg_smile_order_redirect( $order_id ){
    $order = wc_get_order( $order_id );
    $orderKey = wc_generate_coupon_code(true);

    $url = get_permalink(738) . '?order_id=' . $order_id . '&key=' . $orderKey;

    update_post_meta($order_id, 'order_key', $orderKey);

    if ( ! $order->has_status( 'failed' ) ) {
        wp_safe_redirect( $url );
        exit;
    }
}

/**
* Create cron events function
 */
function create_cron_events (){
// TODO: create single cron event

}

function send_greeting_cards ($msg){
}
add_action( 'woocommerce_before_checkout_form', 'woocommerce_before_checkout_form__calback', 10 );

function woocommerce_before_checkout_form__calback(){
    get_template_part('template-parts/product-header', 'checkout');
}



add_filter( 'wp_mail', 'smile_mail_filter' );
/**
 * Function for `wp_mail` filter-hook.
 *
 * @param array $args Array of the `wp_mail()` arguments.
 *
 * @return array
 */
function smile_mail_filter( $args ){
    $customer_id = get_current_user_id();
    $billing_name = get_user_meta( $customer_id, 'billing_first_name', true );

    $userName = $billing_name ?: wp_get_current_user()->data->display_name ?: wp_get_current_user()->data->user_nicename;
    $userName = $userName ? ' ' . $userName : '';

    $args['message'] = str_replace(' {user_name}', $userName, $args['message']);
	return $args;
}


// add email field for receipt to checkout
add_action('woocommerce_checkout_process', 'check_receipt_additional_checkout_fields');
function check_receipt_additional_checkout_fields() {
    $customer_id = get_current_user_id();
    $lang = apply_filters( 'wpml_current_language', NULL );

    if ( empty($_POST['receipt_email']) && !is_user_logged_in() ) {
        if ($lang == 'he') {
            wc_add_notice( __( 'אל תשכח למלא את המייל שלך', THEME_TD ), 'error' );
        } else {
            wc_add_notice( __( 'Don’t Forget to Fill In Your Email', THEME_TD ), 'error' );
        }
    }

    if ( empty($_POST['sender-name']) ) {
        if ($lang == 'he') {
            wc_add_notice( __( 'אל תשכח למלא את שמך', THEME_TD ), 'error' );
        } else {
            wc_add_notice( __( 'Don’t Forget to Fill In Your Name', THEME_TD ), 'error' );
        }
    } elseif (is_user_logged_in()) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field($_POST['sender-name']));
    }

    if ( empty($_POST['billing_phone']) ) {
        if ($lang == 'he') {
            wc_add_notice( __( 'אל תשכח למלא את הטלפון שלך', THEME_TD ), 'error' );
        } else {
            wc_add_notice( __( 'Don’t Forget to Fill In Your Phone', THEME_TD ), 'error' );
        }
    } elseif (is_user_logged_in()) {
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}

add_action( 'woocommerce_checkout_update_order_meta', 'receipt_email_checkout_field_update_order_meta' );
function receipt_email_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['receipt_email'] ) ) {
        update_post_meta( $order_id, 'receipt_email', sanitize_text_field( $_POST['receipt_email'] ) );
    }

    if ( ! empty( $_POST['sender-name'] ) ) {
        update_post_meta( $order_id, 'sender-name', sanitize_text_field( $_POST['sender-name'] ) );
    }

    if ( ! empty( $_POST['billing_phone'] ) ) {
        update_post_meta( $order_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'receipt_email_checkout_field_display_admin_order_meta', 10, 1 );
function receipt_email_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Email for Receipt', THEME_TD).':</strong> ' . get_post_meta( $order->get_id(), 'receipt_email', true ) . '</p>';
    echo '<p><strong>'.__('Name for Receipt', THEME_TD).':</strong> ' . get_post_meta( $order->get_id(), 'sender-name', true ) . '</p>';
    echo '<p><strong>'.__('Phone for Receipt', THEME_TD).':</strong> ' . get_post_meta( $order->get_id(), 'billing_phone', true ) . '</p>';
}
add_action( 'woocommerce_checkout_create_order', 'smile_woocommerce_checkout_order_set_custom_fields' );
function smile_woocommerce_checkout_order_set_custom_fields( $order ){
    if (!empty($_POST['receipt_email'])) $order->set_billing_email($_POST['receipt_email']);
    if (!empty($_POST['sender-name'])) $order->set_billing_first_name($_POST['sender-name']);
    if (!empty($_POST['billing_phone'])) $order->set_billing_phone($_POST['billing_phone']);
}
/**
 * Add Remove href to order review
 */
add_filter('woocommerce_checkout_cart_item_quantity', 'checkout_review_order_remove_link', 1000, 3);
function checkout_review_order_remove_link($quantity_html, $cart_item, $cart_item_key) {
    return $quantity_html . apply_filters('woocommerce_cart_item_remove_link', sprintf(
        '<a href="%s" rel="nofollow" class="remove"> </a>',
        esc_url(wc_get_cart_remove_url($cart_item_key)),
        __('Remove this item', 'woocommerce'),
        esc_attr($cart_item['product_id']),
        esc_attr($cart_item['data']->get_sku())
    ), $cart_item_key);
}

/**
 * @snippet       View Thank You Page @ Edit Order Admin
 */
 
add_filter( 'woocommerce_order_actions', 'bbloomer_show_thank_you_page_order_admin_actions', 9999, 2 );
 
function bbloomer_show_thank_you_page_order_admin_actions( $actions, $order ) {
   if ( $order->has_status( wc_get_is_paid_statuses() ) ) {
      $actions['view_thankyou'] = 'Display thank you page';
   }
   return $actions;
}
 
add_action( 'woocommerce_order_action_view_thankyou', 'bbloomer_redirect_thank_you_page_order_admin_actions' );
 
function bbloomer_redirect_thank_you_page_order_admin_actions( $order ) {
   $url = $order->get_checkout_order_received_url();
   add_filter( 'redirect_post_location', function() use ( $url ) {
      return $url;
   });
}

add_action ('save_post_shop_order', function ($postId, $post, $update) {
        if (!$update) return;

        if (!empty($_POST['time_send'])) {
            $utc0Time = date("m/d/Y H:i", strtotime('-2 hours', strtotime($_POST['time_send'])));
            update_post_meta($postId, 'time_send', $utc0Time);
        }
    }, 10, 3);