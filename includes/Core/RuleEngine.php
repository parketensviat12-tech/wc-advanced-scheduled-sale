<?php
defined('ABSPATH') || exit;

/**
 * Rule Engine – прилагане на правила за отстъпки
 */
class WC_ASS_RuleEngine {

    /**
     * Проверява дали продуктът отговаря на правилата
     * @param int $product_id
     * @param array $rules
     * @return bool
     */
    public static function validate($product_id, $rules) {
        $product = wc_get_product($product_id);
        if (!$product) return false;

        // Проверка по категория
        if (!empty($rules['categories'])) {
            $terms = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'ids']);
            if (!array_intersect($rules['categories'], $terms)) return false;
        }

        // Проверка по производител
        if (!empty($rules['manufacturers'])) {
            $terms = wp_get_post_terms($product_id, 'product_brand', ['fields' => 'ids']);
            if (!array_intersect($rules['manufacturers'], $terms)) return false;
        }

        return true;
    }
}
