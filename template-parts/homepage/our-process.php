<?php
/**
 * Template Part: Our Process
 *
 * Displays the puppy buying process steps.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Process steps - can be made dynamic via ACF
$steps = array(
    array(
        'number' => '1',
        'title'  => __('Browse Our Puppies', 'furrylicious'),
        'description' => __('Explore our selection of healthy, happy puppies from trusted breeders.', 'furrylicious'),
    ),
    array(
        'number' => '2',
        'title'  => __('Visit Our Boutique', 'furrylicious'),
        'description' => __('Meet your favorite puppies in person at our beautiful boutique location.', 'furrylicious'),
    ),
    array(
        'number' => '3',
        'title'  => __('Take Your Puppy Home', 'furrylicious'),
        'description' => __('Complete your adoption and bring your new family member home with confidence.', 'furrylicious'),
    ),
);

// Allow filtering steps
$steps = apply_filters('furrylicious_process_steps', $steps);
?>

<section class="section section-process scroll-reveal">
    <div class="container">
        <div class="section-header">
            <span class="section-header__subtitle"><?php esc_html_e('How It Works', 'furrylicious'); ?></span>
            <h2 class="section-header__title section-title">
                <?php esc_html_e('Your Journey to Finding the Perfect Puppy', 'furrylicious'); ?>
            </h2>
        </div>

        <div class="process-steps scroll-reveal-stagger">
            <?php foreach ($steps as $step) : ?>
                <div class="process-step">
                    <span class="process-step__number"><?php echo esc_html($step['number']); ?></span>
                    <h3 class="process-step__title"><?php echo esc_html($step['title']); ?></h3>
                    <p class="process-step__description"><?php echo esc_html($step['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--primary btn--lg">
                <?php esc_html_e('Start Your Journey', 'furrylicious'); ?>
            </a>
        </div>
    </div>
</section>
