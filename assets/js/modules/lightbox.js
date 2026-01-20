/**
 * Lightbox Module
 *
 * Simple, accessible lightbox for image galleries.
 */

const Lightbox = {
    // State
    state: {
        isOpen: false,
        currentIndex: 0,
        images: [],
    },

    // Elements
    elements: {
        lightbox: null,
        image: null,
        prevBtn: null,
        nextBtn: null,
        closeBtn: null,
        counter: null,
    },

    /**
     * Initialize lightbox
     */
    init() {
        this.createLightbox();
        this.bindEvents();
    },

    /**
     * Create lightbox HTML
     */
    createLightbox() {
        // Check if already exists
        if (document.getElementById('lightbox')) {
            return;
        }

        const lightbox = document.createElement('div');
        lightbox.id = 'lightbox';
        lightbox.className = 'lightbox';
        lightbox.setAttribute('role', 'dialog');
        lightbox.setAttribute('aria-modal', 'true');
        lightbox.setAttribute('aria-label', 'Image lightbox');

        lightbox.innerHTML = `
            <button class="lightbox__close" aria-label="Close lightbox">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>

            <button class="lightbox__nav lightbox__nav--prev" aria-label="Previous image">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>

            <img class="lightbox__image" src="" alt="" />

            <button class="lightbox__nav lightbox__nav--next" aria-label="Next image">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </button>

            <div class="lightbox__counter" aria-live="polite"></div>
        `;

        document.body.appendChild(lightbox);

        // Cache elements
        this.elements.lightbox = lightbox;
        this.elements.image = lightbox.querySelector('.lightbox__image');
        this.elements.prevBtn = lightbox.querySelector('.lightbox__nav--prev');
        this.elements.nextBtn = lightbox.querySelector('.lightbox__nav--next');
        this.elements.closeBtn = lightbox.querySelector('.lightbox__close');
        this.elements.counter = lightbox.querySelector('.lightbox__counter');
    },

    /**
     * Bind events
     */
    bindEvents() {
        // Gallery image clicks
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('[data-lightbox]');
            if (trigger) {
                e.preventDefault();
                this.openFromTrigger(trigger);
            }
        });

        // Lightbox controls
        if (this.elements.closeBtn) {
            this.elements.closeBtn.addEventListener('click', () => this.close());
        }

        if (this.elements.prevBtn) {
            this.elements.prevBtn.addEventListener('click', () => this.prev());
        }

        if (this.elements.nextBtn) {
            this.elements.nextBtn.addEventListener('click', () => this.next());
        }

        // Click outside to close
        if (this.elements.lightbox) {
            this.elements.lightbox.addEventListener('click', (e) => {
                if (e.target === this.elements.lightbox) {
                    this.close();
                }
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!this.state.isOpen) return;

            switch (e.key) {
                case 'Escape':
                    this.close();
                    break;
                case 'ArrowLeft':
                    this.prev();
                    break;
                case 'ArrowRight':
                    this.next();
                    break;
            }
        });

        // Touch swipe support
        this.initTouchEvents();
    },

    /**
     * Initialize touch events for mobile swipe
     */
    initTouchEvents() {
        if (!this.elements.lightbox) return;

        let touchStartX = 0;
        let touchEndX = 0;

        this.elements.lightbox.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        this.elements.lightbox.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe(touchStartX, touchEndX);
        }, { passive: true });
    },

    /**
     * Handle swipe gesture
     */
    handleSwipe(startX, endX) {
        const threshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                this.next();
            } else {
                this.prev();
            }
        }
    },

    /**
     * Open lightbox from trigger element
     */
    openFromTrigger(trigger) {
        const group = trigger.dataset.lightbox;
        const triggers = document.querySelectorAll(`[data-lightbox="${group}"]`);

        this.state.images = Array.from(triggers).map((t) => ({
            src: t.href || t.dataset.src,
            alt: t.dataset.alt || t.querySelector('img')?.alt || '',
        }));

        this.state.currentIndex = Array.from(triggers).indexOf(trigger);
        this.open();
    },

    /**
     * Open lightbox
     */
    open() {
        this.state.isOpen = true;
        this.elements.lightbox.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        this.updateImage();
        this.updateNavigation();

        // Focus management
        this.elements.closeBtn.focus();
    },

    /**
     * Close lightbox
     */
    close() {
        this.state.isOpen = false;
        this.elements.lightbox.classList.remove('is-open');
        document.body.style.overflow = '';
    },

    /**
     * Go to previous image
     */
    prev() {
        if (this.state.images.length <= 1) return;

        this.state.currentIndex =
            (this.state.currentIndex - 1 + this.state.images.length) % this.state.images.length;
        this.updateImage();
        this.updateNavigation();
    },

    /**
     * Go to next image
     */
    next() {
        if (this.state.images.length <= 1) return;

        this.state.currentIndex =
            (this.state.currentIndex + 1) % this.state.images.length;
        this.updateImage();
        this.updateNavigation();
    },

    /**
     * Update displayed image
     */
    updateImage() {
        const image = this.state.images[this.state.currentIndex];
        if (!image) return;

        // Add loading state
        this.elements.image.style.opacity = '0.5';

        // Load new image
        const img = new Image();
        img.onload = () => {
            this.elements.image.src = image.src;
            this.elements.image.alt = image.alt;
            this.elements.image.style.opacity = '1';
        };
        img.src = image.src;

        // Update counter
        this.elements.counter.textContent =
            `${this.state.currentIndex + 1} / ${this.state.images.length}`;
    },

    /**
     * Update navigation visibility
     */
    updateNavigation() {
        const hasMultiple = this.state.images.length > 1;
        this.elements.prevBtn.style.display = hasMultiple ? 'block' : 'none';
        this.elements.nextBtn.style.display = hasMultiple ? 'block' : 'none';
        this.elements.counter.style.display = hasMultiple ? 'block' : 'none';
    },

    /**
     * Open with specific images array
     */
    openWithImages(images, startIndex = 0) {
        this.state.images = images;
        this.state.currentIndex = startIndex;
        this.open();
    },
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => Lightbox.init());
} else {
    Lightbox.init();
}

// Export for module usage
export default Lightbox;
