<?php
/**
 * Theme Menus
 */
add_action( 'init', 'smile_register_menus' );
function smile_register_menus() {
    register_nav_menus(
        array(
            'main_menu' => __( 'Main Menu' ),
            'login_menu' => __( 'Login Menu' ),
            'footer_menu' => __( 'Footer Menu' ),
        )
    );
}