<?php
/**
 * Block Name: Our Partners
 * Description: Partners slider.
 * Icon: admin-users
 * Keywords: partners block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'our-partners';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;

$title = get_field('title');
$partners_per_page = 10; // Change the number as per your requirement.
$partners = get_terms([
    'taxonomy' => 'partners',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
]);

if (is_array($partners) && !empty($partners)): ?>

    <section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> ">
        <div class="container">
            <?php if ($title): ?>
                <h2 class="<?= $slug ?>__header"><?= $title ?></h2>
            <?php endif; ?>

            <ul class="<?= $slug ?>__partners">
                <?php $counter = 0;
                foreach ($partners as $partner):
                    $partnerImgId = get_field('partner_logo', $partner);
                    $partnerName = $partner->name;
                    $partnerLink = get_term_link($partner);
                    ?>
                    <li class="<?= $slug ?>__partner" <?= $counter >= $partners_per_page ? 'style="display: none;"' : '' ?>>
                        <div class="<?= $slug ?>__img">
                            <?php if ($partnerImgId): ?>
                                <img src="<?= wp_get_attachment_image_url($partnerImgId, 'full') ?>" alt="<?= $partnerName ?>" loading="lazy" width="170">
                            <?php endif; ?>
                        </div>

                        <?php if ($partnerName): ?>
                            <div class="<?= $slug ?>__title"><?= $partnerName ?></div>
                        <?php endif; ?>

                        <?php if ($partnerLink): ?>
                            <a href="<?= $partnerLink ?>" class="<?= $slug ?>__link" aria-label="<?= $partnerName ?>">
                                <?php _e('Go to the partner page', THEME_TD); ?>
                            </a>
                        <?php endif; ?>
                    </li>
                    <!-- /.partner -->
                <?php
                    $counter++;
                endforeach; ?>
            </ul>
            <?php if ($counter > $partners_per_page): ?>
                <button class="load-more-here" id="our-partners__load-more" aria-label="Load more">
                    <?php _e('Load more +', THEME_TD); ?>
                </button>
            <?php endif; ?>
        </div>
        <!-- /.container -->
    </section>
    <script>
    var loadMoreButton = document.getElementById('our-partners__load-more');
    var partnerList = document.querySelector('.<?= $slug ?>__partners');
    var partnersPerPage = <?= $partners_per_page ?>;
    var totalPartners = <?= count($partners) ?>;
    var showMore = false;
    
    loadMoreButton.addEventListener('click', function() {
      showMore = !showMore;
      var partnersToShow = showMore ? totalPartners : partnersPerPage;
      
      for (var i = 0; i < totalPartners; i++) {
        partnerList.children[i].style.display = i < partnersToShow ? 'list-item' : 'none';
      }
      
      loadMoreButton.innerHTML = showMore ? '<?php _e('Show less -', THEME_TD); ?>' : '<?php _e('Load more +', THEME_TD); ?>';
      loadMoreButton.setAttribute('aria-expanded', showMore);
      partnerList.setAttribute('aria-hidden', !showMore);
    });
    
    // Set initial visibility
    for (var i = partnersPerPage; i < totalPartners; i++) {
      partnerList.children[i].style.display = 'none';
    }
    loadMoreButton.innerHTML = '<?php _e('Load more +', THEME_TD); ?>';
    loadMoreButton.setAttribute('aria-expanded', showMore);
    partnerList.setAttribute('aria-hidden', !showMore);
    </script>
<?php endif; ?>
