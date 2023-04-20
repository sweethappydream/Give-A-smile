<?php
$slug = 'partners';
$term_id = get_queried_object_id();
$term_id_prefixed = $slug .'_'. $term_id;
$project_of_the_month = get_field( 'project_of_the_month', 'option' );
$project_of_the_month_ids = [];
if ($project_of_the_month) {
    foreach ($project_of_the_month as $project) {
        $project_of_the_month_ids[] = $project->ID;
    }
}

?>
<?php get_header(); ?>
<?php if ( have_rows( 'banner_settings', $term_id_prefixed ) ) : ?>
<?php while ( have_rows( 'banner_settings', $term_id_prefixed ) ) : the_row(); ?>
<section class="breadcrumb">
    <div class="container">
        <?php woocommerce_breadcrumb(); ?>
    </div>
</section>
<section class="<?= $slug ?>">
    <div class="container">
        <div class="<?= $slug . '-banner__row' ?>">
            <div class="<?= $slug . '-banner__info' ?>">
                <h1 class="title"><?php the_sub_field( 'title' ); ?></h1>
                <p class="only-d"><?php the_sub_field( 'descriptions' ); ?></p>
            </div>
            <div class="<?= $slug . '-banner__logo' ?>">
                <?php $image = get_sub_field( 'image' ); ?>
                <?php if ( $image ) : ?>
                    <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endwhile; ?>
<?php endif; ?>
<section class="<?= $slug . '__gifts' ?>">
    <div class="container">
        <?php if ( have_rows( 'banner_settings', $term_id_prefixed ) ) : ?>
            <?php while ( have_rows( 'banner_settings', $term_id_prefixed ) ) : the_row(); ?>
                <p class="only-m"><?php the_sub_field( 'descriptions' ); ?></p>
            <?php endwhile; ?>
        <?php endif; ?>
        <h2 class="title"><?php _e('Foundation projects', 'smile'); ?></h2>
        <div class="row gifts">
            <?php
            if ( woocommerce_product_loop() ) {
                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );
                        if (in_array(get_the_ID(), $project_of_the_month_ids)) {
                            get_template_part('template-parts/gifts-item', null, compact('project_of_the_month'));
                        }
                    }
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );

                        if (!in_array(get_the_ID(), $project_of_the_month_ids)) {
                            get_template_part('template-parts/gifts-item', null, compact('project_of_the_month'));
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
