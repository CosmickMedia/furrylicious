<?php
/**
 * Video Gallery Modal Template
 *
 * Modals for video playback and image display.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Video Modal -->
<div class="video-modal" id="video-modal" role="dialog" aria-modal="true" aria-labelledby="video-modal-title" hidden>
    <div class="video-modal__overlay"></div>
    <div class="video-modal__content">
        <button type="button" class="video-modal__close" aria-label="<?php esc_attr_e('Close video', 'furrylicious'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="video-modal__wrapper">
            <iframe id="video-modal-iframe"
                    src=""
                    title="<?php esc_attr_e('Video player', 'furrylicious'); ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
        <h2 class="video-modal__title sr-only" id="video-modal-title"><?php esc_html_e('Video Player', 'furrylicious'); ?></h2>
    </div>
</div>

<!-- Image Lightbox Modal -->
<div class="image-modal" id="image-modal" role="dialog" aria-modal="true" aria-labelledby="image-modal-title" hidden>
    <div class="image-modal__overlay"></div>
    <div class="image-modal__content">
        <button type="button" class="image-modal__close" aria-label="<?php esc_attr_e('Close image', 'furrylicious'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <img id="image-modal-img" src="" alt="" class="image-modal__img" />
        <h2 class="image-modal__title sr-only" id="image-modal-title"><?php esc_html_e('Image Viewer', 'furrylicious'); ?></h2>
    </div>
</div>
