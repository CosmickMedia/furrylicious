<?php
/**
 * Template Name: FAQs Template
 *
 * FAQ page with accordion-style questions and answers.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

get_header();
?>

<main id="main-content" class="site-main faq-page">
    <div class="container">

        <!-- Page Header / Intro -->
        <header class="faq-intro">
            <?php if (get_field('intro_title')) : ?>
                <h1 class="faq-intro__title">
                    <?php echo esc_html(get_field('intro_title')); ?>
                </h1>
            <?php else : ?>
                <h1 class="faq-intro__title">
                    <?php the_title(); ?>
                </h1>
            <?php endif; ?>

            <?php if (get_field('intro_text')) : ?>
                <div class="faq-intro__text">
                    <?php echo wp_kses_post(get_field('intro_text')); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php
        // Puppy FAQs
        $puppy_faqs = new WP_Query(array(
            'post_type'      => 'faq',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'meta_query'     => array(
                array(
                    'key'     => 'category',
                    'value'   => 'puppy',
                    'compare' => 'LIKE',
                ),
            ),
        ));

        if ($puppy_faqs->have_posts()) :
        ?>
            <section class="faq-section">
                <h2 class="faq-section__title">
                    <?php esc_html_e('Puppy FAQs', 'furrylicious'); ?>
                </h2>

                <div class="accordion" data-accordion>
                    <?php while ($puppy_faqs->have_posts()) : $puppy_faqs->the_post(); ?>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button"
                                        type="button"
                                        aria-expanded="false">
                                    <span><?php the_title(); ?></span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php
        endif;
        wp_reset_postdata();

        // General FAQs
        $general_faqs = new WP_Query(array(
            'post_type'      => 'faq',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'meta_query'     => array(
                array(
                    'key'     => 'category',
                    'value'   => 'general',
                    'compare' => 'LIKE',
                ),
            ),
        ));

        if ($general_faqs->have_posts()) :
        ?>
            <section class="faq-section">
                <h2 class="faq-section__title">
                    <?php esc_html_e('General FAQs', 'furrylicious'); ?>
                </h2>

                <div class="accordion" data-accordion>
                    <?php while ($general_faqs->have_posts()) : $general_faqs->the_post(); ?>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button"
                                        type="button"
                                        aria-expanded="false">
                                    <span><?php the_title(); ?></span>
                                    <span class="accordion-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="accordion-content" aria-hidden="true">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php
        endif;
        wp_reset_postdata();

        // Additional page content
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (get_the_content()) :
        ?>
                    <div class="faq-additional-content">
                        <?php the_content(); ?>
                    </div>
        <?php
                endif;
            endwhile;
        endif;
        ?>

    </div>
</main>

<?php get_footer(); ?>
