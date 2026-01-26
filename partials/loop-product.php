<?php
/**
 * Puppy Card Component
 *
 * Displays a single puppy in the product grid with Furrylicious boutique styling.
 * Uses warm colors (espresso, rose, cream, blush) and elegant typography
 * (Cormorant Garamond, Montserrat, Open Sans).
 *
 * NO prices or cart functionality - catalog only.
 *
 * @package Furrylicious
 * @since 1.0.0
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
        'class'    => 'puppy-card__image',
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

// Gender class for badge styling
$gender_class = strtolower($gender) === 'male' ? 'puppy-card__badge--male' : 'puppy-card__badge--female';

// Format birthday
$birthday_formatted = '';
if ($birth_date) {
    $birthday_formatted = wp_date('M j, Y', strtotime((string)$birth_date));
}
?>

<article class="puppy-card" itemscope itemtype="https://schema.org/Product">
    <a href="<?php echo esc_url($link); ?>" class="puppy-card__link" aria-label="<?php printf(esc_attr__('View %s', 'furrylicious'), esc_attr($breed_name)); ?>">

        <div class="puppy-card__media">
            <?php if (!empty($product_image)) : ?>
                <?php echo $product_image; ?>
            <?php else : ?>
                <div class="puppy-card__placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span><?php esc_html_e('Photo coming soon', 'furrylicious'); ?></span>
                </div>
            <?php endif; ?>

            <div class="puppy-card__badges">
                <?php if (!empty($gender)) : ?>
                    <span class="puppy-card__badge <?php echo esc_attr($gender_class); ?>">
                        <?php echo esc_html($gender); ?>
                    </span>
                <?php endif; ?>

                <?php if ($coming_soon) : ?>
                    <span class="puppy-card__badge puppy-card__badge--coming-soon">
                        <?php esc_html_e('Coming Soon', 'furrylicious'); ?>
                    </span>
                <?php elseif ($status === 'Reserved') : ?>
                    <span class="puppy-card__badge puppy-card__badge--reserved">
                        <?php esc_html_e('Reserved', 'furrylicious'); ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (!empty($video)) : ?>
                <div class="puppy-card__video-badge" aria-label="<?php esc_attr_e('Video available', 'furrylicious'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <span><?php esc_html_e('Video', 'furrylicious'); ?></span>
                </div>
            <?php endif; ?>
        </div>

    </a>

    <div class="puppy-card__content">
        <?php if (!empty($pet_name)) : ?>
            <p class="puppy-card__name" itemprop="name"><?php echo esc_html($pet_name); ?></p>
        <?php endif; ?>

        <h3 class="puppy-card__breed">
            <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($breed_name); ?></a>
        </h3>

        <ul class="puppy-card__details">
            <?php if (!empty($gender)) : ?>
                <li class="puppy-card__detail">
                    <span class="puppy-card__detail-label"><?php esc_html_e('Gender', 'furrylicious'); ?></span>
                    <span class="puppy-card__detail-value"><?php echo esc_html($gender); ?></span>
                </li>
            <?php endif; ?>

            <?php if (!empty($ref_id)) : ?>
                <li class="puppy-card__detail">
                    <span class="puppy-card__detail-label"><?php esc_html_e('ID', 'furrylicious'); ?></span>
                    <span class="puppy-card__detail-value"><?php echo esc_html($ref_id); ?></span>
                </li>
            <?php endif; ?>

            <?php if (!empty($birthday_formatted)) : ?>
                <li class="puppy-card__detail">
                    <span class="puppy-card__detail-label"><?php esc_html_e('Birthday', 'furrylicious'); ?></span>
                    <span class="puppy-card__detail-value"><?php echo esc_html($birthday_formatted); ?></span>
                </li>
            <?php endif; ?>
        </ul>

        <a href="<?php echo esc_url($link); ?>" class="puppy-card__cta btn btn--primary">
            <?php esc_html_e('View Puppy', 'furrylicious'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>
</article>
