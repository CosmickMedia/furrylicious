<?php
/**
 * Template Name: Pet Boutique
 *
 * Pet boutique retail page showcasing products and brands.
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
        <div class="boutique-page__hero-background">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/boutique-hero.jpg'); ?>"
                alt="Furrylicious pet boutique interior"
                loading="eager"
            >
            <div class="boutique-page__hero-overlay"></div>
        </div>
        <div class="container">
            <div class="boutique-page__hero-content">
                <span class="boutique-page__section-label">Shop</span>
                <h1 class="boutique-page__hero-title">Luxury & Love, Curated for Your Companion</h1>
                <p class="boutique-page__hero-description">Discover premium pet products from the brands we trust for our own furry friends. From designer accessories to healthy nutrition, we've curated the best for your best friend.</p>

                <div class="boutique-page__hero-cta">
                    <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn btn--white btn--lg">Shop Online</a>
                    <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn btn--outline btn--lg" style="border-color: white; color: white;">Visit In-Store</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Showcase -->
    <section class="boutique-page__brands" aria-labelledby="brands-heading">
        <div class="container">
            <header class="boutique-page__brands-header">
                <span class="boutique-page__section-label">Featured Brands</span>
                <h2 id="brands-heading" class="boutique-page__section-title">Brands We Love</h2>
            </header>

            <div class="boutique-page__brands-grid">
                <?php
                $brands = [
                    ['name' => 'Hello Doggie', 'logo' => 'hello-doggie.png'],
                    ['name' => 'Puppia', 'logo' => 'puppia.png'],
                    ['name' => 'Merrick', 'logo' => 'merrick.png'],
                    ['name' => "Stella & Chewy's", 'logo' => 'stella-chewys.png'],
                    ['name' => 'Kong', 'logo' => 'kong.png'],
                    ['name' => 'Earthbath', 'logo' => 'earthbath.png'],
                ];

                foreach ($brands as $brand) :
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
            </div>
        </div>
    </section>

    <!-- Product Categories -->
    <section class="boutique-page__categories" aria-labelledby="categories-heading">
        <div class="container">
            <header class="boutique-page__categories-header">
                <span class="boutique-page__section-label">Shop by Category</span>
                <h2 id="categories-heading" class="boutique-page__section-title">Explore Our Collection</h2>
            </header>

            <div class="boutique-page__categories-grid">
                <?php
                $categories = [
                    [
                        'name' => 'Apparel',
                        'description' => 'Stylish sweaters, coats, and outfits',
                        'image' => 'category-apparel.jpg',
                        'link' => '/shop/apparel/',
                    ],
                    [
                        'name' => 'Carriers',
                        'description' => 'Designer bags and travel carriers',
                        'image' => 'category-carriers.jpg',
                        'link' => '/shop/carriers/',
                    ],
                    [
                        'name' => 'Beds',
                        'description' => 'Plush beds and cozy blankets',
                        'image' => 'category-beds.jpg',
                        'link' => '/shop/beds/',
                    ],
                    [
                        'name' => 'Food & Treats',
                        'description' => 'Premium nutrition and healthy snacks',
                        'image' => 'category-food.jpg',
                        'link' => '/shop/food/',
                    ],
                    [
                        'name' => 'Toys',
                        'description' => 'Interactive and plush playtime fun',
                        'image' => 'category-toys.jpg',
                        'link' => '/shop/toys/',
                    ],
                    [
                        'name' => 'Grooming',
                        'description' => 'Shampoos, brushes, and spa essentials',
                        'image' => 'category-grooming.jpg',
                        'link' => '/shop/grooming/',
                    ],
                ];

                foreach ($categories as $category) :
                ?>
                    <a href="<?php echo esc_url(home_url($category['link'])); ?>" class="boutique-page__category-card">
                        <div class="boutique-page__category-image">
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/categories/' . $category['image']); ?>"
                                alt="<?php echo esc_attr($category['name']); ?>"
                                loading="lazy"
                                width="400"
                                height="300"
                            >
                        </div>
                        <div class="boutique-page__category-content">
                            <h3 class="boutique-page__category-name"><?php echo esc_html($category['name']); ?></h3>
                            <p class="boutique-page__category-description"><?php echo esc_html($category['description']); ?></p>
                            <span class="boutique-page__category-link">
                                Shop Now
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="boutique-page__featured" aria-labelledby="featured-heading">
        <div class="container">
            <header class="boutique-page__featured-header">
                <span class="boutique-page__section-label">Bestsellers</span>
                <h2 id="featured-heading" class="boutique-page__section-title">Customer Favorites</h2>
            </header>

            <div class="boutique-page__featured-grid">
                <?php
                // Get featured products from WooCommerce
                if (class_exists('WooCommerce')) {
                    $featured_products = wc_get_products([
                        'featured' => true,
                        'status' => 'publish',
                        'limit' => 4,
                    ]);

                    if ($featured_products) {
                        foreach ($featured_products as $product) {
                            ?>
                            <div class="boutique-page__product-card">
                                <a href="<?php echo esc_url($product->get_permalink()); ?>" class="boutique-page__product-link">
                                    <div class="boutique-page__product-image">
                                        <?php echo $product->get_image('medium'); ?>
                                    </div>
                                    <div class="boutique-page__product-content">
                                        <h3 class="boutique-page__product-name"><?php echo esc_html($product->get_name()); ?></h3>
                                        <p class="boutique-page__product-price"><?php echo $product->get_price_html(); ?></p>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                } else {
                    // Placeholder if WooCommerce not active
                    $placeholder_products = [
                        ['name' => 'Hello Doggie Luxe Blanket', 'price' => '$89.00'],
                        ['name' => 'Puppia Soft Harness', 'price' => '$34.00'],
                        ['name' => "Stella & Chewy's Dinner", 'price' => '$32.00'],
                        ['name' => 'Designer Pet Carrier', 'price' => '$149.00'],
                    ];
                    foreach ($placeholder_products as $product) :
                ?>
                    <div class="boutique-page__product-card">
                        <div class="boutique-page__product-link">
                            <div class="boutique-page__product-image boutique-page__product-image--placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                            <div class="boutique-page__product-content">
                                <h3 class="boutique-page__product-name"><?php echo esc_html($product['name']); ?></h3>
                                <p class="boutique-page__product-price"><?php echo esc_html($product['price']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                }
                ?>
            </div>

            <div class="boutique-page__featured-cta">
                <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="btn btn--outline btn--lg">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="boutique-page__services" aria-labelledby="services-heading">
        <div class="container">
            <header class="boutique-page__services-header">
                <span class="boutique-page__section-label">Boutique Services</span>
                <h2 id="services-heading" class="boutique-page__section-title">The Furrylicious Experience</h2>
            </header>

            <div class="boutique-page__services-grid">
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
            </div>
        </div>
    </section>

    <!-- In-Store Experience -->
    <section class="boutique-page__experience" aria-labelledby="experience-heading">
        <div class="container">
            <div class="boutique-page__experience-grid">
                <div class="boutique-page__experience-images">
                    <div class="boutique-page__experience-image boutique-page__experience-image--main">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/boutique-interior-1.jpg'); ?>"
                            alt="Furrylicious boutique interior"
                            loading="lazy"
                            width="500"
                            height="400"
                        >
                    </div>
                    <div class="boutique-page__experience-image boutique-page__experience-image--secondary">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/boutique-interior-2.jpg'); ?>"
                            alt="Product displays at Furrylicious"
                            loading="lazy"
                            width="300"
                            height="250"
                        >
                    </div>
                </div>

                <div class="boutique-page__experience-content">
                    <span class="boutique-page__section-label">Visit Us</span>
                    <h2 id="experience-heading" class="boutique-page__section-title">The In-Store Experience</h2>
                    <p class="boutique-page__experience-intro">Shopping at Furrylicious is more than a transaction&mdash;it's an experience. Browse our carefully curated selection in a warm, welcoming environment designed for you and your furry friend.</p>

                    <blockquote class="boutique-page__testimonial">
                        <p>"I love coming to Furrylicious! The staff always remembers my dog's name and helps me find exactly what I need. The product selection is amazing."</p>
                        <cite>&mdash; Sarah M., Regular Customer</cite>
                    </blockquote>

                    <a href="<?php echo esc_url(home_url('/booking/')); ?>" class="btn btn--primary">
                        Plan Your Visit
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gift Cards -->
    <section class="boutique-page__giftcards" aria-labelledby="giftcards-heading">
        <div class="container">
            <div class="boutique-page__giftcards-card">
                <div class="boutique-page__giftcards-content">
                    <h2 id="giftcards-heading">Give the Gift of Furrylicious</h2>
                    <p>Know a pet parent who deserves something special? Our gift cards make the perfect present for birthdays, holidays, or just because.</p>
                    <a href="<?php echo esc_url(home_url('/shop/gift-cards/')); ?>" class="btn btn--white btn--lg">
                        Shop Gift Cards
                    </a>
                </div>
                <div class="boutique-page__giftcards-image">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/gift-card.png'); ?>"
                        alt="Furrylicious Gift Card"
                        loading="lazy"
                        width="300"
                        height="200"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <?php get_template_part('partials/section-contact', null, [
        'title' => __('Questions About Our Products?', 'furrylicious'),
        'subtitle' => __('Our team is here to help you find the perfect products for your pet', 'furrylicious'),
        'show_form' => false
    ]); ?>

</article>

<?php get_footer(); ?>
