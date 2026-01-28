<?php
/**
 * The template for displaying search results pages
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Modify query to search only products
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'product');
    }
});

get_header();
?>

<main id="main-content" class="site-main search-results">

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__('Search Results for: %s', 'furrylicious'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>

            <!-- Search Form -->
            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <div class="container">
        <?php if (have_posts()) : ?>

            <p class="search-results__count">
                <?php
                global $wp_query;
                printf(
                    /* translators: %d: number of results */
                    esc_html(_n(
                        '%d puppy found',
                        '%d puppies found',
                        $wp_query->found_posts,
                        'furrylicious'
                    )),
                    $wp_query->found_posts
                );
                ?>
            </p>

            <div class="posts-grid">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', 'search');
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <nav class="pagination-nav" aria-label="<?php esc_attr_e('Search results navigation', 'furrylicious'); ?>">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => sprintf(
                        '<span aria-hidden="true">&larr;</span> <span class="screen-reader-text">%s</span>',
                        __('Previous', 'furrylicious')
                    ),
                    'next_text' => sprintf(
                        '<span class="screen-reader-text">%s</span> <span aria-hidden="true">&rarr;</span>',
                        __('Next', 'furrylicious')
                    ),
                ));
                ?>
            </nav>

        <?php else : ?>

            <div class="search-no-results">
                <div class="search-no-results__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        <line x1="8" y1="11" x2="14" y2="11"/>
                    </svg>
                </div>
                <h2 class="search-no-results__title"><?php esc_html_e('No puppies found', 'furrylicious'); ?></h2>
                <p class="search-no-results__text"><?php esc_html_e('We couldn\'t find any puppies matching your search. Try a different search term or browse all our available puppies.', 'furrylicious'); ?></p>
                <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--primary btn--lg">
                    <?php esc_html_e('Browse All Puppies', 'furrylicious'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>

        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>
