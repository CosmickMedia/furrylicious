<?php
/**
 * Template Part: Why Choose Us
 *
 * Alternating image/text blocks showcasing key differentiators.
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
$section_eyebrow = 'Why Furrylicious';
$section_title = 'Why Families|*Choose Us*';

// Process title formatting
$section_title_formatted = str_replace('|', '<br>', esc_html($section_title));
$section_title_formatted = preg_replace('/\*([^*]+)\*/', '<span>$1</span>', $section_title_formatted);

// Static reasons data - edit these directly
$reasons = [
    [
        'number' => '01',
        'title' => 'Health First, Always',
        'description' => 'Every puppy receives comprehensive veterinary care, genetic testing, and vaccinations before going home. Our health guarantee gives you peace of mind for years to come.',
        'image' => get_template_directory_uri() . '/assets/images/why-us/health.jpg',
        'points' => [
            'Full veterinary examination',
            'Up-to-date vaccinations',
            'Genetic health testing',
            '2-year health guarantee',
        ],
    ],
    [
        'number' => '02',
        'title' => 'Raised With Love',
        'description' => 'Our puppies are raised in a home environment, not kennels. They\'re socialized with children, other pets, and everyday sounds to ensure a smooth transition to your family.',
        'image' => get_template_directory_uri() . '/assets/images/why-us/love.jpg',
        'points' => [
            'Home-raised environment',
            'Early socialization program',
            'Exposure to household sounds',
            'Handled daily with care',
        ],
    ],
    [
        'number' => '03',
        'title' => 'Lifetime Support',
        'description' => 'Your journey with us doesn\'t end at pickup. We\'re here for training questions, health advice, and anything else you need. Once you\'re family, you\'re family forever.',
        'image' => get_template_directory_uri() . '/assets/images/why-us/support.jpg',
        'points' => [
            '24/7 phone & email support',
            'Training resources & tips',
            'Private owner community',
            'Breeder network referrals',
        ],
    ],
];
?>

<section class="why-us" data-reveal="fade">
    <div class="container">
        <header class="section-header section-header--center" data-reveal="fade-up">
            <?php if ($section_eyebrow) : ?>
                <p class="section-header__eyebrow"><?php echo esc_html($section_eyebrow); ?></p>
            <?php endif; ?>

            <h2 class="section-header__title">
                <?php echo $section_title_formatted; ?>
            </h2>
        </header>

        <div class="why-us__blocks">
            <?php foreach ($reasons as $index => $reason) :
                $is_reversed = $index % 2 !== 0;
            ?>
                <div class="why-us-block">
                    <div class="why-us-block__image" data-reveal="<?php echo $is_reversed ? 'fade-left' : 'fade-right'; ?>">
                        <img
                            src="<?php echo esc_url($reason['image']); ?>"
                            alt="<?php echo esc_attr($reason['title']); ?>"
                            loading="lazy"
                        />
                        <span class="why-us-block__number"><?php echo esc_html($reason['number']); ?></span>
                    </div>

                    <div class="why-us-block__content" data-reveal="<?php echo $is_reversed ? 'fade-right' : 'fade-left'; ?>">
                        <h3 class="why-us-block__title"><?php echo esc_html($reason['title']); ?></h3>

                        <p class="why-us-block__description"><?php echo esc_html($reason['description']); ?></p>

                        <?php if (!empty($reason['points'])) : ?>
                            <ul class="why-us-block__list">
                                <?php foreach ($reason['points'] as $point) : ?>
                                    <li class="why-us-block__list-item">
                                        <svg viewBox="0 0 24 24" fill="none" class="why-us-block__check" aria-hidden="true">
                                            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo esc_html($point); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="why-us__cta" data-reveal="fade-up">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--outline btn--lg">
                Learn More About Us
            </a>
        </div>
    </div>
</section>
