<?php
/**
 * Single Product Template
 *
 * Displays individual puppy detail page with gallery, tabs, and inquiry CTAs.
 * Furrylicious boutique styling - NO prices or cart functionality.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content
 */
do_action('woocommerce_before_main_content');

while (have_posts()) :
    the_post();

    global $product;

    // Get product data
    $product_id = $product->get_id();
    $breed_name = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
    $pet_name   = $product->get_meta('pet_name');
    ?>

    <article id="product-<?php the_ID(); ?>" <?php wc_product_class('puppy-single', $product); ?>>

        <?php
        /**
         * Hook: woocommerce_before_single_product
         *
         * @hooked woocommerce_output_all_notices - 10
         */
        do_action('woocommerce_before_single_product');
        ?>

        <div class="puppy-single__wrapper">
            <?php get_template_part('partials/woo-product/template'); ?>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product
         */
        do_action('woocommerce_after_single_product');
        ?>

    </article>

    <?php
endwhile;

/**
 * Hook: woocommerce_after_main_content
 */
do_action('woocommerce_after_main_content');

get_footer();
