<?php
if (function_exists('acf_register_block')) {
    $locateDir = locate_template('template-parts/block/');

    if (file_exists($locateDir)) {
        add_action('block_categories_all', function ($categories) {
            return array_merge(
                [
                    [
                        'slug' => 'smile',
                        'title' => __('Smile', THEME_TD),
                    ],
                ],
                $categories
            );
        });

        add_action('acf/init', function () {
            $blockFiles = new DirectoryIterator(locate_template('template-parts/block/'));

            foreach ($blockFiles as $block) {
                if (!$block->isDot() && '.DS_Store' !== $block->getFilename()) {
                    $blockName = $block->getFilename();
                    $blockSlug = 'smile-' . $blockName;
                    $blockPath = $block->getPath() . '/' . $blockName . '/block.php';

                    $blockOptions = get_file_data($blockPath, [
                        'title' => 'Block Name',
                        'desc' => 'Description',
                        'icon' => 'Icon',
                        'keywords' => 'Keywords',
                        'supports' => 'Supports',
                    ]);

                    acf_register_block_type([
                        'name' => $blockSlug,
                        'title' => $blockOptions['title'] ?: __('Unnamed Block:', THEME_TD) . ' ' . $blockName,
                        'description' => $blockOptions['desc'] ?? '',
                        'category' => 'smile',
                        'icon' => $blockOptions['icon'] ?? '',
                        'keywords' => isset($blockOptions['keywords']) ? explode(' ', $blockOptions['keywords']) : '',
                        'supports' => isset($blockOptions['supports']) ? json_decode($blockOptions['supports'], true) : '',
                        'render_template' => $blockPath,
                        'mode' => 'edit',
                    ]);
                }
            }
        });
	
			// add_action('wp_enqueue_scripts', 'connect_gutenberg_block_css');
			add_action('enqueue_block_editor_assets', 'connect_gutenberg_block_css');
			add_action('enqueue_block_editor_assets', 'connect_gutenberg_block_js');
			add_action('wp_enqueue_scripts', 'connect_gutenberg_block_js');
			function connect_gutenberg_block_css() {
					wp_enqueue_style('smile-admin-css-guten', get_stylesheet_directory_uri() . '/src/scss/admin/main.css', [], THEME_FILES_VERSION);
			};
	
			function connect_gutenberg_block_js() {
        
        // wp_enqueue_style('smile-admin-css-guten', get_stylesheet_directory_uri() . '/dist/css/main.min.css', [], THEME_FILES_VERSION);
        wp_enqueue_style('swiper-guten-css', get_template_directory_uri() . '/src/scss/globals/swiper-bundle.css', [], THEME_FILES_VERSION );
        wp_enqueue_script('swiper-guten', get_stylesheet_directory_uri() . '/src/js/scripts/swiper-bundle.min.js', [], THEME_FILES_VERSION, true);
				$blockFiles = new DirectoryIterator(locate_template('template-parts/block/'));
				
				foreach ($blockFiles as $block) {
					if (!$block->isDot() && '.DS_Store' !== $block->getFilename()) {
						$blockName = $block->getFilename();
						$blockSlug = 'smile_' . $blockName;

            // wp_register_style($blockSlug, get_stylesheet_directory_uri() . '/template-parts/block/' . $blockName . '/style.css', [], THEME_FILES_VERSION);
            wp_enqueue_style($blockSlug, get_template_directory_uri() . '/template-parts/block/' . $blockName . '/style.css', [], THEME_FILES_VERSION );
						
						if (file_exists(dirname(__FILE__) . '/../template-parts/block/' . $blockName . '/index.js')) {
							wp_enqueue_script( $blockSlug . '-js', get_template_directory_uri() . '/template-parts/block/' . $blockName . '/index.js', ['jquery', 'swiper-guten'], THEME_FILES_VERSION, true);
						}
					}
				}
			}

        add_filter('render_block', function ($block_content, $block) {
            if (empty($block_content)) return $block_content;

            ob_start();
            wp_print_styles($block['blockName']);
            return ob_get_clean() . $block_content;
        }, 10, 3);
    }
}

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {
        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme General Settings'),
            'menu_title'  => __('Theme Settings'),
//            'redirect'    => false,
        ));

//        $child = acf_add_options_page(array(
//            'page_title'  => __('Social Settings'),
//            'menu_title'  => __('Social'),
//            'parent_slug' => $parent['menu_slug'],
//        ));
    }
}