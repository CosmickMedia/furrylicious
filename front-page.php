<?php
/**
 * Front Page Template
 *
 * The main homepage with boutique-style editorial sections.
 * No ACF dependencies - all content is static for easy editing.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

get_header();
?>

<!-- Hero Section - Split screen with Ken Burns effect -->
<?php get_template_part('template-parts/homepage/hero'); ?>

<!-- Puppies Mosaic - Editorial asymmetric grid -->
<?php get_template_part('template-parts/homepage/puppies-mosaic'); ?>

<!-- Experience Journey - Horizontal scroll storytelling -->
<?php get_template_part('template-parts/homepage/experience-scroll'); ?>

<!-- Why Choose Us - Alternating image/text blocks -->
<?php get_template_part('template-parts/homepage/why-us'); ?>

<!-- Testimonials - Polaroid marquee -->
<?php get_template_part('template-parts/homepage/testimonials'); ?>

<!-- Lead Capture - Elegant boutique form -->
<?php get_template_part('template-parts/homepage/lead-capture'); ?>

<!-- Instagram Feed (Optional) -->
<?php
// Static Instagram settings - set $show_instagram to false to hide
$show_instagram = true;
$instagram_handle = '@furrylicious';
$instagram_link = 'https://instagram.com/furrylicious';

// Static Instagram images - replace with actual images
$instagram_images = [
    get_template_directory_uri() . '/assets/images/instagram/insta-1.jpg',
    get_template_directory_uri() . '/assets/images/instagram/insta-2.jpg',
    get_template_directory_uri() . '/assets/images/instagram/insta-3.jpg',
    get_template_directory_uri() . '/assets/images/instagram/insta-4.jpg',
    get_template_directory_uri() . '/assets/images/instagram/insta-5.jpg',
    get_template_directory_uri() . '/assets/images/instagram/insta-6.jpg',
];

if ($show_instagram) :
?>
<section class="instagram-feed" data-reveal="fade">
    <div class="container">
        <header class="instagram-feed__header" data-reveal="fade-up">
            <p class="instagram-feed__label">Follow Along</p>
            <a href="<?php echo esc_url($instagram_link); ?>" class="instagram-feed__handle" target="_blank" rel="noopener">
                <?php echo esc_html($instagram_handle); ?>
            </a>
        </header>
    </div>

    <div class="instagram-feed__grid">
        <?php foreach ($instagram_images as $index => $image) : ?>
            <a href="<?php echo esc_url($instagram_link); ?>" class="instagram-feed__item" target="_blank" rel="noopener" data-reveal="fade-up" data-reveal-delay="<?php echo $index * 50; ?>">
                <img
                    src="<?php echo esc_url($image); ?>"
                    alt="Instagram post"
                    class="instagram-feed__image"
                    loading="lazy"
                />
                <div class="instagram-feed__overlay">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>
                        <circle cx="18" cy="6" r="1" fill="currentColor"/>
                    </svg>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
