/**
 * Accordion Module
 *
 * Accessible accordion component with smooth animations.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

(function() {
    'use strict';

    /**
     * Initialize all accordions on the page
     */
    function initAccordions() {
        const accordions = document.querySelectorAll('[data-accordion]');

        accordions.forEach(accordion => {
            new Accordion(accordion);
        });
    }

    /**
     * Accordion Class
     */
    class Accordion {
        constructor(element) {
            this.accordion = element;
            this.items = this.accordion.querySelectorAll('.accordion-item');
            this.allowMultiple = this.accordion.dataset.allowMultiple === 'true';

            this.init();
        }

        init() {
            this.items.forEach((item, index) => {
                const button = item.querySelector('.accordion-button');
                const content = item.querySelector('.accordion-content');

                if (!button || !content) return;

                // Set unique IDs
                const id = `accordion-${Date.now()}-${index}`;
                button.setAttribute('id', `${id}-button`);
                button.setAttribute('aria-controls', `${id}-content`);
                content.setAttribute('id', `${id}-content`);
                content.setAttribute('aria-labelledby', `${id}-button`);

                // Set initial state
                const isOpen = item.classList.contains('is-open');
                button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                content.setAttribute('aria-hidden', isOpen ? 'false' : 'true');

                // Add event listeners
                button.addEventListener('click', (e) => this.toggle(item, e));
                button.addEventListener('keydown', (e) => this.handleKeydown(e, index));
            });
        }

        toggle(item, event) {
            event.preventDefault();

            const button = item.querySelector('.accordion-button');
            const content = item.querySelector('.accordion-content');
            const isOpen = button.getAttribute('aria-expanded') === 'true';

            // Close other items if not allowing multiple
            if (!this.allowMultiple && !isOpen) {
                this.closeAll();
            }

            // Toggle current item
            if (isOpen) {
                this.close(item);
            } else {
                this.open(item);
            }
        }

        open(item) {
            const button = item.querySelector('.accordion-button');
            const content = item.querySelector('.accordion-content');

            item.classList.add('is-open');
            button.setAttribute('aria-expanded', 'true');
            content.setAttribute('aria-hidden', 'false');

            // Animate open
            this.animateOpen(content);
        }

        close(item) {
            const button = item.querySelector('.accordion-button');
            const content = item.querySelector('.accordion-content');

            item.classList.remove('is-open');
            button.setAttribute('aria-expanded', 'false');
            content.setAttribute('aria-hidden', 'true');
        }

        closeAll() {
            this.items.forEach(item => {
                if (item.classList.contains('is-open')) {
                    this.close(item);
                }
            });
        }

        animateOpen(content) {
            // Get the height of the content
            content.style.height = 'auto';
            const height = content.offsetHeight;

            // Start from 0
            content.style.height = '0';
            content.style.overflow = 'hidden';

            // Trigger reflow
            content.offsetHeight;

            // Animate to full height
            content.style.transition = 'height 0.3s ease-out';
            content.style.height = height + 'px';

            // Clean up after animation
            content.addEventListener('transitionend', function handler() {
                content.style.height = '';
                content.style.overflow = '';
                content.style.transition = '';
                content.removeEventListener('transitionend', handler);
            });
        }

        handleKeydown(event, index) {
            const buttons = Array.from(this.accordion.querySelectorAll('.accordion-button'));
            let newIndex;

            switch (event.key) {
                case 'ArrowDown':
                    event.preventDefault();
                    newIndex = (index + 1) % buttons.length;
                    buttons[newIndex].focus();
                    break;

                case 'ArrowUp':
                    event.preventDefault();
                    newIndex = (index - 1 + buttons.length) % buttons.length;
                    buttons[newIndex].focus();
                    break;

                case 'Home':
                    event.preventDefault();
                    buttons[0].focus();
                    break;

                case 'End':
                    event.preventDefault();
                    buttons[buttons.length - 1].focus();
                    break;
            }
        }
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAccordions);
    } else {
        initAccordions();
    }

    // Export for external use
    window.FurryliciousAccordion = Accordion;

})();
