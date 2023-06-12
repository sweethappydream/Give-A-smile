<?php
/** 
 * Mobile Menu
 */
$loginLink = $args['loginLink'] ?? null;
?>

<div class="mobile-menu lg-show">
    <div class="container">
        <div class="site-lang">
            <?= file_get_contents(get_stylesheet_directory() . '/assets/img/world.svg') ?>
            <?= do_shortcode('[wpml_language_selector_widget]'); ?>
        </div>

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

        <?php if ($loginLink): ?>
            <a href="<?= get_permalink(wc_get_page_id('myaccount')) ?>" class="site-login btn btn--small">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                <?php _e('LOGIN', THEME_TD) ?>
            </a>
        <?php endif; ?>
    </div>
    <!-- /.container -->
</div>
<!-- /.mobile-menu -->