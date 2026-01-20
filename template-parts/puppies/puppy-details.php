<?php
/**
 * Template Part: Puppy Details
 *
 * Displays puppy information (breed, age, gender, etc.)
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

if (!$puppy) {
    return;
}

// Build details array
$details = array();

if (!empty($puppy->breed_name)) {
    $details[] = array(
        'label' => __('Breed', 'furrylicious'),
        'value' => $puppy->breed_name,
    );
}

if (!empty($puppy->name)) {
    $details[] = array(
        'label' => __('Name', 'furrylicious'),
        'value' => $puppy->name,
    );
}

if (!empty($puppy->birth_date)) {
    $details[] = array(
        'label' => __('Birth Date', 'furrylicious'),
        'value' => $puppy->birth_date,
    );
}

if (!empty($puppy->coloring)) {
    $details[] = array(
        'label' => __('Color', 'furrylicious'),
        'value' => $puppy->coloring,
    );
}

if (!empty($puppy->gender)) {
    $details[] = array(
        'label' => __('Gender', 'furrylicious'),
        'value' => $puppy->gender,
    );
}

if (!empty($puppy->reference_id)) {
    $details[] = array(
        'label' => __('Reference ID', 'furrylicious'),
        'value' => $puppy->reference_id,
    );
}

if (!empty($puppy->location_name) && $puppy->location_name !== 'default') {
    $details[] = array(
        'label' => __('Location', 'furrylicious'),
        'value' => $puppy->location_name,
    );
}

// Allow filtering
$details = apply_filters('furrylicious_puppy_details', $details, $puppy);
?>

<div class="puppy-info">
    <?php foreach ($details as $detail) : ?>
        <div class="puppy-info__box">
            <div class="puppy-info__label"><?php echo esc_html($detail['label']); ?></div>
            <div class="puppy-info__value"><?php echo esc_html($detail['value']); ?></div>
        </div>
    <?php endforeach; ?>
</div>
