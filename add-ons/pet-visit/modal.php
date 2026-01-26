<?php
/**
 * Pet Visit Modal Template
 *
 * Modal for scheduling visits via Gravity Forms.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$schedule_form_id = get_field('schedule_visit_form_id', 'option');

if (!$schedule_form_id) {
    return;
}

$modal_title = get_field('schedule_visit_title', 'option') ?: __('Schedule a Visit', 'furrylicious');
$modal_description = get_field('schedule_visit_description', 'option') ?: '';
?>

<div class="visit-modal" id="visit-modal" role="dialog" aria-modal="true" aria-labelledby="visit-modal-title" hidden>
    <div class="visit-modal__overlay"></div>
    <div class="visit-modal__content">
        <button type="button" class="visit-modal__close" aria-label="<?php esc_attr_e('Close modal', 'furrylicious'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <div class="visit-modal__header">
            <div class="visit-modal__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            <h2 class="visit-modal__title" id="visit-modal-title"><?php echo esc_html($modal_title); ?></h2>
            <?php if ($modal_description) : ?>
                <p class="visit-modal__description"><?php echo esc_html($modal_description); ?></p>
            <?php endif; ?>
        </div>

        <div class="visit-modal__body">
            <?php
            if (function_exists('gravity_form')) {
                gravity_form($schedule_form_id, false, false, false, null, true, 0);
            } else {
                ?>
                <div class="visit-modal__fallback">
                    <p><?php esc_html_e('Please contact us to schedule a visit:', 'furrylicious'); ?></p>
                    <?php
                    $phone = get_field('phone', 'option');
                    $email = get_field('email', 'option');

                    if ($phone) : ?>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn btn--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <?php echo esc_html($phone); ?>
                        </a>
                    <?php endif;

                    if ($email) : ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>" class="btn btn--outline">
                            <?php esc_html_e('Email Us', 'furrylicious'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
