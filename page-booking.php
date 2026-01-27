<?php
/**
 * Template Name: Booking an Appointment
 *
 * Book a visit to meet puppies at Furrylicious.
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
            '@type' => 'LocalBusiness',
            '@id' => home_url('/#localbusiness'),
            'name' => 'Furrylicious',
            'description' => 'Premium puppy boutique in Whitehouse Station, NJ',
            'url' => home_url('/'),
            'telephone' => '(908) 823-4468',
            'email' => 'info@furryliciousnj.com',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '531 US Highway 22 E',
                'addressLocality' => 'Whitehouse Station',
                'addressRegion' => 'NJ',
                'postalCode' => '08889',
                'addressCountry' => 'US'
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => '40.6151',
                'longitude' => '-74.7699'
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => '11:00',
                'closes' => '19:00'
            ]
        ],
        [
            '@type' => 'ReservationAction',
            'name' => 'Book an Appointment at Furrylicious',
            'description' => 'Schedule a private visit to meet our puppies',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => home_url('/booking/'),
                'actionPlatform' => ['http://schema.org/DesktopWebPlatform', 'http://schema.org/MobileWebPlatform']
            ],
            'result' => [
                '@type' => 'Reservation',
                'reservationFor' => [
                    '@type' => 'LocalBusiness',
                    '@id' => home_url('/#localbusiness')
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="booking-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="booking-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Book an Appointment', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="booking-page__hero" aria-label="Book an Appointment">
        <div class="container">
            <div class="booking-page__hero-grid">
                <div class="booking-page__hero-content">
                    <span class="booking-page__section-label">Visit Us</span>
                    <h1 class="booking-page__hero-title">Meet Your Future Best Friend</h1>
                    <p class="booking-page__hero-description">Schedule a private appointment to visit our boutique and spend quality time with our puppies. No pressure, no obligation&mdash;just pure puppy love.</p>

                    <div class="booking-page__trust-badges">
                        <div class="booking-page__trust-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                            <span>Private Appointments</span>
                        </div>
                        <div class="booking-page__trust-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                            <span>No Obligation</span>
                        </div>
                        <div class="booking-page__trust-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span>Flexible Scheduling</span>
                        </div>
                    </div>

                    <div class="booking-page__hero-cta">
                        <a href="#booking-form" class="btn btn--primary btn--lg">
                            Schedule Your Visit
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="booking-page__hero-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/booking-hero.jpg'); ?>"
                        alt="Family meeting puppies at Furrylicious"
                        loading="eager"
                        width="600"
                        height="500"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Booking Form -->
    <section id="booking-form" class="booking-page__form" aria-labelledby="form-heading">
        <div class="container">
            <div class="booking-page__form-wrapper">
                <header class="booking-page__form-header">
                    <h2 id="form-heading" class="booking-page__form-title">Request an Appointment</h2>
                    <p class="booking-page__form-subtitle">Fill out the form below and we'll confirm your visit within 24 hours.</p>
                </header>

                <div class="booking-page__form-content">
                    <?php
                    if (function_exists('gravity_form')) {
                        gravity_form(2, false, false, false, null, true, 50);
                    } else {
                    ?>
                        <div class="booking-page__form-fallback">
                            <p><?php esc_html_e('Call us to schedule your appointment:', 'furrylicious'); ?></p>
                            <a href="tel:+19088234468" class="btn btn--primary btn--lg">(908) 823-4468</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- What to Expect -->
    <section class="booking-page__expectations" aria-labelledby="expect-heading">
        <div class="container">
            <header class="booking-page__expectations-header">
                <span class="booking-page__section-label">Your Visit</span>
                <h2 id="expect-heading" class="booking-page__section-title">What to Expect</h2>
                <p class="booking-page__section-description">Your appointment is a relaxed, personal experience designed to help you find your perfect companion.</p>
            </header>

            <div class="booking-page__steps">
                <div class="booking-page__step">
                    <div class="booking-page__step-number">1</div>
                    <div class="booking-page__step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <h3 class="booking-page__step-title">Arrival & Welcome</h3>
                    <p class="booking-page__step-text">You'll be greeted by our friendly staff and given a tour of our clean, comfortable facility.</p>
                </div>

                <div class="booking-page__step">
                    <div class="booking-page__step-number">2</div>
                    <div class="booking-page__step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19.5 12.572l-7.5 7.428-7.5-7.428A5 5 0 1112 6.006a5 5 0 017.5 6.566z"/>
                        </svg>
                    </div>
                    <h3 class="booking-page__step-title">Puppy Introduction</h3>
                    <p class="booking-page__step-text">Meet and interact with puppies that match your preferences in a private, comfortable setting.</p>
                </div>

                <div class="booking-page__step">
                    <div class="booking-page__step-number">3</div>
                    <div class="booking-page__step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <h3 class="booking-page__step-title">Ask Questions</h3>
                    <p class="booking-page__step-text">Our experts answer all your questions about breed, care, health, and what to expect as a puppy parent.</p>
                </div>

                <div class="booking-page__step">
                    <div class="booking-page__step-number">4</div>
                    <div class="booking-page__step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <polyline points="9 11 12 14 22 4"/>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                    </div>
                    <h3 class="booking-page__step-title">Next Steps</h3>
                    <p class="booking-page__step-text">If you find a match, we'll guide you through reservations, financing options, and take-home planning.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Preparation Tips -->
    <section class="booking-page__tips" aria-labelledby="tips-heading">
        <div class="container">
            <div class="booking-page__tips-grid">
                <div class="booking-page__tips-content">
                    <span class="booking-page__section-label">Before You Visit</span>
                    <h2 id="tips-heading" class="booking-page__section-title">Preparation Tips</h2>
                    <p class="booking-page__tips-intro">A few simple tips to make the most of your appointment.</p>
                </div>

                <div class="booking-page__tips-accordion">
                    <div class="accordion" data-accordion>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" aria-expanded="false">
                                    <span>What should I wear?</span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <p>Wear comfortable, casual clothes that you don't mind getting a little puppy fur on. Avoid loose jewelry or dangling accessories that puppies might grab. Closed-toe shoes are recommended.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" aria-expanded="false">
                                    <span>What should I bring?</span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <p>Bring a valid ID, your questions written down, and photos of your living space if you'd like breed recommendations. If you're ready to reserve, a deposit method is helpful but not required for your first visit.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" aria-expanded="false">
                                    <span>How long do appointments last?</span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <p>Plan for about 45 minutes to an hour. This gives you plenty of time to meet puppies, ask questions, and explore without feeling rushed. We're happy to extend if needed.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" aria-expanded="false">
                                    <span>Can I bring my children?</span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <p>Absolutely! We encourage families to bring children so everyone can meet potential puppies. Our staff is experienced with helping kids interact safely and positively with the puppies.</p>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" aria-expanded="false">
                                    <span>Can I bring my current pet?</span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <p>For the safety of our puppies, we ask that you leave other pets at home during your initial visit. Once you've reserved a puppy, we can arrange a meet-and-greet with your current pet before pickup.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Hours -->
    <section class="booking-page__location" aria-labelledby="location-heading">
        <div class="container">
            <div class="booking-page__location-grid">
                <div class="booking-page__location-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.8977!2d-74.7699!3d40.6151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDM2JzU0LjQiTiA3NMKwNDYnMTEuNiJX!5e0!3m2!1sen!2sus!4v1234567890"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Furrylicious Location Map"
                    ></iframe>
                </div>

                <div class="booking-page__location-info">
                    <h2 id="location-heading" class="booking-page__section-title">Find Us</h2>

                    <div class="booking-page__location-card">
                        <div class="booking-page__location-item">
                            <div class="booking-page__location-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Address</strong>
                                <address>
                                    531 US Highway 22 E<br>
                                    Whitehouse Station, NJ 08889
                                </address>
                            </div>
                        </div>

                        <div class="booking-page__location-item">
                            <div class="booking-page__location-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Hours</strong>
                                <span>Open Daily: 11 AM &ndash; 7 PM</span>
                            </div>
                        </div>

                        <div class="booking-page__location-item">
                            <div class="booking-page__location-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                                </svg>
                            </div>
                            <div>
                                <strong>Phone</strong>
                                <a href="tel:+19088234468">(908) 823-4468</a>
                            </div>
                        </div>
                    </div>

                    <a href="https://maps.google.com/?q=531+US+Highway+22+E+Whitehouse+Station+NJ+08889" target="_blank" rel="noopener noreferrer" class="btn btn--outline">
                        Get Directions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                            <polyline points="15 3 21 3 21 9"/>
                            <line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <?php get_template_part('partials/section-contact', null, [
        'title' => __('Have Questions Before Booking?', 'furrylicious'),
        'subtitle' => __('We\'re happy to answer any questions about your visit', 'furrylicious'),
        'show_form' => false
    ]); ?>

</article>

<?php get_footer(); ?>
