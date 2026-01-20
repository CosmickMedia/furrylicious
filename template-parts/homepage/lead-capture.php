<?php
/**
 * Template Part: Lead Capture Form
 *
 * Elegant boutique-style newsletter/inquiry form with floating labels.
 * Static content for easy editing.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Section settings
$section_eyebrow = 'Stay Connected';
$section_title = 'Join the *Furrylicious* Family';
$section_description = 'Be the first to know about new puppy arrivals, special offers, and puppy care tips. We promise no spam—just puppy love!';

// Process title formatting
$section_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', esc_html($section_title));

// Form settings
$form_action = home_url('/newsletter-signup/'); // Update with actual form handler
$show_preferences = true;

// Static breed options
$breeds = [
    'goldendoodle' => 'Goldendoodle',
    'french-bulldog' => 'French Bulldog',
    'cavalier' => 'Cavalier King Charles',
    'golden-retriever' => 'Golden Retriever',
    'bernedoodle' => 'Bernedoodle',
    'labrador' => 'Labrador Retriever',
    'other' => 'Other / Not Sure',
];
?>

<section class="lead-capture" data-reveal="fade">
    <div class="lead-capture__background">
        <div class="lead-capture__pattern"></div>
    </div>

    <div class="container">
        <div class="lead-capture__inner">
            <header class="lead-capture__header" data-reveal="fade-up">
                <?php if ($section_eyebrow) : ?>
                    <p class="section-header__eyebrow"><?php echo esc_html($section_eyebrow); ?></p>
                <?php endif; ?>

                <h2 class="lead-capture__title">
                    <?php echo $section_title_formatted; ?>
                </h2>

                <?php if ($section_description) : ?>
                    <p class="lead-capture__description"><?php echo esc_html($section_description); ?></p>
                <?php endif; ?>
            </header>

            <form class="lead-capture__form" action="<?php echo esc_url($form_action); ?>" method="post" data-reveal="fade-up" data-reveal-delay="100">
                <?php wp_nonce_field('furrylicious_lead_capture', 'lead_capture_nonce'); ?>

                <div class="lead-capture__form-grid">
                    <!-- First Name -->
                    <div class="form-field form-field--floating">
                        <input
                            type="text"
                            id="lead-first-name"
                            name="first_name"
                            class="form-field__input"
                            required
                            autocomplete="given-name"
                        />
                        <label for="lead-first-name" class="form-field__label">First Name</label>
                    </div>

                    <!-- Last Name -->
                    <div class="form-field form-field--floating">
                        <input
                            type="text"
                            id="lead-last-name"
                            name="last_name"
                            class="form-field__input"
                            required
                            autocomplete="family-name"
                        />
                        <label for="lead-last-name" class="form-field__label">Last Name</label>
                    </div>

                    <!-- Email -->
                    <div class="form-field form-field--floating form-field--full">
                        <input
                            type="email"
                            id="lead-email"
                            name="email"
                            class="form-field__input"
                            required
                            autocomplete="email"
                        />
                        <label for="lead-email" class="form-field__label">Email Address</label>
                    </div>

                    <!-- Phone (Optional) -->
                    <div class="form-field form-field--floating form-field--full">
                        <input
                            type="tel"
                            id="lead-phone"
                            name="phone"
                            class="form-field__input"
                            autocomplete="tel"
                        />
                        <label for="lead-phone" class="form-field__label">Phone (Optional)</label>
                    </div>
                </div>

                <?php if ($show_preferences) : ?>
                    <div class="lead-capture__preferences">
                        <p class="lead-capture__preferences-label">I'm interested in: <span class="optional">(Optional)</span></p>

                        <div class="lead-capture__breeds">
                            <?php foreach ($breeds as $value => $label) : ?>
                                <label class="lead-capture__breed-option">
                                    <input type="checkbox" name="breeds[]" value="<?php echo esc_attr($value); ?>" />
                                    <span class="lead-capture__breed-chip"><?php echo esc_html($label); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="lead-capture__gender">
                            <p class="lead-capture__preferences-sublabel">Gender preference:</p>
                            <div class="lead-capture__gender-options">
                                <label class="lead-capture__gender-option">
                                    <input type="radio" name="gender_preference" value="any" checked />
                                    <span class="lead-capture__gender-chip">No Preference</span>
                                </label>
                                <label class="lead-capture__gender-option">
                                    <input type="radio" name="gender_preference" value="female" />
                                    <span class="lead-capture__gender-chip">Female</span>
                                </label>
                                <label class="lead-capture__gender-option">
                                    <input type="radio" name="gender_preference" value="male" />
                                    <span class="lead-capture__gender-chip">Male</span>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="lead-capture__consent">
                    <label class="lead-capture__checkbox">
                        <input type="checkbox" name="consent" required />
                        <span class="lead-capture__checkbox-mark"></span>
                        <span class="lead-capture__checkbox-text">
                            I agree to receive emails about puppies, promotions, and news.
                            <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" target="_blank">Privacy Policy</a>
                        </span>
                    </label>
                </div>

                <div class="lead-capture__submit">
                    <button type="submit" class="btn btn--primary btn--lg btn--full">
                        <span class="btn__text">Join the Family</span>
                        <svg class="btn__icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <p class="lead-capture__privacy">
                    We respect your privacy. Unsubscribe anytime.
                </p>
            </form>

            <!-- Trust indicators -->
            <div class="lead-capture__trust" data-reveal="fade-up" data-reveal-delay="200">
                <div class="lead-capture__trust-item">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Secure & Private</span>
                </div>
                <div class="lead-capture__trust-item">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <polyline points="22,4 12,14.01 9,11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>No Spam, Ever</span>
                </div>
                <div class="lead-capture__trust-item">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Unsubscribe Anytime</span>
                </div>
            </div>
        </div>
    </div>
</section>
