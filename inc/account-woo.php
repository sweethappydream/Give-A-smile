<?php
/**
 * Convert file url to path
 *
 * @param string $url Link to file
 *
 * @return bool|mixed|string
 */

function convert_url_to_path($url)
{
    if (!$url) {
        return false;
    }
    $url = str_replace(array('https://', 'http://'), '', $url);
    $home_url = str_replace(array('https://', 'http://'), '', site_url());
    $file_part = ABSPATH . str_replace($home_url, '', $url);
    $file_part = str_replace('//', '/', $file_part);
    if (file_exists($file_part)) {
        return $file_part;
    }

    return false;
}

function display_svg($img, $class = '', $size = 'medium')
{
    echo return_svg($img, $class, $size);
}

function return_svg($img, $class = '', $size = 'medium')
{
    if (!$img) {
        return '';
    }

    $file_url = is_array($img) ? $img['url'] : $img;

    $file_info = pathinfo($file_url);
    if ($file_info['extension'] == 'svg') {
        $file_path = convert_url_to_path($file_url);

        if (!$file_path) {
            return '';
        }

        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $image = file_get_contents($file_path, false, stream_context_create($arrContextOptions));
        if ($class) {
            $image = str_replace('<svg ', '<svg class="' . esc_attr($class) . '" ', $image);
        }
        $image = preg_replace('/^(.*)?(<svg.*<\/svg>)(.*)?$/is', '$2', $image);

    } elseif (is_array($img)) {
        $image = wp_get_attachment_image($img['id'], $size, false, array('class' => $class));
    } else {
        $image = '<img class="' . esc_attr($class) . '" src="' . esc_url($img) . '" alt="' . esc_attr($file_info['filename']) . '"/>';
    };

    return $image;
}


function smile_add_magic_endpoint()
{
    add_rewrite_endpoint('magic', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('wishlist', EP_ROOT | EP_PAGES);
}

add_action('init', 'smile_add_magic_endpoint');

add_filter("woocommerce_get_query_vars", function ($vars) {
    $vars['magic'] = 'magic';
    $vars['wishlist'] = 'wishlist';
    return $vars;
});

function smile_magic_query_vars($vars)
{
    $vars[] = 'magic';
    $vars[] = 'wishlist';
    return $vars;
}

add_filter('query_vars', 'smile_magic_query_vars', 0);

add_filter('woocommerce_account_menu_items', 'remove_and_rename_menu_items', 9999);
function remove_and_rename_menu_items($items)
{
    $items = [
        'orders' => __('Gifts I’ve Purchased ', THEME_TD),
        'magic'=>__('Used Magic GIFT', THEME_TD),
        'payment-methods' => __('Payment methods', THEME_TD),
        'edit-account' => __('My details', THEME_TD),
        'wishlist' => __('My Wishlist', THEME_TD),
        'customer-logout' => __( 'Logout', THEME_TD),
    ];
    return $items;
}


function smile_magic_content()
{
    get_template_part('template-parts/account-magic-tab');

}

add_action('woocommerce_account_magic_endpoint', 'smile_magic_content');

function smile_wishlist_content()
{
     get_template_part('template-parts/account-wishlist-tab');
}

add_action('woocommerce_account_wishlist_endpoint', 'smile_wishlist_content');


function redirect_account_dashboard($wp)
{

    if (!is_admin()) {

        //  The following will only match if it's the root Account page; all other endpoints will be left alone

        if ($wp->request === 'my-account') {

            wp_redirect(wc_get_account_endpoint_url('orders'));
            exit;
        }
        if ( isset( $wp->query_vars['customer-logout'] ) ) {
            wp_redirect( str_replace( '&amp;', '&',
                wp_logout_url( wc_get_page_permalink( 'hesabim' ) ) ) );
            exit;
        }
    }
}

add_action('parse_request', 'redirect_account_dashboard', 10, 1);



function debug($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

add_filter('woocommerce_save_account_details_required_fields', 'ts_hide_first_name');
function ts_hide_first_name($required_fields)
{
    unset($required_fields["account_first_name"]);
    unset($required_fields["account_last_name"]);
    return $required_fields;
}