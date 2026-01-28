<?php
defined('ABSPATH') || exit;

class WC_ASS_Helper_Apply {
    public static function apply_rule(array $rule): void {
        $product_ids = WC_ASS_ProductQuery::get_products($rule['categories'] ?? [], $rule['manufacturers'] ?? []);
        WC_ASS_Apply::apply_discount($product_ids, $rule['percent']);
    }
}
