<?php
/**
 * Search Form Template
 *
 * @package Furrylicious
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get aria label if provided
$aria_label = !empty($args['aria_label']) ? $args['aria_label'] : __('Search', 'furrylicious');
$unique_id = wp_unique_id('search-form-');
?>

<form role="search"
      method="get"
      class="search-form"
      action="<?php echo esc_url(home_url('/')); ?>"
      aria-label="<?php echo esc_attr($aria_label); ?>">

    <label for="<?php echo esc_attr($unique_id); ?>" class="screen-reader-text">
        <?php esc_html_e('Search for:', 'furrylicious'); ?>
    </label>

    <div class="search-form__wrapper">
        <input type="search"
               id="<?php echo esc_attr($unique_id); ?>"
               class="search-form__input"
               placeholder="<?php esc_attr_e('Search...', 'furrylicious'); ?>"
               value="<?php echo get_search_query(); ?>"
               name="s"
               autocomplete="off" />

        <button type="submit" class="search-form__submit" aria-label="<?php esc_attr_e('Submit search', 'furrylicious'); ?>">
            <svg class="search-form__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <span class="screen-reader-text"><?php esc_html_e('Search', 'furrylicious'); ?></span>
        </button>
    </div>
</form>

<style>
/* Search Form Styles */
.search-form__wrapper {
    display: flex;
    align-items: center;
    position: relative;
}

.search-form__input {
    width: 100%;
    padding: var(--spacing-sm) var(--spacing-lg);
    padding-right: 50px;
    font-size: var(--font-size-base);
    font-family: var(--font-body);
    border: 2px solid var(--color-border);
    border-radius: var(--border-radius-lg);
    background-color: white;
    transition: all var(--transition-fast);
}

.search-form__input:focus {
    outline: none;
    border-color: var(--color-dark-pink);
    box-shadow: 0 0 0 3px rgba(231, 138, 148, 0.2);
}

.search-form__input::placeholder {
    color: #999;
}

.search-form__submit {
    position: absolute;
    right: 4px;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--color-dark-pink);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: background-color var(--transition-fast);
}

.search-form__submit:hover,
.search-form__submit:focus {
    background-color: var(--color-brown);
}

.search-form__icon {
    width: 20px;
    height: 20px;
}
</style>
