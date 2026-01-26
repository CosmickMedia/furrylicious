<?php
/**
 * Ancestry Tab
 *
 * Displays pedigree and ancestry information for the puppy.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id = $product->get_id();

// Get ancestry data from ACF or product meta
$sire_name    = get_post_meta($product_id, 'sire_name', true) ?: '';
$dam_name     = get_post_meta($product_id, 'dam_name', true) ?: '';
$sire_breed   = get_post_meta($product_id, 'sire_breed', true) ?: '';
$dam_breed    = get_post_meta($product_id, 'dam_breed', true) ?: '';
$registration = get_post_meta($product_id, 'registration', true) ?: '';
$pedigree     = get_post_meta($product_id, 'pedigree', true) ?: '';

$has_ancestry = !empty($sire_name) || !empty($dam_name) || !empty($registration) || !empty($pedigree);
?>

<div class="puppy-tab-content puppy-tab-content--ancestry">
    <?php if ($has_ancestry) : ?>
        <div class="ancestry-info">
            <?php if (!empty($registration)) : ?>
                <div class="ancestry-card ancestry-card--registration">
                    <div class="ancestry-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <div class="ancestry-card__content">
                        <span class="ancestry-card__label"><?php esc_html_e('Registration', 'furrylicious'); ?></span>
                        <span class="ancestry-card__value"><?php echo esc_html($registration); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="ancestry-tree">
                <h4 class="ancestry-tree__title"><?php esc_html_e('Parents', 'furrylicious'); ?></h4>

                <div class="ancestry-tree__parents">
                    <?php if (!empty($sire_name)) : ?>
                        <div class="ancestry-parent ancestry-parent--sire">
                            <div class="ancestry-parent__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="10" cy="14" r="5"></circle>
                                    <line x1="19" y1="5" x2="13.6" y2="10.4"></line>
                                    <line x1="19" y1="5" x2="14" y2="5"></line>
                                    <line x1="19" y1="5" x2="19" y2="10"></line>
                                </svg>
                            </div>
                            <div class="ancestry-parent__info">
                                <span class="ancestry-parent__role"><?php esc_html_e('Sire (Father)', 'furrylicious'); ?></span>
                                <span class="ancestry-parent__name"><?php echo esc_html($sire_name); ?></span>
                                <?php if (!empty($sire_breed)) : ?>
                                    <span class="ancestry-parent__breed"><?php echo esc_html($sire_breed); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($dam_name)) : ?>
                        <div class="ancestry-parent ancestry-parent--dam">
                            <div class="ancestry-parent__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="5"></circle>
                                    <line x1="12" y1="13" x2="12" y2="21"></line>
                                    <line x1="9" y1="18" x2="15" y2="18"></line>
                                </svg>
                            </div>
                            <div class="ancestry-parent__info">
                                <span class="ancestry-parent__role"><?php esc_html_e('Dam (Mother)', 'furrylicious'); ?></span>
                                <span class="ancestry-parent__name"><?php echo esc_html($dam_name); ?></span>
                                <?php if (!empty($dam_breed)) : ?>
                                    <span class="ancestry-parent__breed"><?php echo esc_html($dam_breed); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($pedigree)) : ?>
                <div class="ancestry-pedigree">
                    <h4 class="ancestry-pedigree__title"><?php esc_html_e('Pedigree Information', 'furrylicious'); ?></h4>
                    <div class="ancestry-pedigree__content">
                        <?php echo wp_kses_post($pedigree); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="ancestry-info ancestry-info--empty">
            <div class="ancestry-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                </svg>
                <p><?php esc_html_e('Ancestry information coming soon.', 'furrylicious'); ?></p>
                <p class="ancestry-empty__note"><?php esc_html_e('Contact us for details about this puppy\'s lineage.', 'furrylicious'); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
