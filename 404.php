<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<main id="main-content" class="site-main error-404">

    <div class="container">
        <div class="error-404__content">

            <!-- Error Number -->
            <div class="error-404__number" aria-hidden="true">
                404
            </div>

            <!-- Error Message -->
            <h1 class="error-404__title">
                <?php esc_html_e('Page Not Found', 'furrylicious'); ?>
            </h1>

            <p class="error-404__message">
                <?php esc_html_e('The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'furrylicious'); ?>
            </p>

            <!-- Search Form -->
            <div class="error-404__search">
                <p class="error-404__search-label">
                    <?php esc_html_e('Try searching for what you need:', 'furrylicious'); ?>
                </p>
                <?php
                get_search_form(array(
                    'aria_label' => __('404 not found', 'furrylicious'),
                ));
                ?>
            </div>

            <!-- Helpful Links -->
            <div class="error-404__links">
                <h2 class="error-404__links-title">
                    <?php esc_html_e('Or visit one of these pages:', 'furrylicious'); ?>
                </h2>

                <div class="error-404__links-grid">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404__link">
                        <span class="error-404__link-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </span>
                        <span class="error-404__link-text"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>

                    <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="error-404__link">
                        <span class="error-404__link-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </span>
                        <span class="error-404__link-text"><?php esc_html_e('Available Puppies', 'furrylicious'); ?></span>
                    </a>

                    <a href="<?php echo esc_url(home_url('/about-furrylicious-pet/')); ?>" class="error-404__link">
                        <span class="error-404__link-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                        </span>
                        <span class="error-404__link-text"><?php esc_html_e('About Us', 'furrylicious'); ?></span>
                    </a>

                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="error-404__link">
                        <span class="error-404__link-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </span>
                        <span class="error-404__link-text"><?php esc_html_e('Contact Us', 'furrylicious'); ?></span>
                    </a>
                </div>
            </div>

            <!-- Return Home Button -->
            <div class="error-404__action">
                <?php
                furrylicious_get_template_part('template-parts/components/cta-button', null, array(
                    'text'  => __('Return to Homepage', 'furrylicious'),
                    'url'   => home_url('/'),
                    'style' => 'primary',
                    'size'  => 'lg',
                ));
                ?>
            </div>

        </div>
    </div>

</main>

<style>
/* 404 Page Specific Styles */
.error-404 {
    padding: var(--spacing-3xl) 0;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.error-404__content {
    max-width: 700px;
    margin: 0 auto;
    text-align: center;
}

.error-404__number {
    font-family: var(--font-heading);
    font-size: clamp(6rem, 20vw, 12rem);
    font-weight: 700;
    color: var(--color-light-pink);
    line-height: 1;
    margin-bottom: var(--spacing-md);
}

.error-404__title {
    font-family: var(--font-heading);
    font-size: var(--font-size-3xl);
    color: var(--color-brown);
    margin-bottom: var(--spacing-md);
}

.error-404__message {
    font-size: var(--font-size-lg);
    color: var(--color-text-brown);
    margin-bottom: var(--spacing-xl);
    line-height: 1.6;
}

.error-404__search {
    margin-bottom: var(--spacing-2xl);
}

.error-404__search-label {
    margin-bottom: var(--spacing-sm);
    color: var(--color-text-brown);
}

.error-404__links {
    margin-bottom: var(--spacing-2xl);
}

.error-404__links-title {
    font-family: var(--font-heading);
    font-size: var(--font-size-xl);
    color: var(--color-green);
    margin-bottom: var(--spacing-lg);
}

.error-404__links-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--spacing-md);
}

@media (min-width: 576px) {
    .error-404__links-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.error-404__link {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: var(--spacing-lg);
    background-color: var(--color-lightest-pink);
    border-radius: var(--border-radius-lg);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.error-404__link:hover,
.error-404__link:focus {
    background-color: var(--color-light-pink);
    transform: translateY(-4px);
}

.error-404__link-icon {
    width: 40px;
    height: 40px;
    margin-bottom: var(--spacing-sm);
    color: var(--color-dark-pink);
}

.error-404__link-icon svg {
    width: 100%;
    height: 100%;
}

.error-404__link-text {
    font-size: var(--font-size-sm);
    font-weight: 600;
    color: var(--color-brown);
}

.error-404__action {
    margin-top: var(--spacing-lg);
}
</style>

<?php get_footer(); ?>
