/**
 * Pet Inquiry Modal Module
 *
 * Handles the quick inquiry modal functionality.
 *
 * @package Furrylicious
 */

class InquiryModal {
    constructor() {
        this.modal = null;
        this.overlay = null;
        this.closeBtn = null;
        this.triggers = null;
        this.isOpen = false;
        this.previousFocus = null;

        this.init();
    }

    init() {
        // Find trigger buttons
        this.triggers = document.querySelectorAll('[data-inquiry-modal]');

        if (!this.triggers.length) {
            return;
        }

        this.bindEvents();
    }

    bindEvents() {
        // Bind trigger clicks
        this.triggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const puppyId = trigger.dataset.puppyId;
                if (puppyId) {
                    this.loadModal(puppyId);
                }
            });
        });

        // Handle keyboard events
        document.addEventListener('keydown', (e) => {
            if (this.isOpen && e.key === 'Escape') {
                this.close();
            }
        });
    }

    async loadModal(puppyId) {
        // Show loading state on trigger
        const trigger = document.querySelector(`[data-puppy-id="${puppyId}"]`);
        if (trigger) {
            trigger.classList.add('is-loading');
        }

        try {
            const response = await fetch(furryliciousInquiry.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'furrylicious_load_inquiry_modal',
                    nonce: furryliciousInquiry.nonce,
                    puppy_id: puppyId,
                }),
            });

            const data = await response.json();

            if (data.success && data.data.html) {
                this.insertModal(data.data.html);
                this.open();
            }
        } catch (error) {
            console.error('Failed to load inquiry modal:', error);
        } finally {
            if (trigger) {
                trigger.classList.remove('is-loading');
            }
        }
    }

    insertModal(html) {
        // Remove any existing modal
        const existingModal = document.getElementById('inquiry-modal');
        if (existingModal) {
            existingModal.remove();
        }

        // Insert new modal
        document.body.insertAdjacentHTML('beforeend', html);

        // Get references
        this.modal = document.getElementById('inquiry-modal');
        this.overlay = this.modal.querySelector('.inquiry-modal__overlay');
        this.closeBtn = this.modal.querySelector('.inquiry-modal__close');

        // Bind modal events
        this.bindModalEvents();
    }

    bindModalEvents() {
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.close());
        }

        if (this.overlay) {
            this.overlay.addEventListener('click', () => this.close());
        }

        // Trap focus within modal
        this.modal.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                this.trapFocus(e);
            }
        });
    }

    open() {
        if (!this.modal) return;

        // Store current focus
        this.previousFocus = document.activeElement;

        // Show modal
        this.modal.removeAttribute('hidden');
        this.modal.classList.add('is-open');
        document.body.classList.add('modal-open');

        // Set focus to close button
        requestAnimationFrame(() => {
            if (this.closeBtn) {
                this.closeBtn.focus();
            }
        });

        this.isOpen = true;
    }

    close() {
        if (!this.modal) return;

        this.modal.classList.remove('is-open');
        this.modal.classList.add('is-closing');
        document.body.classList.remove('modal-open');

        // Wait for animation
        setTimeout(() => {
            this.modal.setAttribute('hidden', '');
            this.modal.classList.remove('is-closing');
            this.modal.remove();
            this.modal = null;
        }, 300);

        // Restore focus
        if (this.previousFocus) {
            this.previousFocus.focus();
        }

        this.isOpen = false;
    }

    trapFocus(e) {
        const focusableElements = this.modal.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );

        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === firstFocusable) {
                e.preventDefault();
                lastFocusable.focus();
            }
        } else {
            if (document.activeElement === lastFocusable) {
                e.preventDefault();
                firstFocusable.focus();
            }
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new InquiryModal();
});

export default InquiryModal;
