<?php
/**
 * The template for displaying product content within loops
 *
 * This template wraps each puppy in the product loop.
 * The actual card content is loaded via partials/loop-product.php
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<div <?php wc_product_class('puppy-grid__item', $product); ?>>
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item
     */
    do_action('woocommerce_before_shop_loop_item');

    /**
     * Hook: woocommerce_before_shop_loop_item_title
     */
    do_action('woocommerce_before_shop_loop_item_title');

    /**
     * Hook: woocommerce_shop_loop_item_title
     *
     * @hooked furrylicious_custom_loop_product - 10 (loads partials/loop-product.php)
     */
    do_action('woocommerce_shop_loop_item_title');

    /**
     * Hook: woocommerce_after_shop_loop_item_title
     */
    do_action('woocommerce_after_shop_loop_item_title');

    /**
     * Hook: woocommerce_after_shop_loop_item
     */
    do_action('woocommerce_after_shop_loop_item');
    ?>
</div>
