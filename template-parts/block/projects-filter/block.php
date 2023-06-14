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
<section class="partners__gifts">
    <div class="container">
			<h2 class="partnersh2"><?php the_field('special_headline_before_projects'); ?></h2>
      <ul class="row gifts home-gifts">
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
                'posts_per_page' => 12,
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                // 'post__in' => $project_of_the_month_ids
            );

            $loop = new WP_Query($args);
            $counter = 0;
            while ($loop->have_posts()) : $loop->the_post();
                $product_type = get_field('product_type', get_the_ID());
                //if ($product_type === 'simple' || empty($product_type)):
                get_template_part('template-parts/gifts-item', null, compact('project_of_the_month'));
                //endif;

                $counter++;
            endwhile;
            wp_reset_query();
            ?>
        </ul>
        <button class="load-more-btn">Load More</button>
    </div>
</section>
<script>
const s = window.jQuery;

class LoadMore {
  constructor() {
    this.loadMoreBtn = s('.load-more-btn');
    this.giftsContainer = s('.partners__gifts .gifts');
    this.init();
  }

  init() {
    const self = this;
    self.loadMoreBtn.on('click', function (e) {
      e.preventDefault();
      self.loadMoreContent();
    });
  }

  loadMoreContent() {
    const self = this;
    self.loadMoreBtn.addClass('loading');
    const filters = s('#projects-filter li a.selected');
    const giftIds = s('.partners__gifts .gifts__image');

    const currentPage = self.loadMoreBtn.data('page') || 5;
    let termIds = [];
    const excludes = [];

    if( giftIds?.length ) {
      giftIds.each( function(index, gift) {
        excludes.push(s(gift).attr('data-id'));
      } );
    }
    if( filters.length ) {
      filters.each( function(index, el) {
        termIds.push(s(el).attr('data-term-id'));
      } );
    }
    s.post(
      "/wp-json/smile/v1/load-more",
      {
        page: currentPage,
        auth: themeVars.logIn,
				user_id: themeVars.userID,
        excludes: excludes,
        term_ids: termIds,
        lang: "<?php echo ICL_LANGUAGE_CODE; ?>",
      },
      function (response) {
        self.giftsContainer.append(response);
        self.loadMoreBtn.data('page', currentPage + 1);
        self.loadMoreBtn.removeClass('loading');

        if (response === '') {
          self.loadMoreBtn.hide();
        }
      }
    );
  }
}

// Initialize the load more class
s(document).ready(function () {
  new LoadMore();
});

</script>
