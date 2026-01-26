<?php
/**
 * Breeder Info Tab
 *
 * Displays breeder information and certifications.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id = $product->get_id();

// Get breeder data from product meta
$breeder_name    = get_post_meta($product_id, 'breeder_name', true) ?: '';
$breeder_state   = get_post_meta($product_id, 'breeder_state', true) ?: '';
$usda_license    = get_post_meta($product_id, 'usda_license', true) ?: '';

$has_breeder_info = !empty($breeder_name) || !empty($usda_license);
?>

<div class="puppy-tab-content puppy-tab-content--breeder">
    <?php if ($has_breeder_info) : ?>
        <div class="breeder-info">
            <div class="breeder-card">
                <div class="breeder-card__header">
                    <div class="breeder-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <h4 class="breeder-card__title"><?php esc_html_e('Breeder Information', 'furrylicious'); ?></h4>
                </div>

                <div class="breeder-card__content">
                    <?php if (!empty($breeder_name)) : ?>
                        <div class="breeder-detail">
                            <span class="breeder-detail__label"><?php esc_html_e('Breeder Name', 'furrylicious'); ?></span>
                            <span class="breeder-detail__value"><?php echo esc_html($breeder_name); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($breeder_state)) : ?>
                        <div class="breeder-detail">
                            <span class="breeder-detail__label"><?php esc_html_e('Location', 'furrylicious'); ?></span>
                            <span class="breeder-detail__value"><?php echo esc_html($breeder_state); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($usda_license)) : ?>
                        <div class="breeder-detail">
                            <span class="breeder-detail__label"><?php esc_html_e('USDA License', 'furrylicious'); ?></span>
                            <span class="breeder-detail__value"><?php echo esc_html($usda_license); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="breeder-commitment">
                <h4 class="breeder-commitment__title"><?php esc_html_e('Our Commitment', 'furrylicious'); ?></h4>
                <div class="breeder-commitment__grid">
                    <div class="commitment-item">
                        <div class="commitment-item__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <span class="commitment-item__text"><?php esc_html_e('Health Tested Parents', 'furrylicious'); ?></span>
                    </div>
                    <div class="commitment-item">
                        <div class="commitment-item__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <span class="commitment-item__text"><?php esc_html_e('Veterinary Care', 'furrylicious'); ?></span>
                    </div>
                    <div class="commitment-item">
                        <div class="commitment-item__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <span class="commitment-item__text"><?php esc_html_e('Socialized Puppies', 'furrylicious'); ?></span>
                    </div>
                    <div class="commitment-item">
                        <div class="commitment-item__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <span class="commitment-item__text"><?php esc_html_e('Lifetime Support', 'furrylicious'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="breeder-info breeder-info--empty">
            <div class="breeder-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <p><?php esc_html_e('Breeder information available upon request.', 'furrylicious'); ?></p>
                <p class="breeder-empty__note"><?php esc_html_e('Contact us to learn more about our trusted breeding partners.', 'furrylicious'); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
