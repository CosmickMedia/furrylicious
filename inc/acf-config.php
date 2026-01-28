<?php
/**
 * ACF Configuration
 *
 * Registers ACF options pages and related settings.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF JSON Save Point
 *
 * Saves ACF field groups to theme's acf folder.
 *
 * @param string $path Path to save JSON files.
 * @return string Modified path.
 */
function furrylicious_acf_json_save_point($path) {
    return FURRYLICIOUS_DIR . '/acf';
}
add_filter('acf/settings/save_json', 'furrylicious_acf_json_save_point');

/**
 * ACF JSON Load Point
 *
 * Loads ACF field groups from theme's acf folder.
 *
 * @param array $paths Existing load paths.
 * @return array Modified paths.
 */
function furrylicious_acf_json_load_point($paths) {
    $paths[] = FURRYLICIOUS_DIR . '/acf';
    return $paths;
}
add_filter('acf/settings/load_json', 'furrylicious_acf_json_load_point');

/**
 * Register ACF Options Pages
 *
 * @return void
 */
function furrylicious_register_acf_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    // Main Theme Options page
    acf_add_options_page(array(
        'page_title'    => __('Theme Options', 'furrylicious'),
        'menu_title'    => __('Theme Options', 'furrylicious'),
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_theme_options',
        'redirect'      => true,
        'icon_url'      => 'dashicons-admin-customizer',
        'position'      => 60,
    ));

    // Main Settings sub-page
    acf_add_options_sub_page(array(
        'page_title'    => __('Main Settings', 'furrylicious'),
        'menu_title'    => __('Main', 'furrylicious'),
        'parent_slug'   => 'theme-options',
        'capability'    => 'edit_theme_options',
    ));

    // Social Media sub-page
    acf_add_options_sub_page(array(
        'page_title'    => __('Social Media Settings', 'furrylicious'),
        'menu_title'    => __('Social Media', 'furrylicious'),
        'parent_slug'   => 'theme-options',
        'capability'    => 'edit_theme_options',
    ));

    // Header Settings sub-page
    acf_add_options_sub_page(array(
        'page_title'    => __('Header Settings', 'furrylicious'),
        'menu_title'    => __('Header', 'furrylicious'),
        'parent_slug'   => 'theme-options',
        'capability'    => 'edit_theme_options',
    ));

    // Footer Settings sub-page
    acf_add_options_sub_page(array(
        'page_title'    => __('Footer Settings', 'furrylicious'),
        'menu_title'    => __('Footer', 'furrylicious'),
        'parent_slug'   => 'theme-options',
        'capability'    => 'edit_theme_options',
    ));

    // Lead Capture Settings sub-page
    acf_add_options_sub_page(array(
        'page_title'    => __('Lead Capture Settings', 'furrylicious'),
        'menu_title'    => __('Lead Capture', 'furrylicious'),
        'parent_slug'   => 'theme-options',
        'capability'    => 'edit_theme_options',
    ));
}
add_action('acf/init', 'furrylicious_register_acf_options_pages');

/**
 * Get ACF option with fallback
 *
 * Helper function to get ACF option values with fallback.
 *
 * @param string $field   Field name.
 * @param mixed  $default Default value if field is empty.
 * @return mixed Field value or default.
 */
function furrylicious_get_option($field, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }

    $value = get_field($field, 'option');

    return !empty($value) ? $value : $default;
}

/**
 * Get theme contact info
 *
 * Returns an array of contact information from ACF options.
 *
 * @return array Contact information.
 */
function furrylicious_get_contact_info() {
    return array(
        'phone'         => furrylicious_get_option('phone', ''),
        'email'         => furrylicious_get_option('email', ''),
        'address'       => furrylicious_get_option('address', ''),
        'footer_address'=> furrylicious_get_option('footer_address', ''),
        'hours'         => furrylicious_get_option('business_hours', 'Open Every Day – 11AM to 7PM'),
        'map_url'       => furrylicious_get_option('map_url', ''),
    );
}

/**
 * Get social networks
 *
 * Returns an array of social network links from ACF options.
 *
 * @return array Social networks with name and URL.
 */
function furrylicious_get_social_networks() {
    if (!function_exists('get_field')) {
        return array();
    }

    $networks = get_field('social_networks', 'option');

    if (empty($networks) || !is_array($networks)) {
        return array();
    }

    return $networks;
}

/**
 * Output social media icons
 *
 * @param string $class Additional CSS class for the list.
 * @return void
 */
function furrylicious_social_icons($class = '') {
    $networks = furrylicious_get_social_networks();

    if (empty($networks)) {
        return;
    }

    $icons = array(
        'facebook'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'twitter'   => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'instagram' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>',
        'pinterest' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>',
        'youtube'   => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        'tiktok'    => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
    );

    echo '<ul class="social-icons ' . esc_attr($class) . '">';

    foreach ($networks as $network) {
        $name = strtolower($network['name']);
        $url = $network['web_address'];

        if (isset($icons[$name])) {
            printf(
                '<li class="social-icons__item"><a href="%s" target="_blank" rel="noopener noreferrer" class="social-icons__link social-icons__link--%s" aria-label="%s">%s</a></li>',
                esc_url($url),
                esc_attr($name),
                esc_attr(ucfirst($name)),
                $icons[$name]
            );
        }
    }

    echo '</ul>';
}

/**
 * Get hero banner settings
 *
 * @param int $post_id Post ID. Default current post.
 * @return array Hero banner settings.
 */
function furrylicious_get_hero_settings($post_id = null) {
    if (!function_exists('get_field')) {
        return array();
    }

    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    return array(
        'title'       => get_field('hero_title', $post_id),
        'subtitle'    => get_field('hero_subtitle', $post_id),
        'image'       => get_field('hero_image', $post_id),
        'cta_text'    => get_field('hero_cta_text', $post_id),
        'cta_link'    => get_field('hero_cta_link', $post_id),
        'overlay'     => get_field('hero_overlay', $post_id),
    );
}

/**
 * ============================================================================
 * Page Template ACF Helper Functions
 * ============================================================================
 */

/**
 * Get page field with fallback
 *
 * Helper function to get ACF page field values with fallback for backward compatibility.
 *
 * @param string $field   Field name.
 * @param mixed  $default Default value if field is empty.
 * @param int    $post_id Post ID. Default current post.
 * @return mixed Field value or default.
 */
function furrylicious_get_page_field($field, $default = '', $post_id = null) {
    if (!function_exists('get_field')) {
        return $default;
    }

    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    $value = get_field($field, $post_id);

    return !empty($value) ? $value : $default;
}

/**
 * Check if repeater has rows
 *
 * @param string $field   Repeater field name.
 * @param int    $post_id Post ID. Default current post.
 * @return bool True if repeater has rows.
 */
function furrylicious_has_items($field, $post_id = null) {
    if (!function_exists('have_rows')) {
        return false;
    }

    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    return have_rows($field, $post_id);
}

/**
 * Render repeater with callback
 *
 * @param string   $field    Repeater field name.
 * @param callable $callback Function to call for each row, receives index.
 * @param int      $post_id  Post ID. Default current post.
 * @return void
 */
function furrylicious_render_repeater($field, $callback, $post_id = null) {
    if (!furrylicious_has_items($field, $post_id)) {
        return;
    }

    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    $i = 0;
    while (have_rows($field, $post_id)) {
        the_row();
        call_user_func($callback, $i++);
    }
}

/**
 * Get image field with fallback
 *
 * @param string $field       Image field name.
 * @param string $size        Image size. Default 'large'.
 * @param string $default_url Default image URL if field is empty.
 * @param int    $post_id     Post ID. Default current post.
 * @return array Array with 'url', 'alt', 'width', 'height' keys.
 */
function furrylicious_get_image_field($field, $size = 'large', $default_url = '', $post_id = null) {
    $image = furrylicious_get_page_field($field, null, $post_id);

    if ($image && is_array($image)) {
        $sized = isset($image['sizes'][$size]) ? $image['sizes'][$size] : $image['url'];
        return array(
            'url'    => $sized,
            'alt'    => isset($image['alt']) ? $image['alt'] : '',
            'width'  => isset($image['sizes'][$size . '-width']) ? $image['sizes'][$size . '-width'] : (isset($image['width']) ? $image['width'] : ''),
            'height' => isset($image['sizes'][$size . '-height']) ? $image['sizes'][$size . '-height'] : (isset($image['height']) ? $image['height'] : ''),
        );
    }

    return array(
        'url'    => $default_url,
        'alt'    => '',
        'width'  => '',
        'height' => '',
    );
}

/**
 * ============================================================================
 * Editor Visibility
 * ============================================================================
 */

/**
 * Disable Gutenberg block editor on ACF-powered page templates
 *
 * Since all content is managed via ACF fields, the block editor is unnecessary.
 * This forces the classic editor to load, where ACF's hide_on_screen can then hide the content editor.
 *
 * @param bool    $use_block_editor Whether to use block editor.
 * @param WP_Post $post             The post being edited.
 * @return bool False to disable block editor for ACF templates.
 */
function furrylicious_disable_gutenberg_for_acf_templates($use_block_editor, $post) {
    if ($post->post_type !== 'page') {
        return $use_block_editor;
    }

    $template = get_page_template_slug($post->ID);

    $acf_templates = [
        'page-booking.php',
        'page-blog.php',
        'page-boutique.php',
        'page-breeders.php',
        'page-contact-us.php',
        'page-financing.php',
        'page-look-inside.php',
        'page-preferences.php',
        'page-reviews.php',
        'templates/template-faq.php',
    ];

    if (in_array($template, $acf_templates, true)) {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post', 'furrylicious_disable_gutenberg_for_acf_templates', 10, 2);

/**
 * Hide the default WordPress editor on ACF-powered page templates
 *
 * Since all content is managed via ACF fields, the empty editor is unnecessary.
 * This hides the content editor in the Classic Editor after Gutenberg is disabled.
 *
 * @param array $field_group The field group settings.
 * @return array Modified field group settings.
 */
function furrylicious_hide_editor_on_acf_pages($field_group) {
    $templates_to_hide = [
        'page-booking.php',
        'page-blog.php',
        'page-boutique.php',
        'page-breeders.php',
        'page-contact-us.php',
        'page-financing.php',
        'page-look-inside.php',
        'page-preferences.php',
        'page-reviews.php',
        'templates/template-faq.php',
    ];

    if (!empty($field_group['location'])) {
        foreach ($field_group['location'] as $group) {
            foreach ($group as $rule) {
                if ($rule['param'] === 'page_template' &&
                    in_array($rule['value'], $templates_to_hide)) {
                    $field_group['hide_on_screen'] = ['the_content', 'discussion', 'comments', 'revisions', 'slug', 'author'];
                    return $field_group;
                }
            }
        }
    }

    return $field_group;
}
add_filter('acf/load_field_group', 'furrylicious_hide_editor_on_acf_pages');
