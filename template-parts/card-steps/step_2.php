<?php
/**
 * Step 2
 */
global $sitepress;
$sitepress->switch_lang(ICL_LANGUAGE_CODE);
$select = $fields['select_celebration'];
$default_card = $fields['default_greeting_card'];
$default_title = $fields['rush_button_group']['defult_title_for_the_fast_track'];
$default_description = $fields['rush_button_group']['defult_messege_for_the_fast_track'];

?>
<div class="default-card" style="display: none; visibility: hidden;" >
    <div class="item">
        <div class="default-card__block" id="default-card" data-default-title="<?= ($default_title) ? $default_title : ''; ?>"  data-default-message="<?= ($default_description) ? $default_description : ''; ?>"></div>
        <div class="svg">
        <?= @file_get_contents($default_card); ?>
        </div>
    </div>
</div>

<div class="steps-list__item step2">
    <div class="choosing-step">
        <div class="left">
            <div class="wrapper">
                <form action="" class="choosing-step-form" id="form-step2">
                    <?php if (isset($fields['select_label']) && $fields['select_label']) : ?>
                        <label for="select-happening"
                               class="select-label"><strong><?= $fields['select_label'] ?></strong></label>
                    <?php endif; ?>
                    <select class="custom" name="select-happening" id="select-happening">
                        <?php
                        if (is_array($select) && $select) :
                            foreach ($select as $key => $option) : ?>
                                <option value="<?= $option['option_name']; ?>" data-option-order="<?= $key; ?>"><?= $option['option_name']; ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                    <?php if (isset($fields['above_the_format_title']) && $fields['above_the_format_title']) : ?>
                        <label class="title"><strong><?= $fields['above_the_format_title']; ?></strong></label>
                    <?php endif; ?>
                    <?php
                    if (is_array($select) && $select) :
                        $mainIndex = 1;

                        // Iterate.
                        foreach ($select as $option) : ?>
                            <div class="select-panel" <?= ($mainIndex !== 1) ? 'style="display:none;"' : ''; ?>
                                 data-select-value="<?= $option['option_name']; ?>">
                                <div class="form-tabs">
                                    <ul>
                                        <?php
                                        $arr4 = is_array($option['templates']['a4']) && $option['templates']['a4'] ? $option['templates']['a4'] : [];
                                        if (count($arr4) > 0) : ?>
                                            <li>
                                                <input class="radiobutton-format visually-hidden" type="radio"
                                                       value="a4-<?= $mainIndex; ?>" id="a4-<?= $mainIndex; ?>"
                                                       name="format-<?= $mainIndex; ?>" checked>
                                                <label class="radiobutton" for="a4-<?= $mainIndex; ?>">
                                                    <span><?= (isset($option['format_labels']['label_a4']) && $option['format_labels']['label_a4']) ? $option['format_labels']['label_a4'] : __('A4 Portrait', THEME_TD); ?></span>
                                                </label>
                                            </li>
                                        <?php endif; ?>
                                        <?php
                                        $arr4h = is_array($option['templates']['a4_horizontal']) && $option['templates']['a4_horizontal'] ? $option['templates']['a4_horizontal'] : [];
                                        if (count($arr4h) > 0) : ?>
                                            <li>
                                                <input class="radiobutton-format visually-hidden" type="radio"
                                                       value="a4h-<?= $mainIndex; ?>" id="a4h-<?= $mainIndex; ?>"
                                                       name="format-<?= $mainIndex; ?>">
                                                <label class="radiobutton" for="a4h-<?= $mainIndex; ?>">
                                                    <span><?= (isset($option['format_labels']['label_a4_horizontal']) && $option['format_labels']['label_a4_horizontal']) ? $option['format_labels']['label_a4_horizontal'] : __('A4 Landscape', THEME_TD); ?></span>
                                                </label>
                                            </li>
                                        <?php endif; ?>
                                        <?php
                                        $arrsq = is_array($option['templates']['square']) && $option['templates']['square'] ? $option['templates']['square'] : [];
                                        if (count($arrsq) > 0) : ?>
                                            <li>
                                                <input class="radiobutton-format visually-hidden" type="radio"
                                                       value="sq-<?= $mainIndex; ?>" id="sq-<?= $mainIndex; ?>"
                                                       name="format-<?= $mainIndex; ?>">
                                                <label class="radiobutton" for="sq-<?= $mainIndex; ?>">
                                                    <span><?= (isset($option['format_labels']['label_square']) && $option['format_labels']['label_square']) ? $option['format_labels']['label_square'] : __('Square', THEME_TD); ?></span>
                                                </label>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="form-panels">
                                    <?php $u = 1;
                                    if (is_array($option['templates']['a4']) && $option['templates']['a4']) : ?>
                                        <div class="panel a4 a4-<?= $mainIndex; ?> format-<?= $mainIndex; ?>"
                                             data-format="a4-<?= $mainIndex; ?>">
                                            <div class="items slider-panel swiper">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($option['templates']['a4'] as $item) : ?>
                                                        <div class="item swiper-slide js-id-a4-<?= $u; ?>-<?= $mainIndex; ?>">
                                                            <input type="radio" class="visually-hidden" <?= ($mainIndex . '-' . $u === "1-1") ? 'checked' : ''; ?>
                                                                   value="a4-<?= $u; ?>-<?= $mainIndex; ?>"
                                                                   id="a4-<?= $u; ?>-<?= $mainIndex; ?>" name="template-id">
                                                            <label class="wrapper" for="a4-<?= $u; ?>-<?= $mainIndex; ?>">
                                                                <?= @file_get_contents($item); ?>
                                                            </label>
                                                        </div>
                                                        <?php $u++;
                                                    endforeach; ?>
                                                </div>
												<!-- If we need pagination -->
                                                        <div class="swiper-pagination panel-swiper" id="panel-swiper"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $v = 1;
                                    if (is_array($option['templates']['a4_horizontal']) && $option['templates']['a4_horizontal']) : ?>
                                        <div class="panel a4h a4h-<?= $mainIndex; ?> format-<?= $mainIndex; ?>"
                                             style="display: none;" data-format="a4h-<?= $mainIndex; ?>">
                                            <div class="items slider-panel swiper">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($option['templates']['a4_horizontal'] as $item) : ?>
                                                        <div class="item swiper-slide js-id-a4h-<?= $u; ?>-<?= $mainIndex; ?>">
                                                            <input type="radio" class="visually-hidden" value="a4h-<?= $v; ?>-<?= $mainIndex; ?>"
                                                                   id="a4h-<?= $v; ?>-<?= $mainIndex; ?>"
                                                                   name="template-id">
                                                            <label class="wrapper" for="a4h-<?= $v; ?>-<?= $mainIndex; ?>">
                                                                <?= @file_get_contents($item); ?>
                                                            </label>
                                                        </div>
                                                        <?php $v++;
                                                    endforeach; ?>
                                                </div>
                                                <!--  we need pagination -->
                                                <div class="swiper-pagination panel-swiper" id="panel-swiper"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $s = 1;
                                    if (is_array($option['templates']['square']) && $option['templates']['square']) : ?>
                                        <div class="panel sq sq-<?= $mainIndex; ?> format-<?= $mainIndex; ?>"
                                             style="display: none;" data-format="sq-<?= $mainIndex; ?>">
                                            <div class="items slider-panel swiper">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($option['templates']['square'] as $item) : ?>
                                                        <div class="item swiper-slide js-id-sq-<?= $u; ?>-<?= $mainIndex; ?>">
                                                            <input type="radio" class="visually-hidden" value="sq-<?= $s; ?>-<?= $mainIndex; ?>"
                                                                   id="sq-<?= $s; ?>-<?= $mainIndex; ?>" name="template-id">
                                                            <label class="wrapper" for="sq-<?= $s; ?>-<?= $mainIndex; ?>">
                                                                <?= @file_get_contents($item); ?>
                                                            </label>
                                                        </div>
                                                        <?php $s++;
                                                    endforeach; ?>
                                                </div>
                                                <!--  we need pagination -->
                                                <div class="swiper-pagination panel-swiper" id="panel-swiper"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $mainIndex++;
                        endforeach;
                    endif; ?>

                    <button for="form-step2" type="submit"
                            class="btn next-step"><?= (isset($fields['submit_button_text_2']) && $fields['submit_button_text_2']) ? $fields['submit_button_text_2'] : __('Next Step', THEME_TD); ?></button>
                </form>
            </div>
        </div>
        <div class="right">
            <div class="wrapper">
                <?php if (isset($fields['rush_button_group']['title']) && $fields['rush_button_group']['title']) : ?>
                    <h6 class="title"><?= $fields['rush_button_group']['title'] ?></h6>
                <?php endif; ?>
                <?php if (isset($fields['rush_button_group']['subtitle']) && $fields['rush_button_group']['subtitle']) : ?>
                    <p class="description"><?= $fields['rush_button_group']['subtitle'] ?></p>
                <?php endif; ?>
                <a href="#"
                   class="rush-btn"><?= (isset($fields['rush_button_group']['button_label']) && $fields['rush_button_group']['button_label']) ? $fields['rush_button_group']['button_label'] : __('For the fast track', THEME_TD); ?></a>
            </div>
        </div>
    </div>
</div>
