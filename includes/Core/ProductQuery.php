<?php
defined('ABSPATH') || exit;

class WC_Ass_ProductQuery {

    public static function get_products_by_rule($rule) {
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'tax_query' => [],
            'meta_query' => [],
        ];

        // Филтър по категория
        if (!empty($rule['categories'])) {
            $args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $rule['categories'],
            ];
        }

        // Филтър по производител
        if (!empty($rule['brands'])) {
            $args['tax_query'][] = [
                'taxonomy' => 'pa_brand', // примерен атрибут за производител
                'field'    => 'slug',
                'terms'    => $rule['brands'],
            ];
        }

        // Филтър по SKU
        if (!empty($rule['skus'])) {
            $args['meta_query'][] = [
                'key'   => '_sku',
                'value' => $rule['skus'],
                'compare' => 'IN'
            ];
        }

        $query = new WP_Query($args);
        return $query->posts ?? [];
    }
}
