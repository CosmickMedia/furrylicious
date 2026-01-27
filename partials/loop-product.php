<?php
/**
 * Product Card Component - Boutique Design
 *
 * Displays a single puppy in the product grid with Furrylicious boutique styling.
 * Features action buttons, video meet & greet, unlock promo badge, and location badge.
 *
 * NO prices or cart functionality - catalog only.
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
$img_id     = $product->get_image_id();
$link       = get_permalink($product_id);

// Get pet metadata
$pet_name    = $product->get_meta('pet_name');
$breed_name  = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
$ref_id      = $product->get_meta('reference_number');
$birth_date  = $product->get_meta('birth_date');
$gender      = $product->get_attribute('pa_gender');
$video       = $product->get_meta('video');

// Coming soon status
$coming_soon = apply_filters('furrylicious_product_coming_soon', false, $product);

// Status for badges
$status = get_post_meta($product_id, 'status', true);

// Unlock promo - can be controlled via filter or meta
$show_unlock_promo = apply_filters('furrylicious_show_unlock_promo', true, $product);

// Store constants
$phone      = defined('FURRYLICIOUS_PHONE') ? FURRYLICIOUS_PHONE : '(908) 823-4468';
$phone_link = defined('FURRYLICIOUS_PHONE_LINK') ? FURRYLICIOUS_PHONE_LINK : 'tel:+19088234468';
$booking_url = defined('FURRYLICIOUS_BOOKING_URL') ? FURRYLICIOUS_BOOKING_URL : '#';
$location   = defined('FURRYLICIOUS_LOCATION') ? FURRYLICIOUS_LOCATION : 'Furrylicious';

// Build alt text
$alt = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : '';
if (!$alt) {
    $alt = trim(sprintf('%s %s', (string)$pet_name, (string)$breed_name));
}
if (!$alt) {
    $alt = $breed_name ?: __('Adorable puppy', 'furrylicious');
}

/**
 * Image handling with LCP optimization
 * First card loads eagerly, others lazy load
 */
$product_image = '';
if ($img_id) {
    $preferred_size = 'furrylicious_card';
    $has_custom_size = image_get_intermediate_size($img_id, $preferred_size);
    $render_size = $has_custom_size ? $preferred_size : 'woocommerce_thumbnail';

    static $card_index = 0;
    $card_index++;

    $attrs = array(
        'class'    => 'product-card__image',
        'alt'      => esc_attr($alt),
        'sizes'    => '(max-width: 480px) 100vw, (max-width: 768px) 50vw, 25vw',
        'decoding' => 'async',
    );

    if ($card_index <= 4) {
        $attrs['loading'] = 'eager';
        $attrs['fetchpriority'] = $card_index === 1 ? 'high' : 'auto';
    } else {
        $attrs['loading'] = 'lazy';
    }

    $product_image = wp_get_attachment_image($img_id, $render_size, false, $attrs);
}

// Gender icon and class
$gender_lower = strtolower($gender);
$gender_icon = '';
if ($gender_lower === 'male') {
    $gender_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10.5" cy="13.5" r="7.5"></circle><line x1="21" y1="3" x2="15" y2="9"></line><polyline points="21 9 21 3 15 3"></polyline></svg>';
} elseif ($gender_lower === 'female') {
    $gender_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="7"></circle><line x1="12" y1="15" x2="12" y2="22"></line><line x1="9" y1="19" x2="15" y2="19"></line></svg>';
}

// Format birthday
$birthday_formatted = '';
if ($birth_date) {
    $birthday_formatted = wp_date('M j, Y', strtotime((string)$birth_date));
}

// Data attributes for modal buttons
$modal_data = sprintf(
    'data-pet-id="%s" data-pet-name="%s" data-pet-ref="%s" data-breed="%s"',
    esc_attr($product_id),
    esc_attr($pet_name),
    esc_attr($ref_id),
    esc_attr($breed_name)
);
?>

<article class="product-card" itemscope itemtype="https://schema.org/Product">
    <div class="product-card__media">
        <a href="<?php echo esc_url($link); ?>" class="product-card__image-link" aria-label="<?php printf(esc_attr__('View %s', 'furrylicious'), esc_attr($breed_name)); ?>">
            <?php if (!empty($product_image)) : ?>
                <?php echo $product_image; ?>
            <?php else : ?>
                <div class="product-card__placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span><?php esc_html_e('Photo coming soon', 'furrylicious'); ?></span>
                </div>
            <?php endif; ?>
        </a>

        <!-- Location Badge -->
        <div class="product-card__location-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
            <span><?php echo esc_html($location); ?></span>
        </div>

        <!-- Status Badges -->
        <div class="product-card__badges">
            <?php if ($coming_soon) : ?>
                <span class="product-card__badge product-card__badge--coming-soon">
                    <?php esc_html_e('Coming Soon', 'furrylicious'); ?>
                </span>
            <?php elseif ($status === 'Reserved') : ?>
                <span class="product-card__badge product-card__badge--reserved">
                    <?php esc_html_e('Reserved', 'furrylicious'); ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($video)) : ?>
                <span class="product-card__badge product-card__badge--video">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <?php esc_html_e('Video', 'furrylicious'); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Unlock Promo Badge -->
        <?php if ($show_unlock_promo) : ?>
            <button type="button"
                    class="product-card__unlock-badge"
                    data-bs-toggle="modal"
                    data-bs-target="#unlockPromoModal"
                    <?php echo $modal_data; ?>
                    aria-label="<?php esc_attr_e('Unlock special pricing', 'furrylicious'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                </svg>
                <span><?php esc_html_e('Unlock Promo', 'furrylicious'); ?></span>
            </button>
        <?php endif; ?>
    </div>

    <div class="product-card__content">
        <!-- Breed Label -->
        <p class="product-card__breed"><?php echo esc_html($breed_name); ?></p>

        <!-- Pet Name -->
        <?php if (!empty($pet_name)) : ?>
            <h3 class="product-card__name" itemprop="name">
                <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($pet_name); ?></a>
            </h3>
        <?php endif; ?>

        <!-- Info Grid -->
        <div class="product-card__info-grid">
            <?php if (!empty($ref_id)) : ?>
                <div class="product-card__info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 9h16"></path>
                        <path d="M4 15h16"></path>
                        <path d="M10 3L8 21"></path>
                        <path d="M16 3l-2 18"></path>
                    </svg>
                    <span><?php echo esc_html($ref_id); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($birthday_formatted)) : ?>
                <div class="product-card__info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <rect x="2" y="14" width="20" height="8" rx="2"></rect>
                        <path d="M12 6V2"></path>
                        <path d="M8 10V6"></path>
                        <path d="M16 10V6"></path>
                        <path d="M12 6a2 2 0 0 1 2 2v2H10V8a2 2 0 0 1 2-2z"></path>
                    </svg>
                    <span><?php echo esc_html($birthday_formatted); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($gender)) : ?>
                <div class="product-card__info-item product-card__info-item--<?php echo esc_attr($gender_lower); ?>">
                    <?php echo $gender_icon; ?>
                    <span><?php echo esc_html($gender); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="product-card__actions">
            <a href="<?php echo esc_url($phone_link); ?>" class="product-card__action-btn product-card__action-btn--call" aria-label="<?php printf(esc_attr__('Call about %s', 'furrylicious'), esc_attr($pet_name)); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span><?php esc_html_e('Call', 'furrylicious'); ?></span>
            </a>

            <button type="button"
                    class="product-card__action-btn product-card__action-btn--email"
                    data-bs-toggle="modal"
                    data-bs-target="#petEnquiryModal"
                    <?php echo $modal_data; ?>
                    aria-label="<?php printf(esc_attr__('Email about %s', 'furrylicious'), esc_attr($pet_name)); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span><?php esc_html_e('Email', 'furrylicious'); ?></span>
            </button>

            <a href="<?php echo esc_url($booking_url); ?>" class="product-card__action-btn product-card__action-btn--book" aria-label="<?php printf(esc_attr__('Book visit to see %s', 'furrylicious'), esc_attr($pet_name)); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span><?php esc_html_e('Book Visit', 'furrylicious'); ?></span>
            </a>
        </div>

        <!-- Video Meet & Greet Button -->
        <button type="button"
                class="product-card__video-btn"
                data-bs-toggle="modal"
                data-bs-target="#videoMeetingModal"
                <?php echo $modal_data; ?>>
            <span class="product-card__video-btn-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                </svg>
            </span>
            <span class="product-card__video-btn-text"><?php esc_html_e('Video Meet & Greet', 'furrylicious'); ?></span>
            <span class="product-card__video-btn-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </span>
        </button>

        <!-- More Info CTA -->
        <a href="<?php echo esc_url($link); ?>" class="product-card__cta btn btn--primary">
            <?php esc_html_e('More Info', 'furrylicious'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>
</article>
