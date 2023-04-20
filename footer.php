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

?>
</main>

<footer class="site-footer">
    <?php if (has_nav_menu('footer_menu') || !empty($contacts)): ?>
        <div class="container">
            <?php if (has_nav_menu('footer_menu')): ?>
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

            <?php if (!empty($contacts)): ?>
                <div class="c-social">
                    <?php foreach ($contacts as $key => $contact):
                        if (!empty($contact)): ?>
                            <a
                                    href="<?= $contact['url'] ?: '#' ?>"
                                    class="c-social__item"
                                <?= $contact['target'] ? 'target="_blank" rel="nofollow"' : '' ?>
                            >
                                <div class="c-social__icon">
                                    <?= file_get_contents(get_stylesheet_directory() . '/assets/img/contact-' . $key . '.svg') ?>
                                </div>

                                <span class="c-social__title"><?= $contact['title'] ?: '' ?></span>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.container -->
    <?php endif; ?>

    <?php // get_template_part('template-parts/login-popup'); ?>

    <?php if ($copyright): ?>
        <div class="container copyright">
            <?= $copyright; ?>
			<?php
    //echo do_shortcode('[yaycurrency-switcher]');
			echo do_shortcode('[currency_switcher]');
?>
        </div>
    <?php endif ?>
</footer>
<?php wp_footer(); ?>

</body>
</html>