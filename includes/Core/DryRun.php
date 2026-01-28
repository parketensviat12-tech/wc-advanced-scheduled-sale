<?php
defined('ABSPATH') || exit;

class WC_Ass_DryRun {

    public static function preview_rules(array $rules) {
        $results = [];

        foreach ($rules as $rule) {
            $products = WC_Ass_ProductQuery::get_products_by_rule($rule);

            foreach ($products as $product_id) {
                $product = wc_get_product($product_id);
                $original_price = floatval($product->get_regular_price());
                $discount = WC_Ass_RuleEngine::calculate_discount($rule, $product);
                $new_price = $original_price * (1 - $discount / 100);

                $results[] = [
                    'ID' => $product_id,
                    'Name' => $product->get_name(),
                    'Original' => $original_price,
                    'Discount' => $discount,
                    'New' => $new_price,
                ];
            }
        }

        return $results;
    }
}
