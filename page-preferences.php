<?php
/**
 * Template Name: Preference Center
 *
 * Puppy matching preference center with multi-step form.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// ACF Fields with fallbacks
// Hero Section
$hero_label = get_field('hero_label') ?: 'Puppy Matching';
$hero_title = get_field('hero_title') ?: "Let's Find Your Perfect Match";
$hero_description = get_field('hero_description') ?: 'Tell us about your lifestyle, and we\'ll help match you with puppies that fit your home, heart, and daily routine.';
$hero_icon = get_field('hero_icon') ?: 'heart';

// Wizard
$form_action_url = get_field('form_action_url') ?: admin_url('admin-post.php');
$wizard_steps = get_field('wizard_steps');
if (empty($wizard_steps)) {
    $wizard_steps = [
        ['number' => 1, 'label' => 'Lifestyle'],
        ['number' => 2, 'label' => 'Experience'],
        ['number' => 3, 'label' => 'Preferences'],
        ['number' => 4, 'label' => 'Contact'],
    ];
}

// How It Works
$how_label = get_field('how_label') ?: 'The Process';
$how_title = get_field('how_title') ?: 'How Matching Works';
$how_steps = get_field('how_steps');
if (empty($how_steps)) {
    $how_steps = [
        [
            'icon' => 'file-text',
            'title' => 'Share Your Preferences',
            'description' => "Complete the form above to tell us about your lifestyle and what you're looking for.",
        ],
        [
            'icon' => 'search',
            'title' => 'We Find Matches',
            'description' => 'Our team reviews your preferences and searches for puppies that fit your criteria.',
        ],
        [
            'icon' => 'mail',
            'title' => 'Get Notified',
            'description' => "When a matching puppy arrives, we'll reach out with photos and details just for you.",
        ],
    ];
}

// Popular Breeds
$breeds_label = get_field('breeds_label') ?: 'Popular Breeds';
$breeds_title = get_field('breeds_title') ?: 'Breeds Families Love';
$popular_breeds = get_field('popular_breeds');
$breeds_link = get_field('breeds_link') ?: home_url('/dog-breed-info/');
if (empty($popular_breeds)) {
    $popular_breeds = [
        ['name' => 'Golden Retriever', 'traits' => [['trait' => 'Family-friendly'], ['trait' => 'Active'], ['trait' => 'Loyal']], 'image' => null],
        ['name' => 'French Bulldog', 'traits' => [['trait' => 'Apartment-friendly'], ['trait' => 'Low energy'], ['trait' => 'Affectionate']], 'image' => null],
        ['name' => 'Goldendoodle', 'traits' => [['trait' => 'Hypoallergenic'], ['trait' => 'Intelligent'], ['trait' => 'Playful']], 'image' => null],
        ['name' => 'Cavalier King Charles', 'traits' => [['trait' => 'Gentle'], ['trait' => 'Great with kids'], ['trait' => 'Adaptable']], 'image' => null],
    ];
}

// Concierge
$concierge_label = get_field('concierge_label') ?: 'Premium Service';
$concierge_title = get_field('concierge_title') ?: 'Puppy Concierge Service';
$concierge_description = get_field('concierge_description') ?: "Looking for something specific? Our Puppy Concierge team can source your dream puppy from our trusted breeder network. Tell us exactly what you're looking for, and we'll find it.";
$concierge_cta_text = get_field('concierge_cta_text') ?: 'Contact Concierge';
$concierge_cta_link = get_field('concierge_cta_link') ?: home_url('/contact/?subject=concierge');
$concierge_image = get_field('concierge_image');

// Helper function for How It Works icons
function furrylicious_get_how_icon($icon_name) {
    $icons = [
        'file-text' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
        </svg>',
        'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>',
        'mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
        </svg>',
    ];
    return $icons[$icon_name] ?? $icons['file-text'];
}

// Helper function for Hero icon
function furrylicious_get_hero_icon($icon_name) {
    $icons = [
        'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
        </svg>',
        'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>',
        'star' => '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
        </svg>',
    ];
    return $icons[$icon_name] ?? $icons['heart'];
}
?>

<?php
// Schema.org JSON-LD Structured Data
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'WebApplication',
    'name' => 'Furrylicious Puppy Matcher',
    'description' => 'Find your perfect puppy match based on your lifestyle and preferences',
    'url' => home_url('/preferences/'),
    'applicationCategory' => 'LifestyleApplication',
    'operatingSystem' => 'Any',
    'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'USD'
    ],
    'provider' => [
        '@type' => 'LocalBusiness',
        'name' => 'Furrylicious',
        'url' => home_url('/')
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="preferences-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="preferences-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Preference Center', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="preferences-page__hero" aria-label="<?php echo esc_attr($hero_title); ?>">
        <div class="container">
            <div class="preferences-page__hero-content">
                <div class="preferences-page__hero-icon">
                    <?php echo furrylicious_get_hero_icon($hero_icon); ?>
                </div>
                <span class="preferences-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="preferences-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="preferences-page__hero-description"><?php echo esc_html($hero_description); ?></p>
            </div>
        </div>
    </section>

    <!-- Preference Form -->
    <section class="preferences-page__form" aria-labelledby="form-heading">
        <div class="container">
            <div class="preferences-page__wizard" data-preference-wizard>
                <!-- Progress Indicator -->
                <div class="preferences-page__progress">
                    <div class="preferences-page__progress-bar">
                        <div class="preferences-page__progress-fill" style="width: 25%;"></div>
                    </div>
                    <div class="preferences-page__progress-steps">
                        <?php foreach ($wizard_steps as $index => $step) : ?>
                            <span class="preferences-page__progress-step<?php echo $index === 0 ? ' is-active' : ''; ?>" data-step="<?php echo esc_attr($step['number']); ?>"><?php echo esc_html($step['label']); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <form class="preferences-page__form-content" action="<?php echo esc_url($form_action_url); ?>" method="post">
                    <?php wp_nonce_field('furrylicious_preferences', 'preferences_nonce'); ?>
                    <input type="hidden" name="action" value="furrylicious_preferences">

                    <!-- Step 1: Lifestyle -->
                    <div class="preferences-page__step is-active" data-step="1">
                        <h2 id="form-heading" class="preferences-page__step-title">Tell Us About Your Lifestyle</h2>
                        <p class="preferences-page__step-description">This helps us understand what kind of puppy will thrive in your home.</p>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">What type of home do you live in?</label>
                            <div class="preferences-page__options preferences-page__options--grid">
                                <label class="preferences-page__option">
                                    <input type="radio" name="home_type" value="house_yard" required>
                                    <span class="preferences-page__option-card">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                            <polyline points="9 22 9 12 15 12 15 22"/>
                                        </svg>
                                        <span>House with Yard</span>
                                    </span>
                                </label>
                                <label class="preferences-page__option">
                                    <input type="radio" name="home_type" value="house_no_yard">
                                    <span class="preferences-page__option-card">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                        </svg>
                                        <span>House without Yard</span>
                                    </span>
                                </label>
                                <label class="preferences-page__option">
                                    <input type="radio" name="home_type" value="apartment">
                                    <span class="preferences-page__option-card">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"/>
                                            <line x1="9" y1="22" x2="9" y2="2"/>
                                            <line x1="14" y1="2" x2="14" y2="22"/>
                                            <line x1="4" y1="7" x2="20" y2="7"/>
                                            <line x1="4" y1="12" x2="20" y2="12"/>
                                            <line x1="4" y1="17" x2="20" y2="17"/>
                                        </svg>
                                        <span>Apartment/Condo</span>
                                    </span>
                                </label>
                                <label class="preferences-page__option">
                                    <input type="radio" name="home_type" value="townhouse">
                                    <span class="preferences-page__option-card">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="2" y="7" width="8" height="15"/>
                                            <rect x="14" y="7" width="8" height="15"/>
                                            <path d="M6 7V3l6-1 6 1v4"/>
                                        </svg>
                                        <span>Townhouse</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">How active is your lifestyle?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="activity_level" value="low" required>
                                    <span class="preferences-page__option-pill">Relaxed (walks, cuddles)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="activity_level" value="moderate">
                                    <span class="preferences-page__option-pill">Moderate (daily walks, play)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="activity_level" value="high">
                                    <span class="preferences-page__option-pill">Active (running, hiking, adventures)</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">How many hours will your puppy be home alone?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="alone_time" value="rarely" required>
                                    <span class="preferences-page__option-pill">Rarely (0-2 hours)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="alone_time" value="sometimes">
                                    <span class="preferences-page__option-pill">Sometimes (3-5 hours)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="alone_time" value="often">
                                    <span class="preferences-page__option-pill">Regularly (6-8 hours)</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__nav">
                            <button type="button" class="btn btn--primary btn--lg" data-next>
                                Continue
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Experience -->
                    <div class="preferences-page__step" data-step="2">
                        <h2 class="preferences-page__step-title">Your Pet Experience</h2>
                        <p class="preferences-page__step-description">Help us understand your background with pets.</p>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Is this your first puppy?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="first_puppy" value="yes" required>
                                    <span class="preferences-page__option-pill">Yes, first time!</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="first_puppy" value="no">
                                    <span class="preferences-page__option-pill">No, I've had dogs before</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Are there children in your home?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="children" value="none" required>
                                    <span class="preferences-page__option-pill">No children</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="children" value="young">
                                    <span class="preferences-page__option-pill">Young children (under 6)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="children" value="older">
                                    <span class="preferences-page__option-pill">Older children (6+)</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Do you have other pets?</label>
                            <div class="preferences-page__options preferences-page__options--checkboxes">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="other_pets[]" value="none">
                                    <span class="preferences-page__option-pill">No other pets</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="other_pets[]" value="dogs">
                                    <span class="preferences-page__option-pill">Dogs</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="other_pets[]" value="cats">
                                    <span class="preferences-page__option-pill">Cats</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="other_pets[]" value="other">
                                    <span class="preferences-page__option-pill">Other pets</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__nav">
                            <button type="button" class="btn btn--outline" data-prev>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="19" y1="12" x2="5" y2="12"/>
                                    <polyline points="12 19 5 12 12 5"/>
                                </svg>
                                Back
                            </button>
                            <button type="button" class="btn btn--primary btn--lg" data-next>
                                Continue
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Breed Preferences -->
                    <div class="preferences-page__step" data-step="3">
                        <h2 class="preferences-page__step-title">Breed Preferences</h2>
                        <p class="preferences-page__step-description">Tell us what you're looking for in your perfect companion.</p>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Preferred size?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="size[]" value="small">
                                    <span class="preferences-page__option-pill">Small (under 20 lbs)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="size[]" value="medium">
                                    <span class="preferences-page__option-pill">Medium (20-50 lbs)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="size[]" value="large">
                                    <span class="preferences-page__option-pill">Large (50+ lbs)</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="size[]" value="any">
                                    <span class="preferences-page__option-pill">No preference</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Coat type preference?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="coat[]" value="low_shedding">
                                    <span class="preferences-page__option-pill">Low/No shedding</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="coat[]" value="short">
                                    <span class="preferences-page__option-pill">Short coat</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="coat[]" value="long">
                                    <span class="preferences-page__option-pill">Long/fluffy coat</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="checkbox" name="coat[]" value="any">
                                    <span class="preferences-page__option-pill">No preference</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Any specific breeds you're interested in?</label>
                            <div class="preferences-page__options preferences-page__options--breeds">
                                <?php
                                $breeds = [
                                    'Golden Retriever', 'Goldendoodle', 'Labradoodle',
                                    'French Bulldog', 'Cavalier King Charles', 'Bernedoodle',
                                    'Maltipoo', 'Cockapoo', 'Mini Aussie',
                                    'Shih Tzu', 'Yorkshire Terrier', 'Other'
                                ];
                                foreach ($breeds as $breed) :
                                ?>
                                    <label class="preferences-page__option preferences-page__option--horizontal">
                                        <input type="checkbox" name="breeds[]" value="<?php echo esc_attr(sanitize_title($breed)); ?>">
                                        <span class="preferences-page__option-pill"><?php echo esc_html($breed); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label class="preferences-page__label">Gender preference?</label>
                            <div class="preferences-page__options">
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="gender" value="male">
                                    <span class="preferences-page__option-pill">Male</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="gender" value="female">
                                    <span class="preferences-page__option-pill">Female</span>
                                </label>
                                <label class="preferences-page__option preferences-page__option--horizontal">
                                    <input type="radio" name="gender" value="any" checked>
                                    <span class="preferences-page__option-pill">No preference</span>
                                </label>
                            </div>
                        </div>

                        <div class="preferences-page__nav">
                            <button type="button" class="btn btn--outline" data-prev>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="19" y1="12" x2="5" y2="12"/>
                                    <polyline points="12 19 5 12 12 5"/>
                                </svg>
                                Back
                            </button>
                            <button type="button" class="btn btn--primary btn--lg" data-next>
                                Almost Done!
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Contact Info -->
                    <div class="preferences-page__step" data-step="4">
                        <h2 class="preferences-page__step-title">Let's Stay in Touch</h2>
                        <p class="preferences-page__step-description">We'll notify you when puppies matching your preferences become available.</p>

                        <div class="preferences-page__field-group">
                            <div class="preferences-page__fields-row">
                                <div class="preferences-page__field">
                                    <label for="pref-first-name" class="preferences-page__label">First Name *</label>
                                    <input type="text" id="pref-first-name" name="first_name" required class="preferences-page__input">
                                </div>
                                <div class="preferences-page__field">
                                    <label for="pref-last-name" class="preferences-page__label">Last Name *</label>
                                    <input type="text" id="pref-last-name" name="last_name" required class="preferences-page__input">
                                </div>
                            </div>
                        </div>

                        <div class="preferences-page__field-group">
                            <label for="pref-email" class="preferences-page__label">Email Address *</label>
                            <input type="email" id="pref-email" name="email" required class="preferences-page__input">
                        </div>

                        <div class="preferences-page__field-group">
                            <label for="pref-phone" class="preferences-page__label">Phone Number</label>
                            <input type="tel" id="pref-phone" name="phone" class="preferences-page__input">
                        </div>

                        <div class="preferences-page__field-group">
                            <label for="pref-notes" class="preferences-page__label">Anything else we should know?</label>
                            <textarea id="pref-notes" name="notes" rows="3" class="preferences-page__textarea" placeholder="Special requests, questions, timeline, etc."></textarea>
                        </div>

                        <div class="preferences-page__consent">
                            <label class="preferences-page__checkbox">
                                <input type="checkbox" name="consent" required>
                                <span class="preferences-page__checkbox-mark"></span>
                                <span class="preferences-page__checkbox-text">
                                    I agree to receive communications about matching puppies and related updates.
                                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" target="_blank">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        <div class="preferences-page__nav">
                            <button type="button" class="btn btn--outline" data-prev>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="19" y1="12" x2="5" y2="12"/>
                                    <polyline points="12 19 5 12 12 5"/>
                                </svg>
                                Back
                            </button>
                            <button type="submit" class="btn btn--primary btn--lg">
                                Find My Match
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- How Matching Works -->
    <section class="preferences-page__how" aria-labelledby="how-heading">
        <div class="container">
            <header class="preferences-page__how-header">
                <span class="preferences-page__section-label"><?php echo esc_html($how_label); ?></span>
                <h2 id="how-heading" class="preferences-page__section-title"><?php echo esc_html($how_title); ?></h2>
            </header>

            <div class="preferences-page__how-steps">
                <?php foreach ($how_steps as $step) : ?>
                    <div class="preferences-page__how-step">
                        <div class="preferences-page__how-icon">
                            <?php echo furrylicious_get_how_icon($step['icon']); ?>
                        </div>
                        <h3><?php echo esc_html($step['title']); ?></h3>
                        <p><?php echo esc_html($step['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Popular Matches -->
    <section class="preferences-page__matches" aria-labelledby="matches-heading">
        <div class="container">
            <header class="preferences-page__matches-header">
                <span class="preferences-page__section-label"><?php echo esc_html($breeds_label); ?></span>
                <h2 id="matches-heading" class="preferences-page__section-title"><?php echo esc_html($breeds_title); ?></h2>
            </header>

            <div class="preferences-page__matches-grid">
                <?php foreach ($popular_breeds as $breed) : ?>
                    <div class="preferences-page__match-card">
                        <div class="preferences-page__match-image">
                            <?php if (!empty($breed['image']) && is_array($breed['image'])) : ?>
                                <img
                                    src="<?php echo esc_url($breed['image']['url']); ?>"
                                    alt="<?php echo esc_attr($breed['name']); ?>"
                                    loading="lazy"
                                    width="300"
                                    height="200"
                                >
                            <?php else : ?>
                                <img
                                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/breeds/' . sanitize_title($breed['name']) . '.jpg'); ?>"
                                    alt="<?php echo esc_attr($breed['name']); ?>"
                                    loading="lazy"
                                    width="300"
                                    height="200"
                                >
                            <?php endif; ?>
                        </div>
                        <div class="preferences-page__match-content">
                            <h3 class="preferences-page__match-name"><?php echo esc_html($breed['name']); ?></h3>
                            <div class="preferences-page__match-traits">
                                <?php
                                $traits = $breed['traits'] ?? [];
                                foreach ($traits as $trait_item) :
                                    $trait_text = is_array($trait_item) ? ($trait_item['trait'] ?? '') : $trait_item;
                                    if ($trait_text) :
                                ?>
                                    <span class="preferences-page__trait"><?php echo esc_html($trait_text); ?></span>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="preferences-page__matches-cta">
                <a href="<?php echo esc_url($breeds_link); ?>" class="btn btn--outline">Explore All Breeds</a>
            </div>
        </div>
    </section>

    <!-- Concierge Service CTA -->
    <section class="preferences-page__concierge" aria-labelledby="concierge-heading">
        <div class="container">
            <div class="preferences-page__concierge-card">
                <div class="preferences-page__concierge-content">
                    <span class="preferences-page__section-label"><?php echo esc_html($concierge_label); ?></span>
                    <h2 id="concierge-heading"><?php echo esc_html($concierge_title); ?></h2>
                    <p><?php echo esc_html($concierge_description); ?></p>
                    <a href="<?php echo esc_url($concierge_cta_link); ?>" class="btn btn--white btn--lg">
                        <?php echo esc_html($concierge_cta_text); ?>
                    </a>
                </div>
                <div class="preferences-page__concierge-image">
                    <?php if (!empty($concierge_image) && is_array($concierge_image)) : ?>
                        <img
                            src="<?php echo esc_url($concierge_image['url']); ?>"
                            alt="<?php echo esc_attr($concierge_image['alt'] ?? 'Puppy concierge service'); ?>"
                            loading="lazy"
                            width="400"
                            height="300"
                        >
                    <?php else : ?>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/concierge.jpg'); ?>"
                            alt="Puppy concierge service"
                            loading="lazy"
                            width="400"
                            height="300"
                        >
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const wizard = document.querySelector('[data-preference-wizard]');
    if (!wizard) return;

    const steps = wizard.querySelectorAll('.preferences-page__step');
    const progressSteps = wizard.querySelectorAll('.preferences-page__progress-step');
    const progressFill = wizard.querySelector('.preferences-page__progress-fill');
    let currentStep = 1;

    function showStep(stepNumber) {
        steps.forEach(step => {
            step.classList.remove('is-active');
            if (parseInt(step.dataset.step) === stepNumber) {
                step.classList.add('is-active');
            }
        });

        progressSteps.forEach(step => {
            step.classList.remove('is-active', 'is-complete');
            const stepNum = parseInt(step.dataset.step);
            if (stepNum === stepNumber) {
                step.classList.add('is-active');
            } else if (stepNum < stepNumber) {
                step.classList.add('is-complete');
            }
        });

        progressFill.style.width = (stepNumber / steps.length * 100) + '%';
        currentStep = stepNumber;

        // Scroll to top of form
        wizard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    wizard.querySelectorAll('[data-next]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < steps.length) {
                showStep(currentStep + 1);
            }
        });
    });

    wizard.querySelectorAll('[data-prev]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    });
});
</script>

<?php get_footer(); ?>
