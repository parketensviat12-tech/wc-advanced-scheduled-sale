<?php
defined('ABSPATH') || exit;

class WC_Ass_Apply {
    public static function apply_discount($start, $end, $percent, $exclude_cats = [], $brands = []) {
        $today = date('Y-m-d');
        if($today < $start || $today > $end) return false;

        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => []
        ];

        if(!empty($exclude_cats)){
            $args['tax_query'][] = ['taxonomy'=>'product_cat','field'=>'term_id','terms'=>$exclude_cats,'operator'=>'NOT IN'];
        }
        if(!empty($brands)){
            $args['tax_query'][] = ['taxonomy'=>'product_brand','field'=>'term_id','terms'=>$brands,'operator'=>'IN'];
        }

        $products = get_posts($args);
        foreach($products as $product_post){
            $product = wc_get_product($product_post->ID);
            $regular = $product->get_regular_price();
            $new_price = round($regular * (1 - ($percent/100)),2);
            $product->set_sale_price($new_price);
            $product->save();
            WC_Ass_Logger::log("Product ID {$product_post->ID} updated: {$regular} → {$new_price}");
        }
    }
}
