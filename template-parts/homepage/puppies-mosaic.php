<?php
/**
 * Template Part: Puppies Mosaic Grid
 *
 * Asymmetric editorial-style puppy grid with featured + supporting cards.
 * Static content for easy editing.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Section settings
$section_eyebrow = 'Meet Our Puppies';
$section_title = 'Find Your New|*Best Friend*';
$section_description = 'Each of our puppies is raised with love, socialized from day one, and ready to become part of your family.';

// Process title formatting
$section_title_formatted = str_replace('|', '<br>', esc_html($section_title));
$section_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $section_title_formatted);

// Static puppies data - edit these directly
$puppies = [
    [
        'name' => 'Luna',
        'breed' => 'Golden Retriever',
        'age' => '10 weeks',
        'gender' => 'female',
        'price' => '$2,800',
        'image' => get_template_directory_uri() . '/assets/images/puppies/puppy-1.jpg',
        'link' => home_url('/puppies-for-sale/luna/'),
        'badge' => 'Just Arrived',
        'featured' => true,
    ],
    [
        'name' => 'Milo',
        'breed' => 'French Bulldog',
        'age' => '12 weeks',
        'gender' => 'male',
        'price' => '$4,500',
        'image' => get_template_directory_uri() . '/assets/images/puppies/puppy-2.jpg',
        'link' => home_url('/puppies-for-sale/milo/'),
        'badge' => '',
        'featured' => false,
    ],
    [
        'name' => 'Daisy',
        'breed' => 'Mini Goldendoodle',
        'age' => '9 weeks',
        'gender' => 'female',
        'price' => '$3,200',
        'image' => get_template_directory_uri() . '/assets/images/puppies/puppy-3.jpg',
        'link' => home_url('/puppies-for-sale/daisy/'),
        'badge' => '',
        'featured' => false,
    ],
    [
        'name' => 'Charlie',
        'breed' => 'Cavalier King Charles',
        'age' => '11 weeks',
        'gender' => 'male',
        'price' => '$3,000',
        'image' => get_template_directory_uri() . '/assets/images/puppies/puppy-4.jpg',
        'link' => home_url('/puppies-for-sale/charlie/'),
        'badge' => 'Reserved',
        'featured' => false,
    ],
    [
        'name' => 'Bella',
        'breed' => 'Bernedoodle',
        'age' => '8 weeks',
        'gender' => 'female',
        'price' => '$3,800',
        'image' => get_template_directory_uri() . '/assets/images/puppies/puppy-5.jpg',
        'link' => home_url('/puppies-for-sale/bella/'),
        'badge' => '',
        'featured' => false,
    ],
];
?>

<section class="puppies-mosaic" data-reveal="fade">
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

        <div class="puppies-mosaic__grid">
            <?php foreach ($puppies as $index => $puppy) :
                $card_class = 'puppy-card';
                if ($puppy['featured']) {
                    $card_class .= ' puppy-card--featured';
                }
                $delay = ($index % 3) * 100;
            ?>
                <article class="<?php echo esc_attr($card_class); ?>" data-reveal="fade-up" data-reveal-delay="<?php echo $delay; ?>">
                    <a href="<?php echo esc_url($puppy['link']); ?>" class="puppy-card__link">
                        <div class="puppy-card__image-wrapper">
                            <img
                                src="<?php echo esc_url($puppy['image']); ?>"
                                alt="<?php echo esc_attr($puppy['name']); ?> - <?php echo esc_attr($puppy['breed']); ?>"
                                class="puppy-card__image"
                                loading="lazy"
                            />

                            <?php if ($puppy['badge']) : ?>
                                <span class="puppy-card__badge"><?php echo esc_html($puppy['badge']); ?></span>
                            <?php endif; ?>

                            <div class="puppy-card__overlay">
                                <span class="puppy-card__view">View Profile</span>
                            </div>
                        </div>

                        <div class="puppy-card__content">
                            <div class="puppy-card__header">
                                <h3 class="puppy-card__name"><?php echo esc_html($puppy['name']); ?></h3>
                                <span class="puppy-card__gender puppy-card__gender--<?php echo esc_attr($puppy['gender']); ?>">
                                    <?php if ($puppy['gender'] === 'female') : ?>
                                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <circle cx="12" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
                                            <path d="M12 14v8M9 19h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    <?php else : ?>
                                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <circle cx="10" cy="14" r="6" stroke="currentColor" stroke-width="2"/>
                                            <path d="M14 10l6-6M15 4h5v5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <p class="puppy-card__breed"><?php echo esc_html($puppy['breed']); ?></p>

                            <div class="puppy-card__meta">
                                <span class="puppy-card__age"><?php echo esc_html($puppy['age']); ?></span>
                                <span class="puppy-card__price"><?php echo esc_html($puppy['price']); ?></span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="puppies-mosaic__cta" data-reveal="fade-up">
            <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--primary btn--lg">
                View All Puppies
            </a>
        </div>
    </div>
</section>
