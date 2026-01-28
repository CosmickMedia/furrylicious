<?php
/**
 * Template Name: Reviews
 *
 * Customer reviews and testimonials page.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// =============================================================================
// ACF FIELDS WITH STATIC FALLBACKS
// =============================================================================

// Hero Section
$hero_label = get_field('hero_label') ?: 'Testimonials';
$hero_title = get_field('hero_title') ?: 'Real Stories from Real Families';
$overall_rating = get_field('overall_rating') ?: 5.0;
$total_reviews = get_field('total_reviews') ?: '125+';
$leave_review_cta_text = get_field('leave_review_cta_text') ?: 'Leave a Review';
$leave_review_cta_link = get_field('leave_review_cta_link') ?: 'https://search.google.com/local/writereview?placeid=ChIJ';

// Platforms
$platforms = get_field('platforms');
if (empty($platforms)) {
    $platforms = [
        [
            'name' => 'google',
            'logo' => null,
            'rating' => 4.2,
            'count' => '570 reviews',
            'url' => 'https://www.google.com/maps/place/Furrylicious',
        ],
        [
            'name' => 'yelp',
            'logo' => null,
            'rating' => 5.0,
            'count' => '75 reviews',
            'url' => 'https://www.yelp.com/biz/furrylicious-whitehouse-station-3',
        ],
        [
            'name' => 'facebook',
            'logo' => null,
            'rating' => 5.0,
            'count' => '65 reviews',
            'url' => 'https://www.facebook.com/furryliciousnj/reviews',
        ],
    ];
}

// Reviews Section
$reviews_section_title = get_field('reviews_section_title') ?: 'What Our Families Say';
$reviews = get_field('reviews');
if (empty($reviews)) {
    $reviews = [
        [
            'quote' => 'Very happy with this place. Very clean the best pet shop I\'ve ever been to I\'m so happy with my dachshund that I purchased from the store he is very happy and healthy his name is Riley I had a very good experience with the owner she\'s fantastic!!!',
            'author' => 'Renee',
            'breed' => 'Dachshund',
            'platform' => 'google',
            'rating' => 5,
        ],
        [
            'quote' => 'I truly enjoyed my experience with Furrylicious when purchasing my Cockalier Georgie. The staff was extremely helpful and knowledgeable. Georgie has been a wonderful addition to my family. He is adorable, happy, smart and very playful.',
            'author' => 'Maria Lorefice',
            'breed' => 'Cockalier',
            'platform' => 'google',
            'rating' => 5,
        ],
        [
            'quote' => 'We are so fortunate to have found Furrylicious! We love our mini goldendoodle puppy! He has a wonderful, calm temperament and is the best addition to our family! Cindy and her team went above and beyond for our family! Definitely recommend!!',
            'author' => 'D. O\'Donnell',
            'breed' => 'Mini Goldendoodle',
            'platform' => 'yelp',
            'rating' => 5,
        ],
        [
            'quote' => 'We found our perfect French Bulldog at Furrylicious! The staff was incredibly knowledgeable and helped us every step of the way. Our Louie is healthy, happy, and the best addition to our family.',
            'author' => 'Jennifer M.',
            'breed' => 'French Bulldog',
            'platform' => 'facebook',
            'rating' => 5,
        ],
        [
            'quote' => 'The experience at Furrylicious was nothing like other pet stores. They truly care about matching the right puppy with the right family. Their follow-up support has been amazing!',
            'author' => 'David K.',
            'breed' => 'Golden Retriever',
            'platform' => 'google',
            'rating' => 5,
        ],
        [
            'quote' => 'As first-time puppy parents, we had so many questions. The team at Furrylicious was patient, informative, and made the whole process enjoyable. Our Cavapoo is absolutely perfect!',
            'author' => 'Sarah R.',
            'breed' => 'Cavapoo',
            'platform' => 'yelp',
            'rating' => 5,
        ],
        [
            'quote' => 'Best place to get a puppy! Clean facility, healthy puppies, and amazing customer service. They even followed up a week later to see how we were doing. Highly recommend!',
            'author' => 'Michael T.',
            'breed' => 'Labradoodle',
            'platform' => 'google',
            'rating' => 5,
        ],
        [
            'quote' => 'We drove 2 hours to visit Furrylicious after reading the reviews, and it was absolutely worth it. The puppies are well cared for and the staff is so passionate about what they do.',
            'author' => 'Amanda P.',
            'breed' => 'Cavalier King Charles',
            'platform' => 'facebook',
            'rating' => 5,
        ],
        [
            'quote' => 'From the moment we walked in, we knew this was different. No high-pressure sales, just genuine love for the puppies and desire to find them great homes. Our Bernedoodle is thriving!',
            'author' => 'Chris & Lisa M.',
            'breed' => 'Bernedoodle',
            'platform' => 'yelp',
            'rating' => 5,
        ],
    ];
}

// Photos Section
$photos_label = get_field('photos_label') ?: 'Happy Puppies';
$photos_title = get_field('photos_title') ?: 'Photos from Our Families';
$customer_photos = get_field('customer_photos');
$instagram_link = get_field('instagram_link') ?: 'https://www.instagram.com/furryliciousnj/';

// Leave Review Section
$leave_review_title = get_field('leave_review_title') ?: 'Share Your Story';
$leave_review_description = get_field('leave_review_description') ?: 'We\'d love to hear about your experience! Leave a review on your favorite platform.';
$leave_review_platforms = get_field('leave_review_platforms');
if (empty($leave_review_platforms)) {
    $leave_review_platforms = [
        [
            'name' => 'google',
            'url' => 'https://search.google.com/local/writereview?placeid=ChIJ',
        ],
        [
            'name' => 'yelp',
            'url' => 'https://www.yelp.com/writeareview/biz/furrylicious-whitehouse-station-3',
        ],
        [
            'name' => 'facebook',
            'url' => 'https://www.facebook.com/furryliciousnj/reviews',
        ],
    ];
}

// SEO Fields
$focus_keyphrase = get_field('focus_keyphrase');
$seo_meta_description = get_field('seo_meta_description');
$og_image = get_field('og_image');

// =============================================================================
// HELPER FUNCTIONS
// =============================================================================

/**
 * Get platform logo URL (ACF image or fallback to theme asset)
 */
function furrylicious_get_platform_logo($platform_data, $platform_name) {
    if (!empty($platform_data['logo']) && is_array($platform_data['logo'])) {
        return $platform_data['logo']['url'];
    }
    return get_template_directory_uri() . '/assets/images/platforms/' . $platform_name . '.svg';
}

/**
 * Get platform display name
 */
function furrylicious_get_platform_display_name($platform_name) {
    $names = [
        'google' => 'Google',
        'yelp' => 'Yelp',
        'facebook' => 'Facebook',
    ];
    return $names[$platform_name] ?? ucfirst($platform_name);
}

// =============================================================================
// SCHEMA.ORG STRUCTURED DATA
// =============================================================================
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Furrylicious',
    'url' => home_url('/'),
    'telephone' => '(908) 823-4468',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '531 US Highway 22 E',
        'addressLocality' => 'Whitehouse Station',
        'addressRegion' => 'NJ',
        'postalCode' => '08889',
        'addressCountry' => 'US'
    ],
    'aggregateRating' => [
        '@type' => 'AggregateRating',
        'ratingValue' => (string) $overall_rating,
        'reviewCount' => preg_replace('/[^0-9]/', '', $total_reviews),
        'bestRating' => '5',
        'worstRating' => '1'
    ],
    'review' => []
];

// Add reviews to schema (first 2 for structured data)
$schema_reviews = array_slice($reviews, 0, 2);
foreach ($schema_reviews as $review) {
    $schema['review'][] = [
        '@type' => 'Review',
        'reviewRating' => ['@type' => 'Rating', 'ratingValue' => (string) ($review['rating'] ?? 5)],
        'author' => ['@type' => 'Person', 'name' => $review['author']],
        'reviewBody' => $review['quote']
    ];
}
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="reviews-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="reviews-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Reviews', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="reviews-page__hero" aria-label="Customer Reviews">
        <div class="container">
            <div class="reviews-page__hero-content">
                <span class="reviews-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="reviews-page__hero-title"><?php echo esc_html($hero_title); ?></h1>

                <div class="reviews-page__hero-rating">
                    <div class="reviews-page__stars" aria-label="<?php echo esc_attr($overall_rating); ?> out of 5 stars">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="reviews-page__rating-value"><?php echo esc_html(number_format((float) $overall_rating, 1)); ?></span>
                    <span class="reviews-page__rating-count">from <?php echo esc_html($total_reviews); ?> reviews</span>
                </div>

                <div class="reviews-page__platforms">
                    <?php foreach ($platforms as $platform) :
                        $platform_name = $platform['name'] ?? 'google';
                        $logo_url = furrylicious_get_platform_logo($platform, $platform_name);
                        $display_name = furrylicious_get_platform_display_name($platform_name);
                    ?>
                        <span class="reviews-page__platform">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($display_name); ?>" width="24" height="24">
                            <?php echo esc_html($display_name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <a href="<?php echo esc_url($leave_review_cta_link); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--lg">
                    <?php echo esc_html($leave_review_cta_text); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Rating Summary -->
    <section class="reviews-page__summary" aria-labelledby="summary-heading">
        <div class="container">
            <h2 id="summary-heading" class="sr-only">Rating Summary</h2>

            <div class="reviews-page__summary-grid">
                <?php foreach ($platforms as $platform) :
                    $platform_name = $platform['name'] ?? 'google';
                    $logo_url = furrylicious_get_platform_logo($platform, $platform_name);
                    $display_name = furrylicious_get_platform_display_name($platform_name);
                    $platform_rating = $platform['rating'] ?? 5.0;
                    $platform_count = $platform['count'] ?? '';
                    $platform_url = $platform['url'] ?? '#';
                ?>
                    <div class="reviews-page__summary-card">
                        <div class="reviews-page__summary-platform">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($display_name); ?>" width="32" height="32">
                            <span><?php echo esc_html($display_name); ?> Reviews</span>
                        </div>
                        <div class="reviews-page__summary-rating">
                            <span class="reviews-page__summary-value"><?php echo esc_html(number_format((float) $platform_rating, 1)); ?></span>
                            <div class="reviews-page__summary-stars">
                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <span class="reviews-page__summary-count"><?php echo esc_html($platform_count); ?></span>
                        <a href="<?php echo esc_url($platform_url); ?>" target="_blank" rel="noopener noreferrer" class="reviews-page__summary-link">Read on <?php echo esc_html($display_name); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Review Grid -->
    <section class="reviews-page__grid-section" aria-labelledby="reviews-heading">
        <div class="container">
            <header class="reviews-page__grid-header">
                <h2 id="reviews-heading" class="reviews-page__section-title"><?php echo esc_html($reviews_section_title); ?></h2>
            </header>

            <div class="reviews-page__grid">
                <?php foreach ($reviews as $review) :
                    $review_rating = $review['rating'] ?? 5;
                    $review_platform = $review['platform'] ?? 'google';
                ?>
                    <div class="reviews-page__review-card" itemscope itemtype="https://schema.org/Review">
                        <div class="reviews-page__review-header">
                            <div class="reviews-page__review-stars" aria-label="<?php echo esc_attr($review_rating); ?> out of 5 stars">
                                <?php for ($i = 0; $i < $review_rating; $i++) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="reviews-page__review-platform reviews-page__review-platform--<?php echo esc_attr($review_platform); ?>">
                                <?php echo esc_html(furrylicious_get_platform_display_name($review_platform)); ?>
                            </span>
                        </div>

                        <blockquote class="reviews-page__review-quote" itemprop="reviewBody">
                            "<?php echo esc_html($review['quote']); ?>"
                        </blockquote>

                        <footer class="reviews-page__review-footer">
                            <div class="reviews-page__review-author">
                                <div class="reviews-page__review-avatar">
                                    <?php echo esc_html(substr($review['author'], 0, 1)); ?>
                                </div>
                                <div class="reviews-page__review-info">
                                    <span class="reviews-page__review-name" itemprop="author"><?php echo esc_html($review['author']); ?></span>
                                    <span class="reviews-page__review-breed"><?php echo esc_html($review['breed']); ?> Parent</span>
                                </div>
                            </div>
                        </footer>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Photo Reviews -->
    <section class="reviews-page__photos" aria-labelledby="photos-heading">
        <div class="container">
            <header class="reviews-page__photos-header">
                <span class="reviews-page__section-label"><?php echo esc_html($photos_label); ?></span>
                <h2 id="photos-heading" class="reviews-page__section-title"><?php echo esc_html($photos_title); ?></h2>
            </header>

            <div class="reviews-page__photos-grid">
                <?php if (!empty($customer_photos) && is_array($customer_photos)) : ?>
                    <?php foreach ($customer_photos as $photo) : ?>
                        <a href="<?php echo esc_url($photo['url']); ?>" class="reviews-page__photo" data-lightbox>
                            <img
                                src="<?php echo esc_url($photo['sizes']['medium'] ?? $photo['url']); ?>"
                                alt="<?php echo esc_attr($photo['alt'] ?: 'Happy puppy from Furrylicious family'); ?>"
                                loading="lazy"
                                width="300"
                                height="300"
                            >
                            <div class="reviews-page__photo-overlay">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    <line x1="11" y1="8" x2="11" y2="14"/>
                                    <line x1="8" y1="11" x2="14" y2="11"/>
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <a href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/customer-photos/photo-' . $i . '.svg'); ?>" class="reviews-page__photo" data-lightbox>
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/customer-photos/photo-' . $i . '.svg'); ?>"
                                alt="Happy puppy from Furrylicious family"
                                loading="lazy"
                                width="300"
                                height="300"
                            >
                            <div class="reviews-page__photo-overlay">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    <line x1="11" y1="8" x2="11" y2="14"/>
                                    <line x1="8" y1="11" x2="14" y2="11"/>
                                </svg>
                            </div>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>

            <div class="reviews-page__photos-cta">
                <p>Share your puppy photos with us on Instagram!</p>
                <a href="<?php echo esc_url($instagram_link); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                    @furryliciousnj
                </a>
            </div>
        </div>
    </section>

    <!-- Leave a Review CTA -->
    <section id="leave-review" class="reviews-page__leave-review" aria-labelledby="leave-heading">
        <div class="container">
            <div class="reviews-page__leave-card">
                <h2 id="leave-heading"><?php echo esc_html($leave_review_title); ?></h2>
                <p><?php echo esc_html($leave_review_description); ?></p>

                <div class="reviews-page__leave-buttons">
                    <?php foreach ($leave_review_platforms as $platform) :
                        $platform_name = $platform['name'] ?? 'google';
                        $platform_url = $platform['url'] ?? '#';
                        $display_name = furrylicious_get_platform_display_name($platform_name);
                        $logo_url = get_template_directory_uri() . '/assets/images/platforms/' . $platform_name . '.svg';
                    ?>
                        <a href="<?php echo esc_url($platform_url); ?>" target="_blank" rel="noopener noreferrer" class="reviews-page__leave-btn reviews-page__leave-btn--<?php echo esc_attr($platform_name); ?>">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="" width="24" height="24">
                            Review on <?php echo esc_html($display_name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
