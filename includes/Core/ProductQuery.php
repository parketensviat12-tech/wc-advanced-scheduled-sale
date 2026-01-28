<?php
defined('ABSPATH') || exit;

/**
 * Вземане на продукти по категории и производители
 */
class WC_ASS_ProductQuery {

    /**
     * @param int[] $category_ids
     * @param int[] $manufacturer_ids
     * @return int[] Връща IDs на продуктите
     */
    public static function get_products(array $category_ids = [], array $manufacturer_ids = []): array {
        $tax_query = ['relation' => 'AND'];

        if (!empty($category_ids)) {
            $tax_query[] = [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $category_ids,
                'operator' => 'IN',
            ];
        }

        if (!empty($manufacturer_ids)) {
            $tax_query[] = [
                'taxonomy' => 'pa_brand', // WooCommerce manufacturer attribute
                'field'    => 'term_id',
                'terms'    => $manufacturer_ids,
                'operator' => 'IN',
            ];
        }

        $query_args = [
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'fields'         => 'ids',
            'tax_query'      => $tax_query,
        ];

        return get_posts($query_args);
    }
}
