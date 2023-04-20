<?php
/**
 * Template Name: Cron Template
 */
get_header();
?>
<?php
$orders = wc_get_orders(array(
    'status' => 'processing',
    'return' => 'ids',
    'limit' => -1,
));

if ($orders) {
    foreach ($orders as $order_id) {
        $send_date = get_post_meta($order_id, 'time_send', true);

        if ($send_date && $send_date !== 'now') {
            $current_timestamp = time();
            $send_date_timestamp = DateTime::createFromFormat('m/d/Y H:i', $send_date)->getTimestamp();
            $diff = $send_date_timestamp - $current_timestamp;

            if ($diff < 3600 || $diff < 0) {
                $order_receivers = get_post_meta($order_id, 'order_receivers', true);
                $post_data = get_post_meta($order_id, 'sender_data', true);
                $type_send = get_post_meta($order_id, 'type_send', true);
                $file_url = get_post_meta($order_id, 'file_url', true);


                if ($order_receivers) {
                    sendAllCard($order_receivers, $type_send, null, $order_id, $file_url, $post_data);
                }

            }
        }
    }
}
?>

<?php get_footer(); ?>