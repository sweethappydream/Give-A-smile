<?php
$contacts = [
    'tel' => get_field('opt_contacts_phone', 'option'),
    'email' => get_field('opt_contacts_email', 'option'),
    'facebook' => get_field('opt_contacts_facebook', 'option'),
    'instagram' => get_field('opt_contacts_instagram', 'option'),
];
global $sitepress;
$sitepress->switch_lang(ICL_LANGUAGE_CODE);
$copyright = get_field('footer_copyright', 'option');
$acf_title = get_field('acf_title', 'option');
$logo = get_field('logo_footer', 'option');
$image = get_field('image_footer', 'option');
$button_label = get_field('button_label', 'option');
$button_link = get_field('button_link', 'option');
?>

</main>

<footer class="site-footer">
    <div class="container footers">
        <?php if ($acf_title) : ?>
            <h3 class="site-footer__title"><?= $acf_title ?></h3>
        <?php endif; ?>

        <?php if ($logo) : ?>
            <div class="site-footer__logo">
                <img src="<?= $logo ?>" alt="Logo">
            </div>
        <?php endif; ?>

        <?php if (has_nav_menu('footer_menu')) : ?>
            <nav aria-label="footer">
                <?php wp_nav_menu([
                    'theme_location' => 'footer_menu',
                    'menu' => '',
                    'container' => false,
                    'menu_class' => 'site-footer__menu',
                    'echo' => true,
                    'depth' => 1,
                ]); ?>
            </nav>
        <?php endif; ?>

        <?php if (!empty($contacts)) : ?>
            <div class="c-social">
                <?php foreach ($contacts as $key => $contact) :
                    if (!empty($contact)) : ?>
                        <a href="<?= $contact['url'] ?: '#' ?>" class="c-social__item" <?= $contact['target'] ? 'target="_blank" rel="nofollow"' : '' ?>>
                            <div class="c-social__icon">
                                <?= file_get_contents(get_stylesheet_directory() . '/assets/img/contact-' . $key . '.svg') ?>
                            </div>
                            <span class="c-social__title"><?= $contact['title'] ?: '' ?></span>
                        </a>
                    <?php endif;
                endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($image && $button_label && $button_link) : ?>
            <div class="site-footer__image-button">
                <img src="<?= $image ?>" alt="Image">
                <a href="<?= $button_link ?>" class="site-footer__button"><?= $button_label ?></a>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.container -->

    <?php if ($copyright) : ?>
        <div class="container copyright">
            <?= $copyright; ?>
            <?php echo do_shortcode('[currency_switcher]'); ?>
        </div>
    <?php endif ?>
</footer>
<?php wp_footer(); ?>

</body>

</html>
