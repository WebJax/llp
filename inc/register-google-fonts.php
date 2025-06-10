<?php
/**
 * Register Google Font using WordPress Webfonts API
 * 
 * @since 1.0.0
 * 
 * @return void
 */
function llp_register_google_fonts() {
    if (class_exists('WP_Webfonts_Provider_Google') && function_exists('wp_register_webfont_provider')) {
        // Register Google as a provider
        wp_register_webfont_provider('google', 'WP_Webfonts_Provider_Google');

        // Register Hind Siliguri font with all weights
        $hind_siliguri_config = array(
            'provider'    => 'google',
            'font-family' => 'Hind Siliguri',
            'font-style'  => 'normal',
            'weights'     => array(300, 400, 500, 600, 700),
        );
        wp_register_webfont('hind-siliguri', $hind_siliguri_config);
    } else {
        // Fallback for WordPress versioner uden Webfonts API support
        wp_enqueue_style(
            'llp-google-fonts',
            'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap',
            array(),
            null
        );
    }
}
add_action('after_setup_theme', 'llp_register_google_fonts');

/**
 * Add preconnect for Google Fonts
 * 
 * @since 1.0.0
 * 
 * @return void
 */
function llp_preconnect_google_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'llp_preconnect_google_fonts', 1);