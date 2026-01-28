<?php
defined('ABSPATH') || exit;

class WC_Ass_Apply {

    /**
     * Прилагане на отстъпки към продукти
     */
    public static function apply_rules(array $rules, $dry_run = false) {
        $affected_products = [];

        foreach ($rules as $rule) {
            $products = WC_Ass_ProductQuery::get_products_by_rule($rule);

            foreach ($products as $product_id) {
                $product = wc_get_product($product_id);
                if (!$product) continue;

                $original_price = floatval($product->get_regular_price());
                $discount = floatval($rule['discount'] ?? 0);

                if ($discount <= 0) continue;

                $new_price = $original_price * (1 - $discount / 100);

                if (!$dry_run) {
                    $product->set_sale_price($new_price);
                    $product->save();

                    WC_Ass_Logger::log("Прилагана отстъпка {$discount}% на продукт ID {$product_id}. Старо: {$original_price}, Ново: {$new_price}");
                }

                $affected_products[] = $product_id;
            }
        }

        return array_unique($affected_products);
    }

    /**
     * Preview без реално прилагане
     */
    public static function preview_rules(array $rules) {
        return self::apply_rules($rules, true);
    }
}
