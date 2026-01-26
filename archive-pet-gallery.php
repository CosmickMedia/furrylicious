<?php
/**
 * Template: Pet Gallery Archive (Adopted Puppies)
 *
 * Displays a gallery of puppies that have found their forever homes.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<div class="pet-gallery-archive">
    <!-- Header -->
    <header class="pet-gallery-archive__header">
        <div class="container">
            <h1 class="pet-gallery-archive__title"><?php esc_html_e('Happy Families', 'furrylicious'); ?></h1>
            <p class="pet-gallery-archive__subtitle">
                <?php esc_html_e('See our puppies who have found their forever homes', 'furrylicious'); ?>
            </p>
        </div>
    </header>

    <!-- Filter (optional) -->
    <?php
    $breed_terms = get_terms(array(
        'taxonomy'   => 'pet_gallery_category',
        'hide_empty' => true,
    ));

    if (!is_wp_error($breed_terms) && !empty($breed_terms)) :
        $current_term = get_queried_object();
    ?>
        <div class="pet-gallery-filter">
            <div class="container">
                <nav class="pet-gallery-filter__nav" aria-label="<?php esc_attr_e('Filter by breed', 'furrylicious'); ?>">
                    <a href="<?php echo esc_url(get_post_type_archive_link('pet-gallery')); ?>"
                       class="pet-gallery-filter__link <?php echo !is_tax() ? 'is-active' : ''; ?>">
                        <?php esc_html_e('All', 'furrylicious'); ?>
                    </a>
                    <?php foreach ($breed_terms as $term) : ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"
                           class="pet-gallery-filter__link <?php echo (is_tax() && $current_term->term_id === $term->term_id) ? 'is-active' : ''; ?>">
                            <?php echo esc_html($term->name); ?>
                            <span class="pet-gallery-filter__count"><?php echo esc_html($term->count); ?></span>
                        </a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="pet-gallery-archive__content">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="pet-gallery-grid">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('partials/content', 'pet-gallery');
                    endwhile;
                    ?>
                </div>

                <?php
                // Pagination
                furrylicious_numeric_posts_nav();
                ?>

            <?php else : ?>
                <div class="pet-gallery-archive__empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                    </svg>
                    <h2><?php esc_html_e('No adopted puppies yet', 'furrylicious'); ?></h2>
                    <p><?php esc_html_e('Check back soon to see our happy families!', 'furrylicious'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="pet-gallery-cta">
        <div class="container text-center">
            <div class="pet-gallery-cta__content">
                <h2 class="pet-gallery-cta__title">
                    <?php esc_html_e('Want to Be Part of Our Family?', 'furrylicious'); ?>
                </h2>
                <p class="pet-gallery-cta__description">
                    <?php esc_html_e('Find your perfect puppy and create your own forever memories.', 'furrylicious'); ?>
                </p>
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn--primary btn--lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <?php esc_html_e('Find Your Puppy', 'furrylicious'); ?>
                </a>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
