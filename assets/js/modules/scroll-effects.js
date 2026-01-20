/**
 * Scroll Effects Module - Furrylicious Boutique
 *
 * Handles scroll-based animations including:
 * - Reveal animations (fade-up, fade-left, fade-right)
 * - Parallax effects
 * - Staggered animations
 */

const ScrollEffects = {
    // Configuration
    config: {
        revealThreshold: 0.15,      // Percentage of element visible to trigger
        revealRootMargin: '0px 0px -50px 0px',
        parallaxSpeed: 0.3,          // Parallax movement multiplier
        staggerDelay: 100,           // Default stagger delay in ms
    },

    // State
    state: {
        observer: null,
        parallaxElements: [],
        isReducedMotion: false,
    },

    /**
     * Initialize scroll effects
     */
    init() {
        // Check for reduced motion preference
        this.state.isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (this.state.isReducedMotion) {
            // Show all elements immediately without animation
            this.showAllElements();
            return;
        }

        this.setupRevealObserver();
        this.setupParallax();
        this.bindEvents();
    },

    /**
     * Set up Intersection Observer for reveal animations
     */
    setupRevealObserver() {
        const options = {
            root: null,
            rootMargin: this.config.revealRootMargin,
            threshold: this.config.revealThreshold,
        };

        this.state.observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    this.revealElement(entry.target);
                    this.state.observer.unobserve(entry.target);
                }
            });
        }, options);

        // Observe all elements with data-reveal attribute
        document.querySelectorAll('[data-reveal]').forEach((el) => {
            // Set initial state
            el.classList.add('reveal-hidden');
            this.state.observer.observe(el);
        });
    },

    /**
     * Reveal an element with animation
     */
    revealElement(element) {
        const delay = element.dataset.revealDelay || 0;
        const revealType = element.dataset.reveal || 'fade';

        setTimeout(() => {
            element.classList.remove('reveal-hidden');
            element.classList.add('reveal-visible', `reveal-${revealType}`);
        }, parseInt(delay, 10));
    },

    /**
     * Show all elements immediately (for reduced motion)
     */
    showAllElements() {
        document.querySelectorAll('[data-reveal]').forEach((el) => {
            el.classList.add('reveal-visible');
        });
    },

    /**
     * Set up parallax effects
     */
    setupParallax() {
        this.state.parallaxElements = document.querySelectorAll('[data-parallax]');

        if (this.state.parallaxElements.length > 0) {
            this.updateParallax();
        }
    },

    /**
     * Update parallax positions
     */
    updateParallax() {
        const scrollY = window.scrollY;

        this.state.parallaxElements.forEach((el) => {
            const speed = parseFloat(el.dataset.parallax) || this.config.parallaxSpeed;
            const rect = el.getBoundingClientRect();
            const elementTop = rect.top + scrollY;

            // Only apply parallax when element is in viewport
            if (scrollY + window.innerHeight > elementTop && scrollY < elementTop + rect.height) {
                const yPos = (scrollY - elementTop) * speed;
                el.style.transform = `translate3d(0, ${yPos}px, 0)`;
            }
        });
    },

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Parallax scroll handler
        if (this.state.parallaxElements.length > 0) {
            window.addEventListener('scroll', this.throttle(() => this.updateParallax(), 16));
        }

        // Handle resize
        window.addEventListener('resize', this.debounce(() => {
            this.updateParallax();
        }, 150));

        // Re-check reveal on orientation change
        window.addEventListener('orientationchange', () => {
            setTimeout(() => {
                document.querySelectorAll('[data-reveal].reveal-hidden').forEach((el) => {
                    if (this.isElementInViewport(el)) {
                        this.revealElement(el);
                    }
                });
            }, 100);
        });
    },

    /**
     * Check if element is in viewport
     */
    isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top < window.innerHeight &&
            rect.bottom > 0 &&
            rect.left < window.innerWidth &&
            rect.right > 0
        );
    },

    /**
     * Throttle function for scroll events
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
     * Debounce function for resize events
     */
    debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    },

    /**
     * Manually trigger reveal for dynamically added elements
     */
    observe(element) {
        if (this.state.isReducedMotion) {
            element.classList.add('reveal-visible');
            return;
        }

        element.classList.add('reveal-hidden');
        this.state.observer.observe(element);
    },

    /**
     * Cleanup
     */
    destroy() {
        if (this.state.observer) {
            this.state.observer.disconnect();
        }
    },
};

// Export for module usage - main.js handles initialization
export default ScrollEffects;
