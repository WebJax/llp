<?php
// Registrer menuområdet
function register_floating_menu() {
    register_nav_menu('floating-menu-area', __('Floating Menu Area', 'dit-child-theme'));
}
add_action('after_setup_theme', 'register_floating_menu');

// Indlæs CSS og JavaScript
function enqueue_floating_menu_assets() {
    wp_enqueue_style('floating-menu-styles', get_stylesheet_directory_uri() . '/assets/css/floating-menu.css', array(), '1.0');
    wp_enqueue_script('floating-menu-script', get_stylesheet_directory_uri() . '/assets/js/floating-menu.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_floating_menu_assets');

// PHP Template Hook - Indsæt floating menu
function insert_floating_menu() {
    ?>
    <div class="floating-menu-container">
        <div class="floating-menu-area">
            <?php
            // Vis menuen
            if (has_nav_menu('floating-menu-area')) {
                wp_nav_menu(array(
                    'theme_location' => 'floating-menu-area',
                    'container' => 'nav',
                    'container_class' => 'floating-menu-navigation',
                    'menu_class' => 'floating-menu',
                ));
            }
            ?>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'insert_floating_menu');