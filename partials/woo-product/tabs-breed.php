<?php
/**
 * Breed Characteristics Tab
 *
 * Displays breed information with trait bars for trainability, shedding, barking, energy.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id = $product->get_id();
$breed_name = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));

// Get breed post by name
$breed_post = null;
$breed_args = array(
    'post_type'      => 'breeds',
    'posts_per_page' => 1,
    'title'          => $breed_name,
    'post_status'    => 'publish',
);
$breed_query = new WP_Query($breed_args);

if ($breed_query->have_posts()) {
    $breed_post = $breed_query->posts[0];
}
wp_reset_postdata();

// Get breed characteristics from ACF
$adult_weight_min = '';
$adult_weight_max = '';
$adult_height_min = '';
$adult_height_max = '';
$life_expectancy  = '';
$temperament      = '';
$trainability     = 0;
$shedding         = 0;
$barking          = 0;
$energy_level     = 0;

if ($breed_post) {
    $adult_weight_min = get_field('adult_weight_min', $breed_post->ID) ?: '';
    $adult_weight_max = get_field('adult_weight_max', $breed_post->ID) ?: '';
    $adult_height_min = get_field('adult_height_min', $breed_post->ID) ?: '';
    $adult_height_max = get_field('adult_height_max', $breed_post->ID) ?: '';
    $life_expectancy  = get_field('life_expectancy', $breed_post->ID) ?: '';
    $temperament      = get_field('temperament', $breed_post->ID) ?: '';
    $trainability     = intval(get_field('trainability', $breed_post->ID));
    $shedding         = intval(get_field('shedding', $breed_post->ID));
    $barking          = intval(get_field('barking', $breed_post->ID));
    $energy_level     = intval(get_field('energy_level', $breed_post->ID));
}

/**
 * Render a trait progress bar
 */
function furrylicious_render_trait_bar($label, $value, $max = 5, $color = 'rose') {
    if ($value <= 0) return;

    $percentage = ($value / $max) * 100;
    ?>
    <div class="breed-trait">
        <div class="breed-trait__header">
            <span class="breed-trait__label"><?php echo esc_html($label); ?></span>
            <span class="breed-trait__value"><?php echo esc_html($value); ?>/<?php echo esc_html($max); ?></span>
        </div>
        <div class="breed-trait__bar">
            <div class="breed-trait__fill breed-trait__fill--<?php echo esc_attr($color); ?>" style="width: <?php echo esc_attr($percentage); ?>%;"></div>
        </div>
    </div>
    <?php
}
?>

<div class="puppy-tab-content puppy-tab-content--breed">
    <?php if ($breed_post) : ?>
        <div class="breed-info">
            <h3 class="breed-info__title"><?php echo esc_html($breed_name); ?></h3>

            <?php if (!empty($temperament)) : ?>
                <p class="breed-info__temperament"><?php echo esc_html($temperament); ?></p>
            <?php endif; ?>

            <div class="breed-stats">
                <?php if (!empty($adult_weight_min) || !empty($adult_weight_max)) : ?>
                    <div class="breed-stat">
                        <span class="breed-stat__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                            </svg>
                        </span>
                        <span class="breed-stat__label"><?php esc_html_e('Adult Weight', 'furrylicious'); ?></span>
                        <span class="breed-stat__value">
                            <?php
                            if ($adult_weight_min && $adult_weight_max) {
                                printf('%s - %s lbs', esc_html($adult_weight_min), esc_html($adult_weight_max));
                            } elseif ($adult_weight_min) {
                                printf('%s lbs', esc_html($adult_weight_min));
                            } elseif ($adult_weight_max) {
                                printf('Up to %s lbs', esc_html($adult_weight_max));
                            }
                            ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($adult_height_min) || !empty($adult_height_max)) : ?>
                    <div class="breed-stat">
                        <span class="breed-stat__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 21l-6-6m6 6v-4.8m0 4.8h-4.8"></path>
                                <path d="M3 16.2V21h4.8"></path>
                                <path d="M21 7.8V3h-4.8"></path>
                                <path d="M3 3l6 6m-6-6v4.8M3 3h4.8"></path>
                            </svg>
                        </span>
                        <span class="breed-stat__label"><?php esc_html_e('Adult Height', 'furrylicious'); ?></span>
                        <span class="breed-stat__value">
                            <?php
                            if ($adult_height_min && $adult_height_max) {
                                printf('%s - %s inches', esc_html($adult_height_min), esc_html($adult_height_max));
                            } elseif ($adult_height_min) {
                                printf('%s inches', esc_html($adult_height_min));
                            } elseif ($adult_height_max) {
                                printf('Up to %s inches', esc_html($adult_height_max));
                            }
                            ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($life_expectancy)) : ?>
                    <div class="breed-stat">
                        <span class="breed-stat__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </span>
                        <span class="breed-stat__label"><?php esc_html_e('Life Expectancy', 'furrylicious'); ?></span>
                        <span class="breed-stat__value"><?php echo esc_html($life_expectancy); ?> <?php esc_html_e('years', 'furrylicious'); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($trainability || $shedding || $barking || $energy_level) : ?>
                <div class="breed-traits">
                    <h4 class="breed-traits__title"><?php esc_html_e('Breed Characteristics', 'furrylicious'); ?></h4>
                    <?php
                    furrylicious_render_trait_bar(__('Trainability', 'furrylicious'), $trainability, 5, 'sage');
                    furrylicious_render_trait_bar(__('Shedding', 'furrylicious'), $shedding, 5, 'rose');
                    furrylicious_render_trait_bar(__('Barking', 'furrylicious'), $barking, 5, 'rose');
                    furrylicious_render_trait_bar(__('Energy Level', 'furrylicious'), $energy_level, 5, 'sage');
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="breed-info breed-info--empty">
            <p><?php esc_html_e('Breed information coming soon.', 'furrylicious'); ?></p>
        </div>
    <?php endif; ?>
</div>
