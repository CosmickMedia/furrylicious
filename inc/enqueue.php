<?php
/**
 * Enqueue Scripts and Styles
 *
 * Handles all asset loading with proper optimization strategies.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue frontend styles
 *
 * @return void
 */
function furrylicious_enqueue_styles() {
    // Google Fonts - matches CSS variables in _variables.css
    wp_enqueue_style(
        'furrylicious-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Josefin+Sans:wght@300;400;500;600&family=DM+Sans:wght@300;400;500;600&family=Caveat:wght@400;500;600&display=swap',
        array(),
        null
    );

    // Bootstrap 5 (CDN with local fallback)
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        array('furrylicious-fonts'),
        '5.3.2'
    );

    // Swiper CSS (for carousels)
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // Main theme stylesheet
    wp_enqueue_style(
        'furrylicious-main',
        FURRYLICIOUS_CSS . '/main.css',
        array('bootstrap', 'swiper'),
        FURRYLICIOUS_VERSION
    );

    // Theme style.css (WordPress requirement)
    wp_enqueue_style(
        'furrylicious-style',
        get_stylesheet_uri(),
        array('furrylicious-main'),
        FURRYLICIOUS_VERSION
    );
}
add_action('wp_enqueue_scripts', 'furrylicious_enqueue_styles');

/**
 * Enqueue frontend scripts
 *
 * @return void
 */
function furrylicious_enqueue_scripts() {
    // Bootstrap 5 JS Bundle (includes Popper)
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.2',
        true
    );

    // Swiper JS (for carousels)
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );

    // Main theme script
    wp_enqueue_script(
        'furrylicious-main',
        FURRYLICIOUS_JS . '/main.js',
        array('bootstrap', 'swiper'),
        FURRYLICIOUS_VERSION,
        true
    );

    // Localize script with data
    wp_localize_script('furrylicious-main', 'furryliciousData', array(
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'siteUrl'  => home_url('/'),
        'themeUrl' => FURRYLICIOUS_URI,
        'nonce'    => wp_create_nonce('furrylicious-nonce'),
        'i18n'     => array(
            'loading'  => esc_html__('Loading...', 'furrylicious'),
            'error'    => esc_html__('An error occurred. Please try again.', 'furrylicious'),
            'close'    => esc_html__('Close', 'furrylicious'),
            'next'     => esc_html__('Next', 'furrylicious'),
            'previous' => esc_html__('Previous', 'furrylicious'),
        ),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'furrylicious_enqueue_scripts');

/**
 * Add async/defer/module attributes to scripts
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 * @param string $src    The script's source URL.
 * @return string Modified script tag.
 */
function furrylicious_script_attributes($tag, $handle, $src) {
    // Scripts to load as ES6 modules
    $module_scripts = array(
        'furrylicious-main',
    );

    // Scripts to defer
    $defer_scripts = array(
        'swiper',
    );

    // Scripts to load async
    $async_scripts = array();

    // Add type="module" for ES6 module scripts
    if (in_array($handle, $module_scripts)) {
        return str_replace(' src', ' type="module" src', $tag);
    }

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'furrylicious_script_attributes', 10, 3);

/**
 * Add preload hints for critical resources
 *
 * @return void
 */
function furrylicious_preload_resources() {
    // Preconnect to Google Fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // Preconnect to CDNs
    echo '<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>' . "\n";

    // DNS prefetch for Font Awesome
    echo '<link rel="dns-prefetch" href="https://kit.fontawesome.com">' . "\n";
}
add_action('wp_head', 'furrylicious_preload_resources', 1);

/**
 * Add preload for LCP image on homepage
 *
 * @return void
 */
function furrylicious_preload_lcp_image() {
    if (is_front_page() && function_exists('get_field')) {
        $hero_image = get_field('hero_image', get_the_ID());
        if ($hero_image) {
            $image_url = is_array($hero_image) ? $hero_image['url'] : $hero_image;
            echo '<link rel="preload" as="image" href="' . esc_url($image_url) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'furrylicious_preload_lcp_image', 2);

/**
 * Inline critical CSS
 *
 * Inlines critical above-the-fold CSS for faster rendering.
 *
 * @return void
 */
function furrylicious_inline_critical_css() {
    // Get critical CSS file
    $critical_css_file = FURRYLICIOUS_DIR . '/assets/css/critical.css';

    if (file_exists($critical_css_file)) {
        echo '<style id="critical-css">';
        echo file_get_contents($critical_css_file);
        echo '</style>';
    }
}
// Uncomment to enable critical CSS inlining
// add_action('wp_head', 'furrylicious_inline_critical_css', 3);

/**
 * Remove block library CSS for non-Gutenberg pages
 *
 * @return void
 */
function furrylicious_dequeue_block_styles() {
    // Keep block styles as they may be needed
    // Uncomment if you want to remove block editor styles
    // wp_dequeue_style('wp-block-library');
    // wp_dequeue_style('wp-block-library-theme');
    // wp_dequeue_style('wc-blocks-style');
}
add_action('wp_enqueue_scripts', 'furrylicious_dequeue_block_styles', 100);

/**
 * Remove jQuery Migrate
 *
 * @param WP_Scripts $scripts WP_Scripts object.
 * @return void
 */
function furrylicious_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'furrylicious_remove_jquery_migrate');

/**
 * Enqueue admin styles
 *
 * @return void
 */
function furrylicious_admin_styles() {
    wp_enqueue_style(
        'furrylicious-admin',
        FURRYLICIOUS_CSS . '/admin.css',
        array(),
        FURRYLICIOUS_VERSION
    );
}
add_action('admin_enqueue_scripts', 'furrylicious_admin_styles');

/**
 * Add editor styles
 *
 * @return void
 */
function furrylicious_editor_styles() {
    add_editor_style(array(
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Josefin+Sans:wght@300;400;500;600&family=DM+Sans:wght@300;400;500;600&family=Caveat:wght@400;500;600&display=swap',
        FURRYLICIOUS_CSS . '/editor-style.css',
    ));
}
add_action('admin_init', 'furrylicious_editor_styles');
