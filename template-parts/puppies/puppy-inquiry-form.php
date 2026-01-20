<?php
/**
 * Template Part: Puppy Inquiry Form
 *
 * Displays the inquiry form for puppy detail pages.
 *
 * @package Furrylicious
 * @version 2.0.0
 *
 * @param object $puppy Puppy data object.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get puppy data
$puppy = isset($args['puppy']) ? $args['puppy'] : null;

// Get contact info
$contact = furrylicious_get_contact_info();
$phone = $contact['phone'];

// Get form settings
$form_id = furrylicious_get_option('inquiry_form_id', 2);

// Check if using Petkey Gallery settings
global $petkey_gallery_settings;
if (!empty($petkey_gallery_settings->petkey_gallery_enquiry)) {
    $form_id = $petkey_gallery_settings->petkey_gallery_enquiry;
}
?>

<div class="puppy-inquiry inquiry-form">
    <div class="puppy-inquiry__header">
        <h3 class="puppy-inquiry__title">
            <?php esc_html_e("I'm Interested in", 'furrylicious'); ?>
            <?php if ($puppy && !empty($puppy->breed_name)) : ?>
                <span><?php echo esc_html($puppy->breed_name); ?></span>
            <?php endif; ?>
        </h3>
    </div>

    <?php if ($phone) : ?>
        <p class="puppy-inquiry__phone">
            <a href="tel:<?php echo esc_attr($phone); ?>">
                <?php echo esc_html($phone); ?>
            </a>
        </p>
    <?php endif; ?>

    <div class="puppy-inquiry__form">
        <?php
        if (function_exists('gravity_form')) {
            // Prepare hidden field values
            $field_values = array();

            if ($puppy) {
                if (!empty($puppy->breed_name)) {
                    $field_values['breed'] = $puppy->breed_name;
                }
                if (!empty($puppy->animal_type)) {
                    $field_values['type'] = $puppy->animal_type;
                }
                if (!empty($puppy->permalink)) {
                    $field_values['peturl'] = $puppy->permalink;
                }
            }

            gravity_form(
                $form_id,
                false,
                false,
                false,
                $field_values,
                true
            );
        } elseif (!empty($petkey_gallery_settings) && $petkey_gallery_settings->custom_form == 'Y') {
            // Custom form code from settings
            $custom_form_code = stripslashes_deep(html_entity_decode($petkey_gallery_settings->custom_form_code));
            if ($puppy && !empty($puppy->breed_name)) {
                $custom_form_code = str_ireplace('`breed`', $puppy->breed_name, $custom_form_code);
            }
            echo '<div class="custom-pet-inquiry-form">' . $custom_form_code . '</div>';
        } else {
            printf(
                '<p class="text-center">%s <a href="%s">%s</a></p>',
                esc_html__('Please visit our', 'furrylicious'),
                esc_url(home_url('/contact-us/')),
                esc_html__('contact us page', 'furrylicious')
            );
        }
        ?>
    </div>

    <div class="puppy-inquiry__privacy">
        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">
            <?php esc_html_e('Privacy Policy', 'furrylicious'); ?>
        </a>
    </div>
</div>
