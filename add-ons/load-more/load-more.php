<?php
/**
 * Load More Add-on
 *
 * Provides AJAX-powered "Load More" functionality for the frontpage puppies grid.
 *
 * @package Furrylicious
 * @since 4.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue load more scripts
 */
function furrylicious_load_more_scripts() {
    // Only load on front page
    if (!is_front_page()) {
        return;
    }

    wp_enqueue_script(
        'furrylicious-load-more',
        get_template_directory_uri() . '/assets/js/modules/load-more.js',
        array(),
        FURRYLICIOUS_VERSION,
        true
    );

    wp_localize_script('furrylicious-load-more', 'furryliciousLoadMore', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('furrylicious_load_more_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'furrylicious_load_more_scripts');

/**
 * AJAX handler for loading more puppies
 */
function furrylicious_ajax_load_more_puppies() {
    // Verify nonce
    if (!check_ajax_referer('furrylicious_load_more_nonce', 'nonce', false)) {
        wp_send_json_error(array('message' => __('Security check failed', 'furrylicious')));
    }

    // Get parameters
    $offset   = isset($_POST['offset']) ? absint($_POST['offset']) : 0;
    $per_page = 6;

    // Query products
    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'puppies-for-sale',
            ),
        ),
    );

    $query = new WP_Query($args);

    // Get total count (without offset/limit)
    $count_args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'puppies-for-sale',
            ),
        ),
    );
    $count_query = new WP_Query($count_args);
    $total_count = $count_query->found_posts;

    // Generate HTML
    $html = '';
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $product = wc_get_product(get_the_ID());
            if ($product) {
                get_template_part('partials/frontpage-puppy-card');
            }
        }
        wp_reset_postdata();
        $html = ob_get_clean();
    }

    // Calculate if there are more
    $loaded_count = $offset + $query->post_count;
    $has_more     = $loaded_count < $total_count;

    wp_send_json_success(array(
        'html'         => $html,
        'has_more'     => $has_more,
        'loaded_count' => $loaded_count,
        'total_count'  => $total_count,
    ));
}
add_action('wp_ajax_furrylicious_load_more_puppies', 'furrylicious_ajax_load_more_puppies');
add_action('wp_ajax_nopriv_furrylicious_load_more_puppies', 'furrylicious_ajax_load_more_puppies');
