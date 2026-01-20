<?php
/**
 * Petkey Template Override: Search Animal (Puppy Detail)
 *
 * This template overrides the Petkey plugin's default animal detail page.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();

// Get the current pet data
global $petland_settings, $petland;
$pet = isset($GLOBALS['petland_pet']) ? $GLOBALS['petland_pet'] : null;

if (!$pet) {
    get_template_part('template-parts/content', 'none');
    get_footer();
    return;
}

// Prepare alt text
$site_name = get_bloginfo('name');
$alt_value = implode(' - ', array_filter(array(
    $pet->breed_name,
    $pet->animal_type,
    $pet->gender,
    $pet->coloring,
    $pet->petid,
    $site_name,
)));

// Get contact info
$contact = furrylicious_get_contact_info();
?>

<div class="puppy-detail petkey">
    <div class="container">

        <!-- Page Title -->
        <header class="puppy-detail__header text-center">
            <h1 class="page-title">
                <?php
                if (!empty($pet->name)) {
                    echo esc_html($pet->name) . ' - ';
                }
                echo esc_html($pet->breed_name);
                ?>
            </h1>
        </header>

        <div class="puppy-detail__grid">
            <!-- Left Column: Gallery & Info -->
            <div class="puppy-detail__gallery">
                <!-- Main Image -->
                <?php
                $main_image = !empty($pet->list_photo_gallery) ? $pet->list_photo_gallery : $pet->list_photo;
                $gallery = isset($pet->pet_photos) ? $pet->pet_photos : array();

                furrylicious_get_template_part('template-parts/puppies/puppy-gallery', null, array(
                    'main_image' => $main_image,
                    'gallery'    => $gallery,
                    'alt_base'   => $alt_value,
                ));
                ?>

                <!-- Puppy Details -->
                <div class="puppy-detail__info">
                    <?php
                    furrylicious_get_template_part('template-parts/puppies/puppy-details', null, array(
                        'puppy' => $pet,
                    ));
                    ?>
                </div>
            </div>

            <!-- Right Column: Inquiry Form -->
            <div class="puppy-detail__form-wrapper">
                <!-- CTA Message -->
                <div class="puppy-detail__cta">
                    <p class="puppy-detail__cta-text">
                        <?php esc_html_e('Interested in this puppy? Contact us below!', 'furrylicious'); ?>
                    </p>
                </div>

                <!-- Inquiry Form -->
                <?php
                furrylicious_get_template_part('template-parts/puppies/puppy-inquiry-form', null, array(
                    'puppy' => $pet,
                ));
                ?>

                <!-- Social Share -->
                <div class="puppy-share d-none d-md-flex">
                    <?php
                    $current_url = get_permalink();
                    $share_text = sprintf(
                        __('Check out this %s puppy!', 'furrylicious'),
                        $pet->breed_name
                    );
                    ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="puppy-share__btn"
                       aria-label="<?php esc_attr_e('Share on Facebook', 'furrylicious'); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($current_url); ?>&text=<?php echo urlencode($share_text); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="puppy-share__btn"
                       aria-label="<?php esc_attr_e('Share on Twitter', 'furrylicious'); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Related Puppies -->
<div class="section--lightest-pink">
    <?php
    furrylicious_get_template_part('template-parts/puppies/related-puppies', null, array(
        'breed' => $pet->breed_name,
        'count' => 4,
    ));
    ?>
</div>

<?php
// Get breed description if available
$breed_id = furrylicious_get_breeds_desc($pet->breed_name);

if ($breed_id) :
    $breed_post = get_post($breed_id);
    if ($breed_post) :
?>
    <section class="section breed-description-section">
        <div class="container">
            <div class="breed-title">
                <h2 class="section-title text-center">
                    <?php
                    printf(
                        esc_html__('About %s Puppies', 'furrylicious'),
                        esc_html($pet->breed_name)
                    );
                    ?>
                </h2>
            </div>
            <div class="breed-description">
                <?php echo wp_kses_post($breed_post->post_content); ?>
            </div>
        </div>
    </section>
<?php
    endif;
endif;

get_footer();
