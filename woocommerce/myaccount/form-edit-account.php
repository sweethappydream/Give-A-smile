<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<h2 class="border-title"><span><?php _e('My Details', THEME_TD); ?></span></h2>
<div class="wrap-account-form">
    <form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

        <?php do_action( 'woocommerce_edit_account_form_start' ); ?>



        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide row-with-icon">
            <?php display_svg(get_template_directory_uri() . '/assets/icon/login.svg'); ?>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" />
        </p>
        <div class="clear"></div>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide row-with-icon">
            <?php display_svg(get_template_directory_uri() . '/assets/icon/mail.svg'); ?>
            <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
        </p>

        <p class="row-with-icon row-with-icon-title change-password">
            <?php display_svg(get_template_directory_uri() . '/assets/icon/password.svg'); ?>
            <?php esc_html_e( 'Password change', 'woocommerce' ); ?>
        </p>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide password-input p-no-icon">

            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" placeholder="<?php esc_html_e( 'Current password', 'New password' ); ?>"/>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide password-input  p-no-icon">

            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" placeholder="<?php esc_html_e( 'Confirm new password', 'New password' ); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide password-input  p-no-icon">
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" placeholder="<?php esc_html_e( 'Confirm new password', THEME_TD ); ?>" />
        </p>

        <div class="clear"></div>

        <?php do_action( 'woocommerce_edit_account_form' ); ?>

        <p class="wrap-submit-btn">
            <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
            <button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
            <input type="hidden" name="action" value="save_account_details" />
        </p>

        <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </form>
</div>


<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
