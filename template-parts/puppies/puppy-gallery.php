<?php
/**
 * Template Part: Puppy Gallery
 *
 * Displays the image gallery for a puppy detail page.
 *
 * @package Furrylicious
 * @version 2.0.0
 *
 * @param string $main_image  Main image URL.
 * @param array  $gallery     Array of gallery image URLs.
 * @param string $alt_base    Base alt text for images.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get parameters
$main_image = isset($args['main_image']) ? $args['main_image'] : '';
$gallery = isset($args['gallery']) ? $args['gallery'] : array();
$alt_base = isset($args['alt_base']) ? $args['alt_base'] : 'Puppy photo';

// If no main image, try first gallery image
if (empty($main_image) && !empty($gallery)) {
    $main_image = $gallery[0];
}

// Fallback placeholder
if (empty($main_image)) {
    $main_image = FURRYLICIOUS_ASSETS . '/images/no-image.jpg';
}

// Combine for lightbox
$all_images = array_filter(array_merge(array($main_image), $gallery));
$all_images = array_unique($all_images);
?>

<div class="puppy-gallery">
    <!-- Main Image -->
    <div class="puppy-gallery__main">
        <a href="<?php echo esc_url($main_image); ?>" data-lightbox="puppy-gallery" data-alt="<?php echo esc_attr($alt_base); ?>">
            <img
                src="<?php echo esc_url($main_image); ?>"
                alt="<?php echo esc_attr($alt_base); ?>"
                class="puppy-gallery__image"
                id="puppy-main-image"
            />
        </a>
    </div>

    <!-- Thumbnails -->
    <?php if (count($all_images) > 1) : ?>
        <div class="puppy-gallery__thumbs">
            <div class="swiper gallery-thumbs">
                <div class="swiper-wrapper">
                    <?php foreach ($all_images as $index => $image) : ?>
                        <div class="swiper-slide">
                            <a
                                href="<?php echo esc_url($image); ?>"
                                data-lightbox="puppy-gallery"
                                data-alt="<?php echo esc_attr($alt_base . ' ' . ($index + 1)); ?>"
                                class="puppy-gallery__thumb<?php echo $index === 0 ? ' is-active' : ''; ?>"
                                data-image="<?php echo esc_url($image); ?>"
                            >
                                <img
                                    src="<?php echo esc_url($image); ?>"
                                    alt="<?php echo esc_attr($alt_base . ' thumbnail ' . ($index + 1)); ?>"
                                    loading="lazy"
                                />
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Thumbnail click handler
document.querySelectorAll('.puppy-gallery__thumb').forEach(thumb => {
    thumb.addEventListener('click', function(e) {
        if (e.target.closest('[data-lightbox]')) return; // Let lightbox handle it

        e.preventDefault();
        const newSrc = this.dataset.image;
        const mainImage = document.getElementById('puppy-main-image');

        if (mainImage && newSrc) {
            mainImage.src = newSrc;
            document.querySelectorAll('.puppy-gallery__thumb').forEach(t => t.classList.remove('is-active'));
            this.classList.add('is-active');
        }
    });
});
</script>
