<section class="product-header">
    <div class="container">
        <div class="custom-breadcrums">
            <a href="<?= home_url(); ?>"><?php _e('Home'); ?></a>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <?php
            global $woocommerce;
            $items = $woocommerce->cart->get_cart();
            $product_id = '';
            foreach ($items as $item => $values) {
                $_product = wc_get_product($values['data']->get_id());
                $getProductDetail = wc_get_product($values['product_id']);
//                echo "<a href='".strtok($_product->get_permalink(), '?')."'>" . $_product->get_title() . "<a>";
                echo '<span>'.$_product->get_title().'</span>';
                break;
            }
            ?>


        </div>
        <div class="product-banner <?= get_field('product_type', get_the_ID()); ?>" style="display: none">
            <div class="product-banner__content">
                <p class="product-banner__subtitle subtitle"></p>
                <p class="product-banner__title"><?php the_title(); ?></p>
                <p class="product-banner__price"><?= __('At a value of', THEME_TD) . ' ' ?><span
                            class="price"></span> <?= get_woocommerce_currency_symbol(); ?></p>
            </div>
        </div>
        <div class="product-steps">
            <a href="#" class="product-steps__item active" data-steps-item="1">
                <div class="product-steps__item-icon">
                    <div>
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/sp-icon1.svg" alt="icon1">
                    </div>
                </div>
                <p><?php _e('Choose a gift', THEME_TD) ?></p>
            </a>
            <a href="#" class="product-steps__item active" data-steps-item="2">
                <div class="product-steps__item-icon">
                    <div>
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.1173 1.70697H3.69954V23.1264H21.1173V1.70697Z" fill="white"/>
                            <path id="path-mail"
                                  d="M12.8566 18.4368L24.6804 8.48926L24.6747 25.0283H0.972419V8.48926L12.8239 18.4368H12.8566Z"
                                  fill="#C4C4C4"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M24.8737 8.07417C25.0356 8.14932 25.1391 8.31136 25.139 8.48953L25.1333 25.0286C25.1332 25.2814 24.9279 25.4864 24.6746 25.4864H0.972264C0.718901 25.4864 0.51351 25.2813 0.51351 25.0284V8.48938C0.51351 8.31132 0.616901 8.14941 0.778599 8.07425C0.940296 7.99908 1.13098 8.02429 1.2675 8.13888L12.8398 17.8521L24.3846 8.13922C24.5211 8.02439 24.7119 7.99901 24.8737 8.07417ZM1.43102 9.47274V24.5705H24.216L24.2212 9.47452L13.1521 18.7871C13.0694 18.8567 12.9647 18.8949 12.8565 18.8949H12.8238C12.7158 18.8949 12.6112 18.8568 12.5285 18.7874L1.43102 9.47274Z"
                                  fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12.589 0.212244C12.6644 0.162005 12.753 0.135193 12.8437 0.135193H12.86C12.9508 0.135193 13.0395 0.162046 13.1149 0.212357L24.8997 8.07189C25.0102 8.12155 25.0992 8.21411 25.1426 8.33271C25.2086 8.51351 25.1543 8.71622 25.0068 8.84006L16.8343 15.6997L25.0147 24.7213C25.1847 24.9088 25.1703 25.1984 24.9824 25.3681C24.7946 25.5378 24.5045 25.5234 24.3344 25.3359L16.1315 16.2895L13.1553 18.7876C13.0726 18.857 12.9681 18.8951 12.86 18.8951H12.8273C12.7193 18.8951 12.6148 18.857 12.5321 18.7876L9.53305 16.2704L1.31238 25.3359C1.14235 25.5234 0.85224 25.5378 0.664402 25.3681C0.476565 25.1984 0.462129 24.9088 0.632158 24.7213L8.83034 15.6806L0.680583 8.84006C0.533037 8.71622 0.478791 8.51351 0.544816 8.33271C0.589961 8.2091 0.684749 8.11376 0.801809 8.06582L12.589 0.212244ZM1.74612 8.5378L12.8437 17.8525L23.9437 8.53577L12.8517 1.13834L1.74612 8.5378Z"
                                  fill="white"/>
                        </svg>
                    </div>
                </div>
                <p><?php _e('Design a gift card', THEME_TD) ?></p>
            </a>
            <a href="#" class="product-steps__item active" data-steps-item="3">
                <div class="product-steps__item-icon">
                    <div>
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/sp-icon3.svg" alt="icon3">
                    </div>
                </div>
                <p><?php _e('Confirm and Send', THEME_TD) ?></p>
            </a>
        </div>

        <div class="product-steps for-me" style="display: none">
            <a href="#" class="product-steps__item active-m" data-steps-item="1">
                <div class="product-steps__item-icon">
                    <div>
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/sp-icon1.svg" alt="icon1">
                    </div>
                </div>
                <p><?php _e('Select Your Gift', THEME_TD) ?></p>
            </a>
            <a href="#" class="product-steps__item active-m">
                <div class="product-steps__item-icon">
                    <div>

                    </div>
                </div>
            </a>
            <a href="#" class="product-steps__item active-m">
                <div class="product-steps__item-icon">
                    <div>
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/sp-icon3.svg" alt="icon3">
                    </div>
                </div>
                <p><?php _e('Confirm and Send', THEME_TD) ?></p>
            </a>
        </div>
    </div>
</section>