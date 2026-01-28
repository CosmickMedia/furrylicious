<?php
/**
 * Template Name: Financing
 *
 * Financing options for purchasing puppies at Furrylicious.
 * ACF-powered with static fallbacks.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// ACF Fields with defaults - Hero Section
$hero_label = furrylicious_get_page_field('hero_label', 'Flexible Payment Options');
$hero_title = furrylicious_get_page_field('hero_title', 'Bring Home Love Today');
$hero_description = furrylicious_get_page_field('hero_description', 'Don\'t let budget concerns delay your joy. Our financing partners make it easy to welcome your new family member with affordable monthly payments.');
$hero_cta_primary_text = furrylicious_get_page_field('hero_cta_primary_text', 'Check Your Rate');
$hero_cta_primary_link = furrylicious_get_page_field('hero_cta_primary_link', '#financing-partners');
$hero_cta_secondary_text = furrylicious_get_page_field('hero_cta_secondary_text', 'Learn More');
$hero_cta_secondary_link = furrylicious_get_page_field('hero_cta_secondary_link', '#how-it-works');

// ACF Fields with defaults - Partners Section
$partners_label = furrylicious_get_page_field('partners_label', 'Our Partners');
$partners_title = furrylicious_get_page_field('partners_title', 'Trusted Financing Options');
$partners_description = furrylicious_get_page_field('partners_description', 'We\'ve partnered with leading financial institutions to offer you the best rates and terms.');
$partners_disclaimer = furrylicious_get_page_field('partners_disclaimer', '*Subject to credit approval. Minimum monthly payments required. See partner sites for complete terms and conditions.');

// ACF Fields with defaults - Process Section
$process_label = furrylicious_get_page_field('process_label', 'Simple Process');
$process_title = furrylicious_get_page_field('process_title', 'How It Works');

// ACF Fields with defaults - Calculator Section
$calculator_label = furrylicious_get_page_field('calculator_label', 'Estimate Your Payment');
$calculator_title = furrylicious_get_page_field('calculator_title', 'Payment Calculator');
$calculator_intro = furrylicious_get_page_field('calculator_intro', 'Get an estimate of your monthly payments based on the puppy price and your preferred term length.');
$calculator_example_label = furrylicious_get_page_field('calculator_example_label', 'Example: $3,000 puppy');
$calculator_disclaimer = furrylicious_get_page_field('calculator_disclaimer', '*Estimated payments. Actual terms depend on credit approval and lender.');

// ACF Fields with defaults - Benefits Section
$benefits_label = furrylicious_get_page_field('benefits_label', 'Why Finance?');
$benefits_title = furrylicious_get_page_field('benefits_title', 'Benefits of Financing');

// ACF Fields with defaults - FAQ Section
$faq_label = furrylicious_get_page_field('faq_label', 'Questions?');
$faq_title = furrylicious_get_page_field('faq_title', 'Financing FAQs');

// ACF Fields with defaults - Final CTA Section
$final_cta_title = furrylicious_get_page_field('final_cta_title', 'Ready to Bring Home Your Puppy?');
$final_cta_description = furrylicious_get_page_field('final_cta_description', 'Check your financing options in minutes without affecting your credit score.');
$final_cta_btn_text = furrylicious_get_page_field('final_cta_btn_text', 'Check Your Rate');
$final_cta_btn_link = furrylicious_get_page_field('final_cta_btn_link', '#financing-partners');
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
                <span class="financing-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="financing-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="financing-page__hero-description"><?php echo esc_html($hero_description); ?></p>

                <div class="financing-page__hero-trust">
                    <?php if (furrylicious_has_items('hero_trust_items')): ?>
                        <?php while (have_rows('hero_trust_items')): the_row();
                            $icon = get_sub_field('icon');
                        ?>
                            <div class="financing-page__trust-item">
                                <?php if ($icon === 'check-circle'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                <?php elseif ($icon === 'clock'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                <?php endif; ?>
                                <span><?php echo esc_html(get_sub_field('text')); ?></span>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>

                <div class="financing-page__hero-cta">
                    <a href="<?php echo esc_url($hero_cta_primary_link); ?>" class="btn btn--primary btn--lg"><?php echo esc_html($hero_cta_primary_text); ?></a>
                    <a href="<?php echo esc_url($hero_cta_secondary_link); ?>" class="btn btn--outline btn--lg"><?php echo esc_html($hero_cta_secondary_text); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Financing Partners -->
    <section id="financing-partners" class="financing-page__partners" aria-labelledby="partners-heading">
        <div class="container">
            <header class="financing-page__partners-header">
                <span class="financing-page__section-label"><?php echo esc_html($partners_label); ?></span>
                <h2 id="partners-heading" class="financing-page__section-title"><?php echo esc_html($partners_title); ?></h2>
                <p class="financing-page__section-description"><?php echo esc_html($partners_description); ?></p>
            </header>

            <div class="financing-page__partners-grid">
                <?php if (furrylicious_has_items('partners')): ?>
                    <?php while (have_rows('partners')): the_row();
                        $logo = get_sub_field('logo');
                        $name = get_sub_field('name');
                        $description = get_sub_field('description');
                        $apply_url = get_sub_field('apply_url');
                    ?>
                        <div class="financing-page__partner-card">
                            <?php if ($logo): ?>
                                <div class="financing-page__partner-logo">
                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: $name); ?>" loading="lazy" width="160" height="60">
                                </div>
                            <?php endif; ?>
                            <h3 class="financing-page__partner-name"><?php echo esc_html($name); ?></h3>
                            <p class="financing-page__partner-description"><?php echo esc_html($description); ?></p>
                            <?php if (have_rows('features')): ?>
                                <ul class="financing-page__partner-features">
                                    <?php while (have_rows('features')): the_row(); ?>
                                        <li><?php echo esc_html(get_sub_field('feature')); ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if ($apply_url): ?>
                                <a href="<?php echo esc_url($apply_url); ?>" class="btn btn--rose" target="_blank" rel="noopener noreferrer">Apply Now</a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
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
                <?php endif; ?>
            </div>

            <p class="financing-page__disclaimer"><?php echo esc_html($partners_disclaimer); ?></p>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="financing-page__process" aria-labelledby="process-heading">
        <div class="container">
            <header class="financing-page__process-header">
                <span class="financing-page__section-label"><?php echo esc_html($process_label); ?></span>
                <h2 id="process-heading" class="financing-page__section-title"><?php echo esc_html($process_title); ?></h2>
            </header>

            <div class="financing-page__timeline">
                <?php if (furrylicious_has_items('process_steps')): ?>
                    <?php while (have_rows('process_steps')): the_row();
                        $number = get_sub_field('number');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                    ?>
                        <div class="financing-page__timeline-item">
                            <div class="financing-page__timeline-number"><?php echo esc_html($number); ?></div>
                            <div class="financing-page__timeline-content">
                                <h3><?php echo esc_html($title); ?></h3>
                                <p><?php echo esc_html($description); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Payment Calculator -->
    <section class="financing-page__calculator" aria-labelledby="calculator-heading">
        <div class="container">
            <div class="financing-page__calculator-wrapper">
                <div class="financing-page__calculator-content">
                    <span class="financing-page__section-label"><?php echo esc_html($calculator_label); ?></span>
                    <h2 id="calculator-heading" class="financing-page__section-title"><?php echo esc_html($calculator_title); ?></h2>
                    <p><?php echo esc_html($calculator_intro); ?></p>

                    <div class="financing-page__calculator-example">
                        <div class="financing-page__example-row">
                            <span class="financing-page__example-label"><?php echo esc_html($calculator_example_label); ?></span>
                        </div>
                        <div class="financing-page__example-options">
                            <?php if (furrylicious_has_items('calculator_examples')): ?>
                                <?php while (have_rows('calculator_examples')): the_row();
                                    $term = get_sub_field('term');
                                    $payment = get_sub_field('payment');
                                ?>
                                    <div class="financing-page__example-option">
                                        <span class="financing-page__option-term"><?php echo esc_html($term); ?></span>
                                        <span class="financing-page__option-payment"><?php echo esc_html($payment); ?></span>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
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
                            <?php endif; ?>
                        </div>
                        <p class="financing-page__example-note"><?php echo esc_html($calculator_disclaimer); ?></p>
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
                <span class="financing-page__section-label"><?php echo esc_html($benefits_label); ?></span>
                <h2 id="benefits-heading" class="financing-page__section-title"><?php echo esc_html($benefits_title); ?></h2>
            </header>

            <div class="financing-page__benefits-grid">
                <?php if (furrylicious_has_items('benefits')): ?>
                    <?php while (have_rows('benefits')): the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                    ?>
                        <div class="financing-page__benefit">
                            <div class="financing-page__benefit-icon">
                                <?php if ($icon === 'credit-card'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                        <line x1="1" y1="10" x2="23" y2="10"/>
                                    </svg>
                                <?php elseif ($icon === 'dollar-sign'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                                    </svg>
                                <?php elseif ($icon === 'clock'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                <?php elseif ($icon === 'shield'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                <?php elseif ($icon === 'file-text'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                        <polyline points="10 9 9 9 8 9"/>
                                    </svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <h3><?php echo esc_html($title); ?></h3>
                            <p><?php echo esc_html($description); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="financing-page__faq" aria-labelledby="faq-heading">
        <div class="container">
            <header class="financing-page__faq-header">
                <span class="financing-page__section-label"><?php echo esc_html($faq_label); ?></span>
                <h2 id="faq-heading" class="financing-page__section-title"><?php echo esc_html($faq_title); ?></h2>
            </header>

            <div class="financing-page__faq-content">
                <div class="accordion" id="financingFaqAccordion">
                    <?php if (furrylicious_has_items('faq_items')): ?>
                        <?php $faq_index = 0; ?>
                        <?php while (have_rows('faq_items')): the_row();
                            $faq_index++;
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                        ?>
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapse<?php echo $faq_index; ?>"
                                            aria-expanded="false"
                                            aria-controls="faqCollapse<?php echo $faq_index; ?>">
                                        <?php echo esc_html($question); ?>
                                    </button>
                                </h3>
                                <div id="faqCollapse<?php echo $faq_index; ?>" class="accordion-collapse collapse"
                                     data-bs-parent="#financingFaqAccordion">
                                    <div class="accordion-body">
                                        <p><?php echo esc_html($answer); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse1"
                                        aria-expanded="false"
                                        aria-controls="faqCollapse1">
                                    Will applying affect my credit score?
                                </button>
                            </h3>
                            <div id="faqCollapse1" class="accordion-collapse collapse"
                                 data-bs-parent="#financingFaqAccordion">
                                <div class="accordion-body">
                                    <p>No! Our financing partners use a soft credit check to show you options, which does not affect your credit score. A hard inquiry only occurs if you choose to proceed with a specific offer.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse2"
                                        aria-expanded="false"
                                        aria-controls="faqCollapse2">
                                    What credit score do I need?
                                </button>
                            </h3>
                            <div id="faqCollapse2" class="accordion-collapse collapse"
                                 data-bs-parent="#financingFaqAccordion">
                                <div class="accordion-body">
                                    <p>Our partners work with a range of credit profiles. While better credit typically means better rates, many customers with various credit histories have been approved. The best way to know is to apply and see your options.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse3"
                                        aria-expanded="false"
                                        aria-controls="faqCollapse3">
                                    Can I pay off my balance early?
                                </button>
                            </h3>
                            <div id="faqCollapse3" class="accordion-collapse collapse"
                                 data-bs-parent="#financingFaqAccordion">
                                <div class="accordion-body">
                                    <p>Yes! All of our financing partners allow you to pay off your balance early without any prepayment penalties. You can make extra payments anytime to reduce your total interest.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse4"
                                        aria-expanded="false"
                                        aria-controls="faqCollapse4">
                                    What information do I need to apply?
                                </button>
                            </h3>
                            <div id="faqCollapse4" class="accordion-collapse collapse"
                                 data-bs-parent="#financingFaqAccordion">
                                <div class="accordion-body">
                                    <p>You'll need basic personal information including your name, address, date of birth, Social Security number, and income information. The application typically takes less than 5 minutes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqCollapse5"
                                        aria-expanded="false"
                                        aria-controls="faqCollapse5">
                                    Can I use financing with other payment methods?
                                </button>
                            </h3>
                            <div id="faqCollapse5" class="accordion-collapse collapse"
                                 data-bs-parent="#financingFaqAccordion">
                                <div class="accordion-body">
                                    <p>Yes! You can put a portion down in cash, credit card, or debit card and finance the remaining balance. Just let our team know and we'll help you structure the payment.</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="financing-page__cta" aria-label="Apply for financing">
        <div class="container">
            <div class="financing-page__cta-content">
                <h2><?php echo esc_html($final_cta_title); ?></h2>
                <p><?php echo esc_html($final_cta_description); ?></p>
                <a href="<?php echo esc_url($final_cta_btn_link); ?>" class="btn btn--white btn--lg">
                    <?php echo esc_html($final_cta_btn_text); ?>
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
