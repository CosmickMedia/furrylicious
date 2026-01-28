<?php
/**
 * Live Search Add-on
 *
 * Provides instant AJAX-powered search functionality for the header overlay.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue live search scripts
 */
function furrylicious_enqueue_live_search_scripts() {
    wp_localize_script('furrylicious-main', 'furryliciousLiveSearch', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('furrylicious_live_search'),
    ));
}
add_action('wp_enqueue_scripts', 'furrylicious_enqueue_live_search_scripts');

/**
 * AJAX handler for live search
 */
function furrylicious_live_search() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'furrylicious_live_search')) {
        wp_send_json_error(array('message' => 'Security check failed'));
    }

    // Sanitize search term
    $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    if (empty($search_term) || strlen($search_term) < 2) {
        wp_send_json_error(array('message' => 'Search term too short'));
    }

    // Find matching product categories (breeds)
    $matching_cats = get_terms(array(
        'taxonomy'   => 'product_cat',
        'name__like' => $search_term,
        'fields'     => 'ids',
        'hide_empty' => true,
    ));

    $product_ids = array();

    // If we have matching categories, get products from those categories
    if (!empty($matching_cats) && !is_wp_error($matching_cats)) {
        $cat_args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 8,
            'fields'         => 'ids',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $matching_cats,
                ),
            ),
        );
        $cat_query = new WP_Query($cat_args);
        $product_ids = $cat_query->posts;
    }

    // Also get text search results
    $text_args = array(
        's'              => $search_term,
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'fields'         => 'ids',
    );
    $text_query = new WP_Query($text_args);

    // Merge and deduplicate results
    $product_ids = array_unique(array_merge($product_ids, $text_query->posts));

    // Limit to 8 results
    $product_ids = array_slice($product_ids, 0, 8);

    $html = '';
    $found_posts = count($product_ids);

    if (!empty($product_ids)) {
        foreach ($product_ids as $product_id) {
            $html .= furrylicious_get_search_result_card($product_id);
        }
    }

    wp_send_json_success(array(
        'html'        => $html,
        'found_posts' => $found_posts,
        'search_term' => $search_term,
    ));
}
add_action('wp_ajax_furrylicious_live_search', 'furrylicious_live_search');
add_action('wp_ajax_nopriv_furrylicious_live_search', 'furrylicious_live_search');

/**
 * Generate a search result card for a product
 *
 * @param int $product_id The product ID
 * @return string HTML for the search result card
 */
function furrylicious_get_search_result_card($product_id) {
    $product = wc_get_product($product_id);

    if (!$product) {
        return '';
    }

    // Get pet name from ACF or product meta
    $pet_name = '';
    if (function_exists('get_field')) {
        $pet_name = get_field('pet_name', $product_id);
    }
    if (!$pet_name) {
        $pet_name = $product->get_meta('pet_name');
    }
    if (!$pet_name) {
        $pet_name = $product->get_name();
    }

    // Get breed from product categories
    $breed = '';
    $categories = get_the_terms($product_id, 'product_cat');
    if ($categories && !is_wp_error($categories)) {
        $breed_names = array();
        foreach ($categories as $category) {
            // Skip uncategorized
            if ($category->slug !== 'uncategorized') {
                $breed_names[] = $category->name;
            }
        }
        $breed = implode(', ', $breed_names);
    }

    // Get thumbnail
    $thumbnail = '';
    if (has_post_thumbnail($product_id)) {
        $thumbnail = get_the_post_thumbnail($product_id, 'thumbnail', array(
            'class' => 'search-result-card__image',
            'alt'   => esc_attr($pet_name),
        ));
    } else {
        $thumbnail = '<div class="search-result-card__placeholder"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="currentColor"/></svg></div>';
    }

    $permalink = get_permalink($product_id);

    ob_start();
    ?>
    <a href="<?php echo esc_url($permalink); ?>" class="search-result-card">
        <div class="search-result-card__thumbnail">
            <?php echo $thumbnail; ?>
        </div>
        <div class="search-result-card__content">
            <span class="search-result-card__name"><?php echo esc_html($pet_name); ?></span>
            <?php if ($breed) : ?>
                <span class="search-result-card__breed"><?php echo esc_html($breed); ?></span>
            <?php endif; ?>
        </div>
    </a>
    <?php
    return ob_get_clean();
}
