/**
 * Carousel Module
 *
 * Initializes Swiper carousels for testimonials, puppy galleries, and other slideshows.
 * Uses Swiper 11+ with modern configuration.
 */

const Carousel = {
    // Store Swiper instances
    instances: {},

    /**
     * Initialize all carousels
     */
    init() {
        this.initTestimonialCarousel();
        this.initPuppyCarousel();
        this.initGalleryCarousel();
    },

    /**
     * Default Swiper options
     */
    getDefaultOptions() {
        return {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            a11y: {
                prevSlideMessage: 'Previous slide',
                nextSlideMessage: 'Next slide',
                paginationBulletMessage: 'Go to slide {{index}}',
            },
        };
    },

    /**
     * Initialize testimonial carousel
     */
    initTestimonialCarousel() {
        const element = document.querySelector('.testimonial-carousel');

        if (!element || typeof Swiper === 'undefined') {
            return;
        }

        const options = {
            ...this.getDefaultOptions(),
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.testimonial-carousel .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.testimonial-carousel .swiper-button-next',
                prevEl: '.testimonial-carousel .swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
            },
        };

        this.instances.testimonial = new Swiper('.testimonial-carousel', options);
    },

    /**
     * Initialize puppy carousel
     */
    initPuppyCarousel() {
        const element = document.querySelector('.puppy-carousel');

        if (!element || typeof Swiper === 'undefined') {
            return;
        }

        const options = {
            ...this.getDefaultOptions(),
            slidesPerView: 1,
            spaceBetween: 15,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.puppy-carousel .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 25,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        };

        this.instances.puppy = new Swiper('.puppy-carousel', options);
    },

    /**
     * Initialize gallery carousel (lightbox style)
     */
    initGalleryCarousel() {
        const element = document.querySelector('.gallery-carousel');

        if (!element || typeof Swiper === 'undefined') {
            return;
        }

        // Main gallery
        const galleryOptions = {
            ...this.getDefaultOptions(),
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: false,
            navigation: {
                nextEl: '.gallery-carousel .swiper-button-next',
                prevEl: '.gallery-carousel .swiper-button-prev',
            },
        };

        // Thumbs gallery
        const thumbsElement = document.querySelector('.gallery-thumbs');

        if (thumbsElement) {
            const thumbsSwiper = new Swiper('.gallery-thumbs', {
                slidesPerView: 4,
                spaceBetween: 10,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    768: {
                        slidesPerView: 5,
                    },
                    992: {
                        slidesPerView: 6,
                    },
                },
            });

            galleryOptions.thumbs = {
                swiper: thumbsSwiper,
            };

            this.instances.galleryThumbs = thumbsSwiper;
        }

        this.instances.gallery = new Swiper('.gallery-carousel', galleryOptions);
    },

    /**
     * Destroy all carousels
     */
    destroy() {
        Object.keys(this.instances).forEach((key) => {
            if (this.instances[key] && this.instances[key].destroy) {
                this.instances[key].destroy(true, true);
            }
        });
        this.instances = {};
    },

    /**
     * Reinitialize all carousels
     */
    reinit() {
        this.destroy();
        this.init();
    },

    /**
     * Get a specific Swiper instance
     */
    getInstance(name) {
        return this.instances[name] || null;
    },
};

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => Carousel.init());
} else {
    Carousel.init();
}

// Export for module usage
export default Carousel;
