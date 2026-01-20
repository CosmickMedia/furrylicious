/**
 * Form Enhancements Module - Furrylicious Boutique
 *
 * Handles form interactions including:
 * - Floating labels
 * - Input validation feedback
 * - Form submission states
 * - Chip selection interactions
 */

const FormEnhancements = {
    // Configuration
    config: {
        floatingLabelClass: 'form-field--floating',
        activeClass: 'is-active',
        filledClass: 'is-filled',
        errorClass: 'has-error',
        successClass: 'has-success',
    },

    /**
     * Initialize form enhancements
     */
    init() {
        this.setupFloatingLabels();
        this.setupValidation();
        this.setupChipSelectors();
        this.setupFormSubmit();
    },

    /**
     * Set up floating labels
     */
    setupFloatingLabels() {
        const floatingFields = document.querySelectorAll(`.${this.config.floatingLabelClass}`);

        floatingFields.forEach((field) => {
            const input = field.querySelector('input, textarea, select');

            if (!input) return;

            // Check initial state
            if (input.value) {
                field.classList.add(this.config.filledClass);
            }

            // Focus event
            input.addEventListener('focus', () => {
                field.classList.add(this.config.activeClass);
            });

            // Blur event
            input.addEventListener('blur', () => {
                field.classList.remove(this.config.activeClass);

                if (input.value) {
                    field.classList.add(this.config.filledClass);
                } else {
                    field.classList.remove(this.config.filledClass);
                }
            });

            // Input event for real-time filled state
            input.addEventListener('input', () => {
                if (input.value) {
                    field.classList.add(this.config.filledClass);
                } else {
                    field.classList.remove(this.config.filledClass);
                }
            });

            // Handle autofill
            input.addEventListener('animationstart', (e) => {
                if (e.animationName === 'onAutoFillStart') {
                    field.classList.add(this.config.filledClass);
                }
            });
        });
    },

    /**
     * Set up validation feedback
     */
    setupValidation() {
        const forms = document.querySelectorAll('form');

        forms.forEach((form) => {
            const inputs = form.querySelectorAll('input, textarea, select');

            inputs.forEach((input) => {
                // Validate on blur
                input.addEventListener('blur', () => {
                    this.validateField(input);
                });

                // Clear error on input
                input.addEventListener('input', () => {
                    const field = input.closest('.form-field');
                    if (field) {
                        field.classList.remove(this.config.errorClass);
                    }
                });
            });
        });
    },

    /**
     * Validate a single field
     */
    validateField(input) {
        const field = input.closest('.form-field');
        if (!field) return true;

        let isValid = true;

        // Required check
        if (input.required && !input.value.trim()) {
            isValid = false;
        }

        // Email validation
        if (input.type === 'email' && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                isValid = false;
            }
        }

        // Phone validation
        if (input.type === 'tel' && input.value) {
            const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
            if (!phoneRegex.test(input.value)) {
                isValid = false;
            }
        }

        // Update field state
        field.classList.toggle(this.config.errorClass, !isValid);
        field.classList.toggle(this.config.successClass, isValid && input.value);

        return isValid;
    },

    /**
     * Set up chip selector interactions (breed/gender preferences)
     */
    setupChipSelectors() {
        // Checkbox chips
        document.querySelectorAll('.lead-capture__breed-option, [data-chip-checkbox]').forEach((label) => {
            const checkbox = label.querySelector('input[type="checkbox"]');

            if (checkbox) {
                checkbox.addEventListener('change', () => {
                    label.classList.toggle('is-selected', checkbox.checked);
                });
            }
        });

        // Radio chips
        document.querySelectorAll('.lead-capture__gender-option, [data-chip-radio]').forEach((label) => {
            const radio = label.querySelector('input[type="radio"]');

            if (radio) {
                radio.addEventListener('change', () => {
                    // Remove selected from siblings
                    const name = radio.name;
                    document.querySelectorAll(`input[name="${name}"]`).forEach((r) => {
                        r.closest('label').classList.remove('is-selected');
                    });

                    // Add selected to current
                    label.classList.add('is-selected');
                });

                // Initialize checked state
                if (radio.checked) {
                    label.classList.add('is-selected');
                }
            }
        });
    },

    /**
     * Set up form submission handling
     */
    setupFormSubmit() {
        document.querySelectorAll('.lead-capture__form, [data-enhanced-form]').forEach((form) => {
            form.addEventListener('submit', (e) => {
                // Validate all required fields
                const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
                let allValid = true;

                inputs.forEach((input) => {
                    if (!this.validateField(input)) {
                        allValid = false;
                    }
                });

                if (!allValid) {
                    e.preventDefault();

                    // Focus first error field
                    const firstError = form.querySelector(`.${this.config.errorClass} input, .${this.config.errorClass} textarea`);
                    if (firstError) {
                        firstError.focus();
                    }

                    return;
                }

                // Add loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('is-loading');
                    submitBtn.disabled = true;
                }
            });
        });
    },

    /**
     * Show success message
     */
    showSuccess(form, message = 'Thank you! We\'ll be in touch soon.') {
        const successEl = document.createElement('div');
        successEl.className = 'form-success';
        successEl.innerHTML = `
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p>${message}</p>
        `;

        form.innerHTML = '';
        form.appendChild(successEl);
    },

    /**
     * Show error message
     */
    showError(form, message = 'Something went wrong. Please try again.') {
        const existingError = form.querySelector('.form-error-message');
        if (existingError) {
            existingError.remove();
        }

        const errorEl = document.createElement('div');
        errorEl.className = 'form-error-message';
        errorEl.textContent = message;

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.parentNode.insertBefore(errorEl, submitBtn);
            submitBtn.classList.remove('is-loading');
            submitBtn.disabled = false;
        }
    },
};

// Export for module usage - main.js handles initialization
export default FormEnhancements;
