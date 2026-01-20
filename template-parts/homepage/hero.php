<?php
/**
 * Template Part: Homepage Hero - Split Screen
 *
 * Boutique-style split hero with 60/40 image/content layout.
 * Features Ken Burns effect, floating badge, and elegant typography.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Static hero content - edit these values directly
$hero_eyebrow = 'Welcome to Furrylicious';
$hero_title = 'Find Your|*Perfect* Puppy';
$hero_description = 'Where every puppy finds their forever family. We specialize in healthy, happy puppies raised with love and care.';
$hero_image = get_template_directory_uri() . '/assets/images/hero-puppy.jpg';
$hero_cta_text = 'Meet Our Puppies';
$hero_cta_link = home_url('/puppies-for-sale/');
$hero_secondary_cta_text = 'Learn More';
$hero_secondary_cta_link = home_url('/about/');
$hero_accent_text = 'Bringing joy to families since 2010';
$badge_label = 'New Arrivals';
$badge_text = 'Available Now';

// Process title for line breaks (use | as delimiter)
$hero_title_formatted = str_replace('|', '<br>', esc_html($hero_title));

// Check for highlighted word (wrapped in *)
$hero_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $hero_title_formatted);
?>

<section class="hero-split" data-reveal="fade">
    <!-- Image Side -->
    <div class="hero-split__media">
        <img
            src="<?php echo esc_url($hero_image); ?>"
            alt="<?php echo esc_attr(strip_tags($hero_title)); ?>"
            class="hero-split__image"
            loading="eager"
            fetchpriority="high"
        />

        <?php if ($badge_label || $badge_text) : ?>
            <div class="hero-split__badge" data-reveal="fade-up" data-reveal-delay="300">
                <?php if ($badge_label) : ?>
                    <p class="hero-split__badge-label"><?php echo esc_html($badge_label); ?></p>
                <?php endif; ?>
                <?php if ($badge_text) : ?>
                    <p class="hero-split__badge-text"><?php echo esc_html($badge_text); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Content Side -->
    <div class="hero-split__content">
        <?php if ($hero_eyebrow) : ?>
            <p class="hero-split__eyebrow" data-reveal="fade-up"><?php echo esc_html($hero_eyebrow); ?></p>
        <?php endif; ?>

        <h1 class="hero-split__title" data-reveal="fade-up" data-reveal-delay="100">
            <?php echo $hero_title_formatted; ?>
        </h1>

        <?php if ($hero_description) : ?>
            <p class="hero-split__description" data-reveal="fade-up" data-reveal-delay="200">
                <?php echo esc_html($hero_description); ?>
            </p>
        <?php endif; ?>

        <div class="hero-split__cta" data-reveal="fade-up" data-reveal-delay="300">
            <?php if ($hero_cta_text && $hero_cta_link) : ?>
                <a href="<?php echo esc_url($hero_cta_link); ?>" class="btn btn--primary btn--lg">
                    <?php echo esc_html($hero_cta_text); ?>
                </a>
            <?php endif; ?>

            <?php if ($hero_secondary_cta_text && $hero_secondary_cta_link) : ?>
                <a href="<?php echo esc_url($hero_secondary_cta_link); ?>" class="btn btn--outline btn--lg">
                    <?php echo esc_html($hero_secondary_cta_text); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($hero_accent_text) : ?>
            <p class="hero-split__accent" data-reveal="fade-up" data-reveal-delay="400">
                <?php echo esc_html($hero_accent_text); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- Trust Bar -->
<div class="trust-bar">
    <div class="container">
        <div class="trust-bar__inner">
            <div class="trust-bar__item">
                <svg class="trust-bar__icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="trust-bar__text">Health Guarantee</span>
            </div>
            <div class="trust-bar__item">
                <svg class="trust-bar__icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="22,4 12,14.01 9,11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="trust-bar__text">Vet Checked</span>
            </div>
            <div class="trust-bar__item">
                <svg class="trust-bar__icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="trust-bar__text">Raised with Love</span>
            </div>
            <div class="trust-bar__item">
                <svg class="trust-bar__icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/>
                    <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2"/>
                </svg>
                <span class="trust-bar__text">Secure Delivery</span>
            </div>
        </div>
    </div>
</div>
