<?php
/**
 * Video Gallery Add-on
 *
 * Custom post type and display for video galleries.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Pet Videos custom post type
 */
function furrylicious_register_video_cpt() {
    $labels = array(
        'name'               => __('Pet Videos', 'furrylicious'),
        'singular_name'      => __('Pet Video', 'furrylicious'),
        'add_new'            => __('Add New Video', 'furrylicious'),
        'add_new_item'       => __('Add New Pet Video', 'furrylicious'),
        'edit_item'          => __('Edit Pet Video', 'furrylicious'),
        'new_item'           => __('New Pet Video', 'furrylicious'),
        'view_item'          => __('View Pet Video', 'furrylicious'),
        'search_items'       => __('Search Pet Videos', 'furrylicious'),
        'not_found'          => __('No videos found', 'furrylicious'),
        'not_found_in_trash' => __('No videos found in trash', 'furrylicious'),
        'menu_name'          => __('Pet Videos', 'furrylicious'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'videos'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-video-alt3',
        'supports'           => array('title', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('pet-videos', $args);
}
add_action('init', 'furrylicious_register_video_cpt');

/**
 * Register Video Category taxonomy
 */
function furrylicious_register_video_taxonomy() {
    $labels = array(
        'name'              => __('Video Categories', 'furrylicious'),
        'singular_name'     => __('Video Category', 'furrylicious'),
        'search_items'      => __('Search Categories', 'furrylicious'),
        'all_items'         => __('All Categories', 'furrylicious'),
        'parent_item'       => __('Parent Category', 'furrylicious'),
        'parent_item_colon' => __('Parent Category:', 'furrylicious'),
        'edit_item'         => __('Edit Category', 'furrylicious'),
        'update_item'       => __('Update Category', 'furrylicious'),
        'add_new_item'      => __('Add New Category', 'furrylicious'),
        'new_item_name'     => __('New Category Name', 'furrylicious'),
        'menu_name'         => __('Categories', 'furrylicious'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'video-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('videos_category', array('pet-videos'), $args);
}
add_action('init', 'furrylicious_register_video_taxonomy');

/**
 * Add video meta boxes
 */
function furrylicious_video_meta_boxes() {
    add_meta_box(
        'furrylicious_video_info',
        __('Video Information', 'furrylicious'),
        'furrylicious_video_info_callback',
        'pet-videos',
        'normal',
        'high'
    );

    add_meta_box(
        'furrylicious_video_preview',
        __('Video Preview', 'furrylicious'),
        'furrylicious_video_preview_callback',
        'pet-videos',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'furrylicious_video_meta_boxes');

/**
 * Video info meta box callback
 *
 * @param WP_Post $post Current post object.
 */
function furrylicious_video_info_callback($post) {
    wp_nonce_field('furrylicious_video_meta', 'furrylicious_video_nonce');

    $youtube_id = get_post_meta($post->ID, 'youtube_video_id', true);
    $vimeo_id = get_post_meta($post->ID, 'vimeo_video_id', true);
    ?>
    <div class="furrylicious-video-fields">
        <p>
            <label for="youtube_video_id"><strong><?php esc_html_e('YouTube Video ID:', 'furrylicious'); ?></strong></label>
            <input type="text"
                   name="youtube_video_id"
                   id="youtube_video_id"
                   value="<?php echo esc_attr($youtube_id); ?>"
                   class="widefat"
                   placeholder="e.g., RDBwixvR1uY" />
            <span class="description">
                <?php esc_html_e('From https://www.youtube.com/watch?v=RDBwixvR1uY, the ID is: RDBwixvR1uY', 'furrylicious'); ?>
            </span>
        </p>
        <p style="margin: 20px 0; text-align: center; color: #666;">
            <strong><?php esc_html_e('OR', 'furrylicious'); ?></strong>
        </p>
        <p>
            <label for="vimeo_video_id"><strong><?php esc_html_e('Vimeo Video ID:', 'furrylicious'); ?></strong></label>
            <input type="text"
                   name="vimeo_video_id"
                   id="vimeo_video_id"
                   value="<?php echo esc_attr($vimeo_id); ?>"
                   class="widefat"
                   placeholder="e.g., 84188053" />
            <span class="description">
                <?php esc_html_e('From https://vimeo.com/84188053, the ID is: 84188053', 'furrylicious'); ?>
            </span>
        </p>
    </div>
    <?php
}

/**
 * Video preview meta box callback
 *
 * @param WP_Post $post Current post object.
 */
function furrylicious_video_preview_callback($post) {
    $youtube_id = get_post_meta($post->ID, 'youtube_video_id', true);
    $vimeo_id = get_post_meta($post->ID, 'vimeo_video_id', true);

    if ($youtube_id) {
        ?>
        <div class="video-preview">
            <p><strong><?php esc_html_e('YouTube:', 'furrylicious'); ?></strong></p>
            <div class="video-embed" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?rel=0"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                        frameborder="0"
                        allowfullscreen></iframe>
            </div>
        </div>
        <?php
    }

    if ($vimeo_id) {
        ?>
        <div class="video-preview" style="<?php echo $youtube_id ? 'margin-top: 15px;' : ''; ?>">
            <p><strong><?php esc_html_e('Vimeo:', 'furrylicious'); ?></strong></p>
            <div class="video-embed" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                <iframe src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                        frameborder="0"
                        allowfullscreen></iframe>
            </div>
        </div>
        <?php
    }

    if (!$youtube_id && !$vimeo_id) {
        echo '<p class="description">' . esc_html__('Enter a video ID to see preview.', 'furrylicious') . '</p>';
    }
}

/**
 * Save video meta
 *
 * @param int $post_id Post ID.
 */
function furrylicious_save_video_meta($post_id) {
    // Check nonce
    if (!isset($_POST['furrylicious_video_nonce']) ||
        !wp_verify_nonce($_POST['furrylicious_video_nonce'], 'furrylicious_video_meta')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check post type
    if (!isset($_POST['post_type']) || 'pet-videos' !== $_POST['post_type']) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save YouTube ID
    if (isset($_POST['youtube_video_id'])) {
        update_post_meta($post_id, 'youtube_video_id', sanitize_text_field($_POST['youtube_video_id']));
    }

    // Save Vimeo ID
    if (isset($_POST['vimeo_video_id'])) {
        update_post_meta($post_id, 'vimeo_video_id', sanitize_text_field($_POST['vimeo_video_id']));
    }

    // Set flag for has video
    $youtube_id = get_post_meta($post_id, 'youtube_video_id', true);
    $vimeo_id = get_post_meta($post_id, 'vimeo_video_id', true);
    update_post_meta($post_id, '_has_video', (!empty($youtube_id) || !empty($vimeo_id)) ? 'yes' : 'no');
}
add_action('save_post', 'furrylicious_save_video_meta');

/**
 * Add video modal to footer
 */
function furrylicious_video_modal() {
    include FURRYLICIOUS_ADDONS_DIR . '/video-gallery/template.php';
}
add_action('wp_footer', 'furrylicious_video_modal');

/**
 * Modify video archive query
 *
 * @param WP_Query $query The query object.
 */
function furrylicious_video_archive_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_tax('videos_category')) {
        $query->set('posts_per_page', -1);
        $query->set('order', 'ASC');
    } elseif (is_post_type_archive('pet-videos')) {
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'furrylicious_video_archive_query');

/**
 * Get video embed URL
 *
 * @param int $post_id Post ID.
 * @return string|false Video embed URL or false.
 */
function furrylicious_get_video_embed_url($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $youtube_id = get_post_meta($post_id, 'youtube_video_id', true);
    $vimeo_id = get_post_meta($post_id, 'vimeo_video_id', true);

    if ($youtube_id) {
        return 'https://www.youtube.com/embed/' . esc_attr($youtube_id) . '?rel=0&autoplay=1';
    }

    if ($vimeo_id) {
        return 'https://player.vimeo.com/video/' . esc_attr($vimeo_id) . '?autoplay=1';
    }

    return false;
}

/**
 * Get video thumbnail URL
 *
 * @param int $post_id Post ID.
 * @return string Thumbnail URL.
 */
function furrylicious_get_video_thumbnail($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // First check for featured image
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, 'medium');
    }

    // Fall back to YouTube thumbnail
    $youtube_id = get_post_meta($post_id, 'youtube_video_id', true);
    if ($youtube_id) {
        return 'https://img.youtube.com/vi/' . esc_attr($youtube_id) . '/mqdefault.jpg';
    }

    // Fall back to Vimeo (would require API call, so return placeholder)
    return FURRYLICIOUS_ASSETS . '/images/video-placeholder.jpg';
}
