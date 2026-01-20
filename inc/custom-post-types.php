<?php
/**
 * Custom Post Types
 *
 * Registers custom post types for FAQ, Breeds, and other content types.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register FAQ Custom Post Type
 *
 * @return void
 */
function furrylicious_register_faq_post_type() {
    $labels = array(
        'name'                  => _x('FAQs', 'Post type general name', 'furrylicious'),
        'singular_name'         => _x('FAQ', 'Post type singular name', 'furrylicious'),
        'menu_name'             => _x('FAQs', 'Admin Menu text', 'furrylicious'),
        'name_admin_bar'        => _x('FAQ', 'Add New on Toolbar', 'furrylicious'),
        'add_new'               => __('Add New', 'furrylicious'),
        'add_new_item'          => __('Add New FAQ', 'furrylicious'),
        'new_item'              => __('New FAQ', 'furrylicious'),
        'edit_item'             => __('Edit FAQ', 'furrylicious'),
        'view_item'             => __('View FAQ', 'furrylicious'),
        'all_items'             => __('All FAQs', 'furrylicious'),
        'search_items'          => __('Search FAQs', 'furrylicious'),
        'parent_item_colon'     => __('Parent FAQs:', 'furrylicious'),
        'not_found'             => __('No FAQs found.', 'furrylicious'),
        'not_found_in_trash'    => __('No FAQs found in Trash.', 'furrylicious'),
        'featured_image'        => _x('FAQ Cover Image', 'Overrides the "Featured Image" phrase', 'furrylicious'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase', 'furrylicious'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase', 'furrylicious'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase', 'furrylicious'),
        'archives'              => _x('FAQ archives', 'The post type archive label', 'furrylicious'),
        'insert_into_item'      => _x('Insert into FAQ', 'Overrides the "Insert into post" phrase', 'furrylicious'),
        'uploaded_to_this_item' => _x('Uploaded to this FAQ', 'Overrides the "Uploaded to this post" phrase', 'furrylicious'),
        'filter_items_list'     => _x('Filter FAQs list', 'Screen reader text', 'furrylicious'),
        'items_list_navigation' => _x('FAQs list navigation', 'Screen reader text', 'furrylicious'),
        'items_list'            => _x('FAQs list', 'Screen reader text', 'furrylicious'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'faq'),
        'capability_type'    => 'page',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-book',
        'supports'           => array('title', 'editor', 'page-attributes'),
        'show_in_rest'       => true,
    );

    register_post_type('faq', $args);
}
add_action('init', 'furrylicious_register_faq_post_type');

/**
 * Register FAQ Category Taxonomy
 *
 * @return void
 */
function furrylicious_register_faq_taxonomy() {
    $labels = array(
        'name'              => _x('FAQ Categories', 'taxonomy general name', 'furrylicious'),
        'singular_name'     => _x('FAQ Category', 'taxonomy singular name', 'furrylicious'),
        'search_items'      => __('Search FAQ Categories', 'furrylicious'),
        'all_items'         => __('All FAQ Categories', 'furrylicious'),
        'parent_item'       => __('Parent FAQ Category', 'furrylicious'),
        'parent_item_colon' => __('Parent FAQ Category:', 'furrylicious'),
        'edit_item'         => __('Edit FAQ Category', 'furrylicious'),
        'update_item'       => __('Update FAQ Category', 'furrylicious'),
        'add_new_item'      => __('Add New FAQ Category', 'furrylicious'),
        'new_item_name'     => __('New FAQ Category Name', 'furrylicious'),
        'menu_name'         => __('Categories', 'furrylicious'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'faq-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('faq_category', array('faq'), $args);
}
add_action('init', 'furrylicious_register_faq_taxonomy');

/**
 * Register Testimonial Custom Post Type
 *
 * @return void
 */
function furrylicious_register_testimonial_post_type() {
    $labels = array(
        'name'               => _x('Testimonials', 'Post type general name', 'furrylicious'),
        'singular_name'      => _x('Testimonial', 'Post type singular name', 'furrylicious'),
        'menu_name'          => _x('Testimonials', 'Admin Menu text', 'furrylicious'),
        'add_new'            => __('Add New', 'furrylicious'),
        'add_new_item'       => __('Add New Testimonial', 'furrylicious'),
        'new_item'           => __('New Testimonial', 'furrylicious'),
        'edit_item'          => __('Edit Testimonial', 'furrylicious'),
        'view_item'          => __('View Testimonial', 'furrylicious'),
        'all_items'          => __('All Testimonials', 'furrylicious'),
        'search_items'       => __('Search Testimonials', 'furrylicious'),
        'not_found'          => __('No testimonials found.', 'furrylicious'),
        'not_found_in_trash' => __('No testimonials found in Trash.', 'furrylicious'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'furrylicious_register_testimonial_post_type');

/**
 * Flush rewrite rules on theme activation
 *
 * @return void
 */
function furrylicious_flush_rewrite_rules() {
    furrylicious_register_faq_post_type();
    furrylicious_register_faq_taxonomy();
    furrylicious_register_testimonial_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'furrylicious_flush_rewrite_rules');

/**
 * Add custom columns to FAQ admin list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function furrylicious_faq_admin_columns($columns) {
    $new_columns = array();

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        if ($key === 'title') {
            $new_columns['faq_category'] = __('Category', 'furrylicious');
        }
    }

    return $new_columns;
}
add_filter('manage_faq_posts_columns', 'furrylicious_faq_admin_columns');

/**
 * Display custom column content for FAQ
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 * @return void
 */
function furrylicious_faq_admin_column_content($column, $post_id) {
    if ($column === 'faq_category') {
        $terms = get_the_terms($post_id, 'faq_category');
        if ($terms && !is_wp_error($terms)) {
            $term_names = wp_list_pluck($terms, 'name');
            echo esc_html(implode(', ', $term_names));
        } else {
            echo '—';
        }
    }
}
add_action('manage_faq_posts_custom_column', 'furrylicious_faq_admin_column_content', 10, 2);

/**
 * Get FAQs by category
 *
 * @param string $category Category slug. Empty for all FAQs.
 * @param int    $limit    Number of FAQs to retrieve. Default -1 (all).
 * @return WP_Query Query object with FAQs.
 */
function furrylicious_get_faqs($category = '', $limit = -1) {
    $args = array(
        'post_type'      => 'faq',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'faq_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    return new WP_Query($args);
}

/**
 * Get testimonials
 *
 * @param int $limit Number of testimonials to retrieve. Default 3.
 * @return WP_Query Query object with testimonials.
 */
function furrylicious_get_testimonials($limit = 3) {
    return new WP_Query(array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $limit,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
}
