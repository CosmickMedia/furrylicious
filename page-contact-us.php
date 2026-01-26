<?php
/**
 * Template Name: Contact Us
 *
 * Contact page with Gravity Form integration and store information.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// Get contact info from ACF
$phone = get_field('phone', 'option') ?: '';
$email = get_field('email', 'option') ?: '';
$address = get_field('address', 'option') ?: '';
$google_maps_url = get_field('google_maps_url', 'option') ?: '';
$business_hours = get_field('business_hours', 'option') ?: array();
$gravity_form_id = get_field('gravity_form_id', 'option') ?: 1;

// Check for pre-populated puppy data
$puppy_id = isset($_GET['puppy']) ? intval($_GET['puppy']) : 0;
$is_visit = isset($_GET['visit']) && $_GET['visit'] == '1';
$puppy_name = '';
$puppy_breed = '';

if ($puppy_id) {
    $product = wc_get_product($puppy_id);
    if ($product) {
        $puppy_name = $product->get_meta('pet_name') ?: '';
        $puppy_breed = strip_tags(wc_get_product_category_list($puppy_id, ', ', '', ''));
    }
}
?>

<main id="main" class="site-main">
    <article <?php post_class('contact-page'); ?>>
        <header class="contact-page__header">
            <div class="container">
                <h1 class="contact-page__title"><?php the_title(); ?></h1>
                <?php if ($puppy_name || $puppy_breed) : ?>
                    <p class="contact-page__subtitle">
                        <?php if ($is_visit) : ?>
                            <?php printf(__('Schedule a visit to meet %s', 'furrylicious'), esc_html($puppy_name ?: $puppy_breed)); ?>
                        <?php else : ?>
                            <?php printf(__('Inquiring about %s', 'furrylicious'), esc_html($puppy_name ?: $puppy_breed)); ?>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
            </div>
        </header>

        <div class="contact-page__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="contact-form-wrapper">
                            <?php if ($puppy_id && $puppy_breed) : ?>
                                <div class="contact-form__puppy-info">
                                    <div class="puppy-inquiry-card">
                                        <?php
                                        $product = wc_get_product($puppy_id);
                                        if ($product) :
                                            $img_id = $product->get_image_id();
                                        ?>
                                            <?php if ($img_id) : ?>
                                                <div class="puppy-inquiry-card__image">
                                                    <?php echo wp_get_attachment_image($img_id, 'thumbnail', false, array('class' => 'puppy-inquiry-card__img')); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="puppy-inquiry-card__info">
                                                <?php if ($puppy_name) : ?>
                                                    <p class="puppy-inquiry-card__name"><?php echo esc_html($puppy_name); ?></p>
                                                <?php endif; ?>
                                                <p class="puppy-inquiry-card__breed"><?php echo esc_html($puppy_breed); ?></p>
                                                <a href="<?php echo esc_url(get_permalink($puppy_id)); ?>" class="puppy-inquiry-card__link">
                                                    <?php esc_html_e('View Details', 'furrylicious'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <h2 class="contact-form__title">
                                <?php if ($is_visit) : ?>
                                    <?php esc_html_e('Schedule Your Visit', 'furrylicious'); ?>
                                <?php else : ?>
                                    <?php esc_html_e('Send Us a Message', 'furrylicious'); ?>
                                <?php endif; ?>
                            </h2>

                            <?php
                            // Display Gravity Form with pre-populated fields
                            if (function_exists('gravity_form')) {
                                $field_values = array();

                                if ($puppy_name) {
                                    $field_values['puppy_name'] = $puppy_name;
                                }
                                if ($puppy_breed) {
                                    $field_values['puppy_breed'] = $puppy_breed;
                                }
                                if ($puppy_id) {
                                    $field_values['puppy_id'] = $puppy_id;
                                }

                                gravity_form($gravity_form_id, false, false, false, $field_values, true);
                            } else {
                                // Fallback contact info if Gravity Forms not available
                                ?>
                                <div class="contact-fallback">
                                    <p><?php esc_html_e('Please contact us using the information below:', 'furrylicious'); ?></p>
                                    <?php if ($phone) : ?>
                                        <p><strong><?php esc_html_e('Phone:', 'furrylicious'); ?></strong> <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
                                    <?php endif; ?>
                                    <?php if ($email) : ?>
                                        <p><strong><?php esc_html_e('Email:', 'furrylicious'); ?></strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <aside class="contact-sidebar">
                            <div class="contact-info-card">
                                <h3 class="contact-info-card__title"><?php esc_html_e('Get In Touch', 'furrylicious'); ?></h3>

                                <?php if ($phone) : ?>
                                    <div class="contact-info-item">
                                        <div class="contact-info-item__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                            </svg>
                                        </div>
                                        <div class="contact-info-item__content">
                                            <span class="contact-info-item__label"><?php esc_html_e('Phone', 'furrylicious'); ?></span>
                                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="contact-info-item__value"><?php echo esc_html($phone); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($email) : ?>
                                    <div class="contact-info-item">
                                        <div class="contact-info-item__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                        </div>
                                        <div class="contact-info-item__content">
                                            <span class="contact-info-item__label"><?php esc_html_e('Email', 'furrylicious'); ?></span>
                                            <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-info-item__value"><?php echo esc_html($email); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($address) : ?>
                                    <div class="contact-info-item">
                                        <div class="contact-info-item__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                        </div>
                                        <div class="contact-info-item__content">
                                            <span class="contact-info-item__label"><?php esc_html_e('Address', 'furrylicious'); ?></span>
                                            <address class="contact-info-item__value"><?php echo nl2br(esc_html($address)); ?></address>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($business_hours)) : ?>
                                <div class="contact-hours-card">
                                    <h3 class="contact-hours-card__title"><?php esc_html_e('Business Hours', 'furrylicious'); ?></h3>
                                    <ul class="contact-hours-list">
                                        <?php foreach ($business_hours as $hours) : ?>
                                            <li class="contact-hours-list__item<?php echo !empty($hours['closed']) ? ' contact-hours-list__item--closed' : ''; ?>">
                                                <span class="contact-hours-list__day"><?php echo esc_html($hours['day']); ?></span>
                                                <span class="contact-hours-list__time">
                                                    <?php if (!empty($hours['closed'])) : ?>
                                                        <?php esc_html_e('Closed', 'furrylicious'); ?>
                                                    <?php else : ?>
                                                        <?php echo esc_html($hours['open']); ?> - <?php echo esc_html($hours['close']); ?>
                                                    <?php endif; ?>
                                                </span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if ($google_maps_url) : ?>
                                <div class="contact-map-card">
                                    <a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" rel="noopener noreferrer" class="contact-map-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <?php esc_html_e('Get Directions', 'furrylicious'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php furrylicious_social_icons('contact-social'); ?>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<?php get_footer(); ?>
