<?php
/**
 * Template Name: FAQs Template
 *
 * FAQ page with accordion-style questions organized by category.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<?php
// Schema.org JSON-LD Structured Data for FAQPage
$faq_schema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => []
];

// We'll populate this as we loop through FAQs
$faq_items = [];
?>

<article class="faq-page" itemscope itemtype="https://schema.org/FAQPage">

    <!-- Breadcrumb -->
    <nav class="faq-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('FAQs', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="faq-page__hero" aria-label="Frequently Asked Questions">
        <div class="container">
            <header class="faq-page__hero-content">
                <span class="faq-page__section-label">Support</span>
                <h1 class="faq-page__hero-title">Questions? We Have Answers</h1>
                <p class="faq-page__hero-description">Find answers to the most common questions about our puppies, policies, and process.</p>
            </header>

            <div class="faq-page__search">
                <label for="faq-search" class="sr-only"><?php esc_html_e('Search FAQs', 'furrylicious'); ?></label>
                <div class="faq-page__search-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input
                        type="search"
                        id="faq-search"
                        placeholder="<?php esc_attr_e('Search for answers...', 'furrylicious'); ?>"
                        class="faq-page__search-input"
                        data-faq-search
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Category Navigation -->
    <nav class="faq-page__categories" aria-label="FAQ Categories">
        <div class="container">
            <div class="faq-page__category-tabs">
                <button class="faq-page__category-tab is-active" data-category="all">All</button>
                <button class="faq-page__category-tab" data-category="puppies">Puppies</button>
                <button class="faq-page__category-tab" data-category="health">Health</button>
                <button class="faq-page__category-tab" data-category="financing">Financing</button>
                <button class="faq-page__category-tab" data-category="visits">Visits</button>
                <button class="faq-page__category-tab" data-category="general">General</button>
            </div>
        </div>
    </nav>

    <!-- FAQ Sections -->
    <section class="faq-page__content" aria-labelledby="faq-heading">
        <div class="container">
            <h2 id="faq-heading" class="sr-only"><?php esc_html_e('Frequently Asked Questions', 'furrylicious'); ?></h2>

            <!-- Puppies FAQs -->
            <div class="faq-page__section" data-faq-section="puppies">
                <h3 class="faq-page__section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    </svg>
                    Puppies
                </h3>

                <div class="accordion" data-accordion>
                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Where do your puppies come from?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>All of our puppies come from USDA-licensed breeders who meet our rigorous standards for animal welfare, health testing, and ethical breeding practices. We personally inspect each breeder's facility and maintain ongoing monitoring to ensure they continue to meet our standards.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">What breeds do you carry?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>We carry a wide variety of popular breeds including Golden Retrievers, Goldendoodles, French Bulldogs, Cavalier King Charles Spaniels, Bernedoodles, Labradoodles, and many more. Our available puppies change frequently, so we recommend checking our website or contacting us for current availability.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">How old are the puppies when they're available?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Our puppies are typically 8-12 weeks old when they become available. This allows them to have proper time with their mother and littermates for important socialization and weaning. Each puppy's age is listed on their profile.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Can I reserve a puppy before visiting?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Yes! If you see a puppy you love, you can place a deposit to reserve them. However, we encourage you to visit in person when possible to ensure it's the right match. Deposits are refundable within 48 hours if you change your mind.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health FAQs -->
            <div class="faq-page__section" data-faq-section="health">
                <h3 class="faq-page__section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    Health & Guarantees
                </h3>

                <div class="accordion" data-accordion>
                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">What health guarantees do you offer?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Every puppy comes with a comprehensive health guarantee covering genetic and congenital conditions. We also provide a 14-day illness guarantee and require you to have your puppy examined by a veterinarian within 72 hours of purchase. Full details are provided in our purchase agreement.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Are the puppies vaccinated?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Yes, all puppies receive age-appropriate vaccinations before going to their new homes. You'll receive complete medical records including vaccination dates. Your veterinarian will advise on the remaining vaccination schedule.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">What if my puppy gets sick after purchase?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Contact us immediately if your puppy shows signs of illness. Within the first 14 days, common illnesses are covered under our health guarantee. We're here to support you and can help coordinate with your veterinarian to ensure your puppy receives proper care.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financing FAQs -->
            <div class="faq-page__section" data-faq-section="financing">
                <h3 class="faq-page__section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                        <line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                    Financing & Payment
                </h3>

                <div class="accordion" data-accordion>
                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Do you offer financing?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Yes! We partner with several financing companies including Synchrony, Affirm, and Scratchpay. Most applications take just minutes and use a soft credit check that won't affect your credit score. Visit our <a href="<?php echo esc_url(home_url('/financing/')); ?>">financing page</a> for more details.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">What payment methods do you accept?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>We accept cash, all major credit cards (Visa, MasterCard, American Express, Discover), debit cards, and financing through our partner lenders. We also accept personal checks with proper identification.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">How much is the deposit to reserve a puppy?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Deposits are typically $500-$1000 depending on the puppy and breed. This deposit is applied toward the total purchase price. Deposits are refundable within 48 hours if you change your mind.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visits FAQs -->
            <div class="faq-page__section" data-faq-section="visits">
                <h3 class="faq-page__section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Visiting & Appointments
                </h3>

                <div class="accordion" data-accordion>
                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Do I need an appointment to visit?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Walk-ins are welcome during our business hours. However, we recommend scheduling an appointment for the best experience, especially if you have specific puppies you'd like to meet. Appointments ensure dedicated time with our staff and your chosen puppies.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Can I bring my children?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Absolutely! We encourage families to bring children so everyone can meet potential puppies. Our staff is experienced with helping kids interact safely and positively with puppies. It's an important part of finding the right family match.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Can I bring my current pet?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>For the safety of our puppies and to prevent disease transmission, we ask that you leave other pets at home during your initial visit. Once you've reserved a puppy, we can arrange a meet-and-greet with your current pet before pickup.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General FAQs -->
            <div class="faq-page__section" data-faq-section="general">
                <h3 class="faq-page__section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    General Questions
                </h3>

                <div class="accordion" data-accordion>
                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">What's included when I purchase a puppy?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>Every puppy purchase includes: complete veterinary records, age-appropriate vaccinations, health guarantee documentation, registration papers (when applicable), a puppy care kit with food samples, and lifetime support from our team.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Do you offer delivery or shipping?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>We prefer in-person pickups to ensure a proper handoff and allow you to receive our care instructions in person. For special circumstances, we can discuss delivery options within a reasonable distance. We do not ship puppies.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h4 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span itemprop="name">Do you have a return policy?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h4>
                        <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" aria-hidden="true">
                            <div itemprop="text">
                                <p>We want every puppy to find their forever home. If circumstances change and you can no longer care for your puppy, please contact us. We'll work with you to find a solution and ensure the puppy's well-being. We never want a Furrylicious puppy to end up in a shelter.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Still Have Questions CTA -->
    <section class="faq-page__cta" aria-label="Contact us">
        <div class="container">
            <div class="faq-page__cta-card">
                <h2>Still Have Questions?</h2>
                <p>Can't find what you're looking for? Our team is here to help.</p>
                <div class="faq-page__cta-buttons">
                    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="btn btn--white btn--lg">Contact Us</a>
                    <a href="tel:+19088234468" class="btn btn--outline btn--lg" style="border-color: white; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        (908) 823-4468
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <?php get_template_part('partials/section-contact', null, [
        'title' => __('Ready to Find Your Perfect Companion?', 'furrylicious'),
        'subtitle' => __('Schedule a visit or reach out with any questions', 'furrylicious'),
        'show_form' => false
    ]); ?>

</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category tab filtering
    const tabs = document.querySelectorAll('.faq-page__category-tab');
    const sections = document.querySelectorAll('.faq-page__section');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;

            // Update active tab
            tabs.forEach(t => t.classList.remove('is-active'));
            this.classList.add('is-active');

            // Show/hide sections
            sections.forEach(section => {
                if (category === 'all' || section.dataset.faqSection === category) {
                    section.style.display = '';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    const searchInput = document.querySelector('[data-faq-search]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.accordion-item');

            if (query === '') {
                items.forEach(item => item.style.display = '');
                sections.forEach(section => section.style.display = '');
                return;
            }

            items.forEach(item => {
                const question = item.querySelector('.accordion-button span').textContent.toLowerCase();
                const answer = item.querySelector('.accordion-content').textContent.toLowerCase();

                if (question.includes(query) || answer.includes(query)) {
                    item.style.display = '';
                    item.closest('.faq-page__section').style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            // Reset category tabs to "all"
            tabs.forEach(t => t.classList.remove('is-active'));
            document.querySelector('[data-category="all"]').classList.add('is-active');
        });
    }
});
</script>

<?php get_footer(); ?>
