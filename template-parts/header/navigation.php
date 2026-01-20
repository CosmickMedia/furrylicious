<?php
/**
 * Template Part: Navigation
 *
 * Displays the primary navigation menu.
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Walker for Primary Navigation
 */
class Furrylicious_Primary_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Start the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'primary-nav__item';

        // Check for children
        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'has-dropdown';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id_attr = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';

        $output .= $indent . '<li' . $id_attr . $class_names . '>';

        // Link attributes
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'primary-nav__link';

        if ($has_children && $depth === 0) {
            $atts['class'] .= ' primary-nav__dropdown-toggle';
            $atts['aria-expanded'] = 'false';
            $atts['aria-haspopup'] = 'true';
        }

        if (in_array('current-menu-item', $classes)) {
            $atts['aria-current'] = 'page';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Start submenu.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"primary-nav__submenu\">\n";
    }
}

/**
 * Custom Walker for Mobile Navigation
 */
class Furrylicious_Mobile_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Start the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = $depth === 0 ? 'mobile-nav__item' : 'mobile-nav__submenu-item';

        // Check for children
        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'has-dropdown';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        // Link attributes
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = $depth === 0 ? 'mobile-nav__link' : 'mobile-nav__submenu-link';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';

        // Add submenu toggle button for items with children
        if ($has_children && $depth === 0) {
            $item_output .= '<button class="mobile-nav__submenu-toggle" aria-label="' . esc_attr__('Toggle submenu', 'furrylicious') . '">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>';
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Start submenu.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"mobile-nav__submenu\">\n";
    }
}
?>

<!-- Primary Navigation (Desktop) -->
<nav class="primary-nav" aria-label="<?php esc_attr_e('Primary Menu', 'furrylicious'); ?>" role="navigation">
    <?php
    if (has_nav_menu('primary')) {
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'menu_class'     => 'primary-nav__list',
            'container'      => false,
            'depth'          => 2,
            'walker'         => new Furrylicious_Primary_Nav_Walker(),
            'fallback_cb'    => false,
        ));
    }
    ?>
</nav>

<!-- Mobile Menu Toggle -->
<button
    class="mobile-menu-toggle"
    aria-expanded="false"
    aria-controls="mobile-nav"
    aria-label="<?php esc_attr_e('Toggle mobile menu', 'furrylicious'); ?>"
>
    <span class="mobile-menu-toggle__icon">
        <span class="mobile-menu-toggle__bar"></span>
        <span class="mobile-menu-toggle__bar"></span>
        <span class="mobile-menu-toggle__bar"></span>
    </span>
    <span class="sr-only"><?php esc_html_e('Menu', 'furrylicious'); ?></span>
</button>

<!-- Mobile Navigation Overlay -->
<div class="mobile-menu-overlay" aria-hidden="true"></div>

<!-- Mobile Navigation -->
<nav class="mobile-nav" id="mobile-nav" aria-label="<?php esc_attr_e('Mobile Menu', 'furrylicious'); ?>" aria-hidden="true">
    <div class="mobile-nav__header">
        <?php get_template_part('template-parts/header/site-branding'); ?>
        <button class="mobile-nav__close" aria-label="<?php esc_attr_e('Close menu', 'furrylicious'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <?php
    if (has_nav_menu('mobile')) {
        $menu_location = 'mobile';
    } else {
        $menu_location = 'primary';
    }

    if (has_nav_menu($menu_location)) {
        wp_nav_menu(array(
            'theme_location' => $menu_location,
            'menu_id'        => 'mobile-menu',
            'menu_class'     => 'mobile-nav__list',
            'container'      => false,
            'depth'          => 2,
            'walker'         => new Furrylicious_Mobile_Nav_Walker(),
            'fallback_cb'    => false,
        ));
    }
    ?>

    <div class="mobile-nav__contact">
        <?php
        $contact = furrylicious_get_contact_info();

        if (!empty($contact['phone'])) :
        ?>
            <a href="tel:<?php echo esc_attr($contact['phone']); ?>" class="mobile-nav__contact-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7294C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5902 20.9046 21.7335 20.6408 21.8227C20.377 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.19 12.85C3.49998 10.2412 2.44824 7.27097 2.12 4.18C2.09501 3.90347 2.12788 3.62476 2.2165 3.36162C2.30513 3.09849 2.44757 2.85669 2.63477 2.65162C2.82196 2.44655 3.04981 2.28271 3.30379 2.17052C3.55778 2.05833 3.83234 2.00026 4.11 2H7.11C7.59531 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.11 3.72C9.23662 4.68007 9.47145 5.62273 9.81 6.53C9.94455 6.88792 9.97366 7.27691 9.89391 7.65088C9.81415 8.02485 9.62886 8.36811 9.36 8.64L8.09 9.91C9.51356 12.4135 11.5865 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9752 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <?php echo esc_html($contact['phone']); ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($contact['email'])) : ?>
            <a href="mailto:<?php echo esc_attr($contact['email']); ?>" class="mobile-nav__contact-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <?php echo esc_html($contact['email']); ?>
            </a>
        <?php endif; ?>
    </div>
</nav>
