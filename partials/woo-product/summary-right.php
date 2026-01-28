<?php
/**
 * Puppy Summary Right
 *
 * Contact CTA, metadata, and quick info section.
 * NO prices - catalog only.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id   = $product->get_id();
$breed_name   = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
$pet_name     = $product->get_meta('pet_name');
$ref_id       = $product->get_meta('reference_number');
$birth_date   = $product->get_meta('birth_date');
$gender       = $product->get_attribute('pa_gender');
$color        = $product->get_attribute('pa_color');
$status       = get_post_meta($product_id, 'status', true);
$coming_soon  = apply_filters('furrylicious_product_coming_soon', false, $product);

// Get contact info from ACF options
$phone = get_field('phone', 'option') ?: '';
$email = get_field('email', 'option') ?: '';

// Format birthday
$birthday_formatted = '';
$age_text = '';
if ($birth_date) {
    $birthday_formatted = wp_date('F j, Y', strtotime((string)$birth_date));

    // Calculate age
    $birth_timestamp = strtotime((string)$birth_date);
    $now = time();
    $diff = $now - $birth_timestamp;
    $weeks = floor($diff / (60 * 60 * 24 * 7));

    if ($weeks < 1) {
        $age_text = __('Newborn', 'furrylicious');
    } elseif ($weeks < 8) {
        $age_text = sprintf(_n('%d week old', '%d weeks old', $weeks, 'furrylicious'), $weeks);
    } else {
        $months = floor($weeks / 4);
        if ($months < 12) {
            $age_text = sprintf(_n('%d month old', '%d months old', $months, 'furrylicious'), $months);
        } else {
            $years = floor($months / 12);
            $age_text = sprintf(_n('%d year old', '%d years old', $years, 'furrylicious'), $years);
        }
    }
}

// Gender icon and class
$gender_class = strtolower($gender) === 'male' ? 'puppy-summary__gender--male' : 'puppy-summary__gender--female';
?>

<div class="puppy-summary">
    <div class="puppy-summary__card">
        <div class="puppy-summary__quick-facts">
            <?php if (!empty($gender)) : ?>
                <div class="puppy-summary__fact">
                    <span class="puppy-summary__fact-icon <?php echo esc_attr($gender_class); ?>">
                        <?php if (strtolower($gender) === 'male') : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="10" cy="14" r="5"></circle>
                                <line x1="19" y1="5" x2="13.6" y2="10.4"></line>
                                <line x1="19" y1="5" x2="14" y2="5"></line>
                                <line x1="19" y1="5" x2="19" y2="10"></line>
                            </svg>
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="5"></circle>
                                <line x1="12" y1="13" x2="12" y2="21"></line>
                                <line x1="9" y1="18" x2="15" y2="18"></line>
                            </svg>
                        <?php endif; ?>
                    </span>
                    <span class="puppy-summary__fact-label"><?php esc_html_e('Gender', 'furrylicious'); ?></span>
                    <span class="puppy-summary__fact-value"><?php echo esc_html($gender); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($age_text)) : ?>
                <div class="puppy-summary__fact">
                    <span class="puppy-summary__fact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </span>
                    <span class="puppy-summary__fact-label"><?php esc_html_e('Age', 'furrylicious'); ?></span>
                    <span class="puppy-summary__fact-value"><?php echo esc_html($age_text); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($ref_id)) : ?>
                <div class="puppy-summary__fact">
                    <span class="puppy-summary__fact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <span class="puppy-summary__fact-label"><?php esc_html_e('Reference ID', 'furrylicious'); ?></span>
                    <span class="puppy-summary__fact-value"><?php echo esc_html($ref_id); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($birthday_formatted)) : ?>
                <div class="puppy-summary__fact">
                    <span class="puppy-summary__fact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </span>
                    <span class="puppy-summary__fact-label"><?php esc_html_e('Birthday', 'furrylicious'); ?></span>
                    <span class="puppy-summary__fact-value"><?php echo esc_html($birthday_formatted); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($color)) : ?>
                <div class="puppy-summary__fact">
                    <span class="puppy-summary__fact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="13.5" cy="6.5" r=".5"></circle>
                            <circle cx="17.5" cy="10.5" r=".5"></circle>
                            <circle cx="8.5" cy="7.5" r=".5"></circle>
                            <circle cx="6.5" cy="12.5" r=".5"></circle>
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.555C21.965 6.012 17.461 2 12 2z"></path>
                        </svg>
                    </span>
                    <span class="puppy-summary__fact-label"><?php esc_html_e('Color', 'furrylicious'); ?></span>
                    <span class="puppy-summary__fact-value"><?php echo esc_html($color); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <div class="puppy-summary__actions">
            <a href="<?php echo esc_url(home_url('/contact/?puppy=' . $product_id)); ?>" class="puppy-summary__cta puppy-summary__cta--primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <?php esc_html_e('Inquire About This Puppy', 'furrylicious'); ?>
            </a>

            <a href="<?php echo esc_url(home_url('/contact/?visit=1&puppy=' . $product_id)); ?>" class="puppy-summary__cta puppy-summary__cta--secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <?php esc_html_e('Schedule a Visit', 'furrylicious'); ?>
            </a>

            <?php if (!empty($phone)) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="puppy-summary__cta puppy-summary__cta--phone">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <?php echo esc_html($phone); ?>
                </a>
            <?php endif; ?>
        </div>

        <p class="puppy-summary__note">
            <?php esc_html_e('Questions? Our team is here to help you find your perfect companion.', 'furrylicious'); ?>
        </p>
    </div>
</div>
