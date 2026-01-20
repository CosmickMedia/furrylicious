/**
 * Forms Module
 *
 * Handles form enhancements, validation feedback, and multi-step form logic.
 */

const Forms = {
    /**
     * Initialize forms module
     */
    init() {
        this.enhanceInputs();
        this.initFloatingLabels();
        this.initFormValidation();
        this.handleGravityFormsEvents();
    },

    /**
     * Enhance input interactions
     */
    enhanceInputs() {
        const inputs = document.querySelectorAll('input, textarea, select');

        inputs.forEach((input) => {
            // Add focus class to parent
            input.addEventListener('focus', () => {
                input.closest('.gfield, .form-group')?.classList.add('is-focused');
            });

            input.addEventListener('blur', () => {
                input.closest('.gfield, .form-group')?.classList.remove('is-focused');

                // Add filled class if value exists
                if (input.value.trim()) {
                    input.closest('.gfield, .form-group')?.classList.add('is-filled');
                } else {
                    input.closest('.gfield, .form-group')?.classList.remove('is-filled');
                }
            });

            // Check initial state
            if (input.value.trim()) {
                input.closest('.gfield, .form-group')?.classList.add('is-filled');
            }
        });
    },

    /**
     * Initialize floating labels
     */
    initFloatingLabels() {
        const floatingFields = document.querySelectorAll('.form-floating');

        floatingFields.forEach((field) => {
            const input = field.querySelector('input, textarea');
            const label = field.querySelector('label');

            if (!input || !label) return;

            const updateLabel = () => {
                if (input.value || document.activeElement === input) {
                    field.classList.add('is-active');
                } else {
                    field.classList.remove('is-active');
                }
            };

            input.addEventListener('focus', updateLabel);
            input.addEventListener('blur', updateLabel);
            input.addEventListener('input', updateLabel);
            updateLabel();
        });
    },

    /**
     * Initialize form validation feedback
     */
    initFormValidation() {
        const forms = document.querySelectorAll('form:not(.gform_wrapper form)');

        forms.forEach((form) => {
            form.addEventListener('submit', (e) => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.showValidationErrors(form);
                }

                form.classList.add('was-validated');
            });
        });
    },

    /**
     * Show validation errors
     */
    showValidationErrors(form) {
        const invalidInputs = form.querySelectorAll(':invalid');

        invalidInputs.forEach((input) => {
            const field = input.closest('.gfield, .form-group');
            if (field) {
                field.classList.add('has-error');

                // Create or update error message
                let errorMsg = field.querySelector('.validation-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('span');
                    errorMsg.className = 'validation-message';
                    input.parentNode.insertBefore(errorMsg, input.nextSibling);
                }
                errorMsg.textContent = input.validationMessage;
            }
        });

        // Scroll to first error
        if (invalidInputs.length > 0) {
            invalidInputs[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
            invalidInputs[0].focus();
        }
    },

    /**
     * Handle Gravity Forms specific events
     */
    handleGravityFormsEvents() {
        // Listen for Gravity Forms render event
        document.addEventListener('gform_post_render', (event, formId) => {
            this.enhanceInputs();
        });

        // Listen for page change in multi-step forms
        document.addEventListener('gform_page_loaded', (event, formId, currentPage) => {
            // Scroll to form top on page change
            const form = document.getElementById(`gform_${formId}`);
            if (form) {
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            // Reinitialize enhancements
            this.enhanceInputs();
        });

        // Listen for confirmation
        document.addEventListener('gform_confirmation_loaded', (event, formId) => {
            const confirmation = document.querySelector(`#gform_confirmation_wrapper_${formId}`);
            if (confirmation) {
                confirmation.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    },

    /**
     * Phone number formatting
     */
    formatPhoneInput(input) {
        input.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');

            if (value.length > 10) {
                value = value.substring(0, 10);
            }

            if (value.length >= 6) {
                value = `(${value.substring(0, 3)}) ${value.substring(3, 6)}-${value.substring(6)}`;
            } else if (value.length >= 3) {
                value = `(${value.substring(0, 3)}) ${value.substring(3)}`;
            }

            e.target.value = value;
        });
    },

    /**
     * Initialize phone formatting on phone inputs
     */
    initPhoneFormatting() {
        const phoneInputs = document.querySelectorAll('input[type="tel"]');
        phoneInputs.forEach((input) => this.formatPhoneInput(input));
    },

    /**
     * ZIP code validation and lookup (placeholder for future enhancement)
     */
    validateZipCode(input) {
        const zipRegex = /^\d{5}(-\d{4})?$/;

        input.addEventListener('blur', () => {
            const value = input.value.trim();
            const isValid = zipRegex.test(value);

            const field = input.closest('.gfield, .form-group');
            if (field) {
                if (isValid || value === '') {
                    field.classList.remove('has-error');
                } else {
                    field.classList.add('has-error');
                }
            }
        });
    },
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => Forms.init());
} else {
    Forms.init();
}

// Export for module usage
export default Forms;
