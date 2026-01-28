<?php
/**
 * Template Name: Coming Soon Puppies
 *
 * Displays puppies with "Coming Soon" status
 */

get_header();

// Query products with Coming Soon status
$args = array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'     => 'status',
            'value'   => 'Coming Soon',
            'compare' => '=',
        ),
        array(
            'key'     => 'availability_date',
            'value'   => date('Y-m-d'),
            'compare' => '>',
            'type'    => 'DATE',
        ),
    ),
    'orderby'        => 'meta_value',
    'meta_key'       => 'availability_date',
    'order'          => 'ASC',
);

$coming_soon_query = new WP_Query($args);
?>

<main id="main" class="site-main">
    <div class="page-content__wrapper">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (get_field('page_intro')) : ?>
                <div class="page-intro"><?php the_field('page_intro'); ?></div>
            <?php endif; ?>
        </header>

        <?php if ($coming_soon_query->have_posts()) : ?>
            <ul class="products columns-4">
                <?php
                while ($coming_soon_query->have_posts()) :
                    $coming_soon_query->the_post();
                    global $product;
                    $product = wc_get_product(get_the_ID());

                    get_template_part('partials/loop', 'product');
                endwhile;
                ?>
            </ul>
        <?php else : ?>
            <div class="no-products">
                <h2>New Puppies on the Way!</h2>
                <p>We're working with our trusted breeders to bring you adorable new puppies soon. In the meantime, take a look at our available puppies who are ready to find their forever homes today.</p>
                <a href="<?php echo esc_url(home_url('/puppies-for-sale/')); ?>" class="btn btn--rose btn--lg">View Available Puppies</a>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</main>

<?php get_footer(); ?>
