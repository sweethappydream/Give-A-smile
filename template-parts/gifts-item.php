<?php
/**
 * Gifts Item Loop
 */
defined('ABSPATH') || exit;

if (isset($args['id']) && $args['id']) {
    $product = wc_get_product($args['id']);
} else {
    global $product;
}


if (isset($args['auth']) && $args['auth']) {
    $auth = $args['auth'];
} else {
    $auth = false;
}
if (isset($args['user_id']) && $args['user_id']) {
    $user_id = $args['user_id'];
} else {
    $user_id = get_current_user_id();
}


// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
$project_of_the_month = [];
if (isset($args['project_of_the_month']) && $args['project_of_the_month']) {
    foreach ($args['project_of_the_month'] as $project) {
        $project_of_the_month[] = $project->ID;
    }
}
$is_product_of_month = in_array($product->get_id(), $project_of_the_month);
?>
<?php if ($is_product_of_month) : ?>
    <div <?php wc_product_class('col col-3 gifts__item project-month', $product); ?>>
    <?php else : ?>
        <div <?php wc_product_class('col col-3 gifts__item', $product); ?>>
        <?php endif; ?>

        <div class="gifts__image" data-id="<?= $product->get_id(); ?>">
            <a href="<?= $product->get_permalink(); ?><?=(isset($_GET['gift']) && is_can_to_use_coupon($_GET['gift'])) ? '?gift='.filter_var($_GET['gift']) : '';?>">
                <?php if ($project_of_the_month) : ?>
                    <?php if ($is_product_of_month) : ?>
                        <div class="gifts__month">
                            <span><?php _e('Project of the Month', THEME_TD) ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (is_user_logged_in() || $auth) : ?>
                    <div class="favorites <?= checkFavoriteProduct($product->get_id(), $user_id); ?> ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="21" viewBox="0 0 23 21" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0313 1.05881C14.789 0.744847 15.6011 0.583252 16.4213 0.583252C17.2415 0.583252 18.0536 0.744847 18.8113 1.05881C19.5689 1.37271 20.2572 1.83276 20.837 2.4127C21.4169 2.99246 21.8773 3.68109 22.1912 4.43866C22.5052 5.19637 22.6667 6.00852 22.6667 6.8287C22.6667 7.64888 22.5052 8.46102 22.1912 9.21873C21.8773 9.97637 21.4172 10.6647 20.8371 11.2445L12.3457 19.736C11.9706 20.1111 11.3624 20.1111 10.9873 19.736L2.49585 11.2445C1.32469 10.0734 0.666748 8.48496 0.666748 6.8287C0.666748 5.17244 1.32469 3.58402 2.49585 2.41286C3.667 1.24171 5.25542 0.583766 6.91168 0.583766C8.56794 0.583766 10.1564 1.24171 11.3275 2.41286L11.6665 2.75184L12.0053 2.41302C12.5851 1.83301 13.2736 1.37273 14.0313 1.05881ZM16.4213 2.50439C15.8535 2.50439 15.2912 2.61626 14.7667 2.83362C14.2421 3.05097 13.7655 3.36955 13.3641 3.77115L12.3457 4.78951C11.9706 5.16464 11.3624 5.16464 10.9873 4.78951L9.96906 3.77131C9.1582 2.96044 8.05842 2.5049 6.91168 2.5049C5.76494 2.5049 4.66516 2.96044 3.85429 3.77131C3.04343 4.58218 2.58788 5.68196 2.58788 6.8287C2.58788 7.97544 3.04343 9.07521 3.85429 9.88608L11.6665 17.6983L19.4787 9.88608C19.8803 9.48467 20.199 9.00791 20.4164 8.48334C20.6337 7.95877 20.7456 7.39651 20.7456 6.8287C20.7456 6.26088 20.6337 5.69863 20.4164 5.17406C20.199 4.64949 19.8804 4.17288 19.4788 3.77147C19.0774 3.36987 18.6005 3.05097 18.0759 2.83362C17.5514 2.61626 16.9891 2.50439 16.4213 2.50439Z" fill="#E80866" />
                        </svg>
                    </div>
                <?php endif ?>


                <?= $product->get_image() ?>
                <div class="title-wrapper">
                    <h3 class="title">
                    <?php
                     $title = $product->get_title();
                      echo mb_strimwidth($title, 0, 65, "...");
                    ?>

                    </h3>
                </div>
            </a>
        </div>
        <div class="gifts__counter">
            <?php
            $units_sold = $product->get_total_sales();
            echo '<p>' . sprintf(__('The gift was bought %s times', 'woocommerce'), $units_sold) . '</p>';
            ?>
        </div>
        </div>