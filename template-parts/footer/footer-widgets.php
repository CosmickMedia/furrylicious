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
    // Use the footer-specific logo
    $logo = get_template_directory_uri() . '/assets/images/logo-footer.png';
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
                <a href="https://www.google.com/maps/search/?api=1&query=Furrylicious+531+US+Highway+22+E+Whitehouse+Station+New+Jersey+08889" target="_blank" rel="noopener">
                    <?php echo wp_kses_post($address); ?>
                </a>
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

    <a href="https://www.google.com/search?sca_esv=ac8dc95cd3d12e0a&sxsrf=ANbL-n4bKsBFW_LeUJZvsK3v6tg6tRJ5iw:1769548763814&si=AL3DRZHrmvnFAVQPOO2Bzhf8AX9KZZ6raUI_dT7DG_z0kV2_x7YVms8zn01JAEvVuXN2vHy0h-6MsJMWgEvC87Fg2Huepglee-2Of5a4Cq31ZV1wAFB_MrPuR36AUAvIKVSlWq4pkTfV98qbJGayeeOPFvbB7Ze8Jw%3D%3D&q=Furrylicious+Puppy+Boutique+Reviews&sa=X&ved=2ahUKEwjRjuvr0qySAxWkg4kEHeuuIwsQ0bkNegQIJxAH&biw=1643&bih=824&dpr=1&aic=0" target="_blank" rel="noopener noreferrer" class="footer-reviews-link">
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
    </a>
</div>

<!-- Newsletter & Social -->
<?php get_template_part('template-parts/footer/footer-newsletter'); ?>

<!-- Map & BBB Badge -->
<div class="footer-widget footer-map">
    <!-- Google Map Embed -->
    <div class="footer-map__embed">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3033.8876!2d-74.7701!3d40.6176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3ed0a3a5a5a5a%3A0x0!2s531%20US%20Highway%2022%20E%2C%20Whitehouse%20Station%2C%20NJ%2008889!5e0!3m2!1sen!2sus!4v1"
            width="100%"
            height="200"
            style="border:0; border-radius: 8px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Furrylicious Location">
        </iframe>
    </div>

    <!-- BBB Badge -->
    <div class="footer-badge">
        <a href="https://www.bbb.org/us/nj/whitehouse-station/profile/pet-shop/furrylicious-0221-90143942"
           target="_blank"
           rel="nofollow noopener noreferrer">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bbb-seal.png'); ?>"
                 alt="<?php echo esc_attr(get_bloginfo('name') . ' BBB Business Review - A+ Rating'); ?>"
                 loading="lazy" />
        </a>
    </div>
</div>
