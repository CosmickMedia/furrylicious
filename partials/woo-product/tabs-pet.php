<?php
/**
 * Pet Info Tab
 *
 * Displays pet-specific information like status, ID, availability, birth date, gender, etc.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id   = $product->get_id();
$ref_id       = $product->get_meta('reference_number');
$status       = get_post_meta($product_id, 'status', true) ?: 'Available';
$birth_date   = $product->get_meta('birth_date');
$gender       = $product->get_attribute('pa_gender');
$color        = $product->get_attribute('pa_color');
$availability = get_post_meta($product_id, 'availability_date', true);

// Calculate age
$age_text = '';
if ($birth_date) {
    $birth_timestamp = strtotime((string)$birth_date);
    $now = time();
    $diff = $now - $birth_timestamp;
    $weeks = floor($diff / (60 * 60 * 24 * 7));

    if ($weeks < 1) {
        $age_text = __('Newborn', 'furrylicious');
    } elseif ($weeks < 8) {
        $age_text = sprintf(_n('%d week', '%d weeks', $weeks, 'furrylicious'), $weeks);
    } else {
        $months = floor($weeks / 4);
        if ($months < 12) {
            $age_text = sprintf(_n('%d month', '%d months', $months, 'furrylicious'), $months);
        } else {
            $years = floor($months / 12);
            $remaining_months = $months % 12;
            if ($remaining_months > 0) {
                $age_text = sprintf(__('%d year, %d months', 'furrylicious'), $years, $remaining_months);
            } else {
                $age_text = sprintf(_n('%d year', '%d years', $years, 'furrylicious'), $years);
            }
        }
    }
}
?>

<div class="puppy-tab-content puppy-tab-content--pet">
    <div class="puppy-info-grid">
        <?php if (!empty($status)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Status', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html($status); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($ref_id)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="4" y1="9" x2="20" y2="9"></line>
                        <line x1="4" y1="15" x2="20" y2="15"></line>
                        <line x1="10" y1="3" x2="8" y2="21"></line>
                        <line x1="16" y1="3" x2="14" y2="21"></line>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Reference ID', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html($ref_id); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($availability)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Available', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html(wp_date('F j, Y', strtotime($availability))); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($birth_date)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Birthday', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html(wp_date('F j, Y', strtotime($birth_date))); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($age_text)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Age', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html($age_text); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($gender)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <?php if (strtolower($gender) === 'male') : ?>
                            <circle cx="10" cy="14" r="5"></circle>
                            <line x1="19" y1="5" x2="13.6" y2="10.4"></line>
                            <line x1="19" y1="5" x2="14" y2="5"></line>
                            <line x1="19" y1="5" x2="19" y2="10"></line>
                        <?php else : ?>
                            <circle cx="12" cy="8" r="5"></circle>
                            <line x1="12" y1="13" x2="12" y2="21"></line>
                            <line x1="9" y1="18" x2="15" y2="18"></line>
                        <?php endif; ?>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Gender', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html($gender); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($color)) : ?>
            <div class="puppy-info-card">
                <div class="puppy-info-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="13.5" cy="6.5" r=".5"></circle>
                        <circle cx="17.5" cy="10.5" r=".5"></circle>
                        <circle cx="8.5" cy="7.5" r=".5"></circle>
                        <circle cx="6.5" cy="12.5" r=".5"></circle>
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.555C21.965 6.012 17.461 2 12 2z"></path>
                    </svg>
                </div>
                <div class="puppy-info-card__content">
                    <span class="puppy-info-card__label"><?php esc_html_e('Color', 'furrylicious'); ?></span>
                    <span class="puppy-info-card__value"><?php echo esc_html($color); ?></span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
