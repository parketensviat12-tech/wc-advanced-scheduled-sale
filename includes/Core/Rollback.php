<?php
defined('ABSPATH') || exit;

class WC_Ass_Rollback {

    /**
     * Възстановява оригиналните цени на продуктите
     */
    public static function rollback_products(array $product_ids) {
        foreach ($product_ids as $product_id) {
            $product = wc_get_product($product_id);
            if (!$product) continue;

            $product->set_sale_price(''); // премахва sale_price
            $product->save();

            WC_Ass_Logger::log("Rollback: премахната отстъпка на продукт ID {$product_id}");
        }
    }
}
