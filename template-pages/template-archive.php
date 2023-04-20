<?php
/**
 * Template Name: archive page
 */
get_header();

?>
<main class="p-archive">
  <section class="l-head-image">
    <div class="container">
      <?php woocommerce_breadcrumb(); ?>

      <div class="l-head-image__img">
        <p class="l-head-image__title"><?php _e('Selecting a project to donate', THEME_TD); ?></p>
        <img class="l-head-image__img-desctop" src="<?php echo get_template_directory_uri(); ?>/assets/img/gift-img.jpg" alt="magic gift">
        <img class="l-head-image__img-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/img/gift-img-mobile.jpg" alt="magic gift">
      </div> 
    </div>
  </section>

  <div class="c-section-title">
    <div class="container">
      <h1 class="our-projects"><?php _e('Our Projects', THEME_TD); ?></h1> 
    </div>
  </div>

  <?php while (have_posts()) {
        the_post();
        the_content();
    }
    ?>
</main>

<?php get_footer(); ?>