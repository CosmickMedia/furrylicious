<?php
/**
 * Template Name: Our Blog
 *
 * Blog archive page with featured posts and categories.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

get_header();

// Get current page for pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get selected category from query string
$selected_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// =============================================================================
// ACF Fields with Static Fallbacks
// =============================================================================

// Hero Section
$hero_label       = get_field('hero_label') ?: __('From Our Team', 'furrylicious');
$hero_title       = get_field('hero_title') ?: __('Stories, Tips & Puppy Love', 'furrylicious');
$hero_description = get_field('hero_description') ?: __('Helpful advice, heartwarming stories, and everything you need to know about puppy parenthood.', 'furrylicious');
$show_search      = get_field('show_search') !== null ? get_field('show_search') : true;

// Featured Post Override
$featured_override = get_field('featured_override');

// Category Filters
$category_filters = get_field('category_filters');
if (empty($category_filters)) {
    $category_filters = [
        ['slug' => '', 'label' => __('All Posts', 'furrylicious')],
        ['slug' => 'puppy-care', 'label' => __('Puppy Care', 'furrylicious')],
        ['slug' => 'training', 'label' => __('Training', 'furrylicious')],
        ['slug' => 'health', 'label' => __('Health', 'furrylicious')],
        ['slug' => 'breed-guides', 'label' => __('Breed Guides', 'furrylicious')],
        ['slug' => 'news', 'label' => __('News', 'furrylicious')],
    ];
}

// Topics Section
$topics_title = get_field('topics_title') ?: __('Popular Topics', 'furrylicious');
$topics_count = get_field('topics_count') ?: 15;

// SEO Fields (for potential use with Yoast or other SEO plugins)
$focus_keyphrase    = get_field('focus_keyphrase');
$seo_meta_description = get_field('seo_meta_description');
$og_image           = get_field('og_image');

// =============================================================================
// Query Setup
// =============================================================================

// Build query args
$args = [
    'post_type' => 'post',
    'posts_per_page' => 9,
    'paged' => $paged,
    'post_status' => 'publish',
];

if ($selected_category) {
    $args['category_name'] = $selected_category;
}

$blog_query = new WP_Query($args);

// Get featured post
if ($featured_override) {
    // Use ACF override
    $featured_args = [
        'post_type' => 'post',
        'p' => $featured_override,
        'posts_per_page' => 1,
    ];
} else {
    // Default: most recent sticky post
    $featured_args = [
        'post_type' => 'post',
        'posts_per_page' => 1,
        'post__in' => get_option('sticky_posts'),
        'ignore_sticky_posts' => 1,
    ];
}

$featured_query = new WP_Query($featured_args);

// If no sticky post and no override, get latest
if (!$featured_query->have_posts() && !$featured_override) {
    $featured_args = [
        'post_type' => 'post',
        'posts_per_page' => 1,
    ];
    $featured_query = new WP_Query($featured_args);
}
?>

<?php
// Schema.org JSON-LD Structured Data
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => 'Furrylicious Blog',
    'description' => $seo_meta_description ?: __('Stories, tips, and puppy love from Furrylicious', 'furrylicious'),
    'url' => home_url('/blog/'),
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Furrylicious',
        'url' => home_url('/'),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => get_template_directory_uri() . '/assets/images/logo.png'
        ]
    ]
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>

<article class="blog-page" itemscope itemtype="https://schema.org/Blog">

    <!-- Breadcrumb -->
    <nav class="blog-page__breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item">
                        <span itemprop="name"><?php esc_html_e('Home', 'furrylicious'); ?></span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php esc_html_e('Blog', 'furrylicious'); ?></span>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="blog-page__hero" aria-label="Blog">
        <div class="container">
            <header class="blog-page__hero-header">
                <span class="blog-page__section-label"><?php echo esc_html($hero_label); ?></span>
                <h1 class="blog-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="blog-page__hero-description"><?php echo esc_html($hero_description); ?></p>
            </header>

            <?php if ($show_search) : ?>
            <div class="blog-page__search">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="blog-page__search-form">
                    <label for="blog-search" class="sr-only"><?php esc_html_e('Search articles', 'furrylicious'); ?></label>
                    <input
                        type="search"
                        id="blog-search"
                        name="s"
                        placeholder="<?php esc_attr_e('Search articles...', 'furrylicious'); ?>"
                        class="blog-page__search-input"
                    >
                    <input type="hidden" name="post_type" value="post">
                    <button type="submit" class="blog-page__search-btn" aria-label="<?php esc_attr_e('Search', 'furrylicious'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($featured_query->have_posts() && $paged === 1 && !$selected_category) : $featured_query->the_post(); ?>
    <!-- Featured Post -->
    <section class="blog-page__featured" aria-labelledby="featured-heading">
        <div class="container">
            <h2 id="featured-heading" class="sr-only"><?php esc_html_e('Featured Article', 'furrylicious'); ?></h2>

            <article class="blog-page__featured-card" itemscope itemtype="https://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" class="blog-page__featured-link">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="blog-page__featured-image">
                            <?php the_post_thumbnail('large', ['itemprop' => 'image', 'loading' => 'eager']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="blog-page__featured-content">
                        <span class="blog-page__featured-badge"><?php esc_html_e('Featured', 'furrylicious'); ?></span>

                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                        ?>
                            <span class="blog-page__featured-category"><?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>

                        <h3 class="blog-page__featured-title" itemprop="headline"><?php the_title(); ?></h3>

                        <p class="blog-page__featured-excerpt" itemprop="description">
                            <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                        </p>

                        <div class="blog-page__featured-meta">
                            <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                <?php echo get_the_date(); ?>
                            </time>
                            <span class="blog-page__featured-read">
                                <?php
                                $reading_time = ceil(str_word_count(strip_tags(get_the_content())) / 200);
                                printf(_n('%d min read', '%d min read', $reading_time, 'furrylicious'), $reading_time);
                                ?>
                            </span>
                        </div>
                    </div>
                </a>
            </article>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <!-- Category Filters -->
    <section class="blog-page__categories" aria-label="Filter by category">
        <div class="container">
            <div class="blog-page__category-filters">
                <?php foreach ($category_filters as $filter) :
                    $slug = isset($filter['slug']) ? $filter['slug'] : '';
                    $label = isset($filter['label']) ? $filter['label'] : '';
                    if (empty($label)) continue;
                ?>
                    <a href="<?php echo esc_url($slug ? add_query_arg('category', $slug) : remove_query_arg('category')); ?>"
                       class="blog-page__category-pill<?php echo $selected_category === $slug ? ' is-active' : ''; ?>">
                        <?php echo esc_html($label); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Post Grid -->
    <section class="blog-page__grid-section" aria-labelledby="posts-heading">
        <div class="container">
            <h2 id="posts-heading" class="sr-only"><?php esc_html_e('Blog Posts', 'furrylicious'); ?></h2>

            <?php if ($blog_query->have_posts()) : ?>
                <div class="blog-page__grid">
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article class="blog-page__post-card" itemscope itemtype="https://schema.org/BlogPosting">
                            <a href="<?php the_permalink(); ?>" class="blog-page__post-link">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="blog-page__post-image">
                                        <?php the_post_thumbnail('medium_large', ['itemprop' => 'image', 'loading' => 'lazy']); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="blog-page__post-image blog-page__post-image--placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>

                                <div class="blog-page__post-content">
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) :
                                    ?>
                                        <span class="blog-page__post-category"><?php echo esc_html($categories[0]->name); ?></span>
                                    <?php endif; ?>

                                    <h3 class="blog-page__post-title" itemprop="headline"><?php the_title(); ?></h3>

                                    <p class="blog-page__post-excerpt" itemprop="description">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </p>

                                    <div class="blog-page__post-meta">
                                        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php if ($blog_query->max_num_pages > 1) : ?>
                    <nav class="blog-page__pagination" aria-label="Blog navigation">
                        <?php
                        echo paginate_links([
                            'total' => $blog_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg> Previous',
                            'next_text' => 'Next <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>',
                            'type' => 'list',
                        ]);
                        ?>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <div class="blog-page__no-posts">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <h3><?php esc_html_e('No posts found', 'furrylicious'); ?></h3>
                    <p><?php esc_html_e('We couldn\'t find any posts matching your criteria. Try a different category or check back later.', 'furrylicious'); ?></p>
                    <a href="<?php echo esc_url(remove_query_arg('category')); ?>" class="btn btn--primary">
                        <?php esc_html_e('View All Posts', 'furrylicious'); ?>
                    </a>
                </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>

    <!-- Topics Cloud -->
    <section class="blog-page__topics" aria-labelledby="topics-heading">
        <div class="container">
            <h2 id="topics-heading" class="blog-page__topics-title"><?php echo esc_html($topics_title); ?></h2>
            <div class="blog-page__topics-cloud">
                <?php
                $tags = get_tags(['orderby' => 'count', 'order' => 'DESC', 'number' => intval($topics_count)]);
                foreach ($tags as $tag) :
                ?>
                    <a href="<?php echo esc_url(get_tag_link($tag)); ?>" class="blog-page__topic-tag">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</article>

<?php get_footer(); ?>
