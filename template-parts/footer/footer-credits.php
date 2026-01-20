<?php
/**
 * Template Part: Footer Credits
 *
 * Displays the footer credits bar with copyright and payment options.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="footer-credits">
    <div class="container">
        <div class="footer-credits__inner">
            <p class="footer-copyright">
                &copy;<?php echo esc_html(date_i18n('Y')); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>.
                <?php esc_html_e('All rights reserved.', 'furrylicious'); ?>
                |
                <?php esc_html_e('Designed & Developed by', 'furrylicious'); ?>
                <a href="https://www.cosmickmedia.com" target="_blank" rel="noopener noreferrer">
                    Cosmick Media
                </a>
            </p>

            <ul class="footer-payments" aria-label="<?php esc_attr_e('Accepted payment methods', 'furrylicious'); ?>">
                <li>
                    <!-- Visa -->
                    <svg viewBox="0 0 50 32" fill="currentColor" aria-label="Visa">
                        <path d="M21.5 23.5h-3.2l2-12.3h3.2l-2 12.3zm-5.3-12.3l-3 8.4-.4-1.8-.4-1.8-.9-4.3c-.2-.6-.6-.8-1.2-.8H6l-.1.3c1.2.3 2.3.7 3.2 1.2l2.7 10.3h3.3l5.1-11.5h-4zm27.3 12.3h2.9l-2.5-12.3h-2.6c-.6 0-1.1.3-1.3.9l-4.7 11.4h3.3l.6-1.8h4l.3 1.8zm-3.5-4.4l1.7-4.6.9 4.6h-2.6zm-6.5-5.2l.5-2.7c-.8-.3-1.8-.6-2.8-.6-1.6 0-3.3.7-3.3 2.3 0 1.4 1.6 1.9 2.7 2.5 1.1.6 1.5 1 1.5 1.5 0 .8-.9 1.1-1.7 1.1-1.1 0-2.1-.3-2.9-.6l-.4 2.7c.8.3 2 .6 3.4.6 2.4 0 3.5-1.2 3.5-2.5 0-1.9-2.7-2.4-2.7-3.3 0-.3.3-.8 1.2-.8.7 0 1.5.2 2.1.4l.4-.6h.5z"/>
                    </svg>
                </li>
                <li>
                    <!-- Mastercard -->
                    <svg viewBox="0 0 50 32" fill="currentColor" aria-label="Mastercard">
                        <circle cx="18" cy="16" r="10" opacity="0.8"/>
                        <circle cx="32" cy="16" r="10" opacity="0.8"/>
                        <path d="M25 8.5c2.5 2 4 5 4 8.5s-1.5 6.5-4 8.5c-2.5-2-4-5-4-8.5s1.5-6.5 4-8.5z" opacity="0.9"/>
                    </svg>
                </li>
                <li>
                    <!-- Discover -->
                    <svg viewBox="0 0 50 32" fill="currentColor" aria-label="Discover">
                        <rect x="2" y="4" width="46" height="24" rx="3" fill="none" stroke="currentColor" stroke-width="1.5"/>
                        <circle cx="32" cy="16" r="8" opacity="0.8"/>
                        <text x="8" y="19" font-size="8" font-weight="bold" fill="currentColor">DISCOVER</text>
                    </svg>
                </li>
                <li>
                    <!-- American Express -->
                    <svg viewBox="0 0 50 32" fill="currentColor" aria-label="American Express">
                        <rect x="2" y="4" width="46" height="24" rx="3" fill="none" stroke="currentColor" stroke-width="1.5"/>
                        <text x="25" y="15" font-size="6" font-weight="bold" text-anchor="middle" fill="currentColor">AMERICAN</text>
                        <text x="25" y="22" font-size="6" font-weight="bold" text-anchor="middle" fill="currentColor">EXPRESS</text>
                    </svg>
                </li>
            </ul>
        </div>
    </div>
</div>
