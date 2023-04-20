<?php
const THEME_FILES_VERSION = '4.1.8.1.7';
const THEME_TD = 'smile';
require __DIR__ . '/vendor/autoload.php';
require_once get_stylesheet_directory() . '/inc/class-smile-wp-mail.php';
require_once get_stylesheet_directory() . '/inc/class-smile-wc-email-customer-invoice.php';
require_once get_stylesheet_directory() . '/inc/helpers.php';
require_once get_stylesheet_directory() . '/inc/acf.php';
require_once get_stylesheet_directory() . '/inc/admin-menu.php';
require_once get_stylesheet_directory() . '/inc/enqueue-scripts.php';
require_once get_stylesheet_directory() . '/inc/image-sizes.php';
require_once get_stylesheet_directory() . '/inc/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/theme-support.php';
require_once get_stylesheet_directory() . '/inc/theme-menus.php';
require_once get_stylesheet_directory() . '/inc/woo.php';
require_once get_stylesheet_directory() . '/inc/gift.php';
require_once get_stylesheet_directory() . '/inc/account-woo.php';
require_once get_stylesheet_directory() . '/inc/ajax-handlers.php';
require_once get_stylesheet_directory() . '/inc/favorite.php';
require_once get_stylesheet_directory() . '/inc/send-message.php';

//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

//add_action( 'woocommerce_review_order_before_submit', 'woocommerce_checkout_coupon_form' );
function remove_modal_on_load() {
  wp_add_inline_script( 'jquery', '
    $(window).on("load", function() {
      if ($("body.logged-in .l-modal-container.is-active").length) {
        $(".l-modal-container.is-active").removeClass("is-active");
      }
    });
  ');
}
add_action( 'wp_head', 'remove_modal_on_load' );

/* PURPOSE 
 * Disable comments on ALL post types
 * remove/hide any existing comments
 * from displaying and hide forms. 
 */

/* INSTALL
 * Add into your active theme's functions.php file. 
 */

/* 1/  Disable Comments on ALL post types */ 
function updated_disable_comments_post_types_support() {
   $types = get_post_types();
   foreach ($types as $type) {
      if(post_type_supports($type, 'comments')) {
         remove_post_type_support($type, 'comments');
         remove_post_type_support($type, 'trackbacks');
      }
   }
}
add_action('admin_init', 'disable_comments_post_types_support');

/* 2. Hide any existing comments on front end */ 
function disable_comments_hide_existing_comments($comments) {
   $comments = array();
   return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

/* 3. Disable commenting */ 
function disable_comments_status() {
   return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

/** Add Meta Pixel to head**/
function add_facebook_pixel() { ?>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '229537309645423');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=229537309645423&ev=PageView&noscript=1"
/></noscript>
    <!-- Meta Pixel Code -->
<?php } 
add_action('wp_head', 'add_facebook_pixel');
 