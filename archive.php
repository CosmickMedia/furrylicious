<?php
/**
 * The template for displaying archive pages
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<main id="main-content" class="site-main archive-page">

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </div>
    </header>

    <div class="container">
        <?php if (have_posts()) : ?>

            <div class="posts-grid">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <nav class="pagination-nav" aria-label="<?php esc_attr_e('Archive navigation', 'furrylicious'); ?>">
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
                <h2><?php esc_html_e('No posts found', 'furrylicious'); ?></h2>
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'furrylicious'); ?></p>
            </div>

        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>
