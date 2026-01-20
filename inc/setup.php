<?php
/**
 * Theme Setup
 *
 * Registers theme support, navigation menus, and image sizes.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 *
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @return void
 */
function furrylicious_setup() {
    /*
     * Make theme available for translation.
     */
    load_theme_textdomain('furrylicious', FURRYLICIOUS_DIR . '/languages');

    /*
     * Add default posts and comments RSS feed links to head.
     */
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support('post-thumbnails');

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ));

    /*
     * Add support for core custom logo.
     */
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    /*
     * Add support for responsive embeds.
     */
    add_theme_support('responsive-embeds');

    /*
     * Add support for wide alignment in the block editor.
     */
    add_theme_support('align-wide');

    /*
     * Add support for editor styles.
     */
    add_theme_support('editor-styles');

    /*
     * Add support for custom background.
     */
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    /*
     * Remove support for block widget styles.
     */
    remove_theme_support('core-block-patterns');

    /*
     * Register navigation menus.
     */
    register_nav_menus(array(
        'primary'       => esc_html__('Primary Menu', 'furrylicious'),
        'primary-left'  => esc_html__('Primary Menu Left (of logo)', 'furrylicious'),
        'primary-right' => esc_html__('Primary Menu Right (of logo)', 'furrylicious'),
        'secondary'     => esc_html__('Secondary Menu', 'furrylicious'),
        'footer'        => esc_html__('Footer Menu', 'furrylicious'),
        'mobile'        => esc_html__('Mobile Menu', 'furrylicious'),
    ));
}
add_action('after_setup_theme', 'furrylicious_setup');

/**
 * Register custom image sizes
 *
 * @return void
 */
function furrylicious_image_sizes() {
    // Puppy card thumbnail
    add_image_size('puppy-card', 400, 400, true);

    // Puppy card large (for featured/bento items)
    add_image_size('puppy-card-large', 800, 800, true);

    // Hero banner
    add_image_size('hero-banner', 1920, 800, true);

    // Testimonial avatar
    add_image_size('testimonial-avatar', 80, 80, true);

    // Gallery thumbnail
    add_image_size('gallery-thumb', 300, 300, true);

    // Gallery full
    add_image_size('gallery-full', 1200, 900, false);

    // Blog card
    add_image_size('blog-card', 600, 400, true);
}
add_action('after_setup_theme', 'furrylicious_image_sizes');

/**
 * Register widget areas
 *
 * @return void
 */
function furrylicious_widgets_init() {
    // Footer widget area 1
    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'furrylicious'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'furrylicious'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer widget area 2
    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'furrylicious'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'furrylicious'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer widget area 3
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'furrylicious'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'furrylicious'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Sidebar widget area
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'furrylicious'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'furrylicious'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'furrylicious_widgets_init');

/**
 * Set the content width based on the theme's design
 *
 * @return void
 */
function furrylicious_content_width() {
    $GLOBALS['content_width'] = apply_filters('furrylicious_content_width', 1140);
}
add_action('after_setup_theme', 'furrylicious_content_width', 0);

/**
 * Add custom CSS class to menu items with children
 *
 * @param array    $classes CSS classes applied to the menu item.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item.
 * @return array Modified CSS classes.
 */
function furrylicious_menu_item_classes($classes, $item, $args, $depth) {
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'has-dropdown';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'furrylicious_menu_item_classes', 10, 4);

/**
 * Add custom attributes to menu item links
 *
 * @param array    $atts The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item.
 * @return array Modified attributes.
 */
function furrylicious_menu_link_atts($atts, $item, $args, $depth) {
    // Add class to links
    if (!isset($atts['class'])) {
        $atts['class'] = '';
    }

    $atts['class'] .= ' nav-link';

    // Add aria-current for current page
    if (in_array('current-menu-item', $item->classes)) {
        $atts['aria-current'] = 'page';
    }

    // Add aria attributes for dropdowns
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['aria-expanded'] = 'false';
        $atts['aria-haspopup'] = 'true';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'furrylicious_menu_link_atts', 10, 4);
