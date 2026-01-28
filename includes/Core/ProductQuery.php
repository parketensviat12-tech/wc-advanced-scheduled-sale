<?php
defined('ABSPATH') || exit;

/**
 * Вземане на продукти по категории и производители
 */
class WC_ASS_ProductQuery {

    /**
     * @param array $category_ids
     * @param array $manufacturer_ids
     * @return WC_Product[]
     */
    public static function get_products($category_ids = [], $manufacturer_ids = []) {
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => -1, // Вземи всички
            'post_status'    => 'publish',
            'fields'         => 'ids',
            'tax_query'      => ['relation' => 'AND']
        ];

        if (!empty($category_ids)) {
            $args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $category_ids,
                'operator' => 'IN'
            ];
        }

        if (!empty($manufacturer_ids)) {
            $args['tax_query'][] = [
                'taxonomy' => 'product_brand', // или твоята таксономия за производител
                'field'    => 'term_id',
                'terms'    => $manufacturer_ids,
                'operator' => 'IN'
            ];
        }

        return get_posts($args);
    }
}
