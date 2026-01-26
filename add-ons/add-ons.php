<?php
/**
 * Add-ons Loader
 *
 * Loads all theme add-on modules.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define add-ons directory
define('FURRYLICIOUS_ADDONS_DIR', FURRYLICIOUS_DIR . '/add-ons');

/**
 * Load add-on modules
 */
function furrylicious_load_addons() {
    // Pet Inquiry (form pre-population and modal)
    require_once FURRYLICIOUS_ADDONS_DIR . '/pet-inquiry/pet-inquiry.php';

    // Site Notice (dismissible announcements) - load if file exists
    if (file_exists(FURRYLICIOUS_ADDONS_DIR . '/site-notice.php')) {
        require_once FURRYLICIOUS_ADDONS_DIR . '/site-notice.php';
    }

    // WooCommerce Filter - load if file exists
    if (file_exists(FURRYLICIOUS_ADDONS_DIR . '/woo-filter.php')) {
        require_once FURRYLICIOUS_ADDONS_DIR . '/woo-filter.php';
    }

    // Pet Visit scheduling - load if file exists
    if (file_exists(FURRYLICIOUS_ADDONS_DIR . '/pet-visit/pet-visit.php')) {
        require_once FURRYLICIOUS_ADDONS_DIR . '/pet-visit/pet-visit.php';
    }

    // Video Gallery - load if file exists
    if (file_exists(FURRYLICIOUS_ADDONS_DIR . '/video-gallery/video-gallery.php')) {
        require_once FURRYLICIOUS_ADDONS_DIR . '/video-gallery/video-gallery.php';
    }
}
add_action('after_setup_theme', 'furrylicious_load_addons');
