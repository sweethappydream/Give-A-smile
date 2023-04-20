<?php
/**
 * Step 1
 */
$partner_terms = get_the_terms( $post->ID , 'partners' );
$partners_detail = false;
$description_of_the_partner = false;
$partners_photo_images = false;
$logo = false;
if ($partner_terms) {
  $term_id = $partner_terms[0]->term_id;

  $partners_detail = get_field('partner_details', 'term_' . $term_id);
  $description_of_the_partner = get_field('short_text', 'term_' . $term_id);
  $partners_photo_images = get_field('partners_photo', 'term_' . $term_id);
  $logo = get_field('partner_logo', 'term_' . $term_id);
  $logo_src = wp_get_attachment_image_src($logo, 'full');
  $partnerTextForSvg = get_field('description_of_the_partner', 'term_' . $term_id);
}

?>
<div class="steps-list__item step1 show-step">
  <div class="product-step1__row">
    <div class="product-step1__info">
      <div class="title-subtitle">
        <h1 class="block-title"><?= (get_field('product_title')) ? get_field('product_title') : get_the_title(); ?></h1>
        <div class="subtitle"><?php the_field('product_description'); ?>
      </div>
    </div>
    <div class="product-step1__accordion">
      <?php if ($partners_detail) : ?>
          <?php if ($partners_detail['association_name'] && $partners_detail['registration_number']) : ?>
          <div class="accordion-item">
            <div class="accordion-title">
              <p><?php _e('Non-profit organization', THEME_TD) ?></p>
            </div>
            <div class="accordion-content">
              <div>
                <div class="description-wrapper">
                  <div class="description">
                    <p>
                      <span><?php _e('Name', THEME_TD) ?></span><span><?php echo $partners_detail['association_name']; ?></span>
                    </p>
                    <p>
                      <span><?php _e('Registration number', THEME_TD) ?></span><span><?php echo $partners_detail['registration_number']; ?></span>
                    </p>
                    <?php if ($partners_detail['website']): ?>
                      <p><span><?php _e('Website', THEME_TD) ?></span><span><a
                        href="<?php echo $partners_detail['website']; ?>"
                        target="_blank"
                        rel="nofollow"><?php echo $partners_detail['website']; ?></a></span>
                      </p>
                    <?php endif; ?>
                  </div>
                  <?php if ($logo) : ?>
                    <div class="logo">
                      <?php echo wp_get_attachment_image($logo, 'full'); ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($description_of_the_partner) : ?>
      <div class="accordion-item">
        <div class="accordion-title">
          <p><?php _e('Description', THEME_TD) ?></p>
        </div>
        <div class="accordion-content">
          <div>
            <p><?php echo $description_of_the_partner; ?></p>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <?php if ($partners_photo_images) : ?>
      <div class="accordion-item">
        <div class="accordion-title">
          <p><?php _e('Photos', THEME_TD) ?></p>
        </div>
        <div class="accordion-content">
          <div>
            <div class="accordion-img-slider swiper">
              <div class="swiper-wrapper">
              <?php foreach ($partners_photo_images as $partners_photo_image) : ?>
                <a class="swiper-slide" href="<?php echo esc_url($partners_photo_image['sizes']['large']); ?>">
                  <img 
                    src="<?php echo esc_url($partners_photo_image['sizes']['thumbnail']); ?>"
                    alt="<?php echo esc_attr($partners_photo_image['alt'] ? $partners_photo_image['alt'] : $partners_photo_image['title']); ?>"/>
                </a>
              <?php endforeach; ?>
              </div>
            </div>
            <div class="preloader loading">
              <div class="lds-ripple">
                <div></div>
                <div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="product-step1__price">
  <div class="product-step1__price-list">
    <?php foreach ($variation_products as $index => $vproduct_id) : ?>
      <?php $vproduct = wc_get_product($vproduct_id); ?>
      <div class="product-step1__price-item <?php echo $index > 2 ? 'hidden' : ''; ?>">
        <div class="price-item__row">
          <div class="price-description">
            <div class="price-description__wrapper">
              <p><?php echo $vproduct->get_description(); ?></p>

              <?php if (!in_array($vproduct->get_attribute('Donation type'), ['מחיר מיוחד', 'Custom price'])) : ?>
                <p><?php echo $vproduct->get_price_html() ?></p>
              <?php endif; ?>
            </div>
            <div class="price-description__btn <?php echo in_array($vproduct->get_attribute('Donation type'), ['מחיר מיוחד', 'Custom price']) ? 'custom-price' : 'regular-price'; ?>">
              <?php if (in_array($vproduct->get_attribute('Donation type'), ['מחיר מיוחד', 'Custom price'])) : ?>
                <?php $product_min_price = get_post_meta($vproduct_id, 'donate_min_price', true); ?>
                <div class="custom-price-wrap">
                  <input type="number" step="any"
                  min="<?php echo strlen(wp_kses_post($product_min_price)) === 0 ? 0 : wp_kses_post($product_min_price); ?>"
                  data-product_id="<?php echo wp_kses_post($vproduct_id); ?>"
                  class="custom-price"
                  value="<?php echo strlen(wp_kses_post($product_min_price)) === 0 ? 0 : wp_kses_post($product_min_price); ?>"
                  name="<?php echo 'custom_price_field_' . wp_kses_post($vproduct_id); ?>"/>
				<span class="before-currency"> <?php echo get_woocommerce_currency_symbol(); ?> </span>
                  <span class="error">
                    <?php echo sprintf(esc_html__('Price is required and should be more then %1$s', 'smile'), strlen(wp_kses_post($product_min_price)) === 0 ? 0 : wp_kses_post($product_min_price)); ?><?php echo get_woocommerce_currency_symbol(); ?></span>
                  </div>
                  <a href="#" class="btn btn--thin donate-btn"
                  data-vproduct-id="<?= $vproduct_id; ?>"
                  data-title="<?php echo $vproduct->get_description(); ?>"><?php _e('Select', THEME_TD) ?></a>
                <?php else : ?>
                  <a href="#" class="btn btn--thin" 
                  data-modal="#product-modal" 
                  data-vproduct-id="<?= $vproduct_id; ?>"
                  data-title="<?php echo $vproduct->get_description(); ?>"
                  data-price="<?php echo $vproduct->get_price(); ?>"><?php _e('Select', THEME_TD) ?></a>
                <?php endif; ?>

              </div>
            </div>
            <div class="product-image">
              <?php echo $vproduct->get_image(); ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if (count($variation_products) > 3) : ?>
        <div class="product-step1__price-item-btn">
          <a href="#" class="load-more"
          data-product-id="<?php echo $product->get_id(); ?>"><?php _e('More options', THEME_TD) ?></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>