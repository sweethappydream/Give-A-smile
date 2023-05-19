<?php
/**
 * Step 3
 */
$form_fields = $fields['form_fields'];
$svgStyles = $fields['image_fields_style'];
$selectCelebrations = $fields['select_celebration'];
?>

<div class="steps-list__item step3">
    <div class="customize-step">
        <a href="#" class="switcher-btn desktop-d"><span class="text"><span
                        class="text"><?= (isset($fields['switch_button_label']) && $fields['switch_button_label']) ? $fields['switch_button_label'] : __('Switch template', THEME_TD); ?></span>
      <i>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.4839 17.1241C12.109 16.7117 11.5467 16.5243 10.9906 16.6117C8.85382 16.9366 6.59828 16.2306 5.03628 14.5186C3.3743 12.6942 2.93694 10.1888 3.63672 7.98945L4.4927 8.92665C4.82384 9.28904 5.4299 9.04536 5.41741 8.55802L5.32369 4.50305C5.31744 4.24063 5.1175 4.0157 4.85508 3.98446L0.831354 3.52211C0.344008 3.46588 0.0441026 4.04694 0.375248 4.40933L1.19374 5.30904C-0.755645 8.93915 -0.337027 13.5377 2.5933 16.7492C4.94256 19.3234 8.32274 20.3793 11.5217 19.8794C12.8213 19.6733 13.3711 18.0988 12.4839 17.1241Z"
                fill="#0E1856"/>
          <path d="M18.5569 14.6935C20.5063 11.0634 20.0876 6.46489 17.1573 3.2534C14.8081 0.672966 11.4279 -0.38295 8.22888 0.12314C6.92929 0.329325 6.37947 1.90383 7.26669 2.87227C7.64157 3.28464 8.20389 3.47208 8.75996 3.38461C10.8968 3.05971 13.1523 3.76574 14.7143 5.4777C16.3826 7.30212 16.8199 9.80758 16.1201 12.0069L15.2642 11.0697C14.933 10.7073 14.327 10.951 14.3395 11.4383L14.4269 15.487C14.4332 15.7495 14.6331 15.9744 14.8955 16.0056L18.9193 16.468C19.4066 16.5242 19.7065 15.9431 19.3754 15.5808L18.5569 14.6935Z"
                fill="#0E1856"/>
        </svg>
      </i>
        </a>
        <div class="wrapper">
            <div class="left">
                <form action="" class="customize-step-form" id="form-step3">

                    <div class="for-several">
                        <fieldset>
                            <label class="message-label" for="receivers">
                                <strong><?= __('Who Is This Gift For?', THEME_TD) ?></strong>
                                <span><?= __('Up to 10 People', THEME_TD) ?></span>
                            </label>
                            <div class="wrapper-errors">
                                <div class="receivers-repeater">
                                    <ol class="list">
                                        <li>
                                            <input class="receivers-input" type="text" id="receivers"
                                                   placeholder="<?= __('Name', THEME_TD); ?>" maxlength="23">
                                            <button type="button" class="remove"
                                                    id="receivers-remove"><?= __('Remove', THEME_TD); ?></button>
                                        </li>
                                    </ol>
                                    <span class="error"><?= (isset($form_fields['name_field']['required_text']) && $form_fields['name_field']['required_text']) ? $form_fields['name_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                    <button type="button" id="add-button">
                    <span class="plus">
                      <svg width="18" height="18"
                           viewBox="0 0 18 18"
                           fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.125 9.00002L15.875 9" stroke="#E80866" stroke-width="3.64375" stroke-linecap="round"/>
                        <path d="M9.00002 15.875L9 2.125" stroke="#E80866" stroke-width="3.64375" stroke-linecap="round"/>
                      </svg>
                    </span>
                                        <?= __('Add', THEME_TD); ?>
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="wrapper-errors for-one">
                        <label for="receiver-name"><strong><?= (isset($form_fields['name_field']['label']) && $form_fields['name_field']['label']) ? $form_fields['name_field']['label'] : __('Name', THEME_TD); ?></strong></label>
                        <input data-x="<?= $svgStyles['receiver_name']['xposition']; ?>"
                               data-y="<?= $svgStyles['receiver_name']['yposition']; ?>"
                               data-color="<?= $svgStyles['receiver_name']['color']; ?>"
                               data-font-size="<?= $svgStyles['receiver_name']['font_size']; ?>" type="text"
                               name="receiver-name" id="receiver-name" 
                               placeholder="<?= (isset($form_fields['name_field']['placeholder']) && $form_fields['name_field']['placeholder']) ? $form_fields['name_field']['placeholder'] : ''; ?>"
                               maxlength="23"  aria-required="true"
                        >
                        <span class="error"><?= (isset($form_fields['name_field']['required_text']) && $form_fields['name_field']['required_text']) ? $form_fields['name_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                    </div>



                    <div class="d-none js-svg-attr"
                         data-behalf-title="<?php _e('Donated on your behalf', THEME_TD); ?>"
                         data-product-title=""
                         data-partner-logo="<?php echo $partner_terms ? $logo_src[0] : ''; ?>"
                         data-partner-desc="<?php echo $partner_terms ? substr($partnerTextForSvg,0,350).'' : ''; ?>"
                         data-partner-title="<?php echo $partner_terms ? __('To', THEME_TD) . ' ' . $partners_detail['association_name'] : ''; ?>"
                         data-x-t="<?= $svgStyles['product_title']['xposition']; ?>"
                         data-y-t="<?= $svgStyles['product_title']['yposition']; ?>"
                         data-color-t="<?= $svgStyles['product_title']['color']; ?>"
                         data-font-size-t="<?= $svgStyles['product_title']['font_size']; ?>"></div>

                    <label class="message-label" for="message">
                        <?php if (isset($form_fields['message_labels']['title']) && $form_fields['message_labels']['title']) : ?>
                            <strong><?= $form_fields['message_labels']['title']; ?></strong>
                        <?php endif; ?>
                        <?php if (isset($form_fields['message_labels']['subtitle']) && $form_fields['message_labels']['subtitle']) : ?>
                            <span><?= $form_fields['message_labels']['subtitle']; ?></span>
                        <?php endif; ?>
                    </label>

                    <?php if (is_array($selectCelebrations) && count($selectCelebrations) > 0) { ?>
                        <?php foreach ($selectCelebrations as $key => $selectCelebration) { ?>
                            <div class="wrapper-textarea-for-occasion wrapper-textarea-for-<?= $key;?>" style="display:none">
                                <?php
                                $count = count($selectCelebration['massage']);
                                $m = 1;
                                if (is_array($selectCelebration['massage']) && $selectCelebration['massage']) :
                                    foreach ($selectCelebration['massage'] as $subkey => $massage) : ?>
                                        <textarea data-x="<?= $svgStyles['message']['xposition']; ?>"
                                                  data-y="<?= $svgStyles['message']['yposition']; ?>" 
                                                  data-color="<?= $svgStyles['message']['color']; ?>"
                                                  data-font-size="<?= $svgStyles['message']['font_size']; ?>"
                                                  data-textarea-order="<?= $subkey + 1;?>"
                                                  maxlength="250" <?= ($m !== 1) ? 'style="display:none"' : ''; ?> class="<?= ($m === 1) ? 'current-m' : ''; ?>"
                                                  name="message-<?= $m; ?>" id="message-<?= $m; ?>" cols="30"
                                                  rows="11"><?= esc_html($massage['defult_messege']); ?></textarea>
                                        <?php $m++;
                                    endforeach;
                                endif; ?>
                                <div class="border"></div>
                                <?php if ($count > 1) : ?>
                                    <div class="counter">
                    <span class="arrow-left-inactive last">
                      <svg width="7" height="13" viewBox="0 0 7 13" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.70538 11.7946C7.09466 11.4053 7.095 10.7743 6.70615 10.3846L2.83 6.5L6.70615 2.61538C7.095 2.22569 7.09466 1.59466 6.70538 1.20538C6.31581 0.815811 5.68419 0.815811 5.29462 1.20538L1 5.5C0.447716 6.05228 0.447715 6.94772 1 7.5L5.29462 11.7946C5.68419 12.1842 6.31581 12.1842 6.70538 11.7946Z"
                              fill="#0E1856"/>
                      </svg>
                    </span>
                                        <span class="count"><span class="current">1</span>/<span
                                                    class="all"><?= $count; ?></span></span>
                                        <span class="arrow-right-inactive">
                      <svg width="7" height="13" viewBox="0 0 7 13" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.294459 11.7946C-0.0948135 11.4053 -0.0951575 10.7743 0.293691 10.3846L4.16984 6.5L0.29369 2.61538C-0.0951576 2.22569 -0.0948134 1.59466 0.294459 1.20538C0.684032 0.815811 1.31565 0.815811 1.70523 1.20538L5.99984 5.5C6.55213 6.05228 6.55213 6.94771 5.99984 7.5L1.70523 11.7946C1.31565 12.1842 0.684032 12.1842 0.294459 11.7946Z"
                              fill="#0E1856"/>
                      </svg>
                    </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <input type="checkbox" name="show-price" class="visually-hidden" id="show-price"
                           data-text="<?php _e('Gift value: ', THEME_TD); ?>"
                           data-price="0"
                           data-currency="<?= get_woocommerce_currency_symbol(); ?>"
                           data-x-p="<?= $svgStyles['price']['xposition']; ?>"
                           data-y-p="<?= $svgStyles['price']['yposition']; ?>"
                           data-color-p="<?= $svgStyles['price']['color']; ?>"
                           data-font-size-p="<?= $svgStyles['price']['font_size']; ?>"
                           data-x-t="<?= $svgStyles['product_title']['xposition']; ?>"
                           data-y-t="<?= $svgStyles['product_title']['yposition']; ?>"
                           data-color-t="<?= $svgStyles['product_title']['color']; ?>"
                           data-font-size-t="<?= $svgStyles['product_title']['font_size']; ?>"
                    >
                    <label for="show-price" class="checkbox"><span
                                class="checker"></span><?= (isset($form_fields['show_price_label']) && $form_fields['show_price_label']) ? $form_fields['show_price_label'] : __('show price?', THEME_TD); ?>
                    </label>

                    <div class="wrapper-errors">
                        <label for="from-name"><strong><?= (isset($form_fields['from_name_field']['label']) && $form_fields['from_name_field']['label']) ? $form_fields['from_name_field']['label'] : __('from who ?', THEME_TD); ?></strong></label>
                        <input data-x="<?= $svgStyles['from_name']['xposition']; ?>"
                               data-y="<?= $svgStyles['from_name']['yposition']; ?>"
                               data-color="<?= $svgStyles['from_name']['color']; ?>"
                               data-font-size="<?= $svgStyles['from_name']['font_size']; ?>" type="text"
                               name="from-name" id="from-name"
                               placeholder="<?= (isset($form_fields['from_name_field']['placeholder']) && $form_fields['from_name_field']['placeholder']) ? $form_fields['from_name_field']['placeholder'] : ''; ?>"
                               maxlength="40" aria-required="true"
                        >
                        <span class="error"><?= (isset($form_fields['from_name_field']['required_text']) && $form_fields['from_name_field']['required_text']) ? $form_fields['from_name_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                    </div>
                    <button type="submit" class="btn desktop-d"
                            id="form-step3-submit"><?= (isset($form_fields['submit_button_text']) && $form_fields['submit_button_text']) ? $form_fields['submit_button_text'] : __('Next Step', THEME_TD); ?></button>
                </form>
            </div>
            <div class="right">
                <h6 class="title mobile-d">
                    <?php _e('Preview', THEME_TD); ?>
                </h6>
                <a href="#" class="switcher-btn mobile-d"><span
                            class="text"><?= (isset($fields['switch_button_label']) && $fields['switch_button_label']) ? $fields['switch_button_label'] : __('Switch template', THEME_TD); ?></span>
                    <i>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4839 17.1241C12.109 16.7117 11.5467 16.5243 10.9906 16.6117C8.85382 16.9366 6.59828 16.2306 5.03628 14.5186C3.3743 12.6942 2.93694 10.1888 3.63672 7.98945L4.4927 8.92665C4.82384 9.28904 5.4299 9.04536 5.41741 8.55802L5.32369 4.50305C5.31744 4.24063 5.1175 4.0157 4.85508 3.98446L0.831354 3.52211C0.344008 3.46588 0.0441026 4.04694 0.375248 4.40933L1.19374 5.30904C-0.755645 8.93915 -0.337027 13.5377 2.5933 16.7492C4.94256 19.3234 8.32274 20.3793 11.5217 19.8794C12.8213 19.6733 13.3711 18.0988 12.4839 17.1241Z"
                                  fill="#0E1856"/>
                            <path d="M18.5569 14.6935C20.5063 11.0634 20.0876 6.46489 17.1573 3.2534C14.8081 0.672966 11.4279 -0.38295 8.22888 0.12314C6.92929 0.329325 6.37947 1.90383 7.26669 2.87227C7.64157 3.28464 8.20389 3.47208 8.75996 3.38461C10.8968 3.05971 13.1523 3.76574 14.7143 5.4777C16.3826 7.30212 16.8199 9.80758 16.1201 12.0069L15.2642 11.0697C14.933 10.7073 14.327 10.951 14.3395 11.4383L14.4269 15.487C14.4332 15.7495 14.6331 15.9744 14.8955 16.0056L18.9193 16.468C19.4066 16.5242 19.7065 15.9431 19.3754 15.5808L18.5569 14.6935Z"
                                  fill="#0E1856"/>
                        </svg>
                    </i>
                </a>
                <div class="template">
					<!-- <div class="text-from-input"></div> -->
                    <div class="svg">
						
                    </div>
                </div>
                <div id="wrapper-receivers-buttons" class="wrapper-receivers-buttons"></div>
                <label class="btn mobile-d"
                       for="form-step3-submit"><?= (isset($form_fields['submit_button_text']) && $form_fields['submit_button_text']) ? $form_fields['submit_button_text'] : __('Next Step', THEME_TD); ?></label>
            </div>
        </div>
    </div>
</div>
