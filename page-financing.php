<?php
/**
 * Template Name: Financing
 *
 * Financing options for purchasing puppies at Furrylicious.
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
    '@type' => 'FinancialProduct',
    'name' => 'Furrylicious Puppy Financing',
    'description' => 'Flexible financing options to help bring home your perfect puppy',
    'provider' => [
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
        ]
    ],
    'feesAndCommissionsSpecification' => 'No prepayment penalties',
    'offers' => [
        '@type' => 'Offer',
        'availability' => 'https://schema.org/InStock',
        'eligibleRegion' => 'US'
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="financing-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="financing-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Financing', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="financing-page__hero" aria-label="Financing Options">
        <div class="container">
            <div class="financing-page__hero-content">
                <span class="financing-page__section-label">Flexible Payment Options</span>
                <h1 class="financing-page__hero-title">Bring Home Love Today</h1>
                <p class="financing-page__hero-description">Don't let budget concerns delay your joy. Our financing partners make it easy to welcome your new family member with affordable monthly payments.</p>

                <div class="financing-page__hero-trust">
                    <div class="financing-page__trust-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <span>Soft Credit Check</span>
                    </div>
                    <div class="financing-page__trust-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <span>Quick Approval</span>
                    </div>
                    <div class="financing-page__trust-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span>Secure Process</span>
                    </div>
                </div>

                <div class="financing-page__hero-cta">
                    <a href="#financing-partners" class="btn btn--primary btn--lg">Check Your Rate</a>
                    <a href="#how-it-works" class="btn btn--outline btn--lg">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Financing Partners -->
    <section id="financing-partners" class="financing-page__partners" aria-labelledby="partners-heading">
        <div class="container">
            <header class="financing-page__partners-header">
                <span class="financing-page__section-label">Our Partners</span>
                <h2 id="partners-heading" class="financing-page__section-title">Trusted Financing Options</h2>
                <p class="financing-page__section-description">We've partnered with leading financial institutions to offer you the best rates and terms.</p>
            </header>

            <div class="financing-page__partners-grid">
                <div class="financing-page__partner-card">
                    <div class="financing-page__partner-logo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/partners/synchrony.png'); ?>" alt="Synchrony Financial" loading="lazy" width="160" height="60">
                    </div>
                    <h3 class="financing-page__partner-name">Synchrony Financial</h3>
                    <p class="financing-page__partner-description">Promotional financing with deferred interest options. Perfect for larger purchases.</p>
                    <ul class="financing-page__partner-features">
                        <li>0% APR for 6-12 months*</li>
                        <li>Flexible payment terms</li>
                        <li>Easy online management</li>
                    </ul>
                    <a href="#" class="btn btn--rose" target="_blank" rel="noopener noreferrer">Apply Now</a>
                </div>

                <div class="financing-page__partner-card">
                    <div class="financing-page__partner-logo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/partners/affirm.png'); ?>" alt="Affirm" loading="lazy" width="160" height="60">
                    </div>
                    <h3 class="financing-page__partner-name">Affirm</h3>
                    <p class="financing-page__partner-description">Pay over time with clear, simple terms. Know exactly what you'll pay.</p>
                    <ul class="financing-page__partner-features">
                        <li>3, 6, or 12 month terms</li>
                        <li>No hidden fees</li>
                        <li>Real-time decision</li>
                    </ul>
                    <a href="#" class="btn btn--rose" target="_blank" rel="noopener noreferrer">Apply Now</a>
                </div>

                <div class="financing-page__partner-card">
                    <div class="financing-page__partner-logo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/partners/scratchpay.png'); ?>" alt="Scratchpay" loading="lazy" width="160" height="60">
                    </div>
                    <h3 class="financing-page__partner-name">Scratchpay</h3>
                    <p class="financing-page__partner-description">Simple payment plans designed specifically for pet purchases and care.</p>
                    <ul class="financing-page__partner-features">
                        <li>Plans starting at 0% APR</li>
                        <li>Soft credit check</li>
                        <li>Fast approval process</li>
                    </ul>
                    <a href="#" class="btn btn--rose" target="_blank" rel="noopener noreferrer">Apply Now</a>
                </div>
            </div>

            <p class="financing-page__disclaimer">*Subject to credit approval. Minimum monthly payments required. See partner sites for complete terms and conditions.</p>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="financing-page__process" aria-labelledby="process-heading">
        <div class="container">
            <header class="financing-page__process-header">
                <span class="financing-page__section-label">Simple Process</span>
                <h2 id="process-heading" class="financing-page__section-title">How It Works</h2>
            </header>

            <div class="financing-page__timeline">
                <div class="financing-page__timeline-item">
                    <div class="financing-page__timeline-number">1</div>
                    <div class="financing-page__timeline-content">
                        <h3>Quick Application</h3>
                        <p>Apply online in minutes with basic information. Most applications take less than 5 minutes to complete.</p>
                    </div>
                </div>

                <div class="financing-page__timeline-item">
                    <div class="financing-page__timeline-number">2</div>
                    <div class="financing-page__timeline-content">
                        <h3>Instant Decision</h3>
                        <p>Get approved in seconds with a soft credit check that won't affect your credit score.</p>
                    </div>
                </div>

                <div class="financing-page__timeline-item">
                    <div class="financing-page__timeline-number">3</div>
                    <div class="financing-page__timeline-content">
                        <h3>Choose Your Terms</h3>
                        <p>Select the payment plan that fits your budget with clear monthly payments and no surprises.</p>
                    </div>
                </div>

                <div class="financing-page__timeline-item">
                    <div class="financing-page__timeline-number">4</div>
                    <div class="financing-page__timeline-content">
                        <h3>Take Home Your Puppy</h3>
                        <p>Complete your purchase and welcome your new family member home the same day!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Calculator -->
    <section class="financing-page__calculator" aria-labelledby="calculator-heading">
        <div class="container">
            <div class="financing-page__calculator-wrapper">
                <div class="financing-page__calculator-content">
                    <span class="financing-page__section-label">Estimate Your Payment</span>
                    <h2 id="calculator-heading" class="financing-page__section-title">Payment Calculator</h2>
                    <p>Get an estimate of your monthly payments based on the puppy price and your preferred term length.</p>

                    <div class="financing-page__calculator-example">
                        <div class="financing-page__example-row">
                            <span class="financing-page__example-label">Example: $3,000 puppy</span>
                        </div>
                        <div class="financing-page__example-options">
                            <div class="financing-page__example-option">
                                <span class="financing-page__option-term">6 months</span>
                                <span class="financing-page__option-payment">~$500/mo</span>
                            </div>
                            <div class="financing-page__example-option">
                                <span class="financing-page__option-term">12 months</span>
                                <span class="financing-page__option-payment">~$250/mo</span>
                            </div>
                            <div class="financing-page__example-option">
                                <span class="financing-page__option-term">24 months</span>
                                <span class="financing-page__option-payment">~$135/mo</span>
                            </div>
                        </div>
                        <p class="financing-page__example-note">*Estimated payments. Actual terms depend on credit approval and lender.</p>
                    </div>
                </div>

                <div class="financing-page__calculator-cta">
                    <p>Ready to see your personalized options?</p>
                    <a href="#financing-partners" class="btn btn--primary btn--lg">Check Your Rate</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="financing-page__benefits" aria-labelledby="benefits-heading">
        <div class="container">
            <header class="financing-page__benefits-header">
                <span class="financing-page__section-label">Why Finance?</span>
                <h2 id="benefits-heading" class="financing-page__section-title">Benefits of Financing</h2>
            </header>

            <div class="financing-page__benefits-grid">
                <div class="financing-page__benefit">
                    <div class="financing-page__benefit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                            <line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                    </div>
                    <h3>No Prepayment Penalties</h3>
                    <p>Pay off your balance early without any additional fees or charges.</p>
                </div>

                <div class="financing-page__benefit">
                    <div class="financing-page__benefit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                        </svg>
                    </div>
                    <h3>Competitive Rates</h3>
                    <p>Access rates as low as 0% APR through our trusted lending partners.</p>
                </div>

                <div class="financing-page__benefit">
                    <div class="financing-page__benefit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3>Fast Approval</h3>
                    <p>Most applications are approved within minutes, not days.</p>
                </div>

                <div class="financing-page__benefit">
                    <div class="financing-page__benefit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3>Soft Credit Check</h3>
                    <p>See your options without impacting your credit score.</p>
                </div>

                <div class="financing-page__benefit">
                    <div class="financing-page__benefit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <h3>Simple Terms</h3>
                    <p>Clear, transparent payment schedules with no hidden fees.</p>
                </div>

                <div class="financing-page__benefit">
                    <div class="financing-page__benefit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                        </svg>
                    </div>
                    <h3>Take Home Today</h3>
                    <p>Complete your purchase and bring your puppy home the same day.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="financing-page__faq" aria-labelledby="faq-heading">
        <div class="container">
            <header class="financing-page__faq-header">
                <span class="financing-page__section-label">Questions?</span>
                <h2 id="faq-heading" class="financing-page__section-title">Financing FAQs</h2>
            </header>

            <div class="financing-page__faq-content">
                <div class="accordion" data-accordion>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span>Will applying affect my credit score?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div class="accordion-content" aria-hidden="true">
                            <p>No! Our financing partners use a soft credit check to show you options, which does not affect your credit score. A hard inquiry only occurs if you choose to proceed with a specific offer.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span>What credit score do I need?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div class="accordion-content" aria-hidden="true">
                            <p>Our partners work with a range of credit profiles. While better credit typically means better rates, many customers with various credit histories have been approved. The best way to know is to apply and see your options.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span>Can I pay off my balance early?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div class="accordion-content" aria-hidden="true">
                            <p>Yes! All of our financing partners allow you to pay off your balance early without any prepayment penalties. You can make extra payments anytime to reduce your total interest.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span>What information do I need to apply?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div class="accordion-content" aria-hidden="true">
                            <p>You'll need basic personal information including your name, address, date of birth, Social Security number, and income information. The application typically takes less than 5 minutes.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" aria-expanded="false">
                                <span>Can I use financing with other payment methods?</span>
                                <span class="accordion-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div class="accordion-content" aria-hidden="true">
                            <p>Yes! You can put a portion down in cash, credit card, or debit card and finance the remaining balance. Just let our team know and we'll help you structure the payment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="financing-page__cta" aria-label="Apply for financing">
        <div class="container">
            <div class="financing-page__cta-content">
                <h2>Ready to Bring Home Your Puppy?</h2>
                <p>Check your financing options in minutes without affecting your credit score.</p>
                <a href="#financing-partners" class="btn btn--white btn--lg">
                    Check Your Rate
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
