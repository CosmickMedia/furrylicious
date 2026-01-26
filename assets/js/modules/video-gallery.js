/**
 * Video Gallery Module
 *
 * Handles video modal playback and image lightbox functionality.
 *
 * @package Furrylicious
 */

class VideoGallery {
    constructor() {
        this.videoModal = document.getElementById('video-modal');
        this.imageModal = document.getElementById('image-modal');
        this.videoIframe = document.getElementById('video-modal-iframe');
        this.imageElement = document.getElementById('image-modal-img');
        this.currentModal = null;
        this.previousFocus = null;

        this.init();
    }

    init() {
        this.bindVideoTriggers();
        this.bindImageTriggers();
        this.bindModalEvents();
    }

    bindVideoTriggers() {
        const videoTriggers = document.querySelectorAll('[data-video-url], .video-trigger');

        videoTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const videoUrl = trigger.dataset.videoUrl || trigger.href;
                if (videoUrl) {
                    this.openVideo(videoUrl);
                }
            });
        });
    }

    bindImageTriggers() {
        const imageTriggers = document.querySelectorAll('[data-lightbox], .lightbox-trigger');

        imageTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const imageUrl = trigger.dataset.lightbox || trigger.href;
                const imageAlt = trigger.dataset.alt || trigger.querySelector('img')?.alt || '';
                if (imageUrl) {
                    this.openImage(imageUrl, imageAlt);
                }
            });
        });
    }

    bindModalEvents() {
        // Video modal events
        if (this.videoModal) {
            const overlay = this.videoModal.querySelector('.video-modal__overlay');
            const closeBtn = this.videoModal.querySelector('.video-modal__close');

            if (overlay) {
                overlay.addEventListener('click', () => this.closeVideo());
            }
            if (closeBtn) {
                closeBtn.addEventListener('click', () => this.closeVideo());
            }
        }

        // Image modal events
        if (this.imageModal) {
            const overlay = this.imageModal.querySelector('.image-modal__overlay');
            const closeBtn = this.imageModal.querySelector('.image-modal__close');

            if (overlay) {
                overlay.addEventListener('click', () => this.closeImage());
            }
            if (closeBtn) {
                closeBtn.addEventListener('click', () => this.closeImage());
            }
        }

        // Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (this.currentModal === 'video') {
                    this.closeVideo();
                } else if (this.currentModal === 'image') {
                    this.closeImage();
                }
            }
        });
    }

    openVideo(url) {
        if (!this.videoModal || !this.videoIframe) return;

        // Store current focus
        this.previousFocus = document.activeElement;

        // Set video source
        this.videoIframe.src = url;

        // Show modal
        this.videoModal.removeAttribute('hidden');
        requestAnimationFrame(() => {
            this.videoModal.classList.add('is-open');
            document.body.classList.add('modal-open');
        });

        this.currentModal = 'video';

        // Focus close button
        const closeBtn = this.videoModal.querySelector('.video-modal__close');
        if (closeBtn) {
            closeBtn.focus();
        }
    }

    closeVideo() {
        if (!this.videoModal) return;

        this.videoModal.classList.remove('is-open');
        this.videoModal.classList.add('is-closing');
        document.body.classList.remove('modal-open');

        // Stop video
        if (this.videoIframe) {
            this.videoIframe.src = '';
        }

        setTimeout(() => {
            this.videoModal.setAttribute('hidden', '');
            this.videoModal.classList.remove('is-closing');
        }, 300);

        this.restoreFocus();
        this.currentModal = null;
    }

    openImage(url, alt = '') {
        if (!this.imageModal || !this.imageElement) return;

        // Store current focus
        this.previousFocus = document.activeElement;

        // Set image source
        this.imageElement.src = url;
        this.imageElement.alt = alt;

        // Show modal
        this.imageModal.removeAttribute('hidden');
        requestAnimationFrame(() => {
            this.imageModal.classList.add('is-open');
            document.body.classList.add('modal-open');
        });

        this.currentModal = 'image';

        // Focus close button
        const closeBtn = this.imageModal.querySelector('.image-modal__close');
        if (closeBtn) {
            closeBtn.focus();
        }
    }

    closeImage() {
        if (!this.imageModal) return;

        this.imageModal.classList.remove('is-open');
        this.imageModal.classList.add('is-closing');
        document.body.classList.remove('modal-open');

        setTimeout(() => {
            this.imageModal.setAttribute('hidden', '');
            this.imageModal.classList.remove('is-closing');
            if (this.imageElement) {
                this.imageElement.src = '';
            }
        }, 300);

        this.restoreFocus();
        this.currentModal = null;
    }

    restoreFocus() {
        if (this.previousFocus) {
            this.previousFocus.focus();
            this.previousFocus = null;
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new VideoGallery();
});

export default VideoGallery;
