<?php
/**
 * WooCommerce Filter Add-on
 *
 * AJAX filtering for puppies by breed, gender, etc.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register filter sidebar/widget area
 */
function furrylicious_register_filter_sidebar() {
    register_sidebar(array(
        'id'            => 'puppy-filters',
        'name'          => __('Puppy Filters', 'furrylicious'),
        'description'   => __('Filter widgets for the puppies archive.', 'furrylicious'),
        'before_sidebar' => '<div class="puppy-filters">',
        'after_sidebar' => '</div>',
        'before_widget' => '<div id="%1$s" class="filter-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="filter-widget__title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'furrylicious_register_filter_sidebar');

/**
 * Enqueue filter scripts
 */
function furrylicious_filter_scripts() {
    if (!is_shop() && !is_product_taxonomy()) {
        return;
    }

    wp_enqueue_script(
        'furrylicious-filter',
        FURRYLICIOUS_JS . '/modules/filter.js',
        array(),
        FURRYLICIOUS_VERSION,
        true
    );

    wp_localize_script('furrylicious-filter', 'furryliciousFilter', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('furrylicious_filter'),
    ));
}
add_action('wp_enqueue_scripts', 'furrylicious_filter_scripts');

/**
 * AJAX handler for filtering puppies
 */
function furrylicious_filter_puppies() {
    check_ajax_referer('furrylicious_filter', 'nonce');

    $breed = isset($_POST['breed']) ? sanitize_text_field($_POST['breed']) : '';
    $gender = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';
    $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'date';
    $paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1;

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'paged'          => $paged,
    );

    // Handle ordering
    switch ($orderby) {
        case 'title':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'title-desc':
            $args['orderby'] = 'title';
            $args['order'] = 'DESC';
            break;
        case 'date':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    // Tax query for breed
    $tax_query = array();
    if ($breed) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $breed,
        );
    }

    // Meta query for gender
    $meta_query = array();
    if ($gender) {
        $meta_query[] = array(
            'key'     => 'gender',
            'value'   => $gender,
            'compare' => '=',
        );
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }
    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
    } else {
        ?>
        <li class="puppy-grid__empty">
            <div class="puppy-grid__empty-content">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <h3><?php esc_html_e('No puppies found', 'furrylicious'); ?></h3>
                <p><?php esc_html_e('Try adjusting your filters to see more adorable puppies.', 'furrylicious'); ?></p>
            </div>
        </li>
        <?php
    }

    $html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success(array(
        'html'       => $html,
        'found'      => $query->found_posts,
        'max_pages'  => $query->max_num_pages,
        'current'    => $paged,
    ));
}
add_action('wp_ajax_furrylicious_filter_puppies', 'furrylicious_filter_puppies');
add_action('wp_ajax_nopriv_furrylicious_filter_puppies', 'furrylicious_filter_puppies');

/**
 * Get breeds for filter dropdown
 *
 * @return array Array of breed terms.
 */
function furrylicious_get_filter_breeds() {
    $breeds = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'parent'     => 0, // Top-level only
    ));

    if (is_wp_error($breeds)) {
        return array();
    }

    return $breeds;
}

/**
 * Get available genders for filter
 *
 * @return array Array of genders.
 */
function furrylicious_get_filter_genders() {
    return array(
        'male'   => __('Male', 'furrylicious'),
        'female' => __('Female', 'furrylicious'),
    );
}

/**
 * Output filter form
 */
function furrylicious_output_filter_form() {
    $breeds = furrylicious_get_filter_breeds();
    $genders = furrylicious_get_filter_genders();
    $current_breed = isset($_GET['breed']) ? sanitize_text_field($_GET['breed']) : '';
    $current_gender = isset($_GET['gender']) ? sanitize_text_field($_GET['gender']) : '';
    ?>
    <form class="puppy-filter" id="puppy-filter" method="get">
        <div class="puppy-filter__group">
            <label for="filter-breed" class="puppy-filter__label">
                <?php esc_html_e('Breed', 'furrylicious'); ?>
            </label>
            <select name="breed" id="filter-breed" class="puppy-filter__select">
                <option value=""><?php esc_html_e('All Breeds', 'furrylicious'); ?></option>
                <?php foreach ($breeds as $breed) : ?>
                    <option value="<?php echo esc_attr($breed->slug); ?>" <?php selected($current_breed, $breed->slug); ?>>
                        <?php echo esc_html($breed->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="puppy-filter__group">
            <label for="filter-gender" class="puppy-filter__label">
                <?php esc_html_e('Gender', 'furrylicious'); ?>
            </label>
            <select name="gender" id="filter-gender" class="puppy-filter__select">
                <option value=""><?php esc_html_e('All Genders', 'furrylicious'); ?></option>
                <?php foreach ($genders as $value => $label) : ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($current_gender, $value); ?>>
                        <?php echo esc_html($label); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="puppy-filter__submit btn btn--primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <?php esc_html_e('Filter', 'furrylicious'); ?>
        </button>

        <button type="reset" class="puppy-filter__reset btn btn--outline">
            <?php esc_html_e('Clear', 'furrylicious'); ?>
        </button>
    </form>
    <?php
}
