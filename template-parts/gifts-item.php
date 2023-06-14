<?php
/**
 * Gifts Item Loop
 */
defined('ABSPATH') || exit;

$current_lang = $_COOKIE['wp-wpml_current_language'];

if (isset($args['id']) && $args['id']) {
    $product = wc_get_product($args['id']);
} else {
    global $product;
}



if (isset($args['auth']) && $args['auth']) {
    $auth = $args['auth'];
} else {
    $auth = false;
}
if (isset($args['user_id']) && $args['user_id']) {
    $user_id = $args['user_id'];
} else {
    $user_id = get_current_user_id();
}
$lang_prod_id = apply_filters( 'wpml_object_id', $product->get_id(), 'product', false, $current_lang );

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
$project_of_the_month = [];
if (isset($args['project_of_the_month']) && $args['project_of_the_month']) {
    foreach ($args['project_of_the_month'] as $project) {
        $project_of_the_month[] = $project->ID;
    }
}
$is_product_of_month = in_array($product->get_id(), $project_of_the_month);
// Get product categories
        $categories = wp_get_post_terms($lang_prod_id, 'partners');

?>
<?php if ($is_product_of_month) : ?>
    <li <?php wc_product_class('col col-3 gifts__item project-month', $product); ?>>
    <?php else : ?>
        <li <?php wc_product_class('col col-3 gifts__item', $product); ?>>
        <?php endif; ?>

        <div class="gifts__image" data-id="<?= $product->get_id(); ?>">
            <a href="<?= get_the_permalink( $lang_prod_id ); ?><?=(isset($_GET['gift']) && is_can_to_use_coupon($_GET['gift'])) ? '?gift='.filter_var($_GET['gift']) : '';?>" tabindex="-1">
                <?php if ($project_of_the_month) : ?>
                    <?php if ($is_product_of_month) : ?>
                        <div class="gifts__month">
                            <span><?php _e('Project of the Month', THEME_TD) ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (is_user_logged_in() || $auth) : ?>
                    <div class="favorites <?= checkFavoriteProduct($product->get_id(), $user_id); ?>" role="button" aria-label="<?php _e('Add to wishlist', THEME_TD) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="21.48" viewBox="0 0 23 21.48">
  <path id="Icon_ionic-md-heart-empty" data-name="Icon ionic-md-heart-empty" d="M19.325,4.5a6.507,6.507,0,0,0-4.95,2.322A6.507,6.507,0,0,0,9.425,4.5a5.981,5.981,0,0,0-6.05,6.087c0,4.2,3.739,7.578,9.4,12.782l1.6,1.438,1.6-1.438c5.664-5.2,9.4-8.578,9.4-12.782A5.981,5.981,0,0,0,19.325,4.5Z" transform="translate(-2.875 -4)" fill="currentcolor" stroke="currentcolor" stroke-width="1"/>
</svg>


                    </div>
                <?php endif ?>


                <?= $product->get_image() ?>
                 </a>
			<?php
$partner_logo = get_field('partner_logo', 'partners_' . $taxonomy->term_id);
if($partner_logo) {
?>
    <img src="<?= $partner_logo['url']; ?>" alt="<?= $partner_logo['alt']; ?>" />
<?php
}
?>
				
  <?php
  foreach ($categories as $category) {
    $category_link = get_term_link($category); // Get the link to the category archive page
    echo '<a class="span-cat" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a> '; // Wrap the category name in an <a> tag
  }
  ?>
				
                   <h3 class="title">
  					<a  data-lang="<?php echo $current_lang; ?>" href="<?= get_the_permalink( $lang_prod_id ); ?><?=(isset($_GET['gift']) && is_can_to_use_coupon($_GET['gift'])) ? '?gift='.filter_var($_GET['gift']) : '';?>">
    				<?php echo mb_strimwidth(get_the_title( $lang_prod_id ), 0, 65, "..."); ?> 
  					</a>
					</h3>

              
		
        </div>

    <?php
    $units_sold = $product->get_total_sales();
    echo '<p class="gifts__counter">' . sprintf(__('The gift was bought <span class="units-sold">%s</span> times', 'woocommerce'), $units_sold) . '</p>';
    ?>


        </li>