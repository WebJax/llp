<?php
/**
 * Polylang Integration
 * 
 * Enhanced Polylang support for language-specific template parts,
 * menus, and content management.
 * 
 * @package llp
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class for handling Polylang integration
 */
class LLP_Polylang_Integration {
    
    /**
     * Initialize the integration
     */
    public static function init() {
        if (!function_exists('pll_current_language')) {
            return;
        }
        
        add_action('init', [__CLASS__, 'setup_language_support'], 15);
        add_filter('wp_nav_menu_args', [__CLASS__, 'filter_nav_menu_args']);
        add_filter('get_block_template', [__CLASS__, 'get_language_template'], 10, 3);
        add_action('wp_head', [__CLASS__, 'add_language_meta']);
    }
    
    /**
     * Setup language support
     */
    public static function setup_language_support() {
        self::register_language_menu_locations();
        self::create_sample_language_templates();
    }
    
    /**
     * Register language-specific menu locations
     */
    public static function register_language_menu_locations() {
        $languages = pll_languages_list();
        $menu_locations = [];
        
        foreach ($languages as $lang) {
            $lang_name = pll_languages_list(['fields' => 'name'])[$lang] ?? strtoupper($lang);
            $menu_locations["topmenu-{$lang}"] = sprintf(__('Top Menu (%s)', 'llp'), $lang_name);
            $menu_locations["hovedmenu-{$lang}"] = sprintf(__('Main Menu (%s)', 'llp'), $lang_name);
        }
        
        if (!empty($menu_locations)) {
            register_nav_menus($menu_locations);
        }
    }
    
    /**
     * Filter navigation menu arguments to use language-specific menus
     * 
     * @param array $args Nav menu arguments
     * @return array Modified arguments
     */
    public static function filter_nav_menu_args($args) {
        if (!isset($args['theme_location'])) {
            return $args;
        }
        
        $current_lang = pll_current_language('slug');
        $lang_menu_location = $args['theme_location'] . '-' . $current_lang;
        
        // Check if language-specific menu exists and has items
        if (has_nav_menu($lang_menu_location)) {
            $args['theme_location'] = $lang_menu_location;
        }
        
        return $args;
    }
    
    /**
     * Get language-specific block template
     * 
     * @param WP_Block_Template|null $template The block template object
     * @param string $id Template ID
     * @param string $template_type Template type
     * @return WP_Block_Template|null
     */
    public static function get_language_template($template, $id, $template_type) {
        if ($template_type !== 'wp_template_part') {
            return $template;
        }
        
        $current_lang = pll_current_language('slug');
        $template_parts = explode('//', $id);
        
        if (count($template_parts) >= 2) {
            $theme = $template_parts[0];
            $slug = $template_parts[1];
            
            // Try to find language-specific template part
            $lang_template_id = "{$theme}//{$slug}-{$current_lang}";
            $lang_template = get_block_template($lang_template_id, $template_type);
            
            if ($lang_template) {
                return $lang_template;
            }
        }
        
        return $template;
    }
    
    /**
     * Add language meta tags to head
     */
    public static function add_language_meta() {
        $current_lang = pll_current_language('locale');
        echo '<meta name="language" content="' . esc_attr($current_lang) . '">' . "\n";
        
        // Add alternate language links
        $languages = pll_the_languages(['raw' => 1]);
        foreach ($languages as $lang) {
            if (!$lang['current_lang']) {
                echo '<link rel="alternate" hreflang="' . esc_attr($lang['slug']) . '" href="' . esc_url($lang['url']) . '">' . "\n";
            }
        }
    }
    
    /**
     * Create sample language-specific template files
     */
    public static function create_sample_language_templates() {
        $languages = pll_languages_list();
        $parts_dir = get_theme_file_path('parts');
        
        // Only create samples if they don't exist
        foreach ($languages as $lang) {
            $sample_files = [
                "header-{$lang}.html",
                "footer-{$lang}.html",
                "narrow-header-{$lang}.html",
                "narrow-footer-{$lang}.html"
            ];
            
            foreach ($sample_files as $file) {
                $file_path = $parts_dir . '/' . $file;
                if (!file_exists($file_path)) {
                    // Create a basic template file
                    $base_file = str_replace("-{$lang}", '', $file);
                    $base_path = $parts_dir . '/' . $base_file;
                    
                    if (file_exists($base_path)) {
                        $content = file_get_contents($base_path);
                        // Add language-specific comment
                        $lang_comment = "<!-- wp:comment -->\n<div class=\"wp-block-comment\"><!-- Language: {$lang} --></div>\n<!-- /wp:comment -->\n\n";
                        $content = $lang_comment . $content;
                        
                        // Don't actually create files automatically to avoid overwrites
                        // This is just for reference - users should create manually
                    }
                }
            }
        }
    }
    
    /**
     * Get current language code
     * 
     * @return string Current language code
     */
    public static function get_current_language() {
        return pll_current_language('slug') ?: 'en';
    }
    
    /**
     * Get all available languages
     * 
     * @return array Available languages
     */
    public static function get_available_languages() {
        return pll_languages_list() ?: [];
    }
    
    /**
     * Check if current language is RTL
     * 
     * @return bool True if RTL language
     */
    public static function is_rtl_language() {
        $current_lang = pll_current_language('slug');
        $rtl_languages = ['ar', 'he', 'fa', 'ur']; // Add more RTL languages as needed
        return in_array($current_lang, $rtl_languages);
    }
}

// Initialize Polylang integration
LLP_Polylang_Integration::init();

/**
 * Helper functions for template usage
 */

/**
 * Display language-specific template part
 * 
 * @param string $slug Template part slug
 * @param string $name Optional template part name
 */
function llp_language_template_part($slug, $name = null) {
    if (!function_exists('pll_current_language')) {
        return block_template_part($slug, $name);
    }
    
    $current_lang = pll_current_language('slug');
    $lang_slug = $name ? "{$slug}-{$name}-{$current_lang}" : "{$slug}-{$current_lang}";
    
    // Try language-specific template first
    $lang_template = get_block_template(get_stylesheet() . '//' . $lang_slug, 'wp_template_part');
    
    if ($lang_template) {
        echo do_blocks($lang_template->content);
    } else {
        // Fall back to default template
        block_template_part($slug, $name);
    }
}

/**
 * Get language-specific menu location
 * 
 * @param string $location Menu location
 * @return string Language-specific menu location
 */
function llp_get_language_menu_location($location) {
    if (!function_exists('pll_current_language')) {
        return $location;
    }
    
    $current_lang = pll_current_language('slug');
    $lang_location = "{$location}-{$current_lang}";
    
    return has_nav_menu($lang_location) ? $lang_location : $location;
}

/**
 * Display language switcher
 * 
 * @param array $args Switcher arguments
 */
function llp_language_switcher($args = []) {
    if (!function_exists('pll_the_languages')) {
        return;
    }
    
    $defaults = [
        'dropdown' => 0,
        'show_names' => 1,
        'show_flags' => 0,
        'hide_if_empty' => 1,
        'force_home' => 0,
        'echo' => 1,
        'hide_current' => 0,
        'post_id' => null,
        'raw' => 0
    ];
    
    $args = wp_parse_args($args, $defaults);
    
    echo '<div class="llp-language-switcher">';
    pll_the_languages($args);
    echo '</div>';
}
