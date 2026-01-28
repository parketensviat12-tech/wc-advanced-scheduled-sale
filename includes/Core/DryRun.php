<?php
defined('ABSPATH') || exit;

/**
 * DryRun – Preview на отстъпките без да се прилагат
 */
class WC_ASS_DryRun {

    /**
     * @param array $product_ids
     * @param float $discount_percent
     * @return array
     */
    public static function preview($product_ids, $discount_percent) {
        $results = [];

        foreach ($product_ids as $id) {
            $product = wc_get_product($id);
            if (!$product) continue;

            $regular = floatval($product->get_regular_price());
            $sale = round($regular * (1 - $discount_percent / 100), 2);

            $results[] = [
                'ID' => $id,
                'title' => $product->get_name(),
                'regular_price' => $regular,
                'sale_price' => $sale
            ];
        }

        return $results;
    }
}
