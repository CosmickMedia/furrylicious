/**
 * Main JavaScript - Furrylicious Boutique
 *
 * Module orchestration and global initialization.
 * Imports and coordinates all theme modules.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

// Import modules
import Navigation from './modules/navigation.js';
import FormEnhancements from './modules/form-enhancements.js';
import { initSingleProduct } from './modules/single-product.js';

(function() {
    'use strict';

    /**
     * Furrylicious Theme Object
     */
    window.Furrylicious = window.Furrylicious || {};

    /**
     * Configuration
     */
    Furrylicious.config = {
        breakpoints: {
            sm: 576,
            md: 768,
            lg: 1024,
            xl: 1280,
            xxl: 1536,
        },
        animationDuration: 300,
        headerHeight: 80,
    };

    /**
     * Module references
     */
    Furrylicious.modules = {
        navigation: Navigation,
        forms: FormEnhancements,
        singleProduct: initSingleProduct,
    };

    /**
     * Utility Functions
     */
    Furrylicious.utils = {
        /**
         * Debounce function
         */
        debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        /**
         * Throttle function
         */
        throttle(func, limit) {
            let inThrottle;
            return function(...args) {
                if (!inThrottle) {
                    func.apply(this, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        },

        /**
         * Check if element is in viewport
         */
        isInViewport(element, threshold = 0) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) - threshold &&
                rect.bottom >= 0 + threshold
            );
        },

        /**
         * Get current breakpoint
         */
        getBreakpoint() {
            const width = window.innerWidth;
            const breakpoints = Furrylicious.config.breakpoints;

            if (width >= breakpoints.xxl) return 'xxl';
            if (width >= breakpoints.xl) return 'xl';
            if (width >= breakpoints.lg) return 'lg';
            if (width >= breakpoints.md) return 'md';
            if (width >= breakpoints.sm) return 'sm';
            return 'xs';
        },

        /**
         * Check if touch device
         */
        isTouchDevice() {
            return (
                'ontouchstart' in window ||
                navigator.maxTouchPoints > 0 ||
                navigator.msMaxTouchPoints > 0
            );
        },

        /**
         * Smooth scroll to element
         */
        scrollTo(target, offset = 0) {
            const element = typeof target === 'string'
                ? document.querySelector(target)
                : target;

            if (!element) return;

            const top = element.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
                top: top,
                behavior: 'smooth'
            });
        },

        /**
         * Check for reduced motion preference
         */
        prefersReducedMotion() {
            return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        },
    };

    /**
     * Initialize Lazy Loading for Images
     */
    Furrylicious.lazyLoad = function() {
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        } else {
            const lazyImages = document.querySelectorAll('img[data-src]');

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                });

                lazyImages.forEach(img => imageObserver.observe(img));
            } else {
                lazyImages.forEach(img => {
                    img.src = img.dataset.src;
                });
            }
        }
    };

    /**
     * Initialize Smooth Scroll for Anchor Links
     */
    Furrylicious.smoothScroll = function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');

                if (targetId === '#' || targetId === '#0') return;

                const target = document.querySelector(targetId);
                if (!target) return;

                e.preventDefault();

                const header = document.querySelector('.site-header');
                const offset = header ? header.offsetHeight : Furrylicious.config.headerHeight;

                Furrylicious.utils.scrollTo(target, offset);
                history.pushState(null, null, targetId);
            });
        });
    };

    /**
     * Initialize External Link Handler
     */
    Furrylicious.externalLinks = function() {
        document.querySelectorAll('a[href^="http"]').forEach(link => {
            if (link.href.includes(window.location.hostname)) return;

            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');

            if (!link.querySelector('.screen-reader-text')) {
                const srText = document.createElement('span');
                srText.className = 'screen-reader-text';
                srText.textContent = ' (opens in a new tab)';
                link.appendChild(srText);
            }
        });
    };

    /**
     * Initialize Reduced Motion Support
     */
    Furrylicious.reducedMotion = function() {
        const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

        function handleChange() {
            if (mediaQuery.matches) {
                document.documentElement.classList.add('reduce-motion');
            } else {
                document.documentElement.classList.remove('reduce-motion');
            }
        }

        handleChange();
        mediaQuery.addEventListener('change', handleChange);
    };

    /**
     * Main Initialization
     */
    Furrylicious.init = function() {
        // Initialize navigation module (header scroll state, mobile menu, search overlay)
        this.modules.navigation.init();

        // Core functionality
        this.lazyLoad();
        this.smoothScroll();
        this.externalLinks();
        this.reducedMotion();

        // Add loaded class for CSS transitions
        document.documentElement.classList.add('js-loaded');

        // Add touch/no-touch class
        if (this.utils.isTouchDevice()) {
            document.documentElement.classList.add('is-touch');
        } else {
            document.documentElement.classList.add('no-touch');
        }
    };

    /**
     * DOM Ready Handler
     */
    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    // Initialize when DOM is ready
    ready(function() {
        Furrylicious.init();
    });

    // Expose to global scope
    window.Furrylicious = Furrylicious;

})();
