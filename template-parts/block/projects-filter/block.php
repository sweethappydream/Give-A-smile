<?php
/**
 * Block Name: Projects Filter
 * Description: Projects Filter
 * Icon: filter
 * Keywords: Projects Filter
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'projects-filter';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

?>
<section class="<?= $slug ?>" id="<?= $slug ?>">
    <div class="container">
        <div class="search-bar">
            <form action="/" name="product-search" method="get" autocomplete="off"  data-lang="<?= ICL_LANGUAGE_CODE; ?>">
                <div class="search-bar__wrapper">
                    <input type="text" name="search" placeholder="<?php _e('Search...', THEME_TD); ?>" id="keyword" class="input_search">
                    <button class="search-bar__btn btn btn--small btn--thin" type="submit" aria-label="search">
                        <img alt="search-icon" src="<?= get_template_directory_uri(); ?>/assets/img/search.svg">
                    </button>
                </div>
                <div class="filter-bar">
                    <div class="filter-bar__icon">
                        <svg width="22" height="15" viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.55556 13.4444C8.55556 14.1195 9.10276 14.6667 9.77778 14.6667H12.2222C12.8972 14.6667 13.4444 14.1195 13.4444 13.4444C13.4444 12.7694 12.8972 12.2222 12.2222 12.2222H9.77778C9.10276 12.2222 8.55556 12.7694 8.55556 13.4444ZM1.22222 0C0.547207 0 0 0.547208 0 1.22222C0 1.89724 0.547207 2.44444 1.22222 2.44444H20.7778C21.4528 2.44444 22 1.89724 22 1.22222C22 0.547208 21.4528 0 20.7778 0H1.22222ZM3.66667 7.33333C3.66667 8.00835 4.21387 8.55556 4.88889 8.55556H17.1111C17.7861 8.55556 18.3333 8.00835 18.3333 7.33333C18.3333 6.65832 17.7861 6.11111 17.1111 6.11111H4.88889C4.21387 6.11111 3.66667 6.65832 3.66667 7.33333Z"
                                  fill="#0E1856"/>
                                  <title id="filters-id">Filter by</title>
                        </svg>
                    </div>
                    <?php $terms = get_terms(array('taxonomy' => 'product_tag', 'hide_empty' => true)); ?>
                    <div class="filter-bar__list">
                         <ul aria-labelledby="filters-id">
                            <?php foreach ($terms as $term) { ?>
                                <li><a href="#" data-term-id="<?= $term->term_id ?>"><?= $term->name; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="l-row-switcher">
  <div class="container">
    <div class="c-row-switcher">
      <span class="c-row-switcher__item is-active js-row-switcher">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="8" height="8" rx="2" />
          <rect x="10" width="8" height="8" rx="2" />
          <rect x="10" y="10" width="8" height="8" rx="2" />
          <rect y="10" width="8" height="8" rx="2" />
        </svg>
      </span>
      <span class="c-row-switcher__item js-column-switcher">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect y="10" width="18" height="8" rx="2" />
          <rect width="18" height="8" rx="2" />
        </svg>
      </span>
    </div>
  </div>
</section>
<?php if (get_field('add_special_gift') == 1) : ?>
    <?php if (have_rows('special_gift_settings')) : ?>
        <?php while (have_rows('special_gift_settings')) : the_row(); ?>
          <?php if (get_sub_field('title') && get_sub_field('descriptions')) : ?>
            <section class="special-gift">
                <div class="container">
                    <div class="special-gift__wrapper">
                        <div class="special-gift__content">
                            <p class="title only-d">
                                <span><?php the_sub_field('title'); ?></span>
                                <span>
                                <svg width="46" height="47" viewBox="0 0 46 47" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2411_10159)">
                            <path d="M22.765 34.3912L9.28925 43.1728C9.21879 43.219 9.13623 43.2432 9.05199 43.2426C8.96775 43.2419 8.8856 43.2163 8.8159 43.169C8.74619 43.1217 8.69206 43.0549 8.66033 42.9769C8.62859 42.8989 8.62068 42.8133 8.63758 42.7308L13.0334 27.4882C13.0582 27.4091 13.0574 27.3242 13.0311 27.2456C13.0049 27.167 12.9546 27.0986 12.8873 27.0501L0.161921 17.2542C0.0954005 17.2017 0.0463765 17.1303 0.0213297 17.0494C-0.00371722 16.9685 -0.00360768 16.8819 0.0216438 16.8011C0.0468953 16.7203 0.0960997 16.649 0.162753 16.5967C0.229406 16.5444 0.31037 16.5136 0.394943 16.5082L16.588 15.8925C16.6733 15.8909 16.7562 15.8642 16.8265 15.8158C16.8967 15.7674 16.9511 15.6993 16.9829 15.6202L22.5991 0.772332C22.6325 0.695382 22.6877 0.629867 22.7579 0.583846C22.828 0.537824 22.9101 0.513306 22.9941 0.513306C23.078 0.513306 23.1601 0.537824 23.2303 0.583846C23.3004 0.629867 23.3556 0.695382 23.389 0.772332L29.0171 15.6084C29.048 15.6881 29.1022 15.7567 29.1726 15.8053C29.243 15.8539 29.3265 15.8801 29.412 15.8807L45.605 16.5082C45.6921 16.5082 45.7769 16.5356 45.8475 16.5865C45.9181 16.6373 45.9709 16.7091 45.9985 16.7916C46.026 16.8741 46.0268 16.9632 46.0009 17.0462C45.9749 17.1292 45.9235 17.202 45.8539 17.2542L33.1206 27.0501C33.0526 27.0981 33.0015 27.1662 32.9745 27.2449C32.9476 27.3236 32.9462 27.4087 32.9705 27.4882L37.3624 42.7308C37.3778 42.8108 37.3696 42.8936 37.339 42.9691C37.3084 43.0446 37.2565 43.1096 37.1897 43.1564C37.1229 43.2031 37.044 43.2295 36.9625 43.2324C36.8811 43.2354 36.8005 43.2147 36.7305 43.1728L23.2389 34.3912C23.1679 34.3467 23.0858 34.3231 23.002 34.3231C22.9181 34.3231 22.836 34.3467 22.765 34.3912Z"
                                  fill="#28D6BF"/>
                            <path d="M7.97011 29.0827C8.32951 30.0339 5.92426 30.9299 5.92426 30.9299L3.55455 31.8258C3.55455 31.8258 1.18484 32.7217 0.809636 31.7705C0.434432 30.8193 2.83969 29.9234 2.83969 29.9234L5.2094 29.0275C5.2094 29.0275 7.61465 28.1276 7.97011 29.0827Z"
                                  fill="#28D6BF"/>
                            <path d="M38.0299 29.0827C37.6705 30.0339 40.0599 30.9299 40.0599 30.9299L42.4296 31.8258C42.4296 31.8258 44.7993 32.7217 45.1943 31.7705C45.5892 30.8193 43.1642 29.9234 43.1642 29.9234L40.7748 29.0275C40.7748 29.0275 38.3893 28.1276 38.0299 29.0827Z"
                                  fill="#28D6BF"/>
                            <path d="M8.13206 6.44781C7.41325 7.16613 9.21817 8.96982 9.21817 8.96982L11.0192 10.7617C11.0192 10.7617 12.8241 12.5654 13.5429 11.847C14.2617 11.1287 12.4607 9.32504 12.4607 9.32504L10.6637 7.52924C10.6637 7.52924 8.85087 5.7295 8.13206 6.44781Z"
                                  fill="#28D6BF"/>
                            <path d="M23.002 38.8511C21.983 38.8511 21.983 41.4007 21.983 41.4007V43.9503C21.983 43.9503 21.983 46.5 23.002 46.5C24.0209 46.5 24.017 43.9503 24.017 43.9503V41.4007C24.017 41.4007 24.017 38.8511 23.002 38.8511Z"
                                  fill="#28D6BF"/>
                            <path d="M37.8679 6.44781C38.5867 7.16613 36.7858 8.96982 36.7858 8.96982L34.9808 10.7617C34.9808 10.7617 33.1759 12.5733 32.4571 11.8549C31.7383 11.1366 33.5432 9.33293 33.5432 9.33293L35.3481 7.52924C35.3481 7.52924 37.1491 5.7295 37.8679 6.44781Z"
                                  fill="#28D6BF"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2411_10159">
                            <rect width="46" height="46" fill="white" transform="translate(0 0.5)"/>
                            </clipPath>
                            </defs>
                            </svg>
                            </span>
                            </p>
                            <p class="description"><?php the_sub_field('descriptions'); ?></p>
                            <?php $btn = get_sub_field('button'); ?>
                            <?php if($btn):?>
                                <a class="btn" href="<?= $btn['url']; ?>"><?= $btn['title']; ?></a>
                            <?php endif?>
                        </div>
                        <?php $image = get_sub_field('image'); ?>
                        <div class="special-gift__image <?= ($image) ? ' selected-image' : ''; ?>">
                            <?php if($image):?>
                                <img src="<?= $image; ?>" alt="special image">
                            <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="660" height="253" viewBox="0 0 660 253"
                                     fill="none" class="animate-lines only-d">
                                    <g clip-path="url(#clip0_1_21)">
                                        <path d="M97.9992 125.366C102.616 127.691 106.297 124.43 110.01 121.685C111.398 120.749 113.691 120.749 115.564 122.137C116.016 120.297 115.564 117.972 114.627 117.067C110.462 113.386 106.329 118.004 102.616 120.297C100.776 121.233 98.9355 121.233 96.6108 119.844C97.0951 121.653 97.5471 123.493 97.9992 125.366Z"
                                              fill="#E80866"/>
                                        <path d="M55.7533 28.4225C52.0725 31.6516 53.4286 36.7213 53.4286 40.8868C53.8806 42.7274 53.8806 44.568 51.1039 45.9565C52.9443 46.4086 55.2689 46.8929 57.1093 47.345C59.886 43.6638 59.434 39.0462 58.4977 34.8807C58.4977 33.0401 59.434 31.1995 61.2744 29.811C59.434 29.3266 57.5937 28.8746 55.7533 28.4225Z"
                                              fill="#E80866"/>
                                        <path d="M572.479 227C568.798 230.229 570.154 235.299 570.154 239.464C570.606 241.305 570.606 243.145 567.829 244.534C569.67 244.986 571.995 245.47 573.835 245.923C576.612 242.241 576.16 237.624 575.223 233.458C575.223 231.618 576.16 229.777 578 228.389C576.16 227.904 574.319 227.452 572.479 227Z"
                                              fill="#E80866"/>
                                        <path d="M492.683 30.8244C489.002 34.0535 490.358 39.1232 490.358 43.2887C490.81 45.1293 490.81 46.9699 488.033 48.3584C489.874 48.8104 492.198 49.2948 494.039 49.7469C496.816 46.0657 496.364 41.4481 495.427 37.2826C495.427 35.442 496.364 33.6014 498.204 32.2129C496.364 31.7285 494.523 31.2764 492.683 30.8244Z"
                                              fill="#E80866"/>
                                        <path d="M596.323 140.111C593.998 135.945 589.865 135.041 585.248 134.557C582.924 134.105 582.019 132.232 580.631 130.391C579.695 132.232 579.243 134.072 577.854 135.461C580.179 139.626 584.312 140.53 588.929 141.015C590.769 141.467 592.158 142.855 593.094 145.18C594.482 143.824 594.934 141.499 596.323 140.111Z"
                                              fill="#E80866"/>
                                        <path d="M34.4879 110.984C32.1632 107.303 28.0304 105.43 23.4133 105.43C21.5729 104.978 20.1845 103.59 19.2482 101.265C17.8598 102.653 17.4078 104.946 16.0194 106.334C18.7961 110.952 24.3173 110.5 28.9668 112.34C30.3551 112.793 30.8071 114.181 31.7435 115.57C32.1632 113.729 33.5516 112.373 34.4879 110.984Z"
                                              fill="#0E1856"/>
                                        <path d="M655.24 76.9728C652.916 73.2916 648.783 71.4187 644.166 71.4187C642.325 70.9666 640.937 69.5781 640.001 67.2532C638.612 68.6417 638.16 70.9343 636.772 72.3228C639.549 76.9405 645.07 76.4884 649.719 78.329C651.108 78.7811 651.56 80.1696 652.496 81.5581C652.916 79.7175 654.304 78.3613 655.24 76.9728Z"
                                              fill="#0E1856"/>
                                        <path d="M139.769 244.705C137.445 241.024 133.312 239.151 128.695 239.151C126.854 238.699 125.466 237.311 124.53 234.986C123.141 236.374 122.689 238.667 121.301 240.055C124.078 244.673 129.599 244.221 134.248 246.062C135.637 246.514 136.089 247.902 137.025 249.291C137.445 247.45 138.833 246.094 139.769 244.705Z"
                                              fill="#0E1856"/>
                                        <path d="M134.563 185.775C131.786 182.546 127.621 180.705 123.004 180.705C121.164 180.253 119.775 178.865 118.839 176.54C117.451 177.928 116.999 180.221 115.61 181.609C117.451 184.838 120.679 186.679 124.845 186.679C127.621 186.679 130.398 187.615 131.302 190.844C132.723 189.456 133.175 187.163 134.563 185.775Z"
                                              fill="#F8E22C"/>
                                        <path d="M645.983 204.99C643.206 201.761 639.041 199.92 634.424 199.92C632.584 199.468 631.195 198.08 630.259 195.755C628.871 197.143 628.419 199.436 627.03 200.824C628.871 204.054 632.099 205.894 636.264 205.894C639.041 205.894 641.818 206.831 642.722 210.06C644.143 208.671 644.595 206.378 645.983 204.99Z"
                                              fill="#F8E22C"/>
                                        <path d="M44.0537 237.015C41.277 233.786 37.1119 231.946 32.4948 231.946C30.6544 231.493 29.266 230.105 28.3297 227.78C26.9413 229.169 26.4893 231.461 25.101 232.85C26.9413 236.079 30.1701 237.919 34.3352 237.919C37.1119 237.919 39.8886 238.856 40.7927 242.085C42.2133 240.696 42.6653 238.404 44.0537 237.015Z"
                                              fill="#F8E22C"/>
                                        <path d="M517 182.235C514.223 179.006 510.058 177.166 505.441 177.166C503.601 176.713 502.212 175.325 501.276 173C499.888 174.389 499.436 176.681 498.047 178.07C499.888 181.299 503.116 183.139 507.281 183.139C510.058 183.139 512.835 184.076 513.739 187.305C515.16 185.916 515.612 183.624 517 182.235Z"
                                              fill="#F8E22C"/>
                                        <path d="M48.7467 145.315C46.9063 149.48 47.8104 153.614 50.1351 157.779C51.5234 159.62 50.5871 161.945 48.7467 163.785C50.5871 163.785 52.9118 163.785 54.7522 163.785C57.0769 160.104 56.1406 155.002 53.3638 151.321C51.9755 149.48 52.9118 147.156 54.7522 145.315C52.9118 145.315 50.5871 145.315 48.7467 145.315Z"
                                              fill="#28D6BF"/>
                                        <path d="M552.678 166C550.838 170.166 551.742 174.299 554.067 178.464C555.455 180.305 554.519 182.63 552.678 184.47C554.519 184.47 556.843 184.47 558.684 184.47C561.009 180.789 560.072 175.687 557.295 172.006C555.907 170.166 556.843 167.841 558.684 166C556.843 166 554.519 166 552.678 166Z"
                                              fill="#28D6BF"/>
                                        <path d="M578.909 14.8984C577.068 19.064 577.972 23.6816 580.297 27.8471C581.233 29.6877 580.749 31.5283 578.909 33.4012C580.749 33.4012 583.074 33.4012 584.914 33.4012C587.691 29.2356 585.85 24.618 583.526 20.9368C582.589 19.0962 583.074 16.7713 584.914 14.9307C583.074 14.4141 581.233 15.8026 578.909 14.8984Z"
                                              fill="#28D6BF"/>
                                        <path d="M142.952 43.2117C147.569 43.2117 150.798 39.5306 152.638 35.365C153.575 33.0401 156.319 33.5244 158.192 33.0401C156.803 31.6516 155.867 29.811 154.963 28.4225C150.346 28.4225 147.117 32.1036 145.277 36.2692C144.34 38.5941 141.596 38.1098 139.723 38.5941C141.112 39.9826 142.048 41.8232 142.952 43.2117Z"
                                              fill="#F8E22C"/>
                                        <path d="M551.168 77.6268C550.978 72.0604 545.988 69.5309 542.462 66.1334C541.57 65.1543 541.184 63.7468 541.723 61.9305C539.839 62.7786 538.386 64.0994 536.504 64.9152C537.288 68.1832 538.5 71.9562 542.543 73.9887C544.822 75.0333 546.554 77.409 545.917 80.61C547.402 79.2908 549.715 78.9475 551.168 77.6268Z"
                                              fill="#F8E22C"/>
                                        <path d="M498 240.102C494.771 236.873 490.154 236.873 485.537 237.325C483.697 237.777 481.856 236.873 480.468 235C479.532 236.841 479.08 238.681 478.627 240.554C482.308 244.235 487.862 242.879 492.931 242.879C494.319 242.879 495.256 244.268 496.16 245.656C497.064 243.783 497.548 241.943 498 240.102Z"
                                              fill="#0E1856"/>
                                        <path d="M524.186 122.158C524.279 117.593 521.081 114.262 517.557 111.245C515.956 110.231 515.333 108.277 515.722 105.979C513.746 106.578 512.106 107.527 510.442 108.498C510.336 113.703 515.161 116.769 518.672 120.425C519.633 121.427 519.28 123.064 518.905 124.678C520.882 124.032 522.545 123.107 524.186 122.158Z"
                                              fill="#0E1856"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_21">
                                            <rect width="660" height="253" fill="white" transform="matrix(-1 0 0 1 660 0)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <div class="animate-box">
                                    <img src="<?= get_template_directory_uri() ?>/assets/img/box1.svg"
                                         class="animate-box1 only-d">
                                    <img src="<?= get_template_directory_uri() ?>/assets/img/box2.svg"
                                         class="animate-box2 only-d">
                                    <img src="<?= get_template_directory_uri() ?>/assets/img/box3.svg"
                                         class="animate-box3 only-d">
                                    <img src="<?= get_template_directory_uri() ?>/assets/img/box-email-m.png"
                                         class="only-m">
                                </div>
                            <?php endif?>
                        </div>
                        <p class="title only-m">
                            <span><?php the_sub_field('title'); ?></span>
                            <span>
                            <svg width="46" height="47" viewBox="0 0 46 47" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2411_10159)">
                            <path d="M22.765 34.3912L9.28925 43.1728C9.21879 43.219 9.13623 43.2432 9.05199 43.2426C8.96775 43.2419 8.8856 43.2163 8.8159 43.169C8.74619 43.1217 8.69206 43.0549 8.66033 42.9769C8.62859 42.8989 8.62068 42.8133 8.63758 42.7308L13.0334 27.4882C13.0582 27.4091 13.0574 27.3242 13.0311 27.2456C13.0049 27.167 12.9546 27.0986 12.8873 27.0501L0.161921 17.2542C0.0954005 17.2017 0.0463765 17.1303 0.0213297 17.0494C-0.00371722 16.9685 -0.00360768 16.8819 0.0216438 16.8011C0.0468953 16.7203 0.0960997 16.649 0.162753 16.5967C0.229406 16.5444 0.31037 16.5136 0.394943 16.5082L16.588 15.8925C16.6733 15.8909 16.7562 15.8642 16.8265 15.8158C16.8967 15.7674 16.9511 15.6993 16.9829 15.6202L22.5991 0.772332C22.6325 0.695382 22.6877 0.629867 22.7579 0.583846C22.828 0.537824 22.9101 0.513306 22.9941 0.513306C23.078 0.513306 23.1601 0.537824 23.2303 0.583846C23.3004 0.629867 23.3556 0.695382 23.389 0.772332L29.0171 15.6084C29.048 15.6881 29.1022 15.7567 29.1726 15.8053C29.243 15.8539 29.3265 15.8801 29.412 15.8807L45.605 16.5082C45.6921 16.5082 45.7769 16.5356 45.8475 16.5865C45.9181 16.6373 45.9709 16.7091 45.9985 16.7916C46.026 16.8741 46.0268 16.9632 46.0009 17.0462C45.9749 17.1292 45.9235 17.202 45.8539 17.2542L33.1206 27.0501C33.0526 27.0981 33.0015 27.1662 32.9745 27.2449C32.9476 27.3236 32.9462 27.4087 32.9705 27.4882L37.3624 42.7308C37.3778 42.8108 37.3696 42.8936 37.339 42.9691C37.3084 43.0446 37.2565 43.1096 37.1897 43.1564C37.1229 43.2031 37.044 43.2295 36.9625 43.2324C36.8811 43.2354 36.8005 43.2147 36.7305 43.1728L23.2389 34.3912C23.1679 34.3467 23.0858 34.3231 23.002 34.3231C22.9181 34.3231 22.836 34.3467 22.765 34.3912Z"
                                  fill="#28D6BF"/>
                            <path d="M7.97011 29.0827C8.32951 30.0339 5.92426 30.9299 5.92426 30.9299L3.55455 31.8258C3.55455 31.8258 1.18484 32.7217 0.809636 31.7705C0.434432 30.8193 2.83969 29.9234 2.83969 29.9234L5.2094 29.0275C5.2094 29.0275 7.61465 28.1276 7.97011 29.0827Z"
                                  fill="#28D6BF"/>
                            <path d="M38.0299 29.0827C37.6705 30.0339 40.0599 30.9299 40.0599 30.9299L42.4296 31.8258C42.4296 31.8258 44.7993 32.7217 45.1943 31.7705C45.5892 30.8193 43.1642 29.9234 43.1642 29.9234L40.7748 29.0275C40.7748 29.0275 38.3893 28.1276 38.0299 29.0827Z"
                                  fill="#28D6BF"/>
                            <path d="M8.13206 6.44781C7.41325 7.16613 9.21817 8.96982 9.21817 8.96982L11.0192 10.7617C11.0192 10.7617 12.8241 12.5654 13.5429 11.847C14.2617 11.1287 12.4607 9.32504 12.4607 9.32504L10.6637 7.52924C10.6637 7.52924 8.85087 5.7295 8.13206 6.44781Z"
                                  fill="#28D6BF"/>
                            <path d="M23.002 38.8511C21.983 38.8511 21.983 41.4007 21.983 41.4007V43.9503C21.983 43.9503 21.983 46.5 23.002 46.5C24.0209 46.5 24.017 43.9503 24.017 43.9503V41.4007C24.017 41.4007 24.017 38.8511 23.002 38.8511Z"
                                  fill="#28D6BF"/>
                            <path d="M37.8679 6.44781C38.5867 7.16613 36.7858 8.96982 36.7858 8.96982L34.9808 10.7617C34.9808 10.7617 33.1759 12.5733 32.4571 11.8549C31.7383 11.1366 33.5432 9.33293 33.5432 9.33293L35.3481 7.52924C35.3481 7.52924 37.1491 5.7295 37.8679 6.44781Z"
                                  fill="#28D6BF"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2411_10159">
                            <rect width="46" height="46" fill="white" transform="translate(0 0.5)"/>
                            </clipPath>
                            </defs>
                            </svg>
                        </span>
                        </p>
                    </div>
                </div>
            </section>
          <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
<?php endif; ?>
<section class="partners__gifts">
    <div class="container">
        <div class="lds-ripple">
            <div></div>
            <div></div>
			<h2><?php the_field('special_headline_before_projects'); ?></h2>
        </div>
        <div class="row gifts home-gifts">

            <?php
            $project_of_the_month = get_field('project_of_the_month', 'option');
            $project_of_the_month_ids = [];
            if ($project_of_the_month) {
                foreach ($project_of_the_month as $project) {
                    $project_of_the_month_ids[] = $project->ID;
                }
            }

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                // 'post__in' => $project_of_the_month_ids
            );

            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                $product_type = get_field('product_type', get_the_ID());
                //if ($product_type === 'simple' || empty($product_type)):
                    get_template_part('template-parts/gifts-item', null, compact('project_of_the_month'));
                //endif;
            endwhile;

            // $args = array(
            //     'post_type' => 'product',
            //     'posts_per_page' => -1,
            //     'post__not_in' => $project_of_the_month_ids
            // );

            // $loop = new WP_Query($args);
            // while ($loop->have_posts()) : $loop->the_post();
            // $product_type = get_field('product_type', get_the_ID());
            //     if ($product_type === 'simple' || empty($product_type)):
            //         get_template_part('template-parts/gifts-item');
            //     endif;
            // endwhile;

            wp_reset_query();
            ?>
        </div>
    </div>
</section>
