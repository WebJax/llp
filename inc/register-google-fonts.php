<?php
/**
 * Register Google Fonts
 * 
 * @since 1.0.0
 * 
 * @return void
 */
function llp_register_google_fonts() {
    // Enqueue Google Fonts using the standard WordPress method
    wp_enqueue_style(
        'llp-google-fonts',
        'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'llp_register_google_fonts');

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