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
?>

<?php
// Schema.org JSON-LD Structured Data
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
        'ratingValue' => '5.0',
        'reviewCount' => '125',
        'bestRating' => '5',
        'worstRating' => '1'
    ],
    'review' => [
        [
            '@type' => 'Review',
            'reviewRating' => ['@type' => 'Rating', 'ratingValue' => '5'],
            'author' => ['@type' => 'Person', 'name' => 'Jennifer M.'],
            'reviewBody' => 'We found our perfect French Bulldog at Furrylicious! The staff was incredibly knowledgeable and helped us every step of the way.'
        ],
        [
            '@type' => 'Review',
            'reviewRating' => ['@type' => 'Rating', 'ratingValue' => '5'],
            'author' => ['@type' => 'Person', 'name' => 'David K.'],
            'reviewBody' => 'The experience at Furrylicious was nothing like other pet stores. They truly care about matching the right puppy with the right family.'
        ]
    ]
];
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
                <span class="reviews-page__section-label">Testimonials</span>
                <h1 class="reviews-page__hero-title">Real Stories from Real Families</h1>

                <div class="reviews-page__hero-rating">
                    <div class="reviews-page__stars" aria-label="5 out of 5 stars">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="reviews-page__rating-value">5.0</span>
                    <span class="reviews-page__rating-count">from 125+ reviews</span>
                </div>

                <div class="reviews-page__platforms">
                    <span class="reviews-page__platform">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/google.svg'); ?>" alt="Google" width="24" height="24">
                        Google
                    </span>
                    <span class="reviews-page__platform">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/yelp.svg'); ?>" alt="Yelp" width="24" height="24">
                        Yelp
                    </span>
                    <span class="reviews-page__platform">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/facebook.svg'); ?>" alt="Facebook" width="24" height="24">
                        Facebook
                    </span>
                </div>

                <a href="#leave-review" class="btn btn--primary btn--lg">
                    Leave a Review
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
                <div class="reviews-page__summary-card">
                    <div class="reviews-page__summary-platform">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/google.svg'); ?>" alt="Google" width="32" height="32">
                        <span>Google Reviews</span>
                    </div>
                    <div class="reviews-page__summary-rating">
                        <span class="reviews-page__summary-value">5.0</span>
                        <div class="reviews-page__summary-stars">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <span class="reviews-page__summary-count">58 reviews</span>
                    <a href="https://www.google.com/search?q=furrylicious+whitehouse+station#lrd" target="_blank" rel="noopener noreferrer" class="reviews-page__summary-link">Read on Google</a>
                </div>

                <div class="reviews-page__summary-card">
                    <div class="reviews-page__summary-platform">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/yelp.svg'); ?>" alt="Yelp" width="32" height="32">
                        <span>Yelp Reviews</span>
                    </div>
                    <div class="reviews-page__summary-rating">
                        <span class="reviews-page__summary-value">5.0</span>
                        <div class="reviews-page__summary-stars">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <span class="reviews-page__summary-count">38 reviews</span>
                    <a href="https://www.yelp.com/biz/furrylicious-whitehouse-station" target="_blank" rel="noopener noreferrer" class="reviews-page__summary-link">Read on Yelp</a>
                </div>

                <div class="reviews-page__summary-card">
                    <div class="reviews-page__summary-platform">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/facebook.svg'); ?>" alt="Facebook" width="32" height="32">
                        <span>Facebook Reviews</span>
                    </div>
                    <div class="reviews-page__summary-rating">
                        <span class="reviews-page__summary-value">5.0</span>
                        <div class="reviews-page__summary-stars">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <span class="reviews-page__summary-count">29 reviews</span>
                    <a href="https://www.facebook.com/furryliciousnj/reviews" target="_blank" rel="noopener noreferrer" class="reviews-page__summary-link">Read on Facebook</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Review Grid -->
    <section class="reviews-page__grid-section" aria-labelledby="reviews-heading">
        <div class="container">
            <header class="reviews-page__grid-header">
                <h2 id="reviews-heading" class="reviews-page__section-title">What Our Families Say</h2>
            </header>

            <div class="reviews-page__grid">
                <?php
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

                foreach ($reviews as $review) :
                ?>
                    <div class="reviews-page__review-card" itemscope itemtype="https://schema.org/Review">
                        <div class="reviews-page__review-header">
                            <div class="reviews-page__review-stars" aria-label="<?php echo $review['rating']; ?> out of 5 stars">
                                <?php for ($i = 0; $i < $review['rating']; $i++) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="reviews-page__review-platform reviews-page__review-platform--<?php echo esc_attr($review['platform']); ?>">
                                <?php echo ucfirst($review['platform']); ?>
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
                <span class="reviews-page__section-label">Happy Puppies</span>
                <h2 id="photos-heading" class="reviews-page__section-title">Photos from Our Families</h2>
            </header>

            <div class="reviews-page__photos-grid">
                <?php for ($i = 1; $i <= 8; $i++) : ?>
                    <a href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/customer-photos/photo-' . $i . '.jpg'); ?>" class="reviews-page__photo" data-lightbox>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/customer-photos/photo-' . $i . '.jpg'); ?>"
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
            </div>

            <div class="reviews-page__photos-cta">
                <p>Share your puppy photos with us on Instagram!</p>
                <a href="https://www.instagram.com/furryliciousnj/" target="_blank" rel="noopener noreferrer" class="btn btn--outline">
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

    <!-- Video Testimonials -->
    <section class="reviews-page__videos" aria-labelledby="videos-heading">
        <div class="container">
            <header class="reviews-page__videos-header">
                <span class="reviews-page__section-label">Video Stories</span>
                <h2 id="videos-heading" class="reviews-page__section-title">Watch Their Stories</h2>
            </header>

            <div class="reviews-page__videos-grid">
                <div class="reviews-page__video-card">
                    <div class="reviews-page__video-wrapper">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/video-thumb-1.jpg'); ?>"
                            alt="Video testimonial thumbnail"
                            loading="lazy"
                        >
                        <button class="reviews-page__video-play" aria-label="Play video" data-video="VIDEO_ID_1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                        </button>
                    </div>
                    <p class="reviews-page__video-caption">The Johnson Family &amp; Their Goldendoodle</p>
                </div>

                <div class="reviews-page__video-card">
                    <div class="reviews-page__video-wrapper">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/video-thumb-2.jpg'); ?>"
                            alt="Video testimonial thumbnail"
                            loading="lazy"
                        >
                        <button class="reviews-page__video-play" aria-label="Play video" data-video="VIDEO_ID_2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                        </button>
                    </div>
                    <p class="reviews-page__video-caption">Meet Luna - A Happy Customer Update</p>
                </div>

                <div class="reviews-page__video-card">
                    <div class="reviews-page__video-wrapper">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/video-thumb-3.jpg'); ?>"
                            alt="Video testimonial thumbnail"
                            loading="lazy"
                        >
                        <button class="reviews-page__video-play" aria-label="Play video" data-video="VIDEO_ID_3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                        </button>
                    </div>
                    <p class="reviews-page__video-caption">From First Visit to Forever Home</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Leave a Review CTA -->
    <section id="leave-review" class="reviews-page__leave-review" aria-labelledby="leave-heading">
        <div class="container">
            <div class="reviews-page__leave-card">
                <h2 id="leave-heading">Share Your Story</h2>
                <p>We'd love to hear about your experience! Leave a review on your favorite platform.</p>

                <div class="reviews-page__leave-buttons">
                    <a href="https://www.google.com/search?q=furrylicious+whitehouse+station#lrd" target="_blank" rel="noopener noreferrer" class="reviews-page__leave-btn reviews-page__leave-btn--google">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/google.svg'); ?>" alt="" width="24" height="24">
                        Review on Google
                    </a>
                    <a href="https://www.yelp.com/writeareview/biz/furrylicious-whitehouse-station" target="_blank" rel="noopener noreferrer" class="reviews-page__leave-btn reviews-page__leave-btn--yelp">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/yelp.svg'); ?>" alt="" width="24" height="24">
                        Review on Yelp
                    </a>
                    <a href="https://www.facebook.com/furryliciousnj/reviews" target="_blank" rel="noopener noreferrer" class="reviews-page__leave-btn reviews-page__leave-btn--facebook">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/platforms/facebook.svg'); ?>" alt="" width="24" height="24">
                        Review on Facebook
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <?php get_template_part('partials/section-contact', null, [
        'title' => __('Ready to Start Your Puppy Journey?', 'furrylicious'),
        'subtitle' => __('Join our family of happy puppy parents', 'furrylicious'),
        'show_form' => false
    ]); ?>

</article>

<?php get_footer(); ?>
