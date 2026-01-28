<?php
defined('ABSPATH') || exit;

/**
 * Помощни функции
 */
class WC_ASS_Utils {

    /**
     * Превод на проценти в float
     * @param mixed $value
     * @return float
     */
    public static function float_percent($value) {
        return floatval(str_replace('%', '', $value));
    }

    /**
     * Форматиране на цена
     */
    public static function format_price($price) {
        return wc_price($price);
    }

    /**
     * Вземане на името на категория
     */
    public static function get_category_names($ids = []) {
        if (empty($ids)) return [];
        return wp_list_pluck(get_terms(['taxonomy' => 'product_cat', 'include' => $ids]), 'name');
    }

    /**
     * Вземане на името на производител
     */
    public static function get_manufacturer_names($ids = []) {
        if (empty($ids)) return [];
        return wp_list_pluck(get_terms(['taxonomy' => 'product_brand', 'include' => $ids]), 'name');
    }
}
