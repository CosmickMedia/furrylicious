<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php if (is_search()) : ?>
        <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>

    <?php
    /**
     * Open Graph & Twitter Card Meta Tags
     * These serve as fallbacks when Yoast SEO is not active
     */
    if (!defined('WPSEO_VERSION') && is_singular()) :
        $og_title = get_the_title();
        $og_description = function_exists('furrylicious_get_page_field')
            ? furrylicious_get_page_field('seo_meta_description', get_bloginfo('description'))
            : get_bloginfo('description');
        $og_image = function_exists('furrylicious_get_page_field')
            ? furrylicious_get_page_field('og_image')
            : null;
        $og_url = get_permalink();
        $og_site_name = get_bloginfo('name');
    ?>
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>">
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($og_site_name); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?php echo esc_attr(get_locale()); ?>">
    <?php if ($og_image && isset($og_image['url'])) : ?>
    <meta property="og:image" content="<?php echo esc_url($og_image['url']); ?>">
    <?php if (isset($og_image['width'])) : ?>
    <meta property="og:image:width" content="<?php echo esc_attr($og_image['width']); ?>">
    <?php endif; ?>
    <?php if (isset($og_image['height'])) : ?>
    <meta property="og:image:height" content="<?php echo esc_attr($og_image['height']); ?>">
    <?php endif; ?>
    <?php elseif (has_post_thumbnail()) : ?>
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
    <?php endif; ?>

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($og_description); ?>">
    <?php if ($og_image && isset($og_image['url'])) : ?>
    <meta name="twitter:image" content="<?php echo esc_url($og_image['url']); ?>">
    <?php elseif (has_post_thumbnail()) : ?>
    <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
    <?php endif; ?>
    <?php endif; ?>

    <?php wp_head(); ?>

    <!-- Remove no-js class when JS is enabled -->
    <script>document.documentElement.classList.remove('no-js');document.documentElement.classList.add('js');</script>
</head>

<?php
// Determine header style based on page
$header_class = 'site-header';
$is_transparent = is_front_page() && !is_paged();

if ($is_transparent) {
    $header_class .= ' site-header--transparent';
} else {
    $header_class .= ' site-header--solid';
}

// Static logo paths - edit these directly
$logo_dark = get_template_directory_uri() . '/assets/images/logo.png';
$logo_light = get_template_directory_uri() . '/assets/images/logo.png';

// Static announcement bar - set to empty string to disable
$announcement_text = 'Don\'t see what you\'re looking for?';
$announcement_link_url = '/puppy-concierge/';
$announcement_link_text = 'Click Here';

// Contact info for announcement bar
$contact_phone = '(908) 823-4468';
?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-to-content" href="#main-content">
    <?php esc_html_e('Skip to content', 'furrylicious'); ?>
</a>

<?php if ($announcement_text) : ?>
<div class="announcement-bar">
    <div class="announcement-bar__inner">
        <!-- Left: Spacer for balance -->
        <div class="announcement-bar__spacer"></div>

        <!-- Center: Promo text -->
        <p class="announcement-bar__text">
            <?php echo esc_html($announcement_text); ?>
            <?php if ($announcement_link_url && $announcement_link_text) : ?>
                <a href="<?php echo esc_url(home_url($announcement_link_url)); ?>" class="announcement-bar__link">
                    <?php echo esc_html($announcement_link_text); ?>
                </a>
            <?php endif; ?>
        </p>

        <!-- Right: Account, Map & Phone -->
        <div class="announcement-bar__actions">
            <a href="<?php echo esc_url(home_url('/my-account/')); ?>" class="announcement-bar__action">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="sr-only"><?php esc_html_e('My Account', 'furrylicious'); ?></span>
            </a>
            <a href="https://www.google.com/maps/search/?api=1&query=Furrylicious+531+US+Highway+22+E+Whitehouse+Station+New+Jersey+08889" class="announcement-bar__action" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="sr-only"><?php esc_html_e('Find Us', 'furrylicious'); ?></span>
            </a>
            <?php if ($contact_phone) : ?>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_phone)); ?>" class="announcement-bar__action">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span><?php echo esc_html($contact_phone); ?></span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<header id="site-header" class="<?php echo esc_attr($header_class); ?>" role="banner">
    <div class="header-main header-main--centered">

        <!-- Mobile Menu Toggle -->
        <button
            type="button"
            class="mobile-menu-toggle"
            aria-expanded="false"
            aria-controls="mobile-nav"
            aria-label="<?php esc_attr_e('Toggle navigation menu', 'furrylicious'); ?>"
        >
            <span class="mobile-menu-toggle__icon">
                <span class="mobile-menu-toggle__bar"></span>
                <span class="mobile-menu-toggle__bar"></span>
                <span class="mobile-menu-toggle__bar"></span>
            </span>
        </button>

        <!-- Site Branding (Center) -->
        <div class="site-branding">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                <?php if ($logo_dark) : ?>
                    <img
                        src="<?php echo esc_url($logo_dark); ?>"
                        alt="<?php bloginfo('name'); ?>"
                        class="site-logo__image site-logo__image--dark"
                        width="180"
                        height="40"
                    />
                <?php endif; ?>
                <?php if ($logo_light) : ?>
                    <img
                        src="<?php echo esc_url($logo_light); ?>"
                        alt="<?php bloginfo('name'); ?>"
                        class="site-logo__image site-logo__image--light"
                        width="180"
                        height="40"
                    />
                <?php endif; ?>
                <?php if (!$logo_dark && !$logo_light) : ?>
                    <span class="site-logo__text">
                        <?php bloginfo('name'); ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>

        <!-- Header Actions -->
        <div class="header-actions">
            <!-- Search Toggle -->
            <button
                type="button"
                class="header-actions__btn header-actions__search"
                aria-expanded="false"
                aria-label="<?php esc_attr_e('Open search', 'furrylicious'); ?>"
            >
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                    <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>

            <!-- CTA Button -->
            <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--primary btn--sm header-actions__cta">
                <?php esc_html_e('View Puppies', 'furrylicious'); ?>
            </a>
        </div>

    </div>
</header>

<!-- Header Spacer (for fixed header) -->
<div class="header-spacer"></div>

<!-- Full-Width Search Overlay -->
<div class="header-search-overlay" aria-hidden="true">
    <div class="header-search-overlay__inner">
        <button type="button" class="header-search-overlay__close" aria-label="<?php esc_attr_e('Close search', 'furrylicious'); ?>">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <form role="search" method="get" class="header-search-overlay__form" action="<?php echo esc_url(home_url('/')); ?>">
            <label for="search-overlay-input" class="screen-reader-text"><?php esc_html_e('Search for:', 'furrylicious'); ?></label>
            <input
                type="search"
                id="search-overlay-input"
                class="header-search-overlay__input"
                placeholder="<?php esc_attr_e('Search puppies, breeds, FAQs...', 'furrylicious'); ?>"
                value="<?php echo get_search_query(); ?>"
                name="s"
                autocomplete="off"
            />
            <button type="submit" class="header-search-overlay__submit" aria-label="<?php esc_attr_e('Submit search', 'furrylicious'); ?>">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                    <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </form>

        <!-- Live Search Results -->
        <div class="header-search-overlay__results" aria-live="polite">
            <div class="header-search-overlay__loading" hidden>
                <svg class="header-search-overlay__spinner" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-dasharray="31.4 31.4" />
                </svg>
                <span><?php esc_html_e('Searching...', 'furrylicious'); ?></span>
            </div>
            <div class="header-search-overlay__results-grid"></div>
            <p class="header-search-overlay__no-results" hidden><?php esc_html_e('No puppies found. Try a different search term.', 'furrylicious'); ?></p>
        </div>

        <div class="header-search-overlay__quick-links">
            <p class="header-search-overlay__label"><?php esc_html_e('Popular Searches', 'furrylicious'); ?></p>
            <div class="header-search-overlay__tags">
                <a href="<?php echo esc_url(home_url('/puppies-for-sale/?breed=goldendoodle')); ?>" class="header-search-overlay__tag">Goldendoodles</a>
                <a href="<?php echo esc_url(home_url('/puppies-for-sale/?breed=french-bulldog')); ?>" class="header-search-overlay__tag">French Bulldogs</a>
                <a href="<?php echo esc_url(home_url('/puppies-for-sale/?breed=cavalier')); ?>" class="header-search-overlay__tag">Cavaliers</a>
                <a href="<?php echo esc_url(home_url('/faqs/')); ?>" class="header-search-overlay__tag">FAQs</a>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Navigation (Full-screen takeover) -->
<div class="mobile-nav-overlay"></div>
<nav id="mobile-nav" class="mobile-nav" aria-label="<?php esc_attr_e('Mobile Menu', 'furrylicious'); ?>" aria-hidden="true">
    <div class="mobile-nav__header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
            <?php if ($logo_dark) : ?>
                <img
                    src="<?php echo esc_url($logo_dark); ?>"
                    alt="<?php bloginfo('name'); ?>"
                    class="mobile-nav__logo"
                />
            <?php else : ?>
                <span class="site-logo__text"><?php bloginfo('name'); ?></span>
            <?php endif; ?>
        </a>
        <button type="button" class="mobile-nav__close" aria-label="<?php esc_attr_e('Close menu', 'furrylicious'); ?>">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>

    <div class="mobile-nav__content">
        <?php
        if (has_nav_menu('mobile') || has_nav_menu('primary')) :
            wp_nav_menu(array(
                'theme_location' => has_nav_menu('mobile') ? 'mobile' : 'primary',
                'menu_id'        => 'mobile-menu',
                'menu_class'     => 'mobile-nav__list',
                'container'      => false,
                'depth'          => 2,
                'fallback_cb'    => false,
            ));
        endif;
        ?>

        <!-- Mobile Contact Info - Static -->
        <?php
        // Static contact info - edit these directly
        $contact_phone = '(908) 823-4468';
        $contact_email = 'hello@furrylicious.com';
        ?>
        <div class="mobile-nav__contact">
            <p class="mobile-nav__contact-title"><?php esc_html_e('Get in Touch', 'furrylicious'); ?></p>
            <?php if ($contact_phone) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_phone)); ?>" class="mobile-nav__contact-link">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo esc_html($contact_phone); ?>
                </a>
            <?php endif; ?>

            <?php if ($contact_email) : ?>
                <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="mobile-nav__contact-link">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php echo esc_html($contact_email); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile Social Links - Static -->
        <?php
        // Static social links - set to empty string to hide
        $social_instagram = 'https://www.instagram.com/furrylicious/?hl=en';
        $social_facebook = 'https://www.facebook.com/furrylicious';
        $social_twitter = 'https://twitter.com/_Furrylicious';
        $social_pinterest = 'https://www.pinterest.com/furrylicious/_created/';
        $social_youtube = 'https://www.youtube.com/channel/UCzDaJzujKN2RRcMY_23l3jA';
        ?>
        <?php if ($social_instagram || $social_facebook || $social_twitter || $social_pinterest || $social_youtube) : ?>
        <div class="mobile-nav__social">
            <?php if ($social_instagram) : ?>
                <a href="<?php echo esc_url($social_instagram); ?>" class="mobile-nav__social-link" aria-label="Instagram" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>
                        <circle cx="18" cy="6" r="1" fill="currentColor"/>
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($social_facebook) : ?>
                <a href="<?php echo esc_url($social_facebook); ?>" class="mobile-nav__social-link" aria-label="Facebook" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($social_twitter) : ?>
                <a href="<?php echo esc_url($social_twitter); ?>" class="mobile-nav__social-link" aria-label="Twitter" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($social_pinterest) : ?>
                <a href="<?php echo esc_url($social_pinterest); ?>" class="mobile-nav__social-link" aria-label="Pinterest" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 2C6.477 2 2 6.477 2 12c0 4.236 2.636 7.855 6.356 9.312-.088-.791-.167-2.005.035-2.868.181-.78 1.172-4.97 1.172-4.97s-.299-.598-.299-1.482c0-1.388.806-2.425 1.81-2.425.853 0 1.265.641 1.265 1.409 0 .858-.545 2.14-.828 3.33-.236.995.5 1.807 1.48 1.807 1.778 0 3.144-1.874 3.144-4.58 0-2.393-1.72-4.068-4.177-4.068-2.845 0-4.515 2.135-4.515 4.34 0 .859.331 1.781.745 2.281a.3.3 0 01.069.288l-.278 1.133c-.044.183-.145.223-.335.134-1.249-.581-2.03-2.407-2.03-3.874 0-3.154 2.292-6.052 6.608-6.052 3.469 0 6.165 2.473 6.165 5.776 0 3.447-2.173 6.22-5.19 6.22-1.013 0-1.965-.527-2.292-1.148l-.623 2.378c-.226.869-.835 1.958-1.244 2.621.937.29 1.931.446 2.962.446 5.523 0 10-4.477 10-10S17.523 2 12 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ($social_youtube) : ?>
                <a href="<?php echo esc_url($social_youtube); ?>" class="mobile-nav__social-link" aria-label="YouTube" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</nav>

<!-- Back to Top Button -->
<button type="button" class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'furrylicious'); ?>">
    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M18 15l-6-6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</button>

<div id="page" class="site">
    <div id="content" class="site-content">
        <main id="main-content" class="site-main" role="main">
