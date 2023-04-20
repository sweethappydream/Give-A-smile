<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('smile', get_stylesheet_directory_uri() . '/dist/css/main.min.css', [], THEME_FILES_VERSION);
    wp_enqueue_style('smile_thankyou', get_stylesheet_directory_uri() . '/dist/css/thankyou.css', [], THEME_FILES_VERSION);
    wp_enqueue_style('officeguy-og-css', plugins_url() . '/woo-payment-gateway-officeguy/includes/css/front.css');

    wp_register_script('smile', get_stylesheet_directory_uri() . '/dist/js/app.min.js', [
        'jquery',
        'swiper',
        ], THEME_FILES_VERSION, true);

    wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/src/js/scripts/swiper-bundle.min.js', [], THEME_FILES_VERSION, true);
	wp_enqueue_script('swiper-steps', get_stylesheet_directory_uri() . '/src/js/scripts/steps-swiper.js', [], THEME_FILES_VERSION, true);
	wp_enqueue_script('steps-text', get_stylesheet_directory_uri() . '/src/js/scripts/steps-text.js', [], THEME_FILES_VERSION, true);
    wp_enqueue_script('officeguypayments', 'https://www.myofficeguy.com/scripts/payments.js', ['jquery'], false, false);
    wp_enqueue_script('officeguy-front', plugins_url() . "/woo-payment-gateway-officeguy/includes/js/officeguy.js", ['jquery'], false, false);
    wp_enqueue_script('smile');


    // Throw variables from back to front end.
    $theme_vars = array(
        'home'   => get_home_url(),
        'ajaxUrl' => site_url() . '/wp-admin/admin-ajax.php',
        'logIn' => is_user_logged_in(),
        'userID' => get_current_user_id(),
        'remove' => __('Remove', THEME_TD),
        'add' => __('Add', THEME_TD),
        'defaultText' => __('Default Text', THEME_TD),
        'checkoutPage' => wc_get_checkout_url(),
        'isProduct' => is_singular('product'),
    );

    wp_localize_script('smile', 'themeVars', $theme_vars);
});

function custom_admin_css() {
  wp_enqueue_style( 'custom_admin_css', get_template_directory_uri() . '/src/scss/admin/admin.css', [], THEME_FILES_VERSION);
}
add_action( 'login_enqueue_scripts', 'custom_admin_css', 10 );
add_action( 'admin_enqueue_scripts', 'custom_admin_css', 10 );

function custom_dequeue() {
    wp_dequeue_style('officeguy-og-css');
    wp_deregister_style('officeguy-og-css');

    wp_dequeue_style('wc-blocks-style');
    wp_deregister_style('wc-blocks-style');

    wp_dequeue_style('wc-blocks-vendors-style');
    wp_deregister_style('wc-blocks-vendors-style');

    // wp_deregister_script( 'wc-single-product' );
   // wp_deregister_script( 'cart-widget' );
    wp_deregister_script( 'wc-add-to-cart' );
}
add_action( 'wp_enqueue_scripts', 'custom_dequeue', 9999 );
add_action( 'wp_head', 'custom_dequeue', 9999 );

// Remove Global Styles and SVG Filters from WP 5.9.1 - 2022-02-27
function remove_global_styles_and_svg_filters() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action('init', 'remove_global_styles_and_svg_filters');

//Remove CF7
// Deregister Contact Form 7 styles
add_action( 'wp_print_styles', 'aa_deregister_styles', 100 );
function aa_deregister_styles() { 
	if ( ! is_page( 'faq' ) ) { 
	wp_deregister_style( 'contact-form-7' );
	 }
}
// Deregister Contact Form 7 JavaScript files on all pages without a form
add_action( 'wp_print_scripts', 'aa_deregister_javascript', 100 );
function aa_deregister_javascript() {
		if ( ! is_page( 'faq' ) ) {
	    	wp_deregister_script( 'contact-form-7' );
	}
}
