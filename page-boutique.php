<?php
/**
 * Template Name: Pet Boutique
 *
 * Pet boutique retail page showcasing products and brands.
 * ACF-powered with static fallbacks.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// Hero Section ACF fields with defaults
$hero_label = furrylicious_get_page_field('hero_label', 'Shop');
$hero_title = furrylicious_get_page_field('hero_title', 'Luxury & Love, Curated for Your Companion');
$hero_description = furrylicious_get_page_field('hero_description', 'Discover premium pet products from the brands we trust for our own furry friends. From designer accessories to healthy nutrition, we\'ve curated the best for your best friend.');
$hero_background = furrylicious_get_image_field('hero_background', 'large', '');
$hero_cta_text = furrylicious_get_page_field('hero_cta_secondary_text', 'Visit In-Store');
$hero_cta_link = furrylicious_get_page_field('hero_cta_secondary_link', home_url('/booking-an-appointment/'));

// Brands Section ACF fields with defaults
$brands_label = furrylicious_get_page_field('brands_label', 'Featured Brands');
$brands_title = furrylicious_get_page_field('brands_title', 'Brands We Love');

// Services Section ACF fields with defaults
$services_label = furrylicious_get_page_field('services_label', 'Boutique Services');
$services_title = furrylicious_get_page_field('services_title', 'The Furrylicious Experience');

// Gift Cards Section ACF fields with defaults
$giftcards_title = furrylicious_get_page_field('giftcards_title', 'Give the Gift of Furrylicious');
$giftcards_tagline = furrylicious_get_page_field('giftcards_tagline', 'The perfect present for the pet lover in your life');
$giftcards_cta_text = furrylicious_get_page_field('giftcards_cta_text', 'Buy a Gift Card');
$giftcards_cta_link = furrylicious_get_page_field('giftcards_cta_link', home_url('/shop/gift-cards/'));
?>

<?php
// Schema.org JSON-LD Structured Data
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Store',
    'name' => 'Furrylicious Pet Boutique',
    'description' => 'Premium pet products, accessories, and supplies in Whitehouse Station, NJ',
    'url' => home_url('/boutique/'),
    'telephone' => '(908) 823-4468',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '531 US Highway 22 E',
        'addressLocality' => 'Whitehouse Station',
        'addressRegion' => 'NJ',
        'postalCode' => '08889',
        'addressCountry' => 'US'
    ],
    'openingHoursSpecification' => [
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        'opens' => '11:00',
        'closes' => '19:00'
    ],
    'priceRange' => '$$-$$$',
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Pet Products',
        'itemListElement' => [
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Product', 'name' => 'Pet Apparel']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Product', 'name' => 'Pet Carriers']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Product', 'name' => 'Pet Beds']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Product', 'name' => 'Premium Pet Food']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Product', 'name' => 'Pet Toys']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Product', 'name' => 'Grooming Supplies']]
        ]
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="boutique-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="boutique-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Pet Boutique', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="boutique-page__hero" aria-label="Pet Boutique">
        <?php if (!empty($hero_background['url'])) : ?>
        <div class="boutique-page__hero-background">
            <img
                src="<?php echo esc_url($hero_background['url']); ?>"
                alt="<?php echo esc_attr($hero_background['alt'] ?: 'Furrylicious pet boutique interior'); ?>"
                loading="eager"
            >
            <div class="boutique-page__hero-overlay"></div>
        </div>
        <?php endif; ?>
        <div class="container">
            <div class="boutique-page__hero-content">
                <span class="boutique-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="boutique-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="boutique-page__hero-description"><?php echo esc_html($hero_description); ?></p>

                <div class="boutique-page__hero-cta">
                    <a href="<?php echo esc_url($hero_cta_link); ?>" class="btn btn--white btn--lg"><?php echo esc_html($hero_cta_text); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Showcase -->
    <section class="boutique-page__brands" aria-labelledby="brands-heading">
        <div class="container">
            <header class="boutique-page__brands-header">
                <span class="boutique-page__section-label"><?php echo esc_html($brands_label); ?></span>
                <h2 id="brands-heading" class="boutique-page__section-title"><?php echo esc_html($brands_title); ?></h2>
            </header>

            <div class="boutique-page__brands-grid">
                <?php if (furrylicious_has_items('brands')): ?>
                    <?php while (have_rows('brands')): the_row();
                        $logo = get_sub_field('logo');
                        $name = get_sub_field('name');
                    ?>
                        <div class="boutique-page__brand">
                            <?php if ($logo && is_array($logo)): ?>
                                <img
                                    src="<?php echo esc_url($logo['url']); ?>"
                                    alt="<?php echo esc_attr($logo['alt'] ?: $name); ?>"
                                    loading="lazy"
                                    width="150"
                                    height="80"
                                >
                            <?php else: ?>
                                <span class="boutique-page__brand-name"><?php echo esc_html($name); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <?php
                    $default_brands = [
                        ['name' => 'Hello Doggie', 'logo' => 'hello-doggie.png'],
                        ['name' => 'Puppia', 'logo' => 'puppia.png'],
                        ['name' => 'Merrick', 'logo' => 'merrick.png'],
                        ['name' => "Stella & Chewy's", 'logo' => 'stella-chewys.png'],
                        ['name' => 'Kong', 'logo' => 'kong.png'],
                        ['name' => 'Earthbath', 'logo' => 'earthbath.png'],
                    ];
                    foreach ($default_brands as $brand):
                    ?>
                        <div class="boutique-page__brand">
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/brands/' . $brand['logo']); ?>"
                                alt="<?php echo esc_attr($brand['name']); ?>"
                                loading="lazy"
                                width="150"
                                height="80"
                            >
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="boutique-page__services" aria-labelledby="services-heading">
        <div class="container">
            <header class="boutique-page__services-header">
                <span class="boutique-page__section-label"><?php echo esc_html($services_label); ?></span>
                <h2 id="services-heading" class="boutique-page__section-title"><?php echo esc_html($services_title); ?></h2>
            </header>

            <div class="boutique-page__services-grid">
                <?php if (furrylicious_has_items('services')): ?>
                    <?php while (have_rows('services')): the_row();
                        $service_icon = get_sub_field('icon');
                        $service_title = get_sub_field('title');
                        $service_description = get_sub_field('description');
                    ?>
                        <div class="boutique-page__service">
                            <div class="boutique-page__service-icon">
                                <?php if ($service_icon === 'user'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                <?php elseif ($service_icon === 'gift'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M20 12v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7"/>
                                        <path d="M12 17V3"/>
                                        <path d="M8 7l4-4 4 4"/>
                                        <rect x="4" y="12" width="16" height="2"/>
                                    </svg>
                                <?php elseif ($service_icon === 'search'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="11" cy="11" r="8"/>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                        <line x1="11" y1="8" x2="11" y2="14"/>
                                        <line x1="8" y1="11" x2="14" y2="11"/>
                                    </svg>
                                <?php elseif ($service_icon === 'truck'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="1" y="3" width="15" height="13"/>
                                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                                        <circle cx="5.5" cy="18.5" r="2.5"/>
                                        <circle cx="18.5" cy="18.5" r="2.5"/>
                                    </svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <h3><?php echo esc_html($service_title); ?></h3>
                            <p><?php echo esc_html($service_description); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="boutique-page__service">
                        <div class="boutique-page__service-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <h3>Personal Shopping</h3>
                        <p>Let our experts help you find the perfect products for your pet's needs and personality.</p>
                    </div>

                    <div class="boutique-page__service">
                        <div class="boutique-page__service-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 12v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7"/>
                                <path d="M12 17V3"/>
                                <path d="M8 7l4-4 4 4"/>
                                <rect x="4" y="12" width="16" height="2"/>
                            </svg>
                        </div>
                        <h3>Gift Wrapping</h3>
                        <p>Complimentary gift wrapping for that perfect present for the pet lover in your life.</p>
                    </div>

                    <div class="boutique-page__service">
                        <div class="boutique-page__service-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="11" cy="11" r="8"/>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                <line x1="11" y1="8" x2="11" y2="14"/>
                                <line x1="8" y1="11" x2="14" y2="11"/>
                            </svg>
                        </div>
                        <h3>Special Orders</h3>
                        <p>Can't find what you need? We'll source it for you from our trusted brand partners.</p>
                    </div>

                    <div class="boutique-page__service">
                        <div class="boutique-page__service-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="1" y="3" width="15" height="13"/>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                        </div>
                        <h3>Local Delivery</h3>
                        <p>Free local delivery on orders over $50 within the Whitehouse Station area.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Gift Cards -->
    <section class="boutique-page__giftcards" aria-labelledby="giftcards-heading">
        <div class="container">
            <div class="boutique-page__giftcards-wrapper">
                <h2 id="giftcards-heading"><?php echo esc_html($giftcards_title); ?></h2>
                <p><?php echo esc_html($giftcards_tagline); ?></p>

                <!-- Visual Gift Card -->
                <div class="boutique-page__giftcard-visual">
                    <div class="boutique-page__giftcard-design">
                        <div class="boutique-page__giftcard-logo">
                            <span class="giftcard-logo-text">Furrylicious</span>
                            <span class="giftcard-tagline">Pet Boutique & Salon</span>
                        </div>
                        <div class="boutique-page__giftcard-label">Gift Card</div>
                    </div>
                </div>

                <a href="<?php echo esc_url($giftcards_cta_link); ?>" class="btn btn--giftcard">
                    <?php echo esc_html($giftcards_cta_text); ?>
                </a>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
