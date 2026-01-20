/**
 * Marquee Module - Furrylicious Boutique
 *
 * Handles infinite horizontal scroll animations for testimonials
 * and other marquee elements.
 */

const Marquee = {
    // Configuration
    config: {
        speed: 0.5,             // Pixels per frame
        pauseOnHover: true,     // Pause animation on hover
        direction: 'left',      // 'left' or 'right'
    },

    // State
    instances: [],

    /**
     * Initialize all marquee elements
     */
    init() {
        // Check for reduced motion preference
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            this.disableMarquees();
            return;
        }

        document.querySelectorAll('.marquee-track, [data-marquee]').forEach((track) => {
            this.createInstance(track);
        });
    },

    /**
     * Create a marquee instance
     */
    createInstance(track) {
        const container = track.parentElement;
        const speed = parseFloat(track.dataset.marqueeSpeed) || this.config.speed;
        const direction = track.dataset.marqueeDirection || this.config.direction;
        const pauseOnHover = track.dataset.marqueePause !== 'false';

        const instance = {
            track,
            container,
            speed,
            direction,
            pauseOnHover,
            position: 0,
            isPaused: false,
            animationId: null,
        };

        // Set up CSS for smooth animation
        track.style.display = 'flex';
        track.style.willChange = 'transform';

        // Bind events
        if (pauseOnHover) {
            container.addEventListener('mouseenter', () => {
                instance.isPaused = true;
            });

            container.addEventListener('mouseleave', () => {
                instance.isPaused = false;
            });
        }

        // Start animation
        this.animate(instance);
        this.instances.push(instance);

        return instance;
    },

    /**
     * Animate a marquee instance
     */
    animate(instance) {
        const { track, speed, direction, isPaused } = instance;

        if (!isPaused) {
            // Get the width of the first half of content (since it's duplicated)
            const contentWidth = track.scrollWidth / 2;

            // Move position
            if (direction === 'left') {
                instance.position -= speed;

                // Reset when first set of content has scrolled out
                if (Math.abs(instance.position) >= contentWidth) {
                    instance.position = 0;
                }
            } else {
                instance.position += speed;

                // Reset when first set of content has scrolled out
                if (instance.position >= contentWidth) {
                    instance.position = 0;
                }
            }

            // Apply transform
            track.style.transform = `translate3d(${instance.position}px, 0, 0)`;
        }

        instance.animationId = requestAnimationFrame(() => this.animate(instance));
    },

    /**
     * Disable marquees for reduced motion preference
     */
    disableMarquees() {
        document.querySelectorAll('.marquee-track, [data-marquee]').forEach((track) => {
            track.style.animation = 'none';
            track.style.transform = 'none';
        });
    },

    /**
     * Pause all marquees
     */
    pauseAll() {
        this.instances.forEach((instance) => {
            instance.isPaused = true;
        });
    },

    /**
     * Resume all marquees
     */
    resumeAll() {
        this.instances.forEach((instance) => {
            instance.isPaused = false;
        });
    },

    /**
     * Destroy a specific instance
     */
    destroyInstance(instance) {
        if (instance.animationId) {
            cancelAnimationFrame(instance.animationId);
        }
        const index = this.instances.indexOf(instance);
        if (index > -1) {
            this.instances.splice(index, 1);
        }
    },

    /**
     * Destroy all instances
     */
    destroy() {
        this.instances.forEach((instance) => {
            if (instance.animationId) {
                cancelAnimationFrame(instance.animationId);
            }
        });
        this.instances = [];
    },
};

// Export for module usage - main.js handles initialization
export default Marquee;
