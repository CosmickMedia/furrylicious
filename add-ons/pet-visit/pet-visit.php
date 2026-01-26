<?php
/**
 * Pet Visit Add-on
 *
 * Schedule a visit functionality with modal and Gravity Forms integration.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize pet visit functionality
 */
function furrylicious_pet_visit_init() {
    $schedule_form_id = get_field('schedule_visit_form_id', 'option');

    if ($schedule_form_id) {
        add_action('wp_footer', 'furrylicious_pet_visit_modal');
    }
}
add_action('init', 'furrylicious_pet_visit_init');

/**
 * Output the visit modal in the footer
 */
function furrylicious_pet_visit_modal() {
    include FURRYLICIOUS_ADDONS_DIR . '/pet-visit/modal.php';
}

/**
 * Enqueue pet visit scripts
 */
function furrylicious_pet_visit_scripts() {
    $schedule_form_id = get_field('schedule_visit_form_id', 'option');

    if (!$schedule_form_id) {
        return;
    }

    wp_enqueue_script(
        'furrylicious-pet-visit',
        FURRYLICIOUS_JS . '/modules/pet-visit.js',
        array(),
        FURRYLICIOUS_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'furrylicious_pet_visit_scripts');

/**
 * Pre-populate visit form with puppy data
 *
 * @param array $form The form object.
 * @return array Modified form object.
 */
function furrylicious_prepopulate_visit_form($form) {
    // Check if we have puppy data passed
    $puppy_id = isset($_GET['puppy']) ? intval($_GET['puppy']) : 0;

    if (!$puppy_id || !function_exists('wc_get_product')) {
        return $form;
    }

    $product = wc_get_product($puppy_id);
    if (!$product) {
        return $form;
    }

    $puppy_name = $product->get_meta('pet_name') ?: $product->get_name();
    $puppy_breed = strip_tags(wc_get_product_category_list($puppy_id, ', ', '', ''));
    $ref_id = $product->get_meta('reference_number') ?: '';

    // Pre-populate matching fields
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
add_filter('gform_pre_render', 'furrylicious_prepopulate_visit_form');
