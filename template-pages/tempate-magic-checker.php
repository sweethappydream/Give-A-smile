<?php
/**
 * Template Name: Coupon Checker Page
 * WCAG Compliant: Yes
 */

// Include header template
get_header(); 

// Get title and button text from custom fields
$title = get_field('title');
$button_text = get_field('button_text');
?>
<div id="primary" class="content-area">
    <main id="main" class="p-magic-gift" role="main">
<!-- Section with header image and breadcrumb -->
  <section class="l-head-image">
    <div class="container">
        
      <?php 
    // Display WooCommerce breadcrumb
      woocommerce_breadcrumb(); ?>

      <div class="l-head-image__img">
        <h1 class="l-head-image__title"><?php _e('Smile Gift Voucher', THEME_TD); ?></h1>
        <img class="l-head-image__img-desctop" src="<?php echo get_template_directory_uri(); ?>/assets/img/gift-img.jpg" alt="magic gift">
        <img class="l-head-image__img-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/img/gift-img-mobile.jpg" alt="magic gift">
      </div>
    </div>
  </section>
    <!-- Section with gift card checker form -->
  <section class="l-check-giftcard">
  <div class="container">
  <div class="l-check-giftcard__box">
  <?php 
    // Display title if set
  if($title):?>
              <p class="l-check-giftcard__text">
                 <?= $title; ?>
              </p>
          <?php endif?>
    <!-- Gift card checker form -->
        <form method="post" class="l-check-giftcard__form" id="giftcard-form">
            <label for="coupon_code">Enter coupon code:</label>
            <input type="text" name="coupon_code" id="coupon_code" required placeholder="<?php _e('Enter your Code Coupon here', THEME_TD); ?>">

            <button type="submit" class="u-btn is-big is-pink">
              <?php
                if ($button_text){
     // Display button text if set, else default to "Check Amount"
                   echo $button_text;
                }else{
                    _e('Check Amount', THEME_TD);
                }
              ?>
          </button>
        </form>
    <!-- Gift card checker results -->
<div class="js-check-giftcard-answer">
    <?php
    if (isset($_POST['coupon_code'])) {
    // Check if coupon code was submitted
        $coupon_code = sanitize_text_field($_POST['coupon_code']);
        $coupon = new WC_Coupon($coupon_code);
        if ($coupon->get_id() && $coupon->get_usage_count() == 0) {
            $amount = $coupon->get_amount();
            $usage_limit = $coupon->get_usage_limit();
            $usage_count = $coupon->get_usage_count();
            $amount_left = ($usage_limit == 0) ? $amount : max(0, $amount - ($amount * $usage_count / $usage_limit)); ?>
                              <!-- Display gift card amount and "Select a Project" button if usage limit is set -->
            <a href="#" class="u-btn is-white is-small js-check-giftcard-cancel-code"><?php _e('Cancel code', THEME_TD); ?></a>
            <p><?php _e('You entered the following code:', THEME_TD); ?> <strong><?php echo esc_html($coupon_code); ?></strong></p>
            <p><?php _e('The value of your gift card is:', THEME_TD); ?></p>
            <p class="c-price"><span class="amount"><?php echo wc_price($amount_left); ?></span>
            
            </p>
            <?php if ($usage_limit >= 0) { ?>
                <a href="<?= get_permalink(817); ?>" class="u-btn is-pink is-big" id="projects-gift"><?php _e('Select a Project', THEME_TD); ?></a>
            <?php }
            // Add the CSS class to hide the form
            echo '<style>.js-check-giftcard-answer > form { display: none; }</style>';
        } else if ($coupon->get_id() && $coupon->get_usage_count() > 0) { ?>
            <div class="js-check-giftcard-answer--error" style="color: inherit; margin-top: 30px">
				 <p><?php _e('You entered the following code:', THEME_TD); ?> <strong><?php echo esc_html($coupon_code); ?></strong></p>
                <p><?php _e('Your card has been successfully donated!', THEME_TD); ?></p>
            </div>
        <?php } else { ?>
            <div class="js-check-giftcard-answer--error" style="color: red; margin-top: 30px">
				 <p><?php _e('You entered the following code:', THEME_TD); ?> <strong><?php echo esc_html($coupon_code); ?></strong></p>
                <p><?php _e("Oops! Something went wrong with your Code Coupon. Please double check that you've entered it correctly.", THEME_TD); ?></p>
            </div>
        <?php }
    } ?>
</div>


<script>
  // Function to reset the form
  function resetForm() {
    document.getElementById('coupon_code').value = '';
    document.querySelector('.js-check-giftcard-answer').innerHTML = '';
    document.querySelector('.l-check-giftcard__form').classList.remove('hidden');
  }

  // Function to add the CSS class to hide the form
  function hideForm() {
    document.querySelector('.l-check-giftcard__form').classList.add('hidden');
  }

  // Add click event listener to the cancel code button
  document.querySelector('.js-check-giftcard-cancel-code').addEventListener('click', function (event) {
    event.preventDefault();
    resetForm();
  });

  // Check if the gift card checker results container has content
  const checkGiftCardAnswer = document.querySelector('.js-check-giftcard-answer');
  if (checkGiftCardAnswer.innerHTML.trim() !== '') {
    // If there is content, hide the form
    hideForm();
  }
</script>

          <div class="js-check-giftcard-answer js-check-giftcard-answer--error d-none" style="color: red; margin-top: 30px">
              <p><?php _e('Seems, your code is wrong. Please, try another one.', THEME_TD); ?></p>
          </div>
      </div>
    </div>
  </section>
    </main>
	  <!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
