<?php
/**
 * Template Part: Related Puppies
 *
 * Displays related puppies based on breed.
 *
 * @package Furrylicious
 * @version 2.0.0
 *
 * @param string $breed       Breed name.
 * @param int    $count       Number of puppies to show.
 * @param int    $exclude_id  ID to exclude (current puppy).
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get parameters
$breed = isset($args['breed']) ? $args['breed'] : '';
$count = isset($args['count']) ? absint($args['count']) : 4;
$exclude_id = isset($args['exclude_id']) ? $args['exclude_id'] : 0;

if (empty($breed)) {
    return;
}
?>

<section class="related-puppies">
    <div class="container">
        <!-- Available Puppies of Same Breed -->
        <?php
        if (function_exists('furrylicious_get_available_pets_by_breed')) {
            furrylicious_get_available_pets_by_breed($breed, $count);
        }
        ?>

        <!-- Gallery Puppies (Found Homes) -->
        <?php
        if (function_exists('furrylicious_get_related_pets_gallery')) {
            furrylicious_get_related_pets_gallery($breed, $count);
        }
        ?>

        <!-- Breed Videos -->
        <?php
        if (class_exists('PetkeyVideosFunctions')) {
            global $petkey_videos_functions;

            if ($petkey_videos_functions) {
                $breed_videos = $petkey_videos_functions->get_video_by_breed($breed);

                if (is_array($breed_videos) && count($breed_videos) > 0) {
                    foreach ($breed_videos as $breed_video) :
                    ?>
                        <div class="breed-video">
                            <hr class="section-divider" />

                            <h2 class="section-title text-center">
                                <?php
                                printf(
                                    esc_html__('Watch our video on %s puppies', 'furrylicious'),
                                    esc_html($breed)
                                );
                                ?>
                            </h2>

                            <div class="breed-video__embed">
                                <?php $petkey_videos_functions->get_video_frame($breed_video); ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                }
            }
        }
        ?>
    </div>
</section>
