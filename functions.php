<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package llp
 * @since 1.0.0
 */

/**
 * The theme version.
 *
 * @since 1.0.0
 */
define( 'LLP_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Add theme support for block styles and editor style.
 *
 * @since 1.0.0
 *
 * @return void
 */
function llp_setup() {
	add_editor_style( './assets/css/style-shared.min.css' );

	/*
	 * Load additional block styles.
	 */
	$styled_blocks = [ 'button', 'quote', 'navigation', 'search' ];
	foreach ( $styled_blocks as $block_name ) {
		$args = array(
			'handle' => "llp-$block_name",
			'src'    => get_theme_file_uri( "assets/css/blocks/$block_name.min.css" ),
			'path'   => get_theme_file_path( "assets/css/blocks/$block_name.min.css" ),
		);
		wp_enqueue_block_style( "core/$block_name", $args );
	}

}
add_action( 'after_setup_theme', 'llp_setup' );

/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function llp_styles() {
	wp_enqueue_style(
		'llp-style',
		get_stylesheet_uri(),
		[],
		LLP_VERSION
	);
	wp_enqueue_style(
		'llp-shared-styles',
		get_theme_file_uri( 'assets/css/style-shared.min.css' ),
		[],
		LLP_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'llp_styles' );

/**
 * Register the menus.
 * 
 * @since 1.0.0
 * 
 * @return void
 */
function register_my_menus() {
    register_nav_menus(
        array(
            'topmenu' => __('Top Menu', 'llp'),
            'hovedmenu' => __('Hoved Menu', 'llp')
        )
    );
}
add_action('init', 'register_my_menus');

// Filters.
require_once get_theme_file_path( 'inc/filters.php' );

// Floating menu.
require_once get_theme_file_path( 'inc/floating-menu.php' );

// Google fonts.
require_once get_theme_file_path( 'inc/register-google-fonts.php' );

// Polylang integration.
require_once get_theme_file_path( 'inc/polylang-integration.php' );

/**
 * Enqueue scripts for mobile menu functionality
 */
function llp_enqueue_scripts() {
    // Indlæs mobile menu script - MED jQuery som afhængighed
    wp_enqueue_script(
        'llp-mobile-menu',
        get_template_directory_uri() . '/assets/js/mobilemenu.js',
        array('jquery'), // jQuery som afhængighed
        LLP_VERSION,
        true // Indlæs i footer
    );
}
add_action('wp_enqueue_scripts', 'llp_enqueue_scripts');
