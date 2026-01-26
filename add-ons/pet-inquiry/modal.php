<?php
/**
 * Pet Inquiry Modal Template
 *
 * Modal content for quick puppy inquiries without leaving the page.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$puppy_id = isset($_POST['puppy_id']) ? intval($_POST['puppy_id']) : 0;

if (!$puppy_id) {
    return;
}

$product = wc_get_product($puppy_id);

if (!$product) {
    return;
}

$puppy_name = $product->get_meta('pet_name') ?: '';
$puppy_breed = strip_tags(wc_get_product_category_list($puppy_id, ', ', '', ''));
$ref_id = $product->get_meta('reference_number') ?: '';
$img_id = $product->get_image_id();
$gravity_form_id = get_field('gravity_form_id', 'option') ?: 1;
?>

<div class="inquiry-modal" id="inquiry-modal">
    <div class="inquiry-modal__overlay"></div>
    <div class="inquiry-modal__content">
        <button type="button" class="inquiry-modal__close" aria-label="<?php esc_attr_e('Close modal', 'furrylicious'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <div class="inquiry-modal__header">
            <div class="inquiry-modal__puppy">
                <?php if ($img_id) : ?>
                    <div class="inquiry-modal__image">
                        <?php echo wp_get_attachment_image($img_id, 'thumbnail', false, array('class' => 'inquiry-modal__img')); ?>
                    </div>
                <?php endif; ?>
                <div class="inquiry-modal__info">
                    <?php if ($puppy_name) : ?>
                        <p class="inquiry-modal__name"><?php echo esc_html($puppy_name); ?></p>
                    <?php endif; ?>
                    <p class="inquiry-modal__breed"><?php echo esc_html($puppy_breed); ?></p>
                    <?php if ($ref_id) : ?>
                        <p class="inquiry-modal__ref">ID: <?php echo esc_html($ref_id); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <h2 class="inquiry-modal__title"><?php esc_html_e('Quick Inquiry', 'furrylicious'); ?></h2>
        </div>

        <div class="inquiry-modal__body">
            <?php
            if (function_exists('gravity_form')) {
                $field_values = array(
                    'puppy_name'  => $puppy_name,
                    'puppy_breed' => $puppy_breed,
                    'puppy_id'    => $puppy_id,
                    'reference_id' => $ref_id,
                );

                gravity_form($gravity_form_id, false, false, false, $field_values, true, 0);
            } else {
                ?>
                <div class="inquiry-modal__fallback">
                    <p><?php esc_html_e('Please contact us to inquire about this puppy:', 'furrylicious'); ?></p>
                    <?php
                    $phone = get_field('phone', 'option');
                    $email = get_field('email', 'option');

                    if ($phone) : ?>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn btn--primary">
                            <?php echo esc_html($phone); ?>
                        </a>
                    <?php endif;

                    if ($email) : ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>" class="btn btn--secondary">
                            <?php esc_html_e('Email Us', 'furrylicious'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
