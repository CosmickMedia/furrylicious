<?php
/**
 * Front Page Template
 *
 * The main homepage with boutique-style editorial sections.
 * All content is static for easy editing.
 *
 * @package Furrylicious
 * @version 4.0.0
 */

get_header();

// =============================================================================
// HERO SECTION
// =============================================================================
$hero_eyebrow = 'Welcome to Furrylicious';
$hero_title = 'Find Your|*Perfect* Puppy';
$hero_description = 'Where every puppy finds their forever family. We specialize in healthy, happy puppies raised with love and care.';
$hero_image = get_template_directory_uri() . '/assets/images/furrylicious-hero.jpg';
$hero_cta_text = 'Meet Our Puppies';
$hero_cta_link = home_url('/puppies-for-sale/');
$hero_secondary_cta_text = 'Learn More';
$hero_secondary_cta_link = home_url('/about/');
$hero_accent_text = 'Bringing joy to families since 2010';
$badge_label = 'New Arrivals';
$badge_text = 'Available Now';

$hero_title_formatted = str_replace('|', '<br>', esc_html($hero_title));
$hero_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $hero_title_formatted);
?>

<section class="hero-split hero-split--reversed">
    <div class="hero-split__content">
        <?php if ($hero_eyebrow) : ?>
            <p class="hero-split__eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
        <?php endif; ?>

        <h1 class="hero-split__title">
            <?php echo $hero_title_formatted; ?>
        </h1>

        <?php if ($hero_description) : ?>
            <p class="hero-split__description">
                <?php echo esc_html($hero_description); ?>
            </p>
        <?php endif; ?>

        <div class="hero-split__cta">
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
            <p class="hero-split__accent">
                <?php echo esc_html($hero_accent_text); ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="hero-split__media">
        <img
            src="<?php echo esc_url($hero_image); ?>"
            alt="<?php echo esc_attr(strip_tags($hero_title)); ?>"
            class="hero-split__image"
            loading="eager"
            fetchpriority="high"
        />

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

<?php
// =============================================================================
// PUPPIES MOSAIC SECTION
// =============================================================================
$puppies_eyebrow = 'Meet Our Puppies';
$puppies_title = 'Find Your New|*Best Friend*';
$puppies_description = 'Each of our puppies is raised with love, socialized from day one, and ready to become part of your family.';

$puppies_title_formatted = str_replace('|', '<br>', esc_html($puppies_title));
$puppies_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $puppies_title_formatted);

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

<section class="puppies-mosaic">
    <div class="container">
        <header class="section-header section-header--center">
            <?php if ($puppies_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($puppies_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $puppies_title_formatted; ?>
            </h2>

            <?php if ($puppies_description) : ?>
                <p class="section-header__description"><?php echo esc_html($puppies_description); ?></p>
            <?php endif; ?>
        </header>

        <div class="puppies-mosaic__grid">
            <?php foreach ($puppies as $index => $puppy) :
                $card_class = 'puppy-card';
                if ($puppy['featured']) {
                    $card_class .= ' puppy-card--featured';
                }
            ?>
                <article class="<?php echo esc_attr($card_class); ?>">
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

        <div class="puppies-mosaic__cta">
            <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--primary btn--lg">
                View All Puppies
            </a>
        </div>
    </div>
</section>

<?php
// =============================================================================
// EXPERIENCE SECTION - Simplified to static grid
// =============================================================================
$experience_eyebrow = 'The Journey';
$experience_title = 'The *Furrylicious* Experience';
$experience_description = 'From first visit to forever family, we make finding your perfect puppy simple and joyful.';

$experience_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', esc_html($experience_title));

$steps = [
    [
        'number' => '01',
        'title' => 'Browse & Discover',
        'description' => 'Explore our available puppies online. Each profile includes photos, personality traits, health information, and pricing.',
        'icon' => 'search',
        'accent' => 'Find your match',
    ],
    [
        'number' => '02',
        'title' => 'Connect With Us',
        'description' => 'Reach out with questions or schedule a visit. Our team is here to help you find the perfect companion for your lifestyle.',
        'icon' => 'chat',
        'accent' => 'We\'re here for you',
    ],
    [
        'number' => '03',
        'title' => 'Visit & Bond',
        'description' => 'Come meet your potential puppy in person. Spend time bonding and make sure it\'s the perfect fit for your family.',
        'icon' => 'heart',
        'accent' => 'Love at first sight',
    ],
    [
        'number' => '04',
        'title' => 'Take Home',
        'description' => 'Complete the adoption process and welcome your new family member. We provide a full puppy care kit and lifetime support.',
        'icon' => 'home',
        'accent' => 'Welcome home',
    ],
];

$icons = [
    'search' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><circle cx="20" cy="20" r="14" stroke="currentColor" stroke-width="3"/><path d="M30 30L42 42" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>',
    'chat' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M42 24c0 9.941-8.059 18-18 18-3.032 0-5.895-.749-8.405-2.073L6 42l2.073-9.595A17.9 17.9 0 016 24C6 14.059 14.059 6 24 6s18 8.059 18 18z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="24" r="2" fill="currentColor"/><circle cx="24" cy="24" r="2" fill="currentColor"/><circle cx="32" cy="24" r="2" fill="currentColor"/></svg>',
    'heart' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M24 42S6 30 6 18c0-6.627 5.373-12 12-12 4.314 0 6 3 6 3s1.686-3 6-3c6.627 0 12 5.373 12 12 0 12-18 24-18 24z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'home' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M6 24L24 6l18 18" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 20v18a2 2 0 002 2h24a2 2 0 002-2V20" stroke="currentColor" stroke-width="3"/><path d="M18 40V28a2 2 0 012-2h8a2 2 0 012 2v12" stroke="currentColor" stroke-width="3"/></svg>',
];
?>

<section class="experience-section">
    <div class="container">
        <header class="section-header">
            <?php if ($experience_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($experience_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $experience_title_formatted; ?>
            </h2>

            <?php if ($experience_description) : ?>
                <p class="section-header__description"><?php echo esc_html($experience_description); ?></p>
            <?php endif; ?>
        </header>

        <div class="experience-grid">
            <?php foreach ($steps as $step) : ?>
                <article class="experience-card">
                    <div class="experience-card__number"><?php echo esc_html($step['number']); ?></div>

                    <div class="experience-card__icon">
                        <?php echo $icons[$step['icon']]; ?>
                    </div>

                    <h3 class="experience-card__title"><?php echo esc_html($step['title']); ?></h3>

                    <p class="experience-card__description"><?php echo esc_html($step['description']); ?></p>

                    <p class="experience-card__accent"><?php echo esc_html($step['accent']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// =============================================================================
// WHY US SECTION
// =============================================================================
$why_eyebrow = 'Why Furrylicious';
$why_title = 'Why Families|*Choose Us*';

$why_title_formatted = str_replace('|', '<br>', esc_html($why_title));
$why_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $why_title_formatted);

$reasons = [
    [
        'number' => '01',
        'title' => 'Health First, Always',
        'description' => 'Every puppy receives comprehensive veterinary care, genetic testing, and vaccinations before going home. Our health guarantee gives you peace of mind for years to come.',
        'image' => get_template_directory_uri() . '/assets/images/why-us/health.jpg',
        'points' => [
            'Full veterinary examination',
            'Up-to-date vaccinations',
            'Genetic health testing',
            '2-year health guarantee',
        ],
    ],
    [
        'number' => '02',
        'title' => 'Raised With Love',
        'description' => 'Our puppies are raised in a home environment, not kennels. They\'re socialized with children, other pets, and everyday sounds to ensure a smooth transition to your family.',
        'image' => get_template_directory_uri() . '/assets/images/why-us/love.jpg',
        'points' => [
            'Home-raised environment',
            'Early socialization program',
            'Exposure to household sounds',
            'Handled daily with care',
        ],
    ],
    [
        'number' => '03',
        'title' => 'Lifetime Support',
        'description' => 'Your journey with us doesn\'t end at pickup. We\'re here for training questions, health advice, and anything else you need. Once you\'re family, you\'re family forever.',
        'image' => get_template_directory_uri() . '/assets/images/why-us/support.jpg',
        'points' => [
            '24/7 phone & email support',
            'Training resources & tips',
            'Private owner community',
            'Breeder network referrals',
        ],
    ],
];
?>

<section class="why-us">
    <div class="container">
        <header class="section-header section-header--center">
            <?php if ($why_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($why_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $why_title_formatted; ?>
            </h2>
        </header>

        <div class="why-us__blocks">
            <?php foreach ($reasons as $index => $reason) :
                $is_reversed = $index % 2 !== 0;
            ?>
                <div class="why-us-block<?php echo $is_reversed ? ' why-us-block--reversed' : ''; ?>">
                    <div class="why-us-block__image">
                        <img
                            src="<?php echo esc_url($reason['image']); ?>"
                            alt="<?php echo esc_attr($reason['title']); ?>"
                            loading="lazy"
                        />
                        <span class="why-us-block__number"><?php echo esc_html($reason['number']); ?></span>
                    </div>

                    <div class="why-us-block__content">
                        <h3 class="why-us-block__title"><?php echo esc_html($reason['title']); ?></h3>

                        <p class="why-us-block__description"><?php echo esc_html($reason['description']); ?></p>

                        <?php if (!empty($reason['points'])) : ?>
                            <ul class="why-us-block__list">
                                <?php foreach ($reason['points'] as $point) : ?>
                                    <li class="why-us-block__list-item">
                                        <svg viewBox="0 0 24 24" fill="none" class="why-us-block__check" aria-hidden="true">
                                            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo esc_html($point); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="why-us__cta">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--outline btn--lg">
                Learn More About Us
            </a>
        </div>
    </div>
</section>

<?php
// =============================================================================
// TESTIMONIALS SECTION - Simple grid instead of marquee
// =============================================================================
$testimonials_eyebrow = 'Happy Families';
$testimonials_title = 'Stories from Our|*Furrylicious* Families';
$testimonials_description = 'Every puppy has a story, and every family becomes part of ours.';

$testimonials_title_formatted = str_replace('|', '<br>', esc_html($testimonials_title));
$testimonials_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $testimonials_title_formatted);

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
];
?>

<section class="testimonials-section">
    <div class="container">
        <header class="section-header section-header--center">
            <?php if ($testimonials_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($testimonials_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $testimonials_title_formatted; ?>
            </h2>

            <?php if ($testimonials_description) : ?>
                <p class="section-header__description"><?php echo esc_html($testimonials_description); ?></p>
            <?php endif; ?>
        </header>

        <div class="testimonials-grid">
            <?php foreach ($testimonials as $testimonial) : ?>
                <article class="testimonial-card">
                    <img
                        src="<?php echo esc_url($testimonial['image']); ?>"
                        alt="<?php echo esc_attr($testimonial['author']); ?> with <?php echo esc_attr($testimonial['pet_name']); ?>"
                        class="testimonial-card__image"
                        loading="lazy"
                    />

                    <div class="testimonial-card__content">
                        <blockquote class="testimonial-card__quote">
                            "<?php echo esc_html($testimonial['quote']); ?>"
                        </blockquote>

                        <footer class="testimonial-card__footer">
                            <cite class="testimonial-card__author">
                                <?php echo esc_html($testimonial['author']); ?>
                            </cite>
                            <span class="testimonial-card__location">
                                <?php echo esc_html($testimonial['location']); ?>
                            </span>
                        </footer>

                        <p class="testimonial-card__pet">
                            <span class="testimonial-card__pet-name"><?php echo esc_html($testimonial['pet_name']); ?></span>
                            <span class="testimonial-card__pet-breed"><?php echo esc_html($testimonial['pet_breed']); ?></span>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="testimonials-section__cta">
            <a href="<?php echo esc_url(home_url('/reviews/')); ?>" class="btn btn--outline btn--lg">
                Read More Reviews
            </a>
        </div>
    </div>
</section>

<?php
// =============================================================================
// LEAD CAPTURE SECTION
// =============================================================================
$lead_eyebrow = 'Stay Connected';
$lead_title = 'Join the *Furrylicious* Family';
$lead_description = 'Be the first to know about new puppy arrivals, special offers, and puppy care tips. We promise no spam—just puppy love!';

$lead_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', esc_html($lead_title));

$form_action = home_url('/newsletter-signup/');
$show_preferences = true;

$breeds = [
    'goldendoodle' => 'Goldendoodle',
    'french-bulldog' => 'French Bulldog',
    'cavalier' => 'Cavalier King Charles',
    'golden-retriever' => 'Golden Retriever',
    'bernedoodle' => 'Bernedoodle',
    'labrador' => 'Labrador Retriever',
    'other' => 'Other / Not Sure',
];
?>

<section class="lead-capture">
    <div class="lead-capture__background">
        <div class="lead-capture__pattern"></div>
    </div>

    <div class="container">
        <div class="lead-capture__inner">
            <header class="lead-capture__header">
                <?php if ($lead_eyebrow) : ?>
                    <p class="section-header__eyebrow"><?php echo esc_html($lead_eyebrow); ?></p>
                <?php endif; ?>

                <h2 class="lead-capture__title">
                    <?php echo $lead_title_formatted; ?>
                </h2>

                <?php if ($lead_description) : ?>
                    <p class="lead-capture__description"><?php echo esc_html($lead_description); ?></p>
                <?php endif; ?>
            </header>

            <form class="lead-capture__form" action="<?php echo esc_url($form_action); ?>" method="post">
                <?php wp_nonce_field('furrylicious_lead_capture', 'lead_capture_nonce'); ?>

                <div class="lead-capture__form-grid">
                    <div class="form-field form-field--floating">
                        <input
                            type="text"
                            id="lead-first-name"
                            name="first_name"
                            class="form-field__input"
                            required
                            autocomplete="given-name"
                        />
                        <label for="lead-first-name" class="form-field__label">First Name</label>
                    </div>

                    <div class="form-field form-field--floating">
                        <input
                            type="text"
                            id="lead-last-name"
                            name="last_name"
                            class="form-field__input"
                            required
                            autocomplete="family-name"
                        />
                        <label for="lead-last-name" class="form-field__label">Last Name</label>
                    </div>

                    <div class="form-field form-field--floating form-field--full">
                        <input
                            type="email"
                            id="lead-email"
                            name="email"
                            class="form-field__input"
                            required
                            autocomplete="email"
                        />
                        <label for="lead-email" class="form-field__label">Email Address</label>
                    </div>

                    <div class="form-field form-field--floating form-field--full">
                        <input
                            type="tel"
                            id="lead-phone"
                            name="phone"
                            class="form-field__input"
                            autocomplete="tel"
                        />
                        <label for="lead-phone" class="form-field__label">Phone (Optional)</label>
                    </div>
                </div>

                <?php if ($show_preferences) : ?>
                    <div class="lead-capture__preferences">
                        <p class="lead-capture__preferences-label">I'm interested in: <span class="optional">(Optional)</span></p>

                        <div class="lead-capture__breeds">
                            <?php foreach ($breeds as $value => $label) : ?>
                                <label class="lead-capture__breed-option">
                                    <input type="checkbox" name="breeds[]" value="<?php echo esc_attr($value); ?>" />
                                    <span class="lead-capture__breed-chip"><?php echo esc_html($label); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="lead-capture__gender">
                            <p class="lead-capture__preferences-sublabel">Gender preference:</p>
                            <div class="lead-capture__gender-options">
                                <label class="lead-capture__gender-option">
                                    <input type="radio" name="gender_preference" value="any" checked />
                                    <span class="lead-capture__gender-chip">No Preference</span>
                                </label>
                                <label class="lead-capture__gender-option">
                                    <input type="radio" name="gender_preference" value="female" />
                                    <span class="lead-capture__gender-chip">Female</span>
                                </label>
                                <label class="lead-capture__gender-option">
                                    <input type="radio" name="gender_preference" value="male" />
                                    <span class="lead-capture__gender-chip">Male</span>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="lead-capture__consent">
                    <label class="lead-capture__checkbox">
                        <input type="checkbox" name="consent" required />
                        <span class="lead-capture__checkbox-mark"></span>
                        <span class="lead-capture__checkbox-text">
                            I agree to receive emails about puppies, promotions, and news.
                            <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" target="_blank">Privacy Policy</a>
                        </span>
                    </label>
                </div>

                <div class="lead-capture__submit">
                    <button type="submit" class="btn btn--primary btn--lg btn--full">
                        <span class="btn__text">Join the Family</span>
                        <svg class="btn__icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <p class="lead-capture__privacy">
                    We respect your privacy. Unsubscribe anytime.
                </p>
            </form>

            <div class="lead-capture__trust">
                <div class="lead-capture__trust-item">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Secure & Private</span>
                </div>
                <div class="lead-capture__trust-item">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="22,4 12,14.01 9,11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>No Spam, Ever</span>
                </div>
                <div class="lead-capture__trust-item">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Unsubscribe Anytime</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// =============================================================================
// INSTAGRAM SECTION
// =============================================================================
$show_instagram = true;
$instagram_handle = '@furrylicious';
$instagram_link = 'https://instagram.com/furrylicious';

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
<section class="instagram-feed">
    <div class="container">
        <header class="instagram-feed__header">
            <p class="instagram-feed__label">Follow Along</p>
            <a href="<?php echo esc_url($instagram_link); ?>" class="instagram-feed__handle" target="_blank" rel="noopener">
                <?php echo esc_html($instagram_handle); ?>
            </a>
        </header>
    </div>

    <div class="instagram-feed__grid">
        <?php foreach ($instagram_images as $index => $image) : ?>
            <a href="<?php echo esc_url($instagram_link); ?>" class="instagram-feed__item" target="_blank" rel="noopener">
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
