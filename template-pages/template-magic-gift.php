<?php
/**
 * Template Name: magic gift
 */
get_header();

$title = get_field('title');
$button_text = get_field('button_text');

?>

<main class="p-magic-gift">
  <section class="l-head-image">
    <div class="container">
      <?php woocommerce_breadcrumb(); ?>

      <div class="l-head-image__img">
        <h1 class="l-head-image__title"><?php _e('Smile Gift Voucher', THEME_TD); ?></h1>
        <img class="l-head-image__img-desctop" src="<?php echo get_template_directory_uri(); ?>/assets/img/gift-img.jpg" alt="magic gift">
        <img class="l-head-image__img-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/img/gift-img-mobile.jpg" alt="magic gift">
      </div>
    </div>
  </section>

  <section class="l-check-giftcard">
    <div class="container">
      <div class="l-check-giftcard__box">
          <?php if($title):?>
              <p class="l-check-giftcard__text">
                 <?= $title; ?>
              </p>
          <?php endif?>
        <form action="" class="l-check-giftcard__form js-check-giftcard">
          <input type="text" placeholder="<?php _e('Enter your Code Coupon here', THEME_TD); ?>">

          <button type="submit" class="u-btn is-big is-pink">
              <?php
                if ($button_text){
                   echo $button_text;
                }else{
                    _e('Check Amount', THEME_TD);
                }
              ?>
          </button>
        </form>
        <div class="js-check-giftcard-answer d-none">
          <a href="#" class="u-btn is-white is-small js-check-giftcard-cancel-code"><?php _e('Cancel code', THEME_TD); ?></a>
          <p><?php _e('The value of your gift card is:', THEME_TD); ?></p>
          <p class="c-price"><span class="amount"></span><span class="currency"><?php echo get_woocommerce_currency_symbol(); ?></span></p>
          <a href="<?=get_permalink(817);?>" class="u-btn is-pink is-big" id="projects-gift"><?php _e('Select a Project', THEME_TD); ?></a>
        </div>

          <div class="js-check-giftcard-answer js-check-giftcard-answer--error d-none" style="color: red; margin-top: 30px">
              <p><?php _e('Seems, your code is wrong. Please, try another one.', THEME_TD); ?></p>
          </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>