<?php
/**
 * The template for displaying all single posts
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<main id="main-content" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="single-post__hero">
                    <?php the_post_thumbnail('full', array(
                        'class' => 'single-post__featured-image',
                        'alt'   => get_the_title(),
                    )); ?>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="single-post__wrapper">
                    <!-- Post Header -->
                    <header class="single-post__header">
                        <div class="single-post__meta">
                            <time class="single-post__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>

                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) :
                            ?>
                                <span class="single-post__categories">
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h1 class="single-post__title"><?php the_title(); ?></h1>
                    </header>

                    <!-- Post Content -->
                    <div class="single-post__content entry-content">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'furrylicious'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Post Tags -->
                    <?php
                    $tags = get_the_tags();
                    if (!empty($tags)) :
                    ?>
                        <footer class="single-post__footer">
                            <div class="single-post__tags">
                                <span class="single-post__tags-label"><?php esc_html_e('Tags:', 'furrylicious'); ?></span>
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="single-post__tag">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </footer>
                    <?php endif; ?>

                    <!-- Post Navigation -->
                    <nav class="single-post__navigation" aria-label="<?php esc_attr_e('Post navigation', 'furrylicious'); ?>">
                        <?php
                        the_post_navigation(array(
                            'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'furrylicious') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . __('Next:', 'furrylicious') . '</span> <span class="nav-title">%title</span>',
                        ));
                        ?>
                    </nav>

                </div>
            </div>

        <?php endwhile; endif; ?>
    </article>
</main>

<style>
/* Single Post Styles */
.single-post__hero {
    position: relative;
    width: 100%;
    max-height: 500px;
    overflow: hidden;
}

.single-post__featured-image {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.single-post__wrapper {
    max-width: 800px;
    margin: 0 auto;
    padding: var(--spacing-2xl) 0;
}

.single-post__header {
    text-align: center;
    margin-bottom: var(--spacing-2xl);
}

.single-post__meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-md);
    font-size: var(--font-size-sm);
    color: var(--color-text-brown);
}

.single-post__categories a {
    color: var(--color-dark-pink);
    text-decoration: none;
}

.single-post__categories a:hover {
    text-decoration: underline;
}

.single-post__title {
    font-family: var(--font-heading);
    font-size: var(--font-size-3xl);
    font-weight: 700;
    color: var(--color-brown);
    line-height: 1.2;
}

@media (min-width: 768px) {
    .single-post__title {
        font-size: var(--font-size-4xl);
    }
}

.single-post__content {
    font-size: var(--font-size-lg);
    line-height: 1.8;
    color: var(--color-text-brown);
}

.single-post__content p {
    margin-bottom: var(--spacing-lg);
}

.single-post__content h2 {
    font-family: var(--font-heading);
    font-size: var(--font-size-2xl);
    color: var(--color-brown);
    margin-top: var(--spacing-2xl);
    margin-bottom: var(--spacing-md);
}

.single-post__content h3 {
    font-family: var(--font-heading);
    font-size: var(--font-size-xl);
    color: var(--color-green);
    margin-top: var(--spacing-xl);
    margin-bottom: var(--spacing-sm);
}

.single-post__content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-lg);
}

.single-post__content a {
    color: var(--color-dark-pink);
}

.single-post__content a:hover {
    color: var(--color-brown);
}

.single-post__content ul,
.single-post__content ol {
    margin-left: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
}

.single-post__content li {
    margin-bottom: var(--spacing-xs);
}

.single-post__content blockquote {
    border-left: 4px solid var(--color-dark-pink);
    padding-left: var(--spacing-lg);
    margin: var(--spacing-xl) 0;
    font-style: italic;
    color: var(--color-brown);
}

.single-post__footer {
    border-top: 1px solid var(--color-border);
    padding-top: var(--spacing-lg);
    margin-top: var(--spacing-2xl);
}

.single-post__tags {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: var(--spacing-xs);
}

.single-post__tags-label {
    font-weight: 600;
    color: var(--color-brown);
}

.single-post__tag {
    display: inline-block;
    padding: 4px 12px;
    background-color: var(--color-lightest-pink);
    color: var(--color-dark-pink);
    border-radius: var(--border-radius);
    font-size: var(--font-size-sm);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.single-post__tag:hover {
    background-color: var(--color-dark-pink);
    color: white;
}

.single-post__navigation {
    margin-top: var(--spacing-2xl);
    margin-bottom: var(--spacing-3xl, 4rem);
    padding-top: var(--spacing-xl);
    padding-bottom: var(--spacing-2xl);
    border-top: 1px solid var(--color-border);
}

.single-post__navigation .nav-links {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: var(--spacing-lg);
}

.single-post__navigation .nav-previous,
.single-post__navigation .nav-next {
    flex: 1;
    max-width: 48%;
}

.single-post__navigation .nav-next {
    text-align: right;
    margin-left: auto;
}

.single-post__navigation a {
    display: inline-flex;
    flex-direction: column;
    align-items: flex-start;
    padding: var(--spacing-md) var(--spacing-xl);
    background-color: var(--white);
    border: 2px solid var(--espresso, var(--color-brown));
    border-radius: var(--border-radius-lg, 12px);
    color: var(--espresso, var(--color-brown));
    text-decoration: none;
    transition: all var(--transition-fast);
    min-width: 160px;
}

.single-post__navigation .nav-next a {
    align-items: flex-end;
}

.single-post__navigation a:hover {
    background-color: var(--rose, var(--color-dark-pink));
    border-color: var(--rose, var(--color-dark-pink));
    color: var(--white);
}

.single-post__navigation a:hover .nav-subtitle,
.single-post__navigation a:hover .nav-title {
    color: var(--white);
}

.single-post__navigation .nav-subtitle {
    display: block;
    font-size: var(--font-size-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--rose, var(--color-dark-pink));
    margin-bottom: var(--spacing-xs);
    transition: color var(--transition-fast);
}

.single-post__navigation .nav-title {
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: var(--font-size-base);
    color: var(--espresso, var(--color-brown));
    line-height: 1.3;
    transition: color var(--transition-fast);
}

@media (max-width: 600px) {
    .single-post__navigation .nav-links {
        flex-direction: column;
    }

    .single-post__navigation .nav-previous,
    .single-post__navigation .nav-next {
        max-width: 100%;
    }

    .single-post__navigation a {
        width: 100%;
    }

    .single-post__navigation .nav-next {
        text-align: left;
    }

    .single-post__navigation .nav-next a {
        align-items: flex-start;
    }
}
</style>

<?php get_footer(); ?>
