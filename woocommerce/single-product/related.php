<?php
/**
 * Related Products
 *
 * Displays related puppies with boutique styling.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

if (!$product) {
    return;
}

$args = array(
    'posts_per_page' => 4,
    'columns'        => 4,
    'orderby'        => 'rand',
    'order'          => 'desc',
);

$args = apply_filters('woocommerce_output_related_products_args', $args);

$related_products = wc_get_related_products($product->get_id(), $args['posts_per_page'], $product->get_upsell_ids());

if (!$related_products) {
    return;
}

$related_products = array_map('wc_get_product', $related_products);
$related_products = array_filter($related_products, 'wc_products_array_filter_visible');
$related_products = wc_products_array_orderby($related_products, $args['orderby'], $args['order']);
$related_products = array_slice($related_products, 0, $args['posts_per_page']);

if (empty($related_products)) {
    return;
}
?>

<section class="related-puppies">
    <header class="related-puppies__header">
        <h2 class="related-puppies__title"><?php esc_html_e('You May Also Love', 'furrylicious'); ?></h2>
        <p class="related-puppies__subtitle"><?php esc_html_e('Meet more adorable puppies waiting for their forever homes', 'furrylicious'); ?></p>
    </header>

    <ul class="puppy-grid puppy-grid--related products">
        <?php foreach ($related_products as $related_product) : ?>
            <?php
            $post_object = get_post($related_product->get_id());

            setup_postdata($GLOBALS['post'] =& $post_object);

            wc_get_template_part('content', 'product');
            ?>
        <?php endforeach; ?>
    </ul>

    <div class="related-puppies__footer">
        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn--outline">
            <?php esc_html_e('View All Puppies', 'furrylicious'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>

</section>

<?php
wp_reset_postdata();
