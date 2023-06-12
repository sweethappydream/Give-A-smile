<?php
/**
 * Template Name: Thank You
 *  <!-- <a class="share-thank-page" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo home_url(); ?>">  <?php display_svg(get_template_directory_uri() . '/assets/icon/facebook-f-brands.svg', 'share-thank-page-svg'); ?> <?php _e("Share", THEME_TD); ?></a >-->

 */

if (isset($_GET['action']) && $_GET['action'] == 'get_type') {

    $order_id = $_GET['oid'];

    $ret = array();
    $ret['type_send'] = get_post_meta($order_id, 'type_send', true);
    $sender_data = get_post_meta($order_id, 'sender_data', true);
    $ret['couponCode'] = (isset($sender_data['couponCode'])) ? $sender_data['couponCode'] : '';
    echo json_encode ($ret);
    exit;
}

get_header();

function om ($output, $subject="Debug") {

	$headers = "Content-Type: text/html; charset=UTF-8\r\n";

	$txt  = '<pre style="direction:ltr;">'. print_r ($output, true) . '</pre>';
	


}


$order_id = $_GET['order_id'];
$type_send = get_post_meta($order_id, 'type_send', true);
$sender_data = get_post_meta($order_id, 'sender_data', true);
$couponCode = $sender_data['couponCode'];
om (get_post_meta($order_id), 'Order');

?>


<section class="thank-you-section">


    <div class="wrapper"></div>
    <div class="container">
        <h1 class="title"><?php the_field('title-thankyoupage'); ?> </h1>

        <div class="thank_you_cards_box"></div>
        <a href="<?=get_home_url();?>" class="u-btn is-pink is-big"><?php _e('select another gift', THEME_TD); ?></a>
		<p class="text-text_after_the_title"><?php the_field('text_after_pink_button'); ?></p>
		
		<div id="share">

  <!-- facebook -->
  <a class="facebook"href="http://www.facebook.com/sharer/sharer.php?u=<?php echo home_url(); ?>" target="blank"><i class="fa fa-facebook"></i></a>

  <!-- twitter -->
  <a class="twitter"href="https://twitter.com/intent/tweet?status=<?php echo home_url(); ?>" target="blank"><i class="fa fa-twitter"></i></a>


  <!-- linkedin -->
  <a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo home_url(); ?>" target="blank"><i class="fa fa-linkedin"></i></a>
  
</div>
    </div>
</section>

<script>

(function($) {

    $(".thank_you_cards_box").on("click", ".card_box button", function(e) {
        var TextToCopy = $(this).data("txt");

        var TempText = document.createElement("input");
        TempText.value = TextToCopy;
        document.body.appendChild(TempText);
        TempText.select();

        document.execCommand("copy");
        document.body.removeChild(TempText);

        alert("Copied text: " + TempText.value);

    });

 
    $(document).ready(function ($) {     

        var type_send = '<?php echo $type_send; ?>';
        var couponCode = '<?php echo $couponCode; ?>';
        type_send = '';
        couponCode = '';
        
        function check_type() {
            console.log ('type_send ' + type_send);

            if (type_send != '') {
        
                if (type_send == 'For Me' || couponCode != '') {
                    console.log (type_send + '] [' + couponCode);
                    $(".thank_you_cards_box").remove();
                }
            } else {
                $.ajax({
                    type: 'get',
                    url: "?action=get_type&oid=<?php echo $order_id;?>",
                    cache: false,
                    success: function (response) {
                        console.log ('response ' + response);
                        json = JSON.parse(response);
                        type_send = json.type_send;
                        couponCode = json.couponCode;
                        console.log (type_send + '] + [' + couponCode);
                        check_type();
                    }
                });
            }
        }

        check_type();

    });




}(jQuery));
</script>

<?php get_footer(); ?>

<?php 

