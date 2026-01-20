<?php
/**
 * Template Part: CTA Button
 *
 * Reusable call-to-action button component.
 *
 * @package Furrylicious
 * @version 2.0.0
 *
 * @param string $text     Button text.
 * @param string $url      Button URL.
 * @param string $style    Button style: 'primary', 'outline', 'transparent'. Default 'primary'.
 * @param string $size     Button size: 'sm', 'md', 'lg'. Default 'md'.
 * @param string $class    Additional CSS classes.
 * @param bool   $new_tab  Open in new tab. Default false.
 * @param string $icon     Optional icon position: 'left', 'right', or null.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get parameters
$text = isset($args['text']) ? $args['text'] : __('Learn More', 'furrylicious');
$url = isset($args['url']) ? $args['url'] : '#';
$style = isset($args['style']) ? $args['style'] : 'primary';
$size = isset($args['size']) ? $args['size'] : 'md';
$class = isset($args['class']) ? $args['class'] : '';
$new_tab = isset($args['new_tab']) ? $args['new_tab'] : false;
$icon = isset($args['icon']) ? $args['icon'] : null;

// Build button classes
$button_classes = array('btn');

switch ($style) {
    case 'outline':
        $button_classes[] = 'btn--outline';
        break;
    case 'transparent':
        $button_classes[] = 'btn--transparent';
        break;
    default:
        $button_classes[] = 'btn--primary';
}

switch ($size) {
    case 'sm':
        $button_classes[] = 'btn--sm';
        break;
    case 'lg':
        $button_classes[] = 'btn--lg';
        break;
}

if ($class) {
    $button_classes[] = $class;
}

// Target and rel attributes
$target = $new_tab ? '_blank' : '';
$rel = $new_tab ? 'noopener noreferrer' : '';

// Icons
$arrow_icon = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
?>

<a
    href="<?php echo esc_url($url); ?>"
    class="<?php echo esc_attr(implode(' ', $button_classes)); ?>"
    <?php echo $target ? 'target="' . esc_attr($target) . '"' : ''; ?>
    <?php echo $rel ? 'rel="' . esc_attr($rel) . '"' : ''; ?>
>
    <?php if ($icon === 'left') : ?>
        <span class="btn__icon btn__icon--left"><?php echo $arrow_icon; ?></span>
    <?php endif; ?>

    <span class="btn__text"><?php echo esc_html($text); ?></span>

    <?php if ($icon === 'right') : ?>
        <span class="btn__icon btn__icon--right"><?php echo $arrow_icon; ?></span>
    <?php endif; ?>
</a>
