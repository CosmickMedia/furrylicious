<?php
/**
 * Template Part: Experience Horizontal Scroll
 *
 * Side-scrolling journey cards showing the Furrylicious experience.
 * Static content for easy editing.
 *
 * @package Furrylicious
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Section settings
$section_eyebrow = 'The Journey';
$section_title = 'The *Furrylicious* Experience';
$section_description = 'From first visit to forever family, we make finding your perfect puppy simple and joyful.';

// Process title formatting
$section_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', esc_html($section_title));

// Static experience steps - edit these directly
$steps = [
    [
        'number' => '01',
        'title' => 'Browse & Discover',
        'description' => 'Explore our available puppies online. Each profile includes photos, personality traits, health information, and pricing.',
        'icon' => 'search',
        'accent' => 'Find your match',
    ],
    [
        'number' => '02',
        'title' => 'Connect With Us',
        'description' => 'Reach out with questions or schedule a visit. Our team is here to help you find the perfect companion for your lifestyle.',
        'icon' => 'chat',
        'accent' => 'We\'re here for you',
    ],
    [
        'number' => '03',
        'title' => 'Visit & Bond',
        'description' => 'Come meet your potential puppy in person. Spend time bonding and make sure it\'s the perfect fit for your family.',
        'icon' => 'heart',
        'accent' => 'Love at first sight',
    ],
    [
        'number' => '04',
        'title' => 'Take Home',
        'description' => 'Complete the adoption process and welcome your new family member. We provide a full puppy care kit and lifetime support.',
        'icon' => 'home',
        'accent' => 'Welcome home',
    ],
];

// SVG icons
$icons = [
    'search' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><circle cx="20" cy="20" r="14" stroke="currentColor" stroke-width="3"/><path d="M30 30L42 42" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>',
    'chat' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M42 24c0 9.941-8.059 18-18 18-3.032 0-5.895-.749-8.405-2.073L6 42l2.073-9.595A17.9 17.9 0 016 24C6 14.059 14.059 6 24 6s18 8.059 18 18z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><circle cx="16" cy="24" r="2" fill="currentColor"/><circle cx="24" cy="24" r="2" fill="currentColor"/><circle cx="32" cy="24" r="2" fill="currentColor"/></svg>',
    'heart' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M24 42S6 30 6 18c0-6.627 5.373-12 12-12 4.314 0 6 3 6 3s1.686-3 6-3c6.627 0 12 5.373 12 12 0 12-18 24-18 24z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'home' => '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M6 24L24 6l18 18" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 20v18a2 2 0 002 2h24a2 2 0 002-2V20" stroke="currentColor" stroke-width="3"/><path d="M18 40V28a2 2 0 012-2h8a2 2 0 012 2v12" stroke="currentColor" stroke-width="3"/></svg>',
];
?>

<section class="experience-scroll" data-reveal="fade">
    <div class="container">
        <header class="section-header" data-reveal="fade-up">
            <?php if ($section_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($section_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $section_title_formatted; ?>
            </h2>

            <?php if ($section_description) : ?>
                <p class="section-header__description"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </header>
    </div>

    <div class="experience-scroll__track-wrapper">
        <div class="experience-scroll__track">
            <?php foreach ($steps as $index => $step) : ?>
                <article class="experience-card" data-reveal="fade-up" data-reveal-delay="<?php echo $index * 100; ?>">
                    <div class="experience-card__number"><?php echo esc_html($step['number']); ?></div>

                    <div class="experience-card__icon">
                        <?php echo $icons[$step['icon']]; ?>
                    </div>

                    <h3 class="experience-card__title"><?php echo esc_html($step['title']); ?></h3>

                    <p class="experience-card__description"><?php echo esc_html($step['description']); ?></p>

                    <p class="experience-card__accent"><?php echo esc_html($step['accent']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="experience-scroll__nav">
        <button type="button" class="experience-scroll__btn experience-scroll__btn--prev" aria-label="Previous step">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button type="button" class="experience-scroll__btn experience-scroll__btn--next" aria-label="Next step">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</section>
