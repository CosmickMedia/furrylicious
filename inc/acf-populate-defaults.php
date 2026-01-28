<?php
/**
 * ACF Default Data Population
 *
 * Automatically populate ACF fields with default content from templates.
 * Run from Appearance > Initialize ACF Fields in admin.
 *
 * @package Furrylicious
 * @since 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get page ID by template file name
 *
 * @param string $template_file Template file name (e.g., 'page-booking.php')
 * @return int|null Page ID or null if not found
 */
function furrylicious_get_page_by_template($template_file) {
    $pages = get_posts([
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => $template_file,
        'posts_per_page' => 1,
        'fields' => 'ids',
        'post_status' => 'any',
    ]);
    return !empty($pages) ? $pages[0] : null;
}

/**
 * Get or create placeholder image attachment ID
 *
 * @return int Attachment ID for placeholder image
 */
function furrylicious_get_placeholder_image_id() {
    $placeholder_id = get_option('furrylicious_placeholder_image_id');

    // Verify the attachment still exists
    if ($placeholder_id && get_post($placeholder_id)) {
        return $placeholder_id;
    }

    // Check if placeholder exists in theme
    $placeholder_path = get_template_directory() . '/assets/images/placeholder.jpg';
    if (!file_exists($placeholder_path)) {
        return 0;
    }

    // Upload placeholder to media library
    $upload_dir = wp_upload_dir();
    $filename = 'furrylicious-placeholder.jpg';
    $filepath = $upload_dir['path'] . '/' . $filename;

    // Copy file to uploads
    if (!copy($placeholder_path, $filepath)) {
        return 0;
    }

    // Create attachment
    $attachment = [
        'post_mime_type' => 'image/jpeg',
        'post_title' => 'Furrylicious Placeholder Image',
        'post_content' => '',
        'post_status' => 'inherit',
    ];

    $placeholder_id = wp_insert_attachment($attachment, $filepath);

    if (!is_wp_error($placeholder_id)) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($placeholder_id, $filepath);
        wp_update_attachment_metadata($placeholder_id, $attach_data);
        update_option('furrylicious_placeholder_image_id', $placeholder_id);
    }

    return $placeholder_id;
}

/**
 * Get all default field values for all templates
 *
 * @return array Template => field defaults mapping
 */
function furrylicious_get_all_defaults() {
    $placeholder_id = furrylicious_get_placeholder_image_id();

    return [
        // =====================================================================
        // BOOKING PAGE
        // =====================================================================
        'page-booking.php' => [
            // Hero Section
            'hero_label' => 'Visit Us',
            'hero_title' => 'Meet Your Future Best Friend',
            'hero_description' => 'Schedule a private appointment to visit our boutique and spend quality time with our puppies. No pressure, no obligation—just pure puppy love.',
            'hero_image' => $placeholder_id,
            'hero_cta_text' => 'Schedule Your Visit',
            'hero_cta_link' => '#booking-form',

            // Form Section
            'form_title' => 'Request an Appointment',
            'form_subtitle' => "Fill out the form below and we'll confirm your visit within 24 hours.",
            'gravity_form_id' => 2,
            'fallback_phone' => '(908) 823-4468',

            // Trust Badges (repeater)
            'trust_badges' => [
                ['icon' => 'shield', 'text' => 'Private Appointments'],
                ['icon' => 'check-circle', 'text' => 'No Obligation'],
                ['icon' => 'clock', 'text' => 'Flexible Scheduling'],
            ],

            // Expectations Section
            'expectations_label' => 'Your Visit',
            'expectations_title' => 'What to Expect',
            'expectations_intro' => 'Your appointment is a relaxed, personal experience designed to help you find your perfect companion.',
            'expectations_steps' => [
                ['icon' => 'home', 'title' => 'Arrival & Welcome', 'description' => "You'll be greeted by our friendly staff and given a tour of our clean, comfortable facility."],
                ['icon' => 'heart', 'title' => 'Puppy Introduction', 'description' => 'Meet and interact with puppies that match your preferences in a private, comfortable setting.'],
                ['icon' => 'help-circle', 'title' => 'Ask Questions', 'description' => 'Our experts answer all your questions about breed, care, health, and what to expect as a puppy parent.'],
                ['icon' => 'check-square', 'title' => 'Next Steps', 'description' => "If you find a match, we'll guide you through reservations, financing options, and take-home planning."],
            ],

            // Tips Section
            'tips_label' => 'Before You Visit',
            'tips_title' => 'Preparation Tips',
            'tips_intro' => 'A few simple tips to make the most of your appointment.',
            'tips_faq' => [
                ['question' => 'What should I wear?', 'answer' => "Wear comfortable, casual clothes that you don't mind getting a little puppy fur on. Avoid loose jewelry or dangling accessories that puppies might grab. Closed-toe shoes are recommended."],
                ['question' => 'What should I bring?', 'answer' => "Bring a valid ID, your questions written down, and photos of your living space if you'd like breed recommendations. If you're ready to reserve, a deposit method is helpful but not required for your first visit."],
                ['question' => 'How long do appointments last?', 'answer' => "Plan for about 45 minutes to an hour. This gives you plenty of time to meet puppies, ask questions, and explore without feeling rushed. We're happy to extend if needed."],
                ['question' => 'Can I bring my children?', 'answer' => 'Absolutely! We encourage families to bring children so everyone can meet potential puppies. Our staff is experienced with helping kids interact safely and positively with the puppies.'],
                ['question' => 'Can I bring my current pet?', 'answer' => "For the safety of our puppies, we ask that you leave other pets at home during your initial visit. Once you've reserved a puppy, we can arrange a meet-and-greet with your current pet before pickup."],
            ],

            // Location Section
            'location_address' => "531 US Highway 22 E\nWhitehouse Station, NJ 08889",
            'location_hours' => 'Open Daily: 11 AM – 7 PM',
            'location_phone' => '(908) 823-4468',
            'directions_url' => 'https://maps.google.com/?q=531+US+Highway+22+E+Whitehouse+Station+NJ+08889',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.8977!2d-74.7699!3d40.6151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDM2JzU0LjQiTiA3NMKwNDYnMTEuNiJX!5e0!3m2!1sen!2sus!4v1234567890',
        ],

        // =====================================================================
        // BLOG PAGE
        // =====================================================================
        'page-blog.php' => [
            // Hero Section
            'hero_label' => 'From Our Team',
            'hero_title' => 'Stories, Tips & Puppy Love',
            'hero_description' => 'Helpful advice, heartwarming stories, and everything you need to know about puppy parenthood.',
            'show_search' => true,

            // Category Filters (repeater)
            'category_filters' => [
                ['slug' => '', 'label' => 'All Posts'],
                ['slug' => 'puppy-care', 'label' => 'Puppy Care'],
                ['slug' => 'training', 'label' => 'Training'],
                ['slug' => 'health', 'label' => 'Health'],
                ['slug' => 'breed-guides', 'label' => 'Breed Guides'],
                ['slug' => 'news', 'label' => 'News'],
            ],

            // Newsletter Section
            'newsletter_title' => 'Get Puppy Tips in Your Inbox',
            'newsletter_description' => 'Subscribe to receive new articles, care tips, and exclusive content delivered weekly.',
            'newsletter_form_action' => home_url('/newsletter-signup/'),
            'newsletter_privacy_text' => 'We respect your privacy. Unsubscribe anytime.',

            // Topics Section
            'topics_title' => 'Popular Topics',
            'topics_count' => 15,
        ],

        // =====================================================================
        // BOUTIQUE PAGE
        // =====================================================================
        'page-boutique.php' => [
            // Hero Section
            'hero_label' => 'Shop',
            'hero_title' => 'Luxury & Love, Curated for Your Companion',
            'hero_description' => "Discover premium pet products from the brands we trust for our own furry friends. From designer accessories to healthy nutrition, we've curated the best for your best friend.",
            'hero_background' => $placeholder_id,
            'hero_cta_primary_text' => 'Shop Online',
            'hero_cta_primary_link' => home_url('/shop/'),
            'hero_cta_secondary_text' => 'Visit In-Store',
            'hero_cta_secondary_link' => home_url('/booking/'),

            // Brands Section
            'brands_label' => 'Featured Brands',
            'brands_title' => 'Brands We Love',
            'brands' => [
                ['name' => 'Hello Doggie', 'logo' => $placeholder_id],
                ['name' => 'Puppia', 'logo' => $placeholder_id],
                ['name' => 'Merrick', 'logo' => $placeholder_id],
                ['name' => "Stella & Chewy's", 'logo' => $placeholder_id],
                ['name' => 'Kong', 'logo' => $placeholder_id],
                ['name' => 'Earthbath', 'logo' => $placeholder_id],
            ],

            // Categories Section
            'categories_label' => 'Shop by Category',
            'categories_title' => 'Explore Our Collection',
            'categories' => [
                ['name' => 'Apparel', 'description' => 'Stylish sweaters, coats, and outfits', 'image' => $placeholder_id, 'link' => home_url('/shop/apparel/')],
                ['name' => 'Carriers', 'description' => 'Designer bags and travel carriers', 'image' => $placeholder_id, 'link' => home_url('/shop/carriers/')],
                ['name' => 'Beds', 'description' => 'Plush beds and cozy blankets', 'image' => $placeholder_id, 'link' => home_url('/shop/beds/')],
                ['name' => 'Food & Treats', 'description' => 'Premium nutrition and healthy snacks', 'image' => $placeholder_id, 'link' => home_url('/shop/food/')],
                ['name' => 'Toys', 'description' => 'Interactive and plush playtime fun', 'image' => $placeholder_id, 'link' => home_url('/shop/toys/')],
                ['name' => 'Grooming', 'description' => 'Shampoos, brushes, and spa essentials', 'image' => $placeholder_id, 'link' => home_url('/shop/grooming/')],
            ],

            // Products Section
            'products_label' => 'Bestsellers',
            'products_title' => 'Customer Favorites',
            'show_woo_featured' => true,
            'manual_products' => [
                ['name' => 'Hello Doggie Luxe Blanket', 'price' => '$89.00', 'image' => $placeholder_id, 'link' => '#'],
                ['name' => 'Puppia Soft Harness', 'price' => '$34.00', 'image' => $placeholder_id, 'link' => '#'],
                ['name' => "Stella & Chewy's Dinner", 'price' => '$32.00', 'image' => $placeholder_id, 'link' => '#'],
                ['name' => 'Designer Pet Carrier', 'price' => '$149.00', 'image' => $placeholder_id, 'link' => '#'],
            ],

            // Services Section
            'services_label' => 'Boutique Services',
            'services_title' => 'The Furrylicious Experience',
            'services' => [
                ['icon' => 'user', 'title' => 'Personal Shopping', 'description' => "Let our experts help you find the perfect products for your pet's needs and personality."],
                ['icon' => 'gift', 'title' => 'Gift Wrapping', 'description' => 'Complimentary gift wrapping for that perfect present for the pet lover in your life.'],
                ['icon' => 'search', 'title' => 'Special Orders', 'description' => "Can't find what you need? We'll source it for you from our trusted brand partners."],
                ['icon' => 'truck', 'title' => 'Local Delivery', 'description' => 'Free local delivery on orders over $50 within the Whitehouse Station area.'],
            ],

            // In-Store Experience Section
            'instore_label' => 'Visit Us',
            'instore_title' => 'The In-Store Experience',
            'instore_description' => "Shopping at Furrylicious is more than a transaction—it's an experience. Browse our carefully curated selection in a warm, welcoming environment designed for you and your furry friend.",
            'instore_images' => [$placeholder_id, $placeholder_id],
            'instore_testimonial_quote' => "I love coming to Furrylicious! The staff always remembers my dog's name and helps me find exactly what I need. The product selection is amazing.",
            'instore_testimonial_author' => 'Sarah M., Regular Customer',

            // Gift Cards Section
            'giftcards_title' => 'Give the Gift of Furrylicious',
            'giftcards_description' => 'Know a pet parent who deserves something special? Our gift cards make the perfect present for birthdays, holidays, or just because.',
            'giftcards_cta_text' => 'Shop Gift Cards',
            'giftcards_cta_link' => home_url('/shop/gift-cards/'),
            'giftcards_image' => $placeholder_id,
        ],

        // =====================================================================
        // BREEDERS PAGE
        // =====================================================================
        'page-breeders.php' => [
            // Hero Section
            'hero_label' => 'Our Partners',
            'hero_title' => 'Meet Our Breeder Partners',
            'hero_description' => 'We partner exclusively with USDA-licensed breeders who share our commitment to healthy, well-socialized puppies raised with love and care.',
            'hero_image' => $placeholder_id,
            'hero_badges' => [
                ['icon' => 'shield-check', 'text' => 'USDA Licensed'],
                ['icon' => 'check-circle', 'text' => 'Regularly Inspected'],
                ['icon' => 'heart', 'text' => 'Ethically Raised'],
            ],

            // Vetting Section
            'vetting_label' => 'Our Process',
            'vetting_title' => 'Rigorous Breeder Vetting',
            'vetting_description' => 'Not just anyone can become a Furrylicious breeder partner. We put every potential partner through a comprehensive vetting process.',
            'vetting_steps' => [
                ['number' => 1, 'title' => 'Application Review', 'description' => 'Breeders submit detailed applications including licensing, breeding history, and facility information for our initial review.'],
                ['number' => 2, 'title' => 'On-Site Inspection', 'description' => 'Our team personally visits every breeder facility to inspect living conditions, cleanliness, and animal welfare practices.'],
                ['number' => 3, 'title' => 'Documentation Verification', 'description' => 'We verify all USDA licenses, health testing records, veterinary relationships, and breeding certifications.'],
                ['number' => 4, 'title' => 'Ongoing Monitoring', 'description' => 'Approved partners undergo regular unannounced inspections and must maintain our standards to remain in the program.'],
                ['number' => 5, 'title' => 'Partnership Agreement', 'description' => 'Breeders sign comprehensive agreements committing to our welfare standards, health guarantees, and ethical practices.'],
            ],

            // Standards Section
            'standards_label' => 'What We Require',
            'standards_title' => 'Our Breeder Standards',
            'standards_image' => $placeholder_id,
            'standards_categories' => [
                [
                    'title' => 'Living Conditions',
                    'items' => [
                        ['item' => 'Clean, climate-controlled indoor environments'],
                        ['item' => 'Spacious exercise and play areas'],
                        ['item' => 'Regular socialization with humans and other dogs'],
                        ['item' => 'Comfortable bedding and rest areas'],
                    ],
                ],
                [
                    'title' => 'Health Testing',
                    'items' => [
                        ['item' => 'OFA or PennHIP hip and elbow evaluations'],
                        ['item' => 'Genetic testing for breed-specific conditions'],
                        ['item' => 'Annual veterinary health exams'],
                        ['item' => 'Complete vaccination and deworming protocols'],
                    ],
                ],
                [
                    'title' => 'Socialization',
                    'items' => [
                        ['item' => 'Early neurological stimulation (ENS)'],
                        ['item' => 'Exposure to household sounds and environments'],
                        ['item' => 'Positive human interaction from birth'],
                        ['item' => 'Temperament assessment and matching'],
                    ],
                ],
            ],

            // Breeder Profiles Section
            'profiles_label' => 'Meet Our Partners',
            'profiles_title' => 'Featured Breeders',
            'breeders' => [
                ['name' => 'Golden Meadows Farm', 'region' => 'Pennsylvania', 'specialties' => [['breed' => 'Golden Retrievers'], ['breed' => 'Goldendoodles']], 'years' => '8+ years', 'image' => $placeholder_id],
                ['name' => 'Sunrise Puppies', 'region' => 'Ohio', 'specialties' => [['breed' => 'French Bulldogs'], ['breed' => 'English Bulldogs']], 'years' => '12+ years', 'image' => $placeholder_id],
                ['name' => 'Heritage Kennels', 'region' => 'Virginia', 'specialties' => [['breed' => 'Cavaliers'], ['breed' => 'Cockapoos']], 'years' => '15+ years', 'image' => $placeholder_id],
                ['name' => 'Valley View Breeders', 'region' => 'Indiana', 'specialties' => [['breed' => 'Bernedoodles'], ['breed' => 'Labradoodles']], 'years' => '6+ years', 'image' => $placeholder_id],
                ['name' => 'Countryside Companions', 'region' => 'Missouri', 'specialties' => [['breed' => 'Shih Tzus'], ['breed' => 'Maltipoos']], 'years' => '10+ years', 'image' => $placeholder_id],
                ['name' => 'Heartland Pups', 'region' => 'Wisconsin', 'specialties' => [['breed' => 'Labs'], ['breed' => 'Mini Aussies']], 'years' => '9+ years', 'image' => $placeholder_id],
            ],

            // Certifications Section
            'certifications_title' => 'Certifications & Affiliations',
            'certifications_description' => 'Our breeders maintain memberships and certifications with respected industry organizations.',
            'certifications' => [
                ['name' => 'USDA Licensed', 'logo' => $placeholder_id],
                ['name' => 'AKC Registered', 'logo' => $placeholder_id],
                ['name' => 'State Licensed', 'logo' => $placeholder_id],
                ['name' => 'OFA Health Testing', 'logo' => $placeholder_id],
            ],

            // Partner CTA Section
            'partner_cta_title' => 'Are You a Responsible Breeder?',
            'partner_cta_description' => "We're always looking to expand our network of ethical, quality breeders. If you share our commitment to puppy welfare and meet our rigorous standards, we'd love to hear from you.",
            'partner_requirements' => [
                ['requirement' => 'USDA Licensed'],
                ['requirement' => 'Health Testing Program'],
                ['requirement' => 'Clean Inspection History'],
                ['requirement' => 'Commitment to Socialization'],
            ],
            'partner_btn_text' => 'Apply to Be a Partner',
            'partner_btn_link' => home_url('/contact-us/?subject=breeder-inquiry'),
        ],

        // =====================================================================
        // CONTACT US PAGE
        // =====================================================================
        'page-contact-us.php' => [
            // Hero Section
            'hero_label' => 'Get In Touch',
            'hero_title' => "We'd Love to Hear From You",
            'hero_description' => "Have questions about our puppies, services, or want to schedule a visit? We're here to help!",

            // Contact Form
            'form_title' => 'Send Us a Message',
            'gravity_form_id' => 1,
            'fallback_message' => 'Please contact us using the information below:',

            // Contact Info
            'contact_phone' => '(908) 823-4468',
            'contact_email' => 'info@furryliciousnj.com',
            'contact_address' => "531 US Highway 22 E\nWhitehouse Station, NJ 08889",

            // Map Settings
            'show_map' => true,
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.8977!2d-74.7699!3d40.6151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDM2JzU0LjQiTiA3NMKwNDYnMTEuNiJX!5e0!3m2!1sen!2sus!4v1234567890',
            'directions_url' => 'https://maps.google.com/?q=531+US+Highway+22+E+Whitehouse+Station+NJ+08889',

            // Business Hours (repeater)
            'business_hours' => [
                ['day' => 'Monday', 'hours' => '11 AM - 7 PM'],
                ['day' => 'Tuesday', 'hours' => '11 AM - 7 PM'],
                ['day' => 'Wednesday', 'hours' => '11 AM - 7 PM'],
                ['day' => 'Thursday', 'hours' => '11 AM - 7 PM'],
                ['day' => 'Friday', 'hours' => '11 AM - 7 PM'],
                ['day' => 'Saturday', 'hours' => '11 AM - 7 PM'],
                ['day' => 'Sunday', 'hours' => '11 AM - 7 PM'],
            ],

            // FAQ Section
            'faq_title' => 'Frequently Asked Questions',
            'faq_description' => 'Quick answers to common questions',
            'faq_link' => home_url('/faqs/'),
            'faq_items' => [
                ['question' => 'What are your hours?', 'answer' => "We're open daily from 11 AM to 7 PM, including weekends and most holidays."],
                ['question' => 'Do I need an appointment?', 'answer' => 'Walk-ins are welcome, but we recommend scheduling an appointment for the best experience.'],
                ['question' => 'What payment methods do you accept?', 'answer' => 'We accept cash, all major credit cards, and offer financing options through our partners.'],
                ['question' => 'How quickly will you respond?', 'answer' => 'We aim to respond to all inquiries within 24 hours during business days.'],
            ],

            // Social Section
            'show_social' => true,
            'social_title' => 'Connect With Us',
        ],

        // =====================================================================
        // FINANCING PAGE
        // =====================================================================
        'page-financing.php' => [
            // Hero Section
            'hero_label' => 'Flexible Payment Options',
            'hero_title' => 'Bring Home Love Today',
            'hero_description' => "Don't let budget concerns delay your joy. Our financing partners make it easy to welcome your new family member with affordable monthly payments.",
            'hero_cta_primary_text' => 'Check Your Rate',
            'hero_cta_primary_link' => '#financing-partners',
            'hero_cta_secondary_text' => 'Learn More',
            'hero_cta_secondary_link' => '#how-it-works',
            'hero_trust_items' => [
                ['icon' => 'check-circle', 'text' => 'Soft Credit Check'],
                ['icon' => 'clock', 'text' => 'Quick Approval'],
                ['icon' => 'shield', 'text' => 'Secure Process'],
            ],

            // Partners Section
            'partners_label' => 'Our Partners',
            'partners_title' => 'Trusted Financing Options',
            'partners_description' => "We've partnered with leading financial institutions to offer you the best rates and terms.",
            'partners_disclaimer' => '*Subject to credit approval. Minimum monthly payments required. See partner sites for complete terms and conditions.',
            'partners' => [
                [
                    'name' => 'Synchrony Financial',
                    'logo' => $placeholder_id,
                    'description' => 'Promotional financing with deferred interest options. Perfect for larger purchases.',
                    'apply_url' => '#',
                    'features' => [
                        ['feature' => '0% APR for 6-12 months*'],
                        ['feature' => 'Flexible payment terms'],
                        ['feature' => 'Easy online management'],
                    ],
                ],
                [
                    'name' => 'Affirm',
                    'logo' => $placeholder_id,
                    'description' => "Pay over time with clear, simple terms. Know exactly what you'll pay.",
                    'apply_url' => '#',
                    'features' => [
                        ['feature' => '3, 6, or 12 month terms'],
                        ['feature' => 'No hidden fees'],
                        ['feature' => 'Real-time decision'],
                    ],
                ],
                [
                    'name' => 'Scratchpay',
                    'logo' => $placeholder_id,
                    'description' => 'Simple payment plans designed specifically for pet purchases and care.',
                    'apply_url' => '#',
                    'features' => [
                        ['feature' => 'Plans starting at 0% APR'],
                        ['feature' => 'Soft credit check'],
                        ['feature' => 'Fast approval process'],
                    ],
                ],
            ],

            // Process Section
            'process_label' => 'Simple Process',
            'process_title' => 'How It Works',
            'process_steps' => [
                ['number' => 1, 'title' => 'Quick Application', 'description' => 'Apply online in minutes with basic information. Most applications take less than 5 minutes to complete.'],
                ['number' => 2, 'title' => 'Instant Decision', 'description' => "Get approved in seconds with a soft credit check that won't affect your credit score."],
                ['number' => 3, 'title' => 'Choose Your Terms', 'description' => 'Select the payment plan that fits your budget with clear monthly payments and no surprises.'],
                ['number' => 4, 'title' => 'Take Home Your Puppy', 'description' => 'Complete your purchase and welcome your new family member home the same day!'],
            ],

            // Calculator Section
            'calculator_label' => 'Estimate Your Payment',
            'calculator_title' => 'Payment Calculator',
            'calculator_intro' => 'Get an estimate of your monthly payments based on the puppy price and your preferred term length.',
            'calculator_example_label' => 'Example: $3,000 puppy',
            'calculator_disclaimer' => '*Estimated payments. Actual terms depend on credit approval and lender.',
            'calculator_examples' => [
                ['term' => '6 months', 'payment' => '~$500/mo'],
                ['term' => '12 months', 'payment' => '~$250/mo'],
                ['term' => '24 months', 'payment' => '~$135/mo'],
            ],

            // Benefits Section
            'benefits_label' => 'Why Finance?',
            'benefits_title' => 'Benefits of Financing',
            'benefits' => [
                ['icon' => 'credit-card', 'title' => 'No Prepayment Penalties', 'description' => 'Pay off your balance early without any additional fees or charges.'],
                ['icon' => 'dollar-sign', 'title' => 'Competitive Rates', 'description' => 'Access rates as low as 0% APR through our trusted lending partners.'],
                ['icon' => 'clock', 'title' => 'Fast Approval', 'description' => 'Most applications are approved within minutes, not days.'],
                ['icon' => 'shield', 'title' => 'Soft Credit Check', 'description' => 'See your options without impacting your credit score.'],
                ['icon' => 'file-text', 'title' => 'Simple Terms', 'description' => 'Clear, transparent payment schedules with no hidden fees.'],
                ['icon' => 'heart', 'title' => 'Take Home Today', 'description' => 'Complete your purchase and bring your puppy home the same day.'],
            ],

            // FAQ Section
            'faq_label' => 'Questions?',
            'faq_title' => 'Financing FAQs',
            'faq_items' => [
                ['question' => 'Will applying affect my credit score?', 'answer' => 'No! Our financing partners use a soft credit check to show you options, which does not affect your credit score. A hard inquiry only occurs if you choose to proceed with a specific offer.'],
                ['question' => 'What credit score do I need?', 'answer' => "Our partners work with a range of credit profiles. While better credit typically means better rates, many customers with various credit histories have been approved. The best way to know is to apply and see your options."],
                ['question' => 'Can I pay off my balance early?', 'answer' => 'Yes! All of our financing partners allow you to pay off your balance early without any prepayment penalties. You can make extra payments anytime to reduce your total interest.'],
                ['question' => 'What information do I need to apply?', 'answer' => "You'll need basic personal information including your name, address, date of birth, Social Security number, and income information. The application typically takes less than 5 minutes."],
                ['question' => 'Can I use financing with other payment methods?', 'answer' => "Yes! You can put a portion down in cash, credit card, or debit card and finance the remaining balance. Just let our team know and we'll help you structure the payment."],
            ],

            // Final CTA Section
            'final_cta_title' => 'Ready to Bring Home Your Puppy?',
            'final_cta_description' => 'Check your financing options in minutes without affecting your credit score.',
            'final_cta_btn_text' => 'Check Your Rate',
            'final_cta_btn_link' => '#financing-partners',
        ],

        // =====================================================================
        // LOOK INSIDE PAGE
        // =====================================================================
        'page-look-inside.php' => [
            // Hero Section
            'hero_label' => 'Welcome',
            'hero_title' => 'See Where the Magic Happens',
            'hero_description' => 'Take a virtual tour of our boutique and see why families trust us with their puppy journey. Clean, comfortable, and designed with love for every puppy.',
            'hero_background' => $placeholder_id,
            'hero_cta_video_text' => 'Watch Video Tour',
            'hero_cta_video_link' => '#video-tour',
            'hero_cta_gallery_text' => 'View Gallery',
            'hero_cta_gallery_link' => '#gallery',

            // Video Section
            'video_label' => 'Video Tour',
            'video_title' => 'Take a Walk Through',
            'video_description' => 'Join us for a guided tour of our facility and see how we care for our puppies every day.',
            'video_url' => '', // Empty to use fallback YouTube embed

            // Gallery Section
            'gallery_label' => 'Photo Gallery',
            'gallery_title' => 'Explore Our Space',
            'gallery_categories' => [
                ['slug' => 'interior', 'label' => 'Interior'],
                ['slug' => 'play-areas', 'label' => 'Play Areas'],
                ['slug' => 'puppy-suites', 'label' => 'Puppy Suites'],
                ['slug' => 'retail', 'label' => 'Retail'],
            ],
            'gallery_images' => [
                ['image' => $placeholder_id, 'alt' => 'Furrylicious main entrance and reception', 'category' => 'interior'],
                ['image' => $placeholder_id, 'alt' => 'Open play area for puppies', 'category' => 'play-areas'],
                ['image' => $placeholder_id, 'alt' => 'Private puppy meeting room', 'category' => 'puppy-suites'],
                ['image' => $placeholder_id, 'alt' => 'Premium pet product displays', 'category' => 'retail'],
                ['image' => $placeholder_id, 'alt' => 'Comfortable puppy resting area', 'category' => 'puppy-suites'],
                ['image' => $placeholder_id, 'alt' => 'Indoor play equipment', 'category' => 'play-areas'],
                ['image' => $placeholder_id, 'alt' => 'Boutique interior design', 'category' => 'interior'],
                ['image' => $placeholder_id, 'alt' => 'Designer accessories display', 'category' => 'retail'],
            ],

            // Features Section
            'features_label' => 'Our Facility',
            'features_title' => 'What Makes Us Special',
            'features' => [
                ['icon' => 'thermometer', 'title' => 'Climate Control', 'description' => 'Temperature and humidity carefully maintained year-round for puppy comfort and health.'],
                ['icon' => 'shield', 'title' => 'Daily Sanitization', 'description' => 'Hospital-grade cleaning protocols ensure a healthy environment for every puppy.'],
                ['icon' => 'smile', 'title' => 'Play Areas', 'description' => 'Dedicated spaces for puppies to exercise, socialize, and develop healthy behaviors.'],
                ['icon' => 'users', 'title' => 'Private Meetings', 'description' => 'Comfortable rooms where families can bond with puppies in a relaxed, private setting.'],
                ['icon' => 'monitor', 'title' => '24/7 Monitoring', 'description' => 'Security cameras and staff checks ensure puppies are safe and well-cared for always.'],
                ['icon' => 'heart', 'title' => 'Loving Care', 'description' => 'Our team treats every puppy like family with daily handling and attention.'],
            ],

            // Standards Section
            'standards_label' => 'Health & Safety',
            'standards_title' => 'Our Cleanliness Standards',
            'standards_intro' => 'We go above and beyond to maintain a pristine environment that keeps our puppies healthy and happy.',
            'standards_list' => [
                ['item' => 'Hospital-grade disinfection multiple times daily'],
                ['item' => 'HEPA air filtration for clean, fresh air'],
                ['item' => 'Separate areas for new arrivals and quarantine'],
                ['item' => 'Fresh bedding changed throughout the day'],
                ['item' => 'Staff trained in proper hygiene protocols'],
                ['item' => 'Regular health inspections by licensed veterinarians'],
            ],
            'standards_image' => $placeholder_id,

            // CTA Section
            'cta_title' => 'Ready to See Us in Person?',
            'cta_description' => 'Nothing beats visiting in person. Schedule your appointment and experience our boutique firsthand.',
            'cta_primary_text' => 'Schedule a Visit',
            'cta_primary_link' => home_url('/booking/'),
            'cta_secondary_text' => 'Meet Our Puppies',
            'cta_secondary_link' => home_url('/puppies/'),
        ],

        // =====================================================================
        // PREFERENCES PAGE
        // =====================================================================
        'page-preferences.php' => [
            // Hero Section
            'hero_label' => 'Puppy Matching',
            'hero_title' => "Let's Find Your Perfect Match",
            'hero_description' => "Tell us about your lifestyle, and we'll help match you with puppies that fit your home, heart, and daily routine.",
            'hero_icon' => 'heart',

            // Wizard Steps
            'form_action_url' => admin_url('admin-post.php'),
            'wizard_steps' => [
                ['number' => 1, 'label' => 'Lifestyle'],
                ['number' => 2, 'label' => 'Experience'],
                ['number' => 3, 'label' => 'Preferences'],
                ['number' => 4, 'label' => 'Contact'],
            ],

            // How It Works Section
            'how_label' => 'The Process',
            'how_title' => 'How Matching Works',
            'how_steps' => [
                ['icon' => 'file-text', 'title' => 'Share Your Preferences', 'description' => "Complete the form above to tell us about your lifestyle and what you're looking for."],
                ['icon' => 'search', 'title' => 'We Find Matches', 'description' => 'Our team reviews your preferences and searches for puppies that fit your criteria.'],
                ['icon' => 'mail', 'title' => 'Get Notified', 'description' => "When a matching puppy arrives, we'll reach out with photos and details just for you."],
            ],

            // Popular Breeds Section
            'breeds_label' => 'Popular Breeds',
            'breeds_title' => 'Breeds Families Love',
            'breeds_link' => home_url('/breeds/'),
            'popular_breeds' => [
                ['name' => 'Golden Retriever', 'traits' => [['trait' => 'Family-friendly'], ['trait' => 'Active'], ['trait' => 'Loyal']], 'image' => $placeholder_id],
                ['name' => 'French Bulldog', 'traits' => [['trait' => 'Apartment-friendly'], ['trait' => 'Low energy'], ['trait' => 'Affectionate']], 'image' => $placeholder_id],
                ['name' => 'Goldendoodle', 'traits' => [['trait' => 'Hypoallergenic'], ['trait' => 'Intelligent'], ['trait' => 'Playful']], 'image' => $placeholder_id],
                ['name' => 'Cavalier King Charles', 'traits' => [['trait' => 'Gentle'], ['trait' => 'Great with kids'], ['trait' => 'Adaptable']], 'image' => $placeholder_id],
            ],

            // Concierge Section
            'concierge_label' => 'Premium Service',
            'concierge_title' => 'Puppy Concierge Service',
            'concierge_description' => "Looking for something specific? Our Puppy Concierge team can source your dream puppy from our trusted breeder network. Tell us exactly what you're looking for, and we'll find it.",
            'concierge_cta_text' => 'Contact Concierge',
            'concierge_cta_link' => home_url('/contact-us/?subject=concierge'),
            'concierge_image' => $placeholder_id,
        ],

        // =====================================================================
        // REVIEWS PAGE
        // =====================================================================
        'page-reviews.php' => [
            // Hero Section
            'hero_label' => 'Testimonials',
            'hero_title' => 'Real Stories from Real Families',
            'overall_rating' => 5.0,
            'total_reviews' => '125+',
            'leave_review_cta_text' => 'Leave a Review',
            'leave_review_cta_link' => '#leave-review',

            // Platforms
            'platforms' => [
                ['name' => 'google', 'logo' => $placeholder_id, 'rating' => 5.0, 'count' => '58 reviews', 'url' => 'https://www.google.com/search?q=furrylicious+whitehouse+station#lrd'],
                ['name' => 'yelp', 'logo' => $placeholder_id, 'rating' => 5.0, 'count' => '38 reviews', 'url' => 'https://www.yelp.com/biz/furrylicious-whitehouse-station'],
                ['name' => 'facebook', 'logo' => $placeholder_id, 'rating' => 5.0, 'count' => '29 reviews', 'url' => 'https://www.facebook.com/furryliciousnj/reviews'],
            ],

            // Reviews Section
            'reviews_section_title' => 'What Our Families Say',
            'reviews' => [
                ['quote' => "Very happy with this place. Very clean the best pet shop I've ever been to I'm so happy with my dachshund that I purchased from the store he is very happy and healthy his name is Riley I had a very good experience with the owner she's fantastic!!!", 'author' => 'Renee', 'breed' => 'Dachshund', 'platform' => 'google', 'rating' => 5],
                ['quote' => 'I truly enjoyed my experience with Furrylicious when purchasing my Cockalier Georgie. The staff was extremely helpful and knowledgeable. Georgie has been a wonderful addition to my family. He is adorable, happy, smart and very playful.', 'author' => 'Maria Lorefice', 'breed' => 'Cockalier', 'platform' => 'google', 'rating' => 5],
                ['quote' => 'We are so fortunate to have found Furrylicious! We love our mini goldendoodle puppy! He has a wonderful, calm temperament and is the best addition to our family! Cindy and her team went above and beyond for our family! Definitely recommend!!', 'author' => "D. O'Donnell", 'breed' => 'Mini Goldendoodle', 'platform' => 'yelp', 'rating' => 5],
                ['quote' => 'We found our perfect French Bulldog at Furrylicious! The staff was incredibly knowledgeable and helped us every step of the way. Our Louie is healthy, happy, and the best addition to our family.', 'author' => 'Jennifer M.', 'breed' => 'French Bulldog', 'platform' => 'facebook', 'rating' => 5],
                ['quote' => 'The experience at Furrylicious was nothing like other pet stores. They truly care about matching the right puppy with the right family. Their follow-up support has been amazing!', 'author' => 'David K.', 'breed' => 'Golden Retriever', 'platform' => 'google', 'rating' => 5],
                ['quote' => 'As first-time puppy parents, we had so many questions. The team at Furrylicious was patient, informative, and made the whole process enjoyable. Our Cavapoo is absolutely perfect!', 'author' => 'Sarah R.', 'breed' => 'Cavapoo', 'platform' => 'yelp', 'rating' => 5],
                ['quote' => 'Best place to get a puppy! Clean facility, healthy puppies, and amazing customer service. They even followed up a week later to see how we were doing. Highly recommend!', 'author' => 'Michael T.', 'breed' => 'Labradoodle', 'platform' => 'google', 'rating' => 5],
                ['quote' => 'We drove 2 hours to visit Furrylicious after reading the reviews, and it was absolutely worth it. The puppies are well cared for and the staff is so passionate about what they do.', 'author' => 'Amanda P.', 'breed' => 'Cavalier King Charles', 'platform' => 'facebook', 'rating' => 5],
                ['quote' => 'From the moment we walked in, we knew this was different. No high-pressure sales, just genuine love for the puppies and desire to find them great homes. Our Bernedoodle is thriving!', 'author' => 'Chris & Lisa M.', 'breed' => 'Bernedoodle', 'platform' => 'yelp', 'rating' => 5],
            ],

            // Photos Section
            'photos_label' => 'Happy Puppies',
            'photos_title' => 'Photos from Our Families',
            'customer_photos' => [
                $placeholder_id, $placeholder_id, $placeholder_id, $placeholder_id,
                $placeholder_id, $placeholder_id, $placeholder_id, $placeholder_id,
            ],
            'instagram_link' => 'https://www.instagram.com/furryliciousnj/',

            // Videos Section
            'videos_label' => 'Video Stories',
            'videos_title' => 'Watch Their Stories',
            'videos' => [
                ['thumbnail' => $placeholder_id, 'video_id' => 'VIDEO_ID_1', 'caption' => 'The Johnson Family & Their Goldendoodle'],
                ['thumbnail' => $placeholder_id, 'video_id' => 'VIDEO_ID_2', 'caption' => 'Meet Luna - A Happy Customer Update'],
                ['thumbnail' => $placeholder_id, 'video_id' => 'VIDEO_ID_3', 'caption' => 'From First Visit to Forever Home'],
            ],

            // Leave Review Section
            'leave_review_title' => 'Share Your Story',
            'leave_review_description' => "We'd love to hear about your experience! Leave a review on your favorite platform.",
            'leave_review_platforms' => [
                ['name' => 'google', 'url' => 'https://www.google.com/search?q=furrylicious+whitehouse+station#lrd'],
                ['name' => 'yelp', 'url' => 'https://www.yelp.com/writeareview/biz/furrylicious-whitehouse-station'],
                ['name' => 'facebook', 'url' => 'https://www.facebook.com/furryliciousnj/reviews'],
            ],
        ],

        // =====================================================================
        // FAQ PAGE
        // =====================================================================
        'templates/template-faq.php' => [
            // Hero Section
            'hero_label' => 'Support',
            'hero_title' => 'Questions? We Have Answers',
            'hero_description' => 'Find answers to the most common questions about our puppies, policies, and process.',
            'show_search' => true,

            // CTA Section
            'cta_title' => 'Still Have Questions?',
            'cta_description' => "Can't find what you're looking for? Our team is here to help.",
            'cta_btn1_text' => 'Contact Us',
            'cta_btn1_link' => home_url('/contact-us/'),
            'cta_btn2_text' => '(908) 823-4468',
            'cta_btn2_link' => 'tel:+19088234468',

            // FAQ Categories (complex nested repeater)
            'faq_categories' => [
                [
                    'slug' => 'puppies',
                    'label' => 'Puppies',
                    'icon' => 'heart',
                    'section_title' => 'Puppies',
                    'questions' => [
                        ['question' => 'Where do your puppies come from?', 'answer' => "<p>All of our puppies come from USDA-licensed breeders who meet our rigorous standards for animal welfare, health testing, and ethical breeding practices. We personally inspect each breeder's facility and maintain ongoing monitoring to ensure they continue to meet our standards.</p>"],
                        ['question' => 'What breeds do you carry?', 'answer' => '<p>We carry a wide variety of popular breeds including Golden Retrievers, Goldendoodles, French Bulldogs, Cavalier King Charles Spaniels, Bernedoodles, Labradoodles, and many more. Our available puppies change frequently, so we recommend checking our website or contacting us for current availability.</p>'],
                        ['question' => "How old are the puppies when they're available?", 'answer' => "<p>Our puppies are typically 8-12 weeks old when they become available. This allows them to have proper time with their mother and littermates for important socialization and weaning. Each puppy's age is listed on their profile.</p>"],
                        ['question' => 'Can I reserve a puppy before visiting?', 'answer' => "<p>Yes! If you see a puppy you love, you can place a deposit to reserve them. However, we encourage you to visit in person when possible to ensure it's the right match. Deposits are refundable within 48 hours if you change your mind.</p>"],
                    ],
                ],
                [
                    'slug' => 'health',
                    'label' => 'Health',
                    'icon' => 'shield',
                    'section_title' => 'Health & Guarantees',
                    'questions' => [
                        ['question' => 'What health guarantees do you offer?', 'answer' => '<p>Every puppy comes with a comprehensive health guarantee covering genetic and congenital conditions. We also provide a 14-day illness guarantee and require you to have your puppy examined by a veterinarian within 72 hours of purchase. Full details are provided in our purchase agreement.</p>'],
                        ['question' => 'Are the puppies vaccinated?', 'answer' => "<p>Yes, all puppies receive age-appropriate vaccinations before going to their new homes. You'll receive complete medical records including vaccination dates. Your veterinarian will advise on the remaining vaccination schedule.</p>"],
                        ['question' => 'What if my puppy gets sick after purchase?', 'answer' => "<p>Contact us immediately if your puppy shows signs of illness. Within the first 14 days, common illnesses are covered under our health guarantee. We're here to support you and can help coordinate with your veterinarian to ensure your puppy receives proper care.</p>"],
                    ],
                ],
                [
                    'slug' => 'financing',
                    'label' => 'Financing',
                    'icon' => 'credit-card',
                    'section_title' => 'Financing & Payment',
                    'questions' => [
                        ['question' => 'Do you offer financing?', 'answer' => '<p>Yes! We partner with several financing companies including Synchrony, Affirm, and Scratchpay. Most applications take just minutes and use a soft credit check that won\'t affect your credit score. Visit our <a href="' . esc_url(home_url('/financing/')) . '">financing page</a> for more details.</p>'],
                        ['question' => 'What payment methods do you accept?', 'answer' => '<p>We accept cash, all major credit cards (Visa, MasterCard, American Express, Discover), debit cards, and financing through our partner lenders. We also accept personal checks with proper identification.</p>'],
                        ['question' => 'How much is the deposit to reserve a puppy?', 'answer' => '<p>Deposits are typically $500-$1000 depending on the puppy and breed. This deposit is applied toward the total purchase price. Deposits are refundable within 48 hours if you change your mind.</p>'],
                    ],
                ],
                [
                    'slug' => 'visits',
                    'label' => 'Visits',
                    'icon' => 'calendar',
                    'section_title' => 'Visiting & Appointments',
                    'questions' => [
                        ['question' => 'Do I need an appointment to visit?', 'answer' => "<p>Walk-ins are welcome during our business hours. However, we recommend scheduling an appointment for the best experience, especially if you have specific puppies you'd like to meet. Appointments ensure dedicated time with our staff and your chosen puppies.</p>"],
                        ['question' => 'Can I bring my children?', 'answer' => "<p>Absolutely! We encourage families to bring children so everyone can meet potential puppies. Our staff is experienced with helping kids interact safely and positively with puppies. It's an important part of finding the right family match.</p>"],
                        ['question' => 'Can I bring my current pet?', 'answer' => "<p>For the safety of our puppies and to prevent disease transmission, we ask that you leave other pets at home during your initial visit. Once you've reserved a puppy, we can arrange a meet-and-greet with your current pet before pickup.</p>"],
                    ],
                ],
                [
                    'slug' => 'general',
                    'label' => 'General',
                    'icon' => 'help-circle',
                    'section_title' => 'General Questions',
                    'questions' => [
                        ['question' => 'What\'s included when I purchase a puppy?', 'answer' => '<p>Every puppy purchase includes: complete veterinary records, age-appropriate vaccinations, health guarantee documentation, registration papers (when applicable), a puppy care kit with food samples, and lifetime support from our team.</p>'],
                        ['question' => 'Do you offer delivery or shipping?', 'answer' => '<p>We prefer in-person pickups to ensure a proper handoff and allow you to receive our care instructions in person. For special circumstances, we can discuss delivery options within a reasonable distance. We do not ship puppies.</p>'],
                        ['question' => 'Do you have a return policy?', 'answer' => "<p>We want every puppy to find their forever home. If circumstances change and you can no longer care for your puppy, please contact us. We'll work with you to find a solution and ensure the puppy's well-being. We never want a Furrylicious puppy to end up in a shelter.</p>"],
                    ],
                ],
            ],
        ],
    ];
}

/**
 * Populate ACF fields with default values
 *
 * @param bool $overwrite Whether to overwrite existing field values
 * @return array Results per template
 */
function furrylicious_populate_acf_defaults($overwrite = false) {
    if (!function_exists('update_field')) {
        return ['error' => 'ACF not installed or activated'];
    }

    $defaults = furrylicious_get_all_defaults();
    $results = [];

    foreach ($defaults as $template => $fields) {
        $page_id = furrylicious_get_page_by_template($template);

        if (!$page_id) {
            $results[$template] = [
                'status' => 'skipped',
                'message' => 'Page not found for template',
            ];
            continue;
        }

        $updated = 0;
        $skipped = 0;

        foreach ($fields as $field_name => $value) {
            $existing = get_field($field_name, $page_id);

            // Check if field already has content
            $has_content = false;
            if (is_array($existing)) {
                $has_content = !empty($existing);
            } elseif (is_bool($existing)) {
                $has_content = true; // Booleans always count as having content
            } else {
                $has_content = !empty($existing) && $existing !== '';
            }

            // Skip if already has data and not overwriting
            if (!$overwrite && $has_content) {
                $skipped++;
                continue;
            }

            // Update the field
            $result = update_field($field_name, $value, $page_id);
            if ($result !== false) {
                $updated++;
            }
        }

        $results[$template] = [
            'status' => 'processed',
            'page_id' => $page_id,
            'updated' => $updated,
            'skipped' => $skipped,
        ];
    }

    return $results;
}

/**
 * Add admin menu page for ACF initialization
 */
function furrylicious_add_acf_admin_menu() {
    add_theme_page(
        'Initialize ACF Fields',
        'Initialize ACF',
        'manage_options',
        'furrylicious-acf-init',
        'furrylicious_acf_init_page'
    );
}
add_action('admin_menu', 'furrylicious_add_acf_admin_menu');

/**
 * Handle form submissions for ACF initialization
 */
function furrylicious_handle_acf_init_action() {
    if (!isset($_POST['furrylicious_acf_action'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized access');
    }

    check_admin_referer('furrylicious_acf_init_nonce');

    $action = sanitize_text_field($_POST['furrylicious_acf_action']);
    $overwrite = ($action === 'reset_all');

    $results = furrylicious_populate_acf_defaults($overwrite);

    // Store results in transient for display
    set_transient('furrylicious_acf_init_results', $results, 60);

    // Redirect to prevent form resubmission
    wp_redirect(add_query_arg('acf_init_complete', '1', admin_url('themes.php?page=furrylicious-acf-init')));
    exit;
}
add_action('admin_init', 'furrylicious_handle_acf_init_action');

/**
 * Render the ACF initialization admin page
 */
function furrylicious_acf_init_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check for results from recent action
    $results = get_transient('furrylicious_acf_init_results');
    if ($results) {
        delete_transient('furrylicious_acf_init_results');
    }

    // Check if ACF is installed
    $acf_active = function_exists('get_field');
    ?>
    <div class="wrap">
        <h1>Initialize ACF Fields</h1>

        <?php if (!$acf_active): ?>
            <div class="notice notice-error">
                <p><strong>ACF Pro is required.</strong> Please install and activate Advanced Custom Fields Pro to use this feature.</p>
            </div>
        <?php else: ?>

            <div class="card" style="max-width: 800px; padding: 20px;">
                <h2>About This Tool</h2>
                <p>This tool populates all ACF fields with the default content currently hardcoded in the page templates. Use this during initial site setup to avoid manually entering content in WP admin.</p>

                <h3>Requirements</h3>
                <ul style="list-style-type: disc; margin-left: 20px;">
                    <li>Pages must exist with the correct templates assigned</li>
                    <li>ACF field groups must be registered (they are defined in JSON files)</li>
                </ul>

                <h3>Templates Included</h3>
                <ol>
                    <li>page-booking.php - Booking an Appointment</li>
                    <li>page-blog.php - Our Blog</li>
                    <li>page-boutique.php - Pet Boutique</li>
                    <li>page-breeders.php - Our Breeders</li>
                    <li>page-contact-us.php - Contact Us</li>
                    <li>page-financing.php - Financing</li>
                    <li>page-look-inside.php - Look Inside Furrylicious</li>
                    <li>page-preferences.php - Preference Center</li>
                    <li>page-reviews.php - Reviews</li>
                    <li>templates/template-faq.php - FAQs Template</li>
                </ol>
            </div>

            <?php if ($results): ?>
                <div class="notice notice-success" style="margin: 20px 0;">
                    <p><strong>ACF fields have been populated!</strong></p>
                </div>

                <table class="wp-list-table widefat fixed striped" style="max-width: 800px;">
                    <thead>
                        <tr>
                            <th>Template</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th>Skipped</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $template => $result): ?>
                            <tr>
                                <td><code><?php echo esc_html($template); ?></code></td>
                                <td>
                                    <?php if ($result['status'] === 'processed'): ?>
                                        <span style="color: green;">&#10003; Processed</span>
                                    <?php elseif ($result['status'] === 'skipped'): ?>
                                        <span style="color: orange;">&#8212; <?php echo esc_html($result['message']); ?></span>
                                    <?php else: ?>
                                        <span style="color: red;">&#10007; Error</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo isset($result['updated']) ? esc_html($result['updated']) : '-'; ?></td>
                                <td><?php echo isset($result['skipped']) ? esc_html($result['skipped']) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <div style="margin-top: 30px; max-width: 800px;">
                <form method="post" style="display: inline-block; margin-right: 20px;">
                    <?php wp_nonce_field('furrylicious_acf_init_nonce'); ?>
                    <input type="hidden" name="furrylicious_acf_action" value="populate_empty">
                    <button type="submit" class="button button-primary button-large">
                        Populate Empty Fields
                    </button>
                    <p class="description">Only fills fields that don't have content yet. Safe to run multiple times.</p>
                </form>

                <form method="post" style="display: inline-block;" onsubmit="return confirm('Are you sure? This will overwrite ALL ACF field values with defaults.');">
                    <?php wp_nonce_field('furrylicious_acf_init_nonce'); ?>
                    <input type="hidden" name="furrylicious_acf_action" value="reset_all">
                    <button type="submit" class="button button-secondary button-large">
                        Reset All to Defaults
                    </button>
                    <p class="description">Overwrites all fields with default values. Use with caution!</p>
                </form>
            </div>

        <?php endif; ?>
    </div>
    <?php
}
