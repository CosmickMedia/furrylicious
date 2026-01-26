<?php
/**
 * Description Tab
 *
 * Displays the product/puppy description.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id = $product->get_id();
$description = $product->get_description();
$short_description = $product->get_short_description();

$breed_name = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
$pet_name = $product->get_meta('pet_name');
?>

<div class="puppy-tab-content puppy-tab-content--description">
    <div class="puppy-description">
        <?php if (!empty($description) || !empty($short_description)) : ?>
            <div class="puppy-description__content">
                <?php if (!empty($short_description)) : ?>
                    <div class="puppy-description__intro">
                        <?php echo wp_kses_post($short_description); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($description)) : ?>
                    <div class="puppy-description__main">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div class="puppy-description__empty">
                <div class="description-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <h4><?php printf(esc_html__('Meet %s', 'furrylicious'), esc_html($pet_name ?: 'this adorable puppy')); ?></h4>
                    <p>
                        <?php
                        printf(
                            esc_html__('This beautiful %s is looking for their forever home. Contact us to learn more about this puppy\'s personality, temperament, and why they might be the perfect addition to your family.', 'furrylicious'),
                            esc_html($breed_name)
                        );
                        ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/contact-us/?puppy=' . $product_id)); ?>" class="puppy-description__cta btn btn--primary">
                        <?php esc_html_e('Ask About This Puppy', 'furrylicious'); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
