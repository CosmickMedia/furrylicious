<?php
/**
 * Template: Breeds Archive
 *
 * Displays all breed information pages in a grid layout.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<div class="breeds-archive">
    <!-- Header -->
    <header class="breeds-archive__header">
        <div class="container">
            <h1 class="breeds-archive__title"><?php esc_html_e('Our Breeds', 'furrylicious'); ?></h1>
            <p class="breeds-archive__subtitle">
                <?php esc_html_e('Explore our carefully selected breeds and find your perfect companion', 'furrylicious'); ?>
            </p>
        </div>
    </header>

    <!-- Content -->
    <div class="breeds-archive__content">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="breeds-grid">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('partials/content', 'breed');
                    endwhile;
                    ?>
                </div>

                <?php
                // Pagination
                furrylicious_numeric_posts_nav();
                ?>

            <?php else : ?>
                <div class="breeds-archive__empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                        <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                        <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                    </svg>
                    <h2><?php esc_html_e('No breeds found', 'furrylicious'); ?></h2>
                    <p><?php esc_html_e('Check back soon for our available breeds.', 'furrylicious'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="breeds-cta">
        <div class="container text-center">
            <h2 class="breeds-cta__title">
                <?php esc_html_e('Found Your Perfect Breed?', 'furrylicious'); ?>
            </h2>
            <p class="breeds-cta__description">
                <?php esc_html_e('Browse our available puppies or contact us to learn more about upcoming litters.', 'furrylicious'); ?>
            </p>
            <div class="breeds-cta__buttons">
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn--primary">
                    <?php esc_html_e('View Available Puppies', 'furrylicious'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline">
                    <?php esc_html_e('Contact Us', 'furrylicious'); ?>
                </a>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
