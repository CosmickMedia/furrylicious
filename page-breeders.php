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

// =============================================================================
// ACF Fields with Static Fallbacks
// =============================================================================

// Hero Section
$hero_label = get_field('hero_label') ?: __('Our Partners', 'furrylicious');
$hero_title = get_field('hero_title') ?: __('Meet Our Breeder Partners', 'furrylicious');
$hero_description = get_field('hero_description') ?: __('We partner exclusively with USDA-licensed breeders who share our commitment to healthy, well-socialized puppies raised with love and care.', 'furrylicious');
$hero_image = get_field('hero_image');
$hero_badges = get_field('hero_badges');

// Hero badges fallback
$default_hero_badges = [
    [
        'icon' => 'shield-check',
        'text' => __('USDA Licensed', 'furrylicious'),
    ],
    [
        'icon' => 'check-circle',
        'text' => __('Regularly Inspected', 'furrylicious'),
    ],
    [
        'icon' => 'heart',
        'text' => __('Ethically Raised', 'furrylicious'),
    ],
];
if (empty($hero_badges)) {
    $hero_badges = $default_hero_badges;
}

// Vetting Section
$vetting_label = get_field('vetting_label') ?: __('Our Process', 'furrylicious');
$vetting_title = get_field('vetting_title') ?: __('Rigorous Breeder Vetting', 'furrylicious');
$vetting_description = get_field('vetting_description') ?: __('Not just anyone can become a Furrylicious breeder partner. We put every potential partner through a comprehensive vetting process.', 'furrylicious');
$vetting_steps = get_field('vetting_steps');

// Vetting steps fallback
$default_vetting_steps = [
    [
        'number' => 1,
        'title' => __('Application Review', 'furrylicious'),
        'description' => __('Breeders submit detailed applications including licensing, breeding history, and facility information for our initial review.', 'furrylicious'),
    ],
    [
        'number' => 2,
        'title' => __('On-Site Inspection', 'furrylicious'),
        'description' => __('Our team personally visits every breeder facility to inspect living conditions, cleanliness, and animal welfare practices.', 'furrylicious'),
    ],
    [
        'number' => 3,
        'title' => __('Documentation Verification', 'furrylicious'),
        'description' => __('We verify all USDA licenses, health testing records, veterinary relationships, and breeding certifications.', 'furrylicious'),
    ],
    [
        'number' => 4,
        'title' => __('Ongoing Monitoring', 'furrylicious'),
        'description' => __('Approved partners undergo regular unannounced inspections and must maintain our standards to remain in the program.', 'furrylicious'),
    ],
    [
        'number' => 5,
        'title' => __('Partnership Agreement', 'furrylicious'),
        'description' => __('Breeders sign comprehensive agreements committing to our welfare standards, health guarantees, and ethical practices.', 'furrylicious'),
    ],
];
if (empty($vetting_steps)) {
    $vetting_steps = $default_vetting_steps;
}

// Standards Section
$standards_label = get_field('standards_label') ?: __('What We Require', 'furrylicious');
$standards_title = get_field('standards_title') ?: __('Our Breeder Standards', 'furrylicious');
$standards_image = get_field('standards_image');
$standards_categories = get_field('standards_categories');

// Standards categories fallback
$default_standards_categories = [
    [
        'title' => __('Living Conditions', 'furrylicious'),
        'items' => [
            ['item' => __('Clean, climate-controlled indoor environments', 'furrylicious')],
            ['item' => __('Spacious exercise and play areas', 'furrylicious')],
            ['item' => __('Regular socialization with humans and other dogs', 'furrylicious')],
            ['item' => __('Comfortable bedding and rest areas', 'furrylicious')],
        ],
    ],
    [
        'title' => __('Health Testing', 'furrylicious'),
        'items' => [
            ['item' => __('OFA or PennHIP hip and elbow evaluations', 'furrylicious')],
            ['item' => __('Genetic testing for breed-specific conditions', 'furrylicious')],
            ['item' => __('Annual veterinary health exams', 'furrylicious')],
            ['item' => __('Complete vaccination and deworming protocols', 'furrylicious')],
        ],
    ],
    [
        'title' => __('Socialization', 'furrylicious'),
        'items' => [
            ['item' => __('Early neurological stimulation (ENS)', 'furrylicious')],
            ['item' => __('Exposure to household sounds and environments', 'furrylicious')],
            ['item' => __('Positive human interaction from birth', 'furrylicious')],
            ['item' => __('Temperament assessment and matching', 'furrylicious')],
        ],
    ],
];
if (empty($standards_categories)) {
    $standards_categories = $default_standards_categories;
}

// Profiles Section
$profiles_label = get_field('profiles_label') ?: __('Meet Our Partners', 'furrylicious');
$profiles_title = get_field('profiles_title') ?: __('Featured Breeders', 'furrylicious');
$breeders = get_field('breeders');

// Breeders fallback
$default_breeders = [
    [
        'name' => 'Golden Meadows Farm',
        'region' => 'Pennsylvania',
        'specialties' => [['breed' => 'Golden Retrievers'], ['breed' => 'Goldendoodles']],
        'years' => '8+ years',
        'image' => null,
        'fallback_image' => 'breeder-1.jpg',
    ],
    [
        'name' => 'Sunrise Puppies',
        'region' => 'Ohio',
        'specialties' => [['breed' => 'French Bulldogs'], ['breed' => 'English Bulldogs']],
        'years' => '12+ years',
        'image' => null,
        'fallback_image' => 'breeder-2.jpg',
    ],
    [
        'name' => 'Heritage Kennels',
        'region' => 'Virginia',
        'specialties' => [['breed' => 'Cavaliers'], ['breed' => 'Cockapoos']],
        'years' => '15+ years',
        'image' => null,
        'fallback_image' => 'breeder-3.jpg',
    ],
    [
        'name' => 'Valley View Breeders',
        'region' => 'Indiana',
        'specialties' => [['breed' => 'Bernedoodles'], ['breed' => 'Labradoodles']],
        'years' => '6+ years',
        'image' => null,
        'fallback_image' => 'breeder-4.jpg',
    ],
    [
        'name' => 'Countryside Companions',
        'region' => 'Missouri',
        'specialties' => [['breed' => 'Shih Tzus'], ['breed' => 'Maltipoos']],
        'years' => '10+ years',
        'image' => null,
        'fallback_image' => 'breeder-5.jpg',
    ],
    [
        'name' => 'Heartland Pups',
        'region' => 'Wisconsin',
        'specialties' => [['breed' => 'Labs'], ['breed' => 'Mini Aussies']],
        'years' => '9+ years',
        'image' => null,
        'fallback_image' => 'breeder-6.jpg',
    ],
];
if (empty($breeders)) {
    $breeders = $default_breeders;
}

// Certifications Section
$certifications_title = get_field('certifications_title') ?: __('Certifications & Affiliations', 'furrylicious');
$certifications_description = get_field('certifications_description') ?: __('Our breeders maintain memberships and certifications with respected industry organizations.', 'furrylicious');
$certifications = get_field('certifications');

// Certifications fallback
$default_certifications = [
    [
        'name' => __('USDA Licensed', 'furrylicious'),
        'logo' => null,
        'fallback_logo' => 'usda.png',
    ],
    [
        'name' => __('AKC Registered', 'furrylicious'),
        'logo' => null,
        'fallback_logo' => 'akc.png',
    ],
    [
        'name' => __('State Licensed', 'furrylicious'),
        'logo' => null,
        'fallback_logo' => 'state-licensed.png',
    ],
    [
        'name' => __('OFA Health Testing', 'furrylicious'),
        'logo' => null,
        'fallback_logo' => 'ofa.png',
    ],
];
if (empty($certifications)) {
    $certifications = $default_certifications;
}

// Partner CTA Section
$partner_cta_title = get_field('partner_cta_title') ?: __('Are You a Responsible Breeder?', 'furrylicious');
$partner_cta_description = get_field('partner_cta_description') ?: __("We're always looking to expand our network of ethical, quality breeders. If you share our commitment to puppy welfare and meet our rigorous standards, we'd love to hear from you.", 'furrylicious');
$partner_requirements = get_field('partner_requirements');
$partner_btn_text = get_field('partner_btn_text') ?: __('Apply to Be a Partner', 'furrylicious');
$partner_btn_link = get_field('partner_btn_link') ?: home_url('/contact-us/?subject=breeder-inquiry');

// Partner requirements fallback
$default_partner_requirements = [
    ['requirement' => __('USDA Licensed', 'furrylicious')],
    ['requirement' => __('Health Testing Program', 'furrylicious')],
    ['requirement' => __('Clean Inspection History', 'furrylicious')],
    ['requirement' => __('Commitment to Socialization', 'furrylicious')],
];
if (empty($partner_requirements)) {
    $partner_requirements = $default_partner_requirements;
}

// =============================================================================
// Icon SVG Helper Function
// =============================================================================
function furrylicious_get_badge_icon($icon_name) {
    $icons = [
        'shield-check' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="M9 12l2 2 4-4"/>
        </svg>',
        'check-circle' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>',
        'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
        </svg>',
    ];
    return $icons[$icon_name] ?? $icons['shield-check'];
}
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
                    <span class="breeders-page__section-label"><?php echo esc_html($hero_label); ?></span>
                    <h1 class="breeders-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                    <p class="breeders-page__hero-description"><?php echo esc_html($hero_description); ?></p>

                    <div class="breeders-page__hero-badges">
                        <?php foreach ($hero_badges as $badge) : ?>
                            <div class="breeders-page__badge">
                                <?php echo furrylicious_get_badge_icon($badge['icon']); ?>
                                <span><?php echo esc_html($badge['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="breeders-page__hero-image">
                    <?php if ($hero_image) : ?>
                        <img
                            src="<?php echo esc_url($hero_image['url']); ?>"
                            alt="<?php echo esc_attr($hero_image['alt'] ?: __('Puppies being cared for by professional breeder', 'furrylicious')); ?>"
                            loading="eager"
                            width="600"
                            height="500"
                        >
                    <?php else : ?>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeders-hero.jpg'); ?>"
                            alt="<?php esc_attr_e('Puppies being cared for by professional breeder', 'furrylicious'); ?>"
                            loading="eager"
                            width="600"
                            height="500"
                        >
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Vetting Process -->
    <section class="breeders-page__vetting" aria-labelledby="vetting-heading">
        <div class="container">
            <header class="breeders-page__vetting-header">
                <span class="breeders-page__section-label"><?php echo esc_html($vetting_label); ?></span>
                <h2 id="vetting-heading" class="breeders-page__section-title"><?php echo esc_html($vetting_title); ?></h2>
                <p class="breeders-page__section-description"><?php echo esc_html($vetting_description); ?></p>
            </header>

            <div class="breeders-page__vetting-steps">
                <?php foreach ($vetting_steps as $index => $step) : ?>
                    <?php if ($index > 0) : ?>
                        <div class="breeders-page__vetting-line"></div>
                    <?php endif; ?>

                    <div class="breeders-page__vetting-step">
                        <div class="breeders-page__step-number"><?php echo esc_html($step['number']); ?></div>
                        <div class="breeders-page__step-content">
                            <h3><?php echo esc_html($step['title']); ?></h3>
                            <p><?php echo esc_html($step['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Standards Overview -->
    <section class="breeders-page__standards" aria-labelledby="standards-heading">
        <div class="container">
            <div class="breeders-page__standards-grid">
                <div class="breeders-page__standards-image">
                    <?php if ($standards_image) : ?>
                        <img
                            src="<?php echo esc_url($standards_image['url']); ?>"
                            alt="<?php echo esc_attr($standards_image['alt'] ?: __('Clean, spacious breeder facility', 'furrylicious')); ?>"
                            loading="lazy"
                            width="600"
                            height="500"
                        >
                    <?php else : ?>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeder-standards.jpg'); ?>"
                            alt="<?php esc_attr_e('Clean, spacious breeder facility', 'furrylicious'); ?>"
                            loading="lazy"
                            width="600"
                            height="500"
                        >
                    <?php endif; ?>
                </div>

                <div class="breeders-page__standards-content">
                    <span class="breeders-page__section-label"><?php echo esc_html($standards_label); ?></span>
                    <h2 id="standards-heading" class="breeders-page__section-title"><?php echo esc_html($standards_title); ?></h2>

                    <?php foreach ($standards_categories as $category) : ?>
                        <div class="breeders-page__standard-category">
                            <h3><?php echo esc_html($category['title']); ?></h3>
                            <ul>
                                <?php foreach ($category['items'] as $item) : ?>
                                    <li><?php echo esc_html($item['item']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Breeder Profiles -->
    <section class="breeders-page__profiles" aria-labelledby="profiles-heading">
        <div class="container">
            <header class="breeders-page__profiles-header">
                <span class="breeders-page__section-label"><?php echo esc_html($profiles_label); ?></span>
                <h2 id="profiles-heading" class="breeders-page__section-title"><?php echo esc_html($profiles_title); ?></h2>
            </header>

            <div class="breeders-page__profiles-grid">
                <?php foreach ($breeders as $breeder) : ?>
                    <div class="breeders-page__profile-card">
                        <div class="breeders-page__profile-image">
                            <?php if (!empty($breeder['image'])) : ?>
                                <img
                                    src="<?php echo esc_url($breeder['image']['url']); ?>"
                                    alt="<?php echo esc_attr($breeder['image']['alt'] ?: $breeder['name']); ?>"
                                    loading="lazy"
                                    width="300"
                                    height="200"
                                >
                            <?php elseif (!empty($breeder['fallback_image'])) : ?>
                                <img
                                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeders/' . $breeder['fallback_image']); ?>"
                                    alt="<?php echo esc_attr($breeder['name']); ?>"
                                    loading="lazy"
                                    width="300"
                                    height="200"
                                >
                            <?php endif; ?>
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
                                    <span class="breeders-page__specialty-tag"><?php echo esc_html($specialty['breed']); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <p class="breeders-page__profile-years">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                <?php
                                /* translators: %s: years as partner */
                                printf(esc_html__('Partner for %s', 'furrylicious'), esc_html($breeder['years']));
                                ?>
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
                <h2 id="certs-heading" class="breeders-page__section-title"><?php echo esc_html($certifications_title); ?></h2>
                <p class="breeders-page__section-description"><?php echo esc_html($certifications_description); ?></p>
            </header>

            <div class="breeders-page__certifications-grid">
                <?php foreach ($certifications as $cert) : ?>
                    <div class="breeders-page__certification">
                        <?php if (!empty($cert['logo'])) : ?>
                            <img
                                src="<?php echo esc_url($cert['logo']['url']); ?>"
                                alt="<?php echo esc_attr($cert['logo']['alt'] ?: $cert['name']); ?>"
                                loading="lazy"
                                width="120"
                                height="80"
                            >
                        <?php elseif (!empty($cert['fallback_logo'])) : ?>
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/certs/' . $cert['fallback_logo']); ?>"
                                alt="<?php echo esc_attr($cert['name']); ?>"
                                loading="lazy"
                                width="120"
                                height="80"
                            >
                        <?php endif; ?>
                        <span><?php echo esc_html($cert['name']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Become a Partner -->
    <section class="breeders-page__partner-cta" aria-labelledby="partner-heading">
        <div class="container">
            <div class="breeders-page__partner-card">
                <div class="breeders-page__partner-content">
                    <h2 id="partner-heading"><?php echo esc_html($partner_cta_title); ?></h2>
                    <p><?php echo esc_html($partner_cta_description); ?></p>

                    <ul class="breeders-page__partner-requirements">
                        <?php foreach ($partner_requirements as $req) : ?>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <?php echo esc_html($req['requirement']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="breeders-page__partner-action">
                    <a href="<?php echo esc_url($partner_btn_link); ?>" class="btn btn--primary btn--lg">
                        <?php echo esc_html($partner_btn_text); ?>
                    </a>
                    <p class="breeders-page__partner-note"><?php
                        /* translators: %s: phone number link */
                        printf(
                            esc_html__('or call us at %s', 'furrylicious'),
                            '<a href="tel:+19088234468">(908) 823-4468</a>'
                        );
                    ?></p>
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
