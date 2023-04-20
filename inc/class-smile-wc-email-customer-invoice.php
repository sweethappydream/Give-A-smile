<?php
include(WP_PLUGIN_DIR . '/woocommerce/includes/emails/class-wc-email.php');
include(WP_PLUGIN_DIR . '/woocommerce/includes/emails/class-wc-email-customer-invoice.php');


class Smile_WC_Email_Customer_Invoice extends WC_Email_Customer_Invoice {
    /**
     * Trigger the sending of this email.
     *
     * @param int      $order_id The order ID.
     * @param WC_Order $order Order object.
     * @param string|null $recipient_email customer email.
     */
    public function trigger($order_id, $order = false, string $recipient_email = null ) {
        $this->setup_locale();

        if ( $order_id && ! is_a( $order, 'WC_Order' ) ) {
            $order = wc_get_order( $order_id );
        }

        if ( is_a( $order, 'WC_Order' ) ) {
            $this->object                         = $order;
            $this->recipient                      = $recipient_email ?: $this->object->get_billing_email();
            $this->placeholders['{order_date}']   = wc_format_datetime( $this->object->get_date_created() );
            $this->placeholders['{order_number}'] = $this->object->get_order_number();
        }

        if ( $this->get_recipient() ) {
            $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        }

        $this->restore_locale();
    }
}
