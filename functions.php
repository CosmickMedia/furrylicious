<?php
/**
 * Furrylicious Theme Functions
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('FURRYLICIOUS_VERSION', '2.0.0');
define('FURRYLICIOUS_DIR', get_template_directory());
define('FURRYLICIOUS_URI', get_template_directory_uri());
define('FURRYLICIOUS_ASSETS', FURRYLICIOUS_URI . '/assets');
define('FURRYLICIOUS_CSS', FURRYLICIOUS_ASSETS . '/css');
define('FURRYLICIOUS_JS', FURRYLICIOUS_ASSETS . '/js');

/**
 * Include modular theme files
 *
 * Core functionality is split into separate files for maintainability.
 * Each file handles a specific aspect of the theme.
 */

// Theme setup: theme support, menus, image sizes
require_once FURRYLICIOUS_DIR . '/inc/setup.php';

// Asset enqueuing: CSS, JS with proper loading strategies
require_once FURRYLICIOUS_DIR . '/inc/enqueue.php';

// Custom Post Types: FAQ, breeds, etc.
require_once FURRYLICIOUS_DIR . '/inc/custom-post-types.php';

// ACF configuration: options pages
require_once FURRYLICIOUS_DIR . '/inc/acf-config.php';

// Gravity Forms customizations
require_once FURRYLICIOUS_DIR . '/inc/gravity-forms.php';

// Performance optimizations
require_once FURRYLICIOUS_DIR . '/inc/performance.php';

/**
 * Unique ID generator for accessibility
 *
 * Generates unique IDs for form elements and ARIA attributes.
 *
 * @param string $prefix Optional prefix for the ID.
 * @return string Unique ID.
 */
function furrylicious_unique_id($prefix = '') {
    static $id_counter = 0;

    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }

    return $prefix . (string) ++$id_counter;
}

/**
 * Custom excerpt length
 *
 * @param int $length Default excerpt length.
 * @return int Modified excerpt length.
 */
function furrylicious_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'furrylicious_excerpt_length', 999);

/**
 * Custom read more link
 *
 * @return string Read more link HTML.
 */
function furrylicious_read_more_link() {
    return sprintf(
        '<a class="more-link btn btn--outline" href="%s">%s</a>',
        esc_url(get_permalink()),
        esc_html__('Read More', 'furrylicious')
    );
}
add_filter('the_content_more_link', 'furrylicious_read_more_link');

/**
 * Custom pagination for archive pages
 *
 * Displays numeric pagination with previous/next links.
 *
 * @return void
 */
function furrylicious_numeric_posts_nav() {
    if (is_singular()) {
        return;
    }

    global $wp_query;

    // Don't print empty pagination
    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);
    $links = array();

    // Add current page
    if ($paged >= 1) {
        $links[] = $paged;
    }

    // Add pages around current
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination" aria-label="' . esc_attr__('Page navigation', 'furrylicious') . '">';
    echo '<ul class="pagination__list">';

    // Previous link
    if (get_previous_posts_link()) {
        printf(
            '<li class="pagination__item pagination__item--prev">%s</li>',
            get_previous_posts_link('<span class="sr-only">' . esc_html__('Previous', 'furrylicious') . '</span><svg aria-hidden="true" width="20" height="20" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/></svg>')
        );
    }

    // First page link
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
        printf(
            '<li%s><a href="%s" class="pagination__link">%s</a></li>',
            $class,
            esc_url(get_pagenum_link(1)),
            '1'
        );

        if (!in_array(2, $links)) {
            echo '<li class="pagination__item pagination__item--ellipsis"><span>&hellip;</span></li>';
        }
    }

    // Page number links
    sort($links);
    foreach ($links as $link) {
        $class = $paged == $link ? ' pagination__item--active' : '';
        printf(
            '<li class="pagination__item%s"><a href="%s" class="pagination__link">%s</a></li>',
            $class,
            esc_url(get_pagenum_link($link)),
            $link
        );
    }

    // Last page link
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            echo '<li class="pagination__item pagination__item--ellipsis"><span>&hellip;</span></li>';
        }

        $class = $paged == $max ? ' pagination__item--active' : '';
        printf(
            '<li class="pagination__item%s"><a href="%s" class="pagination__link">%s</a></li>',
            $class,
            esc_url(get_pagenum_link($max)),
            $max
        );
    }

    // Next link
    if (get_next_posts_link()) {
        printf(
            '<li class="pagination__item pagination__item--next">%s</li>',
            get_next_posts_link('<span class="sr-only">' . esc_html__('Next', 'furrylicious') . '</span><svg aria-hidden="true" width="20" height="20" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>')
        );
    }

    echo '</ul>';
    echo '</nav>';
}

/**
 * Get template part with data passing
 *
 * Enhanced get_template_part that allows passing data to the template.
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialized template.
 * @param array  $args Additional arguments passed to the template.
 * @return void
 */
function furrylicious_get_template_part($slug, $name = null, $args = array()) {
    if (!empty($args) && is_array($args)) {
        extract($args);
    }

    $templates = array();
    $name = (string) $name;

    if ($name !== '') {
        $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";

    $located = locate_template($templates, false, false);

    if ($located) {
        include $located;
    }
}

/**
 * Add body classes
 *
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function furrylicious_body_classes($classes) {
    // Add class for JS detection
    $classes[] = 'no-js';

    // Add page slug
    if (is_singular()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class for sticky header
    $classes[] = 'has-sticky-header';

    return $classes;
}
add_filter('body_class', 'furrylicious_body_classes');

/**
 * Hide WordPress admin bar globally
 */
add_filter('show_admin_bar', '__return_false');
