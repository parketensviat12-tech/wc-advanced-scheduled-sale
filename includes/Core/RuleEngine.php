<?php
defined('ABSPATH') || exit;

class WC_Ass_RuleEngine {

    /**
     * Пресмята процентите по правило
     */
    public static function calculate_discount($rule, $product) {
        $default_discount = floatval($rule['discount'] ?? 0);

        // Ако има различен процент по производител
        if (!empty($rule['brand_discounts']) && $product->get_attribute('pa_brand')) {
            $brand = $product->get_attribute('pa_brand');
            if (isset($rule['brand_discounts'][$brand])) {
                return floatval($rule['brand_discounts'][$brand]);
            }
        }

        return $default_discount;
    }

    /**
     * Проверка дали продуктът покрива правилото (AND / OR)
     */
    public static function match_rule($rule, $product) {
        $match_type = $rule['match_type'] ?? 'AND'; // AND или OR
        $category_match = empty($rule['categories']) || has_term($rule['categories'], 'product_cat', $product->get_id());
        $brand_match = empty($rule['brands']) || has_term($rule['brands'], 'pa_brand', $product->get_id());

        if ($match_type === 'AND') {
            return $category_match && $brand_match;
        } else {
            return $category_match || $brand_match;
        }
    }
}
