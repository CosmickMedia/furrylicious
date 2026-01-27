<?php
/**
 * Template Name: Look Inside Furrylicious
 *
 * Virtual tour and gallery of the Furrylicious facility.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();
?>

<?php
// Schema.org JSON-LD Structured Data
$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'ImageGallery',
            'name' => 'Furrylicious Facility Tour',
            'description' => 'Take a virtual tour of our clean, comfortable puppy boutique',
            'url' => home_url('/look-inside/'),
            'about' => [
                '@type' => 'Place',
                'name' => 'Furrylicious',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => '531 US Highway 22 E',
                    'addressLocality' => 'Whitehouse Station',
                    'addressRegion' => 'NJ',
                    'postalCode' => '08889',
                    'addressCountry' => 'US'
                ]
            ]
        ],
        [
            '@type' => 'Place',
            'name' => 'Furrylicious Puppy Boutique',
            'description' => 'Premium puppy boutique with climate-controlled environment and play areas',
            'amenityFeature' => [
                ['@type' => 'LocationFeatureSpecification', 'name' => 'Climate Control'],
                ['@type' => 'LocationFeatureSpecification', 'name' => 'Play Areas'],
                ['@type' => 'LocationFeatureSpecification', 'name' => 'Private Meeting Rooms'],
                ['@type' => 'LocationFeatureSpecification', 'name' => 'Retail Boutique']
            ]
        ]
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="tour-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="tour-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Look Inside', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="tour-page__hero" aria-label="Virtual Tour">
        <div class="tour-page__hero-background">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/tour-hero.jpg'); ?>"
                alt="Inside Furrylicious boutique"
                loading="eager"
            >
            <div class="tour-page__hero-overlay"></div>
        </div>
        <div class="container">
            <div class="tour-page__hero-content">
                <span class="tour-page__section-label">Welcome</span>
                <h1 class="tour-page__hero-title">See Where the Magic Happens</h1>
                <p class="tour-page__hero-description">Take a virtual tour of our boutique and see why families trust us with their puppy journey. Clean, comfortable, and designed with love for every puppy.</p>

                <div class="tour-page__hero-cta">
                    <a href="#video-tour" class="btn btn--white btn--lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"/>
                        </svg>
                        Watch Video Tour
                    </a>
                    <a href="#gallery" class="btn btn--outline btn--lg" style="border-color: white; color: white;">
                        View Gallery
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Tour -->
    <section id="video-tour" class="tour-page__video" aria-labelledby="video-heading">
        <div class="container">
            <header class="tour-page__video-header">
                <span class="tour-page__section-label">Video Tour</span>
                <h2 id="video-heading" class="tour-page__section-title">Take a Walk Through</h2>
                <p class="tour-page__section-description">Join us for a guided tour of our facility and see how we care for our puppies every day.</p>
            </header>

            <div class="tour-page__video-wrapper">
                <iframe
                    src="https://www.youtube.com/embed/VnlnqPz6PBQ?rel=0&modestbranding=1"
                    title="Furrylicious Facility Tour"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </section>

    <!-- Photo Gallery -->
    <section id="gallery" class="tour-page__gallery" aria-labelledby="gallery-heading">
        <div class="container">
            <header class="tour-page__gallery-header">
                <span class="tour-page__section-label">Photo Gallery</span>
                <h2 id="gallery-heading" class="tour-page__section-title">Explore Our Space</h2>
            </header>

            <div class="tour-page__gallery-filters">
                <button class="tour-page__filter-btn is-active" data-filter="all">All</button>
                <button class="tour-page__filter-btn" data-filter="interior">Interior</button>
                <button class="tour-page__filter-btn" data-filter="play-areas">Play Areas</button>
                <button class="tour-page__filter-btn" data-filter="puppy-suites">Puppy Suites</button>
                <button class="tour-page__filter-btn" data-filter="retail">Retail</button>
            </div>

            <div class="tour-page__gallery-grid" data-lightbox-gallery>
                <?php
                $gallery_images = [
                    ['src' => 'tour-1.jpg', 'alt' => 'Furrylicious main entrance and reception', 'category' => 'interior'],
                    ['src' => 'tour-2.jpg', 'alt' => 'Open play area for puppies', 'category' => 'play-areas'],
                    ['src' => 'tour-3.jpg', 'alt' => 'Private puppy meeting room', 'category' => 'puppy-suites'],
                    ['src' => 'tour-4.jpg', 'alt' => 'Premium pet product displays', 'category' => 'retail'],
                    ['src' => 'tour-5.jpg', 'alt' => 'Comfortable puppy resting area', 'category' => 'puppy-suites'],
                    ['src' => 'tour-6.jpg', 'alt' => 'Indoor play equipment', 'category' => 'play-areas'],
                    ['src' => 'tour-7.jpg', 'alt' => 'Boutique interior design', 'category' => 'interior'],
                    ['src' => 'tour-8.jpg', 'alt' => 'Designer accessories display', 'category' => 'retail'],
                    ['src' => 'tour-9.jpg', 'alt' => 'Puppy socialization area', 'category' => 'play-areas'],
                    ['src' => 'tour-10.jpg', 'alt' => 'Individual puppy suite', 'category' => 'puppy-suites'],
                    ['src' => 'tour-11.jpg', 'alt' => 'Premium food and treats', 'category' => 'retail'],
                    ['src' => 'tour-12.jpg', 'alt' => 'Cozy waiting area', 'category' => 'interior'],
                ];

                foreach ($gallery_images as $image) :
                ?>
                    <a href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/tour/' . $image['src']); ?>"
                       class="tour-page__gallery-item"
                       data-category="<?php echo esc_attr($image['category']); ?>"
                       data-lightbox>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/tour/' . $image['src']); ?>"
                            alt="<?php echo esc_attr($image['alt']); ?>"
                            loading="lazy"
                            width="400"
                            height="300"
                        >
                        <div class="tour-page__gallery-overlay">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                <line x1="11" y1="8" x2="11" y2="14"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Facility Features -->
    <section class="tour-page__features" aria-labelledby="features-heading">
        <div class="container">
            <header class="tour-page__features-header">
                <span class="tour-page__section-label">Our Facility</span>
                <h2 id="features-heading" class="tour-page__section-title">What Makes Us Special</h2>
            </header>

            <div class="tour-page__features-grid">
                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 14.76V3.5a2.5 2.5 0 00-5 0v11.26a4.5 4.5 0 105 0z"/>
                        </svg>
                    </div>
                    <h3>Climate Control</h3>
                    <p>Temperature and humidity carefully maintained year-round for puppy comfort and health.</p>
                </div>

                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3>Daily Sanitization</h3>
                    <p>Hospital-grade cleaning protocols ensure a healthy environment for every puppy.</p>
                </div>

                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                            <line x1="9" y1="9" x2="9.01" y2="9"/>
                            <line x1="15" y1="9" x2="15.01" y2="9"/>
                        </svg>
                    </div>
                    <h3>Play Areas</h3>
                    <p>Dedicated spaces for puppies to exercise, socialize, and develop healthy behaviors.</p>
                </div>

                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                            <path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h3>Private Meetings</h3>
                    <p>Comfortable rooms where families can bond with puppies in a relaxed, private setting.</p>
                </div>

                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <h3>24/7 Monitoring</h3>
                    <p>Security cameras and staff checks ensure puppies are safe and well-cared for always.</p>
                </div>

                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                        </svg>
                    </div>
                    <h3>Loving Care</h3>
                    <p>Our team treats every puppy like family with daily handling and attention.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cleanliness Standards -->
    <section class="tour-page__standards" aria-labelledby="standards-heading">
        <div class="container">
            <div class="tour-page__standards-grid">
                <div class="tour-page__standards-content">
                    <span class="tour-page__section-label">Health & Safety</span>
                    <h2 id="standards-heading" class="tour-page__section-title">Our Cleanliness Standards</h2>
                    <p class="tour-page__standards-intro">We go above and beyond to maintain a pristine environment that keeps our puppies healthy and happy.</p>

                    <ul class="tour-page__standards-list">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Hospital-grade disinfection multiple times daily</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>HEPA air filtration for clean, fresh air</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Separate areas for new arrivals and quarantine</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Fresh bedding changed throughout the day</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Staff trained in proper hygiene protocols</span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Regular health inspections by licensed veterinarians</span>
                        </li>
                    </ul>
                </div>

                <div class="tour-page__standards-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cleanliness-standards.jpg'); ?>"
                        alt="Clean and organized puppy care area at Furrylicious"
                        loading="lazy"
                        width="600"
                        height="500"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Visit CTA -->
    <section class="tour-page__cta" aria-label="Schedule a visit">
        <div class="container">
            <div class="tour-page__cta-content">
                <h2>Ready to See Us in Person?</h2>
                <p>Nothing beats visiting in person. Schedule your appointment and experience our boutique firsthand.</p>
                <div class="tour-page__cta-buttons">
                    <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn btn--white btn--lg">
                        Schedule a Visit
                    </a>
                    <a href="<?php echo esc_url(home_url('/puppies/')); ?>" class="btn btn--outline btn--lg" style="border-color: white; color: white;">
                        Meet Our Puppies
                    </a>
                </div>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
