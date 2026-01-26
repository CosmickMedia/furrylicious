<?php
/**
 * Show options for ordering
 *
 * Boutique-styled sort dropdown for puppies.
 *
 * @package Furrylicious
 * @since 1.0.0
 */

defined('ABSPATH') || exit;
?>
<form class="puppies-ordering" method="get">
    <label class="puppies-ordering__label" for="puppy-orderby">
        <span class="puppies-ordering__text">Sort by:</span>
    </label>
    <select
        name="orderby"
        id="puppy-orderby"
        class="puppies-ordering__select"
        aria-label="<?php esc_attr_e('Sort puppies', 'furrylicious'); ?>"
    >
        <?php foreach ($catalog_orderby_options as $id => $name) : ?>
            <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>>
                <?php echo esc_html($name); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>
