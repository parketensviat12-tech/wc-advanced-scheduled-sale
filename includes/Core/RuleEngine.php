<?php
defined('ABSPATH') || exit;

/**
 * Rule engine – изчислява дали продуктът попада в правилата
 */
class WC_ASS_RuleEngine {

    /**
     * Проверява дали даден продукт отговаря на правилото
     * @param int $product_id
     * @param array $rule
     * @return bool
     */
    public static function matches_rule(int $product_id, array $rule): bool {
        $product = wc_get_product($product_id);
        if (!$product) return false;

        // Проверка категория
        if (!empty($rule['categories'])) {
            $product_cats = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'ids']);
            if (empty(array_intersect($rule['categories'], $product_cats))) return false;
        }

        // Проверка производител
        if (!empty($rule['manufacturers'])) {
            $product_brands = wp_get_post_terms($product_id, 'pa_brand', ['fields' => 'ids']);
            if (empty(array_intersect($rule['manufacturers'], $product_brands))) return false;
        }

        return true;
    }
}
