<?php
/**
 * Template Part: Content
 *
 * Default template part for displaying posts.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="post-card__image">
            <?php the_post_thumbnail('medium_large', array(
                'class' => 'post-card__img',
                'alt'   => get_the_title(),
            )); ?>
        </a>
    <?php endif; ?>

    <div class="post-card__content">
        <header class="post-card__header">
            <?php if ('post' === get_post_type()) : ?>
                <div class="post-card__meta">
                    <time class="post-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>

                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <span class="post-card__category">
                            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                <?php echo esc_html($categories[0]->name); ?>
                            </a>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php
            if (is_singular()) :
                the_title('<h1 class="post-card__title">', '</h1>');
            else :
                the_title('<h2 class="post-card__title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
            endif;
            ?>
        </header>

        <div class="post-card__excerpt">
            <?php the_excerpt(); ?>
        </div>

        <footer class="post-card__footer">
            <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">
                <?php esc_html_e('Read More', 'furrylicious'); ?>
                <span class="screen-reader-text"><?php the_title(); ?></span>
            </a>
        </footer>
    </div>
</article>

<style>
/* Post Card Styles */
.post-card {
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-fast);
}

.post-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-4px);
}

.post-card__image {
    display: block;
    aspect-ratio: 16 / 10;
    overflow: hidden;
}

.post-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-base);
}

.post-card:hover .post-card__img {
    transform: scale(1.05);
}

.post-card__content {
    padding: var(--spacing-lg);
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.post-card__meta {
    display: flex;
    gap: var(--spacing-sm);
    align-items: center;
    margin-bottom: var(--spacing-sm);
    font-size: var(--font-size-sm);
    color: var(--color-text-brown);
}

.post-card__category a {
    color: var(--color-dark-pink);
    text-decoration: none;
}

.post-card__category a:hover {
    text-decoration: underline;
}

.post-card__title {
    font-family: var(--font-heading);
    font-size: var(--font-size-xl);
    font-weight: 600;
    color: var(--color-brown);
    margin-bottom: var(--spacing-sm);
    line-height: 1.3;
}

.post-card__title a {
    color: inherit;
    text-decoration: none;
}

.post-card__title a:hover {
    color: var(--color-dark-pink);
}

.post-card__excerpt {
    color: var(--color-text-brown);
    line-height: 1.6;
    margin-bottom: var(--spacing-md);
    flex-grow: 1;
}

.post-card__excerpt p {
    margin: 0;
}

.post-card__footer {
    margin-top: auto;
}
</style>
