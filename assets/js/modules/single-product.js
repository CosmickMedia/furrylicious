/**
 * Single Product (Puppy Detail) JavaScript
 *
 * Handles gallery slider, tabs, and video modal functionality.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

export function initSingleProduct() {
    initGallery();
    initTabs();
    initVideoModal();
}

/**
 * Gallery Slider
 */
function initGallery() {
    const slider = document.getElementById('puppy-gallery-slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.puppy-gallery__slide');
    const thumbs = document.querySelectorAll('.puppy-gallery__thumb');
    const prevBtn = document.querySelector('.puppy-gallery__nav--prev');
    const nextBtn = document.querySelector('.puppy-gallery__nav--next');

    if (slides.length <= 1) return;

    let currentIndex = 0;

    function showSlide(index) {
        // Handle wrapping
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;

        // Update slides
        slides.forEach((slide, i) => {
            slide.classList.toggle('puppy-gallery__slide--active', i === index);
        });

        // Update thumbnails
        thumbs.forEach((thumb, i) => {
            thumb.classList.toggle('puppy-gallery__thumb--active', i === index);
        });

        currentIndex = index;
    }

    // Navigation buttons
    if (prevBtn) {
        prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
    }

    // Thumbnail clicks
    thumbs.forEach((thumb, index) => {
        thumb.addEventListener('click', () => showSlide(index));
    });

    // Keyboard navigation
    slider.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            showSlide(currentIndex - 1);
        } else if (e.key === 'ArrowRight') {
            showSlide(currentIndex + 1);
        }
    });

    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                showSlide(currentIndex + 1); // Swipe left - next
            } else {
                showSlide(currentIndex - 1); // Swipe right - prev
            }
        }
    }
}

/**
 * Tabs
 */
function initTabs() {
    const tabButtons = document.querySelectorAll('.puppy-tabs__tab');
    const tabPanels = document.querySelectorAll('.puppy-tabs__panel');

    if (!tabButtons.length) return;

    tabButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('aria-controls');
            const targetPanel = document.getElementById(targetId);

            if (!targetPanel) return;

            // Update buttons
            tabButtons.forEach((btn) => {
                btn.classList.remove('puppy-tabs__tab--active');
                btn.setAttribute('aria-selected', 'false');
            });

            button.classList.add('puppy-tabs__tab--active');
            button.setAttribute('aria-selected', 'true');

            // Update panels
            tabPanels.forEach((panel) => {
                panel.classList.remove('puppy-tabs__panel--active');
                panel.setAttribute('hidden', '');
            });

            targetPanel.classList.add('puppy-tabs__panel--active');
            targetPanel.removeAttribute('hidden');
        });

        // Keyboard navigation between tabs
        button.addEventListener('keydown', (e) => {
            const buttons = Array.from(tabButtons);
            const currentIndex = buttons.indexOf(button);
            let newIndex;

            switch (e.key) {
                case 'ArrowLeft':
                    newIndex = currentIndex > 0 ? currentIndex - 1 : buttons.length - 1;
                    buttons[newIndex].focus();
                    buttons[newIndex].click();
                    e.preventDefault();
                    break;
                case 'ArrowRight':
                    newIndex = currentIndex < buttons.length - 1 ? currentIndex + 1 : 0;
                    buttons[newIndex].focus();
                    buttons[newIndex].click();
                    e.preventDefault();
                    break;
                case 'Home':
                    buttons[0].focus();
                    buttons[0].click();
                    e.preventDefault();
                    break;
                case 'End':
                    buttons[buttons.length - 1].focus();
                    buttons[buttons.length - 1].click();
                    e.preventDefault();
                    break;
            }
        });
    });
}

/**
 * Video Modal
 */
function initVideoModal() {
    const modal = document.getElementById('puppy-video-modal');
    const videoBtn = document.querySelector('.puppy-gallery__video-btn');
    const iframe = document.getElementById('puppy-video-iframe');

    if (!modal || !videoBtn || !iframe) return;

    const closeBtn = modal.querySelector('.puppy-video-modal__close');
    const overlay = modal.querySelector('.puppy-video-modal__overlay');

    function openModal() {
        const videoUrl = videoBtn.dataset.videoUrl;
        if (!videoUrl) return;

        // Convert YouTube/Vimeo URLs to embed format
        let embedUrl = videoUrl;

        if (videoUrl.includes('youtube.com/watch')) {
            const videoId = new URL(videoUrl).searchParams.get('v');
            embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        } else if (videoUrl.includes('youtu.be')) {
            const videoId = videoUrl.split('/').pop();
            embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        } else if (videoUrl.includes('vimeo.com')) {
            const videoId = videoUrl.split('/').pop();
            embedUrl = `https://player.vimeo.com/video/${videoId}?autoplay=1`;
        }

        iframe.src = embedUrl;
        modal.removeAttribute('hidden');
        document.body.style.overflow = 'hidden';

        // Focus trap
        closeBtn.focus();
    }

    function closeModal() {
        iframe.src = '';
        modal.setAttribute('hidden', '');
        document.body.style.overflow = '';
        videoBtn.focus();
    }

    videoBtn.addEventListener('click', openModal);

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.hasAttribute('hidden')) {
            closeModal();
        }
    });
}

// Auto-initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSingleProduct);
} else {
    initSingleProduct();
}
