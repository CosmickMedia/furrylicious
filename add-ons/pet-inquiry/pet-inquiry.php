<?php
/**
 * Pet Inquiry Add-on
 *
 * Handles pet inquiry form pre-population and modal functionality.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Pre-populate Gravity Form fields with puppy data
 *
 * @param array $form The form object
 * @return array Modified form object
 */
function furrylicious_prepopulate_inquiry_form($form) {
    // Check if we have a puppy ID in the URL
    $puppy_id = isset($_GET['puppy']) ? intval($_GET['puppy']) : 0;

    if (!$puppy_id) {
        return $form;
    }

    $product = wc_get_product($puppy_id);
    if (!$product) {
        return $form;
    }

    $puppy_name = $product->get_meta('pet_name') ?: '';
    $puppy_breed = strip_tags(wc_get_product_category_list($puppy_id, ', ', '', ''));
    $ref_id = $product->get_meta('reference_number') ?: '';

    // Find and pre-populate fields
    foreach ($form['fields'] as &$field) {
        if ($field->inputName === 'puppy_name' || $field->adminLabel === 'puppy_name') {
            $field->defaultValue = $puppy_name;
        }
        if ($field->inputName === 'puppy_breed' || $field->adminLabel === 'puppy_breed') {
            $field->defaultValue = $puppy_breed;
        }
        if ($field->inputName === 'puppy_id' || $field->adminLabel === 'puppy_id') {
            $field->defaultValue = $puppy_id;
        }
        if ($field->inputName === 'reference_id' || $field->adminLabel === 'reference_id') {
            $field->defaultValue = $ref_id;
        }
    }

    return $form;
}
add_filter('gform_pre_render', 'furrylicious_prepopulate_inquiry_form');

/**
 * Add inquiry button to single product page
 */
function furrylicious_add_inquiry_button() {
    global $product;

    if (!$product) {
        return;
    }

    $product_id = $product->get_id();
    $inquiry_url = add_query_arg('puppy', $product_id, home_url('/contact-us/'));
    ?>
    <div class="pet-inquiry-cta">
        <a href="<?php echo esc_url($inquiry_url); ?>" class="btn btn--primary btn--full">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <?php esc_html_e('Inquire About This Puppy', 'furrylicious'); ?>
        </a>
    </div>
    <?php
}

/**
 * Enqueue inquiry modal scripts
 */
function furrylicious_enqueue_inquiry_scripts() {
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script(
            'furrylicious-inquiry',
            FURRYLICIOUS_JS . '/modules/inquiry.js',
            array(),
            FURRYLICIOUS_VERSION,
            true
        );

        wp_localize_script('furrylicious-inquiry', 'furryliciousInquiry', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('furrylicious_inquiry'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'furrylicious_enqueue_inquiry_scripts');

/**
 * AJAX handler for loading inquiry modal content
 */
function furrylicious_load_inquiry_modal() {
    check_ajax_referer('furrylicious_inquiry', 'nonce');

    $puppy_id = isset($_POST['puppy_id']) ? intval($_POST['puppy_id']) : 0;

    if (!$puppy_id) {
        wp_send_json_error('Invalid puppy ID');
    }

    ob_start();
    include FURRYLICIOUS_DIR . '/add-ons/pet-inquiry/modal.php';
    $html = ob_get_clean();

    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_furrylicious_load_inquiry_modal', 'furrylicious_load_inquiry_modal');
add_action('wp_ajax_nopriv_furrylicious_load_inquiry_modal', 'furrylicious_load_inquiry_modal');

/**
 * Add hidden fields to Gravity Form for tracking
 *
 * @param string $button_input The button input HTML
 * @param array  $form         The form object
 * @return string Modified button HTML
 */
function furrylicious_add_hidden_tracking_fields($button_input, $form) {
    $puppy_id = isset($_GET['puppy']) ? intval($_GET['puppy']) : 0;

    if ($puppy_id) {
        $product = wc_get_product($puppy_id);
        if ($product) {
            $puppy_url = get_permalink($puppy_id);
            $tracking = sprintf(
                '<input type="hidden" name="puppy_url" value="%s" />',
                esc_attr($puppy_url)
            );
            $button_input = $tracking . $button_input;
        }
    }

    return $button_input;
}
add_filter('gform_submit_button', 'furrylicious_add_hidden_tracking_fields', 10, 2);
