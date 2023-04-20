<?php
/**
 * Template Name: Thank You
 *  <!-- <a class="share-thank-page" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo home_url(); ?>">  <?php display_svg(get_template_directory_uri() . '/assets/icon/facebook-f-brands.svg', 'share-thank-page-svg'); ?> <?php _e("Share", THEME_TD); ?></a >-->

 */
get_header();

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




}(jQuery));
</script>

<?php get_footer(); ?>

<?php 

