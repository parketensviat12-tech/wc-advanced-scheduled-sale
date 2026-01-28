<?php
defined('ABSPATH') || exit;

/**
 * Rollback – връща предишната цена
 */
class WC_ASS_Rollback {

    /**
     * @param array $product_ids
     * @return int
     */
    public static function undo($product_ids) {
        $count = 0;

        foreach ($product_ids as $id) {
            $product = wc_get_product($id);
            if (!$product) continue;

            $product->set_sale_price(''); // премахва sale_price
            $product->save();

            WC_ASS_Logger::log("Rollback на продукт {$id} ({$product->get_name()})");

            $count++;
        }

        return $count;
    }
}
