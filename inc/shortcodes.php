<?php
/**
 * ShortCodes Class
 */
if (!shortcode_exists('smile_wc_login_form') && !function_exists('smile_login_form')) {
    add_shortcode('smile_wc_login_form', 'smile_login_form');
    function smile_login_form()
    {
        global $wp;

        ob_start();
        if (!empty(WC()->session->get('wc_notices', array()))): ?>
            <script>window.isLoginError = true</script>
        <?php endif;
        woocommerce_login_form(['redirect' => home_url($wp->request)]);
        return ob_get_clean();
    }
}

if (!shortcode_exists('smile_wc_registration_form') && !function_exists('smile_registration_form')) {
    add_shortcode('smile_wc_registration_form', 'smile_registration_form');
    function smile_registration_form()
    {
        /// NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php

        $labelsText = get_field('register_form_labels', 'option');
        $user = $labelsText['user'] ?? null;
        $email = $labelsText['email'] ?? null;
        $phone = $labelsText['phone'] ?? null;
        $password = $labelsText['password'] ?? null;
        $submit_button = $labelsText['submit_button'] ?? null;

        ob_start();
        if (!empty(WC()->session->get('wc_notices', array()))): ?>
            <script>window.isLoginError = true</script>
        <?php endif;
//        do_action('woocommerce_before_customer_login_form');
        ?>

        <form method="post"
              class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?> >

            <?php do_action('woocommerce_register_form_start'); ?>

            <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-before input-before--user">
                    <label for="reg_username" class="visually-hidden"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span
                                class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                           id="reg_username" autocomplete="username" placeholder="<?= $user ?: __('אלמ םש', 'woocommerce') ?>"
                           value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                </p>

            <?php endif; ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-before input-before--mail">
                <label for="reg_email" class="visually-hidden"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                       id="reg_email" autocomplete="email" placeholder="<?= $email ?: __('ינורטקלא ראוד', 'woocommerce') ?>"
                       value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine 
                ?>
            </p>

            <p class="form-row input-before input-before--phone">
                <label for="reg_billing_phone" class="visually-hidden"><?php _e('Phone', 'woocommerce'); ?></label>
                <input type="tel" class="input-text" name="billing_phone" id="reg_billing_phone"
                       placeholder="<?= $phone ?: __('דיינ רפסמ', 'woocommerce') ?>"
                       value="<?php esc_attr_e($_POST['billing_phone'] ?? ''); ?>"/>
            </p>

            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-before input-before--password">
                    <label for="reg_password" class="visually-hidden"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp<span
                                class="required">*</span></label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password"
                           id="reg_password" autocomplete="new-password"
                           placeholder="<?= $password ?: __('אמסיס', 'woocommerce') ?>"/>
                </p>

            <?php else : ?>

                <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

            <?php endif; ?>

            <?php do_action('woocommerce_register_form'); ?>

            <p class="woocommerce-form-row form-row">
                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                <button type="submit"
                        class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn"
                        name="register"
                        value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?= $submit_button ?: esc_html__('רבחתהו םשרה', 'woocommerce'); ?></button>
            </p>

            <?php do_action('woocommerce_register_form_end'); ?>

        </form>

        <?php return ob_get_clean();
    }
}
