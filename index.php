<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>

            <?php if (is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <div class="posts-grid">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <nav class="pagination-nav" aria-label="<?php esc_attr_e('Posts navigation', 'furrylicious'); ?>">
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
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'furrylicious'); ?></p>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
