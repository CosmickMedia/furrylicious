<?php
/**
 * Template Name: Puppy Concierge
 *
 * Puppy Concierge service - personalized puppy matching.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();
?>

<article class="concierge-page" itemscope itemtype="https://schema.org/WebPage">

    <!-- Breadcrumb -->
    <nav class="concierge-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Puppy Concierge', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="concierge-page__hero" aria-label="Puppy Concierge Service">
        <div class="container">
            <div class="concierge-page__hero-content">
                <span class="concierge-page__section-label"><?php esc_html_e('Puppy Concierge', 'furrylicious'); ?></span>
                <h1 class="concierge-page__hero-title"><?php esc_html_e('Your Personal Puppy Matchmaker', 'furrylicious'); ?></h1>
                <p class="concierge-page__hero-description"><?php esc_html_e('Can\'t find your dream puppy in our store? Let us help! Share your preferences and we\'ll work with our trusted network of breeders to find the perfect match for your family.', 'furrylicious'); ?></p>

                <div class="concierge-page__hero-cta">
                    <a href="<?php echo esc_url(home_url('/contact/?subject=concierge')); ?>" class="btn btn--rose btn--lg">
                        <?php esc_html_e('Contact Us', 'furrylicious'); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="concierge-page__process" aria-labelledby="process-heading">
        <div class="container">
            <header class="concierge-page__process-header">
                <span class="concierge-page__section-label"><?php esc_html_e('Simple Process', 'furrylicious'); ?></span>
                <h2 id="process-heading" class="concierge-page__section-title"><?php esc_html_e('How It Works', 'furrylicious'); ?></h2>
            </header>

            <div class="concierge-page__process-steps">
                <div class="concierge-page__process-step">
                    <div class="concierge-page__step-number">1</div>
                    <h3 class="concierge-page__step-title"><?php esc_html_e('Tell Us Your Dream Puppy', 'furrylicious'); ?></h3>
                    <p class="concierge-page__step-text"><?php esc_html_e('Share your preferences for breed, size, color, and temperament. The more details you provide, the better we can match you.', 'furrylicious'); ?></p>
                </div>

                <div class="concierge-page__process-step">
                    <div class="concierge-page__step-number">2</div>
                    <h3 class="concierge-page__step-title"><?php esc_html_e('We Search Our Network', 'furrylicious'); ?></h3>
                    <p class="concierge-page__step-text"><?php esc_html_e('We reach out to our trusted network of USDA-licensed breeders to find puppies that match your criteria.', 'furrylicious'); ?></p>
                </div>

                <div class="concierge-page__process-step">
                    <div class="concierge-page__step-number">3</div>
                    <h3 class="concierge-page__step-title"><?php esc_html_e('Meet Your Match', 'furrylicious'); ?></h3>
                    <p class="concierge-page__step-text"><?php esc_html_e('When we find a puppy that fits your preferences, we\'ll contact you to arrange a meeting at our boutique.', 'furrylicious'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Can Help With Section -->
    <section class="concierge-page__services" aria-labelledby="services-heading">
        <div class="container">
            <header class="concierge-page__services-header">
                <span class="concierge-page__section-label"><?php esc_html_e('Your Preferences', 'furrylicious'); ?></span>
                <h2 id="services-heading" class="concierge-page__section-title"><?php esc_html_e('What We Can Help With', 'furrylicious'); ?></h2>
            </header>

            <div class="concierge-page__services-grid">
                <div class="concierge-page__service-card">
                    <div class="concierge-page__service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            <circle cx="12" cy="17" r="1"/>
                            <path d="M12 9v4"/>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Specific Breeds', 'furrylicious'); ?></h3>
                    <p><?php esc_html_e('Looking for a particular breed? From French Bulldogs to Golden Retrievers, we can help find your favorite.', 'furrylicious'); ?></p>
                </div>

                <div class="concierge-page__service-card">
                    <div class="concierge-page__service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="13.5" cy="6.5" r="2.5"/>
                            <circle cx="19" cy="17" r="2"/>
                            <circle cx="6" cy="12" r="3"/>
                            <path d="M12 6.5v8L6 12"/>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Colors & Markings', 'furrylicious'); ?></h3>
                    <p><?php esc_html_e('Have a preferred coat color or unique markings in mind? Let us know and we\'ll keep an eye out.', 'furrylicious'); ?></p>
                </div>

                <div class="concierge-page__service-card">
                    <div class="concierge-page__service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                            <polyline points="7.5 4.21 12 6.81 16.5 4.21"/>
                            <polyline points="7.5 19.79 7.5 14.6 3 12"/>
                            <polyline points="21 12 16.5 14.6 16.5 19.79"/>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Size Preferences', 'furrylicious'); ?></h3>
                    <p><?php esc_html_e('Whether you want a tiny teacup or a gentle giant, we can match you with the right size for your lifestyle.', 'furrylicious'); ?></p>
                </div>

                <div class="concierge-page__service-card">
                    <div class="concierge-page__service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                        </svg>
                    </div>
                    <h3><?php esc_html_e('Temperament Traits', 'furrylicious'); ?></h3>
                    <p><?php esc_html_e('Need a calm companion or an energetic playmate? We\'ll help find a puppy that matches your energy.', 'furrylicious'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="concierge-page__cta" aria-label="Submit your preferences">
        <div class="container">
            <div class="concierge-page__cta-content">
                <h2><?php esc_html_e('Ready to Find Your Perfect Puppy?', 'furrylicious'); ?></h2>
                <p><?php esc_html_e('Submit your preferences and let our team start the search. There\'s no commitment—just let us know what you\'re looking for.', 'furrylicious'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/?subject=concierge')); ?>" class="btn btn--white btn--lg">
                    <?php esc_html_e('Contact Us', 'furrylicious'); ?>
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
