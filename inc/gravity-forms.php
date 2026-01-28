<?php
/**
 * Gravity Forms Customizations
 *
 * Custom styling and functionality for Gravity Forms.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Disable Gravity Forms auto-updates
 */
add_filter('gform_disable_auto_update', '__return_true', PHP_INT_MAX);
add_filter('option_gform_enable_background_updates', '__return_false', PHP_INT_MAX);

/**
 * Add custom CSS classes to Gravity Forms
 *
 * @param string $form_tag Form tag HTML.
 * @param array  $form     Form data.
 * @return string Modified form tag.
 */
function furrylicious_gform_form_classes($form_tag, $form) {
    // Insert our custom class into the form tag's class attribute
    $form_tag = str_replace("class='", "class='gform--furrylicious ", $form_tag);

    return $form_tag;
}
add_filter('gform_form_tag', 'furrylicious_gform_form_classes', 10, 2);

/**
 * Modify submit button
 *
 * @param string $button Button HTML.
 * @param array  $form   Form data.
 * @return string Modified button HTML.
 */
function furrylicious_gform_submit_button($button, $form) {
    return str_replace(
        'class=\'gform_button',
        'class=\'gform_button btn btn--primary',
        $button
    );
}
add_filter('gform_submit_button', 'furrylicious_gform_submit_button', 10, 2);

/**
 * Enable field label visibility for screen readers
 *
 * @param string $label     Label HTML.
 * @param array  $field     Field data.
 * @param string $value     Field value.
 * @param int    $entry_id  Entry ID.
 * @param int    $form_id   Form ID.
 * @return string Modified label.
 */
function furrylicious_gform_field_label($label, $field, $value, $entry_id, $form_id) {
    // Ensure labels are properly associated with inputs
    return $label;
}
add_filter('gform_field_label', 'furrylicious_gform_field_label', 10, 5);

/**
 * Add custom wrapper class to field container
 *
 * @param string $field_container Field container HTML.
 * @param array  $field           Field data.
 * @param array  $form            Form data.
 * @param string $css_class       CSS class.
 * @param string $style           Inline style.
 * @param string $field_content   Field content.
 * @return string Modified container HTML.
 */
function furrylicious_gform_field_container($field_container, $field, $form, $css_class, $style, $field_content) {
    return $field_container;
}
add_filter('gform_field_container', 'furrylicious_gform_field_container', 10, 6);

/**
 * Multi-step form progress indicator
 *
 * @param string $progress_bar  Progress bar HTML.
 * @param array  $form          Form data.
 * @param string $confirmation  Confirmation message.
 * @return string Modified progress bar.
 */
function furrylicious_gform_progress_bar($progress_bar, $form, $confirmation) {
    // Custom progress bar styling can be added here
    return $progress_bar;
}
add_filter('gform_progress_bar', 'furrylicious_gform_progress_bar', 10, 3);

/**
 * Add ARIA labels to form fields
 *
 * @param string $input Field input HTML.
 * @param array  $field Field data.
 * @param string $value Field value.
 * @param int    $lead_id Entry ID.
 * @param int    $form_id Form ID.
 * @return string Modified input HTML.
 */
function furrylicious_gform_field_input($input, $field, $value, $lead_id, $form_id) {
    // Add accessible labels if needed
    return $input;
}
add_filter('gform_field_input', 'furrylicious_gform_field_input', 10, 5);

/**
 * Customize confirmation message
 *
 * @param string $confirmation Confirmation message.
 * @param array  $form         Form data.
 * @param array  $entry        Entry data.
 * @param bool   $ajax         Whether using AJAX.
 * @return string Modified confirmation.
 */
function furrylicious_gform_confirmation($confirmation, $form, $entry, $ajax) {
    // Add custom wrapper for styling
    if (is_string($confirmation)) {
        $confirmation = '<div class="gform-confirmation">' . $confirmation . '</div>';
    }

    return $confirmation;
}
add_filter('gform_confirmation', 'furrylicious_gform_confirmation', 10, 4);

/**
 * Add required field indicator styling
 *
 * @param string $required_indicator Required indicator HTML.
 * @param int    $form_id            Form ID.
 * @return string Modified indicator.
 */
function furrylicious_gform_required_legend($required_indicator, $form_id) {
    return '<span class="gfield_required" aria-hidden="true">*</span>';
}
add_filter('gform_required_legend', 'furrylicious_gform_required_legend', 10, 2);

/**
 * Load custom form by ID
 *
 * Helper function to display a Gravity Form with custom options.
 *
 * @param int   $form_id     Form ID.
 * @param array $options     Display options.
 * @return string Form HTML.
 */
function furrylicious_gravity_form($form_id, $options = array()) {
    if (!function_exists('gravity_form')) {
        return '<p>' . esc_html__('Please install Gravity Forms to display this form.', 'furrylicious') . '</p>';
    }

    $defaults = array(
        'display_title'       => false,
        'display_description' => false,
        'display_inactive'    => false,
        'field_values'        => null,
        'ajax'                => true,
        'tabindex'            => 0,
        'echo'                => false,
    );

    $options = wp_parse_args($options, $defaults);

    return gravity_form(
        $form_id,
        $options['display_title'],
        $options['display_description'],
        $options['display_inactive'],
        $options['field_values'],
        $options['ajax'],
        $options['tabindex'],
        $options['echo']
    );
}

/**
 * Get inquiry form for puppy pages
 *
 * @param array $puppy_data Puppy data for pre-filling form fields.
 * @return string Form HTML.
 */
function furrylicious_puppy_inquiry_form($puppy_data = array()) {
    // Get the inquiry form ID from options or use default
    $form_id = furrylicious_get_option('inquiry_form_id', 2);

    $field_values = array();

    if (!empty($puppy_data)) {
        $field_values = array(
            'breed'  => isset($puppy_data['breed_name']) ? $puppy_data['breed_name'] : '',
            'type'   => isset($puppy_data['animal_type']) ? $puppy_data['animal_type'] : '',
            'peturl' => isset($puppy_data['permalink']) ? $puppy_data['permalink'] : '',
            'petid'  => isset($puppy_data['petid']) ? $puppy_data['petid'] : '',
        );
    }

    return furrylicious_gravity_form($form_id, array(
        'field_values' => $field_values,
    ));
}

/**
 * Get newsletter signup form
 *
 * @return string Form HTML.
 */
function furrylicious_newsletter_form() {
    $form_id = furrylicious_get_option('newsletter_form_id', 7);

    return furrylicious_gravity_form($form_id);
}

/**
 * Get footer newsletter form
 *
 * @return string Form HTML.
 */
function furrylicious_footer_newsletter_form() {
    $form_id = furrylicious_get_option('footer_newsletter_form_id', 8);

    return furrylicious_gravity_form($form_id);
}

/**
 * Add honeypot field for spam protection
 *
 * @param string $form_tag Form tag HTML.
 * @param array  $form     Form data.
 * @return string Modified form tag.
 */
function furrylicious_gform_honeypot($form_tag, $form) {
    // Gravity Forms has built-in honeypot, this is for additional protection if needed
    return $form_tag;
}
add_filter('gform_form_tag', 'furrylicious_gform_honeypot', 10, 2);
