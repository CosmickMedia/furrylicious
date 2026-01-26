<?php
/**
 * Result Count
 *
 * Shows count of puppies with boutique styling.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;
?>
<p class="puppies-result-count">
    <?php
    if (1 === intval($total)) {
        esc_html_e('Showing 1 adorable puppy', 'furrylicious');
    } elseif ($total <= $per_page || -1 === $per_page) {
        /* translators: %d: total results */
        printf(
            esc_html(_n(
                'Showing %d adorable puppy',
                'Showing all %d adorable puppies',
                $total,
                'furrylicious'
            )),
            $total
        );
    } else {
        $first = ($per_page * $current) - $per_page + 1;
        $last  = min($total, $per_page * $current);
        /* translators: 1: first result 2: last result 3: total results */
        printf(
            esc_html(_nx(
                'Showing %1$d&ndash;%2$d of %3$d puppy',
                'Showing %1$d&ndash;%2$d of %3$d puppies',
                $total,
                'with first and last result',
                'furrylicious'
            )),
            $first,
            $last,
            $total
        );
    }
    ?>
</p>
