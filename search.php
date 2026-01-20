<?php
/**
 * The template for displaying search results pages
 *
 * @package Furrylicious
 * @version 2.0.0
 */

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
                        '%d result found',
                        '%d results found',
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

            <div class="no-results">
                <h2><?php esc_html_e('Nothing Found', 'furrylicious'); ?></h2>
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'furrylicious'); ?></p>

                <!-- Suggestions -->
                <div class="search-suggestions">
                    <h3><?php esc_html_e('Suggestions:', 'furrylicious'); ?></h3>
                    <ul>
                        <li><?php esc_html_e('Check your spelling', 'furrylicious'); ?></li>
                        <li><?php esc_html_e('Try more general keywords', 'furrylicious'); ?></li>
                        <li><?php esc_html_e('Try different keywords', 'furrylicious'); ?></li>
                    </ul>
                </div>

                <!-- Popular Links -->
                <div class="popular-links">
                    <h3><?php esc_html_e('Popular Pages:', 'furrylicious'); ?></h3>
                    <ul>
                        <li>
                            <a href="<?php echo esc_url(home_url('/available-puppies/')); ?>">
                                <?php esc_html_e('Available Puppies', 'furrylicious'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/about-us/')); ?>">
                                <?php esc_html_e('About Us', 'furrylicious'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">
                                <?php esc_html_e('Contact Us', 'furrylicious'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/faq/')); ?>">
                                <?php esc_html_e('FAQ', 'furrylicious'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>
