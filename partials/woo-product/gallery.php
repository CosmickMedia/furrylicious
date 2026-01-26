<?php
/**
 * Puppy Gallery
 *
 * Image gallery with carousel and video support.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

$product_id   = $product->get_id();
$product_name = $product->get_name();
$embed_url    = $product->get_meta('video');
$coming_soon  = apply_filters('furrylicious_product_coming_soon', false, $product);

// Collect all images
$images = array();

// Featured image
$featured_img_id = get_post_thumbnail_id($product_id);
if ($featured_img_id) {
    $featured_img_url = wp_get_attachment_image_url($featured_img_id, 'large');
    if ($featured_img_url) {
        $images[] = array(
            'id'  => $featured_img_id,
            'url' => $featured_img_url,
        );
    }
}

// Gallery images
$gallery_image_ids = $product->get_gallery_image_ids();
if (!empty($gallery_image_ids)) {
    foreach ($gallery_image_ids as $img_id) {
        $img_url = wp_get_attachment_image_url($img_id, 'large');
        if ($img_url) {
            $images[] = array(
                'id'  => $img_id,
                'url' => $img_url,
            );
        }
    }
}

$img_count = count($images);
?>

<div class="puppy-gallery">
    <?php if ($coming_soon) : ?>
        <div class="puppy-gallery__badge puppy-gallery__badge--coming-soon">
            <?php esc_html_e('Coming Soon', 'furrylicious'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($embed_url)) : ?>
        <button class="puppy-gallery__video-btn" type="button" data-video-url="<?php echo esc_url($embed_url); ?>" aria-label="<?php esc_attr_e('Watch Video', 'furrylicious'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M8 5v14l11-7z"/>
            </svg>
            <span><?php esc_html_e('Watch Video', 'furrylicious'); ?></span>
        </button>
    <?php endif; ?>

    <?php if (empty($images)) : ?>
        <div class="puppy-gallery__placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            <p><?php esc_html_e('Photo coming soon', 'furrylicious'); ?></p>
        </div>
    <?php else : ?>
        <div class="puppy-gallery__main">
            <div class="puppy-gallery__slider" id="puppy-gallery-slider">
                <?php foreach ($images as $index => $image) : ?>
                    <div class="puppy-gallery__slide<?php echo $index === 0 ? ' puppy-gallery__slide--active' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                        <?php
                        echo wp_get_attachment_image(
                            $image['id'],
                            'large',
                            false,
                            array(
                                'class'   => 'puppy-gallery__image',
                                'alt'     => sprintf(__('%s - Image %d', 'furrylicious'), $product_name, $index + 1),
                                'loading' => $index === 0 ? 'eager' : 'lazy',
                            )
                        );
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($img_count > 1) : ?>
                <button class="puppy-gallery__nav puppy-gallery__nav--prev" type="button" aria-label="<?php esc_attr_e('Previous image', 'furrylicious'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="puppy-gallery__nav puppy-gallery__nav--next" type="button" aria-label="<?php esc_attr_e('Next image', 'furrylicious'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            <?php endif; ?>
        </div>

        <?php if ($img_count > 1) : ?>
            <div class="puppy-gallery__thumbnails">
                <?php foreach ($images as $index => $image) : ?>
                    <button class="puppy-gallery__thumb<?php echo $index === 0 ? ' puppy-gallery__thumb--active' : ''; ?>" type="button" data-index="<?php echo esc_attr($index); ?>" aria-label="<?php printf(esc_attr__('View image %d', 'furrylicious'), $index + 1); ?>">
                        <?php
                        echo wp_get_attachment_image(
                            $image['id'],
                            'thumbnail',
                            false,
                            array(
                                'class' => 'puppy-gallery__thumb-img',
                                'alt'   => '',
                            )
                        );
                        ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php if (!empty($embed_url)) : ?>
    <div class="puppy-video-modal" id="puppy-video-modal" hidden>
        <div class="puppy-video-modal__overlay"></div>
        <div class="puppy-video-modal__content">
            <button class="puppy-video-modal__close" type="button" aria-label="<?php esc_attr_e('Close video', 'furrylicious'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="puppy-video-modal__player">
                <iframe id="puppy-video-iframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<?php endif; ?>
