<?php

get_header();

?>
<?php
    $taxonomy = get_queried_object();
//    debug($taxonomy);
?>
<div class="section term-section">
    <div class="container">
        <h1><?= $taxonomy->name;; ?></h1>
        <?php if($taxonomy->description):?>
            <div class="wrap-subtitle">

                <p class="subtitle"><?= $taxonomy->description; ?></p>
            </div>
        <?php endif?>

        <div class="row">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?><!-- BEGIN of Post -->
                    <?php get_template_part('template-parts/gifts-item', null, ['id' => get_the_ID()]) ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>




<?php get_footer(); ?>
