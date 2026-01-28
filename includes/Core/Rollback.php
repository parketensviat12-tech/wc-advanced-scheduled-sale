<?php
defined('ABSPATH') || exit;

/**
 * Rollback отстъпки
 */
class WC_ASS_Rollback {

    /**
     * @param int[] $product_ids
     */
    public static function rollback(array $product_ids): void {
        foreach ($product_ids as $id) {
            $product = wc_get_product($id);
            if (!$product) continue;

            $product->set_sale_price('');
            $product->save();

            WC_ASS_Logger::log("Rolled back sale price for product #{$id}");
        }
    }
}
