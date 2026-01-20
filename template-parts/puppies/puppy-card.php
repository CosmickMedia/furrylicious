<?php
/**
 * Template Part: Puppy Card
 *
 * Displays a single puppy card.
 *
 * @package Furrylicious
 * @version 2.0.0
 *
 * @param object $puppy    Puppy data object.
 * @param bool   $featured Whether this is a featured card (optional).
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get puppy data from args or global
$puppy = isset($args['puppy']) ? $args['puppy'] : (isset($puppy) ? $puppy : null);
$featured = isset($args['featured']) ? $args['featured'] : false;

if (!$puppy) {
    return;
}

// Extract puppy properties
$name = isset($puppy->name) ? $puppy->name : '';
$breed = isset($puppy->breed_name) ? $puppy->breed_name : '';
$gender = isset($puppy->gender) ? $puppy->gender : '';
$image = isset($puppy->list_photo) ? $puppy->list_photo : '';
$link = isset($puppy->permalink) ? $puppy->permalink : '#';

// Card class
$card_class = $featured ? 'puppy-card puppy-card--featured' : 'puppy-card';

// Alt text
$alt_text = sprintf(
    '%s%s puppy',
    !empty($name) ? $name . ' - ' : '',
    $breed
);
?>

<article class="<?php echo esc_attr($card_class); ?>">
    <a href="<?php echo esc_url($link); ?>" class="puppy-card__link">
        <div class="puppy-card__image-wrapper">
            <?php if ($image) : ?>
                <img
                    src="<?php echo esc_url($image); ?>"
                    alt="<?php echo esc_attr($alt_text); ?>"
                    class="puppy-card__image"
                    loading="lazy"
                    decoding="async"
                />
            <?php else : ?>
                <div class="puppy-card__placeholder">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="currentColor"/>
                    </svg>
                </div>
            <?php endif; ?>

            <?php if ($gender) : ?>
                <span class="puppy-card__badge puppy-card__badge--<?php echo esc_attr(strtolower($gender)); ?>">
                    <?php echo esc_html($gender); ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="puppy-card__content">
            <?php if ($name) : ?>
                <h3 class="puppy-card__name"><?php echo esc_html($name); ?></h3>
            <?php endif; ?>

            <?php if ($breed) : ?>
                <span class="puppy-card__breed"><?php echo esc_html($breed); ?></span>
            <?php endif; ?>
        </div>

        <div class="puppy-card__overlay">
            <span class="btn btn--primary"><?php esc_html_e('Learn More', 'furrylicious'); ?></span>
        </div>
    </a>
</article>
