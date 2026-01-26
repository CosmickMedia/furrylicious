<?php
/**
 * Site Notice Add-on
 *
 * Displays a dismissible announcement banner at the top of the site.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display site notice banner
 */
function furrylicious_site_notice() {
    // Skip on certain templates
    if (is_page_template('page-empty.php')) {
        return;
    }

    $notice = get_field('site_notice', 'option');
    $notice_enabled = get_field('site_notice_enabled', 'option');

    if (!$notice_enabled || !$notice) {
        return;
    }

    $notice_style = get_field('site_notice_style', 'option') ?: 'info';
    $notice_dismissible = get_field('site_notice_dismissible', 'option');
    $notice_id = md5($notice); // Create unique ID based on content

    ?>
    <div class="site-notice site-notice--<?php echo esc_attr($notice_style); ?>"
         id="site-notice"
         data-notice-id="<?php echo esc_attr($notice_id); ?>"
         role="alert">
        <div class="container">
            <div class="site-notice__content">
                <?php echo wp_kses_post($notice); ?>
            </div>
            <?php if ($notice_dismissible) : ?>
                <button type="button"
                        class="site-notice__dismiss"
                        aria-label="<?php esc_attr_e('Dismiss notice', 'furrylicious'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
add_action('wp_body_open', 'furrylicious_site_notice');

/**
 * Enqueue site notice scripts
 */
function furrylicious_site_notice_scripts() {
    $notice = get_field('site_notice', 'option');
    $notice_enabled = get_field('site_notice_enabled', 'option');
    $notice_dismissible = get_field('site_notice_dismissible', 'option');

    if (!$notice_enabled || !$notice || !$notice_dismissible) {
        return;
    }

    wp_add_inline_script('furrylicious-main', '
        document.addEventListener("DOMContentLoaded", function() {
            const notice = document.getElementById("site-notice");
            if (!notice) return;

            const noticeId = notice.dataset.noticeId;
            const dismissKey = "furrylicious_notice_dismissed_" + noticeId;

            // Check if already dismissed
            if (localStorage.getItem(dismissKey)) {
                notice.remove();
                return;
            }

            const dismissBtn = notice.querySelector(".site-notice__dismiss");
            if (dismissBtn) {
                dismissBtn.addEventListener("click", function() {
                    notice.classList.add("site-notice--hiding");
                    localStorage.setItem(dismissKey, "1");
                    setTimeout(function() {
                        notice.remove();
                    }, 300);
                });
            }
        });
    ');
}
add_action('wp_enqueue_scripts', 'furrylicious_site_notice_scripts', 20);
