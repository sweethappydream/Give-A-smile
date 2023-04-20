<?php
function smile_add_woocommerce_partners()
{

    $labels = array(
        'name' => 'Partners',
        'singular_name' => 'Partner',
        'menu_name' => 'Partners',
        'all_items' => 'All Partners',
        'parent_item' => 'Parent Parent',
        'parent_item_colon' => 'Parent Parent:',
        'new_item_name' => 'New Partner Name',
        'add_new_item' => 'Add New Partner',
        'edit_item' => 'Edit Partner',
        'update_item' => 'Update Partner',
        'separate_items_with_commas' => 'Separate Partner with commas',
        'search_items' => 'Search Partners',
        'add_or_remove_items' => 'Add or remove Partners',
        'choose_from_most_used' => 'Choose from the most used Partners',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('partners', 'product', $args);

}

add_action('init', 'smile_add_woocommerce_partners', 0);

add_filter('template_include', 'team_set_template');
function team_set_template($template)
{

    if (is_tax('partners')) {
        wc_get_template('archive-partners.php');
        exit();
    }
    return $template;
}

add_action('rest_api_init', function () {
    register_rest_route('smile/v1',
        '/gift/search=(?P<s>[\S]+)',
        [
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => 'gift_filter',
                'sanitize_callback' => 'sanitize_text_field',
                'permission_callback' => '__return_true',
            ]
        ]
    );
    register_rest_route('smile/v1',
        '/gifts/',
        [
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => 'get_all_gifts',
                'permission_callback' => '__return_true',
            ],
            [
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => 'get_gifts_by_terms',
                'permission_callback' => '__return_true',
            ]
        ]
    );
});

function get_gifts_by_terms(WP_REST_Request $request): WP_REST_Response
{
    $terms = $request->get_param('terms');
    $auth = $request->get_param('auth');
    $user_id = $request->get_param('user_id');
    $current_lang = trim($request->get_param('current_lang'));
    $has_posts = false;



    if ($terms) {
        global $sitepress;
        $sitepress->switch_lang($current_lang);

        ob_start();


        $project_of_the_month = get_field('project_of_the_month', 'option');
        $project_of_the_month_ids = [];
        if ($project_of_the_month) {
            foreach ($project_of_the_month as $project) {
                $project_of_the_month_ids[] = $project->ID;
            }
        }

        //Project month
        if ($project_of_the_month) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'post__in' => $project_of_the_month_ids,
                'tax_query' => [
                    [
                        'taxonomy' => 'product_tag',
                        'field' => 'term_id',
                        'terms' => $terms,
                        'operator' => 'IN',
                    ]
                ]
            );

            $loop = new WP_Query($args);

            if ($loop->have_posts()) {
                $has_posts = true;
            }
            while ($loop->have_posts()) : $loop->the_post();
                get_template_part('template-parts/gifts-item', null, compact('project_of_the_month', 'auth', 'user_id'));
            endwhile;
        }

//        Other products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post__not_in' => $project_of_the_month_ids,
            'tax_query' => [
                [
                    'taxonomy' => 'product_tag',
                    'field' => 'term_id',
                    'terms' => $terms,
                    'operator' => 'IN',
                ]
            ]
        );

        $loop = new WP_Query($args);

        if ($loop->have_posts()) {
            $has_posts = true;
        }
        while ($loop->have_posts()) : $loop->the_post();
            get_template_part('template-parts/gifts-item', null, compact('auth', 'user_id'));
        endwhile;

        wp_reset_query();

        $html = ob_get_clean();

        if (!$has_posts) {
            $html = '<div class="col col-12"><span>'.__('Sorry no results were found',THEME_TD).'</span></div>';
        }
        return new WP_REST_Response($html);
    }

    return all_gifts($auth, $user_id, $current_lang);
}

function all_gifts($auth = false, $user_id = null, $current_lang = null)
{
    global $sitepress;
    $sitepress->switch_lang($current_lang);

    ob_start();
    $project_of_the_month = get_field('project_of_the_month', 'option');
    $project_of_the_month_ids = [];

    if ($project_of_the_month) {
        foreach ($project_of_the_month as $project) {
            $project_of_the_month_ids[] = $project->ID;
        }
    }

    if ($project_of_the_month) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post__in' => $project_of_the_month_ids
        );

        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
            get_template_part('template-parts/gifts-item', null, compact('project_of_the_month', 'auth', 'user_id'));
        endwhile;
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post__not_in' => $project_of_the_month_ids
    );

    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
        get_template_part('template-parts/gifts-item', null, compact('auth', 'user_id'));
    endwhile;

    wp_reset_query();
    $html = ob_get_clean();
    return new WP_REST_Response($html);
}

function get_all_gifts(): WP_REST_Response
{
    return all_gifts();
}

function gift_filter(WP_REST_Request $request): WP_REST_Response
{
    $query = urldecode($request->get_param('s'));
    $auth = $request->get_param('auth');
    $user_id = $request->get_param('user_id');

    $current_lang = trim($request->get_param('current_lang'));

    global $sitepress;
    $sitepress->switch_lang($current_lang);

    $has_posts = false;
    ob_start();
    $project_of_the_month = get_field('project_of_the_month', 'option');
    $project_of_the_month_ids = [];

    if($project_of_the_month) {

        foreach ($project_of_the_month as $project) {
            $project_of_the_month_ids[] = $project->ID;
        }

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            's' => $query,
            'post__in' => $project_of_the_month_ids
        );

        $loop = new WP_Query($args);
        if ($loop->have_posts()) {
            $has_posts = true;
            while ($loop->have_posts()) : $loop->the_post();
                get_template_part('template-parts/gifts-item', null, compact('project_of_the_month', 'auth', 'user_id'));
            endwhile;
        }
        wp_reset_query();
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $query,
        'post__not_in' => $project_of_the_month_ids
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        $has_posts = true;
        while ($loop->have_posts()) : $loop->the_post();
            get_template_part('template-parts/gifts-item');
        endwhile;
    }


    $html = ob_get_clean();

    wp_reset_query();
    if ($has_posts) {
        return new WP_REST_Response($html);
    } else {
        if($current_lang == 'he'){
            return new WP_REST_Response(__('מצטערים אך לא נמצאו תוצאות עבור ' . $query , 'smile'), 400);
        }
       return new WP_REST_Response(__('Sorry no results were found for ' . $query , 'smile'), 400);
    }
}

//check coupon
function is_can_to_use_coupon($c_code)
{
    if (isset($c_code) && wc_get_coupon_id_by_code($c_code)) {
        $coupon = new WC_Coupon(sanitize_text_field($c_code));
        if ($coupon->get_amount()) {
            return true;
        }
    }
}
