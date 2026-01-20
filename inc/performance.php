<?php
/**
 * Performance Optimizations
 *
 * WebP support, lazy loading, and other performance enhancements.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add WebP support for uploads
 *
 * @param array $mimes Allowed mime types.
 * @return array Modified mime types.
 */
function furrylicious_allow_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'furrylicious_allow_webp_upload');

/**
 * Enable WebP image display in admin
 *
 * @param bool   $result  Whether to use the icon.
 * @param string $path    File path.
 * @return bool True if WebP file.
 */
function furrylicious_webp_admin_display($result, $path) {
    if (preg_match('/\.webp$/i', $path)) {
        return true;
    }
    return $result;
}
add_filter('file_is_displayable_image', 'furrylicious_webp_admin_display', 10, 2);

/**
 * Add native lazy loading to images
 *
 * @param string $content Post content.
 * @return string Modified content with lazy loading.
 */
function furrylicious_lazy_load_images($content) {
    if (is_admin()) {
        return $content;
    }

    // Add loading="lazy" to images that don't have it
    $content = preg_replace(
        '/<img((?!loading=)[^>]+)>/i',
        '<img loading="lazy"$1>',
        $content
    );

    return $content;
}
add_filter('the_content', 'furrylicious_lazy_load_images', 999);
add_filter('post_thumbnail_html', 'furrylicious_lazy_load_images', 999);
add_filter('widget_text', 'furrylicious_lazy_load_images', 999);

/**
 * Add decoding async to images
 *
 * @param array $attr Image attributes.
 * @return array Modified attributes.
 */
function furrylicious_image_decoding_async($attr) {
    $attr['decoding'] = 'async';
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'furrylicious_image_decoding_async');

/**
 * Disable emoji scripts and styles
 *
 * @return void
 */
function furrylicious_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    add_filter('tiny_mce_plugins', function($plugins) {
        return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
    });

    add_filter('wp_resource_hints', function($urls, $relation_type) {
        if ($relation_type === 'dns-prefetch') {
            $urls = array_filter($urls, function($url) {
                return strpos($url, 'https://s.w.org/images/core/emoji/') === false;
            });
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'furrylicious_disable_emojis');

/**
 * Remove WordPress version from head
 *
 * @return void
 */
function furrylicious_remove_wp_version() {
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'furrylicious_remove_wp_version');

/**
 * Remove RSD link
 *
 * @return void
 */
function furrylicious_remove_rsd_link() {
    remove_action('wp_head', 'rsd_link');
}
add_action('init', 'furrylicious_remove_rsd_link');

/**
 * Remove WLManifest link
 *
 * @return void
 */
function furrylicious_remove_wlwmanifest() {
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'furrylicious_remove_wlwmanifest');

/**
 * Remove shortlink
 *
 * @return void
 */
function furrylicious_remove_shortlink() {
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'furrylicious_remove_shortlink');

/**
 * Disable XML-RPC
 *
 * @param bool $enabled Whether XML-RPC is enabled.
 * @return bool False to disable.
 */
function furrylicious_disable_xmlrpc($enabled) {
    return false;
}
add_filter('xmlrpc_enabled', 'furrylicious_disable_xmlrpc');

/**
 * Add fetchpriority hint to hero images
 *
 * @param string       $html          Image HTML.
 * @param int          $attachment_id Attachment ID.
 * @param string|array $size          Image size.
 * @param bool         $icon          Whether to use icon.
 * @param array        $attr          Image attributes.
 * @return string Modified image HTML.
 */
function furrylicious_lcp_fetchpriority($html, $attachment_id, $size, $icon, $attr) {
    // Add fetchpriority="high" to hero images
    if (isset($attr['class']) && strpos($attr['class'], 'hero-image') !== false) {
        $html = str_replace('<img', '<img fetchpriority="high"', $html);
        // Remove lazy loading from hero images
        $html = str_replace('loading="lazy"', '', $html);
    }

    return $html;
}
add_filter('wp_get_attachment_image', 'furrylicious_lcp_fetchpriority', 10, 5);

/**
 * Limit post revisions
 *
 * @param int     $num     Number of revisions.
 * @param WP_Post $post    Post object.
 * @return int Limited number of revisions.
 */
function furrylicious_limit_revisions($num, $post) {
    return 5;
}
add_filter('wp_revisions_to_keep', 'furrylicious_limit_revisions', 10, 2);

/**
 * Remove oEmbed discovery
 *
 * @return void
 */
function furrylicious_remove_oembed() {
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'furrylicious_remove_oembed');

/**
 * Add preload link for LCP image
 *
 * @return void
 */
function furrylicious_preload_lcp() {
    if (!is_front_page()) {
        return;
    }

    // Get hero image URL from ACF or featured image
    $hero_image = '';

    if (function_exists('get_field')) {
        $hero = get_field('hero_image', get_the_ID());
        if ($hero) {
            $hero_image = is_array($hero) ? $hero['url'] : $hero;
        }
    }

    if (empty($hero_image) && has_post_thumbnail()) {
        $hero_image = get_the_post_thumbnail_url(get_the_ID(), 'hero-banner');
    }

    if ($hero_image) {
        echo '<link rel="preload" as="image" href="' . esc_url($hero_image) . '">' . "\n";
    }
}
add_action('wp_head', 'furrylicious_preload_lcp', 2);

/**
 * Optimize Gravity Forms scripts loading
 *
 * @return void
 */
function furrylicious_optimize_gform_scripts() {
    // Dequeue Gravity Forms styles on pages without forms
    if (!is_page() && !is_single()) {
        return;
    }

    global $post;

    if (!$post) {
        return;
    }

    // Check if page has a Gravity Form
    if (strpos($post->post_content, '[gravityform') === false) {
        // Optionally dequeue GF assets on pages without forms
        // Uncomment if you want to dequeue:
        // wp_dequeue_style('gforms_reset_css');
        // wp_dequeue_style('gforms_formsmain_css');
        // wp_dequeue_style('gforms_ready_class_css');
        // wp_dequeue_style('gforms_browsers_css');
    }
}
add_action('wp_enqueue_scripts', 'furrylicious_optimize_gform_scripts', 100);

/**
 * Add resource hints for external resources
 *
 * @param array  $urls          URLs to hint.
 * @param string $relation_type Hint type.
 * @return array Modified URLs.
 */
function furrylicious_resource_hints($urls, $relation_type) {
    if ($relation_type === 'preconnect') {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => true,
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => true,
        );
        $urls[] = array(
            'href' => 'https://cdn.jsdelivr.net',
            'crossorigin' => true,
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'furrylicious_resource_hints', 10, 2);
