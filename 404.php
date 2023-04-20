<?php
/**
 * page 404
 */
get_header(); ?>


    <section class="error-404 not-found">

        <div class="container">
            <div class="page-content">
                <div class="error-page-titles">
                    <h1 class="error-page">404</h1>
                    <div class="error-subtitle"><?= __('Page Not Found', THEME_TD); ?></div>
                    <a href="<?= home_url(); ?>" class="btn"><?= __('Home', THEME_TD); ?></a>
                </div>

            </div><!-- .page-content -->
        </div>

    </section><!-- .error-404 -->

<?php
get_footer();