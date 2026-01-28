<?php
defined('ABSPATH') || exit;

/**
 * Dry-run / Preview
 */
class WC_ASS_DryRun {

    /**
     * @param int[] $product_ids
     * @param float $percent
     * @return array [product_id => new_price]
     */
    public static function calculate(array $product_ids, float $percent): array {
        $result = [];
        foreach ($product_ids as $id) {
            $product = wc_get_product($id);
            if (!$product) continue;

            $regular = (float)$product->get_regular_price();
            $result[$id] = round($regular * (1 - $percent / 100), 2);
        }
        return $result;
    }
}
