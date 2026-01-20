<?php
/**
 * Template Part: Testimonials Marquee
 *
 * Polaroid-style testimonials in infinite horizontal scroll.
 * Static content for easy editing.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Static testimonials data - edit these directly
$testimonials = [
    [
        'quote' => 'Our little Luna has brought so much joy to our family. The team at Furrylicious made the whole process feel like working with friends.',
        'author' => 'Sarah M.',
        'location' => 'Austin, TX',
        'pet_name' => 'Luna',
        'pet_breed' => 'Golden Retriever',
        'image' => get_template_directory_uri() . '/assets/images/testimonials/family-1.jpg',
    ],
    [
        'quote' => 'From our first visit to bringing Milo home, every step was transparent and caring. You can tell they truly love these puppies.',
        'author' => 'The Johnson Family',
        'location' => 'Denver, CO',
        'pet_name' => 'Milo',
        'pet_breed' => 'French Bulldog',
        'image' => get_template_directory_uri() . '/assets/images/testimonials/family-2.jpg',
    ],
    [
        'quote' => 'Best decision we ever made! Daisy is healthy, happy, and the perfect addition to our home. Thank you Furrylicious!',
        'author' => 'Jennifer K.',
        'location' => 'Seattle, WA',
        'pet_name' => 'Daisy',
        'pet_breed' => 'Cavalier King Charles',
        'image' => get_template_directory_uri() . '/assets/images/testimonials/family-3.jpg',
    ],
    [
        'quote' => 'The health guarantee gave us peace of mind, and the lifetime support has been invaluable. Charlie is thriving!',
        'author' => 'Michael & David',
        'location' => 'Portland, OR',
        'pet_name' => 'Charlie',
        'pet_breed' => 'Mini Goldendoodle',
        'image' => get_template_directory_uri() . '/assets/images/testimonials/family-4.jpg',
    ],
    [
        'quote' => 'We drove 4 hours to visit and it was absolutely worth it. The facility was spotless and the puppies were so well socialized.',
        'author' => 'Amanda R.',
        'location' => 'Phoenix, AZ',
        'pet_name' => 'Bella',
        'pet_breed' => 'Bernedoodle',
        'image' => get_template_directory_uri() . '/assets/images/testimonials/family-5.jpg',
    ],
    [
        'quote' => 'Second puppy from Furrylicious and we couldn\'t be happier. They remember us by name and always follow up to see how our pups are doing.',
        'author' => 'The Martinez Family',
        'location' => 'San Diego, CA',
        'pet_name' => 'Cooper & Max',
        'pet_breed' => 'Labrador Retrievers',
        'image' => get_template_directory_uri() . '/assets/images/testimonials/family-6.jpg',
    ],
];

// Section settings
$section_eyebrow = 'Happy Families';
$section_title = 'Stories from Our|*Furrylicious* Families';
$section_description = 'Every puppy has a story, and every family becomes part of ours.';

// Process title for line breaks (use | as delimiter)
$section_title_formatted = str_replace('|', '<br>', esc_html($section_title));

// Check for highlighted word (wrapped in *)
$section_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $section_title_formatted);
?>

<section class="testimonials-marquee" data-reveal="fade">
    <div class="container">
        <header class="section-header section-header--center" data-reveal="fade-up">
            <?php if ($section_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($section_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $section_title_formatted; ?>
            </h2>

            <?php if ($section_description) : ?>
                <p class="section-header__description"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </header>
    </div>

    <!-- Marquee Track - duplicated for seamless loop -->
    <div class="marquee-container">
        <div class="marquee-track">
            <?php
            // Render testimonials twice for seamless infinite scroll
            for ($loop = 0; $loop < 2; $loop++) :
                foreach ($testimonials as $index => $testimonial) :
            ?>
                <article class="testimonial-polaroid" data-reveal="fade-up" data-reveal-delay="<?php echo ($index % 3) * 100; ?>">
                    <img
                        src="<?php echo esc_url($testimonial['image']); ?>"
                        alt="<?php echo esc_attr($testimonial['author']); ?> with <?php echo esc_attr($testimonial['pet_name']); ?>"
                        class="testimonial-polaroid__image"
                        loading="lazy"
                    />

                    <div class="testimonial-polaroid__content">
                        <blockquote class="testimonial-polaroid__quote">
                            "<?php echo esc_html($testimonial['quote']); ?>"
                        </blockquote>

                        <footer class="testimonial-polaroid__footer">
                            <cite class="testimonial-polaroid__author">
                                <?php echo esc_html($testimonial['author']); ?>
                            </cite>
                            <span class="testimonial-polaroid__location">
                                <?php echo esc_html($testimonial['location']); ?>
                            </span>
                        </footer>

                        <p class="testimonial-polaroid__pet">
                            <span class="testimonial-polaroid__pet-name"><?php echo esc_html($testimonial['pet_name']); ?></span>
                            <span class="testimonial-polaroid__pet-breed"><?php echo esc_html($testimonial['pet_breed']); ?></span>
                        </p>
                    </div>
                </article>
            <?php
                endforeach;
            endfor;
            ?>
        </div>
    </div>

    <div class="container">
        <div class="testimonials-marquee__cta" data-reveal="fade-up">
            <a href="<?php echo esc_url(home_url('/reviews/')); ?>" class="btn btn--outline btn--lg">
                Read More Reviews
            </a>
        </div>
    </div>
</section>
