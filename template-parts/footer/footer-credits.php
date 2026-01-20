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

// Get developer info from ACF
$developer_name = function_exists('get_field') ? get_field('department', 'options') : '';
$developer_link = function_exists('get_field') ? get_field('department_link', 'options') : '';

// Payment methods
$payment_methods = array(
    array(
        'name' => 'Visa',
        'image' => 'cc_visa.png',
    ),
    array(
        'name' => 'Mastercard',
        'image' => 'cc_mc.png',
    ),
    array(
        'name' => 'Discover',
        'image' => 'cc_discover.png',
    ),
    array(
        'name' => 'American Express',
        'image' => 'americanexpress.png',
    ),
);
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

                <a href="https://sgsolutionsllc.com/wordpress-seo/" target="_blank" rel="noopener noreferrer">
                    Search Geek Solutions
                </a>

                <?php if (!empty($developer_name)) : ?>
                    |
                    <?php esc_html_e('Developed by:', 'furrylicious'); ?>
                    <?php if (!empty($developer_link)) : ?>
                        <a href="<?php echo esc_url($developer_link); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($developer_name); ?>
                        </a>
                    <?php else : ?>
                        <?php echo esc_html($developer_name); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </p>

            <ul class="footer-payments" aria-label="<?php esc_attr_e('Accepted payment methods', 'furrylicious'); ?>">
                <?php foreach ($payment_methods as $method) : ?>
                    <li>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/payments/' . $method['image']); ?>"
                             alt="<?php echo esc_attr($method['name']); ?>"
                             width="40"
                             height="25"
                             loading="lazy" />
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
