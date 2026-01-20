/**
 * Scrollytelling Module
 *
 * Handles scroll-based animations and reveal effects using IntersectionObserver.
 * Provides smooth, performant scroll animations.
 */

const Scrollytelling = {
    // Configuration
    config: {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px',
        staggerDelay: 100,
    },

    // Observer instance
    observer: null,

    /**
     * Initialize scrollytelling
     */
    init() {
        if (!this.supportsIntersectionObserver()) {
            this.fallbackShow();
            return;
        }

        this.createObserver();
        this.observeElements();
        this.initParallax();
    },

    /**
     * Check for IntersectionObserver support
     */
    supportsIntersectionObserver() {
        return 'IntersectionObserver' in window &&
               'IntersectionObserverEntry' in window &&
               'intersectionRatio' in window.IntersectionObserverEntry.prototype;
    },

    /**
     * Create IntersectionObserver
     */
    createObserver() {
        this.observer = new IntersectionObserver(
            (entries) => this.handleIntersection(entries),
            {
                threshold: this.config.threshold,
                rootMargin: this.config.rootMargin,
            }
        );
    },

    /**
     * Handle intersection changes
     */
    handleIntersection(entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                this.revealElement(entry.target);

                // Unobserve after revealing (one-time animation)
                if (!entry.target.classList.contains('scroll-reveal--repeat')) {
                    this.observer.unobserve(entry.target);
                }
            } else if (entry.target.classList.contains('scroll-reveal--repeat')) {
                // Reset for repeat animations
                entry.target.classList.remove('is-visible');
            }
        });
    },

    /**
     * Reveal an element
     */
    revealElement(element) {
        // Handle staggered children
        if (element.classList.contains('scroll-reveal-stagger')) {
            this.revealStaggered(element);
        } else {
            element.classList.add('is-visible');
        }

        // Trigger custom event
        element.dispatchEvent(new CustomEvent('scrollReveal', {
            bubbles: true,
            detail: { element },
        }));
    },

    /**
     * Reveal staggered children
     */
    revealStaggered(container) {
        const children = container.children;

        container.classList.add('is-visible');

        Array.from(children).forEach((child, index) => {
            setTimeout(() => {
                child.style.opacity = '1';
                child.style.transform = 'translateY(0)';
            }, index * this.config.staggerDelay);
        });
    },

    /**
     * Observe all scroll-reveal elements
     */
    observeElements() {
        const elements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-stagger');

        elements.forEach((element) => {
            this.observer.observe(element);
        });
    },

    /**
     * Fallback for browsers without IntersectionObserver
     */
    fallbackShow() {
        const elements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-stagger');

        elements.forEach((element) => {
            element.classList.add('is-visible');
        });
    },

    /**
     * Initialize parallax effects
     */
    initParallax() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');

        if (parallaxElements.length === 0) {
            return;
        }

        // Use passive event listener for performance
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    this.updateParallax(parallaxElements);
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    },

    /**
     * Update parallax positions
     */
    updateParallax(elements) {
        const scrollTop = window.pageYOffset;

        elements.forEach((element) => {
            const speed = parseFloat(element.dataset.parallax) || 0.5;
            const rect = element.getBoundingClientRect();
            const elementTop = rect.top + scrollTop;

            if (this.isInViewport(rect)) {
                const yPos = (scrollTop - elementTop) * speed;
                element.style.transform = `translate3d(0, ${yPos}px, 0)`;
            }
        });
    },

    /**
     * Check if element is in viewport
     */
    isInViewport(rect) {
        return (
            rect.bottom >= 0 &&
            rect.right >= 0 &&
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.left <= (window.innerWidth || document.documentElement.clientWidth)
        );
    },

    /**
     * Add element to observe
     */
    observe(element) {
        if (this.observer) {
            this.observer.observe(element);
        }
    },

    /**
     * Stop observing element
     */
    unobserve(element) {
        if (this.observer) {
            this.observer.unobserve(element);
        }
    },

    /**
     * Refresh observer (useful after dynamic content load)
     */
    refresh() {
        this.observeElements();
    },

    /**
     * Destroy observer
     */
    destroy() {
        if (this.observer) {
            this.observer.disconnect();
            this.observer = null;
        }
    },
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => Scrollytelling.init());
} else {
    Scrollytelling.init();
}

// Export for module usage
export default Scrollytelling;
