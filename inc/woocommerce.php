<?php
/**
 * Furrylicious WooCommerce Integration
 *
 * Provides WooCommerce support for the catalog-only puppy browsing experience.
 * NO e-commerce functionality - WooCommerce is used for data/metadata storage only.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add WooCommerce theme support
 */
function furrylicious_woocommerce_setup() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 400,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 6,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 4,
        ),
    ));

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'furrylicious_woocommerce_setup');

/**
 * Set products per page
 */
function furrylicious_products_per_page($cols) {
    return 12;
}
add_filter('loop_shop_per_page', 'furrylicious_products_per_page');

/**
 * Set product grid columns
 */
function furrylicious_loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'furrylicious_loop_columns');

/**
 * Remove default WooCommerce hooks (prices, cart, ratings)
 * Since this is catalog-only, we don't need e-commerce elements
 */
function furrylicious_remove_wc_hooks() {
    // Remove loop hooks
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

    // Remove result count from shop loop
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

    // Remove single product hooks
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
}
add_action('init', 'furrylicious_remove_wc_hooks');

/**
 * Add custom puppy card template to product loop
 */
function furrylicious_custom_loop_product() {
    get_template_part('partials/loop', 'product');
}
add_action('woocommerce_shop_loop_item_title', 'furrylicious_custom_loop_product', 10);

/**
 * Hide prices via CSS as backup
 */
function furrylicious_hide_prices_css() {
    if (is_woocommerce()) {
        echo '<style>
            .woocommerce .price,
            .woocommerce .add_to_cart_button,
            .woocommerce .added_to_cart,
            .woocommerce .cart,
            .woocommerce-cart-form,
            .woocommerce-checkout,
            .woocommerce-MyAccount-navigation-link--orders,
            .woocommerce-MyAccount-navigation-link--downloads,
            .woocommerce-MyAccount-navigation-link--payment-methods {
                display: none !important;
            }
        </style>';
    }
}
add_action('wp_head', 'furrylicious_hide_prices_css');

/**
 * Disable cart functionality
 */
add_filter('woocommerce_is_purchasable', '__return_false');

/**
 * Redirect cart and checkout pages
 */
function furrylicious_redirect_cart_checkout() {
    if (is_cart() || is_checkout()) {
        wp_redirect(wc_get_page_permalink('shop'));
        exit;
    }
}
add_action('template_redirect', 'furrylicious_redirect_cart_checkout');

/**
 * Remove cart from header
 */
add_filter('woocommerce_widget_cart_is_hidden', '__return_true');

/**
 * Customize product query for puppies
 */
function furrylicious_product_query($query) {
    if (!is_admin() && $query->is_main_query() && is_woocommerce()) {
        // Only show products with stock status 'instock' or available
        $query->set('meta_query', array(
            'relation' => 'OR',
            array(
                'key'     => '_stock_status',
                'value'   => 'instock',
                'compare' => '=',
            ),
            array(
                'key'     => '_stock_status',
                'compare' => 'NOT EXISTS',
            ),
        ));
    }
}
add_action('pre_get_posts', 'furrylicious_product_query');

/**
 * Filter to determine if product is "coming soon"
 *
 * @param bool       $coming_soon Whether product is coming soon
 * @param WC_Product $product     The product object
 * @return bool
 */
function furrylicious_product_coming_soon($coming_soon, $product) {
    if (!isset($product) || !$product) {
        return $coming_soon;
    }

    $product_id = $product->get_id();
    $status = get_post_meta($product_id, 'status', true);

    if ($status && in_array($status, array('coming_soon', 'comingsoon', 'ComingSoon', 'Coming Soon'))) {
        return true;
    }

    $availability = get_post_meta($product_id, 'availability_date', true);

    if ($availability && strtotime($availability) > time()) {
        return true;
    }

    return $coming_soon;
}
add_filter('furrylicious_product_coming_soon', 'furrylicious_product_coming_soon', 10, 2);

/**
 * Custom image sizes for puppy cards
 */
function furrylicious_product_image_sizes() {
    add_image_size('furrylicious_card', 400, 400, true);
    add_image_size('furrylicious_card_large', 800, 800, true);
}
add_action('after_setup_theme', 'furrylicious_product_image_sizes');

/**
 * Add product class filter for grid
 */
function furrylicious_product_class($classes, $product) {
    $classes[] = 'puppy-grid__item';
    return $classes;
}
add_filter('woocommerce_post_class', 'furrylicious_product_class', 10, 2);

/**
 * Wrapper for WooCommerce content
 */
function furrylicious_woocommerce_wrapper_before() {
    echo '<main id="main" class="site-main">';
}

function furrylicious_woocommerce_wrapper_after() {
    echo '</main>';
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'furrylicious_woocommerce_wrapper_before');
add_action('woocommerce_after_main_content', 'furrylicious_woocommerce_wrapper_after');

/**
 * Remove breadcrumbs (we'll add custom ones)
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**
 * Custom sorting options for puppies
 */
function furrylicious_catalog_orderby($orderby) {
    unset($orderby['price']);
    unset($orderby['price-desc']);
    unset($orderby['rating']);

    $orderby = array(
        'date'       => __('Newest arrivals', 'furrylicious'),
        'popularity' => __('Most popular', 'furrylicious'),
        'title'      => __('Alphabetically', 'furrylicious'),
    );

    return $orderby;
}
add_filter('woocommerce_catalog_orderby', 'furrylicious_catalog_orderby');

/**
 * Output breed filter dropdown in shop loop
 */
function furrylicious_breed_filter_dropdown() {
    // Get the parent category by slug
    $parent_cat = get_term_by('slug', 'puppies-for-sale', 'product_cat');
    $parent_id = $parent_cat ? $parent_cat->term_id : 0;

    // Get breed sub-categories under the parent
    $breeds = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'parent'     => $parent_id,
    ));

    if (is_wp_error($breeds) || empty($breeds)) {
        return;
    }

    $current_breed = isset($_GET['product_cat']) ? sanitize_text_field($_GET['product_cat']) : '';
    ?>
    <form class="puppies-ordering puppies-filter-breed" method="get" action="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>">
        <select
            name="product_cat"
            id="puppy-breed-filter"
            class="puppies-ordering__select"
            aria-label="<?php esc_attr_e('Filter by breed', 'furrylicious'); ?>"
            onchange="if(this.value === '') { window.location.href = '<?php echo esc_url(home_url('/puppies-for-sale/')); ?>'; } else { this.form.submit(); }"
        >
            <option value=""><?php esc_html_e('All Breeds', 'furrylicious'); ?></option>
            <?php foreach ($breeds as $breed) : ?>
                <option value="<?php echo esc_attr($breed->slug); ?>" <?php selected($current_breed, $breed->slug); ?>>
                    <?php echo esc_html($breed->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
    <?php
}
add_action('woocommerce_before_shop_loop', 'furrylicious_breed_filter_dropdown', 15);

/**
 * Remove sidebar from shop pages
 */
function furrylicious_remove_sidebar() {
    if (is_woocommerce()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}
add_action('wp', 'furrylicious_remove_sidebar');

/**
 * Remove /product-category/ base from product category URLs
 * Changes URLs from /product-category/breed-name/ to /breed-name/
 */

// Add custom rewrite rules for product categories at root level
add_action('init', function() {
    // Get all product categories
    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'fields' => 'all',
    ));

    if (is_wp_error($terms) || empty($terms)) {
        return;
    }

    foreach ($terms as $term) {
        // Add rewrite rule for this category
        add_rewrite_rule(
            '^' . preg_quote($term->slug, '/') . '/?$',
            'index.php?product_cat=' . $term->slug,
            'top'
        );
        // Handle pagination
        add_rewrite_rule(
            '^' . preg_quote($term->slug, '/') . '/page/([0-9]+)/?$',
            'index.php?product_cat=' . $term->slug . '&paged=$matches[1]',
            'top'
        );
    }
}, 10);

// Fix the term links to remove /product-category/
add_filter('term_link', function($url, $term, $taxonomy) {
    if ($taxonomy === 'product_cat') {
        return home_url('/' . $term->slug . '/');
    }
    return $url;
}, 10, 3);

// Prevent canonical redirects on product category URLs
add_filter('redirect_canonical', function($redirect_url, $requested_url) {
    // Get all product category slugs
    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'fields' => 'slugs',
    ));

    if (is_wp_error($terms) || empty($terms)) {
        return $redirect_url;
    }

    // Get the request path
    $path = trim(parse_url($requested_url, PHP_URL_PATH), '/');

    // If the path matches a product category slug, prevent redirect
    if (in_array($path, $terms)) {
        return false;
    }

    return $redirect_url;
}, 10, 2);

// Flush rewrite rules when product categories change
add_action('created_product_cat', 'furrylicious_flush_product_cat_rewrite_rules');
add_action('edited_product_cat', 'furrylicious_flush_product_cat_rewrite_rules');
add_action('delete_product_cat', 'furrylicious_flush_product_cat_rewrite_rules');

function furrylicious_flush_product_cat_rewrite_rules() {
    // Set a flag to flush on next page load
    update_option('furrylicious_flush_product_cat_rewrite_rules', true);
}

// Check if we need to flush rewrite rules
add_action('init', function() {
    if (get_option('furrylicious_flush_product_cat_rewrite_rules')) {
        flush_rewrite_rules();
        delete_option('furrylicious_flush_product_cat_rewrite_rules');
    }
}, 999);

// Force flush via admin URL parameter: ?flush_rewrite_rules=1
add_action('admin_init', function() {
    if (isset($_GET['flush_rewrite_rules']) && $_GET['flush_rewrite_rules'] === '1' && current_user_can('manage_options')) {
        flush_rewrite_rules();
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success"><p>Rewrite rules flushed successfully.</p></div>';
        });
    }
});
