<?php
/**
 * Template Part: Site Branding
 *
 * Displays the site logo and name.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$logo_url = get_template_directory_uri() . '/assets/images/logo.png';

// Check for custom logo
if (has_custom_logo()) {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
}

// Fallback to ACF logo if available
if (function_exists('get_field')) {
    $acf_logo = get_field('site_logo', 'option');
    if ($acf_logo) {
        $logo_url = is_array($acf_logo) ? $acf_logo['url'] : $acf_logo;
    }
}
?>

<div class="site-branding">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?> - Home">
        <?php if ($logo_url) : ?>
            <img
                src="<?php echo esc_url($logo_url); ?>"
                alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                class="site-logo__image"
                width="300"
                height="100"
            />
        <?php else : ?>
            <span class="site-logo__text"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
    </a>
</div>
