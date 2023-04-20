<?php
/**
 * Template Name: Wishlist
 */
get_header();

?>

    <section class="wish-list">
        <div class="container">
            <h1><?php the_title(); ?></h1>

            <div class="wrap-subtitle">
                <p class="subtitle"><?php _e('Your wishlist products are here', THEME_TD); ?></p>
            </div>

            <?php
            if (is_user_logged_in()) {
                $user_id = get_current_user_id();
                $arr_wish = get_user_meta($user_id, 'wish_list', true);
            }
            ?>
            <?php if (isset($arr_wish) && is_array($arr_wish) && $arr_wish): ?>
                <div class="row">
                    <?php foreach ($arr_wish as $item): ?>
                        <?php get_template_part('template-parts/gifts-item', null, ['id' => $item]) ?>
                    <?php endforeach; ?>
                </div>
            <?php elseif (!is_user_logged_in()): ?>
                <div class="no-wishlist no-log">
                    <p><?php _e('You are not logged in', THEME_TD); ?></p>
                    <a  data-target=".login-popup" data-modal="#login-popup" href="<?= home_url(); ?>" class="btn site-login function-toggle"><?php _e('Login', THEME_TD); ?></a>
                </div>
            <?php else: ?>
                <div class="no-wishlist">
                    <p>
                        <?php _e('You haven\'t saved the gifts you like...', THEME_TD); ?>
                    </p>
                    <img src="<?= get_template_directory_uri() . '/assets/img/no-wishlist.png'; ?>" alt="">
                    <a href="<?= home_url(); ?>" class="btn"><?php _e('All gifts', THEME_TD); ?></a>
                </div>

            <?php endif ?>

        </div>
    </section>

<?php get_footer(); ?>