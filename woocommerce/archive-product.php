<?php
/**
 * The Template for displaying product archives (Shop page / Puppies page)
 *
 * Furrylicious boutique styling with warm colors and elegant typography.
 * This is a catalog-only display - no prices or cart functionality.
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
?>

<div class="puppies-archive">
    <header class="puppies-archive__header">
        <div class="container">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="puppies-archive__title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description
             */
            do_action('woocommerce_archive_description');
            ?>
        </div>
    </header>

    <div class="puppies-archive__content">
        <div class="container">
            <?php
            if (woocommerce_product_loop()) {

                /**
                 * Hook: woocommerce_before_shop_loop
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');

                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
            } else {
                /**
                 * Hook: woocommerce_no_products_found
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action('woocommerce_no_products_found');
            }
            ?>
        </div>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content
 */
do_action('woocommerce_after_main_content');

get_footer();
