<?php
/**
 * Frontpage Puppy Card Partial
 *
 * A simpler card component for the frontpage, using the existing puppy-card
 * CSS classes but populated with WooCommerce product data.
 *
 * @package Furrylicious
 * @since 4.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

global $product;

// Validate product
if (!$product || !is_a($product, 'WC_Product')) {
    return;
}

// Get product data
$product_id = $product->get_id();
$link       = get_permalink($product_id);
$img_id     = $product->get_image_id();

// Get pet metadata
$pet_name   = $product->get_meta('pet_name');
$breed_name = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
$gender     = $product->get_attribute('pa_gender');
$birth_date = $product->get_meta('birth_date');
$status     = get_post_meta($product_id, 'status', true);

// Coming soon status
$coming_soon = apply_filters('furrylicious_product_coming_soon', false, $product);

// Build alt text
$alt = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';
if (!$alt) {
    $alt = trim(sprintf('%s %s', (string)$pet_name, (string)$breed_name));
}
if (!$alt) {
    $alt = $breed_name ?: __('Adorable puppy', 'furrylicious');
}

// Get image URL
$image_url = '';
if ($img_id) {
    $image_data = wp_get_attachment_image_src($img_id, 'furrylicious_card');
    if (!$image_data) {
        $image_data = wp_get_attachment_image_src($img_id, 'woocommerce_thumbnail');
    }
    $image_url = $image_data ? $image_data[0] : '';
}
if (!$image_url) {
    $image_url = wc_placeholder_img_src('woocommerce_thumbnail');
}

// Calculate age from birth date
$age_display = '';
if ($birth_date) {
    $birth_timestamp = strtotime($birth_date);
    if ($birth_timestamp) {
        $now = time();
        $diff_weeks = floor(($now - $birth_timestamp) / (7 * 24 * 60 * 60));
        if ($diff_weeks < 1) {
            $age_display = __('Newborn', 'furrylicious');
        } elseif ($diff_weeks == 1) {
            $age_display = __('1 week', 'furrylicious');
        } else {
            $age_display = sprintf(__('%d weeks', 'furrylicious'), $diff_weeks);
        }
    }
}

// Gender normalization
$gender_lower = strtolower($gender);

// Determine badge text
$badge_text = '';
if ($coming_soon) {
    $badge_text = __('Coming Soon', 'furrylicious');
} elseif ($status === 'Reserved') {
    $badge_text = __('Reserved', 'furrylicious');
}
?>

<article class="puppy-card">
    <a href="<?php echo esc_url($link); ?>" class="puppy-card__link">
        <div class="puppy-card__image-wrapper">
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                class="puppy-card__image"
                loading="lazy"
            />

            <?php if ($badge_text) : ?>
                <span class="puppy-card__badge"><?php echo esc_html($badge_text); ?></span>
            <?php endif; ?>
        </div>

        <div class="puppy-card__content">
            <div class="puppy-card__header">
                <?php if (!empty($pet_name)) : ?>
                    <h3 class="puppy-card__name"><?php echo esc_html($pet_name); ?></h3>
                <?php endif; ?>

                <?php if (!empty($gender)) : ?>
                    <span class="puppy-card__gender puppy-card__gender--<?php echo esc_attr($gender_lower); ?>">
                        <?php if ($gender_lower === 'female') : ?>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle cx="12" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 14v8M9 19h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        <?php else : ?>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle cx="10" cy="14" r="6" stroke="currentColor" stroke-width="2"/>
                                <path d="M14 10l6-6M15 4h5v5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (!empty($breed_name)) : ?>
                <p class="puppy-card__breed"><?php echo esc_html($breed_name); ?></p>
            <?php endif; ?>

            <?php if (!empty($age_display)) : ?>
                <div class="puppy-card__meta">
                    <span class="puppy-card__age"><?php echo esc_html($age_display); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </a>
</article>
