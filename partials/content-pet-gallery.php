<?php
/**
 * Partial: Pet Gallery Card (Adopted Puppy)
 *
 * Displays a single adopted puppy card in gallery layouts.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_the_ID();
$post_link = get_permalink();

// Get pet meta data
$pet_name = get_post_meta($post_id, 'name', true) ?: get_the_title();
$breed_name = get_post_meta($post_id, 'breed_name', true);
$coloring = get_post_meta($post_id, 'coloring', true);
$gender = get_post_meta($post_id, 'gender', true);
$adoption_date = get_post_meta($post_id, 'adoption_date', true);

// Format adoption date if available
$formatted_date = '';
if ($adoption_date) {
    $formatted_date = date_i18n(get_option('date_format'), strtotime($adoption_date));
}

// Get image
$image_url = get_the_post_thumbnail_url($post_id, 'medium_large');
if (!$image_url) {
    $image_url = FURRYLICIOUS_ASSETS . '/images/no-image.jpg';
}
?>

<article <?php post_class('gallery-card'); ?>>
    <a href="<?php echo esc_url($post_link); ?>" class="gallery-card__link">
        <div class="gallery-card__media">
            <img src="<?php echo esc_url($image_url); ?>"
                 alt="<?php echo esc_attr($pet_name . ' - ' . $breed_name); ?>"
                 class="gallery-card__image"
                 loading="lazy" />

            <div class="gallery-card__overlay">
                <span class="gallery-card__view">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
            </div>

            <!-- Heart badge -->
            <span class="gallery-card__badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                </svg>
                <?php esc_html_e('Adopted', 'furrylicious'); ?>
            </span>
        </div>

        <div class="gallery-card__content">
            <?php if ($pet_name) : ?>
                <h3 class="gallery-card__name"><?php echo esc_html($pet_name); ?></h3>
            <?php endif; ?>

            <?php if ($breed_name) : ?>
                <p class="gallery-card__breed"><?php echo esc_html($breed_name); ?></p>
            <?php endif; ?>

            <div class="gallery-card__meta">
                <?php if ($gender) : ?>
                    <span class="gallery-card__gender gallery-card__gender--<?php echo esc_attr(strtolower($gender)); ?>">
                        <?php if (strtolower($gender) === 'male') : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="10" cy="14" r="5"></circle>
                                <line x1="19" y1="5" x2="13.6" y2="10.4"></line>
                                <line x1="14" y1="5" x2="19" y2="5"></line>
                                <line x1="19" y1="5" x2="19" y2="10"></line>
                            </svg>
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="5"></circle>
                                <line x1="12" y1="13" x2="12" y2="21"></line>
                                <line x1="9" y1="18" x2="15" y2="18"></line>
                            </svg>
                        <?php endif; ?>
                        <?php echo esc_html($gender); ?>
                    </span>
                <?php endif; ?>

                <?php if ($coloring) : ?>
                    <span class="gallery-card__color"><?php echo esc_html($coloring); ?></span>
                <?php endif; ?>
            </div>

            <?php if ($formatted_date) : ?>
                <p class="gallery-card__date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <?php echo esc_html($formatted_date); ?>
                </p>
            <?php endif; ?>
        </div>
    </a>
</article>
