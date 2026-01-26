<?php
/**
 * Partial: Breed Card
 *
 * Displays a single breed card in archive/grid layouts.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$breed_id = get_the_ID();
$breed_name = get_the_title();
$breed_link = get_permalink();
$breed_excerpt = get_the_excerpt();

// ACF fields
$temperament = get_field('temperament');
$size = get_field('size');
$life_expectancy = get_field('life_expectancy');

// Get available puppies count for this breed
$available_count = 0;
if (function_exists('wc_get_products')) {
    $args = array(
        'status'   => 'publish',
        'limit'    => -1,
        'return'   => 'ids',
        'category' => array(sanitize_title($breed_name)),
    );
    $products = wc_get_products($args);
    $available_count = count($products);
}
?>

<article <?php post_class('breed-card'); ?>>
    <a href="<?php echo esc_url($breed_link); ?>" class="breed-card__link">
        <div class="breed-card__media">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium_large', array(
                    'class' => 'breed-card__image',
                    'alt'   => esc_attr($breed_name),
                )); ?>
            <?php else : ?>
                <div class="breed-card__placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                        <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                    </svg>
                </div>
            <?php endif; ?>

            <?php if ($available_count > 0) : ?>
                <span class="breed-card__badge">
                    <?php echo esc_html(sprintf(_n('%d Available', '%d Available', $available_count, 'furrylicious'), $available_count)); ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="breed-card__content">
            <h2 class="breed-card__title"><?php echo esc_html($breed_name); ?></h2>

            <?php if ($breed_excerpt) : ?>
                <p class="breed-card__excerpt"><?php echo esc_html($breed_excerpt); ?></p>
            <?php endif; ?>

            <ul class="breed-card__traits">
                <?php if ($size) : ?>
                    <li class="breed-card__trait">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        </svg>
                        <span><?php echo esc_html($size); ?></span>
                    </li>
                <?php endif; ?>

                <?php if ($life_expectancy) : ?>
                    <li class="breed-card__trait">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                        </svg>
                        <span><?php echo esc_html($life_expectancy); ?></span>
                    </li>
                <?php endif; ?>

                <?php if ($temperament) : ?>
                    <li class="breed-card__trait breed-card__trait--full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                        <span><?php echo esc_html(wp_trim_words($temperament, 5)); ?></span>
                    </li>
                <?php endif; ?>
            </ul>

            <span class="breed-card__cta">
                <?php esc_html_e('Learn More', 'furrylicious'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </span>
        </div>
    </a>
</article>
