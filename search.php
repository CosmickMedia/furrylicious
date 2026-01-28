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

            <div class="puppy-grid products">
                <?php
                while (have_posts()) : the_post();
                    global $product;
                    $product = wc_get_product(get_the_ID());
                    if ($product && is_a($product, 'WC_Product')) :
                        $product_id = $product->get_id();
                        $link       = get_permalink($product_id);
                        $img_id     = $product->get_image_id();

                        // Get pet metadata
                        $pet_name   = $product->get_meta('pet_name');
                        $breed_name = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));
                        $ref_id     = $product->get_meta('reference_number');
                        $birth_date = $product->get_meta('birth_date');
                        $gender     = $product->get_attribute('pa_gender');

                        // Format birthday
                        $birthday_formatted = $birth_date ? wp_date('M j, Y', strtotime($birth_date)) : '';

                        // Gender icon
                        $gender_lower = strtolower($gender);
                        $gender_icon = '';
                        if ($gender_lower === 'male') {
                            $gender_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10.5" cy="13.5" r="7.5"></circle><line x1="21" y1="3" x2="15" y2="9"></line><polyline points="21 9 21 3 15 3"></polyline></svg>';
                        } elseif ($gender_lower === 'female') {
                            $gender_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="7"></circle><line x1="12" y1="15" x2="12" y2="22"></line><line x1="9" y1="19" x2="15" y2="19"></line></svg>';
                        }
                        ?>
                        <div class="puppy-grid__item">
                        <article <?php wc_product_class('product-card', $product); ?>>
                            <div class="product-card__media">
                                <a href="<?php echo esc_url($link); ?>" class="product-card__image-link">
                                    <?php if ($img_id) : ?>
                                        <?php echo wp_get_attachment_image($img_id, 'woocommerce_thumbnail', false, array('class' => 'product-card__image')); ?>
                                    <?php else : ?>
                                        <div class="product-card__placeholder">
                                            <span><?php esc_html_e('Photo coming soon', 'furrylicious'); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="product-card__content">
                                <p class="product-card__breed"><?php echo esc_html($breed_name); ?></p>

                                <?php if ($pet_name) : ?>
                                    <h3 class="product-card__name">
                                        <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($pet_name); ?></a>
                                    </h3>
                                <?php endif; ?>

                                <div class="product-card__info-grid">
                                    <?php if ($ref_id) : ?>
                                        <div class="product-card__info-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path d="M4 9h16"></path><path d="M4 15h16"></path><path d="M10 3L8 21"></path><path d="M16 3l-2 18"></path>
                                            </svg>
                                            <span><?php echo esc_html($ref_id); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($birthday_formatted) : ?>
                                        <div class="product-card__info-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <span><?php echo esc_html($birthday_formatted); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($gender) : ?>
                                        <div class="product-card__info-item product-card__info-item--<?php echo esc_attr($gender_lower); ?>">
                                            <?php echo $gender_icon; ?>
                                            <span><?php echo esc_html($gender); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <a href="<?php echo esc_url($link); ?>" class="product-card__cta btn btn--primary">
                                    <?php esc_html_e('More Info', 'furrylicious'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </article>
                        </div>
                        <?php
                    endif;
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
