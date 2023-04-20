<?php
$loginLink = get_permalink(wc_get_page_id('myaccount'));
$isUserLoggedIn = is_user_logged_in();
$current_lang = apply_filters( 'wpml_current_language', NULL );
$wishlistUrl = wc_get_account_endpoint_url('wishlist');

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<!---->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (is_page(738)) {
    wp_print_scripts('smile');
} ?>
<?php get_template_part('template-parts/modal'); ?>
<header class="site-header">
	<a class="screen-reader-text" href="#main">Skip to main content</a>
    <div class="container">
        <div class="site-header__row">
            <div class="site-header__col">
                <div class="site-logo"><?= get_custom_logo() ?></div>
                <div class="site-lang lg-hide">
                    <?= file_get_contents(get_stylesheet_directory() . '/assets/img/world.svg') ?>
                    <?= do_shortcode('[wpml_language_selector_widget]'); ?>
                </div>
            </div>
            <!-- /.site-header__col -->

            <div class="site-header__col site-menu lg-hide">
                <nav>
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
                </nav>

                <?php if ($loginLink && !$isUserLoggedIn): ?>
                    <a href="<?= get_permalink(wc_get_page_id('myaccount')) ?>"
                       class="site-login btn btn--small function-toggle"
                       data-modal="#login-modal"
                    >
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        <?php _e('LOGIN', THEME_TD) ?>
                    </a>
                <?php elseif ($isUserLoggedIn): ?>

                    <?php if($wishlistUrl):?>
                        <a class="wish-list-link-header" href="<?=$wishlistUrl; ?>"> <?php display_svg(get_template_directory_uri() . '/assets/icon/list.svg'); ?></a>
                    <?php endif?>

                    <div class="login-menu">
                        <div class="login-menu__absolute btn btn--transparent btn--small">
                            <span class="login-menu__title">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <?php if ($current_lang == 'he'): ?>
                                    <span class="login-menu__name"><?php echo wp_get_current_user()->display_name; ?>, <?php _e('Hi', THEME_TD) ?></span>
                                <?php else: ?>
                                    <span class="login-menu__name"><?php _e('Hi', THEME_TD) ?>, <?php echo wp_get_current_user()->display_name; ?></span>
                                <?php endif; ?>
                            </span>

                            <div>
                                <?php
                                wp_nav_menu([
                                    'theme_location' => 'login_menu',
                                    'menu' => '',
                                    'container' => false,
                                    'menu_class' => 'login-menu__menu',
                                    'echo' => true,
                                    'depth' => 1,
                                ]);
                                ?>
                            </div>
                        </div>
                        <!-- /.login-menu__relative -->
                    </div>
                    <!-- /.login-menu -->
                <?php endif; ?>
            </div>
            <!-- /.site-header__col -->

            <button type="button" class="site-burger lg-show" data-modal="#mobile-menu">
                <?= file_get_contents(get_stylesheet_directory() . '/assets/img/burger.svg') ?>
            </button>
            <?php if($isUserLoggedIn && $wishlistUrl):?>
                <a class="wish-list-link-header mobile" href="<?=$wishlistUrl; ?>"> <?php display_svg(get_template_directory_uri() . '/assets/icon/list.svg'); ?></a>
            <?php endif?>
        </div>
    </div><!-- /.container -->

    <?php get_template_part('template-parts/mobile-menu', null, ['loginLink' => $loginLink]); ?>
</header>
<main>
