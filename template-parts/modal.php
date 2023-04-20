<div class="l-modal-container">
  <?php 
    $logged = (is_admin() || is_user_logged_in()) ? true : false;
    	$ProductlTitle = get_field('headline_product', 'option');
	$DescModal = get_field('short_text_before_the_buttons', 'option');
	$SomeOneElse = get_field('someone_else_button', 'option');
	$FewPeople = get_field('few_people_button', 'option');
	$ForMeButton = get_field('for_me_button', 'option');
	$TextAfterButton = get_field('text_after_buttons', 'option');
  ?>
  <div class="c-modal c-mobile-menu" id="mobile-menu">
    <div class="c-mobile-menu__head">
      <div class="c-mobile-menu__close" data-modal="close">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.491 28.8244C14.8422 28.1756 14.8416 27.1239 15.4897 26.4744L21.95 20L15.4897 13.5256C14.8416 12.8761 14.8422 11.8244 15.491 11.1756V11.1756C16.1403 10.5264 17.193 10.5264 17.8423 11.1756L25.2524 18.5858C26.0335 19.3668 26.0335 20.6332 25.2524 21.4142L17.8423 28.8244C17.193 29.4736 16.1403 29.4736 15.491 28.8244V28.8244Z" fill="white"/>
        </svg>


      </div>
      <div class="c-mobile-menu__head-login <?php echo $logged ? 'is-logged' : ''; ?>">
        <?php if ($logged === false): ?>
          <a href="#" data-modal="#login-modal" class="u-btn">
            <i class="fa fa-user-o" aria-hidden="true"></i>
            <?php _e('LOGIN', THEME_TD) ?>
          </a>
        <?php else: 
          $current_user = wp_get_current_user();
        ?>
          <div class="c-user">
            <i class="fa fa-user-o" aria-hidden="true"></i>
            <span><?php _e('Hello', THEME_TD);  echo ', ' . $current_user->display_name; ?></span>
          </div>
          <a href="<?php echo wp_logout_url('/'); ?>" class="u-btn is-white"><?php _e('Log out', THEME_TD) ?></a>
        <?php endif; ?>
      </div>
    </div>
    <div class="c-mobile-menu__body">
      <?php
        if ($logged === true) {
          wp_nav_menu([
            'theme_location' => 'login_menu',
            'menu' => '',
            'container' => false,
            'menu_class' => 'site-main-menu',
            'echo' => true,
            'depth' => 1,
          ]);
        }
      ?>
      <div class="c-mobile-menu__body-line"></div>
      <?php
        wp_nav_menu([
          'theme_location' => 'main_menu',
          'menu' => '',
          'container' => false,
          'menu_class' => 'site-main-menu',
          'echo' => true,
          'depth' => 1,
        ]);
      ?>
    </div>
    <div class="c-mobile-menu__bottom">
      <div class="site-lang">
        
        <?= do_shortcode('[wpml_language_selector_widget]'); ?>
        <?= file_get_contents(get_stylesheet_directory() . '/assets/img/world.svg') ?>
      </div>
    </div>
  </div>
<?php
  if (!is_admin() && !is_user_logged_in()):

   $loginImg = get_field('opt_popup_image', 'option');
 $loginTitle = get_field('opt_popup_title', 'option');

 $loginForm = do_shortcode('[smile_wc_login_form]');
 $registerForm = do_shortcode('[smile_wc_registration_form]');

 $loginLabelsText = get_field('login_form_labels', 'option');
 $loginTabText = $loginLabelsText['tab_text'] ?? null;

 $registerLabelsText = get_field('register_form_labels', 'option');
 $registerTabText = $registerLabelsText['tab_text'] ?? null;

 $externalTitle = get_field('external_logins_title', 'option');
 ?>

 <div class="login-popup c-modal" id="login-modal" role="dialog" aria-labelledby="nice-to-see-you-heading-id">
    <div class="login-popup__container">
      <?php if ($loginTitle || $loginImg): ?>
        <header class="login-popup__header">
          <?= $loginTitle ? '<div class="login-popup__title h6">' .$loginTitle . '</div>' : '' ?>
          <?= $loginImg ? '<div class="login-popup__img">' . wp_get_attachment_image($loginImg, 'thumbnail') . '</div>' : '' ?>
        </header>
      <?php endif; ?>

      <?php if ($loginForm && $registerForm): ?>
        <div class="login-popup__tabs function-tab" data-target=".login-popup__forms"
        data-active-class="tab-btn--active">
        <button type="button" class="login-popup__tab tab-btn tab-btn--thin" data-id="login">
          <?= $loginTabText ?: __('תורבחתה', THEME_TD) ?>
        </button>

        <button type="button" class="login-popup__tab tab-btn tab-btn--thin" data-id="register">
          <?= $registerTabText ?: __('המשרה', THEME_TD) ?>
        </button>
      </div>
    <?php endif; ?>

    <?php do_action('woocommerce_before_customer_login_form'); ?>

    <div class="login-popup__forms">
      <?= $loginForm ? '<div class="login-popup__form" data-id="login">' . $loginForm . '</div>' : '' ?>
      <?= $registerForm ? '<div class="login-popup__form" data-id="register">' . $registerForm . '</div>' : '' ?>
    </div>
    <!-- /.login-popup__forms -->

    <div class="login-popup__external">
      <div class="login-popup__external-title"><?= $externalTitle ?: __('ךרד רבחתה וא', THEME_TD) ?></div>
      <div class="login-popup__external-social">
        <?php echo do_shortcode('[nextend_social_login]'); ?>
      </div>
    </div>

    <button type="button" class="login-popup__close function-toggle" data-modal="close" aria-label="close">
      <?= file_get_contents(get_stylesheet_directory() . '/assets/img/close.svg') ?>
    </button>
  </div>
</div>

<?php endif; ?>

  
<?php if (is_product() || is_checkout()) : ?>
	
  <div class="project-popup c-modal" id="product-modal" role="dialog" aria-labelledby="product-choose">
    <div class="project-popup__overlay ">
      <div class="project-popup__container">
        <button type="button" class="project-popup__close" data-modal="close" aria-label="close">
          <?= file_get_contents(get_stylesheet_directory() . '/assets/img/close.svg') ?>
        </button>
		<h2 class="project-popup__title h6"><?= $ProductlTitle ?: __('טסט לבדיקה של כותרת ארוכה', THEME_TD) ?></h2>
        <p><?= $DescModal ?: __('טסט לבדיקה של כותרת ארוכה', THEME_TD) ?></p>
        <div class="project-popup__btn-wrap" role="group" aria-labelledby="On which behalf is this donation?">
          <button id="for-one" class="tab-btn tab-btn--popup btn-step" data-type="For One Receiver" data-step="2"><?= $SomeOneElse ?: __('טסט לבדיקה של כותרת ארוכה', THEME_TD) ?></button>
          <button id="for-few" class="tab-btn tab-btn--popup btn-step" data-type="For Several Receivers" data-step="2"><?= $FewPeople ?: __('טסט לבדיקה של כותרת ארוכה', THEME_TD) ?></button>
          <?php $product_type = get_field('product_type', get_the_ID());
          if ($product_type === 'simple' || empty($product_type)):?>
            <button id="for-me" class="tab-btn tab-btn--popup btn-step" aria-describedby="for-me-desc" data-type="For Me" data-step="5"><?= $ForMeButton ?: __('טסט לבדיקה של כותרת ארוכה', THEME_TD) ?>*</button> 
          <?php endif;?>
        </div>
        <?php if ($product_type === 'simple' || empty($product_type)):?>
          <p class="project-popup__sm-text" id="for-me-desc" ><?= $TextAfterButton ?: __('טסט לבדיקה של כותרת ארוכה', THEME_TD) ?></p> 
        <?php endif;?>
      </div>
    </div>
  </div>


  <div class="c-modal is-add-tip" id="add-tip" role="dialog" aria-labelledby="tip">
    <div class="c-modal__close" data-modal="close" aria-label="close">
      <?= file_get_contents(get_stylesheet_directory() . '/assets/img/close.svg') ?>
    </div>
    <div class="c-modal__head">
      <h2 class="c-modal__head-title"><?php _e('Thanks for Supporting Us!', THEME_TD) ?></h2>
      <p class="c-modal__head-subtitle"><?php _e('How Much Would You Like to Tip?<br>All Prices in', THEME_TD) ?></p>
	<span class="c-modal__head-subtitle"> <?php echo get_woocommerce_currency_symbol(); ?> </span>
    </div>
    <form class="c-modal__body" id="tip-form">
            <input class="u-btn is-big is-grey is-border-green js-add-custom-price" type="number" name="custom_price" placeholder="<?php _e('Select Amount', THEME_TD) ?>" onkeypress="return event.charCode >= 48" min="1" data-symbol="€">

      <div class="c-modal__body-row" role="radiogroup">

        <input type="radio" id="gift1" name="add-tip" value="10" class="visually-hidden">
        <label class="u-btn is-radio is-small is-white" for="gift1">
          <?php _e('10% of My Gift', THEME_TD) ?>
        </label>

        <input type="radio" id="gift2" name="add-tip" value="15" class="visually-hidden">
        <label class="u-btn is-radio is-small is-white" for="gift2">
          <?php _e('15% of My Gift', THEME_TD) ?>
        </label>

        <input type="radio" id="gift3" name="add-tip" value="20" class="visually-hidden">
        <label class="u-btn is-radio is-small is-white" for="gift3">
          <?php _e('20% of My Gift', THEME_TD) ?>
        </label>


        <input type="radio" id="gift4" name="add-tip" value="25" class="visually-hidden">
        <label class="u-btn is-radio is-small is-white" for="gift4">
          <?php _e('25% of My Gift', THEME_TD) ?>
        </label>

      </div>
      <button for="tip-form" type="submit" class="btn"><?php _e('Add to Cart', THEME_TD) ?></button>
    </form>
  </div>
<?php endif; ?>
</div>
<span class="js-trigger-modal is-product-modal" data-modal="#product-modal"></span>
<span class="js-trigger-modal is-add-tip" data-modal="#add-tip"></span>
<span class="js-trigger-modal is-login" data-modal="#login-modal"></span>