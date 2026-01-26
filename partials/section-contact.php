<?php
/**
 * Contact Section Component
 *
 * Reusable contact section for use on various pages.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get settings
$section_title = $args['title'] ?? __('Get In Touch', 'furrylicious');
$section_subtitle = $args['subtitle'] ?? __('We\'d love to hear from you', 'furrylicious');
$show_form = $args['show_form'] ?? true;

// Get contact info from ACF
$phone = get_field('phone', 'option') ?: '';
$email = get_field('email', 'option') ?: '';
$address = get_field('address', 'option') ?: '';
?>

<section class="section-contact">
    <div class="container">
        <header class="section-contact__header">
            <h2 class="section-contact__title"><?php echo esc_html($section_title); ?></h2>
            <?php if ($section_subtitle) : ?>
                <p class="section-contact__subtitle"><?php echo esc_html($section_subtitle); ?></p>
            <?php endif; ?>
        </header>

        <div class="section-contact__content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-cards">
                        <?php if ($phone) : ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="contact-mini-card">
                                <div class="contact-mini-card__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                                <div class="contact-mini-card__content">
                                    <span class="contact-mini-card__label"><?php esc_html_e('Call Us', 'furrylicious'); ?></span>
                                    <span class="contact-mini-card__value"><?php echo esc_html($phone); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>

                        <?php if ($email) : ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-mini-card">
                                <div class="contact-mini-card__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                                <div class="contact-mini-card__content">
                                    <span class="contact-mini-card__label"><?php esc_html_e('Email Us', 'furrylicious'); ?></span>
                                    <span class="contact-mini-card__value"><?php echo esc_html($email); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>

                        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="contact-mini-card contact-mini-card--cta">
                            <div class="contact-mini-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                            </div>
                            <div class="contact-mini-card__content">
                                <span class="contact-mini-card__label"><?php esc_html_e('Visit', 'furrylicious'); ?></span>
                                <span class="contact-mini-card__value"><?php esc_html_e('Contact Page', 'furrylicious'); ?></span>
                            </div>
                        </a>
                    </div>
                </div>

                <?php if ($show_form) : ?>
                    <div class="col-lg-8">
                        <div class="section-contact__form">
                            <?php
                            $form_id = get_field('gravity_form_id', 'option') ?: 1;
                            if (function_exists('gravity_form')) {
                                gravity_form($form_id, false, false, false, null, true);
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
