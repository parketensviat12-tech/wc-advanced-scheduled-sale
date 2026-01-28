<?php
defined('ABSPATH') || exit;

/**
 * Прилагане на отстъпки
 */
class WC_ASS_Apply {

    /**
     * @param array $product_ids
     * @param float $discount_percent
     * @return int Колко продукта са променени
     */
    public static function apply($product_ids, $discount_percent) {
        $count = 0;

        foreach ($product_ids as $id) {
            $product = wc_get_product($id);
            if (!$product) continue;

            $regular = floatval($product->get_regular_price());
            $sale = round($regular * (1 - $discount_percent / 100), 2);

            $product->set_sale_price($sale);
            $product->save();

            // Лог
            WC_ASS_Logger::log("Отстъпка $discount_percent% приложена на продукт {$id} ({$product->get_name()})");

            $count++;
        }

        return $count;
    }
}
