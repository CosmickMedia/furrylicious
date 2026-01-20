<?php
/**
 * Template Part: Available Puppies Section
 *
 * Displays available puppies in a bento grid layout.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get available puppies
$puppies = furrylicious_get_available_puppies(4);

if (empty($puppies)) {
    return;
}
?>

<section class="section section-puppies" id="available-puppies">
    <div class="container">
        <div class="bento-grid bento-grid--puppies">
            <?php
            $count = 0;

            foreach ($puppies as $key => $puppy) :
                $count++;

                // After first 2 puppies, insert CTA card
                if ($count === 3) :
            ?>
                    <!-- CTA Card -->
                    <div class="bento-item bento-item--cta">
                        <div class="bento-cta">
                            <div class="bento-cta__shimmer"></div>
                            <div class="bento-cta__content">
                                <h2 class="section-title section-title--left">
                                    <?php esc_html_e('Available Puppies For Sale', 'furrylicious'); ?>
                                </h2>
                                <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--primary">
                                    <?php esc_html_e('View All', 'furrylicious'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endif;
            ?>

                <!-- Puppy Card -->
                <div class="bento-item<?php echo ($count === 1 || $count === 2) ? ' bento-item--tall' : ''; ?>">
                    <?php
                    furrylicious_get_template_part('template-parts/puppies/puppy-card', null, array(
                        'puppy' => $puppy,
                        'featured' => ($count === 1 || $count === 2),
                    ));
                    ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>
