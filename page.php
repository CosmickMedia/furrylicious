<?php
/**
 * The template for displaying all pages
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            <!-- Page Header -->
            <?php if (!is_front_page()) : ?>
                <header class="page-header">
                    <div class="container">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="container">
                <div class="page-content__wrapper">
                    <div class="entry-content">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'furrylicious'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </article>

    <?php endwhile; endif; ?>
</main>

<style>
/* Page Content Styles */
.page-content__wrapper {
    max-width: 900px;
    margin: 0 auto;
    padding: var(--spacing-xl) 0 var(--spacing-2xl);
}

.page-content .entry-content {
    font-size: var(--font-size-lg);
    line-height: 1.8;
    color: var(--color-text-brown);
}

.page-content .entry-content p {
    margin-bottom: var(--spacing-lg);
}

.page-content .entry-content h2 {
    font-family: var(--font-heading);
    font-size: var(--font-size-2xl);
    color: var(--color-brown);
    margin-top: var(--spacing-2xl);
    margin-bottom: var(--spacing-md);
}

.page-content .entry-content h3 {
    font-family: var(--font-heading);
    font-size: var(--font-size-xl);
    color: var(--color-green);
    margin-top: var(--spacing-xl);
    margin-bottom: var(--spacing-sm);
}

.page-content .entry-content h4 {
    font-family: var(--font-heading);
    font-size: var(--font-size-lg);
    color: var(--color-brown);
    margin-top: var(--spacing-lg);
    margin-bottom: var(--spacing-sm);
}

.page-content .entry-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-lg);
    margin: var(--spacing-lg) 0;
}

.page-content .entry-content a {
    color: var(--color-dark-pink);
}

.page-content .entry-content a:hover {
    color: var(--color-brown);
}

.page-content .entry-content ul,
.page-content .entry-content ol {
    margin-left: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
}

.page-content .entry-content li {
    margin-bottom: var(--spacing-xs);
}

.page-content .entry-content blockquote {
    border-left: 4px solid var(--color-dark-pink);
    padding-left: var(--spacing-lg);
    margin: var(--spacing-xl) 0;
    font-style: italic;
    color: var(--color-brown);
}

.page-content .entry-content table {
    width: 100%;
    border-collapse: collapse;
    margin: var(--spacing-lg) 0;
}

.page-content .entry-content th,
.page-content .entry-content td {
    padding: var(--spacing-sm);
    border: 1px solid var(--color-border);
    text-align: left;
}

.page-content .entry-content th {
    background-color: var(--color-lightest-pink);
    font-weight: 600;
    color: var(--color-brown);
}

.page-links {
    margin-top: var(--spacing-xl);
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--color-border);
}
</style>

<?php get_footer(); ?>
