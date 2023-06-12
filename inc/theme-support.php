<?php
/**
 * Theme Support
 */
add_theme_support('custom-logo');
add_theme_support('menus');

// Custom Header
add_theme_support(
    'custom-header',
    array(
        'height' => '30',
        'flex-height' => true,
        'uploads' => true,
        'header-text' => false,
    )
);


// change url of login logo link
add_filter( 'login_headerurl', 'custom_loginlogo_url');

function custom_loginlogo_url($url) {

    return site_url();

}
add_action( 'login_enqueue_scripts', 'my_login_logo_one' );

function my_login_logo_one() {
    ?>
    <style>
        body.login div#login h1 a {
            background-image: url(<?php echo get_header_image()?>);
            background-position: center center;
            background-size: contain;
            width: 100%;
            transition: opacity 0.3s ease-in-out;
        }

        body.login div#login h1 a:hover {
            transition: opacity 0.3s ease-in-out;
            opacity: 0.6;
        }

        #loginform {
            border-radius: 5px;
            border: 1px solid #000;
            -webkit-box-shadow: 7px 7px 0 0 rgb(0 0 0 / 8%);
            box-shadow: 7px 7px 0 0 rgb(0 0 0 / 8%);
        }
    </style>
    <?php
}


add_action('after_setup_theme', 'smile_add_woocommerce_support');
function smile_add_woocommerce_support()
{
    add_theme_support('woocommerce', array(
        'product_grid' => array(
            'default_rows' => 3,
            'min_rows' => 1,
            'max_rows' => 10,
            'default_columns' => 3,
            'min_columns' => 3,
            'max_columns' => 3,
        ),
    ));
}

add_filter('woocommerce_enqueue_styles', '__return_empty_array');


//Change Alt attribute in logo
add_filter( 'get_custom_logo_image_attributes', 'wp_kama_get_custom_logo_image_attributes_filter', 10, 3 );


function wp_kama_get_custom_logo_image_attributes_filter( $custom_logo_attr, $custom_logo_id, $blog_id ){

    $custom_logo_attr['alt'] = 'smile logo';
    return $custom_logo_attr;
}
