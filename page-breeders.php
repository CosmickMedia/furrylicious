<?php
/**
 * Template Name: Our Breeders
 *
 * Information about Furrylicious breeder partners and vetting process.
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
    '@type' => 'Organization',
    'name' => 'Furrylicious Breeder Network',
    'description' => 'USDA-licensed breeder partners committed to ethical breeding practices',
    'url' => home_url('/breeders/'),
    'parentOrganization' => [
        '@type' => 'LocalBusiness',
        'name' => 'Furrylicious',
        'url' => home_url('/'),
        'telephone' => '(908) 823-4468'
    ],
    'memberOf' => [
        [
            '@type' => 'Organization',
            'name' => 'USDA Licensed Breeders'
        ],
        [
            '@type' => 'Organization',
            'name' => 'American Kennel Club'
        ]
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="breeders-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="breeders-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Our Breeders', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="breeders-page__hero" aria-label="Our Breeders">
        <div class="container">
            <div class="breeders-page__hero-grid">
                <div class="breeders-page__hero-content">
                    <span class="breeders-page__section-label">Our Partners</span>
                    <h1 class="breeders-page__hero-title">Meet Our Breeder Partners</h1>
                    <p class="breeders-page__hero-description">We partner exclusively with USDA-licensed breeders who share our commitment to healthy, well-socialized puppies raised with love and care.</p>

                    <div class="breeders-page__hero-badges">
                        <div class="breeders-page__badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                            <span>USDA Licensed</span>
                        </div>
                        <div class="breeders-page__badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                            <span>Regularly Inspected</span>
                        </div>
                        <div class="breeders-page__badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                            </svg>
                            <span>Ethically Raised</span>
                        </div>
                    </div>
                </div>

                <div class="breeders-page__hero-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeders-hero.jpg'); ?>"
                        alt="Puppies being cared for by professional breeder"
                        loading="eager"
                        width="600"
                        height="500"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Vetting Process -->
    <section class="breeders-page__vetting" aria-labelledby="vetting-heading">
        <div class="container">
            <header class="breeders-page__vetting-header">
                <span class="breeders-page__section-label">Our Process</span>
                <h2 id="vetting-heading" class="breeders-page__section-title">Rigorous Breeder Vetting</h2>
                <p class="breeders-page__section-description">Not just anyone can become a Furrylicious breeder partner. We put every potential partner through a comprehensive vetting process.</p>
            </header>

            <div class="breeders-page__vetting-steps">
                <div class="breeders-page__vetting-step">
                    <div class="breeders-page__step-number">1</div>
                    <div class="breeders-page__step-content">
                        <h3>Application Review</h3>
                        <p>Breeders submit detailed applications including licensing, breeding history, and facility information for our initial review.</p>
                    </div>
                </div>

                <div class="breeders-page__vetting-line"></div>

                <div class="breeders-page__vetting-step">
                    <div class="breeders-page__step-number">2</div>
                    <div class="breeders-page__step-content">
                        <h3>On-Site Inspection</h3>
                        <p>Our team personally visits every breeder facility to inspect living conditions, cleanliness, and animal welfare practices.</p>
                    </div>
                </div>

                <div class="breeders-page__vetting-line"></div>

                <div class="breeders-page__vetting-step">
                    <div class="breeders-page__step-number">3</div>
                    <div class="breeders-page__step-content">
                        <h3>Documentation Verification</h3>
                        <p>We verify all USDA licenses, health testing records, veterinary relationships, and breeding certifications.</p>
                    </div>
                </div>

                <div class="breeders-page__vetting-line"></div>

                <div class="breeders-page__vetting-step">
                    <div class="breeders-page__step-number">4</div>
                    <div class="breeders-page__step-content">
                        <h3>Ongoing Monitoring</h3>
                        <p>Approved partners undergo regular unannounced inspections and must maintain our standards to remain in the program.</p>
                    </div>
                </div>

                <div class="breeders-page__vetting-line"></div>

                <div class="breeders-page__vetting-step">
                    <div class="breeders-page__step-number">5</div>
                    <div class="breeders-page__step-content">
                        <h3>Partnership Agreement</h3>
                        <p>Breeders sign comprehensive agreements committing to our welfare standards, health guarantees, and ethical practices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Standards Overview -->
    <section class="breeders-page__standards" aria-labelledby="standards-heading">
        <div class="container">
            <div class="breeders-page__standards-grid">
                <div class="breeders-page__standards-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeder-standards.jpg'); ?>"
                        alt="Clean, spacious breeder facility"
                        loading="lazy"
                        width="600"
                        height="500"
                    >
                </div>

                <div class="breeders-page__standards-content">
                    <span class="breeders-page__section-label">What We Require</span>
                    <h2 id="standards-heading" class="breeders-page__section-title">Our Breeder Standards</h2>

                    <div class="breeders-page__standard-category">
                        <h3>Living Conditions</h3>
                        <ul>
                            <li>Clean, climate-controlled indoor environments</li>
                            <li>Spacious exercise and play areas</li>
                            <li>Regular socialization with humans and other dogs</li>
                            <li>Comfortable bedding and rest areas</li>
                        </ul>
                    </div>

                    <div class="breeders-page__standard-category">
                        <h3>Health Testing</h3>
                        <ul>
                            <li>OFA or PennHIP hip and elbow evaluations</li>
                            <li>Genetic testing for breed-specific conditions</li>
                            <li>Annual veterinary health exams</li>
                            <li>Complete vaccination and deworming protocols</li>
                        </ul>
                    </div>

                    <div class="breeders-page__standard-category">
                        <h3>Socialization</h3>
                        <ul>
                            <li>Early neurological stimulation (ENS)</li>
                            <li>Exposure to household sounds and environments</li>
                            <li>Positive human interaction from birth</li>
                            <li>Temperament assessment and matching</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breeder Profiles -->
    <section class="breeders-page__profiles" aria-labelledby="profiles-heading">
        <div class="container">
            <header class="breeders-page__profiles-header">
                <span class="breeders-page__section-label">Meet Our Partners</span>
                <h2 id="profiles-heading" class="breeders-page__section-title">Featured Breeders</h2>
            </header>

            <div class="breeders-page__profiles-grid">
                <?php
                $breeders = [
                    [
                        'name' => 'Golden Meadows Farm',
                        'region' => 'Pennsylvania',
                        'specialties' => ['Golden Retrievers', 'Goldendoodles'],
                        'years' => '8+ years',
                        'image' => 'breeder-1.jpg',
                    ],
                    [
                        'name' => 'Sunrise Puppies',
                        'region' => 'Ohio',
                        'specialties' => ['French Bulldogs', 'English Bulldogs'],
                        'years' => '12+ years',
                        'image' => 'breeder-2.jpg',
                    ],
                    [
                        'name' => 'Heritage Kennels',
                        'region' => 'Virginia',
                        'specialties' => ['Cavaliers', 'Cockapoos'],
                        'years' => '15+ years',
                        'image' => 'breeder-3.jpg',
                    ],
                    [
                        'name' => 'Valley View Breeders',
                        'region' => 'Indiana',
                        'specialties' => ['Bernedoodles', 'Labradoodles'],
                        'years' => '6+ years',
                        'image' => 'breeder-4.jpg',
                    ],
                    [
                        'name' => 'Countryside Companions',
                        'region' => 'Missouri',
                        'specialties' => ['Shih Tzus', 'Maltipoos'],
                        'years' => '10+ years',
                        'image' => 'breeder-5.jpg',
                    ],
                    [
                        'name' => 'Heartland Pups',
                        'region' => 'Wisconsin',
                        'specialties' => ['Labs', 'Mini Aussies'],
                        'years' => '9+ years',
                        'image' => 'breeder-6.jpg',
                    ],
                ];

                foreach ($breeders as $breeder) :
                ?>
                    <div class="breeders-page__profile-card">
                        <div class="breeders-page__profile-image">
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeders/' . $breeder['image']); ?>"
                                alt="<?php echo esc_attr($breeder['name']); ?>"
                                loading="lazy"
                                width="300"
                                height="200"
                            >
                        </div>
                        <div class="breeders-page__profile-content">
                            <h3 class="breeders-page__profile-name"><?php echo esc_html($breeder['name']); ?></h3>
                            <p class="breeders-page__profile-region">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <?php echo esc_html($breeder['region']); ?>
                            </p>
                            <div class="breeders-page__profile-specialties">
                                <?php foreach ($breeder['specialties'] as $specialty) : ?>
                                    <span class="breeders-page__specialty-tag"><?php echo esc_html($specialty); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <p class="breeders-page__profile-years">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                Partner for <?php echo esc_html($breeder['years']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Certifications -->
    <section class="breeders-page__certifications" aria-labelledby="certs-heading">
        <div class="container">
            <header class="breeders-page__certifications-header">
                <h2 id="certs-heading" class="breeders-page__section-title">Certifications & Affiliations</h2>
                <p class="breeders-page__section-description">Our breeders maintain memberships and certifications with respected industry organizations.</p>
            </header>

            <div class="breeders-page__certifications-grid">
                <div class="breeders-page__certification">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/certs/usda.png'); ?>"
                        alt="USDA Licensed"
                        loading="lazy"
                        width="120"
                        height="80"
                    >
                    <span>USDA Licensed</span>
                </div>
                <div class="breeders-page__certification">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/certs/akc.png'); ?>"
                        alt="AKC Registered"
                        loading="lazy"
                        width="120"
                        height="80"
                    >
                    <span>AKC Registered</span>
                </div>
                <div class="breeders-page__certification">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/certs/state-licensed.png'); ?>"
                        alt="State Licensed"
                        loading="lazy"
                        width="120"
                        height="80"
                    >
                    <span>State Licensed</span>
                </div>
                <div class="breeders-page__certification">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/certs/ofa.png'); ?>"
                        alt="OFA Health Testing"
                        loading="lazy"
                        width="120"
                        height="80"
                    >
                    <span>OFA Health Testing</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Become a Partner -->
    <section class="breeders-page__partner-cta" aria-labelledby="partner-heading">
        <div class="container">
            <div class="breeders-page__partner-card">
                <div class="breeders-page__partner-content">
                    <h2 id="partner-heading">Are You a Responsible Breeder?</h2>
                    <p>We're always looking to expand our network of ethical, quality breeders. If you share our commitment to puppy welfare and meet our rigorous standards, we'd love to hear from you.</p>

                    <ul class="breeders-page__partner-requirements">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            USDA Licensed
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Health Testing Program
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Clean Inspection History
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Commitment to Socialization
                        </li>
                    </ul>
                </div>

                <div class="breeders-page__partner-action">
                    <a href="<?php echo esc_url(home_url('/contact-us/?subject=breeder-inquiry')); ?>" class="btn btn--primary btn--lg">
                        Apply to Be a Partner
                    </a>
                    <p class="breeders-page__partner-note">or call us at <a href="tel:+19088234468">(908) 823-4468</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <?php get_template_part('partials/section-contact', null, [
        'title' => __('Questions About Our Breeders?', 'furrylicious'),
        'subtitle' => __('We\'re happy to share more about our vetting process and breeder partners', 'furrylicious'),
        'show_form' => false
    ]); ?>

</article>

<?php get_footer(); ?>
