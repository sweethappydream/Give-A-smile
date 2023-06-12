<?php
/**
 * My account Wishlist tab
 */
defined('ABSPATH') || exit;

?>
<section class="wish-list">
        <h2 class="border-title"><span><?php _e('My Wishlist', THEME_TD); ?></span></h2>

        <?php
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $arr_wish = get_user_meta($user_id, 'wish_list', true);
        }
        ?>
        <?php if (isset($arr_wish) && is_array($arr_wish) && $arr_wish): ?>
            <ul class="row gifts home-gifts">
                <?php foreach ($arr_wish as $item): ?>
                    <?php get_template_part('template-parts/gifts-item', null, ['id' => $item]) ?>
                <?php endforeach; ?>
                </ul>
        <?php elseif (!is_user_logged_in()): ?>
            <div class="no-wishlist no-log">
                <p><?php _e('You are not logged in', THEME_TD); ?></p>
                <a  data-target=".login-popup" data-modal="#login-popup" href="<?= home_url(); ?>" class="btn site-login function-toggle"><?php _e('Login', THEME_TD); ?></a>
            </div>
        <?php else: ?>
            <div class="no-wishlist">
                <p>
                    <?php _e('You Still Haven’t Saved your Favorite Gifts…', THEME_TD); ?>
                </p>
                <img src="<?= get_template_directory_uri() . '/assets/img/no-wishlist.png'; ?>" alt="">
                <a href="<?= home_url(); ?>" class="btn"><?php _e('To Homepage', THEME_TD); ?></a>
            </div>

        <?php endif ?>
</section>
