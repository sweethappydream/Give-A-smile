<?php

/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
    return;
}

$labelsText = get_field('login_form_labels', 'option');
$email = $labelsText['email'] ?? null;
$password = $labelsText['password'] ?? null;
$checkbox = $labelsText['checkbox'] ?? null;
$lostPwd = $labelsText['lost_password_link'] ?? null;
$submit = $labelsText['submit_button'] ?? null;

?>
<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ($hidden) ? 'style="display:none;"' : ''; ?>>

    <?php do_action('woocommerce_login_form_start'); ?>

    <?php echo ($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine 
    ?>

    <p class="form-row form-row-first input-before input-before--mail">
        <label for="username" class="visually-hidden"><?php esc_html_e('Username or email', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="input-text" name="username" id="username" autocomplete="username" placeholder="<?= $email ?: __('Email or Username', 'woocommerce') ?>" />
    </p>
    <p class="form-row form-row-last input-before input-before--password">
        <label for="password" class="visually-hidden"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input class="input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?= $password ?: __('password', 'woocommerce') ?>" />
    </p>
    <div class="clear"></div>

    <?php do_action('woocommerce_login_form'); ?>

    <p class="form-row form-row--flex form-row--last">
        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
        <label for="rememberme" class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
            <span class="checker"></span>
            <span><?= $checkbox ?: esc_html__('Remember me', 'woocommerce'); ?></span>
        </label>
        <span class="lost_password">
            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?= $lostPwd ?: esc_html__('Forgot password', 'woocommerce'); ?></a>
        </span>

        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
        <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />
    </p>

    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn" name="login" value="<?php esc_attr_e('Login', 'woocommerce'); ?>">
        <?= $submit ?: esc_html__('Login', 'woocommerce'); ?>
    </button>

    <?php do_action('woocommerce_login_form_end'); ?>

</form>
