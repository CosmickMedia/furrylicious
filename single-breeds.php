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
        $breed_id = get_the_ID();

        // ACF fields
        $temperament = get_field('temperament');
        $size = get_field('size');
        $life_expectancy = get_field('life_expectancy');
        $activity_level = get_field('activity_level');
        $adult_weight_min = get_field('adult_weight_min');
        $adult_weight_max = get_field('adult_weight_max');
        $adult_height_min = get_field('adult_height_min');
        $adult_height_max = get_field('adult_height_max');

        // Trait ratings (1-5 scale)
        $trainability = get_field('trainability');
        $shedding = get_field('shedding');
        $barking = get_field('barking');
        $energy_level = get_field('energy_level');
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
        <header class="breeds-archive__header">
            <div class="container">
                <h1 class="breeds-archive__title"><?php the_title(); ?></h1>
            </div>
        </header>
    <?php endif; ?>

    <!-- Breed Content -->
    <div class="breed-content">
        <div class="container">
            <div class="breed-description">
                <?php the_content(); ?>
            </div>

            <?php if ($temperament || $size || $life_expectancy || $activity_level || $adult_weight_min) : ?>
                <div class="breed-facts">
                    <h2 class="breed-facts__title">
                        <?php esc_html_e('Breed Characteristics', 'furrylicious'); ?>
                    </h2>
                    <div class="breed-facts__grid">
                        <?php if ($size) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Size', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($size); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($adult_weight_min && $adult_weight_max) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Adult Weight', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($adult_weight_min . ' - ' . $adult_weight_max . ' lbs'); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($adult_height_min && $adult_height_max) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Adult Height', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($adult_height_min . ' - ' . $adult_height_max . '"'); ?></span>
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

                        <?php if ($temperament) : ?>
                            <div class="breed-fact">
                                <span class="breed-fact__label"><?php esc_html_e('Temperament', 'furrylicious'); ?></span>
                                <span class="breed-fact__value"><?php echo esc_html($temperament); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($trainability || $shedding || $barking || $energy_level) : ?>
                        <div class="breed-traits">
                            <?php if ($trainability) : ?>
                                <div class="breed-trait">
                                    <div class="breed-trait__header">
                                        <span class="breed-trait__label"><?php esc_html_e('Trainability', 'furrylicious'); ?></span>
                                        <span class="breed-trait__value"><?php echo esc_html($trainability); ?>/5</span>
                                    </div>
                                    <div class="breed-trait__bar">
                                        <div class="breed-trait__fill breed-trait__fill--sage" style="width: <?php echo esc_attr($trainability * 20); ?>%;"></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($shedding) : ?>
                                <div class="breed-trait">
                                    <div class="breed-trait__header">
                                        <span class="breed-trait__label"><?php esc_html_e('Shedding', 'furrylicious'); ?></span>
                                        <span class="breed-trait__value"><?php echo esc_html($shedding); ?>/5</span>
                                    </div>
                                    <div class="breed-trait__bar">
                                        <div class="breed-trait__fill breed-trait__fill--rose" style="width: <?php echo esc_attr($shedding * 20); ?>%;"></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($barking) : ?>
                                <div class="breed-trait">
                                    <div class="breed-trait__header">
                                        <span class="breed-trait__label"><?php esc_html_e('Barking', 'furrylicious'); ?></span>
                                        <span class="breed-trait__value"><?php echo esc_html($barking); ?>/5</span>
                                    </div>
                                    <div class="breed-trait__bar">
                                        <div class="breed-trait__fill breed-trait__fill--rose" style="width: <?php echo esc_attr($barking * 20); ?>%;"></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($energy_level) : ?>
                                <div class="breed-trait">
                                    <div class="breed-trait__header">
                                        <span class="breed-trait__label"><?php esc_html_e('Energy Level', 'furrylicious'); ?></span>
                                        <span class="breed-trait__value"><?php echo esc_html($energy_level); ?>/5</span>
                                    </div>
                                    <div class="breed-trait__bar">
                                        <div class="breed-trait__fill breed-trait__fill--sage" style="width: <?php echo esc_attr($energy_level * 20); ?>%;"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>

<!-- Available Puppies of This Breed -->
<?php
// Query available puppies of this breed
$puppies_args = array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'name',
            'terms'    => $breed_name,
        ),
    ),
);
$puppies_query = new WP_Query($puppies_args);

if ($puppies_query->have_posts()) :
?>
<section class="related-puppies">
    <div class="container">
        <div class="related-puppies__header">
            <h2 class="related-puppies__title">
                <?php
                printf(
                    esc_html__('Available %s Puppies', 'furrylicious'),
                    esc_html($breed_name)
                );
                ?>
            </h2>
            <p class="related-puppies__subtitle">
                <?php esc_html_e('Meet our adorable puppies waiting for their forever homes', 'furrylicious'); ?>
            </p>
        </div>

        <ul class="puppy-grid products">
            <?php
            while ($puppies_query->have_posts()) :
                $puppies_query->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
            wp_reset_postdata();
            ?>
        </ul>

        <div class="related-puppies__footer">
            <a href="<?php echo esc_url(add_query_arg('breed', sanitize_title($breed_name), wc_get_page_permalink('shop'))); ?>" class="btn btn--outline">
                <?php esc_html_e('View All Available Puppies', 'furrylicious'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="breeds-cta">
    <div class="container text-center">
        <h2 class="breeds-cta__title">
            <?php
            printf(
                esc_html__('Interested in a %s?', 'furrylicious'),
                esc_html($breed_name)
            );
            ?>
        </h2>
        <p class="breeds-cta__description">
            <?php esc_html_e('Contact us today to learn more about our available puppies and upcoming litters!', 'furrylicious'); ?>
        </p>
        <div class="breeds-cta__buttons">
            <a href="<?php echo esc_url(home_url('/contact/?breed=' . urlencode($breed_name))); ?>" class="btn btn--primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <?php esc_html_e('Inquire Now', 'furrylicious'); ?>
            </a>
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn--outline">
                <?php esc_html_e('View All Puppies', 'furrylicious'); ?>
            </a>
        </div>
    </div>
</section>

<?php
    endwhile;
endif;

get_footer();
?>
