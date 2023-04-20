<?php
/**
 * Template Name: Thank You
 */

do_action('woocommerce_thankyou', $order->get_id());

get_header();

?>


<section class="thank-you-section">


    <div class="wrapper"></div>
    <div class="container">
        <h1 class="title"><span class="check"><svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">


<path fill-rule="evenodd" clip-rule="evenodd" d="M59.4256 26.4077C60.7192 27.7013 60.7192 29.7987 59.4256 31.0923L36.509 54.009C35.2153 55.3026 33.118 55.3026 31.8244 54.009L21.4077 43.5923C20.1141 42.2987 20.1141 40.2013 21.4077 38.9077C22.7013 37.6141 24.7987 37.6141 26.0923 38.9077L34.1667 46.9821L54.741 26.4077C56.0347 25.1141 58.132 25.1141 59.4256 26.4077Z" fill="#0E1856"/>
</svg></span><?= __('Order complete', THEME_TD);?></h1>

        <div class="thank_you_cards_box"></div>




        <a class="share-thank-page" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo home_url(); ?>">  <?php display_svg(get_template_directory_uri() . '/assets/icon/facebook-f-brands.svg', 'share-thank-page-svg'); ?> <?php _e("Share", THEME_TD); ?></a>


        <a href="<?=get_home_url();?>" class="u-btn is-pink is-big"><?php _e('select another gift', THEME_TD); ?></a>
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

        function get_content() {
            data = {
                action: "thank_you_content",
                order_id: <?php echo $_GET['order_id']; ?>,
                page_id: <?php echo get_the_ID(); ?>
           };

            $.ajax({
                url: themeVars.ajaxUrl,
                data: data,
                type: "POST",
                success: (response) =>{
                    console.log ("[" + response + " " + response.length + "]")
                    if (response.length > 100) {
                        $(".thank_you_cards_box").html(response);
                    } else {
                        get_content();
                    }
                }
            })
        }

       get_content();
    });




}(jQuery));
</script>

<?php get_footer(); ?>

<?php 

