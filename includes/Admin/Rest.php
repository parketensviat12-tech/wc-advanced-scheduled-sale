<?php
defined('ABSPATH') || exit;

class WC_ASS_Admin_Rest {

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route('wc-ass/v1', '/preview', [
            'methods'             => 'POST',
            'callback'            => [$this, 'preview_discount'],
            'permission_callback' => function() {
                return current_user_can('manage_woocommerce');
            },
            'args' => [
                'categories' => [
                    'required' => false,
                    'type' => 'array',
                    'items' => ['type' => 'integer'],
                ],
                'manufacturers' => [
                    'required' => false,
                    'type' => 'array',
                    'items' => ['type' => 'integer'],
                ],
                'percent' => [
                    'required' => true,
                    'type' => 'integer',
                    'minimum' => 0,
                    'maximum' => 100,
                ],
                'start' => [
                    'required' => true,
                    'type' => 'string',
                ],
                'end' => [
                    'required' => true,
                    'type' => 'string',
                ],
            ],
        ]);
    }

    public function preview_discount($request) {
        $categories    = $request->get_param('categories') ?? [];
        $manufacturers = $request->get_param('manufacturers') ?? [];
        $percent       = intval($request->get_param('percent'));
        $start         = sanitize_text_field($request->get_param('start'));
        $end           = sanitize_text_field($request->get_param('end'));

        // Вземаме продуктите по критерии
        $products = WC_ASS_ProductQuery::get_products($categories, $manufacturers);

        $preview = [];
        foreach ($products as $product_id) {
            $product = wc_get_product($product_id);
            if (!$product) continue;

            $regular = floatval($product->get_regular_price());
            $sale    = round($regular * (1 - $percent / 100), 2);

            $preview[] = [
                'id'            => $product_id,
                'title'         => $product->get_name(),
                'regular_price' => $regular,
                'sale_price'    => $sale,
            ];
        }

        return rest_ensure_response([
            'total_products' => count($preview),
            'percent'        => $percent,
            'start'          => $start,
            'end'            => $end,
            'preview'        => array_slice($preview, 0, 50), // показваме първите 50
        ]);
    }
}

new WC_ASS_Admin_Rest();
