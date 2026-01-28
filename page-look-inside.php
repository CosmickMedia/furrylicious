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

// ACF Fields with fallbacks
// Hero Section
$hero_label = get_field('hero_label') ?: 'Welcome';
$hero_title = get_field('hero_title') ?: 'See Where the Magic Happens';
$hero_description = get_field('hero_description') ?: 'Take a virtual tour of our boutique and see why families trust us with their puppy journey. Clean, comfortable, and designed with love for every puppy.';
$hero_background = get_field('hero_background');
$hero_background_url = $hero_background ? $hero_background['url'] : get_template_directory_uri() . '/assets/images/tour-hero.jpg';
$hero_background_alt = $hero_background ? $hero_background['alt'] : 'Inside Furrylicious boutique';
$hero_cta_video_text = get_field('hero_cta_video_text') ?: 'Watch Video Tour';
$hero_cta_video_link = get_field('hero_cta_video_link') ?: '#video-tour';
$hero_cta_gallery_text = get_field('hero_cta_gallery_text') ?: 'View Gallery';
$hero_cta_gallery_link = get_field('hero_cta_gallery_link') ?: '#gallery';

// Video Section
$video_label = get_field('video_label') ?: 'Video Tour';
$video_title = get_field('video_title') ?: 'Take a Walk Through';
$video_description = get_field('video_description') ?: 'Join us for a guided tour of our facility and see how we care for our puppies every day.';
$video_url = get_field('video_url');

// Gallery Section
$gallery_label = get_field('gallery_label') ?: 'Photo Gallery';
$gallery_title = get_field('gallery_title') ?: 'Explore Our Space';
$gallery_categories = get_field('gallery_categories');
$gallery_images = get_field('gallery_images');

// Features Section
$features_label = get_field('features_label') ?: 'Our Facility';
$features_title = get_field('features_title') ?: 'What Makes Us Special';
$features = get_field('features');

// Standards Section
$standards_label = get_field('standards_label') ?: 'Health & Safety';
$standards_title = get_field('standards_title') ?: 'Our Cleanliness Standards';
$standards_intro = get_field('standards_intro') ?: 'We go above and beyond to maintain a pristine environment that keeps our puppies healthy and happy.';
$standards_list = get_field('standards_list');
$standards_image = get_field('standards_image');
$standards_image_url = $standards_image ? $standards_image['url'] : get_template_directory_uri() . '/assets/images/cleanliness-standards.jpg';
$standards_image_alt = $standards_image ? $standards_image['alt'] : 'Clean and organized puppy care area at Furrylicious';

// CTA Section
$cta_title = get_field('cta_title') ?: 'Ready to See Us in Person?';
$cta_description = get_field('cta_description') ?: 'Nothing beats visiting in person. Schedule your appointment and experience our boutique firsthand.';
$cta_primary_text = get_field('cta_primary_text') ?: 'Schedule a Visit';
$cta_primary_link = get_field('cta_primary_link') ?: home_url('/booking/');
$cta_secondary_text = get_field('cta_secondary_text') ?: 'Meet Our Puppies';
$cta_secondary_link = get_field('cta_secondary_link') ?: home_url('/puppies/');

// Static fallback data for gallery categories
$default_gallery_categories = [
    ['slug' => 'interior', 'label' => 'Interior'],
    ['slug' => 'play-areas', 'label' => 'Play Areas'],
    ['slug' => 'puppy-suites', 'label' => 'Puppy Suites'],
    ['slug' => 'retail', 'label' => 'Retail'],
];

// Static fallback data for gallery images
$default_gallery_images = [
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

// Static fallback data for features
$default_features = [
    [
        'icon' => 'thermometer',
        'title' => 'Climate Control',
        'description' => 'Temperature and humidity carefully maintained year-round for puppy comfort and health.',
    ],
    [
        'icon' => 'shield',
        'title' => 'Daily Sanitization',
        'description' => 'Hospital-grade cleaning protocols ensure a healthy environment for every puppy.',
    ],
    [
        'icon' => 'smile',
        'title' => 'Play Areas',
        'description' => 'Dedicated spaces for puppies to exercise, socialize, and develop healthy behaviors.',
    ],
    [
        'icon' => 'users',
        'title' => 'Private Meetings',
        'description' => 'Comfortable rooms where families can bond with puppies in a relaxed, private setting.',
    ],
    [
        'icon' => 'monitor',
        'title' => '24/7 Monitoring',
        'description' => 'Security cameras and staff checks ensure puppies are safe and well-cared for always.',
    ],
    [
        'icon' => 'heart',
        'title' => 'Loving Care',
        'description' => 'Our team treats every puppy like family with daily handling and attention.',
    ],
];

// Static fallback data for standards list
$default_standards_list = [
    ['item' => 'Hospital-grade disinfection multiple times daily'],
    ['item' => 'HEPA air filtration for clean, fresh air'],
    ['item' => 'Separate areas for new arrivals and quarantine'],
    ['item' => 'Fresh bedding changed throughout the day'],
    ['item' => 'Staff trained in proper hygiene protocols'],
    ['item' => 'Regular health inspections by licensed veterinarians'],
];

// Helper function for feature icons
function furrylicious_get_feature_icon($icon_key) {
    $icons = [
        'thermometer' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 14.76V3.5a2.5 2.5 0 00-5 0v11.26a4.5 4.5 0 105 0z"/></svg>',
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>',
        'smile' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>',
        'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>',
        'monitor' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
        'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>',
    ];
    return isset($icons[$icon_key]) ? $icons[$icon_key] : $icons['heart'];
}
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
                src="<?php echo esc_url($hero_background_url); ?>"
                alt="<?php echo esc_attr($hero_background_alt); ?>"
                loading="eager"
            >
            <div class="tour-page__hero-overlay"></div>
        </div>
        <div class="container">
            <div class="tour-page__hero-content">
                <span class="tour-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="tour-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="tour-page__hero-description"><?php echo esc_html($hero_description); ?></p>

                <div class="tour-page__hero-cta">
                    <a href="<?php echo esc_url($hero_cta_video_link); ?>" class="btn btn--white btn--lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"/>
                        </svg>
                        <?php echo esc_html($hero_cta_video_text); ?>
                    </a>
                    <a href="<?php echo esc_url($hero_cta_gallery_link); ?>" class="btn btn--outline btn--lg" style="border-color: white; color: white;">
                        <?php echo esc_html($hero_cta_gallery_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Tour -->
    <section id="video-tour" class="tour-page__video" aria-labelledby="video-heading">
        <div class="container">
            <header class="tour-page__video-header">
                <span class="tour-page__section-label"><?php echo esc_html($video_label); ?></span>
                <h2 id="video-heading" class="tour-page__section-title"><?php echo esc_html($video_title); ?></h2>
                <p class="tour-page__section-description"><?php echo esc_html($video_description); ?></p>
            </header>

            <div class="tour-page__video-wrapper">
                <?php if ($video_url) : ?>
                    <?php echo $video_url; ?>
                <?php else : ?>
                    <iframe
                        src="https://www.youtube.com/embed/VnlnqPz6PBQ?rel=0&modestbranding=1"
                        title="Furrylicious Facility Tour"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                    ></iframe>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Photo Gallery -->
    <section id="gallery" class="tour-page__gallery" aria-labelledby="gallery-heading">
        <div class="container">
            <header class="tour-page__gallery-header">
                <span class="tour-page__section-label"><?php echo esc_html($gallery_label); ?></span>
                <h2 id="gallery-heading" class="tour-page__section-title"><?php echo esc_html($gallery_title); ?></h2>
            </header>

            <div class="tour-page__gallery-filters">
                <button class="tour-page__filter-btn is-active" data-filter="all"><?php esc_html_e('All', 'furrylicious'); ?></button>
                <?php
                $categories_to_display = $gallery_categories ?: $default_gallery_categories;
                foreach ($categories_to_display as $category) :
                    $slug = is_array($category) ? ($category['slug'] ?? '') : '';
                    $label = is_array($category) ? ($category['label'] ?? '') : '';
                    if ($slug && $label) :
                ?>
                    <button class="tour-page__filter-btn" data-filter="<?php echo esc_attr($slug); ?>"><?php echo esc_html($label); ?></button>
                <?php
                    endif;
                endforeach;
                ?>
            </div>

            <div class="tour-page__gallery-grid" data-lightbox-gallery>
                <?php
                $images_to_display = $gallery_images ?: null;

                if ($images_to_display) :
                    // ACF gallery images
                    foreach ($images_to_display as $gallery_item) :
                        $image = $gallery_item['image'] ?? null;
                        $alt = $gallery_item['alt'] ?? '';
                        $category = $gallery_item['category'] ?? '';

                        if ($image) :
                            $img_url = $image['url'] ?? '';
                            $img_alt = $alt ?: ($image['alt'] ?? '');
                ?>
                    <a href="<?php echo esc_url($img_url); ?>"
                       class="tour-page__gallery-item"
                       data-category="<?php echo esc_attr($category); ?>"
                       data-lightbox>
                        <img
                            src="<?php echo esc_url($img_url); ?>"
                            alt="<?php echo esc_attr($img_alt); ?>"
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
                <?php
                        endif;
                    endforeach;
                else :
                    // Fallback static images
                    foreach ($default_gallery_images as $image) :
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
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Facility Features -->
    <section class="tour-page__features" aria-labelledby="features-heading">
        <div class="container">
            <header class="tour-page__features-header">
                <span class="tour-page__section-label"><?php echo esc_html($features_label); ?></span>
                <h2 id="features-heading" class="tour-page__section-title"><?php echo esc_html($features_title); ?></h2>
            </header>

            <div class="tour-page__features-grid">
                <?php
                $features_to_display = $features ?: $default_features;

                foreach ($features_to_display as $feature) :
                    $icon = $feature['icon'] ?? 'heart';
                    $title = $feature['title'] ?? '';
                    $description = $feature['description'] ?? '';

                    if ($title && $description) :
                ?>
                <div class="tour-page__feature">
                    <div class="tour-page__feature-icon">
                        <?php echo furrylicious_get_feature_icon($icon); ?>
                    </div>
                    <h3><?php echo esc_html($title); ?></h3>
                    <p><?php echo esc_html($description); ?></p>
                </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- Cleanliness Standards -->
    <section class="tour-page__standards" aria-labelledby="standards-heading">
        <div class="container">
            <div class="tour-page__standards-grid">
                <div class="tour-page__standards-content">
                    <span class="tour-page__section-label"><?php echo esc_html($standards_label); ?></span>
                    <h2 id="standards-heading" class="tour-page__section-title"><?php echo esc_html($standards_title); ?></h2>
                    <p class="tour-page__standards-intro"><?php echo esc_html($standards_intro); ?></p>

                    <ul class="tour-page__standards-list">
                        <?php
                        $standards_to_display = $standards_list ?: $default_standards_list;

                        foreach ($standards_to_display as $standard) :
                            $item = $standard['item'] ?? '';
                            if ($item) :
                        ?>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </ul>
                </div>

                <div class="tour-page__standards-image">
                    <img
                        src="<?php echo esc_url($standards_image_url); ?>"
                        alt="<?php echo esc_attr($standards_image_alt); ?>"
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
                <h2><?php echo esc_html($cta_title); ?></h2>
                <p><?php echo esc_html($cta_description); ?></p>
                <div class="tour-page__cta-buttons">
                    <a href="<?php echo esc_url($cta_primary_link); ?>" class="btn btn--white btn--lg">
                        <?php echo esc_html($cta_primary_text); ?>
                    </a>
                    <a href="<?php echo esc_url($cta_secondary_link); ?>" class="btn btn--outline btn--lg" style="border-color: white; color: white;">
                        <?php echo esc_html($cta_secondary_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
