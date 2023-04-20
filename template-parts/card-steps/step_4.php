<?php 
/**
 * Step 4 Give a smile
 */
$form_fields_4 = $fields['form_fields_4']; ?>
<div class="steps-list__item step4">
    <div class="send-step">
        <div class="wrapper">
            <div class="left">
                <form action="" class="send-step-form" id="form-step4">
                    <?php if (isset($fields['title_4']) && $fields['title_4']): ?>
                        <h2 class="send-buttons" id="how-to-send"><?= $fields['title_4']; ?></h2>
                    <?php endif; ?>

                    <div class="for-several" id="for-several-receivers">
                        <div class="send-row temp" style="display: none;">
                            <div class="panel-title"><span class="receiver-inc"></span><span class="title"></span><span
                                        class="arrow"><svg width="22" height="13" viewBox="0 0 22 13" fill="none"
                                                           xmlns="http://www.w3.org/2000/svg">
<path d="M20.7068 0.581794C19.9931 -0.131872 18.8362 -0.132503 18.1218 0.580385L11 7.68667L3.8782 0.580384C3.16376 -0.132504 2.00687 -0.131871 1.2932 0.581795V0.581795C0.578987 1.29601 0.578987 2.45399 1.2932 3.1682L10.0277 11.9027C10.5647 12.4397 11.4353 12.4397 11.9723 11.9027L20.7068 3.1682C21.421 2.45399 21.421 1.29601 20.7068 0.581794V0.581794Z"
      fill="#0E1856"/>
</svg></span></div>
                            <div class="send-step-form-tabs panel-content">
                                <?php if (isset($fields['subtitle_4']) && $fields['subtitle_4']): ?>
                                    <p class="description"><?= $fields['subtitle_4']; ?></p>
                                <?php endif; ?>
                                <ul aria-labelledby="how-to-send">
                                    <li>
                                        <div class="wrapper-errors-list">
                                            <input type="checkbox" id="email-id" class="visually-hidden">
                                            <label class="tab" for="email-id">
                                    <span class="icon">
                                        <svg class="email" width="64" height="64" viewBox="0 0 64 64" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
<path d="M47.2189 47.796H17.1221C14.9774 47.796 13.2412 46.0563 13.2412 43.9072V20.4406C13.2412 18.2915 14.9774 16.5518 17.1221 16.5518H47.2189C49.3637 16.5518 51.0999 18.2915 51.0999 20.4406V43.9072C51.0999 46.0563 49.3637 47.796 47.2189 47.796Z"
      stroke="#0E1856" stroke-width="3" stroke-miterlimit="10"/>
<path d="M51.0999 20.4404L33.5179 34.7676C32.7322 35.3974 31.6088 35.3974 30.8232 34.7676L13.2412 20.4404"
      stroke="#0E1856" stroke-width="3" stroke-miterlimit="10"/>
</svg>
                                    </span>
                                                <span class="text"><?= (isset($form_fields_4['email_field']['label']) && $form_fields_4['email_field']['label'] ? $form_fields_4['email_field']['label'] : __('E-MAIL', THEME_TD)); ?></span>
                                                <span class="checked-icon"><svg width="21" height="16"
                                                                                viewBox="0 0 21 16"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M19.7128 1.20385C20.3596 1.85066 20.3596 2.89934 19.7128 3.54615L8.25448 15.0045C7.60767 15.6513 6.55899 15.6513 5.91219 15.0045L0.703854 9.79614C0.0570485 9.14934 0.0570485 8.10066 0.703854 7.45385C1.35066 6.80705 2.39934 6.80705 3.04615 7.45385L7.08333 11.491L17.3705 1.20385C18.0173 0.557049 19.066 0.557049 19.7128 1.20385Z"
      fill="white"/>
</svg></span>
                                            </label>

                                            <div class="wrapper-errors">
                                                <input placeholder="<?= (isset($form_fields_4['email_field']['placeholder']) && $form_fields_4['email_field']['placeholder']) ? $form_fields_4['email_field']['placeholder'] : ''; ?>"
                                                       type="text" name="email-value-id" data-show="false">
                                                <span class="error"><?= (isset($form_fields_4['email_field']['required_text']) && $form_fields_4['email_field']['required_text']) ? $form_fields_4['email_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                            </div>
                                            <span class="error-list"><?= (isset($form_fields_4['required_text_checkboxes']) && $form_fields_4['required_text_checkboxes']) ? $form_fields_4['required_text_checkboxes'] : __('Choose at least one', THEME_TD); ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrapper-errors-list">
                                            <input type="checkbox" id="sms-id" class="visually-hidden">
                                            <label class="tab" for="sms-id">
                                    <span class="icon">
<svg class="sms" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.1807 48.8519L17.5922 49.3596L17.5936 49.3556L16.1807 48.8519ZM17.3929 49.8175L16.6004 48.5439L16.5942 48.5478L17.3929 49.8175ZM22.5445 46.6122L23.2527 45.2899C22.7797 45.0366 22.2076 45.0552 21.7521 45.3386L22.5445 46.6122ZM31.9468 48.9534V47.4534L31.9419 47.4534L31.9468 48.9534ZM18.1484 43.3325L19.5613 43.8362C19.755 43.2931 19.6201 42.687 19.2145 42.2772L18.1484 43.3325ZM14.7692 48.3443C14.6054 48.7996 14.5886 49.2949 14.7211 49.7604L17.6064 48.9389C17.6458 49.0772 17.6408 49.2244 17.5922 49.3595L14.7692 48.3443ZM14.7211 49.7604C14.8536 50.2259 15.1285 50.6373 15.506 50.938L17.3752 48.5915C17.4858 48.6796 17.5671 48.8008 17.6064 48.9389L14.7211 49.7604ZM15.506 50.938C15.8833 51.2385 16.3445 51.4138 16.8252 51.4404L16.9913 48.445C17.1306 48.4528 17.2648 48.5035 17.3752 48.5915L15.506 50.938ZM16.8252 51.4404C17.3058 51.4671 17.7834 51.3439 18.1915 51.0872L16.5942 48.5478C16.7133 48.4729 16.8521 48.4373 16.9913 48.445L16.8252 51.4404ZM18.1853 51.0911L23.3369 47.8858L21.7521 45.3386L16.6004 48.5439L18.1853 51.0911ZM21.8364 47.9345C24.9451 49.5993 28.4221 50.465 31.9517 50.4534L31.9419 47.4534C28.9091 47.4634 25.9223 46.7195 23.2527 45.2899L21.8364 47.9345ZM31.9468 50.4534C42.9954 50.4534 52.1554 42.1428 52.1554 31.6496H49.1554C49.1554 40.2698 41.5634 47.4534 31.9468 47.4534V50.4534ZM52.1554 31.6496C52.1554 21.1564 42.9956 12.8447 31.9468 12.8447V15.8447C41.5633 15.8447 49.1554 23.0292 49.1554 31.6496H52.1554ZM31.9468 12.8447C20.8978 12.8447 11.7412 21.1556 11.7412 31.6496H14.7412C14.7412 23.028 22.3306 15.8447 31.9468 15.8447V12.8447ZM11.7412 31.6496C11.7412 36.5788 13.7798 41.0514 17.0824 44.3877L19.2145 42.2772C16.4219 39.4561 14.7412 35.7254 14.7412 31.6496H11.7412ZM16.7355 42.8288L14.7678 48.3482L17.5936 49.3556L19.5613 43.8362L16.7355 42.8288Z"
      fill="#0E1856"/>
<path d="M27.2611 32.7798C27.6915 32.3488 27.6915 31.6502 27.2611 31.2193C26.8306 30.7883 26.1327 30.7883 25.7023 31.2193C25.2718 31.6502 25.2718 32.3488 25.7023 32.7798C26.1327 33.2107 26.8306 33.2107 27.2611 32.7798Z"
      fill="#0E1856" stroke="#0E1856" stroke-width="0.5"/>
<path d="M32.7791 32.7808C33.2096 32.3498 33.2096 31.6512 32.7791 31.2202C32.3487 30.7893 31.6508 30.7893 31.2203 31.2202C30.7899 31.6512 30.7899 32.3498 31.2203 32.7807C31.6508 33.2117 32.3487 33.2117 32.7791 32.7808Z"
      fill="#0E1856" stroke="#0E1856" stroke-width="0.5"/>
<path d="M38.2982 32.7803C38.7286 32.3493 38.7286 31.6507 38.2982 31.2197C37.8677 30.7888 37.1698 30.7888 36.7394 31.2198C36.3089 31.6507 36.3089 32.3493 36.7394 32.7803C37.1698 33.2112 37.8677 33.2112 38.2982 32.7803Z"
      fill="#0E1856" stroke="#0E1856" stroke-width="0.5"/>
</svg>
                                    </span>
                                                <span class="text"><?= (isset($form_fields_4['sms_field']['label']) && $form_fields_4['sms_field']['label']) ? $form_fields_4['sms_field']['label'] : __('SMS', THEME_TD); ?></span>
                                                <span class="checked-icon"><svg width="21" height="16"
                                                                                viewBox="0 0 21 16"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M19.7128 1.20385C20.3596 1.85066 20.3596 2.89934 19.7128 3.54615L8.25448 15.0045C7.60767 15.6513 6.55899 15.6513 5.91219 15.0045L0.703854 9.79614C0.0570485 9.14934 0.0570485 8.10066 0.703854 7.45385C1.35066 6.80705 2.39934 6.80705 3.04615 7.45385L7.08333 11.491L17.3705 1.20385C18.0173 0.557049 19.066 0.557049 19.7128 1.20385Z"
      fill="white"/>
</svg></span>
                                            </label>
                                            <div class="wrapper-errors">
                                                <input placeholder="<?= (isset($form_fields_4['sms_field']['placeholder']) && $form_fields_4['sms_field']['placeholder']) ? $form_fields_4['sms_field']['placeholder'] : ''; ?>"
                                                       type="text" name="sms-value-id" data-show="false">
                                                <span class="error"><?= (isset($form_fields_4['sms_field']['required_text']) && $form_fields_4['sms_field']['required_text']) ? $form_fields_4['sms_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrapper-errors-list">
                                            <input type="checkbox" id="whatsapp-id" class="visually-hidden">
                                            <label class="tab" for="whatsapp-id">
                                    <span class="icon">
                                        <svg class="whatsapp" width="60" height="60" viewBox="0 -1 64 58" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M42.4369 34.3399C41.7458 34.0014 38.3959 32.3573 37.7709 32.1321C37.146 31.9069 36.6886 31.7936 36.2328 32.4721C35.7769 33.1506 34.4608 34.6799 34.0696 35.1214C33.6784 35.563 33.274 35.6292 32.5843 35.2907C31.8947 34.9522 29.7036 34.2472 27.0963 31.9246C25.0773 30.1378 23.695 27.9212 23.3038 27.2427C22.9126 26.5642 23.2656 26.1992 23.5979 25.8592C23.9111 25.5472 24.2758 25.0644 24.6273 24.6729C24.7185 24.5551 24.7964 24.4506 24.8758 24.3476C25.0347 24.0865 25.1781 23.8162 25.3052 23.5381C25.5405 23.0818 25.4229 22.6903 25.2537 22.3503C25.0846 22.0103 23.7155 18.6708 23.142 17.3152C22.5685 15.9596 22.0083 16.1937 21.6039 16.1937C21.1995 16.1937 20.7568 16.1289 20.301 16.1289C19.9549 16.1373 19.6143 16.2169 19.3004 16.3628C18.9864 16.5086 18.7058 16.7176 18.476 16.9767C17.851 17.6552 16.0908 19.2992 16.0908 22.6373C16.1029 23.4196 16.2217 24.1965 16.4437 24.9467C17.1334 27.334 18.6201 29.3033 18.8804 29.6433C19.2186 30.0848 23.5979 37.1496 30.5315 39.8828C37.4783 42.5821 37.4783 41.6829 38.7297 41.5651C39.9812 41.4474 42.7693 39.9343 43.3296 38.3433C43.8898 36.7522 43.9031 35.4084 43.734 35.1214C43.5649 34.8344 43.1105 34.6799 42.4369 34.3399Z"
      fill="#0E1856"/>
<path d="M3.03947 56.9889L2.45512 58.7453L16.5983 54.2955C20.8514 56.5995 25.6128 57.8024 30.449 57.7946C46.3882 57.7946 59.3101 45.015 59.3101 29.2413C59.3101 13.4676 46.3897 0.689453 30.449 0.689453C14.5082 0.689453 1.58627 13.4691 1.58627 29.2413C1.57993 34.4686 3.02674 39.5946 5.76488 44.0459L1.2738 57.5445L3.03947 56.9889ZM3.03947 56.9889L16.1481 52.8646L16.7541 52.6739L17.3128 52.9766C21.3459 55.1614 25.8608 56.302 30.4466 56.2947L30.449 56.2946C45.5752 56.2946 57.8101 44.1713 57.8101 29.2413C57.8101 14.3113 45.5767 2.18945 30.449 2.18945C15.3212 2.18945 3.08627 14.3129 3.08627 29.2413V29.2431C3.08026 34.1924 4.45013 39.0456 7.04251 43.26L7.40899 43.8557L7.18817 44.5194L3.03947 56.9889Z"
      stroke="#0E1856" stroke-width="3" stroke-miterlimit="10"/>
</svg>
                                    </span>
                                                <span class="text"><?= (isset($form_fields_4['whatsapp_field']['label']) && $form_fields_4['whatsapp_field']['label']) ? $form_fields_4['whatsapp_field']['label'] : __('Whatsapp', THEME_TD); ?></span>
                                                <span class="checked-icon"><svg width="21" height="16"
                                                                                viewBox="0 0 21 16"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M19.7128 1.20385C20.3596 1.85066 20.3596 2.89934 19.7128 3.54615L8.25448 15.0045C7.60767 15.6513 6.55899 15.6513 5.91219 15.0045L0.703854 9.79614C0.0570485 9.14934 0.0570485 8.10066 0.703854 7.45385C1.35066 6.80705 2.39934 6.80705 3.04615 7.45385L7.08333 11.491L17.3705 1.20385C18.0173 0.557049 19.066 0.557049 19.7128 1.20385Z"
      fill="white"/>
</svg></span>
                                            </label>

                                            <div class="wrapper-errors">
                                                <input placeholder="<?= (isset($form_fields_4['whatsapp_field']['placeholder']) && $form_fields_4['whatsapp_field']['placeholder']) ? $form_fields_4['whatsapp_field']['placeholder'] : ''; ?>"
                                                       type="text"
                                                       name="whatsapp-value-id" data-show="false">
                                                <span class="error"><?= (isset($form_fields_4['whatsapp_field']['required_text']) && $form_fields_4['whatsapp_field']['required_text']) ? $form_fields_4['whatsapp_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="for-one">
                        <div class="send-step-form-tabs">
                            <?php if (isset($fields['subtitle_4']) && $fields['subtitle_4']): ?>
                                <p class="description"><?= $fields['subtitle_4']; ?></p>
                            <?php endif; ?>
                            <ul>
                                <li>
                                    <div class="wrapper-errors-list">
                                        <input type="checkbox" class="visually-hidden" name="email" id="email">
                                        <label class="tab" for="email">
                                    <span class="icon">
                                        <svg class="email" width="64" height="64" viewBox="0 0 64 64" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
<path d="M47.2189 47.796H17.1221C14.9774 47.796 13.2412 46.0563 13.2412 43.9072V20.4406C13.2412 18.2915 14.9774 16.5518 17.1221 16.5518H47.2189C49.3637 16.5518 51.0999 18.2915 51.0999 20.4406V43.9072C51.0999 46.0563 49.3637 47.796 47.2189 47.796Z"
      stroke="#0E1856" stroke-width="3" stroke-miterlimit="10"/>
<path d="M51.0999 20.4404L33.5179 34.7676C32.7322 35.3974 31.6088 35.3974 30.8232 34.7676L13.2412 20.4404"
      stroke="#0E1856" stroke-width="3" stroke-miterlimit="10"/>
</svg>
                                    </span>
                                            <span class="text"><?= (isset($form_fields_4['email_field']['label']) && $form_fields_4['email_field']['label'] ? $form_fields_4['email_field']['label'] : __('E-MAIL', THEME_TD)); ?></span>
                                            <span class="checked-icon"><svg width="21" height="16" viewBox="0 0 21 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M19.7128 1.20385C20.3596 1.85066 20.3596 2.89934 19.7128 3.54615L8.25448 15.0045C7.60767 15.6513 6.55899 15.6513 5.91219 15.0045L0.703854 9.79614C0.0570485 9.14934 0.0570485 8.10066 0.703854 7.45385C1.35066 6.80705 2.39934 6.80705 3.04615 7.45385L7.08333 11.491L17.3705 1.20385C18.0173 0.557049 19.066 0.557049 19.7128 1.20385Z"
      fill="white"/>
</svg></span>
                                        </label>

                                        <div class="wrapper-errors">
                                            <input placeholder="<?= (isset($form_fields_4['email_field']['placeholder']) && $form_fields_4['email_field']['placeholder']) ? $form_fields_4['email_field']['placeholder'] : ''; ?>"
                                                   type="text" name="email-value" aria-label="email" data-show="false">
                                            <span class="error"><?= (isset($form_fields_4['email_field']['required_text']) && $form_fields_4['email_field']['required_text']) ? $form_fields_4['email_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                        </div>
                                        <span class="error-list"><?= (isset($form_fields_4['required_text_checkboxes']) && $form_fields_4['required_text_checkboxes']) ? $form_fields_4['required_text_checkboxes'] : __('Choose at least one', THEME_TD); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="wrapper-errors-list">
                                        <input type="checkbox" class="visually-hidden" name="sms" id="sms">
                                        <label class="tab" for="sms">
                                    <span class="icon">
<svg class="sms" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.1807 48.8519L17.5922 49.3596L17.5936 49.3556L16.1807 48.8519ZM17.3929 49.8175L16.6004 48.5439L16.5942 48.5478L17.3929 49.8175ZM22.5445 46.6122L23.2527 45.2899C22.7797 45.0366 22.2076 45.0552 21.7521 45.3386L22.5445 46.6122ZM31.9468 48.9534V47.4534L31.9419 47.4534L31.9468 48.9534ZM18.1484 43.3325L19.5613 43.8362C19.755 43.2931 19.6201 42.687 19.2145 42.2772L18.1484 43.3325ZM14.7692 48.3443C14.6054 48.7996 14.5886 49.2949 14.7211 49.7604L17.6064 48.9389C17.6458 49.0772 17.6408 49.2244 17.5922 49.3595L14.7692 48.3443ZM14.7211 49.7604C14.8536 50.2259 15.1285 50.6373 15.506 50.938L17.3752 48.5915C17.4858 48.6796 17.5671 48.8008 17.6064 48.9389L14.7211 49.7604ZM15.506 50.938C15.8833 51.2385 16.3445 51.4138 16.8252 51.4404L16.9913 48.445C17.1306 48.4528 17.2648 48.5035 17.3752 48.5915L15.506 50.938ZM16.8252 51.4404C17.3058 51.4671 17.7834 51.3439 18.1915 51.0872L16.5942 48.5478C16.7133 48.4729 16.8521 48.4373 16.9913 48.445L16.8252 51.4404ZM18.1853 51.0911L23.3369 47.8858L21.7521 45.3386L16.6004 48.5439L18.1853 51.0911ZM21.8364 47.9345C24.9451 49.5993 28.4221 50.465 31.9517 50.4534L31.9419 47.4534C28.9091 47.4634 25.9223 46.7195 23.2527 45.2899L21.8364 47.9345ZM31.9468 50.4534C42.9954 50.4534 52.1554 42.1428 52.1554 31.6496H49.1554C49.1554 40.2698 41.5634 47.4534 31.9468 47.4534V50.4534ZM52.1554 31.6496C52.1554 21.1564 42.9956 12.8447 31.9468 12.8447V15.8447C41.5633 15.8447 49.1554 23.0292 49.1554 31.6496H52.1554ZM31.9468 12.8447C20.8978 12.8447 11.7412 21.1556 11.7412 31.6496H14.7412C14.7412 23.028 22.3306 15.8447 31.9468 15.8447V12.8447ZM11.7412 31.6496C11.7412 36.5788 13.7798 41.0514 17.0824 44.3877L19.2145 42.2772C16.4219 39.4561 14.7412 35.7254 14.7412 31.6496H11.7412ZM16.7355 42.8288L14.7678 48.3482L17.5936 49.3556L19.5613 43.8362L16.7355 42.8288Z"
      fill="#0E1856"/>
<path d="M27.2611 32.7798C27.6915 32.3488 27.6915 31.6502 27.2611 31.2193C26.8306 30.7883 26.1327 30.7883 25.7023 31.2193C25.2718 31.6502 25.2718 32.3488 25.7023 32.7798C26.1327 33.2107 26.8306 33.2107 27.2611 32.7798Z"
      fill="#0E1856" stroke="#0E1856" stroke-width="0.5"/>
<path d="M32.7791 32.7808C33.2096 32.3498 33.2096 31.6512 32.7791 31.2202C32.3487 30.7893 31.6508 30.7893 31.2203 31.2202C30.7899 31.6512 30.7899 32.3498 31.2203 32.7807C31.6508 33.2117 32.3487 33.2117 32.7791 32.7808Z"
      fill="#0E1856" stroke="#0E1856" stroke-width="0.5"/>
<path d="M38.2982 32.7803C38.7286 32.3493 38.7286 31.6507 38.2982 31.2197C37.8677 30.7888 37.1698 30.7888 36.7394 31.2198C36.3089 31.6507 36.3089 32.3493 36.7394 32.7803C37.1698 33.2112 37.8677 33.2112 38.2982 32.7803Z"
      fill="#0E1856" stroke="#0E1856" stroke-width="0.5"/>
</svg>
                                    </span>
                                            <span class="text"><?= (isset($form_fields_4['sms_field']['label']) && $form_fields_4['sms_field']['label']) ? $form_fields_4['sms_field']['label'] : __('SMS', THEME_TD); ?></span>
                                            <span class="checked-icon"><svg width="21" height="16" viewBox="0 0 21 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M19.7128 1.20385C20.3596 1.85066 20.3596 2.89934 19.7128 3.54615L8.25448 15.0045C7.60767 15.6513 6.55899 15.6513 5.91219 15.0045L0.703854 9.79614C0.0570485 9.14934 0.0570485 8.10066 0.703854 7.45385C1.35066 6.80705 2.39934 6.80705 3.04615 7.45385L7.08333 11.491L17.3705 1.20385C18.0173 0.557049 19.066 0.557049 19.7128 1.20385Z"
      fill="white"/>
</svg></span>
                                        </label>
                                        <div class="wrapper-errors">
                                            <input aria-label="Phone Number for sms" placeholder="<?= (isset($form_fields_4['sms_field']['placeholder']) && $form_fields_4['sms_field']['placeholder']) ? $form_fields_4['sms_field']['placeholder'] : ''; ?>"
                                                   type="text" name="sms-value" data-show="false">
                                            <span class="error"><?= (isset($form_fields_4['sms_field']['required_text']) && $form_fields_4['sms_field']['required_text']) ? $form_fields_4['sms_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wrapper-errors-list">
                                        <input type="checkbox" name="whatsapp" id="whatsapp" class="visually-hidden">
                                        <label class="tab" for="whatsapp">
                                    <span class="icon">
                                        <svg class="whatsapp" width="60" height="60" viewBox="0 -1 64 58" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M42.4369 34.3399C41.7458 34.0014 38.3959 32.3573 37.7709 32.1321C37.146 31.9069 36.6886 31.7936 36.2328 32.4721C35.7769 33.1506 34.4608 34.6799 34.0696 35.1214C33.6784 35.563 33.274 35.6292 32.5843 35.2907C31.8947 34.9522 29.7036 34.2472 27.0963 31.9246C25.0773 30.1378 23.695 27.9212 23.3038 27.2427C22.9126 26.5642 23.2656 26.1992 23.5979 25.8592C23.9111 25.5472 24.2758 25.0644 24.6273 24.6729C24.7185 24.5551 24.7964 24.4506 24.8758 24.3476C25.0347 24.0865 25.1781 23.8162 25.3052 23.5381C25.5405 23.0818 25.4229 22.6903 25.2537 22.3503C25.0846 22.0103 23.7155 18.6708 23.142 17.3152C22.5685 15.9596 22.0083 16.1937 21.6039 16.1937C21.1995 16.1937 20.7568 16.1289 20.301 16.1289C19.9549 16.1373 19.6143 16.2169 19.3004 16.3628C18.9864 16.5086 18.7058 16.7176 18.476 16.9767C17.851 17.6552 16.0908 19.2992 16.0908 22.6373C16.1029 23.4196 16.2217 24.1965 16.4437 24.9467C17.1334 27.334 18.6201 29.3033 18.8804 29.6433C19.2186 30.0848 23.5979 37.1496 30.5315 39.8828C37.4783 42.5821 37.4783 41.6829 38.7297 41.5651C39.9812 41.4474 42.7693 39.9343 43.3296 38.3433C43.8898 36.7522 43.9031 35.4084 43.734 35.1214C43.5649 34.8344 43.1105 34.6799 42.4369 34.3399Z"
      fill="#0E1856"/>
<path d="M3.03947 56.9889L2.45512 58.7453L16.5983 54.2955C20.8514 56.5995 25.6128 57.8024 30.449 57.7946C46.3882 57.7946 59.3101 45.015 59.3101 29.2413C59.3101 13.4676 46.3897 0.689453 30.449 0.689453C14.5082 0.689453 1.58627 13.4691 1.58627 29.2413C1.57993 34.4686 3.02674 39.5946 5.76488 44.0459L1.2738 57.5445L3.03947 56.9889ZM3.03947 56.9889L16.1481 52.8646L16.7541 52.6739L17.3128 52.9766C21.3459 55.1614 25.8608 56.302 30.4466 56.2947L30.449 56.2946C45.5752 56.2946 57.8101 44.1713 57.8101 29.2413C57.8101 14.3113 45.5767 2.18945 30.449 2.18945C15.3212 2.18945 3.08627 14.3129 3.08627 29.2413V29.2431C3.08026 34.1924 4.45013 39.0456 7.04251 43.26L7.40899 43.8557L7.18817 44.5194L3.03947 56.9889Z"
      stroke="#0E1856" stroke-width="3" stroke-miterlimit="10"/>
</svg>
                                    </span>
                                            <span class="text"><?= (isset($form_fields_4['whatsapp_field']['label']) && $form_fields_4['whatsapp_field']['label']) ? $form_fields_4['whatsapp_field']['label'] : __('Whatsapp', THEME_TD); ?></span>
                                            <span class="checked-icon"><svg width="21" height="16" viewBox="0 0 21 16"
                                                                            fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M19.7128 1.20385C20.3596 1.85066 20.3596 2.89934 19.7128 3.54615L8.25448 15.0045C7.60767 15.6513 6.55899 15.6513 5.91219 15.0045L0.703854 9.79614C0.0570485 9.14934 0.0570485 8.10066 0.703854 7.45385C1.35066 6.80705 2.39934 6.80705 3.04615 7.45385L7.08333 11.491L17.3705 1.20385C18.0173 0.557049 19.066 0.557049 19.7128 1.20385Z"
      fill="white"/>
</svg></span>
                                        </label>

                                        <div class="wrapper-errors">
                                            <input placeholder="<?= (isset($form_fields_4['whatsapp_field']['placeholder']) && $form_fields_4['whatsapp_field']['placeholder']) ? $form_fields_4['whatsapp_field']['placeholder'] : ''; ?>"
                                                   type="text"
                                                   name="whatsapp-value" aria-label="phone number for whatsapp" data-show="false">
                                            <span class="error"><?= (isset($form_fields_4['whatsapp_field']['required_text']) && $form_fields_4['whatsapp_field']['required_text']) ? $form_fields_4['whatsapp_field']['required_text'] : __('Required fields', THEME_TD); ?></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>


                    <div class="group-reverse">
<!--                        <div class="group-reverse-1">-->
<!--                            --><?php //if (isset($form_fields_4['from_name_field']['label']) && $form_fields_4['from_name_field']['label']): ?>
<!--                                <label class="group"><strong>--><?//= $form_fields_4['from_name_field']['label']; ?><!--</strong></label>-->
<!--                            --><?php //endif; ?>
<!--                            <div class="send-step-form-group">-->
<!--                                <div class="column">-->
<!--                                    --><?php //$customer_id = get_current_user_id();
//                                    $customer = new WC_Customer( $customer_id );
//
//                                    $billing_name= get_user_meta( $customer_id, 'billing_first_name', true );
//                                    $billing_phone= get_user_meta( $customer_id, 'billing_phone', true );?>
<!---->
<!--                                    <input type="text" name="sender-phone"-->
<!--                                           placeholder="--><?//= (isset($form_fields_4['from_phone_field']['placeholder']) && $form_fields_4['from_phone_field']['placeholder']) ? $form_fields_4['from_phone_field']['placeholder'] : ''; ?><!--" value="--><?php //echo $billing_phone;?><!--">-->
<!--                                </div>-->
<!--                                <div class="column">-->
<!--                                    <input type="text" name="sender-name" value="--><?php //echo $billing_name;?><!--">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="when-to-send-group">
                            <div class="group-reverse-2">
                                <div class="send-step-form-date">
                                    <?php if (isset($form_fields_4['date_field']['group_label']) && $form_fields_4['date_field']['group_label']): ?>
                                        <h2 class="when-to-send"><strong><?= $form_fields_4['date_field']['group_label']; ?></strong></h2>
                                    <?php endif; ?>
                                    <div class="radiobutton-row">
                                        <ul aria-labelledby="when-to-send">
                                            <li>
                                                <input class="custom-date visually-hidden" type="radio" value="<?php echo date('m/d/Y'); ?>" id="now"
                                                       name="dispatch-time" checked>
                                                <label class="radiobutton" for="now">
                                                    <span><?= (isset($form_fields_4['date_field']['now_label']) && $form_fields_4['date_field']['now_label']) ? $form_fields_4['date_field']['now_label'] : __('Now', THEME_TD); ?></span>
                                                </label>
                                            </li>
                                            <li>
                                                <input class="custom-date custom-show visually-hidden" data-hour-value="00" data-minute-value="00" type="radio" value="<?php echo date('m/d/Y'); ?>" id="date"
                                                       name="dispatch-time">
                                                <label class="radiobutton" for="date">
                                                    <span><?= (isset($form_fields_4['date_field']['date_label']) && $form_fields_4['date_field']['date_label']) ? $form_fields_4['date_field']['date_label'] : __('Now', THEME_TD); ?></span>
                                                </label>
                                            </li>
                                        </ul>
                                        <div class="time-group" style="display: none;">
                                            <div class="timepicker">
                                                <div class="timepicker-wrapper">
                                                    <div class="placeholder"><span
                                                                class="text"><?php _e('Time in Israel', THEME_TD); ?></span>
                                                        <span class="time" style="display: none">
                    <span class="hour">00</span>:<span class="minute">00</span>
                </span>
                                                        <span class="arrow">
                    <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M18.8244 1.07436C18.1756 0.425571 17.1239 0.424997 16.4744 1.07308L10 7.53333L3.52564 1.07308C2.87614 0.424999 1.82443 0.425571 1.17564 1.07436V1.07436C0.526352 1.72365 0.526352 2.77635 1.17564 3.42564L8.58579 10.8358C9.36684 11.6168 10.6332 11.6168 11.4142 10.8358L18.8244 3.42564C19.4736 2.77635 19.4736 1.72365 18.8244 1.07436V1.07436Z"
      fill="#0E1856"/>
</svg>

                </span>
                                                        <input type="hidden" class="time-input" name="time" value="12">
                                                    </div>
                                                    <div class="timepicker-dropdown" style="display: none;">
                                                        <div class="timepicker-dropdown-head">
                                                            <div class="hour-column"><?php _e('Select Hour:', THEME_TD); ?></div>
                                                            <!--                                                            <div class="minute-column">--><?php //_e('Select Minute:', THEME_TD); ?><!--</div>-->
                                                        </div>
                                                        <div class="timepicker-dropdown-body">
                                                            <ul class="hour-column">
                                                                <li class="item item-hour">00</li>
                                                                <li class="item item-hour">01</li>
                                                                <li class="item item-hour">02</li>
                                                                <li class="item item-hour">03</li>
                                                                <li class="item item-hour">04</li>
                                                                <li class="item item-hour">05</li>
                                                                <li class="item item-hour">06</li>
                                                                <li class="item item-hour">07</li>
                                                                <li class="item item-hour">08</li>
                                                                <li class="item item-hour">09</li>
                                                                <li class="item item-hour">10</li>
                                                                <li class="item item-hour">11</li>
                                                                <li class="item item-hour">12</li>
                                                                <li class="item item-hour">13</li>
                                                                <li class="item item-hour">14</li>
                                                                <li class="item item-hour">15</li>
                                                                <li class="item item-hour">16</li>
                                                                <li class="item item-hour">17</li>
                                                                <li class="item item-hour">18</li>
                                                                <li class="item item-hour">19</li>
                                                                <li class="item item-hour">20</li>
                                                                <li class="item item-hour">21</li>
                                                                <li class="item item-hour">22</li>
                                                                <li class="item item-hour">23</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="c-datapicker">
                                                <input type="text" class="datapicker datapicker-for-one" placeholder="<?php _e('Date', THEME_TD); ?>">
                                                <div class="c-datapicker__icon">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icon/calendar.svg"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn desktop-d"
                            id="form-step4-submit"><?php _e('click to pay', THEME_TD); ?></button>
                </form>
            </div>

            <div class="right">
                <h6 class="title mobile-d">
                    <?php _e('Preview', THEME_TD); ?>
                </h6>
                <div class="template template-result" data-format="a4">
                    <div class="svg">

                    </div>
                </div>
                <div id="wrapper-receivers-buttons-result" class="wrapper-receivers-buttons"></div>
                <label class="btn mobile-d"
                       for="form-step4-submit"><?= (isset($form_fields_4['submit_button_text']) && $form_fields_4['submit_button_text']) ? $form_fields_4['submit_button_text'] : __('click to pay', THEME_TD); ?></label>
            </div>
        </div>
    </div>
</div>
