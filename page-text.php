<?php /* Template Name: Text Page */ ?>

<?php get_header(); ?>

    <section class="page-title">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>
    <section class="page-content">
        <div class="container">
            <?php while (have_posts()) {
                the_post();
                the_content();
            }
            ?>
        </div>
    </section>

<?php get_footer(); ?>