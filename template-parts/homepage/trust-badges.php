<?php
/**
 * Template Part: Trust Badges
 *
 * Displays trust indicators like BBB rating, certifications, etc.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Trust badges - can be made dynamic via ACF
$badges = array(
    array(
        'icon'  => 'shield-check',
        'title' => __('Health Guaranteed', 'furrylicious'),
        'text'  => __('All puppies come with a health guarantee', 'furrylicious'),
    ),
    array(
        'icon'  => 'star',
        'title' => __('A+ BBB Rating', 'furrylicious'),
        'text'  => __('Rated A+ by the Better Business Bureau', 'furrylicious'),
    ),
    array(
        'icon'  => 'heart',
        'title' => __('Trusted Breeders', 'furrylicious'),
        'text'  => __('We work only with reputable, caring breeders', 'furrylicious'),
    ),
    array(
        'icon'  => 'users',
        'title' => __('Expert Support', 'furrylicious'),
        'text'  => __('Ongoing support for new puppy parents', 'furrylicious'),
    ),
);

// SVG Icons
$icons = array(
    'shield-check' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>',
    'star' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>',
    'heart' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
    'users' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
);

// Allow filtering badges
$badges = apply_filters('furrylicious_trust_badges', $badges);
?>

<section class="section section-trust" aria-label="<?php esc_attr_e('Why Choose Us', 'furrylicious'); ?>">
    <div class="container">
        <div class="trust-badges scroll-reveal-stagger">
            <?php foreach ($badges as $badge) : ?>
                <div class="trust-badge">
                    <div class="trust-badge__icon" aria-hidden="true">
                        <?php
                        if (isset($icons[$badge['icon']])) {
                            echo $icons[$badge['icon']];
                        }
                        ?>
                    </div>
                    <div>
                        <strong class="trust-badge__text"><?php echo esc_html($badge['title']); ?></strong>
                        <?php if (!empty($badge['text'])) : ?>
                            <br>
                            <small><?php echo esc_html($badge['text']); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
