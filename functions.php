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

/**
 * Polylang Support - Language-specific template parts
 * 
 * This allows you to create language-specific template parts like:
 * - header-en.html, header-da.html
 * - footer-en.html, footer-da.html
 * - narrow-header-en.html, narrow-footer-da.html
 * etc.
 * 
 * @since 1.0.0
 */

/**
 * Get language-specific template part
 * 
 * @param string $slug The template part slug (e.g., 'header', 'footer')
 * @param string $name Optional. The template part name
 * @return string The template part path
 */
function llp_get_language_template_part($slug, $name = null) {
    // Check if Polylang is active
    if (!function_exists('pll_current_language')) {
        return $name ? "{$slug}-{$name}" : $slug;
    }
    
    $current_lang = pll_current_language('slug');
    
    // Try language-specific template part first
    $language_template = $name ? "{$slug}-{$name}-{$current_lang}" : "{$slug}-{$current_lang}";
    
    // Check if language-specific template exists
    if (locate_template("parts/{$language_template}.html")) {
        return $language_template;
    }
    
    // Fall back to default template
    return $name ? "{$slug}-{$name}" : $slug;
}

/**
 * Include language-specific template part
 * 
 * @param string $slug The template part slug
 * @param string $name Optional. The template part name
 */
function llp_template_part($slug, $name = null) {
    $template_part = llp_get_language_template_part($slug, $name);
    
    // Use WordPress's template part function
    if (function_exists('block_template_part')) {
        block_template_part($template_part);
    } else {
        // Fallback for older WordPress versions
        $template_path = locate_template("parts/{$template_part}.html");
        if ($template_path) {
            include $template_path;
        }
    }
}

/**
 * Filter template part selection for Polylang
 * 
 * @param string $template The template part name
 * @param array $args Template part arguments
 * @return string Modified template part name
 */
function llp_polylang_template_part_filter($template, $args) {
    if (!function_exists('pll_current_language') || !isset($args['slug'])) {
        return $template;
    }
    
    $current_lang = pll_current_language('slug');
    $slug = $args['slug'];
    $name = isset($args['name']) ? $args['name'] : null;
    
    // Create language-specific template part name
    $language_template = $name ? "{$slug}-{$name}-{$current_lang}" : "{$slug}-{$current_lang}";
    
    // Check if the language-specific template exists
    if (locate_template("parts/{$language_template}.html")) {
        return $language_template;
    }
    
    return $template;
}
add_filter('render_block_core/template-part', 'llp_polylang_template_part_filter', 10, 2);

/**
 * Add language class to body for CSS targeting
 * 
 * @param array $classes Existing body classes
 * @return array Modified body classes
 */
function llp_polylang_body_class($classes) {
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language('slug');
        $classes[] = 'lang-' . $current_lang;
        
        // Add default language class
        if (function_exists('pll_default_language') && $current_lang === pll_default_language()) {
            $classes[] = 'lang-default';
        }
    }
    return $classes;
}
add_filter('body_class', 'llp_polylang_body_class');

/**
 * Enqueue language-specific styles if they exist
 */
function llp_polylang_styles() {
    if (!function_exists('pll_current_language')) {
        return;
    }
    
    $current_lang = pll_current_language('slug');
    $lang_css_path = get_theme_file_path("assets/css/lang-{$current_lang}.css");
    
    if (file_exists($lang_css_path)) {
        wp_enqueue_style(
            "llp-lang-{$current_lang}",
            get_theme_file_uri("assets/css/lang-{$current_lang}.css"),
            ['llp-style'],
            LLP_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'llp_polylang_styles');

/**
 * Register language-specific menu locations
 */
function llp_polylang_menu_locations() {
    if (!function_exists('pll_languages_list')) {
        return;
    }
    
    $languages = pll_languages_list();
    $menu_locations = [];
    
    foreach ($languages as $lang) {
        $menu_locations["topmenu-{$lang}"] = sprintf(__('Top Menu (%s)', 'llp'), strtoupper($lang));
        $menu_locations["hovedmenu-{$lang}"] = sprintf(__('Main Menu (%s)', 'llp'), strtoupper($lang));
    }
    
    if (!empty($menu_locations)) {
        register_nav_menus($menu_locations);
    }
}
add_action('init', 'llp_polylang_menu_locations', 20);

/**
 * Get language-specific menu
 * 
 * @param string $menu_location The menu location
 * @return string Language-specific menu location
 */
function llp_get_language_menu($menu_location) {
    if (!function_exists('pll_current_language')) {
        return $menu_location;
    }
    
    $current_lang = pll_current_language('slug');
    $lang_menu_location = "{$menu_location}-{$current_lang}";
    
    // Check if language-specific menu exists
    if (has_nav_menu($lang_menu_location)) {
        return $lang_menu_location;
    }
    
    // Fall back to default menu
    return $menu_location;
}
