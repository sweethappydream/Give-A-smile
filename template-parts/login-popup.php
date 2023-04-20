<?php
/**
 * Logip Modal
 */
if (!is_admin() && !is_user_logged_in()):

    $loginImg = get_field('opt_popup_image', 'option');
    $loginTitle = get_field('opt_popup_title', 'option');

    $loginForm = do_shortcode('[smile_wc_login_form]');
    $registerForm = do_shortcode('[smile_wc_registration_form]');

    $loginLabelsText = get_field('login_form_labels', 'option');
    $loginTabText = $loginLabelsText['tab_text'] ?? null;

    $registerLabelsText = get_field('register_form_labels', 'option');
    $registerTabText = $loginLabelsText['tab_text'] ?? null;

    $externalTitle = get_field('external_logins_title', 'option');
    ?>

    <div class="login-popup" role="dialog" aria-labelledby="nice-to-see-you-heading-id">
        <div class="login-popup__overlay">
            <div class="login-popup__container">
                <?php if ($loginTitle || $loginImg): ?>
                    <div class="login-popup__header">
                        <?= $loginTitle ? '<div class="login-popup__title h6">' .$loginTitle . '</div>' : '' ?>
                        <?= $loginImg ? '<div class="login-popup__img">' . wp_get_attachment_image($loginImg, 'thumbnail') . '</div>' : '' ?>
                </div>
                    <!-- /.login-popup__header -->
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
                    <!-- /.login-popup__tabs -->
                <?php endif; ?>

                <?php do_action('woocommerce_before_customer_login_form'); ?>

                <div class="login-popup__forms">
                    <?= $loginForm ? '<div class="login-popup__form" data-id="login">' . $loginForm . '</div>' : '' ?>
                    <?= $registerForm ? '<div class="login-popup__form" data-id="register">' . $registerForm . '</div>' : '' ?>
                </div>
                <!-- /.login-popup__forms -->

                <div class="login-popup__external">
                    <div class="login-popup__external-title"><?= $externalTitle ?: __('ךרד רבחתה וא', THEME_TD) ?></div>
                    <span>google</span>
                    <span>facebook</span>
                </div>

                <button type="button" class="login-popup__close function-toggle" data-target=".login-popup"
                        data-scroll-stop="true"
                >
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/img/close.svg') ?>
                </button>
            </div>
            <!-- /.login-popup__container -->
        </div>
        <!-- /.login-popup__overlay -->
    </div>
    <!-- /.login-popup -->

<?php endif;


