<?php
/**
 * Template: Single Breed
 *
 * Displays individual breed information pages.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $breed_name = get_the_title();
?>

<article <?php post_class('breed-single'); ?>>
    <!-- Hero Section -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="breed-hero">
            <div class="breed-hero__image">
                <?php the_post_thumbnail('large', array(
                    'class' => 'breed-hero__img',
                    'alt'   => esc_attr($breed_name),
                )); ?>
            </div>
            <div class="breed-hero__overlay">
                <div class="container">
                    <h1 class="breed-hero__title">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </div>
    <?php else : ?>
        <header class="page-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </header>
    <?php endif; ?>

    <!-- Breed Content -->
    <div class="breed-content section">
        <div class="container">
            <div class="breed-description">
                <?php the_content(); ?>
            </div>

            <?php
            // Quick Facts (if ACF fields exist)
            $temperament = get_field('temperament');
            $size = get_field('size');
            $life_expectancy = get_field('life_expectancy');
            $activity_level = get_field('activity_level');

            if ($temperament || $size || $life_expectancy || $activity_level) :
            ?>
                <div class="breed-facts">
                    <h2 class="breed-facts__title">
                        <?php esc_html_e('Quick Facts', 'furrylicious'); ?>
                    </h2>
                    <div class="breed-facts__grid">
                        <?php if ($temperament) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Temperament', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($temperament); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($size) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Size', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($size); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($life_expectancy) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Life Expectancy', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($life_expectancy); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($activity_level) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Activity Level', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($activity_level); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>

<!-- Available Puppies of This Breed -->
<section class="section--lightest-pink">
    <div class="container">
        <h2 class="section-title text-center">
            <?php
            printf(
                esc_html__('Available %s Puppies', 'furrylicious'),
                esc_html($breed_name)
            );
            ?>
        </h2>

        <?php
        if (function_exists('furrylicious_get_available_pets_by_breed')) {
            furrylicious_get_available_pets_by_breed($breed_name, 8);
        }
        ?>

        <!-- Gallery Puppies (Found Homes) -->
        <?php
        if (function_exists('furrylicious_get_related_pets_gallery')) {
            furrylicious_get_related_pets_gallery($breed_name, 4);
        }
        ?>
    </div>
</section>

<!-- Breed Videos -->
<?php
if (class_exists('PetkeyVideosFunctions')) {
    global $petkey_videos_functions;

    if ($petkey_videos_functions) {
        $breed_videos = $petkey_videos_functions->get_video_by_breed($breed_name);

        if (is_array($breed_videos) && count($breed_videos) > 0) :
?>
<section class="section breed-videos">
    <div class="container">
        <?php foreach ($breed_videos as $breed_video) : ?>
            <div class="breed-video">
                <h2 class="section-title text-center">
                    <?php
                    printf(
                        esc_html__('Watch our video on %s puppies', 'furrylicious'),
                        esc_html($breed_name)
                    );
                    ?>
                </h2>

                <div class="breed-video__embed">
                    <?php $petkey_videos_functions->get_video_frame($breed_video); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php
        endif;
    }
}
?>

<!-- CTA Section -->
<section class="section section--pink">
    <div class="container text-center">
        <h2 class="section-title">
            <?php
            printf(
                esc_html__('Interested in a %s?', 'furrylicious'),
                esc_html($breed_name)
            );
            ?>
        </h2>
        <p class="lead">
            <?php esc_html_e('Contact us today to learn more about our available puppies!', 'furrylicious'); ?>
        </p>
        <?php
        furrylicious_get_template_part('template-parts/components/cta-button', null, array(
            'text'  => __('Contact Us', 'furrylicious'),
            'url'   => home_url('/contact-us/'),
            'style' => 'primary',
            'size'  => 'lg',
        ));
        ?>
    </div>
</section>

<?php
    endwhile;
endif;

get_footer();
?>
