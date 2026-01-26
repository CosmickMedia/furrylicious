<?php
/**
 * Puppy Detail Template
 *
 * Main layout template for single puppy pages.
 * Contains hero section, gallery, summary, and tabbed content.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id = $product->get_id();
$breed_name = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
$pet_name   = $product->get_meta('pet_name');
$coming_soon = apply_filters('furrylicious_product_coming_soon', false, $product);
?>

<div class="container">
    <?php get_template_part('partials/woo-product/summary', 'top'); ?>

    <div class="puppy-single__main">
        <div class="row">
            <div class="col-lg-7">
                <?php get_template_part('partials/woo-product/summary', 'left'); ?>
            </div>
            <div class="col-lg-5">
                <?php get_template_part('partials/woo-product/summary', 'right'); ?>
            </div>
        </div>
    </div>

    <div class="puppy-single__tabs">
        <div class="puppy-tabs">
            <div class="puppy-tabs__nav" role="tablist">
                <button class="puppy-tabs__tab puppy-tabs__tab--active" role="tab" aria-selected="true" aria-controls="tab-pet-info" id="tab-btn-pet-info">
                    Pet Info
                </button>
                <button class="puppy-tabs__tab" role="tab" aria-selected="false" aria-controls="tab-breed" id="tab-btn-breed">
                    Breed
                </button>
                <button class="puppy-tabs__tab" role="tab" aria-selected="false" aria-controls="tab-ancestry" id="tab-btn-ancestry">
                    Ancestry
                </button>
                <button class="puppy-tabs__tab" role="tab" aria-selected="false" aria-controls="tab-breeder" id="tab-btn-breeder">
                    Breeder
                </button>
                <button class="puppy-tabs__tab" role="tab" aria-selected="false" aria-controls="tab-description" id="tab-btn-description">
                    Description
                </button>
            </div>

            <div class="puppy-tabs__content">
                <div class="puppy-tabs__panel puppy-tabs__panel--active" role="tabpanel" id="tab-pet-info" aria-labelledby="tab-btn-pet-info">
                    <?php get_template_part('partials/woo-product/tabs', 'pet'); ?>
                </div>
                <div class="puppy-tabs__panel" role="tabpanel" id="tab-breed" aria-labelledby="tab-btn-breed" hidden>
                    <?php get_template_part('partials/woo-product/tabs', 'breed'); ?>
                </div>
                <div class="puppy-tabs__panel" role="tabpanel" id="tab-ancestry" aria-labelledby="tab-btn-ancestry" hidden>
                    <?php get_template_part('partials/woo-product/tabs', 'ancestry'); ?>
                </div>
                <div class="puppy-tabs__panel" role="tabpanel" id="tab-breeder" aria-labelledby="tab-btn-breeder" hidden>
                    <?php get_template_part('partials/woo-product/tabs', 'breeder'); ?>
                </div>
                <div class="puppy-tabs__panel" role="tabpanel" id="tab-description" aria-labelledby="tab-btn-description" hidden>
                    <?php get_template_part('partials/woo-product/tabs', 'description'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Related puppies
    wc_get_template_part('single-product/related');
    ?>
</div>
