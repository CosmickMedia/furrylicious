<?php
/**
 * Template: Single Pet Gallery (Adopted Puppies)
 *
 * Displays individual adopted puppy pages from the pet-gallery CPT.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();

if (have_posts()) : the_post();
    // Get post data
    $post_id = get_the_ID();
    $post_image = get_the_post_thumbnail_url($post_id, 'large');
    $site_name = get_bloginfo('name');

    // Fallback image
    if (empty($post_image)) {
        $post_image = FURRYLICIOUS_ASSETS . '/images/no-image.jpg';
    }

    // Get pet meta data
    $petid = get_post_meta($post_id, 'petid', true);
    $name = get_post_meta($post_id, 'name', true);
    $age = get_post_meta($post_id, 'age', true);
    $animal_type = get_post_meta($post_id, 'animal_type', true);
    $breed_name = get_post_meta($post_id, 'breed_name', true);
    $coloring = get_post_meta($post_id, 'coloring', true);
    $gender = get_post_meta($post_id, 'gender', true);
    $birth_date = get_post_meta($post_id, 'birth_date', true);
    $status = get_post_meta($post_id, 'status', true);
    $reference_id = get_post_meta($post_id, 'reference_id', true);
    $location_name = get_post_meta($post_id, 'location', true);

    // Build alt text
    $alt_value = implode(' - ', array_filter(array(
        $breed_name,
        $animal_type,
        $gender,
        $coloring,
        $petid,
        $site_name,
    )));

    // Get contact info
    $contact = furrylicious_get_contact_info();
?>

<div class="puppy-detail puppy-detail--adopted">
    <div class="container">

        <!-- Page Title -->
        <header class="puppy-detail__header text-center">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__('Adopted %s', 'furrylicious'),
                    esc_html($breed_name)
                );
                ?>
            </h1>
        </header>

        <div class="puppy-detail__grid">
            <!-- Left Column: Image & Info -->
            <div class="puppy-detail__gallery">
                <!-- Main Image -->
                <div class="puppy-gallery">
                    <div class="puppy-gallery__main">
                        <a href="<?php echo esc_url($post_image); ?>"
                           data-lightbox="puppy-gallery"
                           data-alt="<?php echo esc_attr($alt_value); ?>">
                            <img src="<?php echo esc_url($post_image); ?>"
                                 alt="<?php echo esc_attr($alt_value); ?>"
                                 class="puppy-gallery__image" />
                        </a>
                    </div>
                </div>

                <!-- Puppy Details -->
                <div class="puppy-detail__info">
                    <div class="puppy-info">
                        <?php if (!empty($breed_name)) : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Breed', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($breed_name); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($name)) : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Name', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($name); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($birth_date)) : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Birth Date', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($birth_date); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($coloring)) : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Color', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($coloring); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($gender)) : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Gender', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($gender); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($reference_id)) : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Reference ID', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($reference_id); ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($location_name) && $location_name !== 'default') : ?>
                            <div class="puppy-info__box">
                                <div class="puppy-info__label"><?php esc_html_e('Location', 'furrylicious'); ?></div>
                                <div class="puppy-info__value"><?php echo esc_html($location_name); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Inquiry Form -->
            <div class="puppy-detail__form-wrapper">
                <!-- CTA Message -->
                <div class="puppy-detail__cta puppy-detail__cta--adopted">
                    <p class="puppy-detail__cta-text">
                        <?php esc_html_e('Are you looking for a puppy like this? Contact Us Below!', 'furrylicious'); ?>
                    </p>
                </div>

                <!-- Inquiry Form -->
                <?php
                // Build a puppy object for the form
                $puppy = (object) array(
                    'breed_name'  => $breed_name,
                    'animal_type' => $animal_type,
                    'permalink'   => get_permalink(),
                );

                furrylicious_get_template_part('template-parts/puppies/puppy-inquiry-form', null, array(
                    'puppy' => $puppy,
                ));
                ?>

                <!-- Social Share -->
                <div class="puppy-share d-none d-md-flex">
                    <?php
                    $current_url = get_permalink();
                    $share_text = sprintf(
                        __('Check out this %s puppy!', 'furrylicious'),
                        $breed_name
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
        'breed' => $breed_name,
        'count' => 4,
    ));
    ?>
</div>

<?php
endif; // have_posts

get_footer();
?>
