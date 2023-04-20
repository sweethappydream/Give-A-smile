<?php
if (!function_exists('smile_remove_admin_menus')) {
    add_action('admin_menu', 'smile_remove_admin_menus');
    function smile_remove_admin_menus()
    {
        remove_menu_page('edit-comments.php');
    }
}

if (!function_exists('smile_admin_bar_render')) {
    add_action('wp_before_admin_bar_render', 'smile_admin_bar_render');
    function smile_admin_bar_render()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
}

if (!function_exists('smile_remove_comment_support')) {
    add_action('init', 'smile_remove_comment_support', 100);
    function smile_remove_comment_support()
    {
        remove_post_type_support('post', 'comments');
        remove_post_type_support('page', 'comments');
    }
}