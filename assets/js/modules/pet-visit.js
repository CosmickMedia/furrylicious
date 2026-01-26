/**
 * Pet Visit Modal Module
 *
 * Handles the schedule visit modal functionality.
 *
 * @package Furrylicious
 */

class PetVisitModal {
    constructor() {
        this.modal = document.getElementById('visit-modal');
        this.overlay = null;
        this.closeBtn = null;
        this.triggers = null;
        this.isOpen = false;
        this.previousFocus = null;

        this.init();
    }

    init() {
        if (!this.modal) {
            return;
        }

        this.overlay = this.modal.querySelector('.visit-modal__overlay');
        this.closeBtn = this.modal.querySelector('.visit-modal__close');
        this.triggers = document.querySelectorAll('[data-visit-modal], .schedule-visit-btn');

        this.bindEvents();
    }

    bindEvents() {
        // Bind trigger clicks
        this.triggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                this.open();
            });
        });

        // Close button
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.close());
        }

        // Overlay click
        if (this.overlay) {
            this.overlay.addEventListener('click', () => this.close());
        }

        // Escape key
        document.addEventListener('keydown', (e) => {
            if (this.isOpen && e.key === 'Escape') {
                this.close();
            }
        });

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

        // Trigger animation
        requestAnimationFrame(() => {
            this.modal.classList.add('is-open');
            document.body.classList.add('modal-open');

            // Set focus to close button
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
    new PetVisitModal();
});

export default PetVisitModal;
