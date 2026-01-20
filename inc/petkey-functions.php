<?php
/**
 * Petkey API Integration Functions
 *
 * Functions for integrating with the Petkey API to display puppies.
 * Migrated from the original functions.php with improvements.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get available puppies from Petkey
 *
 * Retrieves a specified number of available puppies from the cached Petkey data.
 *
 * @param int $number_of_pets Number of pets to retrieve. Default 4.
 * @return array Array of pet objects.
 */
function furrylicious_get_available_puppies($number_of_pets = 4) {
    global $petland;

    $number_of_pets = absint($number_of_pets);
    if (empty($number_of_pets)) {
        $number_of_pets = 4;
    }

    $prefix = 'default-';
    $processed_pets_by_key = get_option($prefix . 'petland_pets_by_key', array());

    if (empty($processed_pets_by_key)) {
        return array();
    }

    $available_pets = array_chunk($processed_pets_by_key, $number_of_pets);

    return isset($available_pets[0]) ? $available_pets[0] : array();
}

// Create alias for backward compatibility
function get_available_puppies($number_of_pets = 4) {
    return furrylicious_get_available_puppies($number_of_pets);
}

/**
 * Display available pets by breed
 *
 * Outputs HTML for pets matching a specific breed.
 *
 * @param string $breed         The breed name to filter by.
 * @param int    $number_of_pets Number of pets to display. Default 4.
 * @return void
 */
function furrylicious_get_available_pets_by_breed($breed, $number_of_pets = 4) {
    global $petland;

    if (empty($breed)) {
        return;
    }

    $processed_pets_by_key = get_option('default-petland_pets_by_key', array());

    if (empty($processed_pets_by_key) || !isset($petland)) {
        return;
    }

    $pets = $petland->get_pets_by_filtering($processed_pets_by_key, 'ALL', $breed, 'ALL', '');

    if (empty($pets)) {
        return;
    }
    ?>
    <div class="related-puppies">
        <h2 class="related-puppies__title section-title text-center">
            <?php echo esc_html($breed); ?> Available Puppies
        </h2>

        <div class="row justify-content-center g-4">
            <?php
            $index = 1;
            foreach ($pets as $pet) :
                $post_link = $petland->get_permalink($pet['pet']);
                $post_image = $pet['pet']->list_photo;
                ?>
                <div class="col-6 col-md-3">
                    <a href="<?php echo esc_url($post_link); ?>" class="puppy-card puppy-card--simple">
                        <div class="puppy-card__image">
                            <img
                                src="<?php echo esc_url($post_image); ?>"
                                alt="<?php echo esc_attr($pet['pet']->breed_name . ' puppy'); ?>"
                                class="img-fluid"
                                loading="lazy"
                            />
                        </div>
                    </a>
                </div>
                <?php
                $index++;
                if ($index > $number_of_pets) {
                    break;
                }
            endforeach;
            ?>
        </div>
    </div>
    <?php
}

// Create alias for backward compatibility
function get_available_pets_by_breed($breed, $number_of_pets = 4) {
    furrylicious_get_available_pets_by_breed($breed, $number_of_pets);
}

/**
 * Display related pets from gallery
 *
 * Shows pets that have found loving homes, filtered by breed.
 *
 * @param string|int $breed          The breed name or ID.
 * @param int        $number_of_pets Number of pets to display. Default 4.
 * @return void
 */
function furrylicious_get_related_pets_gallery($breed, $number_of_pets = 4) {
    global $wpdb;

    if (empty($breed)) {
        return;
    }

    $breed_val = intval($breed);

    if (!empty($breed_val)) {
        $breed_title = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT post_title FROM $wpdb->posts WHERE post_type='breeds' AND ID=%d",
                $breed_val
            )
        );
    } else {
        $breed_title = sanitize_text_field($breed);
    }

    if (empty($breed_title)) {
        return;
    }

    $args = array(
        'post_type'      => 'pet-gallery',
        'posts_per_page' => $number_of_pets,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'   => 'breed_name',
                'value' => $breed_title,
            ),
        ),
    );

    $breeds_query = new WP_Query($args);

    if (!$breeds_query->have_posts()) {
        return;
    }
    ?>
    <div class="related-gallery">
        <hr class="related-gallery__divider" />

        <h2 class="related-gallery__title section-title text-center">
            <?php echo esc_html($breed_title); ?> Puppies Who Found Loving Homes
        </h2>

        <div class="row justify-content-center g-4">
            <?php
            while ($breeds_query->have_posts()) :
                $breeds_query->the_post();
                $post_id = get_the_ID();
                $post_link = get_permalink($post_id);
                $post_image = get_the_post_thumbnail_url($post_id);
                $breed_name = get_post_meta($post_id, 'breed_name', true);
                $gender = get_post_meta($post_id, 'gender', true);
                $coloring = get_post_meta($post_id, 'coloring', true);
                $petid = get_post_meta($post_id, 'petid', true);
                $site_name = get_bloginfo('name');

                $alt_value = implode(' - ', array_filter(array(
                    $breed_name,
                    $gender,
                    $coloring,
                    $petid,
                    $site_name,
                )));
                ?>
                <div class="col-6 col-md-3">
                    <a href="<?php echo esc_url($post_link); ?>" class="gallery-card">
                        <img
                            alt="<?php echo esc_attr($alt_value); ?>"
                            src="<?php echo esc_url($post_image); ?>"
                            class="gallery-card__image img-fluid"
                            loading="lazy"
                        />
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    wp_reset_postdata();
}

// Create alias for backward compatibility
function get_related_pets_gallery($breed, $number_of_pets = 4) {
    furrylicious_get_related_pets_gallery($breed, $number_of_pets);
}

/**
 * Get breed description/ID
 *
 * Retrieves the post ID for a breed by name.
 *
 * @param string $breed_name The breed name to search for.
 * @return int|null The breed post ID or null if not found.
 */
function furrylicious_get_breeds_desc($breed_name) {
    global $wpdb;

    if (empty($breed_name)) {
        return null;
    }

    $breed_name = sanitize_text_field($breed_name);

    $breed_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT ID FROM $wpdb->posts
             WHERE post_title LIKE %s
             AND post_status = 'publish'
             AND post_type = 'breeds'
             LIMIT 1",
            $breed_name . '%'
        )
    );

    return $breed_id ? intval($breed_id) : null;
}

// Create alias for backward compatibility
function get_breeds_desc($breed_name) {
    return furrylicious_get_breeds_desc($breed_name);
}

/**
 * Save coming soon pets
 *
 * Fetches and saves "coming soon" pets from the Petkey API.
 *
 * @param array  $processed_pets_by_key Existing processed pets.
 * @param string $location              Location identifier.
 * @return void
 */
function furrylicious_save_coming_soon_pets($processed_pets_by_key, $location) {
    global $petland_settings;

    if (empty($petland_settings->api)) {
        return;
    }

    $apikey = $petland_settings->api;

    $list_args = array(
        'filterOptions' => array(
            'BreedId'  => '',
            'Gender'   => '',
            'HasPhoto' => 'false',
            'PetType'  => '',
            'Status'   => 'coming_soon',
        ),
    );

    $response = wp_remote_post(
        'https://api.petkey.org/v4/partners/search',
        array(
            'body'    => wp_json_encode($list_args['filterOptions']),
            'headers' => array(
                'Content-Type'  => 'application/json',
                'Authorization' => 'PETKEY-AUTH ' . $apikey,
            ),
            'timeout' => 30,
        )
    );

    if (is_wp_error($response)) {
        error_log('Furrylicious: Petkey API error - ' . $response->get_error_message());
        return;
    }

    $pet_lists_data = json_decode(wp_remote_retrieve_body($response));

    if (!is_array($pet_lists_data) || empty($pet_lists_data)) {
        return;
    }

    foreach ($pet_lists_data as $pet_list) {
        $pet_data = furrylicious_get_single_petinfo_coming_soon($location, $apikey, $pet_list->PetId);
        if ($pet_data) {
            $processed_pets_by_key[$pet_list->PetId] = $pet_data;
        }
    }

    $prefix = $location . '-';
    update_option($prefix . 'petland_pets_by_key', $processed_pets_by_key);
}
add_action('after_save_petland_data', 'furrylicious_save_coming_soon_pets', 20, 2);

/**
 * Get single pet info for coming soon pets
 *
 * @param string $location Location identifier.
 * @param string $apikey   API key.
 * @param int    $pet_id   Pet ID.
 * @return object|null Pet data object or null on failure.
 */
function furrylicious_get_single_petinfo_coming_soon($location, $apikey, $pet_id) {
    global $petland_settings, $petland;

    $response = wp_remote_get(
        'https://api.petkey.org/v4/partners/Pet/' . intval($pet_id),
        array(
            'headers' => array(
                'Content-Type'  => 'application/json',
                'Authorization' => 'PETKEY-AUTH ' . $apikey,
            ),
            'timeout' => 30,
        )
    );

    if (is_wp_error($response)) {
        error_log('Furrylicious: Petkey API error - ' . $response->get_error_message());
        return null;
    }

    $pet = json_decode(wp_remote_retrieve_body($response));

    if (empty($pet)) {
        return null;
    }

    $pet_data = new stdClass();

    $status = ($pet->Status == 'OnHold') ? $pet->Status : 'coming_soon';

    $pet_data->petid = $pet->PetId;
    $pet_data->name = $pet->PetName;
    $pet_data->age = $pet->Age;
    $pet_data->animal_type = strtoupper($pet->PetType);
    $pet_data->breed_name = $pet->BreedName;
    $pet_data->breed_slug = sanitize_title($pet->BreedName);
    $pet_data->coloring = $pet->Coloring;
    $pet_data->gender = $pet->Gender;
    $pet_data->birth_date = $pet->BirthDate;
    $pet_data->status = $status;
    $pet_data->reference_id = $pet->ReferenceNumber;
    $pet_data->list_photo = isset($pet->Photo->BaseUrl) ? $pet->Photo->BaseUrl . $pet->Photo->Size300 : '';
    $pet_data->list_photo_gallery = isset($pet->Photo->BaseUrl) ? $pet->Photo->BaseUrl . $pet->Photo->Size800 : '';
    $pet_data->price = isset($pet->Price) ? $pet->Price : '';
    $pet_data->sales_price = isset($pet->SalePrice) ? $pet->SalePrice : '';
    $pet_data->location = $location;
    $pet_data->Description = isset($pet->Description) ? $pet->Description : '';

    if (!empty($petland_settings->api_locations) && $location != 'default') {
        $pet_data->location_name = $petland_settings->api_locations[$location][0];
        $pet_data->location_phone = $petland_settings->location_number[$location];
    } else {
        $pet_data->location_name = $location;
        $pet_data->location_phone = isset($petland_settings->location_number) ? $petland_settings->location_number : '';
    }

    $pet_data->pet_photos = array();
    if (!empty($pet->Photos)) {
        foreach ($pet->Photos as $petphoto) {
            $pet_data->pet_photos[] = $petphoto->BaseUrl . $petphoto->Size800;
        }
    }

    if (isset($petland)) {
        $pet_data->permalink = $petland->get_permalink($pet_data);
    }

    return $pet_data;
}

/**
 * Enable Petkey listing template
 */
add_filter('petkey_use_listing_template', '__return_true');

/**
 * Get puppy card HTML
 *
 * Returns formatted HTML for a puppy card.
 *
 * @param object $puppy   Puppy data object.
 * @param bool   $featured Whether this is a featured card.
 * @return string HTML for puppy card.
 */
function furrylicious_get_puppy_card_html($puppy, $featured = false) {
    $card_class = $featured ? 'puppy-card puppy-card--featured' : 'puppy-card';

    ob_start();
    ?>
    <article class="<?php echo esc_attr($card_class); ?>">
        <a href="<?php echo esc_url($puppy->permalink); ?>" class="puppy-card__link">
            <div class="puppy-card__image-wrapper">
                <img
                    src="<?php echo esc_url($puppy->list_photo); ?>"
                    alt="<?php echo esc_attr($puppy->breed_name . ' puppy'); ?>"
                    class="puppy-card__image"
                    loading="lazy"
                />
                <?php if (!empty($puppy->gender)) : ?>
                    <span class="puppy-card__badge puppy-card__badge--<?php echo esc_attr(strtolower($puppy->gender)); ?>">
                        <?php echo esc_html($puppy->gender); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="puppy-card__content">
                <?php if (!empty($puppy->name)) : ?>
                    <h3 class="puppy-card__name"><?php echo esc_html($puppy->name); ?></h3>
                <?php endif; ?>
                <span class="puppy-card__breed"><?php echo esc_html($puppy->breed_name); ?></span>
            </div>
            <div class="puppy-card__overlay">
                <span class="btn btn--primary">Learn More</span>
            </div>
        </a>
    </article>
    <?php
    return ob_get_clean();
}
