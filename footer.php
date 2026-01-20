<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

        </main><!-- #main -->
    </div><!-- #content -->

    <footer id="site-footer" class="site-footer" role="contentinfo">
        <div class="footer-main">
            <div class="container">
                <div class="footer-grid">
                    <?php get_template_part('template-parts/footer/footer-widgets'); ?>
                </div>
            </div>
        </div>

        <?php get_template_part('template-parts/footer/footer-credits'); ?>
    </footer><!-- #site-footer -->

    <!-- Back to Top Button -->
    <button type="button"
            class="back-to-top"
            aria-label="<?php esc_attr_e('Back to top', 'furrylicious'); ?>"
            title="<?php esc_attr_e('Back to top', 'furrylicious'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
/**
 * Back to Top Button
 */
(function() {
    'use strict';

    const backToTop = document.querySelector('.back-to-top');

    if (!backToTop) return;

    // Show/hide button based on scroll position
    const toggleButton = () => {
        if (window.scrollY > 400) {
            backToTop.classList.add('is-visible');
        } else {
            backToTop.classList.remove('is-visible');
        }
    };

    // Scroll to top on click
    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Throttle scroll event
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                toggleButton();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    // Initial check
    toggleButton();
})();
</script>

</body>
</html>
