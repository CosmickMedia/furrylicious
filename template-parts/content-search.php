<?php
/**
 * Template Part: Content Search
 *
 * Template part for displaying results in search pages.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
    <header class="search-result__header">
        <?php the_title(sprintf('<h2 class="search-result__title"><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="search-result__meta">
                <span class="search-result__type"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></span>
                <time class="search-result__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </div>
        <?php endif; ?>
    </header>

    <div class="search-result__excerpt">
        <?php the_excerpt(); ?>
    </div>

    <footer class="search-result__footer">
        <a href="<?php the_permalink(); ?>" class="search-result__link">
            <?php esc_html_e('Read More', 'furrylicious'); ?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </footer>
</article>

<style>
/* Search Result Styles */
.search-result {
    padding: var(--spacing-lg);
    background-color: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-sm);
    transition: box-shadow var(--transition-fast);
}

.search-result:hover {
    box-shadow: var(--shadow-md);
}

.search-result__title {
    font-family: var(--font-heading);
    font-size: var(--font-size-xl);
    font-weight: 600;
    color: var(--color-brown);
    margin-bottom: var(--spacing-xs);
}

.search-result__title a {
    color: inherit;
    text-decoration: none;
}

.search-result__title a:hover {
    color: var(--color-dark-pink);
}

.search-result__meta {
    display: flex;
    gap: var(--spacing-sm);
    align-items: center;
    margin-bottom: var(--spacing-sm);
    font-size: var(--font-size-sm);
    color: var(--color-text-brown);
}

.search-result__type {
    background-color: var(--color-light-pink);
    color: var(--color-dark-pink);
    padding: 2px 8px;
    border-radius: var(--border-radius);
    font-size: var(--font-size-xs);
    font-weight: 600;
    text-transform: uppercase;
}

.search-result__excerpt {
    color: var(--color-text-brown);
    line-height: 1.6;
    margin-bottom: var(--spacing-md);
}

.search-result__excerpt p {
    margin: 0;
}

.search-result__link {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--color-dark-pink);
    font-weight: 600;
    text-decoration: none;
}

.search-result__link:hover {
    color: var(--color-brown);
}

.search-result__link svg {
    transition: transform var(--transition-fast);
}

.search-result__link:hover svg {
    transform: translateX(4px);
}
</style>
