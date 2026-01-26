<?php
/**
 * Puppy Summary Top
 *
 * Breadcrumbs and title section for single puppy page.
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
$status = get_post_meta($product_id, 'status', true);
?>

<div class="puppy-single__header">
    <nav class="puppy-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'furrylicious'); ?>">
        <ol class="puppy-breadcrumbs__list">
            <li class="puppy-breadcrumbs__item">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="puppy-breadcrumbs__link">
                    <?php esc_html_e('Home', 'furrylicious'); ?>
                </a>
            </li>
            <li class="puppy-breadcrumbs__separator" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </li>
            <li class="puppy-breadcrumbs__item">
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="puppy-breadcrumbs__link">
                    <?php esc_html_e('Puppies', 'furrylicious'); ?>
                </a>
            </li>
            <li class="puppy-breadcrumbs__separator" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </li>
            <li class="puppy-breadcrumbs__item puppy-breadcrumbs__item--current" aria-current="page">
                <?php echo esc_html($breed_name); ?>
            </li>
        </ol>
    </nav>

    <div class="puppy-single__title-row">
        <div class="puppy-single__title-group">
            <?php if (!empty($pet_name)) : ?>
                <p class="puppy-single__pet-name"><?php echo esc_html($pet_name); ?></p>
            <?php endif; ?>
            <h1 class="puppy-single__title"><?php echo esc_html($breed_name); ?></h1>
        </div>

        <div class="puppy-single__badges">
            <?php if ($coming_soon) : ?>
                <span class="puppy-single__badge puppy-single__badge--coming-soon">
                    <?php esc_html_e('Coming Soon', 'furrylicious'); ?>
                </span>
            <?php elseif ($status === 'Reserved') : ?>
                <span class="puppy-single__badge puppy-single__badge--reserved">
                    <?php esc_html_e('Reserved', 'furrylicious'); ?>
                </span>
            <?php else : ?>
                <span class="puppy-single__badge puppy-single__badge--available">
                    <?php esc_html_e('Available', 'furrylicious'); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>
