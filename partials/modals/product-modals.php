<?php
/**
 * Product Modals
 *
 * Bootstrap 5 modals for pet enquiry, video meeting, and unlock promo.
 * Uses Gravity Forms ID 2 for all forms.
 *
 * @package Furrylicious
 * @since 4.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Pet Enquiry Modal -->
<div class="modal fade" id="petEnquiryModal" tabindex="-1" aria-labelledby="petEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="petEnquiryModalLabel"><?php esc_html_e('Ask About This Pet', 'furrylicious'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'furrylicious'); ?>"></button>
            </div>
            <div class="modal-body">
                <p class="modal-pet-info mb-3">
                    <strong><?php esc_html_e('Pet:', 'furrylicious'); ?></strong>
                    <span class="modal-pet-name"></span>
                    <span class="modal-pet-ref"></span>
                </p>
                <?php
                if (function_exists('gravity_form')) {
                    gravity_form(2, false, false, false, array(
                        'pet_id'   => '',
                        'pet_name' => '',
                        'pet_ref'  => '',
                        'form_type' => 'enquiry'
                    ), true, 100);
                } else {
                    echo '<p>' . esc_html__('Contact form not available.', 'furrylicious') . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Video Meeting Modal -->
<div class="modal fade" id="videoMeetingModal" tabindex="-1" aria-labelledby="videoMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoMeetingModalLabel"><?php esc_html_e('Schedule Video Meet & Greet', 'furrylicious'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'furrylicious'); ?>"></button>
            </div>
            <div class="modal-body">
                <p class="modal-pet-info mb-3">
                    <strong><?php esc_html_e('Pet:', 'furrylicious'); ?></strong>
                    <span class="modal-pet-name"></span>
                    <span class="modal-pet-ref"></span>
                </p>
                <div class="video-meet-intro mb-4">
                    <div class="video-meet-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                    </div>
                    <p><?php esc_html_e('Meet your future furry friend from the comfort of your home! Schedule a live video call to see and interact with this adorable pet.', 'furrylicious'); ?></p>
                </div>
                <?php
                if (function_exists('gravity_form')) {
                    gravity_form(2, false, false, false, array(
                        'pet_id'   => '',
                        'pet_name' => '',
                        'pet_ref'  => '',
                        'form_type' => 'video_meeting'
                    ), true, 200);
                } else {
                    echo '<p>' . esc_html__('Contact form not available.', 'furrylicious') . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Unlock Promo Modal -->
<div class="modal fade" id="unlockPromoModal" tabindex="-1" aria-labelledby="unlockPromoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unlockPromoModalLabel"><?php esc_html_e('Unlock Special Pricing', 'furrylicious'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'furrylicious'); ?>"></button>
            </div>
            <div class="modal-body">
                <p class="modal-pet-info mb-3">
                    <strong><?php esc_html_e('Pet:', 'furrylicious'); ?></strong>
                    <span class="modal-pet-name"></span>
                    <span class="modal-pet-ref"></span>
                </p>
                <div class="unlock-promo-intro mb-4">
                    <div class="unlock-promo-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                        </svg>
                    </div>
                    <p><?php esc_html_e('Get exclusive promotional pricing on this adorable pet! Fill out the form below and we\'ll send you our special offer.', 'furrylicious'); ?></p>
                </div>
                <?php
                if (function_exists('gravity_form')) {
                    gravity_form(2, false, false, false, array(
                        'pet_id'   => '',
                        'pet_name' => '',
                        'pet_ref'  => '',
                        'form_type' => 'unlock_promo'
                    ), true, 300);
                } else {
                    echo '<p>' . esc_html__('Contact form not available.', 'furrylicious') . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * Product Modal Pet Data Population
 * Passes pet data to modals when opened
 */
(function() {
    'use strict';

    // Modal IDs to handle
    const modalIds = ['petEnquiryModal', 'videoMeetingModal', 'unlockPromoModal'];

    modalIds.forEach(function(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        modal.addEventListener('show.bs.modal', function(event) {
            const trigger = event.relatedTarget;
            if (!trigger) return;

            // Get pet data from trigger button data attributes
            const petId = trigger.dataset.petId || '';
            const petName = trigger.dataset.petName || '';
            const petRef = trigger.dataset.petRef || '';
            const breed = trigger.dataset.breed || '';

            // Update modal display elements
            const nameEl = modal.querySelector('.modal-pet-name');
            const refEl = modal.querySelector('.modal-pet-ref');

            if (nameEl) {
                nameEl.textContent = petName + (breed ? ' (' + breed + ')' : '');
            }
            if (refEl) {
                refEl.textContent = petRef ? ' - #' + petRef : '';
            }

            // Populate Gravity Forms hidden fields
            // Common field naming patterns for GF hidden fields
            const hiddenFieldSelectors = [
                'input[name*="pet_id"]',
                'input[name*="pet_name"]',
                'input[name*="pet_ref"]',
                'input[name*="reference"]',
                'input[name*="puppy_id"]',
                'input[name*="puppy_name"]'
            ];

            // Set pet ID fields
            modal.querySelectorAll('input[name*="pet_id"], input[name*="puppy_id"]').forEach(function(input) {
                input.value = petId;
            });

            // Set pet name fields
            modal.querySelectorAll('input[name*="pet_name"], input[name*="puppy_name"]').forEach(function(input) {
                input.value = petName;
            });

            // Set reference fields
            modal.querySelectorAll('input[name*="pet_ref"], input[name*="reference"]').forEach(function(input) {
                input.value = petRef;
            });

            // Also try to set fields by common GF parameter IDs
            // Look for hidden inputs within the form
            const forms = modal.querySelectorAll('form');
            forms.forEach(function(form) {
                // Try to find and populate common hidden field patterns
                const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
                hiddenInputs.forEach(function(input) {
                    const name = input.name.toLowerCase();
                    if (name.includes('pet') && name.includes('id')) {
                        input.value = petId;
                    } else if (name.includes('pet') && name.includes('name')) {
                        input.value = petName;
                    } else if (name.includes('ref') || name.includes('reference')) {
                        input.value = petRef;
                    }
                });
            });
        });
    });
})();
</script>
