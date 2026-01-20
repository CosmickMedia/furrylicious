<?php
/**
 * Template Part: Footer Widgets
 *
 * Displays the main footer widget areas (navigation, hours, reviews).
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get contact info
$contact = furrylicious_get_contact_info();
$address = $contact['address'];
$phone = $contact['phone'];
$email = $contact['email'];

// Get hours from options
$hours = function_exists('get_field') ? get_field('store_hours', 'options') : 'Open Every Day - 11AM to 7PM';
if (empty($hours)) {
    $hours = 'Open Every Day - 11AM to 7PM';
}

// Get map link
$map_link = function_exists('get_field') ? get_field('google_maps_link', 'options') : '';
$map_image = function_exists('get_field') ? get_field('footer_map_image', 'options') : '';
?>

<!-- Branding & Contact -->
<div class="footer-branding">
    <?php
    $logo = furrylicious_get_option('footer_logo');
    if (empty($logo)) {
        $logo = get_template_directory_uri() . '/assets/images/logo-footer.png';
    }
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link">
        <img src="<?php echo esc_url($logo); ?>"
             alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
             class="footer-logo"
             width="180"
             height="auto"
             loading="lazy" />
    </a>

    <div class="footer-contact">
        <?php if (!empty($address)) : ?>
            <address class="footer-address">
                <?php echo wp_kses_post($address); ?>
            </address>
        <?php endif; ?>

        <?php if (!empty($phone)) : ?>
            <p class="footer-phone">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>">
                    <?php printf(esc_html__('Phone: %s', 'furrylicious'), esc_html($phone)); ?>
                </a>
            </p>
        <?php endif; ?>

        <?php if (!empty($email)) : ?>
            <p class="footer-email">
                <a href="mailto:<?php echo esc_attr($email); ?>">
                    <?php echo esc_html($email); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- Navigation Widget -->
<div class="footer-widget footer-nav-widget">
    <h3 class="footer-widget__title">
        <?php esc_html_e('Navigation', 'furrylicious'); ?>
    </h3>

    <?php
    if (has_nav_menu('footer')) {
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
            'menu_class'     => 'footer-nav',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => false,
        ));
    }
    ?>
</div>

<!-- Hours & Reviews Widget -->
<div class="footer-widget footer-hours-widget">
    <h3 class="footer-widget__title">
        <?php esc_html_e('Hours', 'furrylicious'); ?>
    </h3>

    <p class="footer-hours">
        <?php echo esc_html($hours); ?>
    </p>

    <h3 class="footer-widget__title">
        <?php esc_html_e('Reviews', 'furrylicious'); ?>
    </h3>

    <div class="footer-reviews">
        <?php
        // Check if CSR plugin is active
        if (function_exists('csr_get_overall_rating')) {
            csr_get_overall_rating();
        } else {
            // Fallback stars display
            ?>
            <div class="stars" aria-label="<?php esc_attr_e('5 out of 5 stars', 'furrylicious'); ?>">
                <span aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<!-- Newsletter & Social -->
<?php get_template_part('template-parts/footer/footer-newsletter'); ?>

<!-- Map & BBB Badge -->
<div class="footer-widget footer-map">
    <?php if (!empty($map_link)) : ?>
        <a href="<?php echo esc_url($map_link); ?>"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="<?php esc_attr_e('View our location on Google Maps', 'furrylicious'); ?>">
            <?php if (!empty($map_image)) : ?>
                <img src="<?php echo esc_url($map_image); ?>"
                     alt="<?php esc_attr_e('Store location map', 'furrylicious'); ?>"
                     class="footer-map__image"
                     loading="lazy" />
            <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/map-placeholder.png'); ?>"
                     alt="<?php esc_attr_e('Store location map', 'furrylicious'); ?>"
                     class="footer-map__image"
                     loading="lazy" />
            <?php endif; ?>
        </a>
    <?php endif; ?>

    <!-- BBB Badge -->
    <?php
    $bbb_link = function_exists('get_field') ? get_field('bbb_link', 'options') : '';
    $bbb_image = function_exists('get_field') ? get_field('bbb_badge', 'options') : '';

    if (!empty($bbb_link)) :
    ?>
        <div class="footer-badge">
            <a href="<?php echo esc_url($bbb_link); ?>"
               target="_blank"
               rel="nofollow noopener noreferrer">
                <?php if (!empty($bbb_image)) : ?>
                    <img src="<?php echo esc_url($bbb_image); ?>"
                         alt="<?php echo esc_attr(get_bloginfo('name') . ' BBB Business Review'); ?>"
                         loading="lazy" />
                <?php else : ?>
                    <img src="https://seal-newjersey.bbb.org/seals/blue-seal-250-52-bbb-90143942.png"
                         alt="<?php echo esc_attr(get_bloginfo('name') . ' BBB Business Review'); ?>"
                         loading="lazy" />
                <?php endif; ?>
            </a>
        </div>
    <?php endif; ?>
</div>
