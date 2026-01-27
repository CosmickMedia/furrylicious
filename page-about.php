<?php
/**
 * Template Name: About Page
 *
 * About Furrylicious - Premium puppy boutique in Whitehouse Station, NJ
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
    '@type' => 'LocalBusiness',
    'name' => 'Furrylicious',
    'description' => 'Premium puppy boutique in Whitehouse Station, NJ offering healthy, ethically-sourced puppies from USDA-licensed breeders with lifetime support.',
    'image' => get_template_directory_uri() . '/assets/images/logo.png',
    'url' => home_url('/about/'),
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
    ],
    'aggregateRating' => [
        '@type' => 'AggregateRating',
        'ratingValue' => '5.0',
        'reviewCount' => '38',
        'bestRating' => '5',
        'worstRating' => '1'
    ],
    'priceRange' => '$$$',
    'sameAs' => [
        'https://www.instagram.com/furryliciousnj/',
        'https://www.facebook.com/furryliciousnj/',
        'https://www.youtube.com/@furryliciousnj',
        'https://www.tiktok.com/@furryliciousnj',
        'https://www.yelp.com/biz/furrylicious-whitehouse-station'
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="about-page" itemscope itemtype="https://schema.org/AboutPage">

    <!-- Breadcrumb -->
    <nav class="about-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('About Us', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="about-page__hero" aria-label="About Furrylicious">
        <div class="container">
            <header class="about-page__hero-header">
                <h1 class="about-page__hero-title">Your Pets Are Our Passion</h1>
                <p class="about-page__hero-subtitle">Whitehouse Station's Premier Puppy Boutique</p>
            </header>

            <div class="about-page__hero-video">
                <div class="about-page__video-wrapper">
                    <iframe
                        src="https://www.youtube.com/embed/VnlnqPz6PBQ?rel=0&modestbranding=1"
                        title="Welcome to Furrylicious - Your Premier Puppy Boutique"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                    ></iframe>
                </div>
            </div>

            <div class="about-page__scroll-indicator" aria-hidden="true">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M19 12l-7 7-7-7"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="about-page__story" aria-labelledby="story-heading">
        <div class="container">
            <div class="about-page__story-grid">
                <div class="about-page__story-content">
                    <span class="about-page__section-label">Our Story</span>
                    <h2 id="story-heading" class="about-page__section-title">Welcome to Furrylicious</h2>

                    <p class="about-page__story-intro">At Furrylicious, we believe that finding the perfect furry companion should be a joyful and memorable experience. Our boutique is more than just a place to find puppies&mdash;it's where families begin their journey with a new best friend.</p>

                    <blockquote class="about-page__quote">
                        <p>"Every puppy deserves a loving home, and every family deserves a healthy, happy companion."</p>
                    </blockquote>

                    <p>Founded with a deep love for animals and a commitment to ethical practices, Furrylicious has become Whitehouse Station's trusted destination for premium puppies. We work exclusively with USDA-licensed breeders who share our dedication to the health and well-being of every puppy.</p>

                    <p>Our warm, welcoming environment allows you to spend quality time getting to know your potential new family member. Our knowledgeable staff is here to guide you every step of the way, from choosing the right breed for your lifestyle to providing ongoing support long after you bring your puppy home.</p>
                </div>

                <div class="about-page__story-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-story.jpg'); ?>"
                        alt="Happy puppy at Furrylicious boutique in Whitehouse Station, NJ"
                        loading="lazy"
                        width="600"
                        height="700"
                    >
                    <div class="about-page__story-flourish" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Pillars Section -->
    <section class="about-page__pillars" aria-labelledby="pillars-heading">
        <div class="container">
            <header class="about-page__pillars-header">
                <span class="about-page__section-label">Why Choose Us</span>
                <h2 id="pillars-heading" class="about-page__section-title">Our Commitment to Excellence</h2>
            </header>

            <div class="about-page__pillars-grid">
                <!-- Pillar 1: Ethical Sourcing -->
                <div class="about-page__pillar">
                    <div class="about-page__pillar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="about-page__pillar-title">Ethical Sourcing</h3>
                    <p class="about-page__pillar-text">We partner exclusively with USDA-licensed, regularly inspected breeders who meet our rigorous standards for animal welfare and breeding practices.</p>
                </div>

                <!-- Pillar 2: Health Guaranteed -->
                <div class="about-page__pillar">
                    <div class="about-page__pillar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19.5 12.572l-7.5 7.428-7.5-7.428A5 5 0 1112 6.006a5 5 0 017.5 6.566z"/>
                        </svg>
                    </div>
                    <h3 class="about-page__pillar-title">Health Guaranteed</h3>
                    <p class="about-page__pillar-text">Every puppy comes with comprehensive health guarantees, complete medical records, and registration papers for your peace of mind.</p>
                </div>

                <!-- Pillar 3: Expert Guidance -->
                <div class="about-page__pillar">
                    <div class="about-page__pillar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <h3 class="about-page__pillar-title">Expert Guidance</h3>
                    <p class="about-page__pillar-text">Our experienced team provides personalized breed recommendations and expert care advice tailored to your lifestyle and family needs.</p>
                </div>

                <!-- Pillar 4: Ongoing Support -->
                <div class="about-page__pillar">
                    <div class="about-page__pillar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                            <path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h3 class="about-page__pillar-title">Ongoing Support</h3>
                    <p class="about-page__pillar-text">We provide lifetime support for every puppy family&mdash;from training tips to health questions, we're always here to help.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="about-page__team" aria-labelledby="team-heading">
        <div class="container">
            <header class="about-page__team-header">
                <span class="about-page__section-label">Meet the Team</span>
                <h2 id="team-heading" class="about-page__section-title">The Passionate People Behind Furrylicious</h2>
                <p class="about-page__team-intro">Our dedicated team brings together years of experience in animal care, breed expertise, and a genuine love for helping families find their perfect companion.</p>
            </header>

            <div class="about-page__team-grid">
                <!-- Team Member 1 -->
                <div class="about-page__team-member">
                    <div class="about-page__team-photo">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team/owner.jpg'); ?>"
                            alt="Store Owner and Founder"
                            loading="lazy"
                            width="200"
                            height="200"
                        >
                    </div>
                    <h3 class="about-page__team-name">Sarah Mitchell</h3>
                    <span class="about-page__team-role">Owner & Founder</span>
                    <p class="about-page__team-bio">With over 15 years in the pet industry, Sarah founded Furrylicious to create a boutique experience for finding the perfect puppy.</p>
                </div>

                <!-- Team Member 2 -->
                <div class="about-page__team-member">
                    <div class="about-page__team-photo">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team/puppy-specialist.jpg'); ?>"
                            alt="Puppy Care Specialist"
                            loading="lazy"
                            width="200"
                            height="200"
                        >
                    </div>
                    <h3 class="about-page__team-name">Michael Chen</h3>
                    <span class="about-page__team-role">Puppy Care Specialist</span>
                    <p class="about-page__team-bio">Michael ensures every puppy receives the best care, from health monitoring to socialization and early training foundations.</p>
                </div>

                <!-- Team Member 3 -->
                <div class="about-page__team-member">
                    <div class="about-page__team-photo">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team/customer-experience.jpg'); ?>"
                            alt="Customer Experience Lead"
                            loading="lazy"
                            width="200"
                            height="200"
                        >
                    </div>
                    <h3 class="about-page__team-name">Emily Rodriguez</h3>
                    <span class="about-page__team-role">Customer Experience Lead</span>
                    <p class="about-page__team-bio">Emily guides families through their puppy journey, ensuring every visit is memorable and every question is answered.</p>
                </div>

                <!-- Team Member 4 -->
                <div class="about-page__team-member">
                    <div class="about-page__team-photo">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/team/boutique-manager.jpg'); ?>"
                            alt="Boutique Manager"
                            loading="lazy"
                            width="200"
                            height="200"
                        >
                    </div>
                    <h3 class="about-page__team-name">Jessica Taylor</h3>
                    <span class="about-page__team-role">Boutique Manager</span>
                    <p class="about-page__team-bio">Jessica curates our premium selection of pet accessories, foods, and supplies from the best brands in the industry.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section class="about-page__expertise" aria-labelledby="expertise-heading">
        <div class="container">
            <div class="about-page__expertise-grid">
                <div class="about-page__expertise-content">
                    <span class="about-page__section-label">Our Expertise</span>
                    <h2 id="expertise-heading" class="about-page__section-title">Knowledge You Can Trust</h2>

                    <div class="about-page__expertise-list">
                        <div class="about-page__expertise-item">
                            <div class="about-page__expertise-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                            </div>
                            <div class="about-page__expertise-text">
                                <h3>Breed Knowledge</h3>
                                <p>From toy breeds to gentle giants, we understand the unique characteristics, temperaments, and care requirements of every breed we carry.</p>
                            </div>
                        </div>

                        <div class="about-page__expertise-item">
                            <div class="about-page__expertise-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                            </div>
                            <div class="about-page__expertise-text">
                                <h3>Care Expertise</h3>
                                <p>We stay current with the latest in nutrition, training, and veterinary care to provide you with accurate, up-to-date guidance.</p>
                            </div>
                        </div>

                        <div class="about-page__expertise-item">
                            <div class="about-page__expertise-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                            </div>
                            <div class="about-page__expertise-text">
                                <h3>Personalized Matching</h3>
                                <p>We take the time to understand your lifestyle, living situation, and preferences to recommend the perfect breed for your family.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-page__expertise-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-expertise.jpg'); ?>"
                        alt="Expert staff member with puppy at Furrylicious"
                        loading="lazy"
                        width="500"
                        height="600"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Boutique Section -->
    <section class="about-page__boutique" aria-labelledby="boutique-heading">
        <div class="container">
            <header class="about-page__boutique-header">
                <span class="about-page__section-label">The Boutique</span>
                <h2 id="boutique-heading" class="about-page__section-title">Premium Products & Services</h2>
                <p class="about-page__boutique-intro">Beyond puppies, we curate a selection of premium pet products from the finest brands to pamper your furry family members.</p>
            </header>

            <div class="about-page__boutique-grid">
                <div class="about-page__boutique-card">
                    <div class="about-page__boutique-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <path d="M16 10a4 4 0 01-8 0"/>
                        </svg>
                    </div>
                    <h3>Premium Brands</h3>
                    <p>Hello Doggie, Puppia, Merricks, Stella & Chewy's, and more top-tier brands for discerning pet parents.</p>
                </div>

                <div class="about-page__boutique-card">
                    <div class="about-page__boutique-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="9" cy="21" r="1"/>
                            <circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                        </svg>
                    </div>
                    <h3>Exclusive Accessories</h3>
                    <p>Designer collars, harnesses, carriers, beds, and toys that combine style with quality craftsmanship.</p>
                </div>

                <div class="about-page__boutique-card">
                    <div class="about-page__boutique-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M18 8h1a4 4 0 010 8h-1"/>
                            <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                            <line x1="6" y1="1" x2="6" y2="4"/>
                            <line x1="10" y1="1" x2="10" y2="4"/>
                            <line x1="14" y1="1" x2="14" y2="4"/>
                        </svg>
                    </div>
                    <h3>Premium Nutrition</h3>
                    <p>Carefully selected foods, treats, and supplements to keep your pet healthy, happy, and thriving.</p>
                </div>

                <div class="about-page__boutique-card">
                    <div class="about-page__boutique-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3>Personal Service</h3>
                    <p>Expert staff to help with sizing, product recommendations, and personalized advice for your pet's needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="about-page__location" aria-labelledby="location-heading">
        <div class="container">
            <div class="about-page__location-grid">
                <div class="about-page__location-info">
                    <span class="about-page__section-label">Visit Us</span>
                    <h2 id="location-heading" class="about-page__section-title">Whitehouse Station Charm</h2>
                    <p class="about-page__location-intro">Located in the heart of Hunterdon County, our boutique is easily accessible and surrounded by the beautiful New Jersey countryside.</p>

                    <div class="about-page__location-details">
                        <div class="about-page__location-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div>
                                <strong>Address</strong>
                                <span>531 US Highway 22 E<br>Whitehouse Station, NJ 08889</span>
                            </div>
                        </div>

                        <div class="about-page__location-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <div>
                                <strong>Hours</strong>
                                <span>Open Daily: 11 AM &ndash; 7 PM</span>
                            </div>
                        </div>

                        <div class="about-page__location-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                            </svg>
                            <div>
                                <strong>Phone</strong>
                                <a href="tel:+19088234468">(908) 823-4468</a>
                            </div>
                        </div>
                    </div>

                    <div class="about-page__nearby">
                        <h3>Nearby Attractions</h3>
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"/>
                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                                </svg>
                                Red Mill Museum Village, Clinton
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"/>
                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                                </svg>
                                Morristown National Historical Park
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"/>
                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                                </svg>
                                Round Valley Recreation Area
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"/>
                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                                </svg>
                                Hunterdon County Arboretum
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="about-page__location-map">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/store-location.jpg'); ?>"
                        alt="Furrylicious store exterior in Whitehouse Station, NJ"
                        loading="lazy"
                        width="600"
                        height="450"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="about-page__testimonials" aria-labelledby="testimonials-heading">
        <div class="container">
            <header class="about-page__testimonials-header">
                <span class="about-page__section-label">Happy Families</span>
                <h2 id="testimonials-heading" class="about-page__section-title">What Our Customers Say</h2>

                <div class="about-page__rating-badge">
                    <div class="about-page__rating-stars" aria-label="5 out of 5 stars">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="about-page__rating-text"><strong>5.0</strong> from 38+ happy families</span>
                </div>
            </header>

            <div class="about-page__testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="about-page__testimonial">
                    <div class="about-page__testimonial-stars" aria-label="5 out of 5 stars">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="about-page__testimonial-quote">
                        <p>"We found our perfect French Bulldog at Furrylicious! The staff was incredibly knowledgeable and helped us every step of the way. Our Louie is healthy, happy, and the best addition to our family."</p>
                    </blockquote>
                    <div class="about-page__testimonial-author">
                        <div class="about-page__testimonial-avatar">JM</div>
                        <div class="about-page__testimonial-info">
                            <span class="about-page__testimonial-name">Jennifer M.</span>
                            <span class="about-page__testimonial-detail">French Bulldog Parent</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="about-page__testimonial">
                    <div class="about-page__testimonial-stars" aria-label="5 out of 5 stars">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="about-page__testimonial-quote">
                        <p>"The experience at Furrylicious was nothing like other pet stores. They truly care about matching the right puppy with the right family. Their follow-up support has been amazing!"</p>
                    </blockquote>
                    <div class="about-page__testimonial-author">
                        <div class="about-page__testimonial-avatar">DK</div>
                        <div class="about-page__testimonial-info">
                            <span class="about-page__testimonial-name">David K.</span>
                            <span class="about-page__testimonial-detail">Golden Retriever Parent</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="about-page__testimonial">
                    <div class="about-page__testimonial-stars" aria-label="5 out of 5 stars">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <blockquote class="about-page__testimonial-quote">
                        <p>"As first-time puppy parents, we had so many questions. The team at Furrylicious was patient, informative, and made the whole process enjoyable. Our Cavapoo is absolutely perfect!"</p>
                    </blockquote>
                    <div class="about-page__testimonial-author">
                        <div class="about-page__testimonial-avatar">SR</div>
                        <div class="about-page__testimonial-info">
                            <span class="about-page__testimonial-name">Sarah R.</span>
                            <span class="about-page__testimonial-detail">Cavapoo Parent</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-page__testimonials-cta">
                <a href="https://www.yelp.com/biz/furrylicious-whitehouse-station" target="_blank" rel="noopener noreferrer" class="btn btn--outline">
                    Read More Reviews on Yelp
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                        <polyline points="15 3 21 3 21 9"/>
                        <line x1="10" y1="14" x2="21" y2="3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Social Links Section -->
    <section class="about-page__social" aria-labelledby="social-heading">
        <div class="container">
            <header class="about-page__social-header">
                <h2 id="social-heading" class="about-page__section-title">Connect With Us</h2>
                <p>Follow our puppy adventures and stay updated on new arrivals</p>
            </header>

            <div class="about-page__social-links">
                <a href="https://www.instagram.com/furryliciousnj/" target="_blank" rel="noopener noreferrer" class="about-page__social-link" aria-label="Follow us on Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                    <span>Instagram</span>
                </a>

                <a href="https://www.facebook.com/furryliciousnj/" target="_blank" rel="noopener noreferrer" class="about-page__social-link" aria-label="Follow us on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                    </svg>
                    <span>Facebook</span>
                </a>

                <a href="https://www.youtube.com/@furryliciousnj" target="_blank" rel="noopener noreferrer" class="about-page__social-link" aria-label="Subscribe on YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                    </svg>
                    <span>YouTube</span>
                </a>

                <a href="https://www.tiktok.com/@furryliciousnj" target="_blank" rel="noopener noreferrer" class="about-page__social-link" aria-label="Follow us on TikTok">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M9 12a4 4 0 104 4V4a5 5 0 005 5"/>
                    </svg>
                    <span>TikTok</span>
                </a>

                <a href="https://www.yelp.com/biz/furrylicious-whitehouse-station" target="_blank" rel="noopener noreferrer" class="about-page__social-link" aria-label="See our reviews on Yelp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <span>Yelp</span>
                </a>

                <a href="https://www.bbb.org/us/nj/whitehouse-station/profile/pet-shop/furrylicious-0221-90191186" target="_blank" rel="noopener noreferrer" class="about-page__social-link" aria-label="View our BBB accreditation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    <span>BBB</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <?php get_template_part('partials/section-contact', null, [
        'title' => __('Ready to Find Your Perfect Companion?', 'furrylicious'),
        'subtitle' => __('Contact us today to schedule a visit or learn about our available puppies', 'furrylicious'),
        'show_form' => true
    ]); ?>

    <!-- Final CTA -->
    <section class="about-page__cta" aria-label="View available puppies">
        <div class="container">
            <div class="about-page__cta-content">
                <h2>Meet Your New Best Friend</h2>
                <p>Browse our selection of healthy, happy puppies waiting to join your family.</p>
                <a href="<?php echo esc_url(home_url('/puppies/')); ?>" class="btn btn--rose btn--lg">
                    View Available Puppies
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
