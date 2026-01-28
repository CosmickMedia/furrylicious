<?php
/**
 * Template Name: Contact Us
 *
 * Contact page with form integration and store information.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// Check for pre-populated puppy data
$puppy_id = isset($_GET['puppy']) ? intval($_GET['puppy']) : 0;
$is_visit = isset($_GET['visit']) && $_GET['visit'] == '1';
$puppy_name = '';
$puppy_breed = '';

if ($puppy_id) {
    $product = wc_get_product($puppy_id);
    if ($product) {
        $puppy_name = $product->get_meta('pet_name') ?: '';
        $puppy_breed = strip_tags(wc_get_product_category_list($puppy_id, ', ', '', ''));
    }
}

// ============================================================================
// ACF Fields with Fallbacks
// ============================================================================

// Hero Section
$hero_label = furrylicious_get_page_field('hero_label', 'Get In Touch');
$hero_title = furrylicious_get_page_field('hero_title', "We'd Love to Hear From You");
$hero_description = furrylicious_get_page_field('hero_description', "Have questions about our puppies, services, or want to schedule a visit? We're here to help!");

// Contact Form
$form_title = furrylicious_get_page_field('form_title', 'Send Us a Message');
$gravity_form_id = furrylicious_get_page_field('gravity_form_id', 1);
$fallback_message = furrylicious_get_page_field('fallback_message', 'Please contact us using the information below:');

// Contact Info (use site defaults if empty)
$default_phone = '(908) 823-4468';
$default_email = 'info@furryliciousnj.com';
$default_address = "531 US Highway 22 E\nWhitehouse Station, NJ 08889";

$contact_phone = furrylicious_get_page_field('contact_phone', $default_phone);
$contact_email = furrylicious_get_page_field('contact_email', $default_email);
$contact_address = furrylicious_get_page_field('contact_address', $default_address);

// Normalize phone for tel: link
$phone_link = preg_replace('/[^0-9+]/', '', $contact_phone);
if (strpos($phone_link, '+') !== 0) {
    $phone_link = '+1' . $phone_link;
}

// Map Settings
$show_map = furrylicious_get_page_field('show_map', true);
$map_embed_url = furrylicious_get_page_field('map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.8977!2d-74.7699!3d40.6151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDM2JzU0LjQiTiA3NMKwNDYnMTEuNiJX!5e0!3m2!1sen!2sus!4v1234567890');
$directions_url = furrylicious_get_page_field('directions_url', 'https://maps.google.com/?q=531+US+Highway+22+E+Whitehouse+Station+NJ+08889');

// FAQ Section
$faq_title = furrylicious_get_page_field('faq_title', 'Frequently Asked Questions');
$faq_description = furrylicious_get_page_field('faq_description', 'Quick answers to common questions');
$faq_link = furrylicious_get_page_field('faq_link', home_url('/faqs/'));

// Social Section
$show_social = furrylicious_get_page_field('show_social', true);
$social_title = furrylicious_get_page_field('social_title', 'Connect With Us');

// SEO Fields (handled by Yoast filters in acf-config.php)
// focus_keyphrase, seo_meta_description, og_image
?>

<?php
// Schema.org JSON-LD Structured Data
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Furrylicious',
    'description' => 'Premium puppy boutique in Whitehouse Station, NJ',
    'url' => home_url('/'),
    'telephone' => $contact_phone,
    'email' => $contact_email,
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
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => $phone_link,
        'contactType' => 'customer service',
        'areaServed' => 'US',
        'availableLanguage' => 'English'
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="contact-page" itemscope itemtype="https://schema.org/ContactPage">

    <!-- Breadcrumb -->
    <nav class="contact-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Contact Us', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="contact-page__hero" aria-label="Contact Us">
        <div class="container">
            <header class="contact-page__hero-content">
                <span class="contact-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="contact-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="contact-page__hero-description"><?php echo esc_html($hero_description); ?></p>

                <?php if ($puppy_name || $puppy_breed) : ?>
                    <div class="contact-page__inquiry-badge">
                        <?php if ($is_visit) : ?>
                            <?php printf(__('Scheduling a visit to meet %s', 'furrylicious'), '<strong>' . esc_html($puppy_name ?: $puppy_breed) . '</strong>'); ?>
                        <?php else : ?>
                            <?php printf(__('Inquiring about %s', 'furrylicious'), '<strong>' . esc_html($puppy_name ?: $puppy_breed) . '</strong>'); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="contact-page__quick-links">
                    <a href="tel:<?php echo esc_attr($phone_link); ?>" class="contact-page__quick-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        <?php echo esc_html($contact_phone); ?>
                    </a>
                    <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="contact-page__quick-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <?php echo esc_html($contact_email); ?>
                    </a>
                </div>
            </header>
        </div>
    </section>

    <!-- Contact Grid -->
    <section class="contact-page__main" aria-labelledby="contact-form-heading">
        <div class="container">
            <div class="contact-page__grid">
                <!-- Contact Form -->
                <div class="contact-page__form-column">
                    <?php if ($puppy_id && $puppy_breed) : ?>
                        <div class="contact-page__puppy-card">
                            <?php
                            $product = wc_get_product($puppy_id);
                            if ($product) :
                                $img_id = $product->get_image_id();
                            ?>
                                <?php if ($img_id) : ?>
                                    <div class="contact-page__puppy-image">
                                        <?php echo wp_get_attachment_image($img_id, 'thumbnail'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="contact-page__puppy-info">
                                    <?php if ($puppy_name) : ?>
                                        <p class="contact-page__puppy-name"><?php echo esc_html($puppy_name); ?></p>
                                    <?php endif; ?>
                                    <p class="contact-page__puppy-breed"><?php echo esc_html($puppy_breed); ?></p>
                                    <a href="<?php echo esc_url(get_permalink($puppy_id)); ?>" class="contact-page__puppy-link">View Details</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="contact-page__form-wrapper">
                        <h2 id="contact-form-heading" class="contact-page__form-title">
                            <?php if ($is_visit) : ?>
                                <?php esc_html_e('Schedule Your Visit', 'furrylicious'); ?>
                            <?php else : ?>
                                <?php echo esc_html($form_title); ?>
                            <?php endif; ?>
                        </h2>

                        <?php
                        if (function_exists('gravity_form')) {
                            $field_values = [];

                            if ($puppy_name) {
                                $field_values['puppy_name'] = $puppy_name;
                            }
                            if ($puppy_breed) {
                                $field_values['puppy_breed'] = $puppy_breed;
                            }
                            if ($puppy_id) {
                                $field_values['puppy_id'] = $puppy_id;
                            }

                            gravity_form($gravity_form_id, false, false, false, $field_values, true);
                        } else {
                        ?>
                            <div class="contact-page__form-fallback">
                                <p><?php echo esc_html($fallback_message); ?></p>
                                <p><strong>Phone:</strong> <a href="tel:<?php echo esc_attr($phone_link); ?>"><?php echo esc_html($contact_phone); ?></a></p>
                                <p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Contact Info Sidebar -->
                <aside class="contact-page__info-column">
                    <div class="contact-page__info-card">
                        <h3 class="contact-page__info-title">Contact Information</h3>

                        <div class="contact-page__info-item">
                            <div class="contact-page__info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                                </svg>
                            </div>
                            <div class="contact-page__info-content">
                                <span class="contact-page__info-label">Phone</span>
                                <a href="tel:<?php echo esc_attr($phone_link); ?>" class="contact-page__info-value"><?php echo esc_html($contact_phone); ?></a>
                            </div>
                        </div>

                        <div class="contact-page__info-item">
                            <div class="contact-page__info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </div>
                            <div class="contact-page__info-content">
                                <span class="contact-page__info-label">Email</span>
                                <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="contact-page__info-value"><?php echo esc_html($contact_email); ?></a>
                            </div>
                        </div>

                        <div class="contact-page__info-item">
                            <div class="contact-page__info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div class="contact-page__info-content">
                                <span class="contact-page__info-label">Address</span>
                                <address class="contact-page__info-value">
                                    <?php echo nl2br(esc_html($contact_address)); ?>
                                </address>
                            </div>
                        </div>
                    </div>

                    <div class="contact-page__hours-card">
                        <h3 class="contact-page__hours-title">Business Hours</h3>
                        <ul class="contact-page__hours-list">
                            <?php if (furrylicious_has_items('business_hours')) : ?>
                                <?php while (have_rows('business_hours')) : the_row(); ?>
                                    <li><span><?php echo esc_html(get_sub_field('day')); ?></span><span><?php echo esc_html(get_sub_field('hours')); ?></span></li>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <!-- Fallback static hours -->
                                <li><span>Monday</span><span>11 AM - 7 PM</span></li>
                                <li><span>Tuesday</span><span>11 AM - 7 PM</span></li>
                                <li><span>Wednesday</span><span>11 AM - 7 PM</span></li>
                                <li><span>Thursday</span><span>11 AM - 7 PM</span></li>
                                <li><span>Friday</span><span>11 AM - 7 PM</span></li>
                                <li><span>Saturday</span><span>11 AM - 7 PM</span></li>
                                <li><span>Sunday</span><span>11 AM - 7 PM</span></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="contact-page__map-card">
                        <a href="<?php echo esc_url($directions_url); ?>" target="_blank" rel="noopener noreferrer" class="contact-page__map-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            Get Directions
                        </a>
                    </div>

                    <?php if ($show_social) : ?>
                        <div class="contact-page__social">
                            <h4 class="contact-page__social-title"><?php echo esc_html($social_title); ?></h4>
                            <div class="contact-page__social-links">
                                <a href="https://www.instagram.com/furryliciousnj/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                    </svg>
                                </a>
                                <a href="https://www.facebook.com/furryliciousnj/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                                    </svg>
                                </a>
                                <a href="https://www.youtube.com/@furryliciousnj" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/>
                                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                                    </svg>
                                </a>
                                <a href="https://www.tiktok.com/@furryliciousnj" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M9 12a4 4 0 104 4V4a5 5 0 005 5"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <?php if ($show_map && $map_embed_url) : ?>
        <section class="contact-page__map" aria-label="Location Map">
            <div class="contact-page__map-wrapper">
                <iframe
                    src="<?php echo esc_url($map_embed_url); ?>"
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Furrylicious Location Map"
                ></iframe>
            </div>
        </section>
    <?php endif; ?>

    <!-- FAQ Preview -->
    <section class="contact-page__faq" aria-labelledby="faq-preview-heading">
        <div class="container">
            <header class="contact-page__faq-header">
                <h2 id="faq-preview-heading" class="contact-page__faq-title"><?php echo esc_html($faq_title); ?></h2>
                <p><?php echo esc_html($faq_description); ?></p>
            </header>

            <div class="contact-page__faq-grid">
                <?php if (furrylicious_has_items('faq_items')) : ?>
                    <?php while (have_rows('faq_items')) : the_row(); ?>
                        <div class="contact-page__faq-item">
                            <h3><?php echo esc_html(get_sub_field('question')); ?></h3>
                            <p><?php echo esc_html(get_sub_field('answer')); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <!-- Fallback static FAQs -->
                    <div class="contact-page__faq-item">
                        <h3>What are your hours?</h3>
                        <p>We're open daily from 11 AM to 7 PM, including weekends and most holidays.</p>
                    </div>
                    <div class="contact-page__faq-item">
                        <h3>Do I need an appointment?</h3>
                        <p>Walk-ins are welcome, but we recommend scheduling an appointment for the best experience.</p>
                    </div>
                    <div class="contact-page__faq-item">
                        <h3>What payment methods do you accept?</h3>
                        <p>We accept cash, all major credit cards, and offer financing options through our partners.</p>
                    </div>
                    <div class="contact-page__faq-item">
                        <h3>How quickly will you respond?</h3>
                        <p>We aim to respond to all inquiries within 24 hours during business days.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="contact-page__faq-cta">
                <a href="<?php echo esc_url($faq_link); ?>" class="btn btn--outline">View All FAQs</a>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
