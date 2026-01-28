<?php
defined('ABSPATH') || exit;

/**
 * Прилагане на отстъпки
 */
class WC_ASS_Apply {

    /**
     * @param int[] $product_ids
     * @param float $percent
     */
    public static function apply_discount(array $product_ids, float $percent): void {
        foreach ($product_ids as $id) {
            $product = wc_get_product($id);
            if (!$product) continue;

            $regular = (float)$product->get_regular_price();
            $new_price = round($regular * (1 - $percent / 100), 2);
            $product->set_sale_price($new_price);
            $product->save();

            WC_ASS_Logger::log("Applied {$percent}% discount to product #{$id}: {$regular} -> {$new_price}");
        }
    }
}
